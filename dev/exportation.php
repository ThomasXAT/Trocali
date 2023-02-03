<?php

    include 'mot.php';

    $host= "mysql:host=lakartxela.iutbayonne.univ-pau.fr;dbname=gpoties_bd";
    $user= "gpoties_bd"; // Utilisateur
    $pass= "gpoties_bd"; // mp

try {
    $bd = new PDO($host,$user,$pass);
} 

catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}

    $dicSynonymes = getDicSynonymes();

    $query = "INSERT INTO EtreSynonymeDe VALUES (?,?)";
    $insert = $bd->prepare($query);

    foreach ($dicSynonymes as $key => $mot) {
        foreach ($mot["Synonymes"] as $synonyme) {
            if ($key != "Array") {
                //$insert->execute([$synonyme, $key]);
            }
        }
    }

$bd = NULL;

?>