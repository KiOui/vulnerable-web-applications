<?php
require 'connection.php';
session_start();
if (isset($_SESSION['email'])) {
    header('location: products.php');
    exit(); // Stop execution after redirection
}
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+5iPOz6k/7BEMcrr0GbtTUcbO4r5l" crossorigin="anonymous"></script>
    <!-- External CSS -->
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
    <div>
        <?php
            require 'header.php';
        ?>
        <br><br>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <h1><b>SIGN UP</b></h1>
                    <form method="post" action="account_create.php">
                         <div class="mb-3">
                            <input type="email" class="form-control" name="email" placeholder="Email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$">
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control" name="password" placeholder="Password(min. 6 characters)" required pattern=".{6,}">
                        </div>
                        <div class="mb-3">
                            <input type="submit" class="btn btn-primary" value="Sign Up">
                        </div>
                    </form>
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
