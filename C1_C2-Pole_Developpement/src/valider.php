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
		exporter($titre, $type);
		//print "Article n°".getNombreArticles()." publié : ".$titre."\r\n";
		header("Location:index.php");
	}


?>