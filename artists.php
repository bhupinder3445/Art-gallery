<?php
include 'db.php';

$stmt = $pdo->query("SELECT * FROM Artists ORDER BY ArtistID DESC");
$artists = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Artists List</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<nav>
    <a href="index.php">Home</a>
    <a href="add_artist.php">Add New Artist</a>
    <a href="add_painting.php">Add Painting</a>
</nav>

<div class="container">
    <h1>Artists</h1>

    <table class="styled-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Nationality</th>
                <th>Year of Birth</th>
                <th>Year of Death</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php if (count($artists) === 0): ?>
            <tr><td colspan="5" style="text-align:center;">No artists found.</td></tr>
        <?php else: ?>
            <?php foreach ($artists as $index => $artist): ?>
                <tr <?= $index === 0 ? 'style="background-color: #eaffea;"' : '' ?>>
                    <td>
                        <?= htmlspecialchars($artist['FirstName'] . ' ' . $artist['LastName']) ?>
                        <?php if ($index === 0): ?>
                            <span style="color: green; font-size: 12px; font-weight: bold;">🆕 New</span>
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($artist['Nationality']) ?></td>
                    <td><?= htmlspecialchars($artist['YearOfBirth']) ?></td>
                    <td><?= htmlspecialchars($artist['YearOfDeath']) ?></td>
                    <td>
                        <a href="edit_artist.php?id=<?= $artist['ArtistID'] ?>" class="button" style="background:#28a745; padding:5px 10px; font-size:14px;">✏️Edit</a>
                        <a href="delete_artist.php?id=<?= $artist['ArtistID'] ?>" onclick="return confirm('Delete this artist?')" class="button" style="background:#dc3545; padding:5px 10px; font-size:14px;">🗑️Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>

    <br>
    <a href="index.php" class="button">Back to Paintings</a>
</div>
</body>
</html>
