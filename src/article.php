<?php
class Article
{
    public $_id;
	public $_titre;

    function __construct($id, $titre) {
		$this->setId($id);
		$this->setTitre($titre);
		print 'Article n°';
		print $this->getId();
		print ' publié : ';
		print $this->getTitre();
    }
	
    public function setId($id) {
        $this->_id = $id;
    }
	
    public function getId() {
        print $this->_id;
    }
	
    public function setTitre($titre) {
        $this->_titre = $titre;
    }
	
    public function getTitre() {
        print $this->_titre;
    }
	
	/*public function sauvegarder($fic) {
		
	}*/
}
?>