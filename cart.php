<?php $title="Mon panier"; include "modules/head.php"; ?>
<?php $page="cart"; include "modules/body/header.php";?>
<!-- Main -->  
    <main>
        <h2>Mon panier</h2>
        <?php
        $statement = $db->prepare("SELECT * From Panier WHERE utilisateur = ?");
        $statement->execute([$_SESSION["user"][0]]);
        
        $row = $statement->rowCount();
        if ($row == 0) {
            print "<p>Votre panier est vide</p>";
            print "<a href='index.php'>Trouver des articles</a>";
        }
        else {
            while ($result= $statement->fetch()){ // On parcourt le résultat et on l'affiche
                $article = $db->prepare("SELECT identifiant, titre FROM Article WHERE identifiant = ?");
                $article->execute([$result['article']]);
                $articleFetch = $article->fetch();
            
                $identifiant = $articleFetch['identifiant'];
                $titre = $articleFetch['titre'];
                
                print "<a href='article.php?id=".$identifiant."'>$titre</a>";
                print "<button href='#'>Regler l'article</button>";
                print "<br /><br />";

            }
        }
        ?>
    </main>
<?php include "modules/body/footer.php"; ?>

