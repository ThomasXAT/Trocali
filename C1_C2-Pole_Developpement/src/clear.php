<?php
    include "article.php";

    // Réinitialisation du compteur
	$compteur = fopen("compteur.txt", "r+");
    ftruncate($compteur, 0);
	fclose($compteur);

    // Réinitialisation des articles
    $articles = fopen("articles.json", "r+");
    ftruncate($articles, 0);
    fclose($articles);

    // Réinitialisation de la liste des articles pour chaque mot
    $dic = getDicSynonymes();
    foreach (getListeMots() as $mot) {
        $dic[$mot]["Articles"] = array();
    }
    $donnees = json_encode($dic);
    file_put_contents("dicSynonymes.json", $donnees);

    // Retour à la page d'accueil
    header("Location:index.php");
?>