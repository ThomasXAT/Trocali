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
	<title>Trocali - Publier un article</title>
</head>
<body>
	<header>
	<h1>Trocali</h1>
		<nav>
			<ul>
				<li><a href="index.php">Accueil<a></li>
			</ul>
		</nav>
	</header>
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
					<label for="titre">Titre</label>
					<input type="text" id="titre" name="titre">
				</div>
				<div>
					<?php
						if (isset($offre)) {
							print '<input type="submit" name="offre" "value="Valider offre">';
						}
						else {
							print '<input type="submit" name="demande" "value="Valider demande">';
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