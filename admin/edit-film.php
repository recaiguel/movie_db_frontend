<?php
include '../db.php';

$id = $_GET['id'] ?? null;
if (!$id || !ctype_digit((string)$id)) {
    header('Location: admin-dashboard.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titel = $_POST['titel'] ?? '';
    $erscheinungsjahr = $_POST['erscheinungsjahr'] ?? '';
    $laufzeit_min = $_POST['laufzeit_min'] ?? '';
    $fsk_id = $_POST['fsk_id'] ?? null;

    $sql = "UPDATE filme
            SET titel = :titel,
                erscheinungsjahr = :erscheinungsjahr,
                laufzeit_min = :laufzeit_min,
                fskID = :fsk_id
            WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':titel' => $titel,
        ':erscheinungsjahr' => $erscheinungsjahr,
        ':laufzeit_min' => $laufzeit_min,
        ':fsk_id' => $fsk_id,
        ':id' => $id,
    ]);

    header('Location: admin-dashboard.php?updated=true');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM filme WHERE id = ?");
$stmt->execute([$id]);
$film = $stmt->fetch(PDO::FETCH_ASSOC);

$fsk_list = $pdo->query("SELECT * FROM fsk ORDER BY mindest_alter ASC")->fetchAll(PDO::FETCH_ASSOC);
?>
<?php include './admin-header.php'; ?>
<?php include './admin-nav.php'; ?>

<div class="main-content">
    <h2>Film bearbeiten</h2>

        <?php 
        // isset($_GET['updated']): Prüft, ob das Wort "updated" in der URL existiert
        // $_GET['updated'] === 'true': Prüft, ob der Wert genau dem Text 'true' entspricht
        if (isset($_GET['updated']) && $_GET['updated'] === 'true'): ?>
        
        <div id="success-popup">
            Film erfolgreich geändert!
        </div>
    <?php endif; ?>

    <form method="POST" action="" autocomplete="off">
        <p><strong>Titel:</strong></p>
        <input type="text" name="titel" value="<?= htmlspecialchars($film['titel']) ?>" required>

        <p><strong>Erscheinungsjahr:</strong></p>
        <input type="number" name="erscheinungsjahr" value="<?= htmlspecialchars($film['erscheinungsjahr']) ?>" required>

        <p><strong>Laufzeit (Minuten):</strong></p>
        <input type="number" name="laufzeit_min" value="<?= htmlspecialchars($film['laufzeit_min']) ?>" required>

        <p><strong>Altersfreigabe:</strong></p>
        <select name="fsk_id" required>
            <?php foreach ($fsk_list as $fsk): ?>
                <option value="<?= $fsk['id'] ?>" <?= $fsk['id'] == $film['fskID'] ? 'selected' : '' ?>>
                    Ab <?= htmlspecialchars($fsk['mindest_alter']) ?> Jahren
                </option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Speichern</button>
    </form>
</div>
<script scr="./relation-script.js"></script>
</body>
</html>