<main>
		<section>
            <article class="articleComplet">
                <h2><?php print "$title"; ?> (<?php print "$type"; $id = $_GET["id"];?>)</h2>
                <?php
                print("<a href='./user.php?id=$id'id='auteur'>Auteur : $writer</a>")
                ?>
                <p id="date">Date de publication : <?php print "$publicationDate"; ?></p>
                <p id="categorie"><?php print "$category"; ?></p>
                <p id="description">Description : <?php print "$description"; ?></p>
                <p id="moyenPayement">Moyen de payement : <?php print "$means"; ?></p>
                <?php if ($price == null) {$price = 0;}; ?>
                <p id="prix">Prix : <?php print "$price"; ?>€</p>
                <?php if ($barter == null) {$barter = "Indisponible";}; ?>
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