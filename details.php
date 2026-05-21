<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Verbindung zur Datenbank
include './db.php';

// den gemeinsamen Header einbinden
include './header.php';

// Sicherheits-Check: Existiert die ID in der URL und ist sie eine Zahl?
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<div class='Content'><h2>Fehler: Kein Film ausgewählt.</h2></div>";
    include './footer.php'; // Wenn ein Footer noch existiert
    exit;
}

// Die ID als sichere Ganzzahl (Integer) speichern
$filmId = (int)$_GET['id'];


try {
    
    $sql = "SELECT
                filme.id,
                filme.titel,
                filme.erscheinungsjahr,
                filme.laufzeit_min,
                GROUP_CONCAT(genre.bezeichnung SEPARATOR ', ') AS genres
            FROM filme
            LEFT JOIN film_genre ON filme.id = film_genre.filmeID
            LEFT JOIN genre ON film_genre.genreID = genre.id
            WHERE filme.id = ?
            GROUP BY filme.id";
    
    // Bereitet die Abfrage vor
    $statement = $pdo->prepare($sql);

    // Führe sie aus und setze die ID für das "?" ein
    $statement->execute([$filmId]);
    
    // Hole genau diesen Einen Film ab
    $film = $statement->fetch(2);

    // Sicherheit-Check: Was ist, wenn jemand id=999 eingibt, die es gar nicht gibt?
    if (!$film) {
        echo "<div class='content'><h2>Film existiert nicht in unserer Datenbank.</h2></div>";
        exit;   
        }

    } catch (PDOException $e) {
        // Falls die Datenbank mal schluckauf hat, fangen wir den Fehler hier ab
        die("Datenbankfehler: " . $e->getMessage());
    }

?>

<div class="layout-container">
    <div class="content">
        <p><a href="./index.php" class="back-link">&larr; Zurück</a></p>

        <div class="movie-detail-box">
            <h1><?= htmlspecialchars($film['titel']) ?></h1>

            <div class="movie-large-poster" >🎞️</div>

            <div class="movie-info-specs">
                <p><strong>Erscheinungsjahr:</strong> <?= $film['erscheinungsjahr'] ?></p>
                <p><strong>Laufzeit:</strong><?= $film['laufzeit_min'] ?>Minuten</p>
                <p><strong>Genres</strong><?= htmlspecialchars($film['genres']) ?></p>
            </div>
        </div>
    </div>
</div>

</body>
</html>