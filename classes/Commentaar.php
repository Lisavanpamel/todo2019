<?php

class Commentaar extends Database {
        // variabelen
        private $reactie;
        private $taakId;
        private $gebruikersId;
        private $lijstId;


// reactie
        public function getReactie()
        {
                return $this->reactie;
        }

        public function setReactie($reactie)
        {
                $this->reactie = $reactie;

                return $this;
        }

// taakId
        public function getTaakId()
        {
                return $this->taakId;
        }

        public function setTaakId($taakId)
        {
                $this->taakId = $taakId;

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

/* ////////////////// functies ////////////////// */

}


?>