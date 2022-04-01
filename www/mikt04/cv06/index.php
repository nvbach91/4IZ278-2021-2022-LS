<?php include './include/head.php'; ?>
<section class="py-5">
 <main class="container">
     <div class="row">
         <div class="col-lg-3">
             <h1 class="my-4">Star Wars Funko Store</h1>
             <?php require './main/CategoryDisplay.php'; ?>
         </div>
         <div class="col-lg-9">
             <?php require './main/SlideDisplay.php'; ?>
             <?php require './main/ProductDisplay.php'; ?>
         </div>
     </div>
 </main>
</section>

 <?php include './include/foot.php'; ?>