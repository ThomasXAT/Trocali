<?php
include "database.php";
session_start();
switch ($_GET["request"]) {
    // Connexion
    case "login":
        if(isset($_POST["username"]) && isset($_POST["password"])) {
            $username = htmlspecialchars($_POST["username"]);
            $password = htmlspecialchars($_POST["password"]);
            $check = $db->prepare("SELECT identifiant, mdp, administrateur FROM Utilisateur WHERE identifiant = ?");
            $check->execute(array($username));
            $data = $check->fetch();
            $row = $check->rowCount();
            if ($row == 1) {
                $password = hash("sha256", $password);
                if ($data["mdp"] === $password) {
                    session_unset();
                    $_SESSION["user"] = $data;
                    header("Location: ../account.php");
                }
                else {
                    header("Location: ../account.php?request=login&error=password");
                }
            }
            else {
                header("Location: ../account.php?request=login&error=username");
            }
        }
        break;

    // Inscription
    case "signup":
        if(isset($_POST["username"]) && isset($_POST["surname"]) && isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["password"])) {
            $username = htmlspecialchars($_POST["username"]);
            $surname = htmlspecialchars($_POST["surname"]);
            $name = htmlspecialchars($_POST["name"]);
            $email = htmlspecialchars($_POST["email"]);
            $password = htmlspecialchars($_POST["password"]);
            $check = $db->prepare("SELECT identifiant FROM Utilisateur WHERE identifiant = ?");
            $check->execute(array($username));
            $data = $check->fetch();
            $row = $check->rowCount();
            if ($row == 0) {
                $password = hash("sha256", $password);
                $statement= $db->prepare("INSERT INTO Utilisateur (identifiant, nom, prenom, email, administrateur, mdp) VALUES (?, ?, ?, ?, 0, ?)");
                $statement->execute([$username, $surname, $name, $email, $password]);
                header("Location: ../account.php?request=login");
            }
            else {
                header("Location: ../account.php?request=signup&error=username");
            }
        }
        break;

    // Déconnexion
    case "logout";
        session_destroy();
        header("Location: ../index.php");
        break;
}
?>

