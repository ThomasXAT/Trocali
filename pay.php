<?php 
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: account.php");
}
session_abort();

$title="Paiement"; include "modules/head.php"; 
$page="pay"; include "modules/body/header.php";?>
<!-- Main -->  
    <main>
        <h2>Paiement</h2>
        <?php
            if (isset($_SESSION['current_article'])) {
                $id = $_SESSION['current_article'];    
                $statement = $db->prepare('SELECT * FROM Article WHERE identifiant = ?');
                $statement->execute([$id]);
                $article = $statement->fetch();
                $moyenPaiement = $article['moyenPaiement'];
                $price = $article['prix'];
                
                if ((strpos($moyenPaiement, 'Argent') !== false) && ($price != 0)) {
                    print '
                    <form method="POST" action="trade.php">
                        <input type="hidden" name="payed">
                        <input type="submit" value="Payer">
                    </form>';
                }
                else {
                    print "Cet article ne peut s'acheter avec de l'argent.";
                    print "<a href='settlement.php?id=$id'>Retourner sur la page de réglement.</a>";
                }

            }
            else {
                print "<p>Vous n'avez pas de transaction en cours.</p>";
                print "<a href='index.php'>Trouver des articles à ajouter à mon panier</a>";
            }
        ?>
        
    </main>
<?php include "modules/body/footer.php"; ?>