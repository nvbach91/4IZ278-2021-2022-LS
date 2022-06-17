<?php
require  __DIR__ . '/db/productsDB.php';
$errors = [];
$productsDB = new productsDB();
if(!empty($_POST)){
    
  $product_name = $_POST['product_name'];
  $price = $_POST['price'];
  $category = $_POST['category'];
  $size = $_POST['size'];
  $imageLink = $_POST['imagelink'];
  
  
  
  


if (strlen($name) < 3) {
  array_push($errors, 'Wrong name');
}
if (strlen($price) < 3) {
  array_push($errors, 'Wrong password');  
}
if (strlen($category) < 3) {
  array_push($errors, 'Wrong password');  
}
if (strlen($imageLink) < 3) {
  array_push($errors, 'Wrong password');  
}

if (!count($errors)){
if(is_null($existingUser)){
  
}
else{
  array_push($errors, 'same email');  
}
}
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Make an offer</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="header">
  <div class="alert alert-danger">
                <?php 
        foreach($errors as $error): ?>
                <div class="error"><?= $error; ?></div>
                <?php endforeach; ?>
            </div>
  	<h2>Sell product</h2>
  </div>
  <form method="post" action="products.php" enctype="multipart/form-data">
  	
  	<div class="input-group">
  	  <label>Name of the product</label>
  	  <input class="form-control" name="product_name" value="<?php echo isset($product_name) ? $product_name : '' ?>">
  	</div>
  	<div class="input-group">
  	  <label>Price</label>
  	  <input class="form-control" name="price" value="<?php echo isset($price) ? $price : '' ?>">
  	</div>
    <div class="input-group">
  	  <label>Choose a category:</label>
      <select name="size" id="size">
        <option value="tshirts">tshirts</option>
        <option value="hoodies">hoodies</option>
        <option value="coats">coats</option>
      </select>
  	</div>
    <div class="input-group">
      <label>Choose a size:</label>
      <select name="size" id="size">
        <option value="S">S</option>
        <option value="M">M</option>
        <option value="L">L</option>
        <option value="XL">XL</option>
      </select>
    </div>
    <div class="input-group">
  	  <label>Image link</label>
  	  <input class="form-control" name="password" value="<?php echo isset($imageLink) ? $imageLink : '' ?>">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_user">Register</button>
  	</div>
  </form>
</body>
</html>