<?php
session_start();
include_once("config.php");

if (isset($_GET['productId'])) {
    $pId = $_GET["productId"];
    $pQty = $_GET['quantity'];
    $subTotal = $_GET['subtotal'];
    $price = $_GET['price'];
    $newQuantity = $pQty - 1;
    $newSubTotal = $newQuantity * $price;

    $updateCart = mysqli_query($con, "UPDATE cart SET quantity='{$newQuantity}', subtotal= '{$newSubTotal}' WHERE productId = '{$pId}'");
    if ($updateCart) {
        echo 'success';
    }
}
