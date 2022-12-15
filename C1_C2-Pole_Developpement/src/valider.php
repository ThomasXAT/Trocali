<?php
    include_once "article.php";

	extract($_POST,EXTR_OVERWRITE);	

	if ($titre != "") {
		if (isset($offre)) {
			$type = "Offre";
		}	
		elseif (isset($demande)) {
			$type = "Demande";
		}
		incrNombreArticles();
		$description = preg_replace("(\r\n|\n|\r)", " ", $description);
		$nouvelArticle = new Article(getNombreArticles(), $titre, trouverMotsCles($titre), $type, $categorie, $description);
		$nouvelArticle->exporter();

		foreach ($nouvelArticle->getMotsCles() as $mot) {
			$mot = new Mot($mot->getIntitule());
			$mot->ajouterArticle($nouvelArticle);
		}

		header("Location:index.php");
	}


?>