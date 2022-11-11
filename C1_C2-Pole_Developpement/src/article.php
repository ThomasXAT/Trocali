<?php
	include 'mot.php';
	
	class Article
	{
		// ATTRIBUTS
		
		public $_id;			// Identifiant unique de l'article
		public $_titre;			// Titre de l'article
		public $_motsCles;		// Mots clés de l'article

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

	function exporter($titre) {

		// Incrémentation et récupération du nombre d'articles
		incrNombreArticles();
		$nombreArticles = getNombreArticles();

		// Création du nouvel article
		$nouvelArticle = new Article($nombreArticles, $titre);	

		// Exportation des données de l'article
		$articles = fopen("articles.txt", "a+");
		fwrite($articles, $nouvelArticle->getId()."\r\n");
		fwrite($articles, $nouvelArticle->getTitre()."\r\n");
		$motsCles = arrayToString($nouvelArticle->getMotsCles());
		fwrite($articles, $motsCles."\r\n");
		fclose($articles);			
	}

	function importer($id) {
		$nombreArticles = getNombreArticles();
		$articles = fopen("articles.txt", "r");
		$valeur = fgets($articles, 4096);
		while ($valeur != $id && $valeur != $nombreArticles) {
			for ($i = 0; $i < 3; $i++) {
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
		}
		fclose($articles);
		return $article;
	}
?>