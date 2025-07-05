<?php
include 'db.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    die("Painting ID missing");
}

// Fetch artists for dropdown
$artists = $pdo->query("SELECT ArtistID, FirstName, LastName FROM Artists ORDER BY LastName")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['Title'];
    $year = (int)$_POST['YearOfWork'];
    $artistId = (int)$_POST['ArtistID'];
    $description = $_POST['Description'] ?? '';

    $sql = "UPDATE Paintings SET Title=?, YearOfWork=?, ArtistID=?, Description=? WHERE PaintingID=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$title, $year, $artistId, $description, $id]);

    header("Location: view_painting.php?id=$id");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM Paintings WHERE PaintingID=?");
$stmt->execute([$id]);
$painting = $stmt->fetch();

if (!$painting) {
    die("Painting not found");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Painting</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<nav>
    <a href="index.php">Home</a>
    <a href="artists.php">Artists</a>
    <a href="add_painting.php">Add Painting</a>
    <a href="add_artist.php">Add Artist</a>
    
</nav>

<div class="container">
    <h1>Edit Painting</h1>

    <form method="post">
        <label>Title:</label>
        <input type="text" name="Title" value="<?= htmlspecialchars($painting['Title']) ?>" required>

        <label>Year of Work:</label>
        <input type="number" name="YearOfWork" min="0" value="<?= htmlspecialchars($painting['YearOfWork']) ?>">

        <label>Artist:</label>
        <select name="ArtistID" required>
            <option value="">Select artist</option>
            <?php foreach ($artists as $artist): ?>
                <option value="<?= $artist['ArtistID'] ?>" <?= $artist['ArtistID'] == $painting['ArtistID'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($artist['FirstName'] . ' ' . $artist['LastName']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Description:</label>
        <textarea name="Description" rows="5"><?= htmlspecialchars($painting['Description'] ?? '') ?></textarea>

        <button type="submit">Update Painting</button>
        <a href="view_painting.php?id=<?= $painting['PaintingID'] ?>" class="button cancel">Cancel</a>
    </form>
</div>
</body>
</html>
