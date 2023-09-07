<?php
session_start();
include_once('config.php');

if (isset($_POST['categoryId']) && isset($_POST['productId'])) {
    $categoryId = mysqli_real_escape_string($con, $_POST['categoryId']);
    $productId = mysqli_real_escape_string($con, $_POST['productId']);
    $productName = mysqli_real_escape_string($con, $_POST['productName']);
    $quantity = mysqli_real_escape_string($con, $_POST['quantity']);
    $price = mysqli_real_escape_string($con, $_POST['price']);
    $description = mysqli_real_escape_string($con, $_POST['description']);

    $author = $_SESSION['name'];
    $now = date('Y-m-d') . " " . "At" . " " . date('h:i:s');

    //get categoryName 
    $getCategory = mysqli_query($con, "SELECT categoryName FROM categories WHERE categoryId = '{$categoryId}' ");
    if ($getCategory) {
        $catData = mysqli_fetch_assoc($getCategory);
        $catName = $catData['categoryName'];

        $updateProduct = mysqli_query($con, "UPDATE products SET productName='{$productName}', quantity='{$quantity}', price='{$price}', productDescription='{$description}', addedBy='{$author}', addedDate='{$now}', categoryId='{$categoryId}', categoryName='{$catName}' WHERE productId='{$productId}' ");

        //$insertProduct = mysqli_query($con, "INSERT INTO products(productId, productName, quantity, price, productDescription, addedBy, addedDate, categoryId, categoryName) VALUES('{$productId}', '{$productName}', '{$quantity}', '{$price}', '{$description}', '{$author}', '{$now}', '{$categoryId}', '{$catName}')");
        if ($updateProduct) {
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
