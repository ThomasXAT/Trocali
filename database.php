<?php
try {
    $database = new PDO('mysql:host=lakartxela.iutbayonne.univ-pau.fr;dbname=gpoties_bd', 'gpoties_bd', 'gpoties_bd');
} catch (PDOException $e) {
    print "Error: " . $e->getMessage() . "<br/>";
    die();
}

function getNombreArticles($database) {
    $statement = $database->query("SELECT COUNT(identifiant) FROM Article");
    return $statement->fetch()[0];
}

function getDicArticles($database) {
    $dicArticles = array();
	$statement = $database->query("SELECT * FROM Article");
    foreach ($statement as $row) {
        $dicArticles[$row['identifiant']]['titre'] = $row['titre'];
        $dicArticles[$row['identifiant']]['type'] = $row['type'];
        $dicArticles[$row['identifiant']]['categorie'] = $row['categorie'];
        $dicArticles[$row['identifiant']]['description'] = $row['description'];
        //$dicArticles[$row['identifiant']]['auteur'] = $row['auteur'];
        //$dicArticles[$row['identifiant']]['datePublication'] = $row['datePublication'];
        //$dicArticles[$row['identifiant']]['acheteur'] = $row['acheteur'];
        //$dicArticles[$row['identifiant']]['dateAchat'] = $row['dateAchat'];
    }
    return $dicArticles;
}

function getDicSynonymes($database) {
    $dicSynonymes = array();
	$statement = $database->query("SELECT * FROM Mot"); 
    foreach ($statement as $row) {
        $dicSynonymes[$row['intitule']]['Synonymes'] = array();
        $statement2 = $database->query("SELECT * FROM EtreSynonymeDe WHERE mot = ".$row['intitule']); 
        foreach ($statement2 as $row2) {
            array_push($dicSynonymes[$row['intitule']]['Synonymes'], $row2['synonyme']);
        }
        $dicSynonymes[$row['intitule']]['Articles'] = array();
        $statement3 = $database->query("SELECT * FROM ContenirDansTitre WHERE mot = ".$row['intitule']); 
        foreach ($statement3 as $row3) {
            array_push($dicSynonymes[$row['intitule']]['Articles'], $row3['article']);
        }
    }
    return $dicSynonymes;
}

function getListeMots($database) {
    return array_keys(getDicSynonymes($database));
}
?>
	
