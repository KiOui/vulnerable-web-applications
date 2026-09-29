<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php">Hacker Store</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <?php
                if (isset($_SESSION['email'])) {
                    require 'connection.php';

                    $user_id = $_SESSION['id'];
                    $cart_count_query = "SELECT COUNT(*) AS cart_count FROM users_items WHERE user_id = :user_id AND status = 'Added to cart'";
                    $cart_count_stmt = $con->prepare($cart_count_query);
                    $cart_count_stmt->bindParam(':user_id', $user_id);
                    $cart_count_stmt->execute();
                    $cart_count_row = $cart_count_stmt->fetch(PDO::FETCH_ASSOC);
                    $cart_count = $cart_count_row['cart_count'];
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php">
                            <span class="bi bi-cart"></span> Cart <span class="badge bg-primary"><?php echo $cart_count; ?></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="settings.php"><span class="bi bi-gear"></span> Settings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php"><span class="bi bi-box-arrow-right"></span> Logout</a>
                    </li>
                    <?php
                } else {
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="signup.php"><span class="bi bi-person-plus"></span> Sign Up</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php"><span class="bi bi-box-arrow-in-right"></span> Login</a>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </div>
</nav>
