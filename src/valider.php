<!DOCTYPE html>
<html lang="fr">
<?php include 'article.php';?>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width-device-width, initial-scale=0.1">
	<title>Trocali - Article publié</title>
</head>
	<header>
		<h1>Trocali</h1>
		<h2>Article publié<h2>
		<nav>
			<ul>
				<li><a href="index.php">Accueil<a></li>
				<li><a href="publier.php">Publier un article<a></li>
			</ul>
		</nav>
	</header>
	<main>
		<section>
			<?php
				extract($_POST,EXTR_OVERWRITE);
				
				$compteur = fopen("compteur.txt", "r+");
				$chaine = fgets($compteur, 255);
				if ($chaine == "") {
					fwrite($compteur, 1);
				}
				else {
					$nb = intval($chaine);
					$nb = $nb + 1;
					file_put_contents("compteur.txt", $nb);
				}
				fclose($compteur);
				
				$monArticle = new Article($nb, $titre);	
				
				
			?>
		</section>
	</main>
	<footer>
	</footer>
<body>
</body>
</html>

