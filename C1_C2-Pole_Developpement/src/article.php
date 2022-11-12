<?php
	include 'mot.php';
	
	class Article
	{
		// ATTRIBUTS
		
		public $_id;			// Identifiant unique de l'article
		public $_titre;			// Titre de l'article
		public $_motsCles;		// Mots clés de l'article
		public $_type;			// Type de l'article (offre ou demande)

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

		// METHODES USUELLES

		public function toString() {
			return $this->getId()." ".$this->getTitre()." ".arrayToString($this->getMotsCles());
		}

		public function afficher($infosDev) {
			$id = $this->getId();
			$titre = $this->getTitre();
			$type = $this->getType();
			print "<article><p>Article n°$id ($type) : '$titre'";
			if ($infosDev) {
				$motsCles = arrayToString($this->getMotsCles());
				print " dont les mots clés sont $motsCles";
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

	function exporter($titre, $type) {

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
		fclose($articles);			
	}

	function importer($id) {
		$nombreArticles = getNombreArticles();
		$articles = fopen("articles.txt", "r");
		$valeur = fgets($articles, 4096);
		while ($valeur != $id && $valeur != $nombreArticles) {
			for ($i = 0; $i < 4; $i++) {
				$valeur = fgets($articles, 4096);
			}
		}
		if ($valeur == $id) {
			// Création de l'article avec l'id correspondant
			$article = new Article($id, "temp");
			
			// Ajout du titre
			$titre = fgets($articles, 4096); 		
			$article->setTitre($titre);

			// Ajout des mots clés
			$chaineMotsCles = fgets($articles, 4096); 		
			$listeMotsCles = stringToArray($chaineMotsCles);
			$article->setMotsCles($listeMotsCles);

			// Ajout du type
			$type = fgets($articles, 4096);
			$article->setType($type);
		}
		fclose($articles);
		return $article;
	}
?>