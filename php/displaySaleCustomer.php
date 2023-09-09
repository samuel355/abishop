<?php
session_start();
include_once('config.php');

if (isset($_GET['customerId'])) {
    $customerId = $_GET['customerId'];
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
}
