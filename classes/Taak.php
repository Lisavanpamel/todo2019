<?php

// bestanden toevoegen
//include_once("classes/Database.php");

class Taak extends Database {
        // variabelen: taken
        private $titel;
        private $begindatum;
        private $einddatum;
        private $gebruikersId;
        private $lijstId;
        
        
// titel
        public function getTitel()
        {
                return $this->titel;
        }

        public function setTitel($titel)
        {
                $this->titel = $titel;

                return $this;
        }

// begindatum
        public function getBegindatum()
        {
                return $this->begindatum;
        }

        public function setBegindatum($begindatum)
        {
                $this->begindatum = $begindatum;

                return $this;
        }

// einddatum        
        public function getEinddatum()
        {
                return $this->einddatum;
        }

        public function setEinddatum($einddatum)
        {
                $this->einddatum = $einddatum;

                return $this;
        }
}

?>