// Das Popup-Element anhand seiner ID aus dem HTML suchen
const popup = document.getElementById('success-popup');


// Die URL im Browser sauber wischen (entfernt das ?saved=true)
setTimeout(function() {
    window.history.replaceState({}, document.title, window.location.pathname);    
}, 50);


// prüfen ob das ELement überhaupt auf der aktuellen Seite existitert
if   (popup) {
    // einen Timer starten, der nach 4000 milisekunden eine Funktion ausführt 
    setTimeout(function() {

        // Das Popup wird unsichtbar geschaltet
        popup.style.display = 'none'; 

    }, 4000);
}