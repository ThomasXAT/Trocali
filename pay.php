<?php $title="Paiement"; include "modules/head.php"; ?>
<?php $page="pay"; include "modules/body/header.php";?>
<!-- Main -->  
    <main>
        <h2>Payement</h2>
        <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];    
                $statement = $db->prepare('SELECT * FROM Article WHERE identifiant = ?');
                $statement->execute([$id]);
                $row = $statement->rowCount();

                if ($row != 0) {
                    $article = $statement->fetch();

                    print "<a href='rating.php?user=".$article['auteur']."'>Payer</a>";
                }
            }
        ?>
        
    </main>
<?php include "modules/body/footer.php"; ?>