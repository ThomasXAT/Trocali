<?php
    include_once "mot.php";

    class MotCle extends Mot {
        
        // ATTRIBUTS

        private $_mot;
        private $_compteur;

        // CONSTRUCTEURS
        
        function __construct($intitule, $compteur = 0) {
            parent::__construct($intitule);
            $this->genererSynonymes();
            $this->setCompteur($compteur);
		}

        // METHODES D'ENCAPSULATION

        public function setMot($mot) {
            $this->_mot = $mot;
        }

        public function getMot() {
            return $this->_mot;
        }

        public function setCompteur($compteur) {
            $this->_compteur = $compteur;
        }

        public function getCompteur() {
            return $this->_compteur;
        }

        // METHODES SPECIFIQUES

        public function incrCompteur($ajout = 1) {
            $this->_compteur += $ajout;
        }
    }
?>
