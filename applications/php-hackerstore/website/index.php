<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon" href="img/HackerStore.png" />
        <title>Hacker Store</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- latest compiled and minified CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <!-- Latest compiled and minified javascript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <!-- External CSS -->
        <link rel="stylesheet" href="css/style.css" type="text/css">
    </head>
    <body>
        <div>
           <?php
            require 'header.php';
            ?>
           <div id="bannerImage">
               <div class="container">
                   <center>
                   <div id="bannerContent" class="mt-5">
                       <h1>Hacker store</h1>
                       <p></p>
                       <a href="products.php" class="btn btn-danger">Shop now</a>
                   </div>
                   </center>
               </div>
           </div>
           <div class="container mt-5">
               <div class="row">
                   <div class="col-md-6">
                       <div class="card">
                           <a href="products.php">
                                <img src="img/hoody.jpg" class="card-img-top" alt="Hoodies">
                           </a>
                           <div class="card-body text-center">
                                <h5 class="card-title">Hoodies</h5>
                                <p class="card-text">Best hoodies to hide in the dark.</p>
                           </div>
                       </div>
                   </div>
                   <div class="col-md-6">
                       <div class="card">
                           <a href="products.php">
                               <img src="img/lockpick.jpg" class="card-img-top" alt="Lockpicking">
                           </a>
                           <div class="card-body text-center">
                                <h5 class="card-title">Lockpicking</h5>
                                <p class="card-text">To practice your lockpicking skills.</p>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
            <br><br><br><br><br><br>
            <?php
            require 'footer.php';
            ?>
        </div>
    </body>
</html>
