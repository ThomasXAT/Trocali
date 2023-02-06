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
                        include "modules/login.php";
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
                        include "modules/signup.php";            
                        break;
                }
            }
            else {
                print "
            <h2>Mon compte</h2>\n";
            include "modules/account.php";            
            }
            ?>
        </section>
    </main>

<?php
html_footer();
?>
