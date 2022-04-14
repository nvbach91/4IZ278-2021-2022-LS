<?php
if(isset($_COOKIE['email'])){
    setcookie('email','',1);
    header('Location: index.php');
}
