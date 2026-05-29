
<?php 

// Verbindung zur Datenbank
include '../db.php';

if (isset($_POST['submit_rolle'])) {

    try {

        // Daten aus dem Formular sicher in Variablen speichern
        $filmeID = $_POST['filmeID'];
        $schauspielerID = $_POST['schauspielerID'];
        $rollen_name = $_POST['rollen_name'];
        $gage = $_POST['gage'];
        $rollenID = $_POST['rollenID'];

        if ($gage === '') {
            $gage = null;
        }
        
        // SQL-Befehl für die film_schauspieler Tabelle vorbereiten
        $sql = "INSERT INTO film_schauspieler (filmeID, schauspielerID, rollen_name, gage, rollenID)
                VALUES (:filmeID, :schauspielerID, :rollen_name, :gage, :rollenID)";

        $stmt = $pdo->prepare($sql);


        // Daten sicher binden und ausführen;
        $stmt->execute([
            ':filmeID' => $filmeID,
            ':schauspielerID' => $schauspielerID,
            ':rollen_name' => $rollen_name,
            ':gage' => $gage,
            ':rollenID' => $rollenID
        ]);

        // Nach dem erfolgreichen Speichern weiterleiten
        header("Location: fs_relation.php?saved=true");
        exit;
    

        } catch (PDOException $e) {
            die("Fehler beim Speichern der Rolle: " . $e->getMessage());
            }
}

try {       // Lädt alle benötigten Stammdaten 
            // (Filme, Schauspieler, Rollen) aus der Datenbank, 
            // um die Dropdowns im Formular zu befüllen


// Filme holen
$sql = "SELECT * FROM filme";

// Bereitet die Abfrage vor
$query_filme = $pdo->query($sql);

// Ergbenis wird in Variable $film_liste gespeichert
$film_liste = $query_filme->fetchAll(2);


//Schauspieler holen
$sql = "SELECT * FROM schauspieler";

//bereitet die Abfrage vor
$query_schauspieler = $pdo->query($sql);

// Ergebnis wird in Variable $query_schauspieler gespeichert
$schauspieler_liste = $query_schauspieler->fetchAll(2);


$sql = "SELECT * FROM rollen";
$query_rollen = $pdo->query($sql);
$rollen_liste = $query_rollen->fetchAll(2);

} catch (PDOException $e) {
    // Falls die Datenbank mal Schluckauf hat, fangen wir den Fehler hier ab
    die("Datenbank: " . $e->getMessage());    
}
?>
    
<?php include './admin-header.php'; ?>
<?php include './admin-nav.php'; ?>

    <div class="main-content">
    <?php 
        // isset($_GET['saved']): Prüft, ob das Wort "saved" in der URL existiert
        // $_GET['saved'] === 'true': Prüft, ob der Wert genau dem Text 'true' entspricht
        if (isset($_GET['saved']) && $_GET['saved'] === 'true'): ?>
        
        <div id="success-popup">
            Schauspieler erfolgreich zum Film hinzugefügt!
        </div>
    <?php endif; ?>

    <h2>Schauspieler zum Film zuweisen</h2>

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
        <br>

        <div id="schauspieler-container">
            <div class="schauspieler-row">
            <p><strong>Schauspieler:</strong></p>

            <select name="schauspielerID" id="" required>
                <option value="">-- Schauspieler wählen --</option>
                <?php foreach ($schauspieler_liste as $schauspieler): ?>
                    <option value="<?= $schauspieler['id'] ?>">
                        <?= htmlspecialchars($schauspieler['vorname'] . ' ' . $schauspieler['nachname']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            </div>
        </div>
        <br>

        <div id="rollenname-container">
            <div class="Rollenname-row">
            <p><strong>Rollenname:</strong></p>
            <input type="text" name="rollen_name" id="rollen_name" placeholder="Bruce Wayne" required>
            </div>
        </div>
        <br>

        <div id="gage-container">
            <div class="gagen-row">
                <p><strong>Gage:</strong></p>
                <input type="number" name="gage" id="gage" placeholder="20000000" >
            </div>
        </div>
        <br>

        <div id="rollenID-container">
            <div class="rollenID-row">
                <p><strong>Rollen-Art:</strong></p>
                <select name="rollenID" required>
                    <option value="">-- Rollen Art --</option>
                    <?php foreach ($rollen_liste as $rollen): ?>
                        <option value="<?= $rollen['id'] ?>">
                            <?= htmlspecialchars($rollen['rollen_bezeichnung']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <br>

        <button name="submit_rolle" type="submit">Speichern</button>
        <br>
    </form>

    </div>
    <script src="./relation-script.js"></script>

</body>
</html>