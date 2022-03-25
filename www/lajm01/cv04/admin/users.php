<?php 
require("../php/dbHelper.php");

$dbHelper = new DBHelper();

foreach($dbHelper->getUsers() as &$user){
    echo $user->email."<br>";
}
?>