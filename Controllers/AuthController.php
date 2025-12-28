<?php

namespace Controllers;

use Core\Database\DBConnection;
use Core\Helper\Alert;
use Services\AuthLogin;
use Services\SessionsServices;
use Core\Helper\URL;
use Repositories\UserRepository;
use Views\Layouts\Footer;
use Views\Layouts\Head;


class AuthController {

    private AuthLogin $auth;
    private SessionsServices $session;

    public function __construct(AuthLogin $login = null)
    {
        $this->session = new SessionsServices();
        if(!$this->session->checkIfExist()) {
            URL::redirect('login');
            return;
        }
        $this->auth = $login ?? new AuthLogin((new UserRepository((new DBConnection())->getConnection())));


    }

    public function renderLoginView(string $message = '', string $type = 'info') {

        echo (new Head('Login System', 'login'))->Render();
        
        $alertMessage = !empty($message) ? Alert::Print($message, $type) : '';

        include BASE_PATH . '/Views/Pages/Main/Login.php';

        echo (new Footer('script', ''))->Render();

    }

    public function login() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS) ?? '';
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS) ?? '';

            if(!empty($username) && !empty($password)) {

                $row = $this->auth->verifyLogin($username, $password);

                if ($row) {
                    
                    $this->session->start();
                    $this->session->set('username', $username);
                    $this->session->set('UserID', $row->userID);
    
                    # Go to Dashboard
    
                    URL::redirect('dashboard');
                    
                } else {
                    $this->renderLoginView('Invalid Username OR Password');
                }

            } else {
                $this->renderLoginView('Error');
            }

        } else {
            // in First Time: Show Login Form
            $this->renderLoginView('');
        }
    }
}
?>