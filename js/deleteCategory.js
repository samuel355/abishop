$(document).ready(function () {
  var t,
    o = "rtl" === $("html").attr("data-textdirection"),
    n = $("#type-success"),
    a = $(".btn-outline-danger");

  $(".delete-image").on("click", function (e) {
    e.preventDefault();
    var catId = $(this).attr("categoryId");
    $(".deleteCategory").attr("dataId", catId);
    $(".categoryId").attr("");
  });

  $(".deleteCategory").on("click", function (e) {
    e.preventDefault();
    var cat = $(this).attr("dataId");

    $.ajax({
      data: { catId: cat },
      method: "GET",
      url: "../php/deleteCategory.php",

      success: function (response) {
        if (response == "success") {
          console.log(response);
          location.reload();
          toastr.success("Category Deleted successfully", "Success", {
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
