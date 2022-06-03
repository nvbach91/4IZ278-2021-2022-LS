<?php session_start() ?>
<?php require '../db/Database.php' ?>
<?php require '../functions/adminRequired.php' ?>
<?php require '../db/ProductsDB.php' ?>
<?php require '../db/CategoriesDB.php' ?>
<?php

if(empty($_POST)){
    header('Location: ../index.php');
    exit();

}

$_SESSION['ui_values'] = [];
$_SESSION['ui_errorMsg'] = [];
$_SESSION['ui_errorValues'] = [];

$errorMsq = [];
$errorValues = [];
$changeCount = 0;

$id = $_POST['id'];
$time = $_POST['time'];
$name = $_POST['name'];
$category = $_POST['category'];
$description =$_POST['description'];
$size =$_POST['size'];
$price =$_POST['price'];
$image =$_POST['image'];


$productsDB = new ProductsDB();
$existingItem = $productsDB->fetchById($id)[0];

//check if product exist
if (empty($existingItem)){
    header('Location ../index.php');
    exit();
}

//check, if product hasn't been changed while editing
if ($existingItem['date_edited']>$time){
    array_push($errorMsq,'Produkt byl během vašich úprav změněn, zkuste to prosím znovu');
    $_SESSION['ui_errorMsg'] = $errorMsq;
    header('Location: ../updateItem.php?id='.$id);
    exit();
}

$categoriesDB = new CategoriesDB();
$existingCategory = $categoriesDB->fetchById($category)[0];

//input validation
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

//return back in case of invaild value
if (sizeof($errorValues)>0){
    $_SESSION['ui_values'] = $_POST;
    $_SESSION['ui_errorMsg'] = $errorMsq;
    $_SESSION['ui_errorValues'] = $errorValues;
    header('Location: ../updateItem.php?id='.$id);
    exit();
}

//Perform and update if value has been changed, stop and return if error occurs
if ($existingItem['name']!=$name){
    if(!$productsDB->updateById($id,'prod_name',$name)){
        array_push($errorMsq,'Něco se pokazilo, zkontrolujte své údaje a zkuste to prosím znovu');
        $_SESSION['ui_errorMsg'] = $errorMsq;
        header('Location: ../updateItem.php?id='.$id);
        exit();
    }
    $changeCount += 1;
}

if ($existingItem['category']!=$category){
    if(!$productsDB->updateById($id,'cat_id',$category)){
        array_push($errorMsq,'Něco se pokazilo, zkontrolujte své údaje a zkuste to prosím znovu');
        $_SESSION['ui_errorMsg'] = $errorMsq;
        header('Location: ../updateItem.php?id='.$id);
        exit();
    }
    $changeCount += 1;
}

if ($existingItem['name']!=$description){
    if(!$productsDB->updateById($id,'description',$description)){
        array_push($errorMsq,'Něco se pokazilo, zkontrolujte své údaje a zkuste to prosím znovu');
        $_SESSION['ui_errorMsg'] = $errorMsq;
        header('Location: ../updateItem.php?id='.$id);
        exit();
    }
    $changeCount += 1;
}

if ($existingItem['size']!=$size){
    if(!$productsDB->updateById($id,'size',$size)){
        array_push($errorMsq,'Něco se pokazilo, zkontrolujte své údaje a zkuste to prosím znovu');
        $_SESSION['ui_errorMsg'] = $errorMsq;
        header('Location: ../updateItem.php?id='.$id);
        exit();
    }
    $changeCount += 1;
}

if ($existingItem['price']!=$price){
    if(!$productsDB->updateById($id,'price',$price)){
        array_push($errorMsq,'Něco se pokazilo, zkontrolujte své údaje a zkuste to prosím znovu');
        $_SESSION['ui_errorMsg'] = $errorMsq;
        header('Location: ../updateItem.php?id='.$id);
        exit();
    }
    $changeCount += 1;
}

if ($existingItem['img_link']!=$image){
    if(!$productsDB->updateById($id,'img_link',$image)){
        array_push($errorMsq,'Něco se pokazilo, zkontrolujte své údaje a zkuste to prosím znovu');
        $_SESSION['ui_errorMsg'] = $errorMsq;
        header('Location: ../updateItem.php?id='.$id);
        exit();
    }
    $changeCount += 1;
}

//clear error fields and header back on success
$_SESSION['ui_values'] = [];
$_SESSION['ui_errorMsg'] = [];
$_SESSION['ui_errorValues'] = [];
header('Location: ../updateItem.php?id='.$id.'&success=1');
exit();
?>
