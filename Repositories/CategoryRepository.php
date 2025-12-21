<?php 

    namespace Repositories;

use Core\Database\DBConnection;
use Model\Category;
use PDO;
use Stringable;

    class CategoryRepository {

        private PDO $PDO;

        public function __construct(?PDO $pdo = null)
        {
            $this->PDO = $pdo ?? (new DBConnection())->getConnection();
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
        public function isExist(string $name, ?int $id = null) : bool {

            $SQL = "SELECT COUNT(*) FROM categories WHERE `Name` = ? AND `ID` != ? ";

            $stmt = $this->PDO->prepare($SQL);
            $stmt->execute([$name, $id]);

            return (int) $stmt->fetchColumn() > 0;

        }

        public function update(array $data) : bool {

             $SQL = "UPDATE categories SET 
                `Name` = :name, 
                `Description` = :description, 
                `Order` = :order, 
                `Visibility` = :visibility, 
                `Allow_Comment` = :allow_comment, 
                `Allow_Ads` = :allow_ads 
                WHERE `ID` = :id";
            
            $stmt = $this->PDO->prepare($SQL);
            return $stmt->execute([
                ':name'           => $data['name'],
                ':description'    => $data['description'],
                ':order'          => $data['order'],
                ':visibility'     => $data['visible'],
                ':allow_comment'  => $data['comments'],
                ':allow_ads'      => $data['ads'],
                ':id'             => $data['id']
            ]);

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

        public function delete($id) : bool {

            $SQL = "DELETE FROM categories WHERE `categories`.`ID` = ?";

             $stmt = $this->PDO->prepare($SQL);
            $stmt->execute([$id]);

            return (int) $stmt->rowCount() > 0;

        }

        public function getTotalItemsInCats() {

            $SQL = 'SELECT c.Name AS Category, COUNT(i.Item_id) AS total_items
                    FROM items i
                    JOIN categories c ON i.Cat_ID = c.ID
                    GROUP BY c.Name
                    ORDER BY total_items DESC;
                    ';

            $stmt = $this->PDO->prepare($SQL);
            $stmt->execute([]);

            return $stmt->fetchAll(PDO::FETCH_ASSOC) ?? [];

        }
        

    }














?>