<?php 

// Verbindung zur Datenbank
include './db.php'; 

if (isset($_POST['submit_film'])) {
    try {
                
        // Daten aus dem Formular sicher in Variablen speichern
        $titel = $_POST['titel'];
        $erscheinungsjahr = $_POST['erscheinungsjahr'];
        $laufzeit_min = $_POST['laufzeit_min'];
        $fsk_id = $_POST['fsk_id'];

        // SQL-Befehl für die Haupttabelle vorbereiten
        $sql = "INSERT INTO filme (titel, erscheinungsjahr, laufzeit_min, fskID)
                VALUES (:titel, :erscheinungsjahr, :laufzeit_min, :fsk_id)";

        $stmt = $pdo->prepare($sql);

        // Daten sicher binden und ausführen
        $stmt->execute([
            ':titel' => $titel,
            ':erscheinungsjahr' => $erscheinungsjahr,
            ':laufzeit_min' => $laufzeit_min,
            ':fsk_id' => $fsk_id
        ]);

        // Die frisch generierte Film-ID abgreifen
        $neue_film_id = $pdo->lastInsertID();

        // Studio in der Zwischentabele verknüpfen
        $studio_id = $_POST['studio_id'];

        // SQL-Befehl vorbereiten
        $sql_studio = "INSERT INTO film_studio (filmeID, studioID) VALUES (:film_id, :studio_id)";
        $stmt_studio = $pdo->prepare($sql_studio);
        $stmt_studio->execute([
            ':film_id' =>$neue_film_id,
            ':studio_id' =>$studio_id
        ]);

        // Genres in der Zwischentabelle verknüpfen
        if (isset($_POST['genres']) && is_array($_POST['genres'])) {
            $sql_genre = "INSERT INTO film_genre (filmeID, genreID) VALUES (:film_id, :genre_id)";
            $stmt_genre = $pdo->prepare($sql_genre);

            foreach ($_POST['genres'] as $genre_id) {
                $stmt_genre->execute([
                    ':film_id' => $neue_film_id,
                    ':genre_id' => $genre_id
                ]);
            }
        }

        
        // Medien in der Zwischentabelle verknüpfen
        if (isset($_POST['medien']) && is_array($_POST['medien'])) {
            $sql_medien = "INSERT INTO film_medien (filmeID, medienID) VALUES (:film_id, :medien_id)";
            $stmt_medien = $pdo->prepare($sql_medien);

            foreach ($_POST['medien'] as $medien_id) {
                $stmt_medien->execute([
                    ':film_id' => $neue_film_id,
                    ':medien_id' => $medien_id
                ]);
            }
        }

        // Regie in der Zwischentabelle verknüpen
        if (isset($_POST['regisseure']) && is_array($_POST['regisseure'])) {
            $sql_regie = "INSERT INTO film_regie (filmeID, regieID) VALUES (:film_id, :regie_id)";
            $stmt_regie = $pdo->prepare($sql_regie);

            foreach ($_POST['regisseure'] as $regie_id) {
                $stmt_regie->execute([
                    ':film_id' => $neue_film_id,
                    ':regie_id' => $regie_id
                ]);
            }
        }

        // Produktionsland in der Zwischentabelle verknüpfen
        if(isset($_POST['produktionsland']) && is_array($_POST['produktionsland'])) {
            $sql_produktionsland = "INSERT INTO film_produktionsland (filmeID, landID) VALUES (:film_id, :land_id)";
            $stmt_produktionsland = $pdo->prepare($sql_produktionsland);

            foreach ($_POST['produktionsland'] as $land_id) {
                $stmt_produktionsland->execute([
                    ':film_id' => $neue_film_id,
                    ':land_id' => $land_id
                ]);
            }
        }

        // HIER SIND SIE! Schauspieler und Rollennamen verknüpfen (Tabelle 'film_schauspieler')
        if (isset($_POST['schauspieler_ids']) && is_array($_POST['schauspieler_ids'])) {
            $sql_schauspieler = "INSERT INTO film_schauspieler (filmeID, schauspielerID, rollen_name) 
                                 VALUES (:film_id, :schauspieler_id, :rollen_name)";
            $stmt_schauspieler = $pdo->prepare($sql_schauspieler);
            
            // Wir nutzen den Index ($index), um ID und Rollennamen aus den beiden parallelen Arrays korrekt zu paaren
            foreach ($_POST['schauspieler_ids'] as $index => $schauspieler_id) {
                // Wenn in der Zeile kein Schauspieler ausgewählt wurde (leeres Dropdown), überspringen wir sie
                if (empty($schauspieler_id)) {
                    continue;
                }

                // Den passenden Rollennamen über die exakt gleiche Zeilennummer (Index) holen
                $rollen_name = $_POST['rollen_namen'][$index];

                $stmt_schauspieler->execute([
                    ':film_id' => $neue_film_id,
                    ':schauspieler_id' => $schauspieler_id,
                    ':rollen_name' => $rollen_name
                ]);
            }
        }

        echo "<p style='color: green;'>Film erfolgreich gespeichert!</p>";

    }   catch (PDOException $e) {
            die("Fehler beim speicher des Films: " . $e->getMessage());
        }
}



