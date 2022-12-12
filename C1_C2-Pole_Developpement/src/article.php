<?php
	include_once 'mot.php';

	/**
	 * Liste des catégories disponibles
	 * @return array<string>
	 */
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
		
		/**
		 * SETTER de $id
		 * @param mixed $id
		 */
		public function setId($id) {
			$this->_id = $id;
		}
		
		/**
		 * GETTER de $id
		 * @return mixed
		 */
		public function getId() {
			return $this->_id;
		}
		
		/**
		 * SETTER de $titre
		 * @param mixed $titre
		 */
		public function setTitre($titre) {
			$this->_titre = $titre;
		}
		
		/**
		 * GETTER de $titre
		 * @return mixed
		 */
		public function getTitre() {
			return $this->_titre;
		}
		
		/**
		 * SETTER de $motsCles
		 * @param mixed $motsCles
		 */
		public function setMotsCles($motsCles) {
			$this->_motsCles = $motsCles;
		}
		
		/**
		 * GETTER de $motsCles
		 * @return mixed
		 */
		public function getMotsCles() {
			return $this->_motsCles;
		}

		/**
		 * SETTER de $type
		 * @param mixed $type
		 */
		public function setType($type) {
			$this->_type = $type;
		}
		
		/**
		 * GETTER de $type
		 * @return mixed
		 */
		public function getType() {
			return $this->_type;
		}

		/**
		 * SETTER de $categorie
		 * @param mixed $categorie
		 */
		public function setCategorie($categorie) {
			$this->_categorie = $categorie;
		}
		
		/**
		 * GETTER de $categorie
		 * @return mixed
		 */
		public function getCategorie() {
			return $this->_categorie;
		}

		/**
		 * SETTER de $description
		 * @param mixed $description
		 */
		public function setDescription($description) {
			$this->_description = $description;
		}
		
		/**
		 * GETTER de $description
		 * @return mixed
		 */
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
			for ($i = 0; $i < sizeof($motsCles); $i++) {
				$motsCles[$i] = $motsCles[$i]->getIntitule();
			}
	
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

	/**
	 * Nombre d'articles publiés
	 * @return int
	 */
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
	
	/**
	 * Incrémenter le nombre d'articles
	 * @return void
	 */
	function incrNombreArticles() {
		$compteur = fopen("compteur.txt", "r+");
		$nombreArticles = getNombreArticles();
		$nombreArticles++;
		file_put_contents("compteur.txt", $nombreArticles);
		fclose($compteur);
	}

	/**
	 * Summary of importer
	 * @param mixed $id
	 * @return Article
	 */
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

	/**
	 * Summary of publier
	 * @param mixed $titre
	 * @param mixed $type
	 * @param mixed $categorie
	 * @param mixed $description
	 * @return void
	 */
	function publier($titre, $type = "Offre", $categorie = "", $description = "") {
		if (in_array($categorie, getCategories()) || $categorie == "") {
			if ($type == "Offre" || $type == "Demande") {
				incrNombreArticles();
				$article = new Article(getNombreArticles(), $titre, findMotsCles($titre), $type, $categorie, $description);
				$article->exporter();

				foreach ($article->getMotsCles() as $mot) {
					$mot = new Mot($mot->getIntitule());
					$mot->ajouterArticle($article);
				}
			}
		}	
	}

function rechercher($liste, $categorie) {
	$resultat = array();
 
	foreach ($liste as $mot) {
		foreach ($mot->getArticles() as $article) {
			if (!in_array($article, $resultat)) {
				array_push($resultat, $article);
			}
		}
	}
	return $resultat;
}
?>