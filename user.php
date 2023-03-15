<?php 
$title="Utilisateur"; include "modules/head.php"; 
$page="user"; include "modules/body/header.php";?>
<!-- Main -->  
<?php
$id=$_GET["id"];
?>
    <main>
        <h2><?php $utilisateurCible = getAuteur($id); print($utilisateurCible); ?></h2>
        <p>Moyenne : <?php  print(getMoyenneAvis($utilisateurCible));?>/10</p>
        <p> Nombre d'avis : <?php $nbAvis=getNombreAvis($utilisateurCible); print($nbAvis);?> </p>
        <?php 	
            if ($nbAvis != 0) {
                print "<p>Derniers avis ($nbAvis)</p><br />\n"; // On présente le fait qu'on va mettre les derniers avis publiés en dessous
                $statement = $db->prepare("SELECT identifiant FROM Avis WHERE cible = ? ORDER BY datePublication DESC"); // On va chercher les titres des articles dans l'ordre décroissant de publication
                $statement->execute([$utilisateurCible]);
                while ($resu= $statement->fetch()){ // On parcourt le résultat et on l'affiche
                    $identifiant = $resu['identifiant'];
                    afficherAvis($identifiant);
                    print "<br /><br />";
                }
            }
            else {
                print "<p>Aucun avis n'a encore été publié...</p>\n";
            }


            $nombreArticles = getNombreArticleUtilisateurPrecisV($utilisateurCible);
				if ($nombreArticles != 0) {
					print "<p>Derniers articles ($nombreArticles)</p><br />\n"; // On présente le fait qu'on va mettre les derniers articles publiés en dessous
					$statement = $db->prepare("SELECT Identifiant, Titre FROM Article WHERE auteur= ? ORDER BY datePublication DESC"); // On va chercher les titres des articles dans l'ordre décroissant de publication
					$statement->execute([$utilisateurCible]);
					$compteur=0;
					while ($resu= $statement->fetch()){ // On parcourt le résultat et on l'affiche
						$identifiant = $resu['Identifiant'];
						afficherArticle($identifiant);
						print "<br /><br />";
					if ($compteur>=10){
						break;
					}
					$compteur=$compteur+1;
					}
				}
				else {
					print "<p>Aucun article n'a encore été publié par cet utilisateur</p>\n";
				}
                ?>
    </main>
<?php include "modules/body/footer.php"; ?>

