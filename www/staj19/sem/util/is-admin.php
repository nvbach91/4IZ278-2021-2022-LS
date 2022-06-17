<?php

require __DIR__ . '/is-logged.php';

if ($_SESSION['user']['privilege'] < 2) {
  header('Location: login.php');
  exit();
}
