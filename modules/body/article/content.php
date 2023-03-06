<main>
		<section>
            <article>
                <h2><?php print "$title"; ?></h2>
                <p><?php print "$writer"; ?></p>
                <p><?php print "$publicationDate"; ?></p>
                <p><?php print "$type"; ?></p>
                <p><?php print "$category"; ?></p>
                <p><?php print "$description"; ?></p>
                <p><?php print "$means"; ?></p>
                <p><?php print "$price"; ?></p>
                <p><?php print "$barter"; ?></p>
                <?php 
                foreach ($images as $image) {
                    print "<img src='.$image.' width='20%' />\n";
                }
                if (isset($_SESSION["user"])) {
                    if (($_SESSION["user"][0] == $writer) || ($_SESSION["user"][2] == 1)) {
                        print "<a href='data/article.php?id=$id&delete=true'>Supprimer cet article</a>\n";
                    }
                    else {
                        $statement = $db->prepare("SELECT * FROM Panier WHERE article = ? AND utilisateur = ?");
                        $statement->execute([$id, $_SESSION["user"][0]]);
                        $row = $statement->rowCount();
                        if ($row == 0) {
                            print "<a href='data/article.php?id=$id&cart=add'>Ajouter au panier</a>\n";
                        }
                        else {
                            print "<a href='data/article.php?id=$id&cart=remove'>Retirer du panier</a>\n";
                        }
                    }
                }
                ?>
            </article>
		</section>
	</main>