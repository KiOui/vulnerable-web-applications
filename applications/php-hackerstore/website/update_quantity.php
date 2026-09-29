<?php

require 'connection.php';
require 'functions.php'; // Include common functions
session_start();
$item_id = $_GET['id'];
$user_id = $_SESSION['id'];
$quantity = sanitize($_POST['quantity']);

/*
if ($quantity <= 0) {
    $quantity = 1; // Ensure minimum quantity is 1
}
*/
$update_quantity_query = "UPDATE users_items SET quantity = :quantity WHERE user_id = :user_id AND item_id = :item_id";
$update_quantity_stmt = $con->prepare($update_quantity_query);
$update_quantity_stmt->bindParam(':quantity', $quantity);
$update_quantity_stmt->bindParam(':user_id', $user_id);
$update_quantity_stmt->bindParam(':item_id', $item_id);
$update_quantity_stmt->execute();

header('location: cart.php');
