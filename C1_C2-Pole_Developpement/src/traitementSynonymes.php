<?php
    include "motCle.php";

    $listeMots = array($voiture, $cours);
    $listeMotsCles = array();

    foreach ($listeMots as $mot) {
        ${$mot->getIntitule()} = new MotCle($mot->getIntitule(), INF);
        array_push($listeMotsCles, ${$mot->getIntitule()});

        foreach (${$mot->getIntitule()}->getSynonymes() as $synonyme) {
            if (!(in_array($synonyme, $listeMotsCles))) {
                ${$synonyme->getIntitule()} = new MotCle($synonyme->getIntitule());
                array_push($listeMotsCles, ${$synonyme->getIntitule()});
            }
            ${$synonyme->getIntitule()}->incrCompteur(2);

            foreach (${$synonyme->getIntitule()}->getSynonymes() as $sousSynonyme) {
                if (!(in_array($synonyme, $listeMotsCles))) {
                    ${$sousSynonyme->getIntitule()} = new MotCle($sousSynonyme->getIntitule());
                    array_push($listeMotsCles, ${$sousSynonyme->getIntitule()});
                }
                ${$sousSynonyme->getIntitule()}->incrCompteur();
            }
        }
    }

    foreach ($listeMotsCles as $motCle) {
        if (!in_array($motCle, $listeMots)) {
            
        }
    }

    print_r($listeMotsCles)


    
    /*

            print_r(${$mot->getIntitule()});
        print "<br />";

    //Récupération des synonymes des mots clés et leur nombre d'occurences
    
    //Initialisation de listeSynonymes
    $listeSynonymes = array();

    foreach ($listeMotsCles as $motCle) {
        ${$motCle->getMot()->getIntitule()} = new motCle($motCle);
        ${$motCle->getMot()->getIntitule()}->setCompteur(INF);
        foreach (${$motCle->getMot()->getIntitule()}->getSynonymes() as $synonyme) {
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

    for ($i=0; $i < count($listeSynonymes); $i++) { 
        foreach ($listeSynonymes[$i]->getSynonymes as $synonyme) {
            
        }
    }

    foreach ($listeSynonymes as $value) {
        echo $value->getIntitule();
        echo $value->getCompteur();
    }
    */
?>