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
        // Voeg commentaar toe
        public function voegNieuwCommentaarToe(){

              $reactie = $this->getReactie();
              $taakId = $this->getTaakId();
              $gebruikersId = $this->getGebruikersId();
              $lijstId = $this->getLijstId();

                      $query = $this->connecteren()->prepare("INSERT INTO commentaar(reactie, taakId, gebruikersId, lijstId) VALUES (:reactie, :taakId, :gebruikersId, :lijstId);");
                      
                      $query->bindParam(':reactie', $reactie);
                      $query->bindParam(':taakId', $taakId);
                      $query->bindParam(':gebruikersId', $gebruikersId);
                      $query->bindParam(':lijstId', $lijstId);
                      $query->execute();
        }

}


?>