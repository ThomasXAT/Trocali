<?php

    include "motCle.php";

    foreach (getListeMots() as $mot) {
        ${$mot} = new MotCle($mot);
        print ${$mot}->getIntitule();
        ${$mot}->genererSynonymes();
    }

    $listeMotsCles = array($leçon, $automobile);
    //Récupération des synonymes des mots clés et leur nombre d'occurences
    
    //Initialisation de listeSynonymes
    $listeSynonymes = array();


    foreach ($listeMotsCles as $motCle) {
        $motCle->setCompteur(INF);
        foreach ($motCle->getSynonymes() as $synonyme) {
            if (!in_array($synonyme, $listeSynonymes) && !in_array($synonyme, $listeMotsCles)) {
                $synonyme = new motCle($synonyme);
                array_push($listeSynonymes, $synonyme);
            }
            $synonyme->incrCompteur();
        }
    }

    foreach ($listeSynonymes as $synonyme) {
        foreach ($synonyme->getSynonymes() as $sousSynonyme) {
            echo "<br>", $sousSynonyme->getIntitule();
            if (in_array($sousSynonyme, $listeSynonymes)) {
                $sousSynonyme->incrCompteur();
                echo $sousSynonyme->getIntitule();
            }
        }
    }
/*
    foreach ($listeSynonymes as $value) {
        echo $value->getIntitule();
        echo $value->getCompteur();
    }
*/
?>