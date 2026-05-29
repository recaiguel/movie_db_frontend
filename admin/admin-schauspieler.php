<?php

// Verbindung zur Datenbank
include '../db.php';

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
        ':nationalitaet' => $nationalitaet
    ]);

        // Nach dem speichern weiterleiten
        header("Location: admin-schauspieler.php?saved=true");
        exit;

    } catch (PDOException $e) {
        die("Fehler beim Speichern: " . $e->getMessage());
    }
}
?>

<?php include './admin-header.php'; ?>
<?php include './admin-nav.php'; ?>

    <div class="main-content">
    <?php 
        // isset($_GET['saved']): Prüft, ob das Wort "saved" in der URL existiert
        // $_GET['saved'] === 'true': Prüft, ob der Wert genau dem Text 'true' entspricht
        if (isset($_GET['saved']) && $_GET['saved'] === 'true'): ?>

        <div>
            Schauspieler erfolgreich gespeichert!
        </div>
    <?php endif; ?>

    <h2>Schauspieler hinzufügen</h2>

    <form method="POST" action="" autocomplete="off">
        <p><strong>Vorname:</strong></p>
        <input type="text" name="vorname" id="" placeholder="Dwayne">
        <br><br>
        
        <p><strong>Nachname:</strong></p>
        <input type="text" name="nachname" id="" placeholder="Johnson">
        <br><br>

        <p><strong>Geburtsdatum:</strong></p>
        <input type="date" name="geburtsdatum" id="">
        <br><br>

        <p><strong>Geschlecht:</strong></p>
        <select name="geschlecht" id="">
            <option value="">-- Bitte wählen --</option>
            <option value="männlich">Männlich</option>
            <option value="weiblich">Weiblich</option>
        </select>
        <br><br>

        <p><strong>Nationalität:</strong></p>
        <select name="nationalitaet" id=""> 
            <option value="">-- Bitte wählen --</option>
            <option value="USA">USA</option>
            <option value="Deutschland">Deutschland</option>
            <option value="Großbritannien">Großbritannien</option>
            <option value="Frankreich">Frankreich</option>
            <option value="Kanada">Kanada</option>
            <option value="Australien">Australien</option>
            <option value="Japan">Japan</option>
            <option value="Südkorea">Südkorea</option>
            <option value="Spanien">Spanien</option>
            <option value="Italien">Italien</option>
        </select>
        <br><br>

        <button name="submit_actor" type="submit">Speichern</button>
        <br>

    </form>

    </div>
    <script src="./relation-script.js"></script>

</body>
</html>