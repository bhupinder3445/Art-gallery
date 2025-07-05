<?php
include 'db.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $artistId = (int) $_GET['id'];

    // Optional: check if the artist is linked to any paintings
    $check = $pdo->prepare("SELECT COUNT(*) FROM Paintings WHERE ArtistID = ?");
    $check->execute([$artistId]);
    $paintingsCount = $check->fetchColumn();

    if ($paintingsCount > 0) {
        // Prevent deletion if the artist has paintings
        header("Location: artists.php?error=Cannot delete artist linked to paintings.");
        exit;
    }

    // Proceed to delete the artist
    $stmt = $pdo->prepare("DELETE FROM Artists WHERE ArtistID = ?");
    $stmt->execute([$artistId]);
}

header("Location: artists.php");
exit;
?>
