<?php

// bestanden toevoegen
include_once("classes/Database.php");

class Lijst extends Database {
        // variabelen
        private $lijstId;
        private $titel;
        private $taken;
        private $mensen;
        private $beheerderId;
    



// lijst
        public function getLijstId()
        {
                return $this->lijstId;
        }

        public function setLijstId($lijstId)
        {
                $this->lijstId = $lijstId;

                return $this;
        }

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


/* ////////////////// functies ////////////////// */
        
        
}


?>