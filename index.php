<?php
include 'db.php';

$sql = "SELECT Paintings.PaintingID, Paintings.Title, Paintings.YearOfWork, Artists.FirstName, Artists.LastName
        FROM Paintings
        JOIN Artists ON Paintings.ArtistID = Artists.ArtistID
        ORDER BY Paintings.PaintingID DESC
        LIMIT 20";

$stmt = $pdo->query($sql);
$paintings = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Artwork Gallery</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<nav>
    <a href="index.php">Home</a>
    <a href="artists.php">View Artists</a>
    <a href="add_painting.php">Add Painting</a>
    <a href="add_artist.php">Add Artist</a>
</nav>

<div class="container">
    <h1 style="margin-top: 20px;">🎨 Artwork Gallery</h1>

    <table class="styled-table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Artist</th>
                <th>Year</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($paintings)): ?>
                <tr><td colspan="4" style="text-align:center;">No paintings available.</td></tr>
            <?php else: ?>
                <?php foreach ($paintings as $index => $p): ?>
                    <tr <?= $index === 0 ? 'style="background-color: #eaffea;"' : '' ?>>
                        <td>
                            <?= htmlspecialchars($p['Title']) ?>
                            <?php if ($index === 0): ?>
                                <span style="color: green; font-size: 12px; font-weight: bold;">🆕 New</span>
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($p['FirstName'] . ' ' . $p['LastName']) ?></td>
                        <td><?= htmlspecialchars($p['YearOfWork']) ?></td>
                        <td>
                            <a href="edit_painting.php?id=<?= $p['PaintingID'] ?>" class="button" style="background:#28a745; padding:5px 10px; font-size:14px; color:white; text-decoration:none; border-radius:4px;">✏️ Edit</a>
                            <a href="view_painting.php?id=<?= $p['PaintingID'] ?>" class="button" style="background:#007bff; padding:5px 10px; font-size:14px; color:white; text-decoration:none; border-radius:4px;">🔍 View</a>
                            <a href="delete_painting.php?id=<?= $p['PaintingID'] ?>" onclick="return confirm('Delete this painting?')" class="button" style="background:#dc3545; padding:5px 10px; font-size:14px; color:white; text-decoration:none; border-radius:4px;">🗑️ Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>
