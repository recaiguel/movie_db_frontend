<?php

// Verbindung zur Datenbank
include './db.php';

if (isset($_POST['submit_actor'])) {
    try {

    // Daten aus dem Formular sicher in den Variablen speichern
    $vorname = $_POST['vorname'];
    $nachname = $_POST['nachname'];
    $geburtsdatum = $_POST['geburtsdatum'];
    $geschlecht = $_POST['geschlecht'];
    $nationalitaet = $_POST['nationalitaet'];

    // SQL-Befehl vorbereiten
    $sql = "INSERT INTO schauspieler (vorname, nachname, geburtsdatum, geschlecht, nationalität)
            VALUES (:vorname, :nachname, :geburtsdatum, :geschlecht, :nationalitaet)";

    $stmt = $pdo->prepare($sql);

    // Daten sicher binden und ausführen
    $stmt->execute([
        ':vorname' => $vorname,
        ':nachname' => $nachname,
        ':geburtsdatum' => $geburtsdatum,
        ':geschlecht' => $geschlecht,
        ':nationalitaet' => $nationalität
    ]);

    echo "<p style='color: green;'>Schauspieler erfolgreich hinzugefügt!</p>";

    } catch (PDOException $e) {
        die("Fehler beim Speichern: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FilmDB-Admin</title>
</head>
<body>
    <form method="POST" action="">
        
    </form>
</body>
</html>