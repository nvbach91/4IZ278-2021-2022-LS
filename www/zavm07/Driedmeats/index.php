<?php  include 'inc/header.php'; ?>
<?php  require 'db/ProductsDB.php'?>

<div class="d-flex w-50 align-items-center text-black flex-column m-auto flex-wrap">
    <h1 class="mb-5">Vítejte na Driedmeats</h1>
    <h4 class="mb-5">Které maso budem sušit tentokrát?</h4>
    <div class="d-flex w-100 flex-wrap justify-content-center">
        <a href="products.php?category=hovezi" class="btn btn-primary m-4" style="height: 200px; width: 200px">
            <h4>Hovězí</h4>
            <img src="res/cow.png" height="150" width="150" alt="kráva">
        </a>
        <a href="products.php?category=veprove" class="btn btn-primary m-4" style="height: 200px; width: 200px">
            <h4>Vepřové</h4>
            <img src="res/pig.png" height="150" width="150" alt="prase">
        </a>
        <a href="products.php?category=kruti" class="btn btn-primary m-4" style="height: 200px; width: 200px">
            <h4>Krůtí</h4>
            <img src="res/turkey.png" height="150" width="150" alt="krůta">
        </a>
        <a href="products.php?category=zverinove" class="btn btn-primary mb-4" style="height: 200px; width: 200px">
            <h4>Zvěřinové</h4>
            <img src="res/deer.png" height="150" width="150" alt="jelen">
        </a>
    </div>
</div>


<?php include "inc/footer.php";?>

