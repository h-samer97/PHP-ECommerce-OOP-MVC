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

        public function findByItemId($id) : ?Comment {

            $SQL = "
                SELECT 
                    items.Item_id AS itemId,
                    items.Item_name,
                    comments.c_id AS commentId,
                    comments.comments,
                    comments.status_com,
                    comments.Added_date,
                    comments.user_id
                    FROM items
                    INNER JOIN comments 
                    ON items.Item_id = comments.item_id
                WHERE comments.c_id = ?
            ";

            $stmt = $this->pdo->prepare($SQL);
            $stmt->execute([$id]);
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            if(empty($data)) return null;

            return new Comment(
                (int)$data['commentId'],
                (string)$data['comments'],
                (int)$data['status_com'],
                (string)$data['Added_date'],
                (int)$data['itemId'],
                (int)$data['user_id']
                
            );

        }

    }

?>