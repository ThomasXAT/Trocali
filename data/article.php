<?php
session_start();
include '../functions.php';
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    if (isset($_GET["delete"])) {
        $delete = $_GET["delete"];
        if ($delete == "true") {
            $statement = $db->prepare("SELECT Lien FROM Photo WHERE Article= ?"); 
            $statement->execute([$id]);
            while ($resu= $statement->fetch()){
                $link = $resu['Lien'];   
                unlink("..".$link);
            }
            $statement = $db->prepare("DELETE FROM Photo WHERE Article = ?"); 
            $statement->execute([$id]);
            $statement = $db->prepare("DELETE FROM Notification WHERE articleRef = ?"); 
            $statement->execute([$id]);
            $statement = $db->prepare("DELETE FROM Panier WHERE article = ?"); 
            $statement->execute([$id]);
            $statement = $db->prepare("DELETE FROM Article WHERE Identifiant = ?"); 
            $statement->execute([$id]);
            header("Location: ../index.php");
        }
    }
    if (isset($_GET["cart"])) {
        $cart = $_GET["cart"];
        if ($cart == 'add') {
            $statement = $db->prepare('INSERT INTO Panier (article, utilisateur) VALUES (?,?)');
            $statement->execute([$id, $_SESSION["user"][0]]);   
            $auteur=getAuteur($id);
		    $titre=getTitre($id);
            $letexte= "Votre article " . $titre . " a été ajouté au panier de l'utilisateur ". $_SESSION["user"][0]. " ! ";
            creerNotifsAvecRefArticle($auteur, $letexte, $id);
            header("Location: ../article.php?id=$id");
        }
        elseif ($cart='remove') {
            $statement = $db->prepare('DELETE FROM Panier WHERE article = ? AND utilisateur = ?');
            $statement->execute([$id, $_SESSION["user"][0]]);
            $auteur=getAuteur($id);
            supprimerNotifsAvecArticleRef($auteur, $id);
            header("Location: ../article.php?id=$id");
        }
    }
}


?>