<?php
include './db.php';
include './header.php';

try {
    $sql = "SELECT id, vorname, nachname, geburtsdatum, geschlecht, `nationalität`
            FROM schauspieler
            ORDER BY nachname, vorname";
    $stmt = $pdo->query($sql);
    $schauspieler = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Datenbankfehler: " . $e->getMessage());
}
?>

<div class="layout-container">
    <div class="content">
        <h2>Schauspieler</h2>

        <?php if (count($schauspieler) === 0): ?>
            <p>Keine Schauspieler in der Datenbank gefunden.</p>
        <?php else: ?>
            <table class="actor-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Geburtsdatum</th>
                        <th>Geschlecht</th>
                        <th>Nationalität</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($schauspieler as $actor): ?>
                        <tr>
                            <td>
                                <a href="schauspieler-detail.php?id=<?= $actor['id'] ?>">
                                <?= htmlspecialchars($actor['vorname'] . ' ' . $actor['nachname']) ?>
                                </a>
                            </td>
                            <td><?= htmlspecialchars($actor['geburtsdatum']) ?></td>
                            <td><?= htmlspecialchars($actor['geschlecht']) ?></td>
                            <td><?= htmlspecialchars($actor['nationalität']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>

</body>
</html>