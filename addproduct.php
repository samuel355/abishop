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
                        <h4>Product Add</h4>
                        <h6>Create new product</h6>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <form class="addProductForm" action="" method="POST">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Product Name</label>
                                        <input type="text" name="productName" id="productName" placeholder="Enter Product name">
                                        <span class="text-danger m-1 productNameError"></span>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Category</label>
                                                <select class="select selectCategory" name="categoryId" id="categoryId">
                                                    <option value="Choose Category">Choose Category</option>
                                                    <?php
                                                    include 'php/config.php';

                                                    $fectchCat = mysqli_query($con, "SELECT * FROM categories");
                                                    while ($cats = mysqli_fetch_array($fectchCat)) {
                                                        $id = $cats['categoryId'];
                                                        $name = $cats['categoryName'];
                                                        echo '
                                                            <option value="' . $id . '">' . $name . '</option>
                                                        ';
                                                    }
                                                    ?>

                                                </select>
                                                <span class="text-danger m-1 categoryError"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-sm-4">
                                            <div class="page-header">
                                                <div class="page-btn" style="margin-top: 30px;">
                                                    <a href="javascript:void(0);" class="btn btn-added" data-bs-target="#create" data-bs-toggle="modal">New Category
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Product Total Quantity</label>
                                        <input type="number" name="quantity" id="quantity" placeholder="Enter Product total quantity">
                                        <span class="text-danger m-1 quantityError"></span>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Product Unit Price [GHs.]</label>
                                        <input type="number" name="price" id="price" placeholder="Enter Product price">
                                        <span class="text-danger m-1 priceError"></span>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="description" id="description" class="form-control" placeholder="Product description"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-submit me-2">Save</button>
                                    <a href="productlist" class="btn btn-cancel">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>

        <!-- Add Category Modal  -->

        <div class="modal fade" id="create" tabindex="-1" aria-labelledby="create" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title text-center">Add Category</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" class="addCategoryForm" method="POST">
                            <div class="row">
                                <div class="col-lg-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label>Category Name</label>
                                        <input name="categoryName" id="categoryName" type="text" placeholder="Category Name">
                                        <span class="text-danger text-sm m-1 categoryNameError"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <input name="description" id="description" type="text" placeholder="description">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-submit me-2">Save</button>
                                <a class="btn btn-cancel" data-bs-dismiss="modal">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include_once('includes/script.php') ?>