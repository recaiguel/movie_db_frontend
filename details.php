<?php
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
            GROUP BY filme.id"
    }

?>