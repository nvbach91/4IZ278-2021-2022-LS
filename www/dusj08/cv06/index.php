<?php include './head.php'; ?>
<section class="py-5">
 <main class="container">
     <div class="row">
         <div class="col-lg-3">
             <h1 class="my-4">Fruit Store</h1>
             <?php require './CategoryDisplay.php'; ?>
         </div>
         <div class="col-lg-9">
             <?php require './SlideDisplay.php'; ?>
             <?php require './ProductDisplay.php'; ?>
         </div>
     </div>
 </main>
</section>

 <?php include './foot.php'; ?>