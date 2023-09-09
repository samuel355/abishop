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
        $fetchCustomer = mysqli_query($con, " SELECT * FROM customers WHERE customerId = '{$customerId}' ");
        if (mysqli_num_rows($fetchCustomer) > 0) {
            while ($data = mysqli_fetch_array($fetchCustomer)) {
                $name = $data['customerName'];
                $phone = $data['phone'];
                $address = $data['address'];
                $email = $data['email'];
                $id = $data['customerId'];

                echo '
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Email </label>
                            <input type="email" placeholder="customer email" name="email" id="email" value=' . $email . '>
                        </div>
                    </div>
                    <input type="hidden" name="customerId" id="customerId" value=' . $id . ' />
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" name="phone" id="phone" placeholder="Customer phone number" value=' . $phone . '>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" name="address" id="address" placeholder="Customer Address" value=' . $addrees . '>
                        </div>
                    </div>
                ';
            }
        } else {
            echo '
            <p class="text-danger mb-5">Select Customer</p>
        ';
        }
    } else {
        echo '<p class="text-danger">Sorry something went wrong adding customer</p>';
    }
}
