<?php
    include "article.php";

	extract($_POST,EXTR_OVERWRITE);		
	if (isset($titre)) {
		exporter($titre);
		$affichage = "Article n°".getNombreArticles()." publié : ".$titre."\r\n";
	}
	header("Location:publier.php");

?>