<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first = $_POST['FirstName'];
    $last = $_POST['LastName'];
    $nationality = $_POST['Nationality'];
    $birth = (int)($_POST['YearOfBirth'] ?? 0);
    $death = (int)($_POST['YearOfDeath'] ?? 0);

    // Basic validation
    if ($first === '' || $last === '') {
        $error = "First Name and Last Name are required.";
    } 
    elseif ($birth !== 0 && $death !== 0 && $death < $birth) {
        $error = "Year of Death cannot be before Year of Birth.";
    } else {
        $sql = "INSERT INTO Artists (FirstName, LastName, Nationality, YearOfBirth, YearOfDeath) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$first, $last, $nationality, $birth, $death]);
        header("Location: artists.php");
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
    <title>Add Artist</title>
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
    <h1>Add New Artist</h1>

    <?php if (!empty($error)): ?>
        <p style="color:red;"> <?= htmlspecialchars($error) ?> </p>
    <?php endif; ?>

    <form method="post">
        <label>First Name:</label>
        <input type="text" name="FirstName" required>

        <label>Last Name:</label>
        <input type="text" name="LastName" required>

        <label>Nationality:</label>
        <input type="text" name="Nationality" value="<?= htmlspecialchars($_POST['Nationality'] ?? '') ?>">

        <label>Year of Birth:</label>
        <select name="YearOfBirth">
            <option value="0">Select Year</option>
            <?php foreach ($years as $year): ?>
                <option value="<?= $year ?>" <?= (($_POST['YearOfBirth'] ?? '') == $year) ? 'selected' : '' ?>><?= $year ?></option>
            <?php endforeach; ?>
        </select>

        <label>Year of Death:</label>
        <select name="YearOfDeath">
            <option value="0">Select Year</option>
            <?php foreach ($years as $year): ?>
                <option value="<?= $year ?>" <?= (($_POST['YearOfDeath'] ?? '') == $year) ? 'selected' : '' ?>><?= $year ?></option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Add Artist</button>
    </form>

    <br>
    <a href="artists.php" class="button">Back to Artists</a>
</div>
</body>
</html>
