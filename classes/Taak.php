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
        private $bestand;
        
        
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

// bestand
        public function getBestand()
        {
                return $this->bestand;
        }

        public function setBestand($bestand)
        {
                $this->bestand = $bestand;

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
                                        $checkbox = '<input type="checkbox" class="check" data-value="' .$resultaat['id'] . '">';
                                } else {
                                        // status = gedaan, checked toevoegen
                                        $checkbox = '<input checked type="checkbox" class="check" data-value="' .$resultaat['id'] . '">';
                                }
// deadline tonen               // kijk of de taak een deadline heeft
                                if ($resultaat['eindDatum'] == "000-00-00"){
                                        // geen deadline
                                        $toonDeadline = 'Geen deadline';
                                } else {
                                        // wel deadline
                                        $toonDeadline = $resultaat['eindDatum'];
                                }
                                echo
                                '<div class="takenPerLijst">
                                        <div class="media-input"><label class="con check">'. $checkbox .'<span class="checkmark"></span></label></div>
                                        <a href="taken.php?lijst=' . $resultaat['id'] . '" data-id="'. $resultaat['id'] . '">
                                        <a href="taakDetail.php?taak=' . $resultaat['id'] . '" data-id="'. $resultaat['id'] . '">
                                        <p class="taakN">'. $resultaat['titel'].'</p>
                                        <p class="datum"><strong>Startdatum:</strong> '. $resultaat['startDatum'].'</p>
                                        <p class="datum"><strong>Deadline:</strong> ' . $toonDeadline.'</p>
                                        <p class="datum"><strong>Werkuren:</strong> '. $resultaat['werkuren'].'</p></a>
                                        <a href="taakVerwijderen.php?post=' . $resultaat['id'] . '"><img src="images/verwijderKruisje.png" class="verwijder" alt="lijst" height="14" width="14"></a>
                                        <a href="taakBewerken.php?post=' . $resultaat['id'] . '"><img src="images/bewerkingIcoon.png" class="bewerk" alt="lijst" height="14" width="14"></a>
                                        
                                        <div class="paperclip">
                                                <a href="bestandToevoegen.php?post=' . $resultaat['id'] .'"><img src="images/paperclip.png" class="bestand" alt="lijst" height="14" width="14"> bestand</a>
                                        </div>
                                </div>';


                                        /*<a href="taakDetail.php"><p class="taakN">'. $resultaat['titel'].'</p> 
                                        <p class="datum"><strong>Startdatum:</strong> '. $resultaat['startDatum'].'</p>
                                        <p class="datum"><strong>Deadline:</strong> ' . $toonDeadline.'</p>
                                        <p class="datum"><strong>Werkuren:</strong> '. $resultaat['werkuren'].'</p></a>
                                        <img src="images/verwijderKruisje.png" class="verwijder" alt="lijst" height="14" width="14">
                                        <img src="images/bewerkingIcoon.png" class="bewerk" alt="lijst" height="14" width="14">

                                /*echo "titel: " . $resultaat['titel'] . ", startdatum: " . $resultaat['startDatum'] . ", einddatum: "
                                . $resultaat['eindDatum'] . ", status: " . $resultaat['status'] . ", uren: " . $resultaat['werkuren'];*/
                        }
                }
        }

        public function taakIsGedaan(){
                $status = "Gedaan";

                $query = $this->connecteren()->prepare("UPDATE taak SET taakStatus = :taakStatus WHERE id = :id AND gebruikersId = :gebruikersId");
                $query->bindParam(':id', $this->taakId);
                $query->bindParam(':taakStatus', $status);
                $query->bindParam(':gebruikersId', $this->gebruikersId);
                $query->execute();
        }
        
        public function taakTeDoen(){
                $status = "Te doen";

                $query = $this->connecteren()->prepare("UPDATE taak SET taakStatus = :taakStatus WHERE id = :id AND gebruikersId = :gebruikersId");
                $query->bindParam(':id', $this->taakId);
                $query->bindParam(':taakStatus', $status);
                $query->bindParam(':gebruikersId', $this->gebruikersId);
                $query->execute();
        }

        // taak verwijderen
        public function taakVerwijderen(){
                $query = $this->connecteren()->prepare("DELETE FROM taak WHERE id = :id");
                $query->bindParam(':id', $this->taakId);
                $query->execute();
        }

        public function takenVerwijderenBijLijstId(){
                $query = $this->connecteren()->prepare("DELETE FROM taak WHERE lijstId = :id"); 
                $query->bindParam(':id', $this->lijstId);
                $query->execute();
        }

        // taak bewerken
        public function toonEnBewerkTaak(){
                $query = $this->connecteren()->prepare("SELECT * FROM taak WHERE id = :id"); 
                $query->bindParam(':id', $this->taakId);
                $query->execute();

                while ($resultaat = $query->fetch(PDO::FETCH_ASSOC)) {
                        // lijstId opvragen van tabel taak
                        $lijstId = $resultaat['lijstId'];

                        echo '<div class="formuliergroep">
                                <input class="formulier" type="text" name="taakNaam" placeholder="Taak naam" value="'. $resultaat['titel'].'">
                                </div>

                                <div class="formuliergroep">
                                <input class="formulier" type="text" name="werkuren" placeholder="Werkuren" value="'. $resultaat['werkuren'].'">
                                </div>

                                <div class="formuliergroep">
                                <input class="formulier" type="text" name="einddatum" placeholder="Einddatum (JJJJ-mm-dd) value="'. $resultaat['eindDatum'].'">
                                </div>

                                <div class="formuliergroep">
                                <input class="nieuweTaak" type="submit" value="Bewerken" name="KnopTaak">
                                </div>';
                }
        }

        public function taakBewerken(){
                echo 'ok';

                $titel = $this->getTitel();
                $werkuren = $this->getWerkuren(); 
                $gebruiker = $this->getGebruikersId();
                $eindDatum = $this->getEinddatum();
                $taakId = $this->getTaakId();

                echo $gebruiker;
                
                    $query = $this->connecteren()->prepare("UPDATE taak SET titel = :titel, gebruikersID = :gebruikersID, eindDatum = :eindDatum, werkuren = :werkuren WHERE id =:id");
                    $query->bindParam(':titel', $titel);
                    $query->bindParam(':gebruikersID', $gebruiker);
                    $query->bindParam(':eindDatum', $eindDatum);
                    $query->bindParam(':werkuren', $werkuren);
                    $query->bindParam(':id', $taakId);
                    $query->execute();
        }

}

?>