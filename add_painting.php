<?php
include 'db.php';

// Fetch artists for dropdown
$artists = $pdo->query("SELECT ArtistID, FirstName, LastName FROM Artists ORDER BY LastName")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['Title'] ?? '';
    $year = (int)($_POST['YearOfWork'] ?? 0);
    $artistId = (int)($_POST['ArtistID'] ?? 0);
    $description = $_POST['Description'] ?? '';

    // Simple validation
    if (!$title || !$artistId) {
        $error = "Title and Artist are required.";
    } else {
        $sql = "INSERT INTO Paintings (Title, YearOfWork, ArtistID, Description) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$title, $year, $artistId, $description]);

        header("Location: index.php");
        exit;
    }
}
// Generate year options for select dropdown (1900 to current year)
$currentYear = date('Y');
$years = range($currentYear, 1900); // descending order
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Painting</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet" />
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
    <h1>Add Painting</h1>

    <?php if (!empty($error)): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="post">
        <label>Title:</label>
        <input type="text" name="Title" required value="<?= htmlspecialchars($_POST['Title'] ?? '') ?>">

        <label>Year of Work:</label>
        <select name="YearOfWork">
            <option value="0">Select Year</option>
            <?php foreach ($years as $year): ?>
                <option value="<?= $year ?>" <?= (($_POST['YearOfWork'] ?? '') == $year) ? 'selected' : '' ?>><?= $year ?></option>
            <?php endforeach; ?>
        </select>

        <label>Artist:</label>
        <select name="ArtistID" required>
            <option value="">Select artist</option>
            <?php foreach ($artists as $artist): ?>
                <option value="<?= $artist['ArtistID'] ?>" <?= (isset($_POST['ArtistID']) && $_POST['ArtistID'] == $artist['ArtistID']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($artist['FirstName'] . ' ' . $artist['LastName']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Description:</label>
        <textarea name="Description" rows="5"><?= htmlspecialchars($_POST['Description'] ?? '') ?></textarea>

        <button type="submit">Add Painting</button>
    </form>
    <br>
    <a href="index.php" class="button">Back to Paintings</a>
</div>
</body>
</html>
