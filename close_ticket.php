<?php
require 'db.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];
$stmt = $pdo->prepare("UPDATE tickets SET status = 'closed' WHERE id = ?");
if ($stmt->execute([$id])) {
    header("Location: admin.php");
}
?>
