<?php
    include "motCle.php";

    $listeMotsCles = array($voiture, $automobile);
    print_r($voiture);
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
<<<<<<< HEAD
    }*/
/*
=======
    }

    for ($i=0; $i < count($listeSynonymes); $i++) { 
        foreach ($listeSynonymes[$i]->getSynonymes as $synonyme) {
            
        }
    }

>>>>>>> f4a46bdae43082a51c21ab912d070def7ed98125
    foreach ($listeSynonymes as $value) {
        echo $value->getIntitule();
        echo $value->getCompteur();
    }
<<<<<<< HEAD
*/
=======
>>>>>>> f4a46bdae43082a51c21ab912d070def7ed98125
?>