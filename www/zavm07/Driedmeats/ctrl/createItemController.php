<?php session_start() ?>
<?php require '../db/Database.php' ?>
<?php require '../functions/adminRequired.php' ?>
<?php require '../db/ProductsDB.php' ?>
<?php require '../db/CategoriesDB.php' ?>
<?php

if(empty($_POST)){
    header('Location ../index.php');
    exit();
}

$_SESSION['ci_values'] = [];
$_SESSION['ci_errorMsg'] = [];
$_SESSION['ci_errorValues'] = [];

$errorMsq = [];
$errorValues = [];

$name = $_POST['name'];
$category = $_POST['category'];
$description =$_POST['description'];
$size =$_POST['size'];
$price =$_POST['price'];
$image =$_POST['image'];

$categoriesDB = new CategoriesDB();
$existingCategory = $categoriesDB->fetchById($category)[0];

if(strlen($name)< 1){
    array_push($errorMsq,'Zadejte prosím název produktu');
    array_push($errorValues,'name');
}

if(empty($existingCategory)){
    array_push($errorMsq,'Zvolená kategorie neexistuje');
    array_push($errorValues,'category');
}

if(strlen($description)< 30){
    array_push($errorMsq,'Popisek produktu je příliš krátký');
    array_push($errorValues,'description');
}

if (!preg_match('/^\d+ \w+$/', $size)){
    array_push($errorMsq,'Velikost musí být ve formátu [číslo][mezera][jednotka]');
    array_push($errorValues,'size');
}
if (!preg_match('/^\d+$/', $price)){
    array_push($errorMsq,'Cena může obsahovat pouze číselné hodnoty');
    array_push($errorValues,'price');
}
if (!preg_match('/^(\S+).(jpeg|JPEG|jpg|JPG|png|PNG)$/', $image)){
    array_push($errorMsq,'Zadejte platný formát telefoního čísla');
    array_push($errorValues,'image');
}

if (sizeof($errorValues)>0){
    $_SESSION['ci_values'] = $_POST;
    $_SESSION['ci_errorMsg'] = $errorMsq;
    $_SESSION['ci_errorValues'] = $errorValues;
    header('Location: ../createItem.php');
    exit();
}

$productsDB = new ProductsDB();
$itemDetails=[
  'prod_name'=>$name,
  'description'=>$description,
  'size'=>$size,
  'price'=>$price,
  'cat_id'=>$category,
  'img_link'=>$image
];

//if creating item fails
if(!$productsDB->create($itemDetails)){
    array_push($_SESSION['ci_errorMsg'],'Něco se pokazilo, zkuste to prosím znovu');
    $_SESSION['ci_values'] = $_POST;
    header('Location: ../createItem.php');
    exit();
}


$_SESSION['ci_values'] = [];
$_SESSION['ci_errorMsg'] = [];
$_SESSION['ci_errorValues'] = [];
header('Location: ../createItem.php?success=1');
exit();






