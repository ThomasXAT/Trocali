<?php
class Article
{
	// ATTRIBUTS
	
    public $_id;			// Identifiant unique de l'article
	public $_titre;			// Titre de l'article
	public $_motsCles;		// Mots clés de l'article

	// CONSTRUCTEUR 
	
    function __construct($id, $titre, $afficher) {
		$this->setId($id);
		$this->setTitre($titre);
		$this->findMotsCles();
		if ($afficher == true) {
			print 'Article n°';
			print $this->getId();
			print ' publié : ';
			print $this->getTitre();
		}
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
	
	// METHODES SPECIFIQUES
	
	public function findMotsCles() {
		$motsCles = array(); 
		$mot = strtok($this->getTitre(), " ");
		while ($mot != false) {
			if (1==1) {	// Si le mot est présent dans le dictionnaire des synonymes, l'ajouter à motsCles sinon, non
				array_push($motsCles, $mot);
				$mot = strtok(" ");	// Trouver comment ne garder que les mots, pas la ponctuation
			}
		}
		$this->_motsCles = $motsCles; 
	}
}
	
	// Récupération des articles dans la base de données
	
	$compteur = fopen("compteur.txt", "r+");
	$nombreArticles = fgets($compteur, 255);
	$nombreArticles = intval($nombreArticles);
	fclose($compteur);
	
	$articles = fopen("articles.txt", "r");
	for ($i = 0; $i < $nombreArticles; $i++) {
		
		// Création de l'article avec l'id correspondant
		$id = fgets($articles, 4096); 
		$id = intval($id);
		${"article$id"} = new Article($id, "temp", false);
		$idArticle = $id;

		// Ajout du titre
		$titre = fgets($articles, 4096); 		
		${"article$idArticle"}->setTitre($titre);
		
		// Ajout des mots clés
		$chaineMotsCles = fgets($articles, 4096); 		
		$listeMotsCles = array();
		$motCle = "";
		for ($i = 0; $i < strlen($chaineMotsCles); $i++) {
			if ($chaineMotsCles[$i] != ";") {
				$motCle[strlen($motCle)] = $chaineMotsCles[$i];
			}
			else {
				array_push($listeMotsCles, $motCle);
				$motCle = "";
			}
		}
		array_push($listeMotsCles, $motCle);
		${"article$idArticle"}->setMotsCles($listeMotsCles);
		
	}
	fclose($articles);
?>