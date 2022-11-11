<?php
    include "article.php";
	extract($_POST,EXTR_OVERWRITE);		
	if ($titre != "") {
		exporter($titre);
	}
	header("Location:publier.php");
?>