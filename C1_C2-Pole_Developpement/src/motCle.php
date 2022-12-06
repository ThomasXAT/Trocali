<?php
<<<<<<< HEAD

    include "mot.php";
=======
    include_once "mot.php";
>>>>>>> f4a46bdae43082a51c21ab912d070def7ed98125

    class MotCle extends Mot {
        
        // ATTRIBUTS

        private $_mot;
        private $_compteur;

        // CONSTRUCTEURS

<<<<<<< HEAD
        function __construct($mot) {
			$this->setMot($mot);
            $this->getMot()->genererSynonymes();
            $this->setCompteur(1);
=======
        function __construct($intitule, $compteur = 1) {
            parent::__construct($intitule);
            $this->setCompteur($compteur);
>>>>>>> f4a46bdae43082a51c21ab912d070def7ed98125
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
