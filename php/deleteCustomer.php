<?php
session_start();
include_once('config.php');

if(isset($_GET['customerId'])){
    $customerId = $_GET['customerId'];
    $deleteCus = mysqli_query($con, "DELETE FROM customers WHERE customerId = '{$customerId}' ");
    if($deleteCus){
        echo 'success';
    }else{
        echo 'Sorry something went wrong';
    }
}else{
    echo 'Sorry Something went wrong';
}
