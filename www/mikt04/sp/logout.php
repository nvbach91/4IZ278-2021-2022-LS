<?php

include './include/nav.php';

session_destroy();

header('Location: ./index.php');

?>