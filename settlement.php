<?php $title="Règlement"; include "modules/head.php"; ?>
<?php $page="settlement"; include "modules/body/header.php";?>
<!-- Main -->  
    <main>
        <h2>Reglement</h2>
        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $statement = $db->prepare('SELECT * FROM Article WHERE identifiant = ?');
            $statement->execute([$id]);
            $article = $statement->fetch();

            $statement = $db->prepare('SELECT * FROM Panier WHERE article = ? AND utilisateur = ?');
            $statement->execute([$id, $_SESSION['user'][0]]);
            $row = $statement->rowCount();

            if ($row != 0) {
                $titre = $article['titre'];
                $moyenPayement = $article['moyenPaiement'];

                print "<a href='article.php?id=" . $id . "'>$titre</a>";
                print "<br /><br />";

                if (strpos($moyenPayement, 'Argent') !== false) {
                    $price = $article['prix'];
                    if ((strpos($moyenPayement, 'Troc') == false) && ($price == 0)) {
                        print "<a href = trade.php?acheteur='false'>Acheter l'article gratuitement</a>";
                    }
                    else {
                        print "L'article peut s'acheter pour $price €";
                        print "<br /><br />";
                        print "<a href=pay.php?prix=$price>Procéder au Paiement</a>";
                        print "<br /><br />";
                    }
                }

                if ($moyenPayement == 'Argent & Troc') {
                    print "Sinon";
                    print "<br /><br />";
                }

                if (strpos($moyenPayement, 'Troc') !== false) {
                    $trade = $article['troc'];
                    print "Voici le troc proposé par le prestatère : $trade ";
                    print "<br /><br />";
                    print "<a href=trade.php?acheteur=false>Procéder au Troc</a>";
                    print "<br /><br />";
                }
            }       
        }
        ?>
    </main>
<?php include "modules/body/footer.php"; ?>