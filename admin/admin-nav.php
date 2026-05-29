<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FilmDB-Admin</title>
    <link rel="stylesheet" href="./admin-style.css?t=<?php echo date('s'); ?>"/>
</head>
    <body>
        
        <nav class="admin-nav">
            <a href="admin-filme.php">🎞️ Film hinzufügen</a>
            <a href="admin-schauspieler.php">🎭 Schauspieler hinzufügen</a>
            <a href="fs_relation.php">🎭->🎞️ Schauspieler zu Film</a>
            <a href="admin-regie.php">🎥 Regisseur hinzufügen</a>
            <a href="fr_relation.php">🎥->🎞️Regisseur zu Film</a>
        </nav>  