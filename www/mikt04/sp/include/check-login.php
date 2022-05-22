<?php
if (!isset($_SESSION['user_id'])) {
    header("location: ./signin.php");
    exit;
}
?>