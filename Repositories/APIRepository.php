<?php


    namespace Repositories;

use Core\Database\DBConnection;
use PDO;
use PDOException;

    class APIRepository {

        private PDO $pdo;

        public function __construct()
        {
            $this->pdo = (new DBConnection())->getConnection();
        }

        public function getInformationToDashboard($id) : array {

            $SQL = 'SELECT users.UserID,
            users.UserName,
            users.FullName,
            users.Email,
            users.Date_Reg,
            users.Avatar,
            COUNT(items.Item_id) AS All_Items
            FROM users
            INNER JOIN items ON users.UserID = items.Member_ID
            WHERE users.UserID = ?
            GROUP BY users.UserID, users.UserName, users.FullName, users.Email, users.Date_Reg, users.Avatar';

            $stmt = $this->pdo->prepare($SQL);

            if (!$stmt) {
                return [];
            }

            if (!$stmt->execute([$id])) {
                return [];
            }

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            // fetch returns false when no row; ensure we always return an array
            return $result === false ? [] : $result;

        }

        public function getNotification($userId) : array {
            $SQL = "SELECT * FROM notifications WHERE user_id = ? ORDER BY created_at DESC";

            try {
                $stmt = $this->pdo->prepare($SQL);
                $stmt->execute([$userId]);
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                return [];
            }

        }

        public function readMarkNotification($notificationId) : bool {

           $stmt = $this->pdo->prepare("UPDATE notifications SET is_read = 1 WHERE id = ?");
            return $stmt->execute([$notificationId]);

        }

        public function addNotification(int $userId, string $message, string $type = 'info') : bool {
            $stmt = $this->pdo->prepare(
                "INSERT INTO notifications (user_id, message, type) VALUES (?, ?, ?)"
            );
            return $stmt->execute([$userId, $message, $type]);
        }


        public function getUnreadCount(int $userId) : int {
            $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM notifications WHERE user_id = ? AND is_read = 0");
            $stmt->execute([$userId]);
            return (int)$stmt->fetchColumn();
        }

        public function markAllAsRead(int $userId) : bool {
            $stmt = $this->pdo->prepare("UPDATE notifications SET is_read = 1 WHERE user_id = ?");
            return $stmt->execute([$userId]);
        }

    }
?>