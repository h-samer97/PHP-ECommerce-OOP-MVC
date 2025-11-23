<?php


namespace Controllers;

use Core\Database\DBConnection;
use Core\Helper\Alert;
use Core\Helper\URL;
use Model\User;
use PDO;
use Repositories\UserRepository;
use Services\MemberService;
use Services\SessionsServices;
use Views\Layouts\Footer;
use Views\Layouts\Head;
use Core\Helper\FlashMessage;
use Soap\Url as SoapUrl;

    class MembersController {

        private MemberService $Service;


        public function __construct()
        {
            $this->Service = new MemberService();
        }



        public function index() {       
                
                    FlashMessage::init();
                    FlashMessage::display();

                    $users = new UserRepository(( new DBConnection())->getConnection() );
                    $rows = $users->getAllMembers();

                    include BASE_PATH . '/Views/Pages/MemberManage.php';
    }


        public function getPendingUsers() {
            $repo = new UserRepository( ( new DBConnection() )->getConnection() );
            $rows = $repo->getPendingUser();
            include BASE_PATH . '/Views/Pages/MemberManage.php';
        }

        public function acceptUser($id) : void {

            $repo = new UserRepository( ( new DBConnection() )->getConnection() );
            $rows = $repo->acceptUser($id);
            FlashMessage::init();
            FlashMessage::success('The User has Accepted');
            URL::redirect('members');

        }

        public function edit(int $id) {

        echo (new Head('Edit Member', 'editmembers'))->Render();

        $user = $this->Service->getMemberById($id);

        if ($user) {

            $rows = $user;

            include BASE_PATH . 'Views/Pages/Members.php';

        } else {

            Alert::Print("المستخدم غير موجود", 'error');
            URL::redirect('404');
        }

        echo (new Footer('script', ''))->Render();
    }


        public function delete(int $id) {

            $repo = new UserRepository( ( new DBConnection() )->getConnection() );
            $repo->deleteUser($id);
            FlashMessage::init();
            FlashMessage::success('The User Has been deleted');
            URL::redirect('members');

        }

        public function insert() {

            $session = new SessionsServices();

            if($_SERVER['REQUEST_METHOD'] === "POST") {
                
                $username = trim($_POST['username']);
                $password = password_hash($_POST['newPassword'], PASSWORD_DEFAULT);
                $email    = trim($_POST['email']);
                $fullname = trim($_POST['fullName']);
                $avatar   = null; // لاحقاً يمكن إضافة رفع صورة

                $repo = new UserRepository((new DBConnection())->getConnection());

                if ($repo->exists($username, $email)) {
                    FlashMessage::warning('This user Already Exists');
                } else {
                    $status = $repo->insertUser($username, $password, $email, $fullname, $avatar);

                    if ($status) {
                        FlashMessage::success('This Member Was Added');
                    } else {
                        FlashMessage::error('Field Add User');
                    }
                }

                URL::redirect('members');

            }
            
            include BASE_PATH . '/Views/Pages/AddMember.php';
        }

       public function update() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $errors = [];

            if(empty($_POST['username']) || strlen($_POST['username']) < 10) {

                $errors[] = "User Name Invalid";

            }
            if(empty($_POST['email'])) {

                $errors[] = "Email Name Invalid";

            }

            if(!empty($errors)) {

                foreach($errors as $error) {
                    Alert::Print($error, 'error');
                    return;
                }


            } else {

                $this->Service->updateMember($_POST);

            }



            // URL::redirect('members?do=manage');

        } else {

            URL::redirect('404');

        }
    }



    }












?>