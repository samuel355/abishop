<?php
session_start();
include_once("config.php");
if(isset($_GET['showOptions'])){
    $userId = $_SESSION['uid'];

    $query = "SELECT * FROM cart WHERE userId='{$userId}' ";
    $fetch = mysqli_query($con, $query);
    if(mysqli_num_rows($fetch) > 0){
        echo "success";
    }else{
        echo "none";
    }
}