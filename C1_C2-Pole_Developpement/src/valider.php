<?php
    include "article.php";

	extract($_POST,EXTR_OVERWRITE);	

	if ($titre != "") {
		if (isset($offre)) {
			$type = "offre";
		}	
		elseif (isset($demande)) {
			$type = "demande";
		}
		$description = preg_replace("(\r\n|\n|\r)", " ", $description);
		exporter($titre, $type, $categorie, $description);
		//print "Article n°".getNombreArticles()." publié : ".$titre."\r\n";
		header("Location:index.php");
	}


?>