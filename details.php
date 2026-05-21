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
                fsk.mindest_alter AS fsk_alter,
                GROUP_CONCAT(DISTINCT genre.bezeichnung SEPARATOR ', ') AS genres,
                GROUP_CONCAT(DISTINCT studio.studio_name SEPARATOR ', ') AS studios,
                GROUP_CONCAT(DISTINCT land.land SEPARATOR ', ') AS laender,
                GROUP_CONCAT(DISTINCT m.bezeichnung SEPARATOR ', ') AS medien,
                GROUP_CONCAT(DISTINCT CONCAT(r.vorname, ' ', r.nachname)SEPARATOR ', ') AS regisseure,
                GROUP_CONCAT(DISTINCT CONCAT(s.vorname, ' ', s.nachname, ' (', fs.rollen_name, ')') SEPARATOR ', ') AS schauspieler
            FROM filme
            LEFT JOIN fsk ON filme.fskID = fsk.id
            LEFT JOIN film_genre ON filme.id = film_genre.filmeID
            LEFT JOIN genre ON film_genre.genreID = genre.id
            LEFT JOIN film_studio ON filme.id = film_studio.filmeID
            LEFT JOIN studio ON film_studio.studioID = studio.id
            LEFT JOIN film_produktionsland ON filme.id = film_produktionsland.filmeID
            LEFT JOIN produktionsland land ON film_produktionsland.landID = land.id
            LEFT JOIN film_medien ON filme.id = film_medien.filmeID
            LEFT JOIN medien AS m ON film_medien.medienID = m.id
            LEFT JOIN film_regie ON filme.id = film_regie.filmeID
            LEFT JOIN regie AS r ON film_regie.regieID = r.id
            LEFT JOIN film_schauspieler AS fs ON filme.id = fs.filmeID
            LEFT JOIN schauspieler AS s ON fs.schauspielerID = s.id
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
                <p><strong>Erscheinungsjahr: </strong> <?= $film['erscheinungsjahr'] ?> </p>
                <p><strong>Laufzeit: </strong> <?= $film['laufzeit_min'] ?> Minuten</p>
                <p><strong>FSK: </strong> Ab <?= $film['fsk_alter'] ?> Jahren</p>
                <p><strong>Genres: </strong> <?= htmlspecialchars($film['genres']) ?> </p>
                <p><strong>Regie: </strong> <?= htmlspecialchars($film['regisseure']) ?> </p>           <!-- regie -->
                <p><strong>Studios: </strong> <?= htmlspecialchars($film['studios']) ?> </p>            <!-- studio -->
                <p><strong>Produktionsland: </strong> <?= htmlspecialchars($film['laender']) ?> </p>    <!-- produktionsland -->
                <p><strong>Medien Formate: </strong> <?= htmlspecialchars($film['medien']) ?></p>       <!-- verfügbare Medien -->
                <br>
                <h3>Besetzung (Schauspieler)</h3>
                <h3><?= htmlspecialchars($film['schauspieler']) ?></h3>
            </div>
        </div>
    </div>
</div>

</body>
</html>