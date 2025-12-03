<?php

use Core\Database\DBConnection;

$Conn = (new DBConnection())->getConnection();
$q    = $_GET['q'] ?? '';
$resulte = [];
$SQL1 = 'SELECT `Username` FROM users WHERE Username LIKE ?';
$SQL2 = 'SELECT `Name` FROM categories WHERE `Name` LIKE ?';
$SQL3 = 'SELECT `Item_name` FROM items WHERE `Item_name` LIKE ?';

$stmt = $Conn->prepare($SQL1);
$stmt->execute(["%{$q}%"]);
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt2 = $Conn->prepare($SQL2);
$stmt2->execute(["%{$q}%"]);
$categories = $stmt2->fetchAll(PDO::FETCH_ASSOC);

$stmt3 = $Conn->prepare($SQL3);
$stmt3->execute(["%{$q}%"]);
$items = $stmt3->fetchAll(PDO::FETCH_ASSOC);

$resulte = [
  "users" => $users,
  "categories" => $categories,
  "items" => $items
];




header('Content-Type: application/json; charset=utf-8');
echo json_encode($resulte, JSON_UNESCAPED_UNICODE);


?>