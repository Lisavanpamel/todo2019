<?php

class Taak extends Database {
        // variabelen: taken
        private $titel;
        private $begindatum;
        private $einddatum;
        private $gebruikersId;
        private $lijstId;
        private $werkuren;
        private $status;
        private $taakId;
        
        
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

// status 
        public function getStatus()
        {
                return $this->status;
        }

        public function setStatus($status)
        {
                $this->status = $status;

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


        
/* ////////////////// functies ////////////////// */
        // kijk na of de deadline juist is ingegeven en niet in het verleden is
        public function controleerDeadline(){
                //controleer of datum in het juiste formaat is
                // nog doen

                //controleer of de datum niet in het verleden is
                $vandaag = $this->begindatum;
                $deadline = $this->einddatum;

                if ($deadline < $vandaag) {
                        throw new Exception("Deadline is in het verleden.");
                }
        }


        // voeg nieuwe taak toe ZONDER deadline
        public function nieuweTaakToevoegenZonderDeadline(){

                $titel = $this->getTitel();
                $werkuren = $this->getWerkuren();
                $begindatum = $this->getBegindatum();
                $status = $this->getStatus();
                $lijstId = $this->getLijstId();
                $gebruiker = $this->getGebruikersId();

                        $query = $this->connecteren()->prepare("INSERT INTO taak(titel, gebruikersId, lijstId, startDatum, taakStatus, werkuren) VALUES (:titel, :gebruikersId, :lijstId, :startDatum, :taakStatus, :werkuren)");
                        
                        $query->bindParam(':titel', $titel);
                        $query->bindParam(':gebruikersId', $gebruiker);
                        $query->bindParam(':lijstId', $lijstId);
                        $query->bindParam(':startDatum', $begindatum);
                        $query->bindParam(':taakStatus', $status);
                        $query->bindParam(':werkuren', $werkuren);
                        $query->execute();
        }


        // voeg nieuwe taak toe MET deadline
        public function nieuweTaakToevoegenMetDeadline(){

                $titel = $this->getTitel();
                $werkuren = $this->getWerkuren();
                $begindatum = $this->getBegindatum();
                $status = $this->getStatus();
                $lijstId = $this->getLijstId();
                $gebruiker = $this->getGebruikersId();
                $einddatum = $this->getEinddatum();

                        $query = $this->connecteren()->prepare("INSERT INTO taak(titel, gebruikersId, lijstId, startDatum, eindDatum, taakStatus, werkuren) VALUES (:titel, :gebruikersId, :lijstId, :startDatum, :eindDatum, :taakStatus, :werkuren)");
                        
                        $query->bindParam(':titel', $titel);
                        $query->bindParam(':gebruikersId', $gebruiker);
                        $query->bindParam(':lijstId', $lijstId);
                        $query->bindParam(':startDatum', $begindatum);
                        $query->bindParam(':eindDatum', $einddatum);
                        $query->bindParam(':taakStatus', $status);
                        $query->bindParam(':werkuren', $werkuren);
                        $query->execute();
        }


        public function toonTaken(){
                // ORDER BY ASC: taken waarvan de deadline dichtbij is staan eerst
                $query = $this->connecteren()->prepare("SELECT * FROM taak WHERE lijstId = :lijstId ORDER BY eindDatum ASC");
                $query->bindParam(':lijstId', $this->lijstId);
                $query->execute();

                // rowCount(): tel of er rijen zijn in de tabel met juist lijstId, of er dus taken zijn voor de lijst
                if($query->rowCount() == 0){
                        // geen taken
                        echo 
                        '<div class="error"><p>Deze lijst heeft nog geen taken.</p></div>';
                        //"Deze lijst heeft nog geen taken.";
                        
                } else {
                        while ($resultaat = $query->fetch(PDO::FETCH_ASSOC)){
                                // kijk de status van de taak na
                                if ($resultaat['taakStatus'] != "Gedaan") {
                                        // status = nog de doen
                                        $checkbox = '<label class="con">
                                        <input type="checkbox" data-value="' .$resultaat['id'] . '">
                                        <span class="checkmark"></span>
                                        </label>';
                                } else {
                                        // status = gedaan, checked toevoegen
                                        $checkbox = '<label class="con">
                                        <input checked type="checkbox" data-value="' .$resultaat['id'] . '">
                                        <span class="checkmark"></span>
                                        </label>';
                                }
                                echo
                                '<div class="takenPerLijst">
                                        <div class="media-input">'. $checkbox .'</div>

                                        <a href="taakDetail.php"><p class="taakN">'. $resultaat['titel'].'</p> 
                                        <p class="datum"><strong>Startdatum:</strong> '. $resultaat['startDatum'].'</p>
                                        <p class="datum"><strong>Deadline:</strong> ' . $resultaat['eindDatum'].'</p>
                                        <p class="datum"><strong>Werkuren:</strong> '. $resultaat['werkuren'].'</p></a>
                                        <img src="images/verwijderKruisje.png" class="verwijder" alt="lijst" height="14" width="14">
                                        <img src="images/bewerkingIcoon.png" class="bewerk" alt="lijst" height="14" width="14">
                                </div>';

                                /*echo "titel: " . $resultaat['titel'] . ", startdatum: " . $resultaat['startDatum'] . ", einddatum: "
                                . $resultaat['eindDatum'] . ", status: " . $resultaat['status'] . ", uren: " . $resultaat['werkuren'];*/
                        }
                }
        }
}

?>