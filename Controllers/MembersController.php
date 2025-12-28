<?php

namespace Controllers;

use Core\Database\DBConnection;
use Core\Helper\FlashMessage;
use Core\Helper\URL;
use Repositories\UserRepository;
use Services\CSRFToken;
use Services\MemberService;
use Services\SessionsServices;

class MembersController {

    private MemberService $Service;
    private UserRepository $repo;
    private SessionsServices $session;

    public function __construct()
    {

        $this->session = new SessionsServices();
            if(!$this->session->checkIfExist()) {
                URL::redirect('login');
                return;
            }

        $this->Service = new MemberService();
        $this->repo = new UserRepository((new DBConnection())->getConnection());
    }

    public function index() {
        $rows = $this->repo->getAllMembers();
        include BASE_PATH . '/Views/Pages/Members/MemberManage.php';
    }

    public function getPendingUsers() {
        $rows = $this->repo->getPendingUser();
        include BASE_PATH . '/Views/Pages/MemberManage.php';
    }

    public function acceptUser(int $id): void {
        $this->repo->acceptUser($id);
        FlashMessage::init();
        FlashMessage::success('The user has been accepted');
        URL::redirect('members');
    }

    public function edit(int $id) {

        $user = $this->Service->getMemberById($id);

        if ($user) {
            $userRecord = $user;
            include BASE_PATH . '/Views/Pages/Members/EditMembers.php';
        } else {
            FlashMessage::init();
            FlashMessage::error("المستخدم غير موجود");
            URL::redirect('404');
        }
    }

    public function delete(int $id) {
    // Dont delete Myself :o
    if ($id == $_SESSION['UserID']) {
        FlashMessage::error('You cannot delete your own account!');
        URL::redirect('members');
        return;
    }

    if ($this->repo->deleteUser($id)) {
        FlashMessage::init();
        FlashMessage::success('The user has been deleted');
    } else {
        FlashMessage::init();
        FlashMessage::error('Failed to delete user or user not found');
    }
    
    URL::redirect('members');
}

    public function insert() {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $username = trim($_POST['username']);
            $password = $_POST['newPassword'];
            $email    = trim($_POST['email']);
            $fullname = trim($_POST['fullName']);
            $avatar   = null;

            if ($this->repo->exists($username, $email)) {
                FlashMessage::init();
                FlashMessage::warning('This user already exists');
            } else {
                $status = $this->repo->insertUser($username, $password, $email, $fullname, $avatar);
                FlashMessage::init();
                if ($status) {
                    FlashMessage::success('Member added successfully');
                } else {
                    FlashMessage::error('Failed to add member');
                }
            }
            URL::redirect('members');
        }

        include BASE_PATH . '/Views/Pages/AddMember.php';
    }

    public function update() {

        $csrf = new CSRFToken();
        
        if(!$csrf->validateRequest($_SERVER, $_POST)) {
            http_response_code(419);
            FlashMessage::init();
            FlashMessage::error('Page Expired! - ERROR 419');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = [];

            if (empty($_POST['username']) || strlen($_POST['username']) < 3) {
                $errors[] = "Invalid username";
            }
            if (empty($_POST['email'])) {
                $errors[] = "Invalid email";
            }

            if (!empty($errors)) {
                FlashMessage::init();
                foreach ($errors as $error) {
                    FlashMessage::error($error);
                }
                URL::redirect('members/edit/' . ($_POST['id'] ?? 0));
                return;
            }

            $this->Service->updateMember($_POST);
            FlashMessage::init();
            FlashMessage::success('Member updated successfully');
            URL::redirect('members');

        } else {
            URL::redirect('404');
        }
    }
}

?>
