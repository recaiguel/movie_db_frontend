<?php

//Verbindung zur Datenbank
include '../db.php';

if (isset($_POST['submit_filmRegie'])) {
    try {

    // Daten aus dem Formular sicher in den Variablen speichern
    $filmeID = $_POST['filmeID'];
    $regieID = $_POST['regieID'];

    // SQL-Befehl für die film_regie Tabelle
    $sql = "INSERT INTO film_regie (filmeID, regieID)
            VALUES (:filmeID, :regieID)";

    $stmt = $pdo->prepare($sql);

    // Daten sicher binden und ausführen
    $stmt->execute([
        ':filmeID' => $filmeID,
        ':regieID' => $regieID
    ]);

    // Nach dem erfolgreichen Speichern weiterleiten
    header("Location: fr_relation.php?saved=true");
    exit;

    } catch (PDOException $e) {
        die("Fehler beim Speichern des Film-Regisseurs: " . $e->getMessage());
        }
}

try {       // Lädt alle benötigten Stammdaten 
            // (Filme, Schauspieler, Rollen) aus der Datenbank, 
            // um die Dropdowns im Formular zu befüllen

$sql = "SELECT * FROM filme";               // Filme holen
$query_filme = $pdo->query($sql);           // bereitet die Abfrage vor
$film_liste = $query_filme->fetchAll(2);    // Ergebnis wird in Variable $film_liste gespeichert

$sql = "SELECT * FROM regie";               // Regisseure holen
$query_regie = $pdo->query($sql);           // bereitet die Abfrage vor
$regie_liste = $query_regie->fetchAll(2);    // Ergebnis wird in Variable $regie_liste gespeichert

} catch (PDOException $e) {
    // Falls die Datenbank mal Schluckauf hat, fangen wir den Fehler ab
    die("Datenbank: " . $e->getMessage());
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

    <?php include './admin-nav.php' ?>

    <?php 
        // isset($_GET['saved']): Prüft, ob das Wort "saved" in der URL existiert
        // $_GET['saved'] === 'true': Prüft, ob der Wert genau dem Text 'true' entspricht
        if (isset($_GET['saved']) && $_GET['saved'] === 'true'): ?>
        
        <div id="success-popup">
            Regisseur erfolgreich zum Film hinzugefügt!
        </div>
    <?php endif; ?>

    <h2>Regisseur zum Film zuweisen</h2>

        <form method="POST" action="" autocomplete="off">

        <div id="film-container">
            <div class="film-row">
            <p><strong>Film:</strong></p>

            <select name="filmeID" required>
            
                <option value="">-- Film wählen --</option>
                <?php foreach ($film_liste as $filme): ?>
                    <option value="<?= $filme['id'] ?>">
                        <?= htmlspecialchars($filme['titel']) ?>
                    </option>
                <?php endforeach; ?>   
            </select>
            </div>
        </div>

        <div id="regisseur-container">
            <div class="regisseur-row">
            <p><strong>Regisseur:</strong></p>

            <select name="regieID" id="" required>
                <option value="">-- Regisseur wählen --</option>
                <?php foreach ($regie_liste as $regie): ?>
                    <option value="<?= $regie['id'] ?>">
                        <?= htmlspecialchars($regie['vorname'] . ' ' . $regie['nachname']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            </div>
        </div>

        <button name="submit_filmRegie" type="submit">Speichern</button>
        <br><br>
    </form>

    <script src="./relation-script.js"></script>

</body>
</html>