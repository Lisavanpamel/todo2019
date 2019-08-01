<?php
// header toevoegen
include_once ("header.php");
?>

<section id="afmeting">  
    <div class="h1T">
        <h1>Reacties</h1>
    </div>            


    <form method="post">
        <!-- foutmelding -->
        <?php if(isset($foutmelding) ): ?>
            <div class="error"><p>
        <?php echo $foutmelding ?></p></div>
        <?php endif; ?>

        <textarea class="reactie" maxlength="150" name="reactie" placeholder="Voeg een reactie toe!"></textarea>

        <!-- BUTTON: commentaar toevoegen -->
        <div class="formuliergroep">
            <input class="nieuweTaak" type="submit" value="Voeg commentaar toe" name="knopCommentaar">
        </div>

        <!-- terugknop -->
        <div class="terugKnop">
            <a href="taken.php?lijst=1" class="knopTer">Terug</a>
        </div>    
    </form>
</section>

<?php 
// footer
include_once("footer.php"); 
?>