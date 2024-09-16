// Funzione di validazione per il form
function validateForm() {
    // Trova tutte le checkbox
    const checkboxes = document.querySelectorAll('input[name="services[]"]');
    let atLeastOneChecked = false;

    // Verifica se almeno una checkbox è selezionata
    checkboxes.forEach(function(checkbox) {
        if (checkbox.checked) {
            atLeastOneChecked = true;
        }
    });

    // Mostra il messaggio di errore se nessuna checkbox è selezionata
    if (!atLeastOneChecked) {
        document.getElementById('service-error').style.display = 'block';
        return false; // Blocca l'invio del form
    }

    // Nasconde il messaggio di errore e consente l'invio
    document.getElementById('service-error').style.display = 'none';
    return true; // Consente l'invio del form
}