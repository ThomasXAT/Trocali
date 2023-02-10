<?php
include "database.php";
uploadSynonyms("dicSynonymes.json");
header("Location: ../index.php");
?>