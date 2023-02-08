        <section class="notification">
            <p>Notifications</p>
            <?php
            if (isset($_SESSION["user"])) {
                $username = $_SESSION["user"][0];
                $statement = $db->prepare("SELECT TexteNotif FROM Notifications WHERE UserU = ? ");
                $statement->execute([$username]);
                while ($resu = $statement->fetch()){
                    print $resu["TexteNotif"];
                }
            }
            ?>
        </section>