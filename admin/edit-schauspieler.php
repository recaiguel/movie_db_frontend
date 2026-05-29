<?php
include '../db.php';

$id = $_GET['id'] ?? null;
if (!$id || !ctype_digit((string)$id)) {
    header('Location: admin-dashboard.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $vorname = $_POST['vorname'] ?? '';
    $nachname = $_POST['nachname'] ?? '';
    $geburtsdatum = $_POST['geburtsdatum'] ?? null;
    $geschlecht = $_POST['geschlecht'] ?? '';
    $nationalitaet = $_POST['nationalitaet'] ?? '';

    $sql = "UPDATE schauspieler
            SET vorname = :vorname,
                nachname = :nachname,
                geburtsdatum = :geburtsdatum,
                geschlecht = :geschlecht,
                nationalität = :nationalitaet
            WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':vorname' => $vorname,
        ':nachname' => $nachname,
        ':geburtsdatum' => $geburtsdatum,
        ':geschlecht' => $geschlecht,
        ':nationalitaet' => $nationalitaet,
        ':id' => $id,
    ]);

    header('Location: admin-dashboard.php?updated=true');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM schauspieler WHERE id = ?");
$stmt->execute([$id]);
$actor = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<?php include './admin-header.php'; ?>
<?php include './admin-nav.php'; ?>

<div class="main-content">
    <h2>Schauspieler bearbeiten</h2>
    <?php 
        // isset($_GET['updated']): Prüft, ob das Wort "updated" in der URL existiert
        // $_GET['updated'] === 'true': Prüft, ob der Wert genau dem Text 'true' entspricht
        if (isset($_GET['updated']) && $_GET['updated'] === 'true'): ?>
        
        <div id="success-popup">
            Schauspieler erfolgreich geändert!
        </div>
    <?php endif; ?>

    <form method="POST" action="" autocomplete="off">
        <p><strong>Vorname:</strong></p>
        <input type="text" name="vorname" value="<?= htmlspecialchars($actor['vorname']) ?>" required>

        <p><strong>Nachname:</strong></p>
        <input type="text" name="nachname" value="<?= htmlspecialchars($actor['nachname']) ?>" required>

        <p><strong>Geburtsdatum:</strong></p>
        <input type="date" name="geburtsdatum" value="<?= htmlspecialchars($actor['geburtsdatum']) ?>">

        <p><strong>Geschlecht:</strong></p>
        <select name="geschlecht">
            <option value="">-- Bitte wählen --</option>
            <option value="männlich" <?= $actor['geschlecht'] === 'männlich' ? 'selected' : '' ?>>Männlich</option>
            <option value="weiblich" <?= $actor['geschlecht'] === 'weiblich' ? 'selected' : '' ?>>Weiblich</option>
        </select>

        <p><strong>Nationalität:</strong></p>
        <select name="nationalitaet">
            <option value="">-- Bitte wählen --</option>
            <?php
            $countries = ['USA','Deutschland','Großbritannien','Frankreich','Kanada','Australien','Japan','Südkorea','Spanien','Italien'];
            foreach ($countries as $country): ?>
                <option value="<?= $country ?>" <?= $actor['nationalität'] === $country ? 'selected' : '' ?>><?= $country ?></option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Speichern</button>
    </form>
</div>
<script scr="./relation-script.js"></script>
</body>
</html>