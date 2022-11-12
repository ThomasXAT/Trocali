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
			</ul>
		</nav>
	</header>
	<main>
		<section class="recherche">
			<form action="index.php" method="POST">
				<label for="recherche">Recherche</label>
				<input type="search" id="recherche" name="recherche">
				<input type="submit" value="Valider">
			</form>
		</section>
		<section class="publication">
			<p>Un bien ou un service à proposer ?</p>
			<a href="publier.php"><button>Publier une offre</button></a>
			<p>Vous avez besoin de quelque chose ?</p>
			<button>Lancer un appel d'offres</button>
		</section>
		<section class="articles">
			<p>Articles</p>	
		</section>
	</main>
	<footer>
		<?php print $footer; ?>
	</footer>
</body>
</html>