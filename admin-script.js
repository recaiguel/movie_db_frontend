// den button und den Container in HTML finden
const addButton = document.getElementById('add-schauspieler');
const container = document.getElementById('schauspieler-container');

// Auf den Klick des Buttons lauschen
addButton.addEventListener('click', function() {

    // Die erste bestehende Schauspieler-Zeile finden
    const originalRow = container.querySelector('.schauspieler-row');

    // Diese Zeile inklusive aller Inhalte (Dropdown, Input) kopieren
    const newRow = originalRow.cloneNode(true);

    // Das Textfeld in der neuen Zeile finden und den Text leeren
    const inputField = newRow.querySelector('input[type="text"]');
    if (inputField) {
        inputField.value = '';
    }

    // Das Dropdown der neuen Zeile in den Container einfügen
    const selectField = newRow.querySelector('select');
    if (selectField) {
        selectField.selectIndex = 0;
    }

    // Die kopierte und gelehrte Zeiöe in den Container einfügen
    container.appendChild(newRow);

})