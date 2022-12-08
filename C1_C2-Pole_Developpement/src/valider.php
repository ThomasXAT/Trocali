<?php
    include "article.php";

	// Récupération des données du formulaire
	extract($_POST,EXTR_OVERWRITE);	

	if ($titre != "") {

		// Récupération du type de l'article 
		if (isset($offre)) {
			$type = "Offre";
		}	
		elseif (isset($demande)) {
			$type = "Demande";
		}

		// Suppressions des sauts de lignes dans la descriptino
		$description = preg_replace("(\r\n|\n|\r)", " ", $description);

		// Publication de l'article
		publier($titre, $type, $categorie, $description);
	}

	// Retour à la page d'accueil
	header("Location:index.php");


?>