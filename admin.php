<?php 

// Verbindung zur Datenbank
include './db.php'; 

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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>adminDB</title>
</head>
<body>
    <select name="fsk_id">
        <?php foreach ($fsk_list as $fsk): ?>
            <option value="<?= $fsk['id'] ?>">Ab <?= $fsk['mindest_alter'] ?> Jahren</option>
        <?php endforeach; ?>
    </select>
    
    <p><strong>Genres ausählen:</strong></p>
    <?php foreach ($genre_list as $genre): ?>
        <label>
            <input type="checkbox" name="genres[]" value="<?= $genre['id'] ?>">
            <?= htmlspecialchars($genre['bezeichnung']) ?>
        </label><br>
    <?php endforeach; ?>
    
    <label for="studio">Studio:</label>
    <select name="studio_id" id="studio">
        <?php foreach ($studio_list as $studio): ?>
            <option value="<?= $fsk['id'] ?>"> <?= $studio['studio_name'] ?></option>
        <?php endforeach; ?>
    </select> 
    
    <select name="produktionsland_id">
        <?php foreach ($produktionsland_list as $produktionsland): ?>
            <option value="<?= $produktionsland['id'] ?>"> <?= $produktionsland['land'] ?></option>
        <?php endforeach; ?>
    </select> 

    <p><strong>Medien auswählen:</strong></p>
    <?php foreach ($medien_list as $medien): ?>
        <label>
            <input type="checkbox" name="medien[]" value="<?= $medien['id'] ?>">
            <?= htmlspecialchars($medien['bezeichnung']) ?>
        </label><br>
    <?php endforeach; ?>

</body>
</html>