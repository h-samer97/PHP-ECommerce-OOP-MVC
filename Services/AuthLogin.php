<?php

    namespace Services;

use Core\Helper\Alert;
use Repositories\UserRepository;

    class AuthLogin {

        private UserRepository $repo;

        public function __construct(UserRepository $repo)
        {
            $this->repo = $repo;
        }

        public function verifyLogin(string $username, string $password) {

            $row = $this->repo->findByUsername($username);

            if (!$row) {
                Alert::Print('error Verify Login', 'error');
                return false;
            };

            if (password_verify($password, $row->password)) {
                
                return $row ?? true;
            }


        }

    }






?>