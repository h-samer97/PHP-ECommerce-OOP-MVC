<?php

    namespace Model;

    class User {
        public int $userID;
        public string $username;
        public string $password;
        public string $email;
        public string $fullName;
        public int $userType;
        public int $trustStatus;
        public int $regStatus;
        public string $dateReg;
        public ?string $avatar; // nullable

        public function __construct(
            int $userID,
            string $username,
            string $password,
            string $email,
            string $fullName,
            int $userType,
            int $trustStatus,
            int $regStatus,
            string $dateReg,
            ?string $avatar = null
        ) {
        $this->userID = $userID;
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->fullName = $fullName;
        $this->userType = $userType;
        $this->trustStatus = $trustStatus;
        $this->regStatus = $regStatus;
        $this->dateReg = $dateReg;
        $this->avatar = $avatar;
    }

    public function getUsername(): string {
        return $this->username;
    }


}