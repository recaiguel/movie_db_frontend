**README für mein FilmDB-Projekt**



**# FilmDB**



**## Projektübersicht**

**Diese Anwendung ist eine einfache Film-Datenbank mit einem öffentlichen Bereich und einem Admin-Bereich.**



**- Frontend zeigt Filme und Schauspieler**

**- Admin-Bereich erlaubt Hinzufügen, Bearbeiten und Löschen**

**- MySQL-Datenbank wird über PHP/PDO angebunden**

**- `script.js` lädt Filme dynamisch aus `filme.php`**



**---**



**## Installation / Setup**

**1. Lege die Dateien in ein PHP-fähiges Webverzeichnis (z. B. `/var/www/html`)**

**2. Passe die Datenbank-Zugangsdaten in `db.php` an**

**3. Stelle sicher, dass die MySQL-Datenbank `filmdb` existiert und die Tabellen angelegt sind**

**4. Rufe `index.php` im Browser auf**



**---**



**## Wichtige Dateien**



**### `db.php`**

**- Stellt die PDO-Verbindung zur Datenbank her**

**- Setzt `ERRMODE\_EXCEPTION` und `FETCH\_ASSOC`**



**### `header.php`**

**- Gemeinsame Kopfzeile für das Frontend**

**- Enthält Logo, Menü und Suchfeld**

**- Verlinkt `index.php` und `schauspieler.php`**



**### `index.php`**

**- Startseite**

**- Lädt `header.php`**

**- Zeigt ein Film-Grid**

**- Nutzt `script.js`, um Filme dynamisch zu laden**



**### `filme.php`**

**- JSON-Endpoint für `script.js`**

**- Führt diese Abfrage aus:**



**```sql**

**SELECT**

&#x20;   **filme.id,**

&#x20;   **filme.titel,**

&#x20;   **filme.erscheinungsjahr,**

&#x20;   **filme.laufzeit\_min,**

&#x20;   **GROUP\_CONCAT(genre.bezeichnung SEPARATOR ', ') AS genres**

**FROM filme**

**LEFT JOIN film\_genre ON filme.id = film\_genre.filmeID**

**LEFT JOIN genre ON film\_genre.genreID = genre.id**

**GROUP BY filme.id**



**# Gibt die Filmdaten als JSON zurück**



**# details.php**

* **Zeigt Filmdetails für details.php?id=...**
* **Verwendet viele LEFT JOINs, um verknüpfte Daten aus mehreren Tabellen zu laden**



**Zeigt:**

* **Titel**
* **Erscheinungsjahr**
* **Laufzeit**
* **FSK**
* **Genres**
* **Studios**
* **Produktionsländer**
* **Medienformate**
* **Regisseure**
* **Schauspieler mit Rollen**





**# schauspieler.php**

**# Listet alle Schauspieler aus der Tabelle schauspieler**



**Zeigt:**

* **Vorname + Nachname**
* **Geburtsdatum**
* **Geschlecht**
* **Nationalität**

**:Verlinkt jeden Schauspieler auf eine Detailseite (schauspieler-detail.php), falls vorhanden**





**# script.js**

* **Lädt Filme per fetch('filme.php')**
* **Speichert sie in alleFilme**
* **Zeigt die Filmkarten im .movie-grid**
* **Filtert nach Suchbegriff und Genre**



**# Admin-Bereich**

**# admin/admin-header.php**

* **Gemeinsame Kopfzeile für Admin-Seiten**
* **Lädt admin-style.css**



**# admin/admin-nav.php**

**# Admin-Menü mit Links zu:**



**admin-filme.php**

**admin-schauspieler.php**

**fs\_relation.php**

**admin-regie.php**

**fr\_relation.php**

**admin-dashboard.php**





**# admin/admin-filme.php**



**Formular zum Hinzufügen neuer Filme**

**Speichert:**

* **titel**
* **erscheinungsjahr**
* **laufzeit\_min**
* **fskID**
* **Verknüpft zusätzlich:**
* **studio über film\_studio**
* **genre über film\_genre**
* **produktionsland über film\_produktionsland**
* **medien über film\_medien**



**# admin/admin-schauspieler.php**

**Formular zum Hinzufügen neuer Schauspieler**

**Speichert:**

* **vorname**
* **nachname**
* **geburtsdatum**
* **geschlecht**
* **Nationalität**



**# admin/edit-schauspieler.php**



* **Bearbeitet existierende Schauspieler**
* **Lädt den Datensatz per id**
* **Aktualisiert ihn per SQL UPDATE**



**#admin/admin-regie.php**

**# Formular zum Hinzufügen neuer Regisseure**

**Speichert:**

* **vorname**
* **nachname**
* **geburtsdatum**
* **geschlecht**
* **nationalität**



**# admin/fr\_relation.php**

* **Weise Regisseur und Film zu**
* **Speichert in film\_regie:**
* **filmeID**
* **regieID**



**# admin/fs\_relation.php**

* **Weise Schauspieler und Film zu**
* **Speichert in film\_schauspieler:**
* **filmeID**
* **schauspielerID**
* **rollen\_name**
* **gage**
* **rollenID**





**# admin/admin-dashboard.php**



* **Übersicht über alle Filme, Schauspieler und Regisseure**
* **Bietet Bearbeiten und Löschen**
* **Löscht bei Filmen auch alle zugehörigen Verknüpfungen in:**

**film\_studio**

**film\_genre**

**film\_produktionsland**

**film\_medien**

**film\_schauspieler**

**film\_regie**



**# Datenbank-Beziehungen:**

**direkte Tabellen**



* **filme**
* **schauspieler**
* **regie**
* **genre**
* **studio**
* **produktionsland**
* **medien**
* **fsk**
* **rollen**





**# many-to-many Beziehungen:**



* **film\_genre: Filme ↔ Genres**
* **film\_studio: Filme ↔ Studios**
* **film\_produktionsland: Filme ↔ Produktionsländer**
* **film\_medien: Filme ↔ Medien**
* **film\_regie: Filme ↔ Regisseure**
* **film\_schauspieler: Filme ↔ Schauspieler**
* **weitere Verknüpfungen**
* **filme.fskID → fsk.id**
* **film\_schauspieler.rollenID → rollen.id**



* **weitere Verknüpfungen**
* **# filme.fskID -> fsk.id**
* **# film\_schauspieler.rollenID -> rollenID**



