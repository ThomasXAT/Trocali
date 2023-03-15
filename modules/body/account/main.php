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

<a onclick="article();" style="cursor: pointer; color: rgb(0, 123, 255);">Vos articles</a><br>
<section id='article'> 
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

<a onclick="commande();" style="cursor: pointer; color: rgb(0, 123, 255);">Vos commandes</a><br>
<section id='commande'> 
    <?php 
    $username = $_SESSION["user"][0];
    $statement = $db->prepare("SELECT identifiant FROM Article WHERE acheteur = ? ORDER BY identifiant DESC"); // On va chercher les titres des articles dans l'ordre décroissant de publication
	$statement->execute([$username]);
    ?>
    <h4>Vos commandes (<?php echo $statement->rowcount() ?>)</h4>
    <?php
		while ($resu= $statement->fetch()){
            $identifiant = $resu['identifiant'];
            afficherArticle($identifiant);
            print "<br /><br />";
		} ?>
</section>

<a onclick="information();" style="cursor: pointer; color: rgb(0, 123, 255);">Vos informations</a><br>
<section  id='information'>
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
                <div><input type="password" name="newPassword2" placeholder="Confirmer mot de passe"></div></br>
                <div><p>Confirmer en entrant votre mot de passe actuel : </p><input type="password" name="oldPassword" placeholder="Mot de passe actuel"></div><br />
                <div><input type="submit" value="Valider"  class="button"></div>
            </form>
</section>

<a href='data/authentication.php?request=logout'>Se déconnecter</a><br><br><br>
