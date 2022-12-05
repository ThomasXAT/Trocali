<?php
	include 'mot.php';
	$footer = "Développé par Thomas JORGE, Noé JOUVE, Guilhem POTIES, Evan SPICKA et parfois Rémi DUPIN (alternant) dans le cadre de la SAÉ 3.01.";

	function getCategories() {
		return ["Automobile", "Enseignement", "Informatique", "Sécurité", "Nettoyage"];
	}
	
	class Article
	{
		// ATTRIBUTS
		
		private $_id; 		
		private $_titre; 
		private $_motsCles;	
		private $_type;
		private $_categorie; 
		private $_description; 

		// CONSTRUCTEUR 
		
		/**
		 * Constructeur de la classe Article
		 * @param mixed $id Identifiant unique : integer
		 * @param mixed $titre Titre : string
		 * @param mixed $motsCles Mots clés extraits du titre : array(string)
		 * @param mixed $type Type ("offre"/"demande") : string 
		 * @param mixed $categorie Catégorie : string
		 * @param mixed $description Description : string
		 */
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

		// METHODES SPECIFIQUES

		/**
		 * Méthode permettant d'afficher l'Article mis en forme
		 */
		public function afficher() {
			$id = $this->getId();
			$titre = $this->getTitre();
			$type = $this->getType();
			$categorie = $this->getCategorie();
			$description = $this->getDescription();

			print "<article>";
			print "<h3>$type : $titre";
			if ($categorie != "") {
				print " ($categorie)";
			}
			print "</h3><br /><p>$description</p>";
			print "</article>";
		}

		/**
		 * Méthode permettant d'exporter les informations de l'Article afin de les stocker dans le fichier articles.json
		 */
		function exporter() {

			// Récupération du nombre d'articles
			$nombreArticles = getNombreArticles();
			$motsCles = findMotsCles($this->getTitre());
	
			// Récupération de dicArticles
			$fichier = ("articles.json");
			$donnees = file_get_contents($fichier);
			$dicArticles = json_decode($donnees, true);
	
			// Stockage des informations du nouvel article
			$dicArticles[$nombreArticles] = ["Titre" => $this->getTitre(), 
											 "Mots cles" => $motsCles, 
											 "Type" => $this->getType(), 
											 "Categorie" => $this->getCategorie(), 
											 "Description" => $this->getDescription()];
	
			// Exporation de la nouvelle version de dicArticles
			$donnees = json_encode($dicArticles);
			file_put_contents("articles.json", $donnees);
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

	function importer($id) {
		// Récupération de dicArticles
		$fichier = ("articles.json");
		$donnees = file_get_contents($fichier);
		$dicArticles = json_decode($donnees, true);

		// Récupération des attributs de l'article
		$titre = $dicArticles[$id]["Titre"];
		$motsCles = array();
		foreach($dicArticles[$id]["Mots cles"] as $mot) {
			array_push($motsCles, $mot);
		}
		$type = $dicArticles[$id]["Type"];
		$categorie = $dicArticles[$id]["Categorie"];
		$description = $dicArticles[$id]["Description"];

		// Création de l'article
		$article = new Article($id, $titre, $motsCles, $type, $categorie, $description);
		return $article;
	}
?>