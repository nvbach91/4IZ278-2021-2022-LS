<?php session_start();

session_destroy();

header('Location: index.php?signedOut=1');


?>
