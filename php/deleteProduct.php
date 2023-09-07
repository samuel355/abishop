<?php
session_start();
include_once('config.php');

if (isset($_GET['productId'])) {
    $productId = mysqli_real_escape_string($con, $_GET['productId']);
    $deleteCat = mysqli_query($con, "DELETE FROM products WHERE productId = '{$productId}' ");

    if ($deleteCat) {
        echo 'success';
    } else {
        echo 'Sorry. Try again later';
    }
}
