<?php $title="Article"; include "modules/head.php"; ?>
<?php $page="article"; include "modules/body/header.php"; ?>
<?php
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $statement = $db->prepare("SELECT * FROM Article WHERE identifiant = ?");
    $statement->execute([$id]);
    $result = $statement->fetch();

    $title = $result['titre'];
    $type = $result['type'];
    $category = $result['categorie'];
    $description = $result['description'];
    $means = $result['moyenPaiement'];
    $price = $result['prix'];
    $barter = $result['troc'];
    $writer = $result['auteur'];
    $publicationDate = $result['datePublication'];

    $statement = $db->prepare("SELECT lien FROM Photo WHERE article = ?");
    $statement->execute([$id]);
    $images = array();
    while ($result = $statement->fetch()) {
        array_push($images, $result['lien']);
    }
}
?>
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
                    print "<img src='images/".$image."' width='20%' />\n";
                }
                if (isset($_SESSION["user"])) {
                    if ($_SESSION["user"][0] == $writer) {
                        print "<a href='data/article.php?id=$id&delete=true'>Supprimer cet article</a>\n";
                    }
                    else {
                        $statement = $db->prepare("SELECT * FROM Panier WHERE idArticle = ? AND idUtilisateur = ?");
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
<?php include "modules/body/footer.php"; ?>