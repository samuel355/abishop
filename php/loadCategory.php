<?php
session_start();
include('config.php');

if (isset($_GET['catId'])) {
    $categoryId = mysqli_real_escape_string($con, $_GET['catId']);

    $fetchCat = mysqli_query($con, "SELECT * FROM  categories WHERE categoryId = '{$categoryId}' ");
    if ($fetchCat) {
        $data = mysqli_fetch_assoc($fetchCat);
        echo '
            <form action="" class="editCategoryForm" method="POST">
                <div class="row">
                    <div class="col-lg-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label>Category Name</label>
                            <input name="categoryName" id="categoryName" type="text" value='.$data['categoryName']. '>
                            <span class="text-danger text-sm m-1 categoryNameError">' . $data['categoryName'] . '</span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label>Description</label>
                            <input name="description" id="description" type="text" value=' . $data['categoryDescription'] . '>
                        </div>
                    </div>
                    <input name="createdBy" value='.$_SESSION['name'].' />
                </div>
                <div class="col-lg-12">
                    <button type="submit" class="btn btn-submit me-2">Save</button>
                    <a class="btn btn-cancel" data-bs-dismiss="modal">Cancel</a>
                </div>
            </form>
        ';
    }
}
