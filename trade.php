<?php 
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: account.php");
}
session_abort();

$title="Troc"; include "modules/head.php"; 
$page="settlement"; include "modules/body/header.php";
?>
<!-- Main -->  
    <main>
        <h2>Troc</h2>
        <?php
            if (isset($_SESSION['current_article'])) {
                $id = $_SESSION['current_article'];


                $statement = $db->prepare('SELECT * FROM Article WHERE identifiant = ?');
                $statement->execute([$id]);
                $article = $statement->fetch();
                $moyenPaiement = $article['moyenPaiement'];
                $price = $article['prix'];

                if ((strpos($moyenPaiement, 'Argent') !== false) && ($price != 0) && !(isset($_POST['payed'])) && (strpos($moyenPaiement, 'Troc') !== false)) {
                    print "<p>Vous devez d'abbord payer cet article</p>";
                    print "<a href='pay.php'>Payer l'article";
                }
                else {
                    reglerArticle($id, $_SESSION['user'][0]);

                    print "
                    <p>Nous vous remercions pour votre transaction</p>
                    <p>Une notification a été envoyée à l'utilisateur pour lui confirmer l'échange</p>
                    <a href='index.php'>Retourner à l'accueil</a>
                    <a href='rating.php?user=".$article['auteur']."'>Laisser un avis sur l'auteur de l'article</a>";
                }
            }
            else {
                print "<p>Vous n'avez pas de transaction en cours</p>";
                print "<a href='index.php'>Trouver des articles à ajouter à mon panier";
            }
        ?>
    </main>
<?php include "modules/body/footer.php"; ?>