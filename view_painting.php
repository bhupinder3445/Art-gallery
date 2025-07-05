<?php
include 'db.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    die("Painting ID missing");
}

$sql = "SELECT Paintings.*, Artists.FirstName, Artists.LastName 
        FROM Paintings 
        JOIN Artists ON Paintings.ArtistID = Artists.ArtistID 
        WHERE PaintingID = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$painting = $stmt->fetch();

if (!$painting) {
    die("Painting not found");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Painting - <?= htmlspecialchars($painting['Title']) ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<nav style="background: #007BFF; padding: 10px; color: white; text-align: center;">
    <a href="index.php" style="color:white; margin: 0 15px;">Home</a>
    <a href="artists.php" style="color:white; margin: 0 15px;">View Artists</a>
    <a href="add_painting.php" style="color:white; margin: 0 15px;">Add Painting</a>
    <a href="add_artist.php" style="color:white; margin: 0 15px;">Add Artist</a>
</nav>

<div class="container">
    <h1><?= htmlspecialchars($painting['Title']) ?></h1>
    <p><strong>Artist:</strong> <?= htmlspecialchars($painting['FirstName'] . ' ' . $painting['LastName']) ?></p>
    <p><strong>Year:</strong> <?= htmlspecialchars($painting['YearOfWork']) ?></p>
    <p><strong>Description:</strong><br><?= nl2br(htmlspecialchars($painting['Description'])) ?></p>

    <a href="edit_painting.php?id=<?= $painting['PaintingID'] ?>" class="button">Edit</a>
    <a href="delete_painting.php?id=<?= $painting['PaintingID'] ?>" onclick="return confirm('Delete this painting?')" class="button" style="background:#dc3545;">Delete</a>
    <br><br>
    <a href="index.php" class="button">Back to Gallery</a>
</div>
</body>
</html>
