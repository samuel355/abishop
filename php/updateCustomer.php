<?php
session_start();
include_once('config.php');

if(isset($_POST['customerId'])){
    $customerId = mysqli_real_escape_string($con, $_POST['customerId']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $address = mysqli_real_escape_string($con, $_POST['address']);

    $update = mysqli_query($con, "UPDATE customers SET customerName = '{$name}', phone='{$phone}', address='{$address}', email='{$email}' WHERE customerId ='{$customerId}' ");
    if($update){
        echo 'success';
    }else{
        echo 'Sorry something went wrong';
    }
    
}