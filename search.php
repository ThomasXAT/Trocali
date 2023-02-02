<?php
include 'database.php';
function trouverMotsCles($chaine) {
    $chaine = strtolower($chaine);
    $delimiteurs = " .!?,:;(){}[]%-$'/\_"; 
    $listeMotsCles = array(); 
    $mot = strtok($chaine, $delimiteurs);
    while ($mot != "") {
        if ($database->query("SELECT COUNT(identifiant) FROM Article")) {
            $motCle = new Mot($mot);
            if (!in_array($motCle, $listeMotsCles)) {
                array_push($listeMotsCles, $motCle);
            }
        }
        elseif (existe(testerSingulier($mot))) {
            $motCle = new Mot(testerSingulier($mot));
            if (!in_array($motCle, $listeMotsCles)) {
                array_push($listeMotsCles, $motCle);
            }
        }
        $mot = strtok($delimiteurs);
    }
    return $listeMotsCles; 
}

function existe($mot) {
    return in_array($mot, getListeMots());
}

foreach (getListeMots() as $mot) {
    ${$mot} = new Mot($mot);
    ${$mot}->genererSynonymes();
}
?>