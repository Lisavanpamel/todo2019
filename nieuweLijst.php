<?php
// bestanden toevoegen 
include_once("classes/Database.php");
include_once("classes/Lijst.php");
include_once("classes/Gebruiker.php");


// Sessie starten
session_start();

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
	}


// header toevoegen
include_once ("header.php");
?>

<section id="afmeting">
    <!-- (nieuwe) lijst toevoegen -->
    <form method="post">
        <!-- foutmelding -->
        <?php if(isset($foutmelding) ): ?>
            <div class="error"><p>
            <?php echo $foutmelding ?></p></div>
        <?php endif; ?>

        <!-- naam veld -->
        <div class="formuliergroep">
            <input class="formulier" type="text" name="lijstNaam" placeholder="Naam">
        </div>

        <!-- knop bevestigen -->
        <div class="formuliergroep">
            <input class="nieuweLijst" type="submit" value="Nieuwe Lijst" name="KnopLijst">
        </div>

        <!-- terugknop -->
        <div class="terugKnop">
            <a href="index.php" class="knopTer">Terug</a>
        </div> 
    </form>
</section>
    
<?php
// footer
include_once("footer.php");
?>