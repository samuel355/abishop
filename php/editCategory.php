<?php
session_start();
include 'config.php';
if(isset($_POST['categoryId'])){
    $categoryId = mysqli_real_escape_string($con, $_POST['categoryId']);
    $categoryName = mysqli_real_escape_string($con, $_POST['categoryName']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $author = $_SESSION['name'];
    $update = mysqli_query($con, "UPDATE categories SET categoryName = '{$categoryName}', categoryDescription = '{$description}', createdBy = '{$author}' WHERE categoryId = '{$categoryId}' ");
    if($update) {
        echo 'success';
    }else{
        echo 'Something went wrong updating this category. Try again later';
    }
}else{
    echo 'Sorry Try again later';
}