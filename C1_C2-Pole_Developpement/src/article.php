<?php
	include 'mot.php';

	function getCategories() {
		return ["Automobile", "Catégorie 2", "Catégorie 3"];
	}
	
	class Article
	{
		// ATTRIBUTS
		
		private $_id;			// Identifiant unique de l'article
		private $_titre;		// Titre de l'article
		private $_motsCles;		// Mots clés de l'article
		private $_type;			// Type de l'article (offre ou demande)
		private $_categorie;	// Catégorie de l'article
		private $_description;
		private $_masque = false;

		// CONSTRUCTEUR 
		
		function __construct($id, $titre) {
			$this->setId($id);
			$this->setTitre($titre);
			$this->setMotsCles(findMotsCles($titre));
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

		// Création du nouvel article
		$nouvelArticle = new Article($nombreArticles, $titre);	
		$nouvelArticle->setType($type);
		$motsCles = arrayToString($nouvelArticle->getMotsCles());

		// Exportation des données de l'article
		$articles = fopen("articles.txt", "a+");
		fwrite($articles, $nouvelArticle->getId()."\r\n");
		fwrite($articles, $nouvelArticle->getTitre()."\r\n");
		fwrite($articles, $motsCles."\r\n");
		fwrite($articles, $type."\r\n");
		fwrite($articles, $categorie."\r\n");
		fwrite($articles, $description."\r\n");
		fwrite($articles, "\r\n");
		fclose($articles);			
	}

	function importer($id) {
		$nombreArticles = getNombreArticles();
		$articles = fopen("articles.txt", "r");
		$valeur = fgets($articles, 4096);
		while ($valeur != $id && $valeur != $nombreArticles) {
			for ($i = 0; $i < 7; $i++) {
				$valeur = fgets($articles, 4096);
			}
		}
		if ($valeur == $id) {
			// Création de l'article avec l'id correspondant
			$titre = fgets($articles, 4096); 	
			$article = new Article($id, $titre);
			
			// Ajout du titre	
			$article->setTitre($titre);

			// Ajout des mots clés
			$chaineMotsCles = fgets($articles, 4096); 		
			$listeMotsCles = stringToArray($chaineMotsCles);
			$article->setMotsCles($listeMotsCles);

			// Ajout du type
			$type = fgets($articles, 4096);
			$article->setType($type);

			// Ajout de la catégorie
			$categorie = fgets($articles, 4096);
			$article->setCategorie($categorie);

			// Ajout de la description
			$description = fgets($articles, 4096);
			$article->setDescription($description);

			fgets($articles, 4096);
		}
		fclose($articles);
		return $article;
	}
?>