try {

// FSK holen
$sql = "SELECT * FROM fsk";
// Bereitet die Abrage vor
$query_fsk = $pdo->query($sql);
// Ergebnis wird in Variable $fsk_liste gespeichert
$fsk_list = $query_fsk->fetchAll(2);

// Genres holen
$sql = "SELECT * FROM genre";
$query_genre = $pdo->query($sql);
$genre_list = $query_genre->fetchAll(2);

// Studios holen
$sql = "SELECT * FROM studio";
$query_studio = $pdo->query($sql);
$studio_list = $query_studio->fetchAll(2);

// Produktionsländer holen
$sql = "SELECT * FROM produktionsland";
$query_produktionsland = $pdo->query($sql);
$produktionsland_list = $query_produktionsland->fetchAll(2);

// Medien/Formate holen
$sql = "SELECT * FROM medien";
$query_medien = $pdo->query($sql);
$medien_list = $query_medien->fetchAll(2);

//Regisseure holen
$sql = "SELECT * FROM regie";
$query_regie = $pdo->query($sql);
$regie_list = $query_regie->fetchAll(2);

// Schauspieler holen
$sql = "SELECT * FROM schauspieler";
$query_schauspieler = $pdo->query($sql);
$schauspieler_list = $query_schauspieler->fetchAll(2);


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
    <form method="POST" action="">
    <select name="fsk_id">
        <?php foreach ($fsk_list as $fsk): ?>
            <option value="<?= $fsk['id'] ?>">Ab <?= $fsk['mindest_alter'] ?> Jahren</option>
        <?php endforeach; ?>
    </select>
    <br><br>

    <p><strong>Genres ausählen:</strong></p>
    <?php foreach ($genre_list as $genre): ?>
        <label>
            <input type="checkbox" name="genres[]" value="<?= $genre['id'] ?>">
            <?= htmlspecialchars($genre['bezeichnung']) ?>
        </label><br>
    <?php endforeach; ?>
    <br><br>

    <label for="studio">Studio:</label><br>
    <select name="studio_id" id="studio">
        <?php foreach ($studio_list as $studio): ?>
            <option value="<?= $studio['id'] ?>"> <?= $studio['studio_name'] ?></option>
        <?php endforeach; ?>
    </select> 
    <br><br>
    
    <label for="produktionsland"><strong>Produktionsland:</strong></label><br>
    <select name="produktionsland[]" id="produktionsland" multiple size="5">
        <?php foreach ($produktionsland_list as $produktionsland): ?>
            <option value="<?= $produktionsland['id'] ?>"> <?= $produktionsland['land'] ?></option>
        <?php endforeach; ?>
    </select> 
    <br><small>❗Halte die <em>Strg-Taste</em> (Windows) oder <em>Cmd-Taste</em> (Mac) gedrückt, um mehrere Länder auszuwählen</small>
    <br><br>

    <p><strong>Medien auswählen:</strong></p>
    <?php foreach ($medien_list as $medien): ?>
        <label>
            <input type="checkbox" name="medien[]" value="<?= $medien['id'] ?>">
            <?= htmlspecialchars($medien['bezeichnung']) ?>
        </label><br>
    <?php endforeach; ?>
    <br><br>

    <label for="regisseure">🎬 <strong>Regie auswählen (Mehrfachauswahl möglich):</strong></label><br>
    <select name="regisseure[]" id="regisseure" multiple size="5">
        <?php foreach ($regie_list as $regie): ?>
            <option value="<?= $regie['id'] ?>">
                <?= htmlspecialchars($regie['vorname'] . ' ' . $regie['nachname']) ?>
            </option>
        <?php endforeach; ?>
    </select>
    <br><small>❗Halte die <em>Strg-Taste</em> (Windows) oder <em>Cmd-Taste</em> (Mac) gedrückt, um mehrere Regisseure auszuwählen</small>
    <br><br>

    <p><strong>Besetzung (Schauspieler & Rollen):</strong></p>
    <div id="schauspieler-container">
        <div class="schauspieler-row" style="margin-bottom: 10px;">
            <select name="schauspieler_ids[]">
            <option value="">-- Schauspieler wählen --</option>
            <?php foreach ($schauspieler_list as $schauspieler): ?>
                <option value="<?= $schauspieler['id'] ?>">
                    <?= htmlspecialchars($schauspieler['vorname'] . ' ' . $schauspieler['nachname']) ?>
                </option>
            <?php endforeach; ?>
            </select>

            <input type="text" name="rollen_namen[]" placeholder="Rollenname (z.B Jack Sparrow)">
        </div>
    </div>
    
    <button type="button" id="add-schauspieler">+ Weiteren Schauspieler Hinzufügen</button>
    <br><br>
    <button type="submit">Absenden</button>
    </form>

    <script src="./admin-script.js"></script>

</body>
</html>