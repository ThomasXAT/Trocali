<!DOCTYPE html>
<?php 
include 'website.php'; 
include 'database.php';
?>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width-device-width, initial-scale=0.1">
	<title>Trocali - Accueil</title>
</head>
<body>
	<?php print $header; ?>
	<main>
		<!-- Barre de recherche -->
		<section>
			<form action="index.php" method="POST">
				<input type="search" id="recherche" name="recherche" placeholder="Recherche">
				<select name="categorie" id="categorie">
					<option value="">Aucune catégorie</option>
					<?php
					$listeCategories = getCategories();
					$nombreCategories = count($listeCategories);
					for ($numCategorie = 0; $numCategorie < $nombreCategories; $numCategorie++) {
						$categorie = $listeCategories[$numCategorie];
						print "<option value=$categorie>$categorie</option>";
					}
					?>
				</select>
				<input type="submit" value="Valider">
			</form>
		</section>
		<!-- Publication -->
		<section>
			<form action="publish.php" method="POST">
				<p>Un bien ou un service à proposer ?</p>
				<input type="submit" name="offre" value="Publier une offre" />
				<p>Vous avez besoin de quelque chose ?</p>
				<input type="submit" name="demande" value="Lancer un appel d'offres" />
			</form>
		</section>
		<!-- Articles -->
		<section>
			<?php
			extract($_POST,EXTR_OVERWRITE);		
			if (isset($recherche) && $recherche != "") {
				$motsCles = trouverMotsCles($recherche);
				print "<h2>Articles correspondants à votre recherche : ".$recherche."</h2>";

				$traitement = rechercher((trouverSynonymes($motsCles)), $categorie);
				if (empty($traitement)) {
					print "<p>Aucun article ne correspond à votre recherche...</p>";
				}
				else {
					print "<br />";
					foreach ($traitement as $article) {
						$article->afficher();
					}
				}
			}
			else {
				$nombreArticles = getNombreArticles($database);
				if ($nombreArticles != 0) {
					print "<h2>Derniers articles ($nombreArticles)</h2><br />\n";
					$statement = $database->query("SELECT identifiant, titre, type, categorie, description FROM Article");
					while ($row = $statement->fetch()) {
						print "				<article>\n";
						print "					<h3>".$row['titre']."</h3>\n";
						print "					<p>".$row['type']."</p>\n";
						print "					<p>".$row['categorie']."</p>\n";
						print "					<p>".$row['description']."</p>\n";
						print "					<p>"."auteur"."</p>\n";
						print "				<article>\n";
					
					}
				}
				else {
					print "<h2>Aucun article n'a encore été publié...</h2>";
				}
			}
			?>
		</section>
	</main>
	<?php print $footer; ?>
</body>
</html>