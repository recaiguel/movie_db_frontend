<?php 

// Verbindung zur Datenbank
include '../db.php'; 

if (isset($_POST['submit_film'])) {
    echo "Button wurde erkannt!";
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

        // Seite neuladen ohne dass das Speichern des Films nochmal ausgeführt wird
        header("Location: admin-filme.php?saved=true");
        exit;    

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


} catch (PDOException $e) {
    // Falls die Datenbank mal schluckauf hat, fangen wir den Fehler hier ab
    die("Datenbankfehler: " . $e->getMessage());
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
        // isset($_GET['saved']): Prüft ob das Wort "saved" in der URL existiert
        // $_GET['saved'] === 'true': Prüft ob der Wert genau den Text 'true' entspricht
        if (isset($_GET['saved']) && $_GET['saved'] === 'true'): ?>
        <div id="success-popup">
            Erfolgreich gespeichert
        </div>
    <?php endif; ?>

    <h2>Filme hinzufügen</h2>
    
    <form method="POST" action="" autocomplete="off">

    <p><strong>Titel:</strong></p>
    <input type="text" name="titel" id="titel" required>
    <br><br>

    <p><strong>Erscheinungsjahr:</strong></p>
    <input type="number" name="erscheinungsjahr" id="" required>
    <br><br>

    <p><strong>Laufzeit:</strong></p>
    <input type="number" name="laufzeit_min" id="" required>
    <br><br>

    <p><strong>Altersfreigabe:</strong></p>
    <select name="fsk_id" required>
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
    <select name="studio_id" id="studio" required>
        <?php foreach ($studio_list as $studio): ?>
            <option value="<?= $studio['id'] ?>"> <?= $studio['studio_name'] ?></option>
        <?php endforeach; ?>
    </select> 
    <br><br>
    
    <label for="produktionsland"><strong>Produktionsland:</strong></label><br>
    <select name="produktionsland[]" id="produktionsland" multiple size="5" required>
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

    <button type="submit" name="submit_film">Speichern</button>
    </form>

    <script src="./relation-script.js"></script>

</body>
</html>