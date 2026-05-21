<?php

// Verbindung zur Datenbank
include './db.php';

// Headers setzen, damit der Browser JSON akzeptiert und CORS erlaubt ist
header("Acces-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


try {

    // Die neue SQL-Abfrage mit GROUP_CONCAT für die Genres
    $sql = "SELECT
                filme.id,
                filme.titel,
                filme.erscheinungsjahr,
                filme.laufzeit_min,
                GROUP_CONCAT(genre.bezeichnung SEPARATOR ', ') AS genres
            FROM filme
            LEFT JOIN film_genre ON filme.id = film_genre.filmeID
            LEFT JOIN genre ON film_genre.genreID = genre.id
            GROUP BY filme.id";

    $statement = $pdo->query($sql);
    // $statement = $pdo->prepare($sql);
    // $statement = $pdo->execute($sql);

    // Fix für PHP 8.5: Wir nutzen die '2' für den assoziativen Modus
    $filme = $statement->fetchAll(2);

    // Daten als JSON an das Frontend senden
    echo json_encode($filme);
    
} catch (PDOException $e) {
    // Falls etwas schiefgeht, senden wir eine Fehlermeldung als JSON
    echo json_encode(["fehler" => "Datenverbindung fehlgeschlagen: " . $e->getMessage()]);
}
?>