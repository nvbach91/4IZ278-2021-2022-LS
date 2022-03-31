<!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="utf-8">
     <<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <meta name="description" content="Fruit Shop">
     <title>FruitStore</title>
     <link rel="shortcut icon" href="./favicon.png">
     <link rel="stylesheet" href="https://bootswatch.com/4/journal/bootstrap.min.css">
     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
     <link rel="stylesheet" href="<?php echo isset($contextPath) ? $contextPath : '.'; ?>/css/styles.css">
 </head>

 <body>
     <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
         <div class="container">
             <img class="logo" height="32px" padding="5px" src="./favicon.png" alt="logo">
             <a class="navbar-brand" href="#">fruitstore.</a>
             <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                 <span class="navbar-toggler-icon"></span>
             </button>
             <div class="collapse navbar-collapse" id="navbarResponsive">
                 <ul class="navbar-nav ml-auto">
                     <li class="nav-item active">
                         <a class="nav-link" href="#">Home
                             <span class="sr-only">(current)</span>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link" href="#">About</a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link" href="#">Services</a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link" href="#">Contact</a>
                     </li>
                 </ul>
             </div>
         </div>
     </nav>