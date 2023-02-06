<?php
include 'database.php';
include 'mot.php';
extract($_POST,EXTR_OVERWRITE);	
if ($titre != "") {
	if (isset($offre)) {
		$type = "Offre";
	}	
	elseif (isset($demande)) {
		$type = "Demande";
	}
	$identifiant = getNombreArticles($database) + 1;
	$sql = "INSERT INTO Article (
		identifiant,
		titre,
		type,
		categorie,
		description
	)
	VALUES (
		$identifiant,
		'$titre',
		'$type',
		'$categorie',
		'$description'
	)";
	$statement= $database->prepare($sql);
	$statement->execute();

	$motsCles = trouverMotsCles($titre);
	foreach ($motsCles as $motCle) {
		$sql = "INSERT INTO ContenirDansTitre (
			mot, article
		)
		VALUES (".
			$motCle->getIntitule().",
			$identifiant
		)";
		$statement= $database->prepare($sql);
		$statement->execute();
	}

	header("Location:index.php");
}
?>