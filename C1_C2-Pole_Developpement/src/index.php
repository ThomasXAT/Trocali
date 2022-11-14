<!DOCTYPE html>
<?php 
	include 'article.php';
	include 'infos.php';
?>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width-device-width, initial-scale=0.1">

	<link rel="stylesheet" href="style.css">
	<title>Trocali - Accueil</title>
</head>
<body>
	<header>
		<h1>Trocali</h1>
		<nav>
			<ul>
				<li><a href="index.php">Accueil</i><a></li>
				<li><a href="clear.php">Supprimer les articles</i><a></li>
			</ul>
		</nav>
	</header>
	<main>
		<section class="recherche">
			<form action="index.php" method="POST">
				<input class="saisie" type="search" id="recherche" name="recherche" placeholder="Recherche">
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
				<input class ="valider" type="submit" value="Valider">
			</form>
		</section>
		<section class="publication">
			<form action="publier.php" method="POST">
				<p>Un bien ou un service à proposer ?</p>
				<input type="submit" name="offre" value="Publier une offre" />
				<p>Vous avez besoin de quelque chose ?</p>
				<input type="submit" name="demande" value="Lancer un appel d'offres" />
			</form>
		</section>
		<section class="articles">
			<?php
				//print getDicSynonymes()["à"]["Articles"][0];
				extract($_POST,EXTR_OVERWRITE);		
				if (isset($recherche) && $recherche != "") {
					print "<p>Articles correspondants à votre recherche :</p><br />";
					$motsClesRecherche = findMotsCles($recherche);
					print arrayToString($motsClesRecherche)." ".$categorie;
				}
				else {
					$nombreArticles = getNombreArticles();
					if ($nombreArticles != 0) {
						print "<p>Derniers articles</p><br />";
						for ($id = $nombreArticles; $id > 0; $id--) {
							$article = importer($id);
							$article->afficher(true);
						}
					}
					else {
						print "<p>Aucun article n'a encore été publié...</p>";
					}
				}
			?>
		</section>
	</main>
	<footer>
		<?php print $footer; ?>
	</footer>
</body>
</html>