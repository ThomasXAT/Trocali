<?php

    include "article.php";

    class MotCle extends Mot {
        
        //ATTRIBUTS

        private $_compteur;

        //CONSTRUCTEURS

        function __construct($intitule) {
			$this->setIntitule($intitule);
			$listeSynonymes = array();
			$listeArticles = array(); 
			
			foreach (getDicSynonymes()[$this->getIntitule()]["Articles"] as $id) {
				$article = importer($id);
				array_push($listeArticles, $article);
			}

			$this->setSynonymes($listeSynonymes);
			$this->setArticles($listeArticles);
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
            $this->_compteur++;
        }
    }
?>
	