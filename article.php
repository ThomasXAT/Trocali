<?php
include_once("data/database.php");
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $statement = $db->prepare("SELECT * FROM Article WHERE identifiant = ?");
    $statement->execute([$id]);
    $result = $statement->fetch();
    $images = $db->query("SELECT lien FROM Photo WHERE article = $id");

    if ($result == false) {
        header("Location: index.php");
    }
    else {
        $title="Article";
        include "modules/head.php";
        $page="article";
        include "modules/body/header.php";
        $title = $result['titre'];
        $type = $result['type'];
        $category = $result['categorie'];
        $description = $result['description'];
        $means = $result['moyenPaiement'];
        $price = $result['prix'];
        $barter = $result['troc'];
        $writer = $result['auteur'];
        $publicationDate = $result['datePublication'];
    
        if ($images == false) {
            $result = [];
        }
        else {
            $images = $images->fetchAll();
        }
        include "modules/body/article/content.php";
        include "modules/body/footer.php";
    }
}
?>