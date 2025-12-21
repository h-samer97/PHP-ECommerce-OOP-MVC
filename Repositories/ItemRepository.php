<?php

namespace Repositories;

use Core\Database\DBConnection;
use Core\Helper\Alert;
use PDO;
use PDOException;

class ItemRepository
{
    private PDO $pdo;

    public function __construct(?PDO $pdo = null)
    {
        $this->pdo = $pdo ?? (new DBConnection())->getConnection();
    }

   public function insert(string $name, string $description, int $price, string $country, int $status, int $rating, int $cat_id, int $member_id, ?string $image = null, int $approve = 0): bool {
    try {
        $SQL = "INSERT INTO `items` 
                (`Item_name`, `Item_description`, `Price`, `Add_Date`, `Country_Made`, `Image`, `Status_Item`, `Rating`, `Cat_ID`, `Member_ID`, `Approve`)
                VALUES (:name, :description, :price, NOW(), :country, :image, :status, :rating, :cat_id, :member_id, :approve)";

        $stmt = $this->pdo->prepare($SQL);

        // Bind parameters
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':price', $price, PDO::PARAM_INT);
        $stmt->bindParam(':country', $country, PDO::PARAM_STR);
        if ($image === null) {
            $stmt->bindValue(':image', null, PDO::PARAM_NULL);
        } else {
            $stmt->bindParam(':image', $image, PDO::PARAM_STR);
        }
        $stmt->bindParam(':status', $status, PDO::PARAM_INT);
        $stmt->bindParam(':rating', $rating, PDO::PARAM_INT);
        $stmt->bindParam(':cat_id', $cat_id, PDO::PARAM_INT);
        $stmt->bindParam(':member_id', $member_id, PDO::PARAM_INT);
        $stmt->bindParam(':approve', $approve, PDO::PARAM_INT);

        return $stmt->execute();
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}



    public function getCategoriesNameAID() : ?array {

        $SQL = "SELECT categories.Name, categories.ID FROM categories";
        $stmt = $this->pdo->prepare($SQL);
        $stmt->execute([]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC) ?? null;

    }

    public function getUsersWithID() : ?array {

        $SQL = "SELECT users.Username, users.UserID FROM users";
        $stmt = $this->pdo->prepare($SQL);
        $stmt->execute([]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC) ?? null;

    }

    public function findById($id) {

        $SQL = "SELECT * FROM items WHERE Item_id = ?";
        $stmt = $this->pdo->prepare($SQL);
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC) ?? [];

    }


  public function getItemsCountWithCats() {
    $SQL = "
        SELECT 
            categories.Name AS Name,
            COUNT(items.Item_id) AS ItemCount
        FROM categories
        LEFT JOIN items ON items.Cat_ID = categories.ID
        GROUP BY categories.ID
        ORDER BY ItemCount DESC
    ";

    $stmt = $this->pdo->prepare($SQL);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Always return an array, never null
    return $result ?: [];
}


                    public function update(
                    int $id,
                    string $name,
                    string $description,
                    float $price,
                    string $country,
                    int $status,
                    int $rating,
                    int $catid,
                    int $memberid
                ) : bool {

                    $SQL = "UPDATE `items` 
                            SET `Item_name` = ?, 
                                `Item_description` = ?, 
                                `Price` = ?, 
                                `Country_Made` = ?, 
                                `Status_Item` = ?, 
                                `Rating` = ?, 
                                `Cat_ID` = ?, 
                                `Member_ID` = ?, 
                                `Approve` = 1
                            WHERE `Item_id` = ?";

                    $stmt = $this->pdo->prepare($SQL);

                    return $stmt->execute([
                        $name,
                        $description,
                        $price,
                        $country,
                        $status,
                        $rating,
                        $catid,
                        $memberid,
                        $id
                    ]);
                }


            public function delete($id) : bool {

                $SQL = "DELETE FROM items WHERE `Item_id` = ?";

                $stmt = $this->pdo->prepare($SQL);
                $stmt->execute([$id]);

            return (int) $stmt->rowCount() > 0;

        }

        public function getItemWithCatsAnalisys() : ?array {

            $SQL = "SELECT categories.Name, COUNT(items.Item_id) AS ItemCount
                    FROM items
                    JOIN categories ON items.Cat_ID = categories.ID
                    GROUP BY categories.Name;
                    ";

                $stmt = $this->pdo->prepare($SQL);
                $stmt->execute([]);

            return $stmt->fetchAll(PDO::FETCH_ASSOC) ?? [];

        }

        public function getItemsByCategoryId(int $catId): array {

            $SQL = "SELECT * FROM items WHERE Cat_ID = ? ORDER BY Item_id DESC";
            $stmt = $this->pdo->prepare($SQL);
            $stmt->execute([$catId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC) ?? [];
            
}

        public function getCountryMadeAPI() : ?array {

            $SQL = "SELECT Country_Made, COUNT(*) AS ItemCount
                    FROM items
                    GROUP BY Country_Made
                    ORDER BY ItemCount DESC;
                    ";
            $stmt = $this->pdo->prepare($SQL);
            $stmt->execute([]);

            return $stmt->fetchAll(PDO::FETCH_ASSOC) ?? [];

        }

        public function analiysRating() : ?array {

            $SQL = 'SELECT Rating, COUNT(*) AS total
                    FROM items
                    GROUP BY Rating
                    ORDER BY Rating;
                    ';

             $stmt = $this->pdo->prepare($SQL);
            $stmt->execute([]);

            return $stmt->fetchAll(PDO::FETCH_ASSOC) ?? [];

        }

        public function analiysApprovedItems() {
            $SQL = 'SELECT Approve, COUNT(*) AS total
                    FROM items
                    GROUP BY Approve;
                    ';
            $stmt = $this->pdo->prepare($SQL);
            $stmt->execute([]);

            return $stmt->fetchAll(PDO::FETCH_ASSOC) ?? [];
        }



}