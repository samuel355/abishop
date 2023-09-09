<?php
session_start();
include_once('config.php');

if (isset($_POST['name'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $email = mysqli_real_escape_string($con, $_POST['email']);

    $generate = rand(time(), 100000000) . substr($name, 0, 3);
    $shuffle = str_shuffle($generate);
    $customerId = str_replace(" ", "", $shuffle);
    $author = $_SESSION['uid'];
    $now = date('d-m-Y') . " " . "At" . " " . date('h:i:s');

    $insert = mysqli_query($con, "INSERT INTO customers(customerId, customerName, phone, address, email, dateAdded, userId) VALUES ('{$customerId}', '{$name}', '{$phone}', '{$address}', '{$email}', '{$now}', '{$author}' )");
    if ($insert) {
        echo 'success';
    } else {
        echo 'Sorry something went wrong adding customer';
    }
}
