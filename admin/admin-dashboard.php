<?php
include '../db.php';

// =================================
// Logik zum Löschen von Datensätzen 
// =================================
if (isset($_POST['delete_item'])) {
    $id = $_POST['id'] ?? null;
    $type = $_POST['type'] ?? null;

    if ($id && ctype_digit((string) $id) && in_array($type, ['film', 'schauspieler', 'regie'], true)) {
        try {
            $pdo->beginTransaction();

            if ($type === 'film') {
                $pdo->prepare("DELETE FROM film_studio WHERE filmeID = ?")->execute([$id]);
                $pdo->prepare("DELETE FROM film_genre WHERE filmeID = ?")->execute([$id]);
                $pdo->prepare("DELETE FROM film_produktionsland WHERE filmeID = ?")->execute([$id]);
                $pdo->prepare("DELETE FROM film_medien WHERE filmeID = ?")->execute([$id]);
                $pdo->prepare("DELETE FROM film_schauspieler WHERE filmeID = ?")->execute([$id]);
                $pdo->prepare("DELETE FROM film_regie WHERE filmeID = ?")->execute([$id]);
                $pdo->prepare("DELETE FROM filme WHERE id = ?")->execute([$id]);
            } elseif ($type === 'schauspieler') {
                $pdo->prepare("DELETE FROM film_schauspieler WHERE schauspielerID = ?")->execute([$id]);
                $pdo->prepare("DELETE FROM schauspieler WHERE id = ?")->execute([$id]);
            } elseif ($type === 'regie') {
                $pdo->prepare("DELETE FROM film_regie WHERE regieID = ?")->execute([$id]);
                $pdo->prepare("DELETE FROM regie WHERE id = ?")->execute([$id]);
            }

            $pdo->commit();
            header("Location: admin-dashboard.php?deleted=true");
            exit;
        } catch (PDOException $e) {
            $pdo->rollBack();
            die("Fehler beim Löschen: " . $e->getMessage());
        }
    }
}

// =============================
// Daten aus der Datenbank laden
// =============================
try {
    $stmt_filme = $pdo->query("SELECT f.id, f.titel, f.erscheinungsjahr, f.laufzeit_min, fsk.mindest_alter
                                FROM filme f 
                                LEFT JOIN fsk ON f.fskID = fsk.id
                                ORDER BY f.id DESC");
    $filme_liste = $stmt_filme->fetchAll(PDO::FETCH_ASSOC);

    $stmt_schauspieler = $pdo->query("SELECT id, vorname, nachname, geburtsdatum, nationalität
                                        FROM schauspieler
                                        ORDER BY id DESC");
    $schauspieler_liste = $stmt_schauspieler->fetchAll(PDO::FETCH_ASSOC);

    $stmt_regie = $pdo->query("SELECT id, vorname, nachname, geburtsdatum, nationalität
                                FROM regie
                                ORDER BY id DESC");
    $regie_liste = $stmt_regie->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Fehler beim Laden der Daten: " . $e->getMessage());
}
?>
<?php include './admin-header.php'; ?>
<?php include './admin-nav.php'; ?>

<div class="main-content">
    <?php if (isset($_GET['deleted'])): ?>
        <div id="success-popup" style="background-color: #ef4444;">Datensatz erfolgreich gelöscht</div>
    <?php endif; ?>

    <h2>Zentrale Datenverwaltung</h2>
    <p style="color: #718096; margin-bottom: 30px; align-self: flex-start; max-width: 1000px; width: 100%">
        Hier siehst du alle gespeicherten Einträge deiner Datenbank. Du kannst Einträge löschen oder bearbeiten.
    </p>

    <div class="dashboard-tables-container">
        <div class="table-card">
            <h3>🎬 Gespeicherte Filme</h3>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Titel</th>
                            <th>Jahr</th>
                            <th>Laufzeit</th>
                            <th>FSK</th>
                            <th>Aktionen</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($filme_liste as $film): ?>
                            <tr>
                                <td><?= $film['id'] ?></td>
                                <td><strong><?= htmlspecialchars($film['titel']) ?></strong></td>
                                <td><?= $film['erscheinungsjahr'] ?></td>
                                <td><?= $film['laufzeit_min'] ?> Min.</td>
                                <td>FSK <?= $film['mindest_alter'] ?? 'N/A' ?></td>
                                <td class="actions-cell">
                                    <a href="edit-film.php?id=<?= $film['id'] ?>" class="btn-edit">Bearbeiten</a>
                                    <form method="POST" action="" onsubmit="return confirm('Möchtest du diesen Film wirklich löschen? Alle Verknüpfungen gehen verloren.');" style="display:inline;">
                                        <input type="hidden" name="id" value="<?= $film['id'] ?>">
                                        <input type="hidden" name="type" value="film">
                                        <button type="submit" name="delete_item" class="btn-delete">Löschen</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if (empty($filme_liste)): ?>
                            <tr><td colspan="6" class="empty-cell">Keine Filme vorhanden.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="table-card">
            <h3>🎭 Gespeicherte Schauspieler</h3>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Geburtsdatum</th>
                            <th>Nationalität</th>
                            <th>Aktionen</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($schauspieler_liste as $actor): ?>
                            <tr>
                                <td><?= $actor['id'] ?></td>
                                <td><strong><?= htmlspecialchars($actor['vorname'] . ' ' . $actor['nachname']) ?></strong></td>
                                <td><?= $actor['geburtsdatum'] ? date('d.m.Y', strtotime($actor['geburtsdatum'])) : 'N/A' ?></td>
                                <td><?= htmlspecialchars($actor['nationalität'] ?? 'N/A') ?></td>
                                <td class="actions-cell">
                                    <a href="edit-schauspieler.php?id=<?= $actor['id'] ?>" class="btn-edit">Bearbeiten</a>
                                    <form method="POST" action="" onsubmit="return confirm('Möchtest du diesen Schauspieler wirklich löschen?');" style="display:inline;">
                                        <input type="hidden" name="id" value="<?= $actor['id'] ?>">
                                        <input type="hidden" name="type" value="schauspieler">
                                        <button type="submit" name="delete_item" class="btn-delete">Löschen</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if (empty($schauspieler_liste)): ?>
                            <tr><td colspan="5" class="empty-cell">Keine Schauspieler vorhanden.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="table-card">
            <h3>🎥 Gespeicherte Regisseure</h3>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Geburtsdatum</th>
                            <th>Nationalität</th>
                            <th>Aktionen</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($regie_liste as $regie): ?>
                            <tr>
                                <td><?= $regie['id'] ?></td>
                                <td><strong><?= htmlspecialchars($regie['vorname'] . ' ' . $regie['nachname']) ?></strong></td>
                                <td><?= $regie['geburtsdatum'] ? date('d.m.Y', strtotime($regie['geburtsdatum'])) : 'N/A' ?></td>
                                <td><?= htmlspecialchars($regie['nationalität'] ?? 'N/A') ?></td>
                                <td class="actions-cell">
                                    <a href="edit-regie.php?id=<?= $regie['id'] ?>" class="btn-edit">Bearbeiten</a>
                                    <form method="POST" action="" onsubmit="return confirm('Möchtest du diesen Regisseur wirklich löschen?');" style="display:inline;">
                                        <input type="hidden" name="id" value="<?= $regie['id'] ?>">
                                        <input type="hidden" name="type" value="regie">
                                        <button type="submit" name="delete_item" class="btn-delete">Löschen</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if (empty($regie_liste)): ?>
                            <tr><td colspan="5" class="empty-cell">Keine Regisseure vorhanden.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="./relation-script.js"></script>
</body>
</html>