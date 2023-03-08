<?php 
session_start(); 
include "functions.php";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trocali - <?php print $title; ?></title>
    <link rel="stylesheet" href="style.css" type="text/css" >
    <link rel="icon" type="image/x-icon" href="../images/Logo_Trocali.ico">
    <script src="https://kit.fontawesome.com/d003054d16.js" crossorigin="anonymous"></script>
    <!--<link href="style/reset.css" rel="stylesheet">-->
    <?php
        if ($title == 'Reglement' || $title == 'Panier'|| $title == 'Troc' || $title == 'Paiement') {
            if(!isset($_SESSION['user'])) {
                print "<meta http-equiv='refresh' content='0; URL=index.php'>";
            }
        }
    ?>
</head>
