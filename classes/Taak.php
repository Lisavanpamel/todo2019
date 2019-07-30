<?php

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
}

?>