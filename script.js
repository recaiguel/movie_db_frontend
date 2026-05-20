let alleFilme = [];

// 1. Wir holen uns das Grid-Element aus dem HTML, in das die Filme geladen werden sollen
const movieGrid = document.querySelector(".movie-grid");

const searchInput = document.getElementById("search");
searchInput.addEventListener("input", (event) => {
    // Was hat der Nutzer eingetippt? (in Kleinbuchstaben umgewandelt)
    const suchBegriff = event.target.value.toLowerCase();

    // Wir filtern die Liste "alleFilme" basierend auf dem Titel
    const gefilterteFilme = alleFilme.filter(film => {
        return film.titel.toLowerCase().includes(suchBegriff);
    });

    // Wir übergeben die gefilterten Filme an deine bestehende Schleifen-Funktion!
    zeigeFilmeAn(gefilterteFilme);
} )

// Alle Links in der Sidebar auswählen
const genreLinks = document.querySelectorAll('.sidebar a');

// Jeden Link mit einem Klick-Zuhörer ausstatten
genreLinks.forEach(link => {
    link.addEventListener('click', (event) => {
        // Stoppt das Neuladen der Seite durch das href-Attribut
        event.preventDefault();

        // Das angeklickte Genre aus dem data-genre-Attribut auslesen
        const gewaehltesGenre = event.target.dataset.genre;

        // Die Filme filtern
        const gefilterteFilme = alleFilme.filter(film => {
            // Falls ein Film gar kein Genre hat, schützen wir uns vor Fehlern
            if (!film.genres) return false;

            // Prüfen ob das gewählte Genre im Text vorkommt
            return film.genres.includes(gewaehltesGenre);
        });

        // Die gefilterte Liste im Grid anzeigen
        zeigeFilmeAn(gefilterteFilme);
    });
});

// Hauptfunktion, die die echten Daten im Hintergrund von PHP abruft
async function ladeUndZeigeFilme() {
    console.log("1. Ich starte den Abruf aus der Datenbank...");

    try {
        // Wir warten auf die Antwort von deiner filme.php auf der VM
        const antwort = await fetch('filme.php');
        const echteFilme = await antwort.json();

        console.log("2. Daten erfolgreich geladen! Jetzt werden sie gezeichnet.", echteFilme);

        // Hier speichern wir die echten Daten an die Zeichen-Funktion
        alleFilme = echteFilme;

        // Wir übergeben die echten Daten an die Zeichen-Funktion
        zeigeFilmeAn(echteFilme);

    } catch (fehler) {
        console.error("Fehler beim Laden der Filme vom Server:", fehler);
    }
}

// Fuktion, die die Filme dynamisch auf der Seite anzeigt
function zeigeFilmeAn(filmeListe) {
    // Zuerst leeren wir das Grid, falls noch Text drinsteht
    movieGrid.innerHTML = '';

    // Schleife: Wir gehen jeden Film aus der MySQL-Datenbank einzeln durch
    filmeListe.forEach(film => {
        // Wir bauen das HTML Grundgerüst für eine einzelne Karte mit den echten Tabellenspalten
        const htmlKarte = `
            <a href="./details.php?id=${film.id}" class="movie-card-link">
                <div class="movie-card">
                    <div class="movie-poster">🎞️</div>
                    <h3>${film.titel}</h3>
                    <p class="movie-meta">${film.erscheinungsjahr} | ${film.laufzeit_min} Min.</p>
                </div>
            </a>
        `;

        // Wir fügen die neu gebaute Karte an das Ende unseres Grids an
        movieGrid.insertAdjacentHTML('beforeend', htmlKarte);
    });
}

// Wir starten die Funktion direkt beim Laden der Seite
ladeUndZeigeFilme();