<?php
session_start();
include_once('config.php');

if (isset($_POST['email'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $queryUser = mysqli_query($con, "SELECT * FROM users WHERE email = '{$email}'");
    $count = mysqli_num_rows($queryUser);
    if ($count > 0) {
        $data = mysqli_fetch_assoc($queryUser);
        $dbPassword = $data['password'];
        $hassPassword = md5($password);
        if ($dbPassword === $hassPassword) {
            $now = date('Y-m-d') . " " . "At" . " " . date('h:i:s');
            $updateQuery = mysqli_query($con, "UPDATE users SET loginDate = '{$now}' WHERE email = '{$email}' ");
            $_SESSION['login'] = 'success';
            $_SESSION['uid'] = $data['userId'];
            $_SESSION['email'] = $data['email'];
            $_SESSION['name'] = $data['firstName'] . ' ' . $data['lastName'];
            $_SESSION['userType'] = $data['userType'];
            echo 'success';
        } else {
            echo 'Password or Email is incorrect';
        }
    } else {
        echo 'Email does not exist';
    }
} else {
    echo 'Server Error, Try again later';
}
