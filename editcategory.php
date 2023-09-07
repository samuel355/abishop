<?php
include_once('includes/redirect.php');
include_once('includes/head.php');

include_once('php/config.php');
if (isset($_GET['catId'])) {
    $catId = $_GET['catId'];

    $fetchCat = mysqli_query($con, "SELECT * FROM categories WHERE categoryId= '{$catId}' ");
    if ($fetchCat) {
        $data = mysqli_fetch_assoc($fetchCat);
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
                        <h4>Product Edit Category</h4>
                        <h6>Edit a product Category</h6>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <form action="" class="editCategoryForm" method="POST">
                            <div class="row">

                                <div class="col-lg-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Category Name</label>
                                        <input name="categoryName" id="categoryName" type="text" value="<?php echo $data['categoryName'] ?>">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Category Code</label>
                                        <input name="catId" id="catId" type="text" disabled value="<?php echo $data['categoryId'] ?>">
                                    </div>
                                </div>
                                <input type="hidden" name="categoryId" id="categoryId" value="<?php echo $data['categoryId'] ?>">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="description" id="description" class="form-control"><?php echo $data['categoryDescription'] ?></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-submit me-2">Submit</button>
                                    <a href="categorylist" class="btn btn-cancel">Cancel</a>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <?php include_once('includes/script.php') ?>