<?php

class Taak extends Database {
        // variabelen: taken
        private $titel;
        private $begindatum;
        private $einddatum;
        private $gebruikersId;
        private $lijstId;
        private $werkuren;
        
        
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

// werkuren
        public function getWerkuren()
        {
                return $this->werkuren;
        }

        public function setWerkuren($werkuren)
        {
                $this->werkuren = $werkuren;

                return $this;
        }


/* ////////////////// functies ////////////////// */
        public function toonTaken(){
                // ORDER BY ASC: taken waarvan de deadline dichtbij is staan eerst
                $query = $this->connecteren()->prepare("SELECT * FROM taak WHERE lijstId = :lijstId ORDER BY eindDatum ASC");
                $query->bindParam(':lijstId', $this->lijstId);
                $query->execute();

                // rowCount(): tel of er rijen zijn in de tabel met juist lijstId, of er dus taken zijn voor de lijst
                if($query->rowCount() == 0){
                        // geen taken
                        echo "Deze lijst heeft nog geen taken.";
                } else {
                        while ($resultaat = $query->fetch(PDO::FETCH_ASSOC)){
                                echo "titel: " . $resultaat['titel'] . ", startdatum: " . $resultaat['startDatum'] . ", einddatum: "
                                . $resultaat['eindDatum'] . ", status: " . $resultaat['status'] . ", uren: " . $resultaat['werkuren'];
                        }
                        //echo "er zijn taken";
                }
        }


        // hebben we nodig voor nieuweTaak.php
        public function toevoegenAanDatabase(){
                $titel = $this->getTitel();
                $gebruikersId = $this->getGebruikersId();

                        $query = $this->connecteren()->prepare("INSERT INTO taak(titel, startDatum, eindDatum, werkuren)VALUES(:titel, :startDatum, :eindDatum, :werkuren)");
                        $query->bindParam(':titel', $titel);
                        $query->bindParam(':startDatum', $begindatum);
                        $query->bindParam(':eindDatum', $einddatum);
                        $query->bindParam(':werkuren', $werkuren);
                        $query->execute();
        }

        public function getLijstIdVanDatabase(){
                $titel = $this->getTitel();

                        $query = $this->connecteren()->prepare("SELECT * FROM taak WHERE titel = :titel");
                        $query->bindParam(':titel', $titel);
                        $query->execute();
                        
                        $resultaat = $query->fetch(PDO::FETCH_ASSOC);
                        return $resultaat['id'];
        }

        
}

?>