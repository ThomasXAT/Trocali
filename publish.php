<?php
include "template.php";
include "articles.php";
html_head("Trocali - Publier un article");
html_header();
?>

	<main>
		<section>
			<?php
			extract($_GET,EXTR_OVERWRITE);		
			if ($type == "Offre") {
				print "<h2>Publier une offre</h2>";
			}
			else {
				print "<h2>Lancer un appel d'offres</h2>";
			}
			?>
		</section>
		<section>
			<form action="data/validate.php" method="POST" enctype="multipart/form-data">
				<div>
					<input type="text" id="titre" name="titre" placeholder="Titre de l'article">
					<select name="categorie" id="categorie">
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
				</div>
				<div>
					<textarea id="description" name="description" rows="4" cols="50" placeholder="Description..."></textarea>
				</div>
				<div>
					<input type="file" id="images" name="images[]" accept="image/*" multiple />>
				</div>
				<div>
					<?php
					if ($type == "Offre") {
						print '<input type="submit" name="offre" value="Valider">';
					}
					else {
						print '<input type="submit" name="demande" value="Valider">';
					}
					?>
				</div>

			</form>
		</section>
	</main>

<?php
	html_footer();
?>