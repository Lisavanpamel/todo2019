<?php
// bestanden toevoegen
//include_once("classes/Database.php");

class Lijst extends Database {
        // variabelen
        private $titel;
        private $lijstId;
        private $gebruikersId;


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

// lijstId 
        public function getLijstId()
        {
                return $this->lijstId;
        }

        public function setLijstId($lijstId)
        {
                $this->lijstId = $lijstId;

                return $this;
        }

// gebruikersId
        public function getGebruikersId()
        {
                return $this->gebruikersId;
        }

        public function setGebruikersId($gebruikersId)
        {
                $this->gebruikersId = $gebruikersId;

                return $this;
        }


/* ////////////////// functies ////////////////// */
        public function toevoegenAanDatabase(){
                $titel = $this->getTitel();
                $gebruikersId = $this->getGebruikersId();

                        
        }
}


?>