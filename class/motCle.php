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

    function trouverSynonymes($liste) {

        $resultat = array();

        // Ajout de chaque mot de la recherche dans la liste résultat avec compteur = INF
        foreach($liste as $mot) {
            ${$mot->getIntitule()} = new MotCle($mot->getIntitule());
            array_push($resultat, ${$mot->getIntitule()});
            ${$mot->getIntitule()}->setCompteur(INF);

            // Ajout de chaque synonyme du mot dans la liste résultat
            foreach(${$mot->getIntitule()}->getSynonymes() as $synonyme) {

                if (!isset(${$synonyme->getIntitule()})) {
                    ${$synonyme->getIntitule()} = new Mot($synonyme->getIntitule());
                    ${$synonyme->getIntitule()}->genererSynonymes();
                }

                // Si le synonyme n'est pas encore dans la liste : compteur = 2
                if (!in_array(${$synonyme->getIntitule()}, $resultat)) {
                    ${$synonyme->getIntitule()} = new MotCle($synonyme->getIntitule());
                    array_push($resultat, ${$synonyme->getIntitule()});
                    ${$synonyme->getIntitule()}->setCompteur(2);
                }

                // Sinon, incrémentation du compteur
                else {
                    ${$synonyme->getIntitule()}->incrCompteur();
                }

                // Ajout de chaque synonyme du synonyme dans la liste résultat
                foreach(${$synonyme->getIntitule()}->getSynonymes() as $sousSynonyme) {

                    if (!isset(${$sousSynonyme->getIntitule()})) {
                        ${$sousSynonyme->getIntitule()} = new Mot($sousSynonyme->getIntitule());
                    }

                    // Si le sous synonyme n'est pas encore dans la liste : compteur = 1
                    if (!in_array(${$sousSynonyme->getIntitule()}, $resultat)) {
                        ${$sousSynonyme->getIntitule()} = new MotCle($sousSynonyme->getIntitule());
                        array_push($resultat, ${$sousSynonyme->getIntitule()});
                        ${$synonyme->getIntitule()}->setCompteur(1);
                    }

                    // Sinon, incrémentation du compteur
                    else {
                        ${$sousSynonyme->getIntitule()}->incrCompteur();
                    }
                }
            }
        }

        return $resultat;
    }
?>
