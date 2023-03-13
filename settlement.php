<?php 
if (!isset($_GET["id"])) {
    header("Location: index.php");
}
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: account.php");
}
session_abort();

$title="Reglement"; include "modules/head.php";
$page="settlement"; include "modules/body/header.php";
?>
<!-- Main -->  
    <main>
        <h2>Reglement</h2>
        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $_SESSION['current_article'] = $id;

            $statement = $db->prepare('SELECT * FROM Article WHERE identifiant = ?');
            $statement->execute([$id]);
            $article = $statement->fetch();

            $statement = $db->prepare('SELECT * FROM Panier WHERE article = ? AND utilisateur = ?');
            $statement->execute([$id, $_SESSION['user'][0]]);
            $row = $statement->rowCount();

            if ($row != 0) {
                $_SESSION['current_article'] = $id;

                $titre = $article['titre'];
                $moyenPaiement = $article['moyenPaiement'];

                print "<a href='article.php?id=" . $id . "'>$titre</a>";
                print "<br /><br />";

                if (strpos($moyenPaiement, 'Argent') !== false) {
                    $price = $article['prix'];
                    if ((strpos($moyenPaiement, 'Troc') == false) && ($price == 0)) {
                        print "<a href = trade.php>Obtenir l'article gratuitement</a>";
                    }
                    else {
                        print "L'article peut s'acheter pour $price €";
                        print "<br /><br />";
                        print "<a href=pay.php>Procéder au Paiement</a>";
                        print "<br /><br />";
                    }
                }

                if ($moyenPaiement == 'Argent & Troc') {
                    print "Sinon";
                    print "<br /><br />";
                }

                if (strpos($moyenPaiement, 'Troc') !== false) {
                    $trade = $article['troc'];
                    print "Voici le troc proposé par le prestatère : $trade ";
                    print "<br /><br />";
                    print "<a href=trade.php>Procéder au Troc</a>";
                    print "<br /><br />";
                }
            }
            else {
                print "<p>Cet article ne figure pas dans votre panier.</p>";
                print "<a href='index.php'>Trouver des articles à ajouter à mon panier";
            }     
        }
        ?>
    </main>
<?php include "modules/body/footer.php"; ?>