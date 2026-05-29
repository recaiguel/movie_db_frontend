<?php
include './db.php';
include './header.php';

if (!isset($_GET['id']) || !ctype_digit((string) $_GET['id'])) {
    echo "<div class='content'><h2>Fehler: Ungültige Schauspieler-ID.</h2></div>";
    exit;
}

$schauspielerId = (int) $_GET['id'];

try {
    $sql = "SELECT id, vorname, nachname, geburtsdatum, geschlecht, `nationalität`
            FROM schauspieler
            WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$schauspielerId]);
    $actor = $stmt->fetch();
    if (!$actor) {
        echo "<div class='content'><h2>Schauspieler nicht gefunden.</h2></div>";
        exit;
    }
} catch (PDOException $e) {
    die("Datenbankfehler: " . $e->getMessage());
}
?>

<div class="layout-container">
    <div class="content">
        <p><a href="./schauspieler.php" class="back-link">&larr; Zurück zur Schauspieler-Liste</a></p>

        <div class="movie-detail-box">
            <h1><?= htmlspecialchars($actor['vorname'] . ' ' . $actor['nachname']) ?></h1>

            <div class="movie-info-specs">
                <p><strong>Geburtsdatum:</strong> <?= htmlspecialchars($actor['geburtsdatum']) ?></p>
                <p><strong>Geschlecht:</strong> <?= htmlspecialchars($actor['geschlecht']) ?></p>
                <p><strong>Nationalität:</strong> <?= htmlspecialchars($actor['nationalität']) ?></p>
            </div>
        </div>
    </div>
</div>

</body>
</html>