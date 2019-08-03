<?php
// bestanden toevoegen 
include_once("classes/Database.php");
include_once("classes/Gebruiker.php");
include_once("classes/Taak.php");

//include_once("classes/Lijst.php");


// Sessie starten
session_start();

    if (isset($_POST['KnopTaak'])){
        if (empty($_POST['taakNaam'])){
            // anders foutmelding
		    $foutmelding = "Gelieve een taaknaam in te voeren."; 
	    } else {
        $titel = $_POST['taakNaam'];
        //$begindatum = $_POST['begindatum'];
        //$einddatum = $_POST['einddatum'];
        $werkuren = $_POST['werkuren'];

        // nieuwe taak toevoegen
        $taak = new Taak();
        $taak->setTitel($titel);
        //$taak->setBegindatum($begindatum);
        //$taak->setEinddatum($einddatum);
        $taak->setWerkuren($werkuren);

        // startdatum toeveogen: vandaag
        // tijdzone
        date_default_timezone_set('Europe/Brussels');

        // vandaag berekenen
        $vandaag = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
        $vandaag = date("Y-m-d");
        $taak->setBegindatum($vandaag);

        // get lijst id
        $lijstId = $_GET['lijst'];

        // lijst id toevoegen
        $taak->setLijstId($lijstId);

        // status op "te doen" zetten
        $taak->setStatus('Te doen');

        // nieuwe gebruiker toevoegen
        $gebruiker = new Gebruiker();

        // gebruikersId opvragen uit session
        $gebruikersId = $_SESSION['gebruiker'];
        $taak->setGebruikersId($gebruikersId);

        // deadline is optioneel, kijken of deadline is ingegeven
        if (empty($_POST['deadline'])){
            // geen deadline, taak toevoegen aan database zonder deadline
            try {
                $taak->nieuweTaakToevoegenZonderDeadline();
            } catch (Exception $e) {
                $foutmelding = $e->getMessage();
            }
        } else {
            // deadline is ingegeven
            $deadline = $_POST['deadline'];
            // taak toevoegen aan database met deadline
            try {
                // kijk na of de dealine niet in het verleden is
                $taak->setEinddatum($deadline);
                $taak->controleerDeadline();
                // voeg taak toe met deadline
                $taak->nieuweTaakToevoegenMetDeadline();
            } catch (Exception $e) {
                $foutmelding = $e->getMessage();
            }
          }
        }
    }

        
// header toevoegen
include_once ("header.php");
?>

<section id="afmeting">  
    <div class="h1T">
        <h1>Taak aanmaken</h1>
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
            <input class="formulier" type="text" name="taakNaam" placeholder="Taak naam">
        </div>

        <!-- begindatum -->
        <div class="formuliergroep">
            <input class="formulier" type="text" name="begindatum" placeholder="Begindatum (JJJJ-mm-dd)">
        </div>

        <!-- einddatum -->
        <div class="formuliergroep">
            <input class="formulier" type="text" name="einddatum" placeholder="Einddatum (JJJJ-mm-dd)">
        </div>

        <!-- werkuren -->
        <div class="formuliergroep">
            <input class="formulier" type="text" name="werkuren" placeholder="Werkuren">
        </div>


        <!-- BUTTON: nieuwe taak toevoegen -->
        <div class="formuliergroep">
            <!-- plusje img -->
            <!--<img src="images/nieuw.png" alt="foto" height="14" width="14">-->
            <input class="nieuweTaak" type="submit" value="bevestigen" name="KnopTaak">
        </div>

        <!-- terugknop 
        <div class="terugKnop">
            <a href="taken.php" class="knopTer">Terug</a>
        </div> -->   
    </form>
</section>

<?php 
// footer
include_once("footer.php"); 
?>