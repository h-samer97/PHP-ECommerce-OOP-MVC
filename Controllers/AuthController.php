<?php

namespace Controllers;

use Core\Database\DBConnection;
use Services\AuthLogin;
use Services\SessionsServices;
use Core\Helper\URL;
use Repositories\UserRepository;
use Views\Layouts\Head;
class AuthController {
    private AuthLogin $auth;

    public function __construct()
    {
        $this->auth = new AuthLogin((new UserRepository((new DBConnection())->getConnection())));
        // $this->auth->
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            $row = $this->auth->verifyLogin($username, $password);
            if ($row) {
                // بدء الجلسة
                
                $session = new SessionsServices();
                $session->start();
                $session->set('username', $username);
                $session->set('UserID', $row->userID);

                // التوجيه إلى لوحة التحكم
                URL::redirect('dashboard');
                exit;
            } else {
                // echo (new Head('Login System'))->Render();

                echo "<p style='color:red'>Invalid credentials</p>";
                include BASE_PATH . 'Views/Pages/Login.php';
            }
        } else {
            // أول مرة يفتح الصفحة → عرض الفورم
                echo (new Head('Login System', 'login'))->Render();
            include BASE_PATH . 'Views/Pages/Login.php';
        }
    }
}
?>