<!DOCTYPE html>
<html lang="fr">
<?php include 'article.php';?>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width-device-width, initial-scale=0.1">
	<title>Trocali - Publier un article</title>
</head>
	<header>
		<h1>Trocali</h1>
		<h2>Publier un article<h2>
		<nav>
			<ul>
				<li><a href="index.php">Accueil<a></li>
				<li><a href="publier.php">Publier un article<a></li>
			</ul>
		</nav>
	</header>
	<main>
		<form action="valider.php" method="POST">
			<label for="titre">Titre</label>
			<input type="text" id="titre" name="titre">
			<input type="submit" value="Valider">
		</form>

	</main>
	<footer>
	</footer>
<body>
</body>
</html>