<?php
// bestanden toevoegen 
include_once("classes/Database.php");
include_once("classes/Gebruiker.php");
include_once("classes/Lijst.php");
include_once("classes/Taak.php");


// Sessie starten
/*session_start();

    if (isset($_POST['KnopLijst'])){
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
		
        // gebruikersId opvragen uit session
        $gebruikersId = $_SESSION['gebruiker'];
        $lijst->setGebruikersId($gebruikersId);
        
        try {
            $lijst->toevoegenAanDatabase();
            $lijstId = $lijst->getLijstIdVanDatabase();
            $lijst->setLijstId($lijstId);
            $lijst->toevoegenAanTabelLijstGebruiker();
            //header("Location: index.php");
        } catch (Exception $e) {
            $foutmelding = $e->getMessage();
        }
		}
    }*/


// header toevoegen
include_once ("header.php");
?>

<section id="afmeting">
    <div class="h1">
        <h1>To-Do</h1>
    </div>

    <div class="h2">
            <h2>Te doen</h2>
    </div>
       

    <!-- taken uit database halen -->
    <?php
        $taak = new Taak();
        $taak->setGebruikersId($_SESSION['gebruiker']);
        $taak->toonTaken();
    ?>

        <!-- Taak veld -->
        <div class="lijsten"><a href="alleTakenPerLijst.php">
            <img src="images/profiel.png" alt="Taak" height="33" width="33">
            <p class="lijst">'. $resultaat['titel'].'</p></a>
        </div>


        <div class="h2">
            <h2>Gedaan</h2>
        </div>


        <!-- BUTTON: nieuwe lijst toevoegen -->
        <div class="knopLijst">
        <img src="images/nieuw.png" alt="foto" height="14" width="14">
            <a href="nieuweTaak.php">Nieuwe Taak</a>
        </div>

        <!-- terugknop -->
        <div class="terugKnop">
            <a href="index.php" class="knopTer">Terug</a>
        </div> 
</section>
    
<?php
// footer
include_once("footer.php");
?>