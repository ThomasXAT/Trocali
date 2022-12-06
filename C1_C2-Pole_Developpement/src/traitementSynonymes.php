<?php

foreach (getListeMots() as $mot) {
    ${$mot} = new Mot($mot);
}

    include "article.php";

    $listeMotsCles = array("je");
    //Récupération des synonymes des mots clés et leur nombre d'occurences
    
    //Initialisation de listeSynonymes
    $listeSynonymes = array();


    //${"article$i"} $article1 +
    foreach ($listeMotsCles as $motCle) {
        ${"$motCle"} = new Mot($motCle);
        ${"$motCle"}->setCompteur(INF);

        foreach (${"$motCle"}->getSynonymes() as $synonyme) {
            if (!in_array($synonyme, $listeSynonymes) && !in_array($synonyme, $listeMotsCles)) {
                ${"$synonyme"} = new Mot($synonyme);
                array_push($listeSynonymes, $synonyme);
            }
            elseif (!in_array($synonyme, ${"$synonyme"})) {
                ${"$synonyme"}->incrCompteur();
            }
        }
    }

    for ($i=0; $i < count($listeSynonymes); $i++) { 
        foreach ($listeSynonymes[$i]->getSynonymes as $synonyme) {
            
        }
    }

    foreach ($listeSynonymes as $value) {
        echo $value;
        echo ${"$value"}->getCompteur();
    }
?>