<?php
include '../articles.php';
session_start();
extract($_POST,EXTR_OVERWRITE);	

if (isset($offre)) {
	$type = "Offre";
}	
elseif (isset($demande)) {
	$type = "Demande";
}

if ($titre != "" && count($_FILES['images']['name']) <= 8) {
	$identifiant = getNombreArticles() + 1;
	$writer = $_SESSION["user"][0];
	$sql = "INSERT INTO Article (
		identifiant,
		titre,
		type,
		categorie,
		description,
		auteur
	)
	VALUES (
		$identifiant,
		'$titre',
		'$type',
		'$categorie',
		'$description',
		'$writer'
	)";
	$statement= $db->prepare($sql);
	$statement->execute();

	$file_array = $_FILES['images'];
	for ($i = 0; $i < count($file_array['name']); $i++) {
		$file_name = "../images/articles/" . $identifiant . "_" . $i . "_" . $file_array['name'][$i];
		$file_tmp = $file_array['tmp_name'][$i];
		$file_size = $file_array['size'][$i];
		$file_type = $file_array['type'][$i];

		if (is_uploaded_file($file_tmp)) {
			$file_data = file_get_contents($file_tmp);
			$stmt = $db->prepare("INSERT INTO Photo (lien, article) VALUES (?, ?)");
			$stmt->execute([$file_name, $identifiant]);

			move_uploaded_file($file_tmp, $file_name);
		}
	}

	if ($price != null && $barter != "") {
		$means = "Argent & Troc";
		$sql = "UPDATE Article SET 
			moyenPaiement = '$means', prix = $price, troc = '$barter'
			WHERE identifiant = $identifiant";
	}
	else if ($price != null && $barter == "") {
		$means = "Argent";
		$sql = "UPDATE Article SET 
			moyenPaiement = '$means', prix = $price, troc = NULL
			WHERE identifiant = $identifiant";
	}
	else if ($price == null && $barter != "") {
		$means = "Troc";
		$sql = "UPDATE Article SET 
			moyenPaiement = '$means', prix = NULL, troc = '$barter'
			WHERE identifiant = $identifiant";
	}
	else {
		$means = "Argent";
		$sql = "UPDATE Article SET 
			moyenPaiement = '$means', prix = 0, troc = NULL
			WHERE identifiant = $identifiant";
	}
	$statement= $db->prepare($sql);
	$statement->execute();

	header("Location:../index.php");
}
else {
	if ($titre == "") {
		header("Location:../publish.php?type=$type&error=title");
	}
	elseif (count($_FILES['images']['name']) > 8) {
		header("Location:../publish.php?type=$type&error=images");
	}}
?>