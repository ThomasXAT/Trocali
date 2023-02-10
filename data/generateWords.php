<?php
include "database.php";
uploadWords("dicSynonymes.json");
header("Location: ../index.php");
?>