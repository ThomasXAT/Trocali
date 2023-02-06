<?php
include "template.php";
include "articles.php";
html_head("Trocali - Accueil");
html_header();
?>

    <main>
        <h2>Accueil</h2>

        <!-- Barre de recherche -->
		<section>
			<form action="index.php" method="POST">
				<input type="search" id="recherche" name="recherche" placeholder="Recherche">
				<select name="categorie" id="categorie">
					<option value="">Aucune catégorie</option>
					<?php
					$listeCategories = getCategories();
					$nombreCategories = count($listeCategories);
					for ($numCategorie = 0; $numCategorie < $nombreCategories; $numCategorie++) {
						$categorie = $listeCategories[$numCategorie];
						print "<option value=$categorie>$categorie</option>\n";
					}
					?>
				</select>
				<input type="submit" value="Valider">
			</form>
		</section>

		<!-- Publication -->
		<section>
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
		<section>
			<?php
			extract($_POST,EXTR_OVERWRITE);		
			if (isset($recherche) && $recherche != "") {
				$motsCles = trouverMotsCles($recherche);
				print "<p>Articles correspondants à votre recherche : ".$recherche."</p>";

				$traitement = rechercher((trouverSynonymes($motsCles)), $categorie);
				if (empty($traitement)) {
					print "<p>Aucun article ne correspond à votre recherche...</p>";
				}
				else {
					print "<br />";
					foreach ($traitement as $article) {
						$article->afficher();
					}
				}
			}
			else {
				$nombreArticles = getNombreArticles();
				if ($nombreArticles != 0) {
					print "<p>Derniers articles ($nombreArticles)</p><br />";
					for ($id = $nombreArticles; $id > 0; $id--) {
						print "ok";
					}
				}
				else {
					print "<p>Aucun article n'a encore été publié...</p>";
				}
			}
			?>
		</section>
    </main>

<?php
html_footer();
?>
