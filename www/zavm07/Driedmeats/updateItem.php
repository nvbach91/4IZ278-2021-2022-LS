<?php require 'inc/header.php' ?>
<?php require 'functions/adminRequired.php' ?>
<?php require 'db/CategoriesDB.php'?>
<?php require 'db/ProductsDB.php'?>

<?php

if (empty($_GET['id'])){
    header('Location: fb_login.php');
    exit();
}

$productsDB = new ProductsDB();
$item = $productsDB->fetchById($_GET['id'])[0];

if (empty($item)){
    header('Location: fb_login.php');
    exit();
}

$categoriesDB = new CategoriesDB();
$categories = $categoriesDB->fetchAll();
//removes shipping category
array_shift($categories);

$ui_errorMsg = [];
if (!empty($_SESSION['ui_errorMsg'])) {
    $ui_errorMsg = $_SESSION['ui_errorMsg'];
}
?>

<h1 class="text-center text-black mt-5">Upravit produkt</h1>
<div class="d-flex flex-column mx-auto">
    <h6 class="text-bg-success m-1"><?php if (!empty($_GET['success'])){ echo "Položka byla úspěšně aktualizována"; } ?></h6>
    <?php foreach ($ui_errorMsg as $msg): ?>
        <h6 class="m-1 text-danger"><?php echo $msg ?></h6>
    <?php endforeach; ?>
</div>
<div class="d-flex w-75 justify-content-center mx-auto text-black flex-wrap">
    <div class="container" style="width: 500px">
        <form method="post" action="ctrl/updateItemController">
            <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
            <input type="hidden" name="time" value="<?php echo date("Y-m-d H:i:s"); ?>">
            <div class="form-group m-1">
                <label for="name">Název položky</label>
                <input type="text" class="form-control" name="name" id="name" value="<?php echo $item['prod_name']?>">
            </div>
            <div class="form-group m-1">
                <label for="category">Kategorie</label>
                <select class="form-select" name="category" id="category">
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo $category['cat_id'] ?>"><?php echo $category['cat_name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group m-1">
                <label for="description">Popis</label>
                <textarea name="description" class="form-control" id="description" style="max-height: 250px"><?php echo $item['description']?></textarea>
            </div>
            <div class="form-group m-1">
                <label for="size">Velikost</label>
                <input type="text" class="form-control" name="size" id="size" value="<?php echo $item['size']?>">
            </div>
            <div class="form-group m-1">
                <label for="price">Cena v Kč</label>
                <input type="text" class="form-control" name="price" id="price" value="<?php echo $item['price']?>">
            </div>

            <div class="form-group m-1">
                <label for="image">Název obrázku</label>
                <input type="text"  class="form-control" name="image" id="image"  value="<?php echo $item['img_link']?>">
            </div>
            <button type="submit" class="btn btn-primary bg-primary border-0 m-1 ">Aktualizovat produkt</button>
        </form>
    </div>

    <div class="container justify-content-center" style="width:300px">
        <h5> Náhled produktu</h5>
        <div class="card" style="width:300px;height: auto">
            <div class="container w-100 p-0 overflow-hidden" style="height: 200px">
                <img class="card-img-top" src="<?php echo "res/items/".$item['img_link']?>" alt="Náhled produktu" width="300" height="auto" id="pre_img" >
            </div>
            <div class="card-body text-black">
                <h4 class="card-title" id="pre_name"><?php echo $item['prod_name']?></h4>
                <p class="card-text" style="min-height: 100px" id="pre_desc"><?php echo $item['description']?></p>
                <h5 id="pre_size"><?php echo $item['size']?></h5>
                <h4 id="pre_price"><?php echo $item['price']?> Kč</h4>
            </div>
            <div class="d-flex mt-4">
                <button class="btn btn-primary m-1" disabled>Přidat do košíku</button>
            </div>
        </div>
    </div>

</div>


<?php require 'inc/footer.php' ?>

<?php if (!empty($_SESSION['ui_values'])): ?>
    <script>$("#name").val('<?php echo $_SESSION['ui_values']['name'] ?>')</script>
    <script>$("#category").val('<?php echo $_SESSION['ui_values']['category'] ?>')</script>
    <script>$("#description").val('<?php echo $_SESSION['ui_values']['description'] ?>')</script>
    <script>$("#size").val('<?php echo $_SESSION['ui_values']['size'] ?>')</script>
    <script>$("#price").val('<?php echo $_SESSION['ui_values']['price'] ?>')</script>
    <script>$("#image").val('<?php echo $_SESSION['ui_values']['image'] ?>')</script>
<?php endif;?>


<?php if (!empty($_SESSION['ui_errorValues'])): ?>
    <?php foreach ($_SESSION['ui_errorValues'] as $errorValue): ?>
        <script>$('#<?php echo $errorValue?>').css("border-color","red")</script>
    <?php endforeach;?>
<?php endif;?>

<script>
    //Insert values to preview
    $('#name').change(function (){
        $('#pre_name').html($(this).val())
    })
    $('#description').change(function (){
        $('#pre_desc').html($(this).val())
    })
    $('#size').change(function (){
        $('#pre_size').html($(this).val())
    })
    $('#price').change(function (){
        $('#pre_price').html($(this).val()+" Kč")
    })
    $('#image').change(function (){
        $('#pre_img').attr('src',"res/items/"+$(this).val())
    })
</script>

<?php
$_SESSION['ui_values'] = [];
$_SESSION['ui_errorMsg'] = [];
$_SESSION['ui_errorValues'] = [];
?>
