<?php
    include "data/database.php";

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
?>