<!DOCTYPE html>
<?php
include 'website.php'; 
include 'database.php';
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trocali - Connexion</title>
</head>
<body>
    <?php print $header; ?>
    <main>
        <section id="connexion">
            <H2> Connexion </H2>
            <form action="connection.php" method = "POST">
                <p> Veuillez renseigner votre email</p>
                <input type="email" id="email" name="email" placeholder="email">

                <p> Entrez votre mot de passe</p>
                <input type="text" id="mdp" name="mdp" placeholder="mot de passe">

                <input type="submit" value="Valider" name="submit">
            </form>

        </section>
        <?php
        extract($_POST,EXTR_OVERWRITE);
        if (isset($_POST['submit'])) {
            $email = $_POST["email"];
            $mdp = $_POST["mdp"];

            $statement = $database->query('SELECT email, mdp FROM utilisateur WHERE email = '.$email.' AND mdp = '.$mdp);

            if(!$statement) {
                echo "<p> Mot de passe ou adresse mail incorects </p>";
            }
            else {
                echo "c'est bien";
            }
            print($statement);
        }
        ?>
    <main>
	<?php print $footer; ?>
</body>
</html>