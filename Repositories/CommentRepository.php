<?php

    namespace Repositories;

use Core\Database\DBConnection;
use Model\Comment;
use PDO;

    class CommentRepository {

        private PDO $pdo;

        public function __construct()
        {
            $this->pdo = ( new DBConnection() )->getConnection();
        }

        public function findById(int $id) : ?Comment {
                    $SQL = "
                    SELECT 
                        items.Item_id       AS itemId,
                        items.Item_name     AS itemName,
                        comments.c_id       AS commentId,
                        comments.comments   AS commentText,
                        comments.status_com AS status,
                        comments.Added_date AS addedDate,
                        comments.user_id    AS userId,
                        users.Username      AS username
                    FROM items
                    INNER JOIN comments ON items.Item_id = comments.item_id
                    INNER JOIN users    ON users.UserID = comments.user_id
                    WHERE comments.c_id = ?
                    LIMIT 1

                    ";

                    $stmt = $this->pdo->prepare($SQL);
                    $stmt->execute([$id]);
                    $data = $stmt->fetch(PDO::FETCH_ASSOC);

                    if (!$data) return null;

                    return new Comment(
                        (int)$data['commentId'],
                        (string)$data['itemName'],
                        (string)$data['commentText'],
                        (int)$data['status'],
                        (string)$data['addedDate'],
                        (int)$data['itemId'],
                        (int)$data['userId'],
                        (string)$data['username']
                    );
}


        public function getLatestComments($count) : array {

                    $SQL = 'SELECT 
                        users.Username AS UserName,
                        users.UserID   AS User_ID,
                        comments.comments AS CommentText,
                        comments.Added_date AS CommentDate,
                        comments.user_id AS CommentUserID,
                        items.Member_ID AS ItemMemberID,
                        comments.item_id AS CommentItemID,
                        items.Item_name AS ItemName,
                        comments.c_id AS CommentID,
                        comments.status_com AS CommentStatus
                    FROM users
                    INNER JOIN comments 
                        ON users.UserID = comments.user_id
                    INNER JOIN items 
                        ON items.Item_id = comments.item_id
                    LIMIT ' . $count;


                     $stmt = $this->pdo->prepare($SQL);
                    $stmt->execute();
                    $data = $stmt->fetchAll(PDO::FETCH_OBJ);

                    return $data ?? [];

        }

        public function updateComment(int $id, string $content, int $status): bool {

            $SQL = "UPDATE comments SET comments = ?, status_com = ? WHERE c_id = ?";
            $stmt = $this->pdo->prepare($SQL);
            return $stmt->execute([$content, $status, $id]);
            
        }

        public function deleteComment($id) : bool {
            $SQL = "DELETE FROM comments WHERE c_id = ?";
            $stmt = $this->pdo->prepare($SQL);
            return $stmt->execute([$id]);
        }

    }

?>