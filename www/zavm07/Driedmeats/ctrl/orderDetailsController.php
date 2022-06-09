<?php

$errorMsq = [];
$errorValues = [];
$_SESSION['od_values'] = [];

if(empty($_POST)){
    header('Location: ./orderDetails.php');
    exit();
}
 if(!empty($_POST)){
     $street = $_POST['street'];
     $number = $_POST['number'];
     $city = $_POST['city'];
     $zip = $_POST['zip'];
     $shipping = $_POST['shipping'];

     if (!preg_match('/^\d{1,4}(\/\d{1,3})?$/', $number)){
         array_push($errorMsq,'Zadejte správný formát čísla popisného');
         array_push($errorValues,'number');
     }

     if(strlen($city)< 1){
         array_push($errorMsq,'Zadejte prosím název obce');
         array_push($errorValues,'city');
     }

     if (preg_match('/^\d{5}$/', $zip)){
         $half = str_split($zip,3);
         $zip = $half[0]." ".$half[1];
         $_POST['zip'] = $zip;
     }

     if (!preg_match('/^\d{3} \d{2}$/', $zip)){
         array_push($errorMsq,'Zadejte správný formát PSČ');
         array_push($errorValues,'zip');
     }

     if($shipping > 3){
         array_push($errorMsq,'Vybraný způsob doručení neexistuje');
         array_push($errorValues,'shipping');
     }

     $_SESSION['od_values'] = $_POST;

     if (sizeof($errorValues)>0){

         $_SESSION['od_errorMsg'] = $errorMsq;
         $_SESSION['od_errorValues'] = $errorValues;
         header('Location: ./orderDetails.php');
         exit();
     }
     else{
         $_SESSION['od_errorMsg'] = [];
         $_SESSION['od_errorValues'] = [];
     }

 }
