<section id='notifications'>
            <h3>Notifications : </h3>

        <div id='contenuNotif'>
        <?php
        if (isset($_SESSION["user"])) {
            $username = $_SESSION["user"][0];
            $statement = $db->prepare("SELECT * FROM Notification WHERE Utilisateur = ? ");
            $statement->execute([$username]);
            while ($resu = $statement->fetch()){
                print $resu["texte"]. "\n";
                $id=$resu["identifiant"];
                print "</BR>";
                print "<a href='data/notifications.php?id=$id'>Supprimer</a>\n";
                print "</BR></BR>";
            }
        }
        ?>
        </div>
</section>
