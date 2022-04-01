<?php require __DIR__ . '/../db/ProductsDB.php'; ?>
<?php

// INSERT INTO `products` (`name`, `price`, `img`) VALUES
// ('Tommy Atkins', '40', 'https://www.mango.org/wp-content/uploads/2017/11/kent-variety.jpg'),
// ('Ataulfo', '61', 'http://elbefruit.eu/wp-content/uploads/2018/07/tommy-variety-1.jpg'),
// ('Kent', '48', 'https://media.mercola.com/assets/images/foodfacts/mango-nutrition-facts.jpg'),
// ('Haden', '52', 'https://images-na.ssl-images-amazon.com/images/I/21jivLJsAeL.jpg'),
// ('Keitt', '40', 'http://betterhomegardening.com/wp-content/uploads/2015/05/pakistan-Ataulfo-mango.jpg'),
// ('Francine', '60', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcStvS-QHWIlsLILy-fIIGXcxlb2jUIrXNDjKXs4eLbSJt4gJKLu');

$productsDB = new ProductsDB();
$products = $productsDB->fetchAll();

?>

<div class="row">
  <?php foreach($products as $product): ?>
  <div class="col-lg-4 col-md-6 mb-4">
    <div class="card h-100 product">
      <a href="#"><img class="card-img-top product-image" src="<?php echo $product['img']; ?>" alt="product-image"></a>
      <div class="card-body">
        <h4 class="card-title"><a href="#"><?php echo $product['name']; ?></a></h4>
        <h5><?php echo number_format($product['price'], 2), ' ', GLOBAL_CURRENCY; ?></h5>
        <p class="card-text">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quisquam animi eius nam earum ducimus illum facere numquam blanditiis architecto dolorum? Totam, possimus. Cupiditate tenetur magnam reiciendis labore laboriosam dolorum sed.</p>
      </div>
      <div class="card-footer">
        <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
      </div>
    </div>
  </div>
  <?php endforeach; ?>
</div>