<?php
namespace Core\Abstracts;

use Core\Interfaces\IDBConnection;
use PDO;

abstract class AbstractDBConnection {
    protected string $Username = 'root';
    protected string $Password = 'root';
    protected string $DSN      = 'mysql:host=eComm.local;dbname=shop;';
    protected array $Config    = [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'];

    protected ?PDO $PDO = null;
}
?>