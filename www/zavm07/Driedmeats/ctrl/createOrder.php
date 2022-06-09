<?php session_start();?>
<?php require '../db/Database.php' ?>
<?php require "../functions/userRequired.php" ?>
<?php require '../functions/cartBuilder.php' ?>
<?php require "../db/OrdersDB.php" ?>
<?php require "../db/Ordered_itemsDB.php" ?>


<?php
if(empty($_SESSION['cart'])){
    header('Location: ../index.php');
    exit();
}

if(empty($_SESSION['od_values'])){
    header('Location: ../orderDetails.php');
    exit();
}

//checkout page load time
$time = $_SESSION['od_values']['time'];

$usersDB = new UsersDB();
$user = $usersDB->fetchById($_SESSION['lg_email'])[0];

//create "unique" order ID
$orderID = ($user['user_id']*1000000)+(date("is")*100)+rand(0,99);

//create new order
$orderValues = $_SESSION['od_values'];
$ordersDB = new OrdersDB();
$orderDetails = [
    'id' => $orderID,
    'street'=>$orderValues['street']." ".$orderValues['number'],
    'city'=>$orderValues['city'],
    'zip'=>$orderValues['zip'],
    'shipping'=>$orderValues['shipping'],
    'user_id'=>$user['user_id'],
    'price'=>$orderValues['price']
        ];

//if creating order fail
if(!$ordersDB->create($orderDetails)){
    $_SESSION['od_errorMsg']= "Něco se pokazilo, zkuste to prosím znovu";
    //header('Location: ../orderDetails.php');
    exit();
}

//get items from the cart
$items = cartBuilder();

//add shipping item
$productsDB = new ProductsDB();
$shipping = $productsDB->fetchById($orderValues['shipping'])[0];
$shipping = [
    'id'=>$shipping['prod_id'],
    'name'=>$shipping['prod_name'],
    'size'=>$shipping['size'],
    'count'=>1,
    'price'=>$shipping['price'],
    'date_edited'=>$shipping['date_edited']
];
array_push($items,$shipping);

//add items to the order
$ordered_itemsDB = new Ordered_itemsDB();
foreach ($items as $item){
    if($item['date_edited']<$time){
        $ordered_itemsDetails =[
            'prod_id' => $item['id'],
            'order_id' => $orderID,
            'prod_name' => $item['name'],
            'count' =>  $item['count'],
            'price' =>  $item['price']
        ];
        if(!$ordered_itemsDB->create($ordered_itemsDetails)){
            $ordersDB->deleteById($orderID);
            array_push($_SESSION['od_errorMsg'], "Něco se pokazilo, zkuste to prosím znovu");
            header('Location: ../orderDetails.php?err=1');
            exit();
        }
    }
    else{
        array_push($_SESSION['od_errorMsg'], "Došlo ke změně údajů o položkách ve vašem košíku. Zkontrolujte prosím svou objednávku");
        $ordersDB->deleteById($orderID);
        header('Location: ../orderDetails.php?err=2');
        exit();
    }
}

//If success, empty cart & user details
$_SESSION['cart'] = [];
$_SESSION['od_values'] = [];
header('Location: ../orderSuccess.php');
exit();
?>
