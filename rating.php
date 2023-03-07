<?php $title="Avis"; include "modules/head.php"; ?>
<?php $page="appreciation"; include "modules/body/header.php";?>
<!-- Main -->  
    <main>
        <?php
        if (isset($_GET['user'])) {
            $cible = $_GET['user'];
            $utilisateur = $_SESSION['user'][0];
            if ($cible != $utilisateur) {
                print "<h2>Avis</h2>";
                include "modules/body/rating/form.html";
            }
            if (isset($_POST['validate'])) {
                $note = $_POST['note'];
                $description = $_POST['description'];

                $statement = $db->prepare('INSERT INTO Avis(note, description, redacteur, cible) VALUES(?,?,?,?)');
                $statement->execute([$note, $description, $utilisateur, $cible]);
            }
        }
        ?>

    </main>
<?php include "modules/body/footer.php"; ?>