<?php
    include "article.php";

	extract($_POST,EXTR_OVERWRITE);		
	if ($titre != "") {
		exporter($titre);
		//print "Article n°".getNombreArticles()." publié : ".$titre."\r\n";
	}
	header("Location:publier.php");

?>