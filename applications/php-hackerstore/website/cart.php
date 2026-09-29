<?php
session_start();
require 'connection.php';
require 'functions.php'; // Include a file for common functions

if (!isset($_SESSION['email'])) {
    header('location: login.php');
    exit(); // Stop execution after redirection
}
$user_id = $_SESSION['id'];

$user_query = "SELECT budget FROM users WHERE id = :user_id";
$user_stmt = $con->prepare($user_query);
$user_stmt->bindParam(':user_id', $user_id);
$user_stmt->execute();
$user = $user_stmt->fetch(PDO::FETCH_ASSOC);
$budget = $user['budget'];

$user_products_query = "SELECT it.id, it.name, it.price, ut.quantity FROM users_items ut INNER JOIN items it ON it.id = ut.item_id WHERE ut.user_id = :user_id";
$user_products_stmt = $con->prepare($user_products_query);
$user_products_stmt->bindParam(':user_id', $user_id);
$user_products_stmt->execute();

$no_of_user_products = $user_products_stmt->rowCount();
$sum = 0;

if ($no_of_user_products > 0) {
    while ($row = $user_products_stmt->fetch(PDO::FETCH_ASSOC)) {
        $sum += $row['price'] * $row['quantity'];
    }
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
    <!-- jquery library -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+5iPOz6k/7BEMcrr0GbtTUcbO4r5l" crossorigin="anonymous"></script>
    <!-- External CSS -->
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
<div>
    <?php require 'header.php'; ?>
    <br>
    <div class="container">
        <h3>Your Budget: €<?php echo number_format($budget, 2); ?></h3>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Item Number</th>
                    <th>Item Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php
            $user_products_stmt->execute(); // Execute the query again to reset the cursor
            $counter = 1;
            while ($row = $user_products_stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <tr>
                    <td><?php echo $counter ?></td>
                    <td><?php echo htmlspecialchars($row['name']) ?></td>
                    <td>€<?php echo htmlspecialchars($row['price']) ?></td>
                    <td>
                        <form method="post" action="update_quantity.php?id=<?php echo $row['id']; ?>">
                            <input type="number" name="quantity" value="<?php echo htmlspecialchars($row['quantity']) ?>" min="1" class="form-control">
                            <input type="submit" value="Update" class="btn btn-primary btn-sm mt-2">
                        </form>
                    </td>
                    <td>€<?php echo htmlspecialchars($row['price'] * $row['quantity']) ?></td>
                    <td><a href='cart_remove.php?id=<?php echo $row['id'] ?>' class="btn btn-danger btn-sm">Remove</a></td>
                </tr>
                <?php $counter++;
            } ?>
            <tr>
                <td></td>
                <td>Total</td>
                <td></td>
                <td></td>
                <td>€<?php echo number_format($sum, 2); ?></td>
                <td>
                    <?php if ($no_of_user_products == 0) { ?>
                        <button class="btn btn-primary" disabled>Confirm Order</button>
                    <?php } elseif ($sum > $budget) { ?>
                        <button class="btn btn-primary" disabled>Insufficient Budget</button>
                    <?php } else { ?>
                        <a href="success.php?id=<?php echo $user_id ?>" class="btn btn-primary">Confirm Order</a>
                    <?php } ?>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <br><br><br><br><br><br><br><br><br><br>
    <?php require 'footer.php'; ?>
</div>
</body>
</html>
