$(function () {
  "use strict";

  var t,
    o = "rtl" === $("html").attr("data-textdirection"),
    n = $("#type-success"),
    a = $(".btn-outline-danger");

  //Add Category Start
  $(".addCategoryForm").on("submit", function (e) {
    e.preventDefault();

    var categoryName = $("#categoryName").val();

    //Category Name
    if (categoryName === "") {
      $(".categoryNameError").text("Enter Category Name");
      return toastr.error("Enter Category Name", "Error", {
        closeButton: !0,
        tapToDismiss: !1,
        rtl: o,
      });
    } else {
      $(".categoryNameError").text("");
    }

    $.ajax({
      data: $(".addCategoryForm").serialize(),
      method: "POST",
      url: "../php/addCategory.php",

      success: function (response) {
        console.log(response);
        //$("#getCategories").html(response);
        if (response === "success") {
          $(".addCategoryForm")[0].reset();
          $("#create").modal("toggle");
          window.location.reload();
          toastr.success("You have added category successfully", "Success", {
            closeButton: !0,
            tapToDismiss: !1,
            rtl: o,
          });
        } else {
          return toastr.error(response, "Error", {
            closeButton: !0,
            tapToDismiss: !1,
            rtl: o,
          });
        }
      },
    });
  });
});
