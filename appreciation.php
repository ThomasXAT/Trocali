<?php $title="Avis"; include "modules/head.php"; ?>
<?php $page="appreciation"; include "modules/body/header.php";?>
<!-- Main -->  
    <main>
        <?php
            if (isset($_GET['utilisateur'])) {
                $utilisateur = $_GET['utilisateur'];
                if ($_SESSION['user'][0] != $utilisateur) {
                    print "
                        <h2>Avis</h2>

                    ";
                }
            }
        ?>
        <form class='avis' method="POST" action="appreciation.php">
            <label>Note</label>
            <input type="text" id="note "pattern="[0,5]">
            <label>Description</label>
            <input type="text" id="descrpition">
            <input type="submit>
        </form>
    </main>
<?php include "modules/body/footer.php"; ?>