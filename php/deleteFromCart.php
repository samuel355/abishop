<?php
session_start();
include_once("config.php");

if(isset($_GET['productId'])){
    $pId = $_GET["productId"];

    $deleteProduct = mysqli_query($con, "DELETE FROM cart WHERE productId = '{$pId}'");
    if($deleteProduct){
        echo 'success';
    }
}