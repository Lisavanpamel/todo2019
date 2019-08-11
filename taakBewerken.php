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

// gebruikersId opvragen
$gebruikersId = $_SESSION['gebruiker'];

    if (isset($_POST['KnopTaak'])){
        echo "ok";
        $titel = $_POST['taakNaam'];
        $werkuren = $_POST['werkuren'];
        $einddatum = $_POST['einddatum'];

        // taak bewerken
        $taak = new Taak();
        $taak->setTitel($titel);
        $taak->setWerkuren($werkuren);
        $taak->setEinddatum($einddatum);
        $taak->setTaakId($taakId);
        $taak->setGebruikersId($gebruikersId);

        try {
            $taak->taakBewerken();
            header("Location: index.php");
        } catch (Exception $e) {
            $error = $e->getMessage();
        }
    }

// header toevoegen
include_once ("header.php");
?>
<section id="afmeting">
    <div class="h1T">
        <h1>Taak bewerken</h1>
    </div>
    <!-- taak bewerken -->
    <form method="post">
        <!-- foutmelding -->
        <?php if(isset($foutmelding) ): ?>
            <div class="error"><p>
            <?php echo $foutmelding ?></p></div>
        <?php endif; ?>

        <!-- taak met huidige waarden laten zien -->
        <?php
            $taak = new Taak();
            $taak->setTaakId($taakId);
            $taak->toonEnBewerkTaak();
        ?>
    </form>
</section>

<?php
// footer
include_once("footer.php");
?>

    