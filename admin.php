<?php 

// Verbindung zur Datenbank
include './db.php'; 

try {

// SQL-Abfrage zum testen

$sql = "SELECT * FROM fsk";


} catch (PDOException $e) {
    // Falls die Datenbank mal schluckauf hat, fangen wir den Fehler hier ab
    die("Datenbankfehler: " . $e->getMessage());
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>adminDB</title>
</head>
<body>
    <select name="fsk_id" id="">
        <option value="1">Ab 0 Jahren</option>
        <option value="2">Ab 6 Jahren</option>
        <option value="3">Ab 12 Jahren</option>
        <option value="4">Ab 16 Jahren</option>
        <option value="5">Ab 18 Jahren</option>
        <option value="6">Ab 21 Jahren</option>
    </select>    
</body>
</html>