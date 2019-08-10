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
              //$lijstId = $this->getLijstId();

                      //$query = $this->connecteren()->prepare("INSERT INTO commentaar(reactie, taakId, gebruikersId, lijstId) VALUES (:reactie, :taakId, :gebruikersId, :lijstId);");
                      
                      $query = $this->connecteren()->prepare("INSERT INTO commentaar(reactie, taakId, gebruikersId) VALUES (:reactie, :taakId, :gebruikersId);");

                      $query->bindParam(':reactie', $reactie);
                      $query->bindParam(':taakId', $taakId);
                      $query->bindParam(':gebruikersId', $gebruikersId);
                      //$query->bindParam(':lijstId', $lijstId);
                      $query->execute();
        }


        public function reactieVanTaakWeergeven(){
                $query = $this->connecteren()->prepare("SELECT * FROM commentaar WHERE taakId = :id");
                
                $query->bindParam(':id', $this->taakId);
                $query->execute();

                if($query->rowCount() == 0){
                        // geen reacties
                        echo
                        '<div class="error"><p>Deze taak heeft nog geen reacties.</p></div>';
                } else {
                        // wel reacties
                        while ($resultaat = $query->fetch(PDO::FETCH_ASSOC)) {
                                // get de gebruikersID van het resultaat
                                $gebruiker = $resultaat['gebruikersId'];

                                // zoek via de gebruikersId de naam van de gebruiker
                                $q = $this->connecteren()->prepare("SELECT * FROM gebruiker WHERE id = :gebruikersId");
                                $q->bindParam(':gebruikersId', $gebruiker);
                                $q->execute();

                                while ($resultaatGebruiker = $q->fetch(PDO::FETCH_ASSOC)) {
                                        echo
                                        '<div class="media reactions">
                                                <div class= media-body">
                                                        <h5>'.$resultaatGebruiker['naam'].'</h5>
                                                        <p class="comment">' . $resultaat['reactie'] . '</p>
                                                </div>
                                        </div>';
                                }
                        }
                }
        }

}


?>