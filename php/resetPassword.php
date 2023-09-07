<?php
session_start();
include_once('config.php');

if (isset($_POST['email'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $hashPassword = md5($password);

    $queryUser = mysqli_query($con, "UPDATE users SET password ='{$hashPassword}' WHERE email = '{$email}'");

    if ($queryUser) {
        echo 'success';
        unset($_SESSION['emailExist']);
    } else {
        echo 'Something went wrong resetting your password. Try again later.';
    }
} else {
    echo 'Something went wrong resetting your password. Try again later.';
}
