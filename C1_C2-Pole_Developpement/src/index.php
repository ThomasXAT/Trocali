<!DOCTYPE html>

<?php 
	include 'website.php';
	include_once 'motCle.php';
	include_once 'article.php';

	/*foreach (getListeMots() as $mot) {
		print $mot."<br>";
	}*/
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
	<?php print $header; ?>
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
				extract($_POST,EXTR_OVERWRITE);		
				if (isset($recherche) && $recherche != "") {
	           		$motsCles = trouverMotsCles($recherche);
					print "<p>Articles correspondants à votre recherche : ".$recherche."</p><br />";

	            	foreach (rechercher((trouverSynonymes($motsCles)), $categorie) as $article) {
						$article->afficher();
					}
				}
				else {
					$nombreArticles = getNombreArticles();
					if ($nombreArticles != 0) {
						print "<p>Derniers articles ($nombreArticles)</p><br />";
						for ($id = $nombreArticles; $id > 0; $id--) {
							$article = importer($id);
							$article->afficher();
						}
					}
					else {
						print "<p>Aucun article n'a encore été publié...</p>";
					}
				}

				$listeTest = array();
				$voiture = new MotCle("voiture", INF);
				$bagnole = new MotCle("bagnole", 3);
				$cours = new MotCle("cours", INF);
				array_push($listeTest, $voiture);
				array_push($listeTest, $bagnole);
				array_push($listeTest, $cours);


			//print_r(recupererArticlesTries($listeTest));
			?>
		</section>
		<?php print $newsletter; ?>
	</main>
	<footer>
		<?php print $footer; ?>
	</footer>
</body>
</html>