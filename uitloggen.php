<?php
    session_start();
    // Om de sessie helemaal te beëindigen
    session_destroy();
    header("Location: inloggen.php");
?>