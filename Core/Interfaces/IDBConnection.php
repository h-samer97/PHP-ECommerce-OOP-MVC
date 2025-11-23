<?php
namespace Core\Interfaces;

use PDO;

interface IDBConnection {
    public function connect(): void;
    public function getConnection(): PDO;
}
?>