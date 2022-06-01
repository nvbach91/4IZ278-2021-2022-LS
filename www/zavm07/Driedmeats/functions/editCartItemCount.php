<?php
session_start();
if(!empty($_POST && !empty($_SESSION['cart']))){
    $id = $_POST['id'];
    $count =$_POST['count'];
    $items = $_SESSION['cart'];

    foreach ($items as $key=>$item){
        if($item['id']===$id){
            $_SESSION['cart'][$key]['count']= $count;
            break;
        }
    }
}
header('Location: ../cart.php');
?>
