<?php
// bestanden toevoegen
include_once("classes/Database.php");

class Gebruiker extends Database {
        // variabelen: registreren
        private $email;
        private $wachtwoord;
        private $wachtwoord2;
        private $gebruikersnaam;
        private $gebruikersId;
        private $beheerder;
        private $beheerderId;
        private $hash;
     
        
// email
        public function getEmail()
        {
                return $this->email;
        }

        public function setEmail($email)
        {
            // indien foute gegevens: foutmelding   
            /*if (empty($email)) {
                throw new Exception("email mag niet leeg zijn");
                }
                else {
                $this->email = $email;
                }
                return $this;*/

                $this->email = $email;
                
                return $this;
        }

// wachtwoord
        public function getWachtwoord()
        {
                return $this->wachtwoord;
        }

        public function setWachtwoord($wachtwoord)
        {
            // wachtwoord moet 8 karakters lang zijn
            /*if (strlen($wachtwoord) < 8){
                // indien foute gegevens: foutmelding 
                throw new Exception("Wachtwoord moet minimaal acht tekens lang zijn");
            }
            $hash = password_hash($wachtwoord, PASSWORD_DEFAULT);
                $this->wachtwoord = $hash;
                return $this; */

                $this->wachtwoord = $wachtwoord;
                return $this;
        }

// wachtwoord bevestiging        
        public function getWachtwoord2()
        {
                return $this->wachtwoord2;
        }

        public function setWachtwoord2($wachtwoord2)
        {
            // wachtwoord moet 8 karakters lang zijn
            /*if (strlen($wachtwoord2) < 8){
                // indien foute gegevens: foutmelding 
                throw new Exception("Wachtwoord moet minimaal acht tekens lang zijn");
            }
            $hash = password_hash($wachtwoord2, PASSWORD_DEFAULT);
                $this->wachtwoord2 = $hash;
                return $this;*/

                $this->wachtwoord2 = $wachtwoord2;

                return $this;
        }

// gebruikersnaam
        public function getGebruikersnaam()
        {
                return $this->gebruikersnaam;
        }

        public function setGebruikersnaam($gebruikersnaam)
        {
                $this->gebruikersnaam = $gebruikersnaam;

                return $this;
        }

// gebruikersID
        // gegevens uit database halen ivp zelf door te geven
        public function getGebruikersId()
        {
                // hier moet ik de gebruikersID uit de tabel Gebruikers halen:
                // 1. conncetie met database, selecteer id van de tabel Gebruiker waar de gebruikersnaam gelijk is aaan de variable gebruikersnaam
                $query = $this->connecteren()->prepare("SELECT id FROM gebruiker WHERE gebruikersnaam = :gebruikersnaam");

                // 2. bind de parameters
                $query->bindParam(':gebruikersnaam', $this->getGebruikersnaam);

                // 3. voer query uit
                $query->execute();

                // 4. sla resultaat op in variable resultaat
                $resultaat = $query->fetch(PDO::FETCH_ASSOC);

                // 5. return van variable resultaat het id
                return $resultaat['id'];
        }

        public function setGebruikersId($gebruikersId)
        {
                $this->gebruikersId = $gebruikersId;

                return $this;
        }

// beheerder        
        public function getBeheerder()
        {
                echo $this->beheerder;
                return 'beheerder: ' . $this->beheerder;
        }

        public function setBeheerder($beheerder)
        {
                $this->beheerder = $beheerder;

                return $this;
        }

// beheerderId 
        public function getBeheerderId()
        {
                echo $this->beheerderId;
                return $this->beheerderId;
        }
 
        public function setBeheerderId($beheerderId)
        {
                $this->beheerderId = $beheerderId;

                return $this;
        }

// hash 
        public function getHash()
        {
                return $this->hash;
        }

        public function setHash($hash)
        {
                $this->hash = $hash;

                return $this;
        }

/* ////////////////// functies ////////////////// */
        function aanmelden() {
            // sessie starten
            session_start();
            // gebruikers id opslaan
            $_SESSION['gebruiker'] = $this->gebruikersId;
            echo "session: " . $_SESSION['gebruiker'];
        }

        function controleerAanmelden(){
                echo $this->wachtwoord;
            $query = $this->connecteren()->prepare("SELECT * FROM gebruiker WHERE email = :email"); 
            $query->bindParam(':email', $this->email);
            $query->execute(); 
            $resultaat = $query->fetch(PDO::FETCH_ASSOC);
                
            // email controleren
            if ($resultaat['email'] != $this->email) {
                throw new Exception("Email is onbekend, probeer het opnieuw.");            
            } else {
                // password controleren
                if (password_verify($this->wachtwoord, $resultaat['wachtwoord'])){
                } else {
                    throw new Exception("Wachtwoord is fout, probeer het opnieuw.");
                }
            }
        }


        function controleerTweeWachtwoorden(){
            if ($this->wachtwoord == $this->wachtwoord2) {
                return true; 
            } else {
                throw new Exception("Uw wachtwoorden komen niet overeen, probeer het opnieuw.");
            }
        }

        function sterkWachtwoord(){
            if (strlen($this->wachtwoord) > 8) {
                return true; 
            } else {
                throw new Exception("Uw wachtwoord moet langer zijn dan 8 tekens.");
            }
        }

        function registreren(){
            $query = $this->connecteren()->prepare("INSERT INTO gebruiker(naam, email, wachtwoord) VALUES (:naam, :email, :wachtwoord)");
            $query->bindParam(':naam', $this->gebruikersnaam);
            $query->bindParam(':email', $this->email);
            $query->bindParam(':wachtwoord', $this->hash);
            $query->execute();
        }
 
        function hashWachtwoord(){
            // uitleggen hoe dit werkt
            $this->hash = password_hash($this->wachtwoord, PASSWORD_DEFAULT); 
            return $this->hash;
        }
        
        function checkRegistreren(){
            $query = $this->connecteren()->prepare("SELECT * FROM gebruiker WHERE email = :email"); 
            $query->bindParam(':email', $email);
            $query->execute();

            while ($resultaat = $query->fetch(PDO::FETCH_ASSOC)) {
                // nakijken of email al in gebruik is
                if ($email == $resultaat['email']){
                        throw new Exception("E-mail bestaat al, kies een andere.");
                } // nakijken of gebruikersnaam al in gebruik is
                else if ($gebruikersnaam == $resultaat['gebruikersnaam']) { 
                        throw new Exception("gebruikersnaam bestaat al, kies een andere.");   
                }
            }
        }

        // deze functie gebruiken we bij het inloggen.php
        function zoekGebruikersIdViaEmail() {
                $query = $this->connecteren()->prepare("SELECT id FROM gebruiker WHERE email = :email");
                $query->bindParam(':email', $this->email);
                $query->execute();
                $result = $query->fetch(PDO::FETCH_ASSOC);
                echo'--- result '. $result['id'];
                return $result['id'];
        }

        // functie wordt gebruikt bij het tonen van de gebruikersnaam in de header
        function zoekGebruikersNaamViaId(){
                $query = $this->connecteren()->prepare("SELECT naam FROM gebruiker WHERE id = :id");
                $query->bindParam(':id', $this->gebruikersId);
                $query->execute();
                $resultaat = $query->fetch(PDO::FETCH_ASSOC);
                return $resultaat['naam'];
        }

    }


?>