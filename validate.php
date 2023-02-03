<?php
include 'database.php';
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

	
	if (isset($_FILES)) {
		print "photo en cours d'upload";
		$nomPhoto = "./photos/".$identifiant;
		move_uploaded_file($_FILES['photos']['tmp_name'], $nomPhoto);

		$sql = "INSERT INTO Photo (
			lien, 
			article
		)
		VALUES (
			$nomPhoto,
			$identifiant
		)";
		$statement= $database->prepare($sql);
		$statement->execute();
		print "</br>";
		print "photo uploadée";
	}


	//header("Location:index.php");
}
else {
	if (isset($offre)) {
		header("Location:publish.php?offre");
	}
	elseif (isset($demande)) {
		header("Location:publish.php?demande");
	}
}
?>