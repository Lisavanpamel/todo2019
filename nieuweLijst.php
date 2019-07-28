<?php
// bestanden toevoegen 
include_once("classes/Database.php");
include_once("classes/Lijst.php");
include_once("classes/Gebruiker.php");


// Sessie starten
session_start();

    if (isset($_POST['knopLijst'])){
	    // controleer of empty niet leeg is
	    if (empty($_POST['lijstNaam'])){
            // anders foutmelding
		    $foutmelding = "Gelieve een Lijstnaam in te voeren."; 
	    } else {
		$titel = $_POST['lijstNaam'];
	
		// nieuwe lijst toevoegen
        $lijst = new Lijst();
        $lijst->setTitel($titel);

        // nieuwe gebruiker toevoegen
		$gebruiker = new Gebruiker();
		
        // Do To
		}
	}


// header toevoegen
include_once ("header.php");
?>

<section id="container"> 
    <!-- (nieuwe) lijst toevoegen -->
    <div class="knopLijst">
        <div class="formuliergroep">
            <input class="formulier" type="text" name="lijstNaam" placeholder="Email">
        </div>

        <img src="images/nieuw.png" alt="foto" height="14" width="14">
        <input class="nieuweLijst" name="knopLijst" type="submit" value="Nieuwe lijst">
    </div>
</section>
    
<?php
// footer
include_once("footer.php");
?>
</html>