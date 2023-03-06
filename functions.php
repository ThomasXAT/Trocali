<?php
    include_once "data/database.php";

	function getCategories() {
		return ["Automobile", "Enseignement", "Informatique", "Sécurité", "Nettoyage"];
	}

    function getNombreArticles() {
        global $db;
        $statement = $db->prepare("SELECT COUNT(identifiant) FROM Article");
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
            $check = $db->prepare("SELECT intitule FROM Mot WHERE intitule = ?");
            $check->execute([$mot]);
			if ($check->rowCount() != 0) {
				if (!in_array($mot, $listeMotsCles)) {
					array_push($listeMotsCles, $mot);
				}
			}
			$mot = strtok($delimiteurs);
		}
		return $listeMotsCles; 
	}

	function creerNotifs($idutilisateur, $texte) {
		global $db;		
		$statement = $db->prepare('INSERT INTO Notification (utilisateur, texte, articleRef) VALUES (?,?,?)');
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
		arsort($result);
		return $result;
	}

	function rechercher($chaine, $categorie) {
		$motsCles = (trouverSynonymes(trouverMotsCles($chaine)));
		foreach($motsCles as $key => $value) {
			echo "$key $value<br>";
		}
	}
?>