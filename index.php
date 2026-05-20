<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meine Film Datenbank</title>
    <link rel="stylesheet" href="./styles.css?t=<?php echo date('s'); ?>"/>

</head>

<body>

    <div class="menü">
        <nav class="navbar">
            <div class="logo">🎬FilmDB🍿</div>
            <ul class="nav-links">
                <li>
                    <input type="search" placeholder="Filme, Schauspieler suchen..." id="search">
                </li>
                <li><a href="./index.php">Home</a></li>
                <li><a href="./schauspieler.php">Schauspieler</a></li>
                <li><a href="./genres.php">Genres</a></li>
            </ul>
        </nav>
    </div>    

    <div class="layout-container">
        <!-- Hauptcontent -->
        <div class="Content">
            <h2>Filme</h2>
            
            <div class="movie-grid"></div>

        </div>        

        <div class="Submenü">
                <aside class="sidebar">
                    <h3>Filter</h3>
                    <ul>
                        <li><a href="#" data-genre="Action">Action</a></li>
                        <li><a href="#" data-genre="Abenteuer">Abenteuer</a></li>
                        <li><a href="#" data-genre="Sci-Fi">Sci-Fi</a></li>
                        <li><a href="#" data-genre="Fantasy">Fantasy</a></li>
                        <li><a href="#" data-genre="Drama">Drama</a></li>
                        <li><a href="#" data-genre="Komödie">Komödie</a></li>
                        <li><a href="#" data-genre="Horror">Horror</a></li>
                        <li><a href="#" data-genre="Thriller">Thriller</a></li>
                        <li><a href="#" data-genre="Krimi">Krimi</a></li>
                    </ul>
                </aside>

        </div>

    </div>

    <script src="./script.js"></script>

</body>
</html>

