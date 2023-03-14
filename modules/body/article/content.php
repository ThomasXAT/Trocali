<main>
		<section>
            <article class="articleComplet">
                <h2><?php print "$type"; ?> : <?php print "$title"; ?></h2>
                <p id="auteur">Auteur : <?php print "$writer"; ?></p>
                <p id="date">Date de publication : <?php print "$publicationDate"; ?></p>
                <p id="categorie"><?php print "$category"; ?></p>
                <p id="description">Description : <?php print "$description"; ?></p>
                <p id="moyenPayement">Moyen de payement : <?php print "$means"; ?></p>
                <p id="prix">Prix : <?php print "$price"; ?>€</p>
                <p id="troc">Modalités de troc : <?php print "$barter"; ?></p>
                <div class="listeImage">
                    <p> Images : </p>
                    <?php
                    foreach ($images as $image) {
                        print "<img src='./".$image["lien"]."' width='20%' />\n";
                    }
                    ?>
                </div>
                <?php
                if (isset($_SESSION["user"])) {
                    if (($_SESSION["user"][0] == $writer) || ($_SESSION["user"][2] == 1)) {
                        print "<a href='data/article.php?id=$id&delete=true' id='modif'>Supprimer cet article</a>\n";
                    }
                    else {
                        $statement = $db->prepare("SELECT * FROM Panier WHERE article = ? AND utilisateur = ?");
                        $statement->execute([$id, $_SESSION["user"][0]]);
                        $row = $statement->rowCount();
                        $id = $_GET["id"];
                        if ($row == 0) {
                            print "<a href='data/article.php?id=$id&cart=add' id='modif'>Ajouter au panier</a>\n";
                        }
                        else {
                            print "<a href='data/article.php?id=$id&cart=remove' id='modif'>Retirer du panier</a>\n";
                        }
                    }
                }
                else {
                    print "<a href='account.php' id='modif'>Ajouter au panier</a>\n";
                }
                ?>
            </article>
		</section>
	</main>