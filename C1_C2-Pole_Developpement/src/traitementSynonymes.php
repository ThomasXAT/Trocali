<?php
    include "motCle.php";
    
    function traitementSynonymes($listeMots) {

        foreach (getListeMots() as $mot) {
            ${$mot} = new Mot($mot);
        }

        foreach (getListeMots() as $mot) {
            ${$mot} = new Mot($mot);
            ${$mot} -> genererSynonymes();
        }

        $listeMotsCles = array();

        foreach ($listeMots as $mot) {

            if (!(in_array(${$mot->getIntitule()}, $listeMotsCles))) {
                ${$mot->getIntitule()} = new MotCle($mot->getIntitule(), INF);
                array_push($listeMotsCles, ${$mot->getIntitule()});
            }
            else {
                ${$mot->getIntitule()}->setCompteur(INF);
            }

            foreach (${$mot->getIntitule()}->getSynonymes() as $synonyme) {
                if (!(in_array(${$synonyme->getIntitule()}, $listeMotsCles))) {
                    ${$synonyme->getIntitule()} = new MotCle($synonyme->getIntitule());
                    array_push($listeMotsCles, ${$synonyme->getIntitule()});
                }
                ${$synonyme->getIntitule()}->incrCompteur(2);

                foreach (${$synonyme->getIntitule()}->getSynonymes() as $sousSynonyme) {
                    if (!(in_array(${$sousSynonyme->getIntitule()}, $listeMotsCles))) {
                        ${$sousSynonyme->getIntitule()} = new MotCle($sousSynonyme->getIntitule());
                        array_push($listeMotsCles, ${$sousSynonyme->getIntitule()});
                    }
                    ${$sousSynonyme->getIntitule()}->incrCompteur();
                }
            }
        }

        for ($iterateur1 = count($listeMotsCles)-2; $iterateur1 >= 0; $iterateur1--) { 
            for ($iterateur2 = 0; $iterateur2 <= $iterateur1; $iterateur2++) { 
                if ($listeMotsCles[$iterateur2+1]->getCompteur() > $listeMotsCles[$iterateur2]->getCompteur()) {
                    $temp = $listeMotsCles[$iterateur2+1];
                    $listeMotsCles[$iterateur2+1] = $listeMotsCles[$iterateur2];
                    $listeMotsCles[$iterateur2] = $temp;
                }
            }
        }
        return $listeMotsCles;

    }
?>