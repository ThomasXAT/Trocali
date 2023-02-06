<?php
include "template.php";
html_head("Trocali - Mon compte");
html_header();
?>

    <main>
        <section class="content">
            <?php 
            if (!isset($_GET["request"])) {
                $request="login";
            }
            else {
                $request = htmlspecialchars($_GET["request"]);
            }
            if (!isset($_SESSION["user"])) {
                switch ($request) {
                    // Connexion
                    case "login":
                        print
                    "<h2>Formulaire de connexion</h2>\n";
                        // Gestion des erreurs
                        if (isset($_GET["error"])) {
                            $error = htmlspecialchars($_GET["error"]);
                            switch ($error) {

                                // Erreur : nom d'utilisateur
                                case "username":
                                    print "<p class=" . '"' . "error" . '"' . ">Nom d'utilisateur inconnu.</p>\n";
                                    break;

                                // Erreur : mot de passe
                                case "password":
                                    print "<p class=" . '"' . "error" . '"' . ">Mot de passe incorrect.</p>\n";
                                    break;
                            }
                        }                
                        print
"            <form method=" . '"' . "POST" . '"' . " action=" . '"' . "data/authentication.php?request=login" . '"' . ">
                <div><input type=" . '"' . "text" . '"' . " name=" . '"' . "username" . '"' . " placeholder=" . '"' . "Nom d'utilisateur" . '"' . " required=" . '"' . "required" . '"' . "></div><br />
                <div><input type=" . '"' . "password" . '"' . " name=" . '"' . "password" . '"' . " placeholder=" . '"' . "Mot de passe" . '"' . " required=" . '"' . "required" . '"' . "></div><br />
                <div><input type=" . '"' . "submit" . '"' . " value=" . '"' . "Se connecter" . '"' . " /></div>
            </form>
            <a href=" . '"' . "account.php?request=signup" . '"' . "><p>Je ne possède pas de compte.</p></a>\n";
                        break;

                    // Inscription
                    case "signup":
                        print
                    "<h2>Formulaire d'inscription</h2>\n";
                        // Gestion des erreurs
                        if (isset($_GET["error"])) {
                            $error = htmlspecialchars($_GET["error"]);
                            switch ($error) {

                                // Erreur : nom d'utilisateur
                                case "username":
                                    print "<p class=" . '"' . "error" . '"' . ">Nom d'utilisateur indisponible.</p>\n";
                                    break;
                            }
                        }                
                        print 
"            <form method=" . '"' . "POST" . '"' . " action=" . '"' . "data/authentication.php?request=signup" . '"' . ">
                <div><input type=" . '"' . "text" . '"' . " name=" . '"' . "username" . '"' . " placeholder=" . '"' . "Nom d'utilisateur" . '"' . " required=" . '"' . "required" . '"' . "></div><br />
                <div><input type=" . '"' . "text" . '"' . " name=" . '"' . "surname" . '"' . " placeholder=" . '"' . "Nom" . '"' . " required=" . '"' . "required" . '"' . "></div><br />
                <div><input type=" . '"' . "text" . '"' . " name=" . '"' . "name" . '"' . " placeholder=" . '"' . "Prénom" . '"' . " required=" . '"' . "required" . '"' . "></div><br />
                <div><input type=" . '"' . "email" . '"' . " name=" . '"' . "email" . '"' . " placeholder=" . '"' . "Adresse e-mail" . '"' . " required=" . '"' . "required" . '"' . "></div><br />
                <div><input type=" . '"' . "password" . '"' . " name=" . '"' . "password" . '"' . " placeholder=" . '"' . "Mot de passe" . '"' . " required=" . '"' . "required" . '"' . "></div><br />
                <div><input type=" . '"' . "submit" . '"' . " value=" . '"' . "S'inscrire" . '"' . " /></div>
            </form>
            <a href=" . '"' . "account.php?request=login" . '"' . "><p>Je possède déjà un compte.</p></a>\n";
                        break;
                }
            }
            else {
                print "
            <h2>Mon compte</h2>\n
            <a href='data/authentication.php?request=logout'>Se déconnecter</a>\n";
            }
            ?>
        </section>
    </main>

<?php
html_footer();
?>
