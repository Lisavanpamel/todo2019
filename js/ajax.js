// AJAX: taak aangevinkt of geen vink
// wanneer er op checkbox (class .check) geklikt wordt, voeren we volgende functie uit
$('.check').on('click', function (e) {
    // als checkbox de attribuut checked heeft
    if ($((this)).is(':checked')){
        console.log('check');
        // de checkbox is aangevinkt (checked)
        // de waarde opvragen van de checkbox
        let taakId = $(this).attr('data-value');
    }
    
});