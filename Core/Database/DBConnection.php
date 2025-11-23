<?php
namespace Core\Database;
use Core\Interfaces\IDBConnection;
use Core\Abstracts\AbstractDBConnection;
use PDO;
use PDOException;

class DBConnection extends AbstractDBConnection implements IDBConnection {

    public function connect(): void {
        if ($this->PDO === null) {
            try {
                $this->PDO = new PDO(
                    $this->DSN,
                    $this->Username,
                    $this->Password,
                    $this->Config
                );
                $this->PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                throw new \Exception("Database connection failed: " . $e->getMessage());
            }
        }
    }

    public function getConnection(): PDO {
        if ($this->PDO === null) {
            $this->connect();
        }
        return $this->PDO;
    }
}
?>