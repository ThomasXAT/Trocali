<?php
	Class Mot
	{
		// ATTRIBUTS
		
		public $_intitule;					// Intitulé du mot
		public $_synonymes;					// Liste des synonymes de ce mot
		public $_presentDans = array();		// Liste des articles dans lesquels est présent ce mot
		public $_compteur = 1 ;			

		// CONSTRUCTEUR 
		
		function __construct($intitule) {
			$this->setIntitule($intitule);
			$this->setSynonymes(getDicSynonymes()[$this->getIntitule()]);
		}
		
		// METHODES D'ENCAPSULATION
		
		public function setIntitule($intitule) {
			$this->_intitule = $intitule;
		}
		
		public function getIntitule() {
			return $this->_intitule;
		}
		
		public function setSynonymes($synonymes) {
			$this->_synonymes = $synonymes;
		}
		
		public function getSynonymes() {
			return $this->_synonymes;
		}
		
		public function setCompteur($compteur) {
			$this->_compteur = $compteur;
		}
		
		public function getCompteur() {
			return $this->_compteur;
		}
		
		// METHODES 
	
		public function incrCompteur() {
			$this->setCompteur($this->getCompteur()+1);
		}	
	}

	// SOUS-PROGRAMMES EXTERNES

	function getDicSynonymes() {
		$fichier = "dicSynonymes.json"; 
		$donnees = file_get_contents($fichier);
		$dicSynonymes = json_decode($donnees, true);
		return $dicSynonymes;
	}

	function getListeMots() {
		return array_keys(getDicSynonymes());
	}

	function stringToArray($chaine) {
		$liste = array();
		for ($i = 0; $i < strlen($chaine); $i++) {
			if ($chaine[$i] != ";") {
				$mot[strlen($mot)] = $chaine[$i];
			}
			else {
				array_push($liste, $mot);
				$mot= "";
			}
		}
		array_push($liste, $mot);
		return $liste;
	}

	function arrayToString($liste) {
		$chaine = "";
		$nombreMots = sizeof($liste);
		for ($mot = 0; $mot < $nombreMots; $mot++) {
			$chaine = $chaine.$liste[$mot];
			if ($liste[$mot] != end($liste)) {
				$chaine = $chaine.";";
			}
		}
		return $chaine;
	}

	function findMotsCles($chaine) {
		$delimiteurs = " .!?,:;(){}[]%"; 
		$listeMotsCles = array(); 
		$mot = strtok($chaine, $delimiteurs);
		$listeMots = getListeMots();
		while ($mot != false) {
			if (in_array($mot, $listeMots)) {
				array_push($listeMotsCles, $mot);
				$mot = strtok($delimiteurs);
			}
		}
		return $listeMotsCles; 
	}
?>