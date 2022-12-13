<!DOCTYPE html>
<?php 
	include 'article.php';
?>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width-device-width, initial-scale=0.1">

	<link rel="stylesheet" href="style.css">
	<title>Trocali - Publier un article</title>
</head>
<body>
	<?php print $header; ?>
	<main>
		<section class="titre">
			<?php
				extract($_POST,EXTR_OVERWRITE);		
				if (isset($offre)) {
					print "<h2>Publier une offre</h2>";
				}
				else {
					print "<h2>Lancer un appel d'offres</h2>";
				}
			?>
		</section>
		<section class="saisieInfosArticles">
			<form action="valider.php" method="POST">
				<div>
					<input type="text" class="titre" id="titre" name="titre" placeholder="Titre de l'article">
					<select class="categorie" name="categorie" id="categorie">
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
				</div>
				<div>
					<textarea class="description" id="description" name="description" rows="4" cols="50" placeholder="Description..."></textarea>
				</div>
				<div>
					<?php
						if (isset($offre)) {
							print '<input class="valider" type="submit" name="offre" value="Valider">';
						}
						else {
							print '<input class="valider" type="submit" name="demande" value="Valider">';
						}
					?>
				</div>

			</form>
		</section>
	</main>
	<footer>
		<?php print $footer; ?>
	</footer>
</body>
</html>