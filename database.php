<?php
try {
    $database = new PDO('mysql:host=lakartxela.iutbayonne.univ-pau.fr;dbname=gpoties_bd', 'gpoties_bd', 'gpoties_bd');
} catch (PDOException $e) {
    print "Error: " . $e->getMessage() . "<br/>";
    die();
}

function getCategories() {
    return ["Automobile", "Enseignement", "Informatique", "Sécurité", "Nettoyage"];
}

function getNombreArticles($database) {
    $statement = $database->query("SELECT COUNT(identifiant) FROM Article");
    return $statement->fetch()[0];
}
?>