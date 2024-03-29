<?php
	
    include_once "data/database.php";

	function getCategories() {
		return ["Automobile", "Enseignement", "Informatique", "Sécurité", "Nettoyage"];
	}

    function getNombreArticles() {
        global $db;
        $statement = $db->prepare("SELECT COUNT(identifiant), Masque FROM Article WHERE Masque = 0 ");
        $statement->execute();
        return $statement->fetch()[0];
    }

    function trouverMotsCles($chaine) {
        global $db;
		$chaine = strtolower($chaine);
		$delimiteurs = " .!?,:;(){}[]%-$'/\_"; 
		$listeMotsCles = array(); 
		$mot = strtok($chaine, $delimiteurs);
		while ($mot != "") {
			if (!in_array($mot, $listeMotsCles)) {
				array_push($listeMotsCles, $mot);
			}
			$mot = strtok($delimiteurs);
		}
		return $listeMotsCles; 
	}

	function creerNotifs($idutilisateur, $texte) {
		global $db;		
		$statement = $db->prepare('INSERT INTO Notification (utilisateur, texte) VALUES (?,?)');
		$statement->execute([$idutilisateur, $texte]);     
	}

	function creerNotifsAvecRefArticle($idutilisateur, $texte, $articleRef) {
		global $db;		
		$statement = $db->prepare('INSERT INTO Notification (utilisateur, texte, articleRef) VALUES (?,?,?)');
		$statement->execute([$idutilisateur, $texte, $articleRef]);     
	}
  
	function supprimerNotifsAvecArticleRef($idutilisateur, $articleRef) {
		global $db;
        $statement = $db->prepare('DELETE FROM Notification WHERE utilisateur = ? AND articleRef = ?');
		$statement->execute([$idutilisateur, $articleRef]);
	}
  
	function supprimerNotifsAvecTexte($idutilisateur, $texte) {
		global $db;
        $statement = $db->prepare('DELETE FROM Notification WHERE utilisateur = ? AND texte = ?');
		$statement->execute([$idutilisateur, $texte]);
	}
  
	function supprimerNotifs($identifiant) {
		global $db;
        $statement = $db->prepare('DELETE FROM Notification WHERE identifiant= ?');
		$statement->execute([$identifiant]);
	}
  
	function getAuteur($identifiant) {
		global $db;
		$statement = $db->prepare('SELECT auteur FROM Article WHERE Identifiant= ?');
		$statement->execute([$identifiant]);
		return $auteur=$statement->fetch()[0];
	}
  
	function getTitre($identifiant) {
		global $db;
		$statement = $db->prepare('SELECT titre FROM Article WHERE Identifiant= ?');
		    $statement->execute([$identifiant]);
		    return $titre=$statement->fetch()[0];
	}
  
	function trouverSynonymes($mots) {
		global $db;
		$result = array();
		foreach ($mots as $mot) {
			$result[$mot] = INF;
		}
		foreach (array_keys($result) as $mot) {
			$check = $db->prepare("SELECT intitule FROM Mot WHERE intitule = ?");
            $check->execute([$mot]);
			if ($check->rowCount() != 0) {
				$idMot = ($db->query("SELECT identifiant FROM Mot WHERE intitule = '$mot'")->fetch())["identifiant"];
				$synonymes = $db->query("SELECT synonyme FROM EtreSynonymeDe WHERE mot = $idMot")->fetchAll();
				foreach ($synonymes as $synonyme) {
					$idSynonyme = $synonyme["synonyme"];
					$intituleSynonyme = ($db->query("SELECT intitule FROM Mot WHERE identifiant = $idSynonyme")->fetch())["intitule"];
					if (isset($result[$intituleSynonyme])) {
						$result[$intituleSynonyme] = $result[$intituleSynonyme] + 1;
					}
					else {
						$result[$intituleSynonyme] = 2;
					}
					$synonymes2 = $db->query("SELECT synonyme FROM EtreSynonymeDe WHERE mot = $idSynonyme")->fetchAll();
					foreach ($synonymes2 as $synonyme) {
						$idSynonyme = $synonyme["synonyme"];
						$intituleSynonyme = ($db->query("SELECT intitule FROM Mot WHERE identifiant = $idSynonyme")->fetch())["intitule"];
						if (isset($result[$intituleSynonyme])) {
							$result[$intituleSynonyme] = $result[$intituleSynonyme] + 1;
						}
					}
				}
			}
		}
		arsort($result);
		return $result;
	}

	function rechercher($string, $categorie) {
		global $db;
		$words = (trouverSynonymes(trouverMotsCles($string)));
		$result = array();
		foreach ($words as $word => $id) {
			$sql = "SELECT identifiant FROM Article WHERE titre LIKE '%$word%'";
			$articles = $db->query($sql)->fetchAll();
			foreach ($articles as $article) {
				if (!in_array($article["identifiant"], $result)) {
					array_push($result, $article["identifiant"]);
				}
			}
		}
		return $result;
	}

	function getDescription($identifiant) {
		global $db;
		$statement = $db->prepare('SELECT Description FROM Article WHERE Identifiant= ?');
		    $statement->execute([$identifiant]);
		    return $titre=$statement->fetch()[0];
	}
	function getDatePublication($identifiant) {
		global $db;
		$statement = $db->prepare('SELECT datePublication FROM Article WHERE Identifiant= ?');
		    $statement->execute([$identifiant]);
		    return $titre=$statement->fetch()[0];
	}

	function get1stImage($identifiant) {
		global $db;
		$statement = $db->prepare('SELECT lien FROM Photo WHERE article= ?');
		    $statement->execute([$identifiant]);
		    return $titre=$statement->fetch();
	}


	function afficherArticle($id, $cart = false){
		if (verifMasque($id)==1){
			if(basename($_SERVER['PHP_SELF'])!='index.php'){
			if(isset($_SESSION["user"])){
			if(getAcheteur($id)==$_SESSION["user"][0])
			{
				retourneAfficheArticle($id, $cart);
			}
			elseif(getAuteur($id)==$_SESSION["user"][0]){
				retourneAfficheArticle($id, $cart);
			}
		}
			
		}
		}
		else{
		retourneAfficheArticle($id, $cart);
	}
	}

	function reglerArticle($idArticle, $user) {
		global $db;
		$statement = $db->prepare('UPDATE Article SET masque = 1, acheteur = ? WHERE identifiant = ?');
		$statement->execute([$user, $idArticle]);

		$statement = $db->prepare('DELETE FROM Panier WHERE article = ?');
		$statement->execute([$idArticle]);

		unset($_SESSION['current_article']);
	}	

	function getNbNotif($utilisateur){
		global $db;
		$statement = $db->prepare("SELECT COUNT(identifiant) FROM Notification WHERE utilisateur= ?");
		    $statement->execute([$utilisateur]);
			
			return $nb=$statement->fetch()[0];
	}
	function verifMasque($article){
		global $db;
		$statement = $db->prepare("SELECT masque FROM Article WHERE identifiant= ?");
		    $statement->execute([$article]);
			
			return $nb=$statement->fetch()[0];
	}

	function getAcheteur($article){
		global $db;
		$statement = $db->prepare("SELECT acheteur FROM Article WHERE identifiant= ?");
		    $statement->execute([$article]);
			
			return $nb=$statement->fetch()[0];
	}
	function retourneAfficheArticle($id, $cart){
		print "<article class='articleListe'>";
		if (!isset((get1stImage($id)[0]))){
			print "<img src='./images/articles/placeholder-1.png'>";
		}
		else {
			print "<img src='./". get1stImage($id)[0]. "'>";
		}
		print "<div>";
		print "<h3> <a href='article.php?id=".$id."'>". getTitre($id). "</a> </h3>";
		print "<span>". getDatePublication($id). "</span>";
		print "</div>";
		if($cart){
			print "</br>";

			print "<a href='settlement.php?id=$id' id='reglement'>Regler l'article</a>";

		}
		print "</article>";
	}

	function getMoyenneAvis($idutilisateur){
		global $db;
		$statement = $db->prepare("SELECT ROUND(AVG(note) ,1) FROM Avis WHERE cible= ?");
		    $statement->execute([$idutilisateur]);
			
			return $nb=$statement->fetch()[0];

	}
	function getNombreAvis($id){
		global $db;
        $statement = $db->prepare("SELECT COUNT(identifiant) FROM Avis WHERE cible= ?");
        $statement->execute([$id]);
        return $statement->fetch()[0];
	}

	function afficherAvis($id){
		print "<article class='avis'>";	
		print ("<p> Auteur : " .getRedacteur($id) ."</p>");	
		print ("<p> Publié le : ". getDateAvis($id) . "</p>");
		print ("<h3>Note : " . getNoteAvis($id) . "/10</h3>" );
		print ("<h5> Description de l'avis : ". getTexteAvis($id) . "</h5>");
		print ("</article>");
	}

	function getRedacteur($id){
		global $db;
        $statement = $db->prepare("SELECT redacteur FROM Avis WHERE identifiant= ?");
        $statement->execute([$id]);
        return $statement->fetch()[0];
	}

	function getNoteAvis($id){
		global $db;
        $statement = $db->prepare("SELECT note FROM Avis WHERE identifiant= ?");
        $statement->execute([$id]);
        return $statement->fetch()[0];
	}

	function getTexteAvis($id){
		global $db;
        $statement = $db->prepare("SELECT description FROM Avis WHERE identifiant= ?");
        $statement->execute([$id]);
        return $statement->fetch()[0];
	}

	function getDateAvis($id){
		global $db;
        $statement = $db->prepare("SELECT datePublication FROM Avis WHERE identifiant= ?");
        $statement->execute([$id]);
        return $statement->fetch()[0];
	}

	function getNombreArticleUtilisateurPrecis(){
		global $db;
        $statement = $db->prepare("SELECT COUNT(identifiant) FROM Article WHERE auteur != ? AND masque = 0");
        $statement->execute([$_SESSION["user"][0]]);
        return $statement->fetch()[0];
	}

	function getNombreArticleUtilisateurPrecisV($user){
		global $db;
        $statement = $db->prepare("SELECT COUNT(identifiant) FROM Article WHERE auteur = ? AND masque = 0");
        $statement->execute([$user]);
        return $statement->fetch()[0];
	}
?>