<?php 

    namespace Repositories;

use Model\Category;
use PDO;
use Stringable;

    class CategoryRepository {

        private PDO $PDO;

        public function __construct(PDO $pdo)
        {
            $this->PDO = $pdo;
        }

        public function showAllCategories(string $sort = 'ASC') : array {

            if($sort == 'DESC') {
            $SQL = 'SELECT * FROM categories ORDER BY `Order` ' . $sort;
            } else {

                $SQL = "SELECT * FROM categories";

            }


            $stmt = $this->PDO->prepare($SQL);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC) ?? [];

        }

        public function findById(int $id) : ?Category {

             $SQL = 'SELECT * FROM categories WHERE ID = ?';

            $stmt = $this->PDO->prepare($SQL);
            $stmt->execute([$id]);
            $Data = $stmt->fetch(PDO::FETCH_ASSOC);

           if(empty($Data)) return null;

            return new Category (
                (int)$Data['ID'],
                (string)$Data['Name'],
                (string)$Data['Description'],
                (int)$Data['Order'],
                (int)$Data['Visibility'],
                (int)$Data['Allow_Comment'],
                (int)$Data['Allow_Ads'],

            );
        }
        public function isExist(string $name) : bool {

            $SQL = "SELECT COUNT(*) FROM categories WHERE Name = ? ";

            $stmt = $this->PDO->prepare($SQL);
            $stmt->execute([$name]);

            return (int) $stmt->fetchColumn() > 0;

        }

        public function insert(array $data) : bool {
            
            $SQL = "INSERT INTO `categories` (`Name`, `Description`, `Order`, `Visibility`, `Allow_Comment`, `Allow_Ads`)
                            VALUES (:name, :description, :order, :visibility, :allow_comment, :allow_ads); ";

            $stmt = $this->PDO->prepare($SQL);
           return $stmt->execute([
                ':name'             => $data['name'],
                ':description'      => $data['description'],
                ':order'            => $data['order'],
                ':visibility'       => $data['visible'],
                ':allow_comment'    => $data['comments'],
                ':allow_ads'        => $data['ads']
            ]);

        }

    }














?>