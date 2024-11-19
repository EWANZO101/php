<?php
require 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $stmt = $pdo->prepare("INSERT INTO tickets (user_id, subject, message) VALUES (?, ?, ?)");
    if ($stmt->execute([$_SESSION['user_id'], $subject, $message])) {
        echo "Ticket created successfully!";
    } else {
        echo "Error: Could not create ticket.";
    }
}
?>

<form method="POST">
    <input type="text" name="subject" placeholder="Subject" required>
    <textarea name="message" placeholder="Message" required></textarea>
    <button type="submit">Create Ticket</button>
</form>
