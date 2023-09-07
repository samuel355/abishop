<?php
include_once('includes/redirect.php');
include_once('includes/head.php');
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
                        <h4>Purchase Add</h4>
                        <h6>Add/Update Purchase</h6>
                    </div>
                </div>
                <form action="">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Supplier Name</label>
                                        <div class="row">
                                            <div class="col-lg-10 col-sm-10 col-10">
                                                <select class="select">
                                                    <option>Select</option>
                                                    <option>Supplier</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-2 col-sm-2 col-2 ps-0">
                                                <div class="add-icon">
                                                    <a href="javascript:void(0);"><img src="assets/img/icons/plus1.svg" alt="img"></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Purchase Date </label>
                                        <div class="input-groupicon">
                                            <input type="text" placeholder="DD-MM-YYYY" class="datetimepicker">
                                            <div class="addonset">
                                                <img src="assets/img/icons/calendars.svg" alt="img">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Product Name</label>
                                        <select class="select">
                                            <option>Choose</option>
                                            <option>Supplier Name</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Reference No.</label>
                                        <input type="text">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-6">
                                    <div class="form-group">
                                        <label>Product Name</label>
                                        <select class="js-example-basic-single form-small select2 selectSaleProduct">
                                            <option value="Search Product">Search Product</option>
                                            <?php
                                            include 'php/config.php';

                                            $fetchProducts = mysqli_query($con, "SELECT * FROM products");
                                            while ($products = mysqli_fetch_array($fetchProducts)) {
                                                $prodId = $products['productId'];
                                                $name = $products['productName'];
                                                echo '
                                                        <option value="' . $prodId . '">' . $name . '</option>
                                                    ';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="table-responsive tableProducts">

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 float-md-right">
                                    <div class="total-order">
                                        <ul class="moneyPart">

                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Order Tax</label>
                                        <input type="text">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Discount</label>
                                        <input type="text">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Shipping</label>
                                        <input type="text">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select class="select">
                                            <option>Choose Status</option>
                                            <option>Completed</option>
                                            <option>Inprogress</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <a href="javascript:void(0);" class="btn btn-submit me-2">Submit</a>
                                    <a href="purchaselist.html" class="btn btn-cancel">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="assets/js/jquery-3.6.0.min.js"></script>

    <script src="assets/js/feather.min.js"></script>

    <script src="assets/js/jquery.slimscroll.min.js"></script>

    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap4.min.js"></script>

    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/plugins/select2/js/select2.min.js"></script>
    <script src="assets/plugins/select2/js/custom-select.js"></script>

    <script src="assets/js/moment.min.js"></script>
    <script src="assets/js/bootstrap-datetimepicker.min.js"></script>

    <script src="assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
    <script src="assets/plugins/sweetalert/sweetalerts.min.js"></script>

    <script src="assets/plugins/toastr/toastr.min.js"></script>
    <script src="assets/plugins/toastr/toastr.js"></script>


    <script src="assets/js/script.js"></script>

    <script src="js/addsale.js"></script>

</body>

</html>