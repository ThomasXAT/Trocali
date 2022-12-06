<?php
	include_once 'article.php';
	
	Class Mot
	{
		// ATTRIBUTS
		
		public $_intitule;					// Intitulé du mot
		public $_synonymes;					// Liste des synonymes de ce mot
		public $_articles = array();		// Liste des articles dans lesquels est présent ce mot

		// CONSTRUCTEUR 
		
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
		
		// METHODES SPECIFIQUES	

		public function ajouterArticle($article) {
			$fichier = ("dicSynonymes.json");
			$donnees = file_get_contents($fichier);
			$dicSynonymes = json_decode($donnees, true);
			
			if (!isset($dicSynonymes[$this->getIntitule()]["Articles"])) {
				$dicSynonymes[$this->getIntitule()]["Articles"] = array();
				print "array créé";
			}
			array_push($dicSynonymes[$this->getIntitule()]["Articles"], $article->getId());

			$donnees = json_encode($dicSynonymes);
			file_put_contents($fichier, $donnees);
		}

		public function genererSynonymes() {
			$listeSynonymes = array();
			foreach (getDicSynonymes()[$this->getIntitule()]["Synonymes"] as $mot) {
				$synonyme = new Mot($mot);
				array_push($listeSynonymes, $synonyme);
			}
			$this->setSynonymes($listeSynonymes);
		}
	}

	// SOUS-PROGRAMMES EXTERNES

	foreach (getListeMots() as $mot) {
		${$mot} = new Mot($mot);
	}

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
				$motCle = new Mot($mot);
				if (!in_array($motCle, $listeMotsCles)) {
					array_push($listeMotsCles, $motCle);
				}
			}
			elseif (existe(testerSingulier($mot))) {
				$motCle = new Mot(testerSingulier($mot));
				if (!in_array($motCle, $listeMotsCles)) {
					array_push($listeMotsCles, $motCle);
				}
			}
			$mot = strtok($delimiteurs);
		}
		return $listeMotsCles; 
	}

	function existe($mot) {
		return in_array($mot, getListeMots());
	}

	
	foreach (getListeMots() as $mot) {
		${$mot} = new Mot($mot);
		${$mot} -> genererSynonymes();
	}
?>