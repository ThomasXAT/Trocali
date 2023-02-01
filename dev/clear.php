<?php
    include "../class/article.php";
	$compteur = fopen("../compteur.txt", "r+");
    ftruncate($compteur, 0);
	fclose($compteur);
    $articles = fopen("../articles.json", "r+");
    ftruncate($articles, 0);
    fclose($articles);

    $dic = getDicSynonymes();
    foreach (getListeMots() as $mot) {
        $dic[$mot]["Articles"] = array();
    }
    $donnees = json_encode($dic);
    file_put_contents("../dicSynonymes.json", $donnees);

    header("Location:../index.php");
?>