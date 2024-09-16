export default function validateForm() {
    // Trova tutte le checkbox
    const submitCheckbox = document.querySelector('.submit-checkbox');
    
    submitCheckbox.addEventListener('click', function(event){
        let atLeastOneChecked = false;
        const checkboxes = document.querySelectorAll('input[name="services[]"]');
        
        // Verifica se almeno una checkbox è selezionata
        checkboxes.forEach(function(checkbox) {
            if (checkbox.checked) {
                atLeastOneChecked = true;
            }
        });
        
        // Mostra il messaggio di errore solo se nessuna checkbox è selezionata
        if (!atLeastOneChecked) {
            document.getElementById('service-error').style.display = 'block';
            return false; // Blocca l'invio del form solo se necessario
        }
        
        // Nascondi il messaggio di errore se tutto è corretto
        document.getElementById('service-error').style.display = 'none';
        
        // Restituisci true per consentire l'invio del form
        // event.preventDefault();
        return true;
    

});
}
