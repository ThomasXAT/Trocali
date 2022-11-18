<?php
    include "article.php";

	extract($_POST,EXTR_OVERWRITE);	

	if ($titre != "") {
		if (isset($offre)) {
			$type = "Offre";
		}	
		elseif (isset($demande)) {
			$type = "Appel d'offres";
		}
		$description = preg_replace("(\r\n|\n|\r)", " ", $description);
		$nouvelArticle = new Article(getNombreArticles(), $titre, findMotsCles($titre), $type, $categorie, $description);
		$nouvelArticle->exporter();

		foreach ($nouvelArticle->getMotsCles() as $mot) {
			$mot = new Mot($mot);
			$mot->ajouterArticle($nouvelArticle);
		}

		header("Location:index.php");
	}


?>