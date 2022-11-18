<?php
	Class Mot
	{
		// ATTRIBUTS
		
		public $_intitule;					// Intitulé du mot
		public $_synonymes;					// Liste des synonymes de ce mot
		public $_articles = array();		// Liste des articles dans lesquels est présent ce mot

		// CONSTRUCTEUR 
		
		function __construct($intitule) {
			$this->setIntitule($intitule);
			$this->setSynonymes(getDicSynonymes()[$this->getIntitule()]["Synonymes"]);
			$this->setArticles(getDicSynonymes()[$this->getIntitule()]["Articles"]);
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

		public function setArticles($articles) {
			$this->_articles = $articles;
		}
		
		public function getArticles() {
			return $this->_articles;
		}
		
		// METHODES 	

		public function ajouterArticle($id) {
			$fichier = ("dicSynonymes.json");
			$donnees = file_get_contents($fichier);
			$dicSynonymes = json_decode($donnees, true);
			$article = importer($id);

			if (isset($dicSynonymes[$this->getIntitule()]["Articles"])) {
				array_push($dicSynonymes[$this->getIntitule()]["Articles"], $article);
			}
			else {
				$dicSynonymes[$this->getIntitule()]["Articles"] = [$article];
			}
			$donnees = json_encode($dicSynonymes);
			file_put_contents($fichier, $donnees);
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

	function testerSingulier($mot) {
		$derniereLettre = substr($mot, -1);
		if ($derniereLettre == "s") {
			$tailleMot = strlen($mot);
			$singulier = "";
			for ($lettre = 0; $lettre <= $tailleMot - 2; $lettre++) {
				$singulier[$lettre] = $mot[$lettre];
			}
			return $singulier;
		}
		else {
			return $mot;
		}
	}

	function findMotsCles($chaine) {
		$chaine = strtolower($chaine);
		$delimiteurs = " .!?,:;(){}[]%-$'/\_"; 
		$listeMotsCles = array(); 
		$mot = strtok($chaine, $delimiteurs);
		while ($mot != "") {
			if (existe($mot)) {
				if (!in_array($mot, $listeMotsCles)) {
					$mot = new Mot($mot);
					array_push($listeMotsCles, $mot);
				}
			}
			elseif (existe(testerSingulier($mot))) {
				if (!in_array($mot, $listeMotsCles)) {
					$mot = new Mot($mot);
					array_push($listeMotsCles, testerSingulier($mot));
				}
			}
			$mot = strtok($delimiteurs);
		}
		return $listeMotsCles; 
	}

	function existe($mot) {
		return in_array($mot, getListeMots());
	}


?>