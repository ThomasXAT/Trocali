<?php
    include "article.php";

	extract($_POST,EXTR_OVERWRITE);	

	if ($titre != "") {
		if (isset($offre)) {
			$type = "Offre";
		}	
		elseif (isset($demande)) {
			$type = "Demande";
		}

		$description = preg_replace("(\r\n|\n|\r)", " ", $description);

		publier($titre, $type, $categorie, $description);

		header("Location:index.php");
	}


?>