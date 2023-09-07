<?php
session_start();
include_once('config.php');

if (isset($_GET['catId'])) {
    $categoryId = mysqli_real_escape_string($con, $_GET['catId']);
    $deleteCat = mysqli_query($con, "DELETE FROM categories WHERE categoryId = '{$categoryId}' ");

    if ($deleteCat) {
        //Delete products with corresponding categoryId 
        $deleteProducts = mysqli_query($con, "DELETE FROM products WHERE categoryId = '{$categoryId}' ");
        if($deleteProducts){
            echo 'success'; 
        }else{
            echo 'Something went wrong';
        }
    } else {
        echo 'Sorry. Try again later';
    }
}
