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
	
	// METHODES USUELLES
	
	public function findMotsCles() {
		$motsCles = array(); 
		$mot = strtok($this->getTitre(), " ");
		while ($mot != false) {
			if (1==1) {	// Si le mot est présent dans le dictionnaire des synonymes, l'ajouter à motsCles sinon, non
				array_push($motsCles, $mot);
				$mot = strtok(" ");
			}
		}
		$this->_motsCles = $motsCles; 
	}
}
?>