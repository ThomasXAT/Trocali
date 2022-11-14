<?php
	include 'mot.php';

	function getCategories() {
		return ["Automobile", "Catégorie 2", "Catégorie 4"];
	}
	
	class Article
	{
		// ATTRIBUTS
		
		private $_id;			// Identifiant unique de l'article
		private $_titre;		// Titre de l'article
		private $_motsCles;		// Mots clés de l'article
		private $_type;			// Type de l'article (offre ou demande)
		private $_categorie;	// Catégorie de l'article
		private $_description;	// Description de l'article
		private $_masque = false;

		// CONSTRUCTEUR 
		
		function __construct($id, $titre, $motsCles, $type, $categorie, $description) {
			$this->setId($id);
			$this->setTitre($titre);
			$this->setMotsCles($motsCles);
			$this->setType($type);
			$this->setCategorie($categorie);
			$this->setDescription($description);
		}
		
		// METHODES D'ENCAPSULATION
		
		public function setId($id) {
			$this->_id = $id;
		}
		
		public function getId() {
			return $this->_id;
		}
		
		public function setTitre($titre) {
			$this->_titre = $titre;
		}
		
		public function getTitre() {
			return $this->_titre;
		}
		
		public function setMotsCles($motsCles) {
			$this->_motsCles = $motsCles;
		}
		
		public function getMotsCles() {
			return $this->_motsCles;
		}

		public function setType($type) {
			$this->_type = $type;
		}
		
		public function getType() {
			return $this->_type;
		}

		public function setCategorie($categorie) {
			$this->_categorie = $categorie;
		}
		
		public function getCategorie() {
			return $this->_categorie;
		}

		public function setDescription($description) {
			$this->_description = $description;
		}
		
		public function getDescription() {
			return $this->_description;
		}

		// METHODES USUELLES

		public function afficher($infosDev) {
			$id = $this->getId();
			$titre = $this->getTitre();
			$type = $this->getType();
			$categorie = $this->getCategorie();
			print "<article><p>Article n°$id ($type) : '$titre'";
			if ($infosDev) {
				$motsCles = arrayToString($this->getMotsCles());
				print " dont les mots clés sont $motsCles est posté dans la catégorie $categorie";
			}
			print "</p></article>";
		}
	}
		
	// SOUS-PROGRAMMES EXTERNES

	function getNombreArticles() {
		$compteur = fopen("compteur.txt", "r+");
		$nombreArticles = fgets($compteur, 255);

		if ($nombreArticles == "") {
			fwrite($compteur, 0);
			$nombreArticles = 0;
		}
		else {
			$nombreArticles = intval($nombreArticles);
		}

		fclose($compteur);
		return $nombreArticles;
	}
	
	function incrNombreArticles() {
		$compteur = fopen("compteur.txt", "r+");
		$nombreArticles = getNombreArticles();
		$nombreArticles++;
		file_put_contents("compteur.txt", $nombreArticles);
		fclose($compteur);
	}

	function exporter($titre, $type, $categorie, $description) {

		// Incrémentation et récupération du nombre d'articles
		incrNombreArticles();
		$nombreArticles = getNombreArticles();
		$motsCles = findMotsCles($titre);

		// Récupération de dicArticles
		$fichier = ("articles.json");
		$donnees = file_get_contents($fichier);
		$dicArticles = json_decode($donnees, true);

		// Stockage des informations du nouvel article
		$dicArticles[$nombreArticles] = ["Titre" => $titre, 
										 "Mots cles" => $motsCles, 
										 "Type" => $type, 
										 "Categorie" => $categorie, 
										 "Description" => $description];

		// Exporation de la nouvelle version de dicArticles
		$donnees = json_encode($dicArticles);
		file_put_contents("articles.json", $donnees);
	}

	function importer($id) {
		// Récupération de dicArticles
		$fichier = ("articles.json");
		$donnees = file_get_contents($fichier);
		$dicArticles = json_decode($donnees, true);

		// Récupération des attributs de l'article
		$titre = $dicArticles[$id]["Titre"];
		$motsCles = $dicArticles[$id]["Mots cles"];
		$type = $dicArticles[$id]["Type"];
		$categorie = $dicArticles[$id]["Categorie"];
		$description = $dicArticles[$id]["Description"];

		// Création de l'article
		$article = new Article($id, $titre, $motsCles, $type, $categorie, $description);
		return $article;
	}
?>