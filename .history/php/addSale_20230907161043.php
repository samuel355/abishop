<?php
session_start();
include_once('config.php');

if (isset($_GET['productId'])) {
    $productId = $_GET['productId'];
    $userId = $_SESSION['uid'];
    $now = date('Y-m-d');
    $quantity = 1;
    $productPrice = 0;
    $subTotal=0;

    $select = mysqli_query($con, "SELECT * FROM products WHERE productId ='{$productId}' ");
    if($select){
        $row = mysqli_fetch_assoc($select);
        $productPrice = $row['price'];
        $subTotal = $productPrice * $quantity;
    }

    $checkProduct = mysqli_query($con, "SELECT * FROM cart WHERE productId = '{$productId}' ");
    if ($checkProduct) {
        if (mysqli_num_rows($checkProduct) > 0) {
            echo 'Product already in cart. Increase the quantity';
        } else {
            $addToCart = mysqli_query($con, "INSERT INTO cart(productId, quantity, price, subtotal, userId, dateCreated) VALUES('{$productId}', '{$quantity}', '{$productPrice}', '{$subTotal}', '{$userId}', '{$now}')");
            if ($addToCart) {
                echo $productId;
            } else {
                echo 'Sorry something went wrong';
            }
        }
    } else {
        echo 'Sorry Something went wrong';
    }
} else {
    echo 'Something went wrong';
}
