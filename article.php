<?php
include_once("data/database.php");
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $statement = $db->prepare("SELECT * FROM Article WHERE identifiant = ?");
    $statement->execute([$id]);
    $result = $statement->fetch();

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
    
        $statement = $db->prepare("SELECT lien FROM Photo WHERE article = ?");
        $statement->execute([$id]);
        $images = array();
        while ($result = $statement->fetch()) {
            array_push($images, $result['lien']);
        }
        include "modules/body/article/content.php";
        include "modules/body/footer.php";
    }
}
?>