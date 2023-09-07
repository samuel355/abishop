$(function () {
  "use strict";

  var t,
    o = "rtl" === $("html").attr("data-textdirection"),
    n = $("#type-success"),
    a = $(".btn-outline-danger");

  //Add Category Start
  $(".addProductForm").on("submit", function (e) {
    e.preventDefault();

    var productName = $("#productName").val(),
      categoryId = $("#categoryId").val(),
      quantity = $("#quantity").val(),
      price = $("#price").val(),
      description = $("#description").val(),
      numbers = /^[0-9]+$/;

    //Product Name
    if (productName === "") {
      $(".productNameError").text("Enter Product Name");
      return toastr.error("Enter Product Name", "Error", {
        closeButton: !0,
        tapToDismiss: !1,
        rtl: o,
      });
    } else if (productName.length <= 3) {
      $(".productNameError").text("Product name is too short");
      return toastr.error("Product name is short", "Error", {
        closeButton: !0,
        tapToDismiss: !1,
        rtl: o,
      });
    } else {
      $(".productNameError").text("");
    }

    //Category Name /id
    if (categoryId === "Choose Category") {
      $(".categoryError").text("Choose product category");
      return toastr.error("Choose product Category", "Error", {
        closeButton: !0,
        tapToDismiss: !1,
        rtl: o,
      });
    } else {
      $(".categoryError").text("");
    }

    //quantity
    if (quantity === "") {
      $(".quantityError").text("Add product total quantity");
      return toastr.error("add product total quantity", "Error", {
        closeButton: !0,
        tapToDismiss: !1,
        rtl: o,
      });
    } else {
      $(".quantityError").text("");
    }

    //price
    if (price === "") {
      $(".priceError").text("Add product unit price");
      return toastr.error("add product unit price", "Error", {
        closeButton: !0,
        tapToDismiss: !1,
        rtl: o,
      });
    } else {
      $(".priceError").text("");
    }

    $.ajax({
      data: $(".addProductForm").serialize(),
      method: "POST",
      url: "../php/addProduct.php",

      success: function (response) {
        console.log(response);
        //$("#getCategories").html(response);
        if (response === "success") {
          $(".addProductForm")[0].reset();
          window.alert("Product Added successfully");
          location.href = '../productlist';
          toastr.success("You have added product successfully", "Success", {
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
