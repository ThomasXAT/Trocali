<?php $title="Avis"; include "modules/head.php"; ?>
<?php $page="appreciation"; include "modules/body/header.php";?>

<!-- Main -->  
    <main>
        <?php
        include_once "functions.php";
        if (isset($_GET['user'])) {
            $cible = $_GET['user'];
            $utilisateur = $_SESSION['user'][0];
            if ($cible != $utilisateur) {
                print "<h2>Avis</h2>";
                include "modules/body/forms/rating.html";
            }
            if (isset($_POST['validate'])) {
                $note = $_POST['note'];
                $description = $_POST['description'];

                $statement = $db->prepare('INSERT INTO Avis(note, description, redacteur, cible) VALUES(?,?,?,?)');
                $statement->execute([$note, $description, $utilisateur, $cible]);
                $texte=$utilisateur. " vous a mis un avis suite à son échange avec vous!";
                creerNotifs($cible, $texte);
            }
        }
        ?>

    </main>
<?php include "modules/body/footer.php"; ?>