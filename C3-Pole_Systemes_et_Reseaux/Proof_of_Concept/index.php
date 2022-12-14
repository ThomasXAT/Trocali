<?php
    $dbname = "espicka_bd";
    $dsn = "mysql:host=lakartxela;dbname=$dbname";
    $user = "espicka_bd";
    $pass = "espicka_bd";

    try{
        $bdd = new PDO($dsn, $user, $pass);
    }

    catch(PDOException $e){
        echo "Erreur : " . $e->getMessage();
    }
?>