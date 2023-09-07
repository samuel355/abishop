$(document).ready(function () {
  var t,
    o = "rtl" === $("html").attr("data-textdirection"),
    n = $("#type-success"),
    a = $(".btn-outline-danger");

  $(".productLink").on("click", function (e) {
    e.preventDefault();
    var productId = $(this).attr("productId");
    //console.log(productId);
    $(".deleteProduct").attr("dataId", productId);
    //$(".productLink").attr("");
  });

  $(".deleteProduct").on("click", function (e) {
    e.preventDefault();
    var productId = $(this).attr("dataId");
    console.log(productId);

    $.ajax({
      data: { productId: productId },
      method: "GET",
      url: "../php/deleteProduct.php",

      success: function (response) {
        if (response == "success") {
          console.log(response);
          window.alert('Product Deleted successfully')
          location.reload();
          toastr.success("Product Deleted successfully", "Success", {
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
