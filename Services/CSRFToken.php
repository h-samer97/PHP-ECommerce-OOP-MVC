<?php

    namespace Services;

    use Services\SessionsServices;

    class CSRFToken {

        protected string $sessionKey = 'csrf_token';
        protected int $ttlTime = 3600; # 1 Hour - TTL = Time To Live
        protected string $timeStampKey = 'csrf_token_ts';


        public function ensureToken() : void {

            if(session_status() !== PHP_SESSION_ACTIVE) {

                session_start();

                $expired = isset($_SESSION[$this->timeStampKey]) && 
                ( time() - $_SESSION[$this->timeStampKey] > $this->ttlTime );

                if(empty($_SESSION[$this->timeStampKey]) || $expired) {
                    $session = new SessionsServices();
                    $session->set($this->sessionKey, bin2hex(random_bytes(32)));
                    $session->set($this->timeStampKey, time());
                }

            }

        }

        public function getToken() : mixed {

            $this->ensureToken();

            return $_SESSION[$this->sessionKey];

        }

        public function rotateToken() : mixed {

            $session = new SessionsServices();
            $bool = $session->checkIfExist();

            if($bool) {

                $session->set($this->sessionKey, bin2hex(random_bytes(32)));
                $session->set($this->timeStampKey, time());

            }

            return $_SESSION[$this->sessionKey];

        }

        public function generateFieldToken(string $name = '__TOKEN__') : string {

            $token = htmlspecialchars($this->getToken(), ENT_QUOTES, 'UTF-8');
            $field = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');

            return '<input type="hidden" ' . 'name="' . $field . '" value="' . $token . '">'; 

        }
        public function validateRequest(array $server, array $post, array $headers = [], string $paramName = '__TOKEN__'): bool {
            
            $method = strtoupper($server['REQUEST_METHOD'] ?? 'GET');
            if(in_array($method, ['GET', 'HEAD', 'OPTION'])) {
                return true;
            }

            $tokenForm = isset($post[$paramName]) ? (string)$post[$paramName] : null;
            $tokenHeader = isset($headers['X-CSRF-TOKEN']) ? (string)$headers['X-CSRF-TOKEN'] : null;

            if (session_status() !== PHP_SESSION_ACTIVE) {
                session_start();
            }
            
            $sessionToken = $_SESSION[$this->sessionKey] ?? null;

            $match = ($tokenForm && hash_equals($sessionToken ?? '', $tokenForm)) ||
            ($tokenHeader && hash_equals($sessionToken ?? '', $tokenHeader));

            if (!$match) {
                return false;
            }

            return true;


        }


    }










?>