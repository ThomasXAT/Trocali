<?php
    include "motCle.php";
    
    function traitementSynonymes($liste) {

        $resultat = array();

        // Ajout de chaque mot de la recherche dans la liste résultat avec compteur = INF
        foreach($liste as $mot) {
            ${$mot->getIntitule()} = new MotCle($mot->getIntitule(), INF);
            array_push($resultat, ${$mot->getIntitule()});

            // Ajout de chaque synonyme du mot dans la liste résultat
            foreach(${$mot->getIntitule()}->getSynonymes() as $synonyme) {

                // Si le synonyme n'est pas encore dans la liste : compteur = 2
                if (!in_array(${$synonyme->getIntitule()}, $resultat)) {
                    ${$synonyme->getIntitule()} = new MotCle($synonyme->getIntitule());
                    array_push($resultat, ${$synonyme->getIntitule()});
                    ${$synonyme->getIntitule()}->setCompteur(2);
                }

                // Sinon, incrémentation du compteur
                else {
                    ${$synonyme->getIntitule()}->incrCompteur();
                }

                // Ajout de chaque synonyme du synonyme dans la liste résultat
                foreach(${$synonyme->getIntitule()}->getSynonymes() as $sousSynonyme) {

                    // Si le sous synonyme n'est pas encore dans la liste : compteur = 1
                    if (!in_array(${$sousSynonyme->getIntitule()}, $resultat)) {
                        ${$sousSynonyme->getIntitule()} = new MotCle($sousSynonyme->getIntitule());
                        array_push($resultat, ${$sousSynonyme->getIntitule()});
                        ${$synonyme->getIntitule()}->setCompteur(1);
                    }

                    // Sinon, incrémentation du compteur
                    else {
                        ${$sousSynonyme->getIntitule()}->incrCompteur();
                    }
                }
            }
        }

        // Tri
        for ($iterateur1 = count($resultat)-2; $iterateur1 >= 0; $iterateur1--) { 
            for ($iterateur2 = 0; $iterateur2 <= $iterateur1; $iterateur2++) { 
                if ($resultat[$iterateur2+1]->getCompteur() > $resultat[$iterateur2]->getCompteur()) {
                    $temp = $resultat[$iterateur2+1];
                    $resultat[$iterateur2+1] = $resultat[$iterateur2];
                    $resultat[$iterateur2] = $temp;
                }
            }
        }

    foreach ($resultat as $mot) {
        print $mot->getIntitule()." ";
        print $mot->getCompteur();
        print "<br>";
    }
    }
?>