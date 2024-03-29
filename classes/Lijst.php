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

                        $query = $this->connecteren()->prepare("INSERT INTO lijst(titel, gebruiker)VALUES(:titel, :gebruiker)");
                        $query->bindParam(':titel', $titel);
                        $query->bindParam(':gebruiker', $gebruikersId);
                        $query->execute();
        }


        public function toevoegenAanTabelLijstGebruiker(){
                $lijstId = $this->getLijstId();
                $gebruikersId = $this->getGebruikersId();

                // tabel lijstgebruiker (database)
                $query = $this->connecteren()->prepare("INSERT INTO lijstgebruiker (lijstId, gebruikersId) VALUES(:lijstId, :gebruikersId)");
                $query->bindParam(':lijstId', $lijstId);
                $query->bindParam(':gebruikersId', $gebruikersId);
                $query->execute();
                // echo "OK";
        }

        public function getLijstIdVanDatabase(){
                $titel = $this->getTitel();

                        $query = $this->connecteren()->prepare("SELECT * FROM lijst WHERE titel = :titel");
                        $query->bindParam(':titel', $titel);
                        $query->execute();
                        
                        $resultaat = $query->fetch(PDO::FETCH_ASSOC);
                        return $resultaat['id'];
        }

        
        // hebben we nodig in index.php
        public function toonLijsten(){
                $query = $this->connecteren()->prepare("SELECT * FROM lijst WHERE gebruiker = :gebruiker");
                $query->bindParam(':gebruiker', $this->gebruikersId);
                $query->execute();

                // toon bericht als er nog geen lijsten bestaan
                if($query->rowCount() == 0){
                        echo 
                        '<div class="error"><p>Je hebt nog geen lijsten aangemaakt.</p></div>';
                } else {
                        // toon alle lijsten op index.php
                        while ($resultaat = $query->fetch(PDO::FETCH_ASSOC)) {
                                echo
                                '<div class="lijsten">
                                <img src="images/lijsten.png" alt="lijst" height="36" width="36">
                                <a href="taken.php?lijst=' . $resultaat['id'] . '" data-id="'. $resultaat['id'] . '">
                                <p class="lijst">'. $resultaat['titel'].'</p></a>
                                <!--<img src="images/profiel.png" alt="lijst" height="33" width="33">-->
                                
                                <a href="lijstVerwijderen.php?post=' . $resultaat['id'] . '"><img src="images/verwijder.png" class="verwijder" alt="lijst" height="33" width="33"></a>
                                </div>';

                                /*'<div class="lijsten"><a href="taken.php">
                                <img src="images/profiel.png" alt="lijst" height="33" width="33">
                                <p class="lijst">'. $resultaat['titel'].'</p></a>
                                <img src="images/verwijder.png" class="verwijder" alt="lijst" height="33" width="33">
                                </div>';*/
                        }
                }
        }

        public function lijstVerwijderen(){
                $query = $this->connecteren()->prepare("DELETE FROM lijst WHERE id = :id");
                $query->bindParam(':id', $this->lijstId);
                $query->execute();
        }

}