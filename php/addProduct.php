<?php
session_start();
include_once('config.php');

if (isset($_POST['categoryId'])) {
    $categoryId = mysqli_real_escape_string($con, $_POST['categoryId']);
    $productName = mysqli_real_escape_string($con, $_POST['productName']);
    $quantity = mysqli_real_escape_string($con, $_POST['quantity']);
    $price = mysqli_real_escape_string($con, $_POST['price']);
    $description = mysqli_real_escape_string($con, $_POST['description']);

    //generate productId
    $generate = rand(time(), 100000000) . substr($productName, 0, 3);
    $shuffle = str_shuffle($generate);
    $productId = str_replace(" ", "", $shuffle);
    $author = $_SESSION['name'];
    $now = date('Y-m-d') . " " . "At" . " " . date('h:i:s');

    //get categoryName 
    $getCategory = mysqli_query($con, "SELECT categoryName FROM categories WHERE categoryId = '{$categoryId}' ");
    if ($getCategory) {
        $catData = mysqli_fetch_assoc($getCategory);
        $catName = $catData['categoryName'];

        //echo 'pid: '.$productId. 'auth '. $author . 'date '. $now. 'pid '. $productId. ' catid'. $categoryId, ' pname'. $productName. ' qty'. $quantity. ' price'. $price . ' desc ' .$description;

        $insertProduct = mysqli_query($con, "INSERT INTO products(productId, productName, quantity, price, productDescription, addedBy, addedDate, categoryId, categoryName) VALUES('{$productId}', '{$productName}', '{$quantity}', '{$price}', '{$description}', '{$author}', '{$now}', '{$categoryId}', '{$catName}')");
        if ($insertProduct) {
            echo 'success';
        } else {
            echo 'Something went wrong';
        }
    } else {
        echo 'Sorry Error occurred';
    }
} else {
    echo 'Error occurred adding products. Try again later';
}
