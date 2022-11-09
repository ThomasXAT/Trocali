<!DOCTYPE html>
<html lang="fr">
<?php 
	include 'article.php';
	$ligne = 0;
	$articles = fopen("articles.txt", "r");
	
	while (!feof($articles)) {
		$ligne++;
		$valeur = fgets($articles, 4096); 
		if ($valeur != ""){ 
			if ($ligne % 2 != 0) {
				$valeur = intval($valeur);
				${"article$valeur"} = new Article($valeur, "temp", false);
				$idArticle = $valeur;
			}
			else {
				${"article$idArticle"}->setTitre($valeur);
			}
		}
	}
	fclose($articles);
?>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width-device-width, initial-scale=0.1">
	<title>Trocali - Accueil</title>
</head>
	<header>
		<h1>Trocali</h1>
		<h2>Accueil<h2>
		<nav>
			<ul>
				<li><a href="index.php">Accueil<a></li>
				<li><a href="publier.php">Publier un article<a></li>
			</ul>
		</nav>
	</header>
	<main>
		<?php 
			$recherche = "";
		?>
		<form action="index.php" method="POST">
			<label for="recherche">Recherche</label>
			<input type="search" id="recherche" name="recherche">
			<input type="submit" value="Valider">
		</form>
		<section class="articles">
			<?php 
				extract($_POST,EXTR_OVERWRITE);
				print $recherche.'<P>';
			?>
		</section>
	</main>
	<footer>
	</footer>
<body>
</body>
</html>