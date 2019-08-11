<?php
// bestanden toevoegen 
include_once("classes/Database.php");
include_once("classes/Gebruiker.php");
include_once("classes/Taak.php");
include_once("classes/Lijst.php");

// sessie starten
session_start();

// taakId opvragen
$taakId = $_GET['post'];

// bron voor code bestand uploaden: https://www.w3schools.com/php/php_file_upload.asp

if (isset($_POST['KnopBestand'])){
    // kijk na of het bestand niet leeg is
    if (!empty($_FILES['bestand'])){
        $bestand = $_FILES['bestand'];

        // vraag de naam op van het bestand
        $bestandsNaam = $_FILES['bestand']['name'];

        // bepaal bestandslocatie: bestanden/naam
        $bestandslocatie = 'bestanden/' . $bestandsNaam;

        // nieuwe taak
        $taak = new Taak();
        $taak->setTaakId($taakId);
        $taak->setBestand($bestandslocatie);

        // update database
        try {
            // alleen pdf is toegestaan
            $taak->controleerPdfFormaat();

            // bestand moet kleiner zijn dan 500kb
            $taak->controleerPdfGrootte($_FILES["bestand"]["size"]);

            // verplaats het bestand van temporary storage (tmp) naar map bestanden
            move_uploaded_file($_FILES['bestand']['tmp_name'], $bestandslocatie);

            $taak->bestandToevoegen();
            //header("Location: index.php");
        } catch (Exception $e) {
            $foutmelding = $e->getMessage();
        }


    }
}

// header toevoegen
include_once ("header.php");
?>

<section id="afmeting">  
    <div class="h1T">
        <h1>Bestand toevoegen</h1>
    </div>            

    <!-- Bestand toevoegen -->
    <form method="post" enctype="multipart/form-data">
        <!-- foutmelding -->
        <?php if(isset($foutmelding) ): ?>
            <div class="error"><p>
        <?php echo $foutmelding ?></p></div>
        <?php endif; ?>

        <!-- bestand: input type = "file" -->
        <div class="formuliergroep">
            <input class="formulier" type="file" name="bestand">
        </div>

        <div class="formuliergroep">
            <input class="NieuweTaak" type="submit" value="Bestand toevoegen" name="KnopBestand">
        </div>
    
    </form>
</section>

<?php 
// footer
include_once("footer.php"); 
?>