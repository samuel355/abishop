<?php
include_once('includes/redirect.php');
include_once('includes/head.php');

include_once('php/config.php');

if (isset($_GET['customerId'])) {
    $customerId = $_GET['customerId'];
    $fetchCustomer = mysqli_query($con, "SELECT * FROM customers WHERE customerId = '{$customerId}' ");
    if (mysqli_num_rows($fetchCustomer) > 0) {
        $data = mysqli_fetch_array($fetchCustomer);
        $name = $data['customerName'];
        $phone = $data['phone'];
        $address = $data['address'];
        $email = $data['email'];
    }else{
        header('Location: /customers');
    }
}
?>

<body>
    <div id="global-loader">
        <div class="whirly-loader"> </div>
    </div>

    <div class="main-wrapper">

        <?php include_once('includes/header.php');
        include_once('includes/sidebar.php') ?>

        <div class="page-wrapper">
            <div class="content">
                <div class="page-header">
                    <div class="page-title">
                        <h4>Edit Customer Management</h4>
                        <h6>Edit/Update Customer</h6>
                    </div>
                </div>

                <form action="" class="editCustomerForm" method="POST">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Customer Name</label>
                                        <input type="text" name="name" id="name" value='<?php echo $name ?>'>
                                        <span class="text-danger m-1 nameError"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="email" id="email" value="<?php echo $data['email'] ?> ">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="text" name="phone" id="phone" value=" <?php echo $phone ?> ">
                                        <span class="text-danger m-1 phoneError"></span>
                                    </div>
                                </div>
                                <input type="hidden" name="customerId" id="customerId" value="<?php echo $customerId ?>">
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" name="address" id="address" value=" <?php echo $address ?> ">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <button type="submit" href="javascript:void(0);" class="btn btn-submit me-2">Update</button>
                                    <a href="javascript:void(0);" class="btn btn-cancel">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>


    <?php include_once('includes/script.php') ?>