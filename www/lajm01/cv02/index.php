<?php
require("php/Person.php");
require("php/utils.php");

$arr = generatePeople();

require("htmlChunks/header.html");
require("htmlChunks/main.php");
require("htmlChunks/footer.html");
?>
