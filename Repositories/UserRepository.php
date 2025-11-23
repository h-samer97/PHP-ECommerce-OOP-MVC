<?php

    namespace Repositories;

use DateTime;
use Exception;
use Model\User;
    use PDO;

    class UserRepository {

        private PDO $PDO;

        public function __construct(PDO $DB)
        {
            $this->PDO = $DB;
        }

        public function findById(int $id) : ?User {

            $SQL = 'SELECT * FROM users WHERE UserID = ? LIMIT 1';

            $stmt = $this->PDO->prepare($SQL);
            $stmt->execute([$id]);
            $Data = $stmt->fetch(PDO::FETCH_ASSOC);

                if(empty($Data)) return null;

                return new User(
                    (int)$Data['UserID'],
                    (string)$Data['Username'],
                    (string)$Data['Password'],
                    (string)$Data['Email'],
                    (string)$Data['FullName'],
                    (int)$Data['UserType'],
                    (int)$Data['TrustStatus'],
                    (int)$Data['RegStatus'],
                    $Data['Date_Reg'],
                    isset($Data['Avatar']) != null ? (string)$Data['Avatar'] : ''

                );

        }

        public function findByUsername(string $username): ?User {
        $stmt = $this->PDO->prepare("SELECT * FROM users WHERE Username = ?");
        $stmt->execute([$username]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            return null;
        }

        return new User(
            (int)$data['UserID'],
            (string)$data['Username'],
            (string)$data['Password'],
            (string)$data['Email'],
            (string)$data['FullName'],
            isset($data['UserType']) ? (int)$data['UserType'] : 0,
            isset($data['TrustStatus']) ? (int)$data['TrustStatus'] : 0,
            isset($data['RegStatus']) ? (int)$data['RegStatus'] : 0,
            $data['Date_Reg'],
            isset($data['Avatar']) ? (string)$data['Avatar'] : null
        );
    }

    public function updateUser(int $id, string $username, string $password, string $email, string $fullname) : bool {

        $SQL = "UPDATE users SET `Username` = ?, `Password` = ?, `Email` = ?, `FullName` = ? WHERE `UserID` = ?";
        $stmt = $this->PDO->prepare($SQL);
        $stmt->execute([$username, $password, $email, $fullname, $id]);
        $count = $stmt->rowCount();

        if($count > 0) {
            return true;
        }
        else {
            return false;
        }

    }

    public function insertUser(string $username, string $password, string $email, string $fullname, ?string $avatar) : bool {

       $SQL = "INSERT INTO users 
                (`Username`, `Password`, `Email`, `FullName`, `UserType`, `TrustStatus`, `RegStatus`, `Date_Reg`, `Avatar`) 
                VALUES (:username, :password, :email, :fullname, :usertype, :truststatus, :regstatus, :datereg, :avatar)";
                
        $success = false;

            try {

                $stmt = $this->PDO->prepare($SQL);
                    $success = $stmt->execute([
                    ':username'   => $username,
                    ':password'   => $password,
                    ':email'      => $email,
                    ':fullname'   => $fullname,
                    ':usertype'   => 0,
                    ':truststatus'=> 0,
                    ':regstatus'  => 0,
                    ':datereg'    => date('Y-m-d H:i:s'),
                    ':avatar'     => $avatar ?? null
                ]);

            } catch (\PDOException $error) {
                throw new \Exception("Database Insert Failed: " . $error->getMessage());
            }

            return (bool)$success;


    }

    public function exists(string $username, string $email) : bool {

        $SQL = "SELECT COUNT(*) FROM users WHERE Username = ? OR Email = ?";
        $stmt = $this->PDO->prepare($SQL);
        $stmt->execute([
            $username,
            $email
        ]);

        return $stmt->fetchColumn() > 0;

    }
    public function getAllMembers($limit = "", $sort = "ASC") : array {

            if(isset($limit)) {
                $SQL = "SELECT * FROM users ORDER BY Username " . $sort . "LIMIT " . $limit;
            } else {
                $SQL = "SELECT * FROM users ORDER BY Username " . $sort;
            }
            $stmt = $this->PDO->prepare($SQL);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }


    public function deleteUser(int $id) : bool {

        $SQL = 'DELETE FROM users WHERE `users`.`UserID` = ?';
        $stmt = $this->PDO->prepare($SQL);
        $stmt->execute([$id]);

        return $stmt->columnCount() > 0;

    }

    public function getUsersAndDates() : array {
        $SQL = "SELECT YEAR(Date_Reg) AS year, COUNT(*) AS count FROM users GROUP BY year ORDER BY year";

        $stmt = $this->PDO->prepare($SQL);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $rows ?? [];
    }

    public function sumCountAllUsers() : int {
        $SQL = "SELECT COUNT(Username) FROM users";

        $stmt = $this->PDO->prepare($SQL);
        $stmt->execute();

        return $stmt->columnCount() ?? 0;
    }

     public function getPendingUser() : array {
        $SQL = "SELECT * FROM users WHERE RegStatus = ?";

        $stmt = $this->PDO->prepare($SQL);
        $stmt->execute([0]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $rows ?? [];
    }

    public function acceptUser($id) : bool {
        $SQL = "UPDATE users SET RegStatus = 1 WHERE UserID = ?";

        $stmt = $this->PDO->prepare($SQL);
        $stmt->execute([$id]);
        

        return $stmt->rowCount() > 0;
    }

    public function countPendingMember() : int {
        $SQL = "SELECT COUNT(Username) FROM users WHERE RegStatus = 0";

        $stmt = $this->PDO->prepare($SQL);
        $stmt->execute();

        return $stmt->rowCount() ?? 0;
    }

}
