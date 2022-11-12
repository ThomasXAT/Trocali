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
		<section>
			<form action="valider.php" method="POST">
				<label for="titre">Titre</label>
				<input type="text" id="titre" name="titre">
				<input type="submit" value="Valider">
			</form>
		</section>
	</main>
	<footer>
		<?php print $footer; ?>
	</footer>
</body>
</html>