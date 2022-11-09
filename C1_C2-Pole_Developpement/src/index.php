<!DOCTYPE html>
<html lang="fr">





<?php 
	include 'article.php';
	
	// Récupération des articles dans la base de données
	
	$compteur = fopen("compteur.txt", "r+");
	$nombreArticles = fgets($compteur, 255);
	$nombreArticles = intval($nombreArticles);
	fclose($compteur);
	
	$articles = fopen("articles.txt", "r");
	for ($i = 0; $i < $nombreArticles; $i++) {
		
		// Création de l'article avec l'id correspondant
		$id = fgets($articles, 4096); 
		$id = intval($id);
		${"article$id"} = new Article($id, "temp", false);
		$idArticle = $id;

		// Ajout du titre
		$titre = fgets($articles, 4096); 		
		${"article$idArticle"}->setTitre($titre);
		
		// Ajout des mots clés
		$chaineMotsCles = fgets($articles, 4096); 		
		$listeMotsCles = array();
		$motCle = "";
		for ($i = 0; $i < strlen($chaineMotsCles); $i++) {
			if ($chaineMotsCles[$i] != ";") {
				$motCle[strlen($motCle)] = $chaineMotsCles[$i];
			}
			else {
				array_push($listeMotsCles, $motCle);
				$motCle = "";
			}
		}
		array_push($listeMotsCles, $motCle);
		${"article$idArticle"}->setMotsCles($listeMotsCles);
		
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