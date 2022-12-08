<?php
    include "article.php";

    publier("Je vends ma voiture", "Offre", "Automobile", "Ma voiture est quasiment neuve.");
    publier("Je donne des cours de mathématiques", "Offre", "Enseignement", "Je suis fort en mathématiques.");
    publier("Je cherche des voitures", "Demande", "Automobile", "Je cherche une voiture d'occasion.");
    publier("Cherche cours informatique", "Demande", "Informatique", "Je souhaiterais recevoir des cours d'informatique.");

    header("Location:index.php");
?>