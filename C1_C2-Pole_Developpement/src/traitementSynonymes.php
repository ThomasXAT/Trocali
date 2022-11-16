<?php 
    include "article.php";

    $listeMotsCles = array("automobile", "location", "moto");
    //Récupération des synonymes des mots clés et leur nombre d'occurences
    
    //Initialisation de listeSynonymes
    $listeSynonymes = array();


    //${"article$i"} $article1 +
    foreach ($listeMotsCles as $motCle) {
        ${"$motCle"} = new Mot($motCle);
        ${"$motCle"}.setCompteur(INF);

        foreach (${"$motCle"}.getSynonymes as $synonyme) {
            if ((!)) {
                # code...
            }
        }
    }
?>