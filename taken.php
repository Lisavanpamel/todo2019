<?php
// bestanden toevoegen 
include_once("classes/Database.php");
include_once("classes/Gebruiker.php");
include_once("classes/Lijst.php");
include_once("classes/Taak.php");

// connectie met db testen
$db = new Database(); 
$db->connecteren();

// taken alleen laten tonen wanneer gebruiker aangemeld is
// werken met sessions
// sessie starten met session_start()
session_start();

// we controleren of deze sessie de juiste sessie is
// bij het inloggen noemen we onze session $_SESSION['gebruiker] en geven we de gebruiker id mee;
if (isset($_SESSION['gebruiker'])){
    // nieuwe instantie maken van de klasse Gebruiker
    // aan deze instantie gaan we de gebruikers id toevoegen
    $gebruiker = new Gebruiker();
    $gebruiker->setGebruikersId($_SESSION['gebruiker']);

} else {
    // er is nog geen sessie opgestart, de gebruiker moet zich nog inloggen en mag deze pagina niet zien
    // we veranderen van locatie en gaan naar de pagina inloggen.php
    header('Location: inloggen.php');
}

// header toevoegen
include_once ("header.php");
?>

<section id="afmeting">
    <div class="h1">
        <h1>Mijn taken</h1>
    </div>


    <!--<div class="h2">
            <h2>Te doen</h2>
    </div>-->
       

    <!-- taken uit database halen -->
    <?php
        $taak = new Taak();

        //get lijst id
        $lijstId = $_GET['lijst'];

        $taak->setLijstId($lijstId);
        $taak->setGebruikersId($_SESSION['gebruiker']);
        $taak->toonTaken();
    ?>
        
        <!--<div class="h2">
            <h2>Gedaan</h2>
        </div>-->

        <!-- moet nog naar klasse verplaatsen -->
        <!--<div class="takenPerLijstT">
            <div class="checkbox2">
                <img src="images/vinkje.png" alt="foto" height="25" width="25">
            </div>            
            <p class="taakNt">Herexamen PHP 1</p>
            <p class="datumt">Deadline: 22/08/2019</p>
            <img src="images/verwijderKruisje.png" class="verwijder" alt="lijst" height="14" width="14"></div>
        </div>-->


        <!-- BUTTON: nieuwe lijst toevoegen -->
        <div class="knopLijst">
        <img src="images/nieuw.png" alt="foto" height="14" width="14">
            <!-- aan de url de juiste lijst id meegeven -->
            <a href="nieuweTaak.php?lijst=<?php echo $lijstId ?>" data-id=<?php echo $lijstId ?>> Nieuw taak</a>
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