<?php
session_start();
include_once('config.php');

if (isset($_POST['categoryName'])) {
    $categoryName = mysqli_real_escape_string($con, $_POST['categoryName']);
    $description = mysqli_real_escape_string($con, $_POST['description']);

    $generate = rand(time(), 100000000) . $categoryName;
    $shuffle = str_shuffle($generate);
    $categoryId = str_replace(" ", "", $shuffle);

    $checkCategory = mysqli_query($con, "SELECT * FROM categories WHERE categoryName = '{$categoryName}' ");

    if (mysqli_num_rows($checkCategory) > 0) {
        echo 'This category name ' . $categoryName . ' Already exist';
    } else {
        $insertCategory = mysqli_query($con, "INSERT INTO categories (categoryId, categoryName, categoryDescription, createdBy) VALUES('{$categoryId}', '{$categoryName}', '{$description}', '{$_SESSION['name']}')");
        echo 'success';
    }
} else {
    echo 'Sorry Try again. Something went wrong adding category';
}
