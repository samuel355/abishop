<?php
session_start();
include_once('config.php');

if (isset($_POST['email'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);

    $queryUser = mysqli_query($con, "SELECT * FROM users WHERE email = '{$email}'");
    $count = mysqli_num_rows($queryUser);
    if ($count > 0) {
        echo 'success';
        $_SESSION['emailExist'] = $email;
    } else {
        echo 'This email ' .$email. ' is not associated with any account';
    }
} else {
    echo 'Server Error, Try again later';
}
