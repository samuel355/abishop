<?php
session_start();
include_once('config.php');

if (isset($_GET['email'])) {
    $email = mysqli_real_escape_string($con, $_GET['email']);
    $now = date('Y-m-d') . " " . "At" . " " . date('h:i:s');
    $queryUser = mysqli_query($con, "UPDATE users SET logoutDate = '{$now}' WHERE email= '{$email}' ");
    if($queryUser){
        echo 'success';
        unset($_SESSION['login']);
        unset($_SESSION['uid']);
        unset($_SESSION['email']);
        unset($_SESSION['name']);
        unset($_SESSION['userType']);
    } else {
        echo 'Sorry Something went wrong login you out. Try again later';
    }
}else{
    echo 'Sorry Something went wrong login you out. Try again later';
}
