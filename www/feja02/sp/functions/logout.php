<?php
session_start();
session_destroy();
setcookie("token", "", date() - 3600, "/");
header("Location: ../");
?>
