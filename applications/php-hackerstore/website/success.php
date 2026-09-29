<?php
session_start();
require 'connection.php';

if (!isset($_SESSION['email'])) {
    header('location: index.php');
    exit(); // Stop execution after redirection
}

$user_id = $_GET['id'];
$user_query = "SELECT budget FROM users WHERE id = :user_id";
$user_stmt = $con->prepare($user_query);
$user_stmt->bindParam(':user_id', $user_id);
$user_stmt->execute();
$user = $user_stmt->fetch(PDO::FETCH_ASSOC);
$budget = $user['budget'];

$order_total_query = "SELECT SUM(it.price * ut.quantity) as total FROM users_items ut INNER JOIN items it ON it.id = ut.item_id WHERE ut.user_id = :user_id AND ut.status = 'Added to cart'";
$order_total_stmt = $con->prepare($order_total_query);
$order_total_stmt->bindParam(':user_id', $user_id);
$order_total_stmt->execute();
$order_total = $order_total_stmt->fetch(PDO::FETCH_ASSOC)['total'];

if ($budget >= $order_total) {
    $confirm_query = "UPDATE users_items SET status = 'Confirmed' WHERE user_id = :user_id";
    $confirm_query_stmt = $con->prepare($confirm_query);
    $confirm_query_stmt->bindParam(':user_id', $user_id);
    $confirm_query_stmt->execute();

    $new_budget = $budget - $order_total;
    $update_budget_query = "UPDATE users SET budget = :new_budget WHERE id = :user_id";
    $update_budget_stmt = $con->prepare($update_budget_query);
    $update_budget_stmt->bindParam(':new_budget', $new_budget);
    $update_budget_stmt->bindParam(':user_id', $user_id);
    $update_budget_stmt->execute();

    $flag_purchased_query = "SELECT COUNT(*) as flag_count FROM users_items WHERE user_id = :user_id AND item_id = 5 AND status = 'Confirmed'";
    $flag_purchased_stmt = $con->prepare($flag_purchased_query);
    $flag_purchased_stmt->bindParam(':user_id', $user_id);
    $flag_purchased_stmt->execute();
    $flag_purchased = $flag_purchased_stmt->fetch(PDO::FETCH_ASSOC)['flag_count'] > 0;

    if ($flag_purchased) {
        $message = "Your order is confirmed. Thank you for shopping with us. You have purchased the 'Flag to buy'. <h2>hacktraining{4z1q5rru7ackx95phlp0uiy6p}</h2>";
    } else {
        $message = "Your order is confirmed. Thank you for shopping with us.";
    }
} else {
    echo "Insufficient budget.";
    echo '<meta http-equiv="refresh" content="5;url=cart.php" />';
}
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
    <!-- External CSS -->
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
<div>
    <?php require 'header.php'; ?>
    <br>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <p><?php echo $message; ?> <a href="products.php">Click here</a> to purchase any other item.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require 'footer.php'; ?>
</div>
</body>
</html>
