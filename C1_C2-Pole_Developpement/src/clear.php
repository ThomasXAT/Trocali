<?php
	$compteur = fopen("compteur.txt", "r+");
    ftruncate($compteur, 0);
	fclose($compteur);
    $articles = fopen("articles.txt", "r+");
    ftruncate($articles, 0);
    fclose($articles);
    header("Location:index.php");
?>