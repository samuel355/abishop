<?php
include_once('includes/redirect.php');
include_once('includes/head.php');
?>

<body>
    <!-- <div id="global-loader">
        <div class="whirly-loader"> </div>
    </div> -->

    <div class="main-wrapper">

        <?php include_once('includes/header.php');
        include_once('includes/sidebar.php') ?>

        <div class="page-wrapper">
            <div class="content">
                <div class="page-header">
                    <div class="page-title">
                        <h4>Product Category list</h4>
                        <h6>View/Search product Category</h6>
                    </div>
                    <div class="page-btn">
                        <a href="javascript:void(0);" class="btn btn-added" data-bs-target="#create" data-bs-toggle="modal">
                            <img src="assets/img/icons/plus.svg" class="me-1" alt="img">Add Category
                        </a>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="table-top">
                            <div class="search-set">
                                <div class="search-path">
                                    <a class="btn btn-filter" id="filter_search">
                                        <img src="assets/img/icons/filter.svg" alt="img">
                                        <span><img src="assets/img/icons/closes.svg" alt="img"></span>
                                    </a>
                                </div>
                                <div class="search-input">
                                    <a class="btn btn-searchset"><img src="assets/img/icons/search-white.svg" alt="img"></a>
                                </div>
                            </div>
                            <div class="wordset">
                                <ul>
                                    <li>
                                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img src="assets/img/icons/pdf.svg" alt="img"></a>
                                    </li>
                                    <li>
                                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img src="assets/img/icons/excel.svg" alt="img"></a>
                                    </li>
                                    <li>
                                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img src="assets/img/icons/printer.svg" alt="img"></a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="card" id="filter_inputs">
                            <div class="card-body pb-0">
                                <div class="row">
                                    <div class="col-lg-2 col-sm-6 col-12">
                                        <div class="form-group">
                                            <select class="select">
                                                <option>Choose Category</option>
                                                <option>Computers</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-sm-6 col-12">
                                        <div class="form-group">
                                            <select class="select">
                                                <option>Choose Sub Category</option>
                                                <option>Fruits</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-sm-6 col-12">
                                        <div class="form-group">
                                            <select class="select">
                                                <option>Choose Sub Brand</option>
                                                <option>Iphone</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-1 col-sm-6 col-12 ms-auto">
                                        <div class="form-group">
                                            <a class="btn btn-filters ms-auto"><img src="assets/img/icons/search-whites.svg" alt="img"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table datanew">
                                <thead>
                                    <tr>
                                        <th>
                                            <label class="checkboxs">
                                                <input type="checkbox" id="select-all">
                                                <span class="checkmarks"></span>
                                            </label>
                                        </th>
                                        <th>Category name</th>
                                        <th>Category Code</th>
                                        <th>Description</th>
                                        <th>Created By</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include_once('php/config.php');

                                    $queryCat = mysqli_query($con, "SELECT * FROM categories");

                                    while ($data = mysqli_fetch_assoc($queryCat)) {
                                        echo '
                                                <tr>
                                                    <td>
                                                        <label class="checkboxs">
                                                            <input type="checkbox">
                                                            <span class="checkmarks"></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0);">' . $data['categoryName'] . '</a>
                                                    </td>
                                                    <td>' . $data['categoryId'] . '</td>
                                                    <td>' . $data['categoryDescription'] . '</td>
                                                    <td>' . $data['createdBy'] . '</td>
                                                    <td>
                                                        <a class="me-3" href="editcategory?catId=' . $data['categoryId'] . '">
                                                            <img  src="assets/img/icons/edit.svg" alt="img">
                                                        </a>
                                                        <a id="categoryLink" data-bs-target="#deleteCategory" data-bs-toggle="modal">
                                                            <img class="delete-image" categoryId=' . $data['categoryId'] . ' src="assets/img/icons/delete.svg" alt="img">
                                                        </a>
                                                    </td>
                                                </tr>
                                            ';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
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

        <!-- Delete Category Modal  -->
        <div class="modal fade" id="deleteCategory" tabindex="-1" aria-labelledby="create" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title text-center">Delete Category</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6 col-sm-12 col-12">
                                <p>Deleting this category will delete all related products</p>
                            </div>
                        </div>
                        <div class="col-lg-12 align-items-center mt-4">
                            <button class="btn btn-danger me-2 deleteCategory">Yes Delete</button>
                            <a class="btn btn-secondary" data-bs-dismiss="modal">Cancel</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php include_once('includes/script.php') ?>