<?php 
$identifiant = $_SESSION["user"][0];
$statement = $db->prepare("SELECT * FROM Utilisateur"); // On va chercher les titres des articles dans l'ordre décroissant de publication
$statement->execute();
while($resu= $statement->fetch()) {
    if ($resu['identifiant'] == $_SESSION["user"][0]) {
        $nom = $resu['nom'];
        $prenom = $resu['prenom'];
        $email = $resu['email'];
        $mdp = $resu['mdp'];
        $mdp = hash("sha256", $mdp);
    }
}
?>

<h3> Bonjour <?php echo $prenom?></h3>

<a href=''>Vos commandes</a><br>
<a href=''>Vos articles</a><br>
<a href=''>Vos informations</a><br>
<a href='data/authentication.php?request=logout'>Se déconnecter</a><br><br><br>

<section> 
    <?php 
    $username = $_SESSION["user"][0];
    $statement = $db->prepare("SELECT identifiant FROM Article WHERE auteur = ? ORDER BY identifiant DESC"); // On va chercher les titres des articles dans l'ordre décroissant de publication
	$statement->execute([$username]);
    ?>
    <h4>Vos articles (<?php echo $statement->rowcount() ?>)</h4>
    <?php
		while ($resu= $statement->fetch()){
            $identifiant = $resu['identifiant'];
            afficherArticle($identifiant);
            print "<br /><br />";

		} 
        ?>
</section>

<section> 
    <?php 
    $username = $_SESSION["user"][0];
    $statement = $db->prepare("SELECT identifiant, titre, acheteur FROM Article WHERE acheteur = ? ORDER BY identifiant DESC"); // On va chercher les titres des articles dans l'ordre décroissant de publication
	$statement->execute([$username]);
    ?>
    <h4>Vos commandes (<?php echo $statement->rowcount() ?>)</h4>
    <?php
		while ($resu= $statement->fetch()){
            $identifiant = $resu['identifiant'];
            $article = $resu['titre'];
            print "<a href='article.php?id=".$identifiant."'>$article</a>";
            print "<br /><br />";
		} ?>
</section>

<section>
    <h4>Vos informations</h4>
    <?php
    if (isset($_GET["error"])) {
        $error = htmlspecialchars($_GET["error"]);
        switch ($error) {
                // Erreur : mot de passe
        case "nonvalide":
            print "<p class=" . '"' . "error" . '"' . ">Mot de passe actuel incorrect.</p>\n";
            break;

        case "mdtDiff":
            print "<p class=" . '"' . "error" . '"' . ">Saisi de mot de passe différent</p>\n";
            break;
            }
        } 
    ?>               
    <form method="POST" action="data/modification.php">
                <div><input type="text" name="surname" value="<?php echo $nom?>" placeholder="Nom" ></div><br />
                <div><input type="text" name="name" value="<?php echo $prenom?>" placeholder="Prénom" ></div><br />
                <div><input type="email" name="email" value="<?php echo $email?>" placeholder="Adresse e-mail" ></div><br />
                <div><input type="password" name="newPassword" placeholder="Nouveau mot de passe"></div></br>
                <div><input type="password" name="newPassword2" placeholder="Confirmer mot de passe"></div>
                <div><p>Confirmer en entrant votre mot de passe actuel : </p><input type="password" name="oldPassword" placeholder="Ancien mot de passe"></div><br />
                <div><input type="submit" value="Valider"></div>
            </form>
</section>
