$(function () {
  "use strict";

  var t,
    o = "rtl" === $("html").attr("data-textdirection"),
    n = $("#type-success"),
    a = $(".btn-outline-danger");

  //Add Category Start
  $(".editCategoryForm").on("submit", function (e) {
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
      console.log($("#categoryId").val());
    }

    $.ajax({
      data: $(".editCategoryForm").serialize(),
      method: "POST",
      url: "../php/editCategory.php",

      success: function (response) {
        console.log(response);
        if (response === "success") {
          window.location.href = "/categorylist";
          toastr.success("You have updated category successfully", "Success", {
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
