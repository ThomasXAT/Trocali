<?php $title="Publier un article"; include "modules/head.php"; ?>
<?php $page="publish"; include "modules/body/header.php"; ?>
<!-- Main -->  
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
				<h3>Caractéristiques</h3>

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
					<textarea id="description" name="description" rows="4" cols="50" placeholder="Description"></textarea>
				</div>
				<h3>Images</h3>
				<div>
					<input type="file" id="images" name="images[]" accept="image/*" multiple />
				</div>
				<h3>Moyens de paiement</h3>
				<div>
					<input type="number" id="price" name="price" placeholder="Prix">
				</div>
				<div>
					<textarea id="barter" name="barter" rows="4" cols="50" placeholder="Modalités de troc"></textarea>
				</div>
				<div>
					<?php
					if ($type == "Offre") {
						print '<input type="submit" name="offre" value="Valider">';
					}
					else {
						print '<input type="submit" name="demande" value="Valider">';
					}
					if (isset($error)) {
						if ($error == 'title') {
							print '<p class = "error">Pas de titre</p>';
						}
						if ($error == 'images') {
							print '<p class = "error">Veuillez ne pas mettre plus de 8 images</p>';
						}
					}
					?>
				</div>

			</form>
		</section>
	</main>
<?php include "modules/body/footer.php"; ?>