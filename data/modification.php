<?php
include "database.php";
session_start();

$oldPassword = htmlspecialchars($_POST["oldPassword"]);
$oldPassword = hash("sha256", $oldPassword);
if($oldPassword == $_SESSION["user"][1]){

    if(isset($_POST["surname"])){
        $surname = htmlspecialchars($_POST["surname"]);
        $username = $_SESSION["user"][0];
        $statement= $db->prepare("UPDATE Utilisateur SET nom = ? WHERE Identifiant = ?");
        $statement->execute([$surname, $username]);
        header("Location: ../account.php");  
    }

    if(isset($_POST["name"])){
        $name = htmlspecialchars($_POST["name"]);
        $username = $_SESSION["user"][0];
        $statement= $db->prepare("UPDATE Utilisateur SET prenom = ? WHERE Identifiant = ?");
        $statement->execute([$name, $username]);
        header("Location: ../account.php");  
    }
    if(isset($_POST["email"])){
        $email = htmlspecialchars($_POST["email"]);
        $username = $_SESSION["user"][0];
        $statement= $db->prepare("UPDATE Utilisateur SET email = ? WHERE Identifiant = ?");
        $statement->execute([$email, $username]);
        header("Location: ../account.php");  
    }
    if(isset($_POST["newPassword"])){
        $newPassword = htmlspecialchars($_POST["newPassword"]);
        $newPassword2 = htmlspecialchars($_POST["newPassword2"]);
        $newPassword2 = hash("sha256", $newPassword2);
        if($newPassword != ""){
            $newPassword = hash("sha256", $newPassword);
            if($newPassword == $newPassword2) {
                $username = $_SESSION["user"][0];
                $statement= $db->prepare("UPDATE Utilisateur SET mdp = ? WHERE Identifiant = ?");
                $statement->execute([$newPassword, $username]);
            }
            else {
                header("Location: ../account.php?error=mdtDiff");
                exit();
       
            }
        }
    }
    session_destroy();
    
}
else {
    header("Location: ../account.php?error=nonvalide");

}
    

