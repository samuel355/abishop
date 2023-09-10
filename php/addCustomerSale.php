<?php
session_start();
include_once("config.php");

if (isset($_POST['customerId'])) {
    $customerId = mysqli_real_escape_string($con, $_POST['customerId']);
    $customerEmail = mysqli_real_escape_string($con, $_POST['customerEmail']);
    $customerAddress = mysqli_real_escape_string($con, $_POST['customerAddress']);
    $customerPhone = mysqli_real_escape_string($con, $_POST['customerPhone']);
    $paymentOption = mysqli_real_escape_string($con, $_POST['paymentOptions']);

    $totalAmount = mysqli_real_escape_string($con, $_POST['totalAmount']);
    $amountPaid = mysqli_real_escape_string($con, $_POST['amountPaid']);
    $amountRemaining = mysqli_real_escape_string($con, $_POST['amountRemaining']);

    $paymentDate = date('d-m-Y');
    $nextPaymentDate = mysqli_real_escape_string($con, $_POST['nextPaymentDate']);
    $shortNote = mysqli_real_escape_string($con, $_POST['shortNote']);

    $userId = $_SESSION['uid'];

    echo (' cusId: ' . $customerId . ' cusEmail ' . $customerEmail . 'cusAddress ' . $customerAddress . ' cusPhone ' . $customerPhone . ' paymentOps ' . $paymentOption . 'totalAmt ' . $totalAmount . 'amtPd ' . $amountPaid . 'amtRem ' . $amountRemaining . 'payD ' . $paymentDate . 'nexpd ' . $nextPaymentDate . 'shortNt ' . $shortNote . 'userId ' . $userId);
}
