<?php
session_start();
include_once('config.php');

if(isset($_POST['email'])){
    $firstName = mysqli_real_escape_string($con, $_POST['firstName']);
    $lastName = mysqli_real_escape_string($con, $_POST['lastName']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $encrypt_password = md5($password);
    $generate = rand(time(), 100000000).$firstName;

    $now = date('Y-m-d') . " " . "At" . " " . date('h:i:s');

    //shuffle string and remove spaces
    $unique_id = str_shuffle($generate);
    $removeSpace = trim($unique_id);
    $userId = str_replace(" ", "", $removeSpace);
    
    //check email if it exist in the database
    $checkEmail = mysqli_query($con, "SELECT * FROM users WHERE email = '{$email}' ");

    if(mysqli_num_rows($checkEmail) > 0 ){
        echo"email exist";
    }else{
        $insertUser = mysqli_query($con, "INSERT INTO users (userId, firstName, lastName, phone, address, password, dateAdded, email) VALUES('{$userId}', '{$firstName}', '{$lastName}', '{$phone}', '{$address}', '{$encrypt_password}', '{$now}', '{$email}')");
        if($insertUser){
            $selectUser = mysqli_query($con, "SELECT * FROM users WHERE email = '{$email}' ");
            if (mysqli_num_rows($selectUser) > 0) {
                $result = mysqli_fetch_assoc($selectUser);
                $_SESSION['login'] = 'success';
                $_SESSION['uid'] = $result['userId'];
                $_SESSION['email'] = $result['email'];
                $_SESSION['name'] = $result['firstName']. ' '. $result['lastName'];
                $_SESSION['userType'] = $result['userType'];
                echo 'success';
            } else {
                echo "This email address not Exist!";
            }
        }else{
            echo 'Sorry Something went wrong with your input';
        }
    }
}else{
    echo 'Server Error, Try again later';
}
