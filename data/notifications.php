<?php
include '../functions.php';
session_start();
if (isset($_GET["id"])) {
    $id=$_GET["id"];
    $statement = $db->prepare("DELETE FROM Notification WHERE identifiant= ?"); 
    $statement->execute([$id]);
    header("Location: ../index.php");
}
?>