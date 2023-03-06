<?php $title="Troc"; include "modules/head.php"; ?>
<?php $page="settlement"; include "modules/body/header.php";?>
<!-- Main -->  
    <main>
        <h2>Troc</h2>
        <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];    
                $statement = $db->prepare('SELECT * FROM Article WHERE identifiant = ?');
                $statement->execute([$id]);
                $row = $statement->rowCount();

                if ($row != 0) {
                    $article = $statement->fetch();

                    print "
                    <p>Une notification a été envoyée à l'utilisateur pour qu'il confirme le troc</p>
                    <a href='index.php'>Retourner à l'accueil</a>
                    <a href='appreciation.php?".$article['auteur']."'>Laisser un avis</a>";
                }
            }
        ?>
    </main>
<?php include "modules/body/footer.php"; ?>