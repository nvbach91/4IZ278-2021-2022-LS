<?php require 'inc/header.php' ?>
<?php require 'functions/adminRequired.php' ?>
<?php require 'db/CategoriesDB.php'?>

<?php
$categoriesDB = new CategoriesDB();
$categories = $categoriesDB->fetchAll();
//removes shipping category
array_shift($categories);


$ci_errorMsg = [];
if (!empty($_SESSION['ci_errorMsg'])) {
    $ci_errorMsg = $_SESSION['ci_errorMsg'];
}
?>

<h1 class="text-center text-black mt-5">Nový produkt</h1>
<div class="d-flex flex-column mx-auto">
    <h6 class="text-bg-success m-1"><?php if (!empty($_GET['success'])){ echo "Produkt byl úspěšně vytvořen"; } ?></h6>
    <?php foreach ($ci_errorMsg as $msg): ?>
        <h6 class="m-1 text-danger"><?php echo $msg ?></h6>
    <?php endforeach; ?>
</div>
<div class="d-flex w-75 justify-content-center mx-auto text-black flex-wrap">
    <div class="container" style="width: 500px">
        <form method="post" action="ctrl/createItemController">
            <div class="form-group m-1">
                <label for="name">Název položky</label>
                <input type="text" class="form-control" name="name" id="name">
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
                <textarea name="description" class="form-control" id="description" style="max-height: 250px"></textarea>
            </div>
            <div class="form-group m-1">
                <label for="size">Velikost</label>
                <input type="text" class="form-control" name="size" id="size">
            </div>
            <div class="form-group m-1">
                <label for="price">Cena v Kč</label>
                <input type="text" class="form-control" name="price" id="price">
            </div>

            <div class="form-group m-1">
                <label for="image">Název obrázku</label>
                <input type="text"  class="form-control" name="image" id="image" accept="image/png, image/jpeg">
            </div>
            <button type="submit" class="btn btn-primary bg-primary border-0 m-1 ">Vytvořit produkt</button>
        </form>
    </div>

    <div class="container justify-content-center" style="width:300px">
        <h5> Náhled produktu</h5>
        <div class="card" style="width:300px;height: auto">
            <div class="container w-100 p-0 overflow-hidden" style="height: 200px">
                <img class="card-img-top" src="" alt="Náhled produktu" width="300" height="auto" id="pre_img" >
            </div>
            <div class="card-body text-black">
                <h4 class="card-title" id="pre_name">Název</h4>
                <p class="card-text" style="min-height: 100px" id="pre_desc">popis</p>
                <h5 id="pre_size">množství</h5>
                <h4 id="pre_price">?? Kč</h4>
            </div>
            <div class="d-flex mt-4">
                <button class="btn btn-primary m-1" disabled>Přidat do košíku</button>
            </div>
        </div>
    </div>

</div>


<?php require 'inc/footer.php' ?>

<!-- Add previously entered values -->

<?php if (!empty($_SESSION['ci_values'])): ?>
    <script>$("#name").val('<?php echo $_SESSION['ci_values']['name'] ?>')</script>
    <script>$("#category").val('<?php echo $_SESSION['ci_values']['category'] ?>')</script>
    <script>$("#description").val('<?php echo $_SESSION['ci_values']['description'] ?>')</script>
    <script>$("#size").val('<?php echo $_SESSION['ci_values']['size'] ?>')</script>
    <script>$("#price").val('<?php echo $_SESSION['ci_values']['price'] ?>')</script>
    <script>$("#image").val('<?php echo $_SESSION['ci_values']['image'] ?>')</script>
<?php endif;?>

<!-- Empty temporary $_SESSION fields -->

<?php if (!empty($_SESSION['ci_errorValues'])): ?>
    <?php foreach ($_SESSION['ci_errorValues'] as $errorValue): ?>
        <script>$('#<?php echo $errorValue?>').css("border-color","red")</script>
    <?php endforeach;?>
<?php endif;?>

<!-- Insert values to preview -->

<script>
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
$_SESSION['ci_values'] = [];
$_SESSION['ci_errorMsg'] = [];
$_SESSION['ci_errorValues'] = [];
?>
