<?php
session_start();
include_once('config.php');

if(isset($_GET['getSaleCustomers'])){
    $fetchCustomers = mysqli_query($con,  "SELECT * FROM customers");
    if($fetchCustomers){
        echo '<option value="Search Product">Search Customer</option>';
        while ($customers = mysqli_fetch_array($fetchCustomers)) {
            $customerId = $customers['customerId'];
            $name = $customers['customerName'];
            echo '
                <option value="' . $customerId . '">' . $name . '</option>
            ';
        }
    }
}