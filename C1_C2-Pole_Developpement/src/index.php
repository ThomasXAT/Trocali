<!DOCTYPE html>

<?php 
	include 'article.php';
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

	<?php
		include 'header.php'
	?>
	
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
	           		$motsCles = findMotsCles($recherche);
					print "<p>Articles correspondants à votre recherche : ".$recherche."</p><br />";
					if (!empty(rechercher($motsCles, $categorie))) {
						foreach (rechercher($motsCles, $categorie) as $article) {
							$article->afficher();
						}
					}
					else {
						print "<p>Aucun article ne correspond à votre recherche...</p>";
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
			?>
		</section>
		<section class="newsletter">
			<h2>Inscrivez-vous à notre formulaire de News Letter</h2>	
			<form  action="main.php" method="POST" > 
				<input class="email" type="email" name="mail"  placeholder="Votre adresse email" class = "email"><br />
				<input class="case" type="checkbox" name="condition_util"><span>J'ai pris connaissance de la Politique de confidentialité</span><br />
				<input class="case" type="checkbox" name="recevoir_mail"><span>J'accepte de recevoir des mails publicitaires</span><br>

				<p> Vous pouvez vous désinscrire à tout moment à l'aide des liens de désincription ou en nous contactant sur contact@trocali.com </p>

				<input class="valider" type="submit" value="Confirmer">
			</form>
		</section>
	</main>
	<footer>
		<?php print $footer; ?>
	</footer>
</body>
</html>