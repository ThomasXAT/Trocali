<?php
    include "mot.php";

    class motCle extends mot {
        
        // ATTRIBUTS

        private $_compteur;

        // CONSTRUCTEURS

        function __construct($intitule) {
			$this->setIntitule($intitule);
			$this->setSynonymes(getDicSynonymes()[$this->getIntitule()]["Synonymes"]);
			$this->setArticles(getDicSynonymes()[$this->getIntitule()]["Articles"]);
            $this->setCompteur(1);
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