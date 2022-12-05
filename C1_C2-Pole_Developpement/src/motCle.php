<?php
<<<<<<< HEAD

    include "article.php";
=======
    include "mot.php";
>>>>>>> ab6e87a6f31181e15de1ab0641a4784b697d21b6

    class MotCle extends Mot {
        
        // ATTRIBUTS

        private $_compteur;

        // CONSTRUCTEURS

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
<<<<<<< HEAD
?>
	
=======
?>
>>>>>>> ab6e87a6f31181e15de1ab0641a4784b697d21b6
