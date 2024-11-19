<?php
require 'db.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

$tickets = $pdo->query("SELECT t.*, u.username FROM tickets t JOIN users u ON t.user_id = u.id")->fetchAll();
?>

<h1>Admin Panel</h1>
<table border="1">
    <tr>
        <th>ID</th>
        <th>User</th>
        <th>Subject</th>
        <th>Message</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($tickets as $ticket): ?>
        <tr>
            <td><?= $ticket['id'] ?></td>
            <td><?= $ticket['username'] ?></td>
            <td><?= $ticket['subject'] ?></td>
            <td><?= $ticket['message'] ?></td>
            <td><?= $ticket['status'] ?></td>
            <td>
                <?php if ($ticket['status'] == 'open'): ?>
                    <a href="close_ticket.php?id=<?= $ticket['id'] ?>">Close</a>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
