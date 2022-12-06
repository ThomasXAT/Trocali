<?php

    include "mot.php";

    class MotCle extends Mot {
        
        // ATTRIBUTS

        private $_mot;
        private $_compteur;

        // CONSTRUCTEURS

        function __construct($mot) {
			$this->setMot($mot);
            $this->getMot()->genererSynonymes();
            $this->setCompteur(1);
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

        public function incrCompteur() {
            $this->_compteur++;
        }
    }
?>
