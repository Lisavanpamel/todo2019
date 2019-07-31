<?php
// bestanden toevoegen 
include_once("classes/Database.php");
include_once("classes/Gebruiker.php");
include_once("classes/Taak.php");


// Sessie starten
session_start();

    if (isset($_POST['KnopTaak'])){
	    // controleer of empty niet leeg is
	    if (empty($_POST['TaakNaam'])){
            // anders foutmelding
		    $foutmelding = "Gelieve een taaknaam in te voeren."; 
        } else if (empty($_POST['werkuren'])){
		    $foutmelding = "Gelieve x-aantal werkuren in te voeren."; 
        } else if (empty($_POST['deadline'])){
		    $foutmelding = "Gelieve einddatum in te voeren."; 
        } else {
            // waarden toevoegen aan variabelen
            $taakNaam = $_POST['TaakNaam'];
            $werkuren = $_POST['werkuren'];
            $deadline = $_POST['deadline'];

            // nieuwe taak toevoegen
            $taak = new Taak();
            $taak->setTitel($titel);

            // nieuwe gebruiker toevoegen
            $gebruiker = new Gebruiker();
            
            // gebruikersId opvragen uit session
            $gebruikersId = $_SESSION['gebruiker'];
            $taak->setGebruikersId($gebruikersId);


            try {
                //$taak->toevoegenAanDatabase();
                //$taakId = $taak->getLijstIdVanDatabase();
                //$taak->setLijstId($taakId);
                //$taak->toevoegenAanTabelLijstGebruiker();
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
        <h1>Nieuwe taak</h1>
    </div>            

    <!-- (nieuwe) taak toevoegen -->
    <form method="post">
        <!-- foutmelding -->
        <?php if(isset($foutmelding) ): ?>
            <div class="error"><p>
        <?php echo $foutmelding ?></p></div>
        <?php endif; ?>

        <!-- naam taak veld -->
        <div class="formuliergroep">
            <input class="formulier" type="text" name="TaakNaam" placeholder="Naam taak">
        </div>

        <!-- werkuren -->
        <div class="formuliergroep">
            <input class="formulier" type="text" name="werkuren" placeholder="Werkuren">
        </div>

        <!-- deadline -->
        <div class="formuliergroep">
            <input class="formulier" type="text" name="deadline" placeholder="Deadline (JJJJ-mm-dd)">
        </div>

        <!-- BUTTON: nieuwe taak toevoegen -->
        <div class="formuliergroep">
            <!-- plusje img -->
            <!--<img src="images/nieuw.png" alt="foto" height="14" width="14">-->
            <input class="nieuweTaak" type="submit" value="bevestigen" name="KnopTaak">
        </div>

        <!-- terugknop -->
        <div class="terugKnop">
            <a href="taken.php" class="knopTer">Terug</a>
        </div>    
    </form>

             
        
    <?php
        // taken uit database halen
        // taken laten tonen op nieuweTaak.php
        /*$taak = new Taak();
        $lijst->setGebruikersId($_SESSION['gebruiker']);
        $lijst->toonTaken();*/
    ?>
</section>

<?php 
// footer
include_once("footer.php"); 
?>