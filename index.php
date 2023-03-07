<?php $title="Accueil"; include "modules/head.php"; ?>
<?php $page="index"; include "modules/body/header.php"; ?>
    <main class="index">
        <h2>Accueil</h2>
        <!-- Barre de recherche -->
		<section class="search">
			<form action="index.php" method="POST">
				<input type="search" id="recherche" name="recherche" placeholder="Recherche">
				<select name="categorie" id="categorie">
					<option value=''>Aucune catégorie</option><?php
					print "\n";
					$listeCategories = getCategories();
					$nombreCategories = count($listeCategories);
					for ($numCategorie = 0; $numCategorie < $nombreCategories; $numCategorie++) {
						$categorie = $listeCategories[$numCategorie];
print "					<option value='$categorie'>$categorie</option>\n";
					}
					?>
				</select>
				<input type="submit" value="Valider">
			</form>
		</section>
		<!-- Publication -->
		<section class="publish">
			<p>Un bien ou un service à proposer ?</p>
			<?php
			if (isset($_SESSION["user"])) {
				print '<a href="publish.php?type=Offre">';
			}
			else {
				print '<a href="account.php?request=login">';
			}
			?><input type="submit" name="offre" value="Publier une offre" /></a>
			<p>Vous avez besoin de quelque chose ?</p>
			<?php
			if (isset($_SESSION["user"])) {
				print '<a href="publish.php?type=Demande">';
			}
			else {
				print '<a href="account.php?request=login">';
			}
			?><input type="submit" name="demande" value="Lancer un appel d'offres" /></a>
		</section>
		<!-- Articles -->
		<section class="articles">
			<?php
			extract($_POST,EXTR_OVERWRITE);		
			if (isset($recherche) && $recherche != "") {
				foreach (rechercher($recherche, $categorie) as $article) {
					afficherArticle($article);
				}
			}
			else {
				$nombreArticles = getNombreArticles();
				if ($nombreArticles != 0) {
					print "<p>Derniers articles ($nombreArticles)</p><br />\n"; // On présente le fait qu'on va mettre les derniers articles publiés en dessous
					$statement = $db->prepare("SELECT Identifiant, Titre FROM Article ORDER BY datePublication DESC"); // On va chercher les titres des articles dans l'ordre décroissant de publication
					$statement->execute();
					while ($resu= $statement->fetch()){ // On parcourt le résultat et on l'affiche
						$identifiant = $resu['Identifiant'];
						$article = $resu['Titre'];
						afficherArticle($identifiant);
						print "<br /><br />";
					}
				}
				else {
					print "<p>Aucun article n'a encore été publié...</p>\n";
				}
			}
			?>
		</section>
    </main>
<?php include "modules/body/footer.php"; ?>
