<?php

if (isset($_COOKIE['name'])) {
  setcookie('name', '', 1);
  header('Location: login.php');
}
