<?php $title="Reglement"; include "modules/head.php"; ?>
<?php $page="pay"; include "modules/body/header.php";?>
<!-- Main -->  
    <main>
        <h2>Mon panier</h2>
        <?php
        if (isset($_SESSION['user'])) {
            $statement = $db->prepare("SELECT * From Panier WHERE utilisateur = ?");
            $statement->execute([$_SESSION["user"][0]]);

            $row = $statement->rowCount();
            if ($row == 0) {
                print "<p>Votre panier est vide</p>";
                print "<a href='index.php'>Trouver des articles</a>";
            } else {
                while ($result = $statement->fetch()) { // On parcourt le résultat et on l'affiche
                    $article = $db->prepare("SELECT identifiant, titre FROM Article WHERE identifiant = ?");
                    $article->execute([$result['article']]);
                    $articleFetch = $article->fetch();

                    $identifiant = $articleFetch['identifiant'];
                    afficherArticle($identifiant, true);
                    print "<br /><br />";
                }
            }
        }
        
        ?>
    </main>
<?php include "modules/body/footer.php"; ?>

