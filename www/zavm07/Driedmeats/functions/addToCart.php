<?php
session_start();
if(!empty($_POST)){
    $id=$_POST['id'];
    $changeIndicator = 0;
    if (!isset($_SESSION['cart'])){
        $_SESSION['cart'] = [];
    }
    foreach ($_SESSION['cart'] as $key=>$item){
        if ($_SESSION['cart'][$key]['id']===$id){
            $_SESSION['cart'][$key]['count'] +=1;
            $changeIndicator +=1;
        }
    }

    if ($changeIndicator==0){
        $toCart = ['id'=>$id,'count'=>1];
        $_SESSION['cart'][] = $toCart;
    }
}
$url = $_POST['url'];
header('Location: ../'.$url);