<?php

    include "mot.php";

    class motCle extends mot {
        
        //ATTRIBUTS

        private $_compteur;

        //CONSTRUCTEURS

        function __construct($intitule) {
			$this->setIntitule($intitule);
			$this->setSynonymes(getDicSynonymes()[$this->getIntitule()]["Synonymes"]);
			$this->setArticles(getDicSynonymes()[$this->getIntitule()]["Articles"]);
            $this->setCompteur(1);
		}

        //GETTERS ET SETTERS

        public function setCompteur($compteur) {
            $this->_compteur = $compteur;
        }

        public function getCompteur() {
            return $this->_compteur;
        }

        //METHODE SPECIFIQUES

        public function incrCompteur() {
            $this->compteur++;
        }

    }

?>

public $_compteur = 1 ;		