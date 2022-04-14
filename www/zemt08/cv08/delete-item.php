<?php
require __DIR__ . '/db.php';
require 'check-access.php';

if (!empty($_GET)) {
    $id = $_GET['id'];
    $stmt = $db->prepare("DELETE FROM goods 
    WHERE id = :id");
    $stmt->execute(['id' => $id]);
}

header('Location: index.php');
exit();
