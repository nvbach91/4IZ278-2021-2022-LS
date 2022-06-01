<?php
session_start();
if(!empty($_POST)){
    $id=$_POST['id'];
    foreach ($_SESSION['cart'] as $key=>$item){
        if ($item['id']===$id){
            array_splice($_SESSION['cart'],$key,1);
            break;
        }
    }
}
header('Location: ../cart.php');