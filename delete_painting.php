<?php
include 'db.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    die("Painting ID missing");
}

$stmt = $pdo->prepare("DELETE FROM Paintings WHERE PaintingID = ?");
$stmt->execute([$id]);

header("Location: index.php");
exit;
