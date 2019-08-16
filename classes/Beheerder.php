<?php
// bestanden toevoegen
include_once("classes/Database.php");

    class Beheerder extends Database {
        // variabelen
        private $gebruikersnaam;
        private $beheerderId;


// gebruikersnaam
        public function getGebruikersnaam()
        {
                return $this->gebruikersnaam;
        }

        public function setGebruikersnaam($gebruikersnaam)
        {
                $this->gebruikersnaam = $gebruikersnaam;

                return $this;
        }

// beheerderId
        public function getBeheerderId()
        {
                return $this->beheerderId;
        }

        public function setBeheerderId($beheerderId)
        {
                $this->beheerderId = $beheerderId;

                return $this;
        }

/* ////////////////// functies ////////////////// */

    }

?>