<?php
session_start();
require 'check_if_added.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon" href="img/HackerStore.png" />
        <title>Hacker Store</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap 5 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <!-- jQuery library -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- Bootstrap 5 JS Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <!-- External CSS -->
        <link rel="stylesheet" href="css/style.css" type="text/css">
    </head>
    <body>
        <div>
            <?php require 'header.php'; ?>
            <div class="container mt-5">
                <div class="jumbotron">
                    <h1>Welcome to our Hacker Store!</h1>
                    <p>We have the best gadgets, apparel, and accessories for you. No need to hunt around, we have all in one place.</p>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-6 mb-4">
                        <div class="card">
                                <img src="img/flipper.jpg" class="card-img-top" alt="Flipper">
                    
                            <div class="card-body text-center">
                                <h5 class="card-title">Flipper</h5>
                                <p class="card-text">Price: €230,-</p>
                                <?php if (!isset($_SESSION['email'])) { ?>
                                    <p><a href="login.php" role="button" class="btn btn-primary">Buy Now</a></p>
                                <?php } else {
                                    if (check_if_added_to_cart(1)) { ?>
                                        <form method="post" action="cart_remove.php?id=1">
                                            <button type="submit" class="btn btn-danger">Remove from Cart</button>
                                        </form>
                                    <?php } else { ?>
                                        <form method="post" action="cart_add.php?id=1">
                                            <div class="form-group mb-2">
                                                <input type="number" class="form-control" name="quantity" value="1" min="1">
                                            </div>
                                            <div class="form-group">
                                                <input type="submit" value="Add to Cart" class="btn btn-primary">
                                            </div>
                                        </form>
                                    <?php }
                                } ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-4">
                        <div class="card">
                                <img src="img/hoody.jpg" class="card-img-top" alt="Hoody">
                        
                            <div class="card-body text-center">
                                <h5 class="card-title">Hoody</h5>
                                <p class="card-text">Price: €80,-</p>
                                <?php if (!isset($_SESSION['email'])) { ?>
                                    <p><a href="login.php" role="button" class="btn btn-primary">Buy Now</a></p>
                                <?php } else {
                                    if (check_if_added_to_cart(2)) { ?>
                                        <form method="post" action="cart_remove.php?id=2">
                                            <button type="submit" class="btn btn-danger">Remove from Cart</button>
                                        </form>
                                    <?php } else { ?>
                                        <form method="post" action="cart_add.php?id=2">
                                            <div class="form-group mb-2">
                                                <input type="number" class="form-control" name="quantity" value="1" min="1">
                                            </div>
                                            <div class="form-group">
                                                <input type="submit" value="Add to Cart" class="btn btn-primary">
                                            </div>
                                        </form>
                                    <?php }
                                } ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-4">
                        <div class="card">
                                <img src="img/lockpick.jpg" class="card-img-top" alt="Lockpick">
                         
                            <div class="card-body text-center">
                                <h5 class="card-title">Lockpick Set</h5>
                                <p class="card-text">Price: €30,-</p>
                                <?php if (!isset($_SESSION['email'])) { ?>
                                    <p><a href="login.php" role="button" class="btn btn-primary">Buy Now</a></p>
                                <?php } else {
                                    if (check_if_added_to_cart(3)) { ?>
                                        <form method="post" action="cart_remove.php?id=3">
                                            <button type="submit" class="btn btn-danger">Remove from Cart</button>
                                        </form>
                                    <?php } else { ?>
                                        <form method="post" action="cart_add.php?id=3">
                                            <div class="form-group mb-2">
                                                <input type="number" class="form-control" name="quantity" value="1" min="1">
                                            </div>
                                            <div class="form-group">
                                                <input type="submit" value="Add to Cart" class="btn btn-primary">
                                            </div>
                                        </form>
                                    <?php }
                                } ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-4">
                        <div class="card">
                                <img src="img/rubberducky.webp" class="card-img-top" alt="Rubber Ducky">
                 
                            <div class="card-body text-center">
                                <h5 class="card-title">Rubber Ducky</h5>
                                <p class="card-text">Price: €150,-</p>
                                <?php if (!isset($_SESSION['email'])) { ?>
                                    <p><a href="login.php" role="button" class="btn btn-primary">Buy Now</a></p>
                                <?php } else {
                                    if (check_if_added_to_cart(4)) { ?>
                                        <form method="post" action="cart_remove.php?id=4">
                                            <button type="submit" class="btn btn-danger">Remove from Cart</button>
                                        </form>
                                    <?php } else { ?>
                                        <form method="post" action="cart_add.php?id=4">
                                            <div class="form-group mb-2">
                                                <input type="number" class="form-control" name="quantity" value="1" min="1">
                                            </div>
                                            <div class="form-group">
                                                <input type="submit" value="Add to Cart" class="btn btn-primary">
                                            </div>
                                        </form>
                                    <?php }
                                } ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-4">
                        <div class="card">
                                <img src="img/flag.jpg" class="card-img-top" alt="Flag">
                   
                            <div class="card-body text-center">
                                <h5 class="card-title">Flag</h5>
                                <p class="card-text">Price: €1337,-</p>
                                <?php if (!isset($_SESSION['email'])) { ?>
                                    <p><a href="login.php" role="button" class="btn btn-primary">Buy Now</a></p>
                                <?php } else {
                                    if (check_if_added_to_cart(5)) { ?>
                                        <form method="post" action="cart_remove.php?id=5">
                                            <button type="submit" class="btn btn-danger">Remove from Cart</button>
                                        </form>
                                    <?php } else { ?>
                                        <form method="post" action="cart_add.php?id=5">
                                            <div class="form-group mb-2">
                                                <input type="number" class="form-control" name="quantity" value="1" min="1">
                                            </div>
                                            <div class="form-group">
                                                <input type="submit" value="Add to Cart" class="btn btn-primary">
                                            </div>
                                        </form>
                                    <?php }
                                } ?>
                            </div>
                        </div>
                    </div>
                    <!-- Repeat for all other products -->
                </div>
            </div>
            <br><br><br><br><br><br><br><br>
            <?php require 'footer.php'; ?>
        </div>
    </body>
</html>