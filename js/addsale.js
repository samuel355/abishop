$(document).ready(function () {
  getCartItem();
  net_total();

  function net_total() {
    $.ajax({
      type: "GET",
      url: "../php/getAmounts.php",
      data: { getAmounts: 1 },

      success: function (data) {
        $(".moneyPart").html(data);
      },
    });
  }

  //Display Cart Items
  function getCartItem() {
    $.ajax({
      type: "GET",
      url: "../php/getCartItems.php",
      data: { getCartProducts: 1 },

      success: function (data) {
        $(".tableProducts").html(data);
        net_total();
      },
    });
  }

  //Remove from cart
  $("body").delegate(".deleteDelete", "click", function (event) {
    var productId = $(this).attr("productId");
    console.log(productId);

    $.ajax({
      type: "GET",
      url: "../php/deleteFromCart.php",
      data: { productId: productId },

      success: function (data) {
        if (data === "success") {
          getCartItem();
          net_total();
        } else {
          return toastr.error(data, "Error", {
            closeButton: !0,
            tapToDismiss: !1,
            rtl: o,
          });
        }
      },
    });
  });

  //Increase product quantity
  $("body").delegate(".quantityIncrease", "click", function (event) {
    var productId = $(this).attr("productId");
    var subtotal = $(this).attr("subtotal");
    var qty = $(this).attr("productQuantity");
    var price = $(this).attr("price");
    var quantity = parseInt(qty);

    $.ajax({
      type: "GET",
      url: "../php/increaseQty.php",
      data: { productId: productId, quantity: quantity, subtotal: subtotal, price: price },

      success: function (data) {
        if (data === "success") {
          getCartItem();
          net_total();
        } else {
          return toastr.error(data, "Error", {
            closeButton: !0,
            tapToDismiss: !1,
            rtl: o,
          });
        }
      },
    });
  });

  //Decrease product quantity
  $("body").delegate(".quantityDecrease", "click", function (event) {
    var productId = $(this).attr("productId");
    var qty = $(this).attr("productQuantity");
    var price =$(this).attr("price")
    var subtotal = $(this).attr("subtotal");
    var quantity = parseInt(qty);

    if (quantity === 1) {
      return toastr.error("Sorry minimum quantity is 1", "Error", {
        closeButton: !0,
        tapToDismiss: !1,
        rtl: o,
      });
    }

    $.ajax({
      type: "GET",
      url: "../php/decreaseQty.php",
      data: { productId: productId, quantity: quantity, subtotal: subtotal, price: price },

      success: function (data) {
        if (data === "success") {
          getCartItem();
          net_total();
        } else {
          return toastr.error(data, "Error", {
            closeButton: !0,
            tapToDismiss: !1,
            rtl: o,
          });
        }
      },
    });
  });

  //Display Cart Products in a Table
  function displayAddedProduct(productId) {
    $.ajax({
      type: "GET",
      data: { productId: productId },
      url: "../php/displaySaleProduct.php",

      success: function (data) {
        $(".tableProducts").html(data);
        net_total();
      },
    });
  }

  var t,
    o = "rtl" === $("html").attr("data-textdirection"),
    n = $("#type-success"),
    a = $(".btn-outline-danger");

  //Add product to cart
  $(".selectSaleProduct").on("change", function (e) {
    var productId = $(this).val();

    if (productId === "Search Product") {
      return toastr.error("Search and Select product", "Error", {
        closeButton: !0,
        tapToDismiss: !1,
        rtl: o,
      });
    } else if (productId === "") {
      return toastr.error("product ID is empty", "Error", {
        closeButton: !0,
        tapToDismiss: !1,
        rtl: o,
      });
    } else {
      $.ajax({
        data: { productId: productId },
        method: "GET",
        url: "../php/addSale.php",

        success: function (response) {
          displayAddedProduct(response);
          //console.log(response);
          if (response === productId) {
            $(".selectSaleProduct").val("");

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
    }
  });

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
    // if (productName === "") {
    //   $(".productNameError").text("Enter Product Name");
    //   return toastr.error("Enter Product Name", "Error", {
    //     closeButton: !0,
    //     tapToDismiss: !1,
    //     rtl: o,
    //   });
    // } else if (productName.length <= 3) {
    //   $(".productNameError").text("Product name is too short");
    //   return toastr.error("Product name is short", "Error", {
    //     closeButton: !0,
    //     tapToDismiss: !1,
    //     rtl: o,
    //   });
    // } else {
    //   $(".productNameError").text("");
    // }

    // //Category Name /id
    // if (categoryId === "Choose Category") {
    //   $(".categoryError").text("Choose product category");
    //   return toastr.error("Choose product Category", "Error", {
    //     closeButton: !0,
    //     tapToDismiss: !1,
    //     rtl: o,
    //   });
    // } else {
    //   $(".categoryError").text("");
    // }

    // //quantity
    // if (quantity === "") {
    //   $(".quantityError").text("Add product total quantity");
    //   return toastr.error("add product total quantity", "Error", {
    //     closeButton: !0,
    //     tapToDismiss: !1,
    //     rtl: o,
    //   });
    // } else {
    //   $(".quantityError").text("");
    // }

    // //price
    // if (price === "") {
    //   $(".priceError").text("Add product unit price");
    //   return toastr.error("add product unit price", "Error", {
    //     closeButton: !0,
    //     tapToDismiss: !1,
    //     rtl: o,
    //   });
    // } else {
    //   $(".priceError").text("");
    // }

    // $.ajax({
    //   data: $(".addProductForm").serialize(),
    //   method: "POST",
    //   url: "../php/addProduct.php",

    //   success: function (response) {
    //     console.log(response);
    //     //$("#getCategories").html(response);
    //     if (response === "success") {
    //       $(".addProductForm")[0].reset();
    //       window.alert("Product Added successfully");
    //       location.href = "../productlist";
    //       toastr.success("You have added product successfully", "Success", {
    //         closeButton: !0,
    //         tapToDismiss: !1,
    //         rtl: o,
    //       });
    //     } else {
    //       return toastr.error(response, "Error", {
    //         closeButton: !0,
    //         tapToDismiss: !1,
    //         rtl: o,
    //       });
    //     }
    //   },
    // });
  });
});
