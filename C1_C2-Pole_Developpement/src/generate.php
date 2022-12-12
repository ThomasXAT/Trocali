<?php
    include "article.php";

    // Articles à générer
    publier("Je vends ma voiture", "Offre", "Automobile", "Ma voiture est quasiment neuve.");
    publier("Je donne des cours de mathématiques", "Offre", "Enseignement", "Je suis fort en mathématiques.");
    publier("Je cherche des voitures", "Demande", "Automobile", "Je cherche une voiture d'occasion.");
    publier("Cherche cours informatique", "Demande", "Informatique", "Je souhaiterais recevoir des cours d'informatique.");
    publier("Vente cash bagnoles d'occasion", "Offre", "Informatique", "Ici a vente flash cash on vend des bagnoles pas cher peuchère.");
    publier("Recherche automobile", "Demande", "Automobile", "Je souhaiterais acheter une automobile rapide et en bon état.");
    publier("Location fourgon sur le Béarn", "Offre", "Automobile", "Je loue des fourgon à ceux qui veulent sur le Béarn.");
    publier("Location de véchicule sur Cauterets", "Demande", "Automobile", "J'aimerais louer un véhicule pour pouvoir aller au travail car je ne peux pas traverser les montagnes.");
    publier("Cherche chariots en quantité", "Demande", "", "Il me faut des chariots en quantité pour pouvoir prendre la terre retournée par mon neveu!");
    publier("Vente d'un car 56 places", "Offre", "Automobile", "Je cherche un acheteur pour un car de compèt qui a fait la guerre du vietnam.");
    publier("Vente de ma très chère cabriolet ferrari", "Offre", "Automobile", "Je souhaiterais me séparer de ma très chère cabriolet ferrari car j'en veux une neuve.");
    publier("Leçons de code de la route ", "Offre", "Enseignement", "J'offre des leçons de code pour ceux qui veulent.");
    publier("Ventes de place pour un séminaire d'enseignement au conservatoire de Toulouse-Matabiau", "Offre", "Enseignement", "Ventes de places pour assister au séminaire du fameux professeur Carpentier.");
    publier("Cherche places pour accéder au monde digital", "Demande", "Informatique", "J'aimerai acheter des places pour accéder au monde digital afin d'accéder au futur.");
    publier("Cherche générateur de monnaie numérique ", "Demande", "Informatique", "Je veux faire de la monnaie numérique mais je ne sais pas comment le faire. il y a un générateur?");
    publier("Cherche cours informatique", "Demande", "Informatique", "Je souhaiterais recevoir des cours d'informatique.");
    publier("Vente de logiciels de bureautiques Offices à bas prix", "Offre", "Informatique", "Je revends mes licenses de Offices que j'ai en trop.");
    publier("Cherche ingégnieur en robotique", "Demande", "Informatique", "Je cherche un ingégnieur en robotique pour m'aider à faire mon projet.");
    publier("Cherche cours informatique", "Demande", "Informatique", "Je souhaiterais recevoir des cours d'informatique.");
    // Retour à la page d'accueil
    header("Location:index.php");
?>