<?php
class Database {
    private static $connectie;

     public static function connecteren() {
        // SET ROOT OF THE FILES
        if(!defined('__ROOT__')){
            define('__ROOT__', dirname(dirname(__FILE__)));
        }

        // Instellingen.php toevoegen
        require_once(__ROOT__.'/instellingen.php');

        // Als connectie nog niet bestaat, maken we een nieuwe connectie
        if( self::$connectie == null ){
            self::$connectie = new PDO(
                "mysql:host=".$instellingen['host']."; 
                dbname=".$instellingen['databaseNaam'].";", 
                $instellingen['gebruikersnaam'], 
                $instellingen['paswoord']
            );
//            echo "connectie ok"; 
            return self::$connectie;
        // Anders geven we huidige connectie terug
        } else {
            return self::$connectie;
        }
    }
}
?>