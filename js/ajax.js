// AJAX: taak aangevinkt of geen vink
// wanneer er op checkbox (class .check) geklikt wordt, voeren we volgende functie uit
$('.check').on('click', function (e) {
    // als checkbox de attribuut checked heeft
    if ($((this)).is(':checked')){
        console.log('check');
        // de checkbox is aangevinkt (checked)
        // de waarde opvragen van de checkbox
        let taakId = $(this).attr('data-value');

        // de waarde meegeven met ajax
        $.ajax({
            method: "POST",
            url: "ajax/taakAanvinken.php",
            data: { taakId: taakId }
        })
            // als ajax klaar is
            .done(function (resultaat) {
                console.log('res ' + resultaat);
                if (resultaat.status == "success") {
                    // resultaat van ajax is success, dus het is gelukt
                    // verander taak van plaats
                    console.log('gelukt');


                    // zet de checkbox op checked
                    $(this).prop('checked', true);
                }
            })
            // als er een fout is
            .fail(function (err) {
                console.log(err.status);
            });

    } else {
        // checkbox is niet aangevinkt
        console.log("unchecked");

        // de waarde opvragen van de checkbox
        let taakId = $(this).attr('data-value');

        // de waarde meegeven met ajax
        $.ajax({
            method: "POST",
            url: "ajax/taakWegvinken.php",
            data: { taakId: taakId }
        })
        // als ajax klaar is
        .done(function (resultaat) {
            console.log('res ' + resultaat.status);
            if (resultaat.status == "success") {
                // resultaat van ajax is success, dus het is gelukt
                // verander taak van plaats
                console.log('verander van plaats');

                // zet de checkbox op checked
                $(this).prop('checked', true);
            }
        })
        // als er een fout is, toon de error
        .fail(function (err) {
            console.log(err.status);
        });
    }
    
});