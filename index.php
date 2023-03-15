<?php $title="Accueil"; include "modules/head.php"; ?>
<?php $page="index"; include "modules/body/header.php"; ?>
    <main class="index">
        <h2>Accueil</h2>
        <!-- Barre de recherche -->
		<section class="row">
			<div class="col-xs-3 content">
			<form action="index.php" method="POST">
				<input type="search" id="recherche" name="recherche" placeholder="Recherche">
				<select name="categorie" id="categorie" >
					<option value=''>Aucune catégorie</option><?php
					print "\n";
					$listeCategories = getCategories();
					$nombreCategories = count($listeCategories);
					for ($numCategorie = 0; $numCategorie < $nombreCategories; $numCategorie++) {
						$categorie = $listeCategories[$numCategorie];
						print "<option value='$categorie'>$categorie</option>\n";
					}
					?>
				</select>
				<input type="submit" value="Valider" style="vertical-align:top; background:#bdd699; border:1px solid black;" >
			</form>
			</div>
		</section>
		<hr>
		<!-- Publication -->
		<section class="publish" >
			<form>
				<p>Un bien ou un service à proposer ?</p>
				<?php
				if (isset($_SESSION["user"])) {
					print '<a href="publish.php?type=Offre" class="button">Publier une offre</a>';
				}
				else {
					print '<a href="account.php?request=login" class="button">Publier une offre</a>';
				}
				?>
				<p>Vous avez besoin de quelque chose ?</p>
				<?php
				if (isset($_SESSION["user"])) {
					print '<a href="publish.php?type=Demande" class="button">Lancer un appel d'."'".'offres</a>';
				}
				else {
					print '<a href="account.php?request=login" class="button">Lancer un appel d'."'".'offres</a>';
				}
				?>
			</form>
		</section>
		<hr>
		<!-- Articles -->
		<section class="articles align-items-center">
			<form class="text-center">
			<?php
			extract($_POST,EXTR_OVERWRITE);		
			if (isset($recherche) && $recherche != "") {
				foreach (rechercher($recherche, $categorie) as $article) {
					afficherArticle($article);
					print "<br /><br />";
				}
			}
			else {
					if (!isset($_SESSION['user'])) {
						$nombreArticles1 = getNombreArticles();
						if ($nombreArticles1 != 0) {
							print "<p>Derniers articles ($nombreArticles1)</p><br />\n"; // On présente le fait qu'on va mettre les derniers articles publiés en dessous
						$statement = $db->prepare("SELECT Identifiant, Titre, Masque FROM Article WHERE Masque = 0 ORDER BY datePublication DESC"); // On va chercher les titres des articles dans l'ordre décroissant de publication
						$statement->execute();
						}
						else {
							print "<p>Aucun article n'a encore été publié...</p>\n";
						}
					}
					else {
						$nombreArticles2 = getNombreArticleUtilisateurPrecis();
						if ($nombreArticles2 != 0) {
							print "<p>Derniers articles ($nombreArticles2)</p><br />\n"; // On présente le fait qu'on va mettre les derniers articles publiés en dessous
							$statement = $db->prepare("SELECT Identifiant, Titre, Auteur, Masque FROM Article WHERE Auteur != ? AND Masque = 0 ORDER BY datePublication DESC"); // On va chercher les titres des articles dans l'ordre décroissant de publication
							$statement->execute([$_SESSION["user"][0]]);
						}
						else {
							print "<p>Aucun article n'a encore été publié...</p>\n";
						}
					}
				}
					$compteur=0;
					while ($resu= $statement->fetch()){ // On parcourt le résultat et on l'affiche
						$identifiant = $resu['Identifiant'];
						afficherArticle($identifiant);
						print "<br /><br />";
					if ($compteur>=10){
						break;
					}
					$compteur=$compteur+1;
					}


			?>
		</form>
		</section>
    </main>
<?php include "modules/body/footer.php" ?>
