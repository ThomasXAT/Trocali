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
				
				if ($titre != "") {
					$compteur = fopen("compteur.txt", "r+");
					$nombreArticles = fgets($compteur, 255);
					if ($nombreArticles == "") {
						fwrite($compteur, 1);
						$nb = 1;
					}
					else {
						$nombreArticles = intval($nombreArticles);
						$nombreArticles = $nombreArticles + 1;
						file_put_contents("compteur.txt", $nombreArticles);
					}
					fclose($compteur);
					
					$nouvelArticle = new Article($nombreArticles, $titre, true);	
					
					$fichierSauvegarde = fopen("articles.txt", "a+");
					fwrite($fichierSauvegarde, $nouvelArticle->_id."\r\n");
					fwrite($fichierSauvegarde, $nouvelArticle->_titre."\r\n");
					fclose($fichierSauvegarde);
				}
			?>
		</section>
	</main>
	<footer>
	</footer>
<body>
</body>
</html>

