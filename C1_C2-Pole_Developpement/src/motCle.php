<?php
    include_once "mot.php";

    class motCle extends mot {
        
        // ATTRIBUTS

        private $_compteur;

        // CONSTRUCTEURS

        function __construct($intitule, $compteur = 1) {
            parent::__construct($intitule);
            $this->setCompteur($compteur);
		}

        // METHODES D'ENCAPSULATION

        public function setCompteur($compteur) {
            $this->_compteur = $compteur;
        }

        public function getCompteur() {
            return $this->_compteur;
        }

        // METHODES SPECIFIQUES

        public function incrCompteur() {
            $this->_compteur++;
        }
    }
?>