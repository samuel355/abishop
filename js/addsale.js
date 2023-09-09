$(function () {
  ("use strict");
  var t,
    o = "rtl" === $("html").attr("data-textdirection"),
    n = $("#type-success"),
    a = $(".btn-outline-danger");

  getCartItem();
  net_total();
  getSaleCustomers();

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

  //Display Sale Customers
  function getSaleCustomers() {
    $.ajax({
      type: "GET",
      url: "../php/getSaleCustomers.php",
      data: {
        getSaleCustomers: 1,
      },

      success: function (data) {
        $('.saleCustomers').html(data);
      }
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
      data: {
        productId: productId,
        quantity: quantity,
        subtotal: subtotal,
        price: price,
      },

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
    var price = $(this).attr("price");
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
      data: {
        productId: productId,
        quantity: quantity,
        subtotal: subtotal,
        price: price,
      },

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

  //Select Customer to begin Sales
  $("#selectSaleCustomer").on("change", function (e) {
    var customerId = $(this).val();

    if (customerId === "Search Customer") {
      return toastr.error("Search and Customer", "Error", {
        closeButton: !0,
        tapToDismiss: !1,
        rtl: o,
      });
    } else if (customerId === "") {
      return toastr.error("customer ID is empty", "Error", {
        closeButton: !0,
        tapToDismiss: !1,
        rtl: o,
      });
    } else {
      $.ajax({
        data: { customerId: customerId },
        method: "GET",
        url: "../php/displaySaleCustomer.php",
        success: function (response) {
          //getSaleCustomers();
  
          $(".saleCustomerInfo").html(response);
        },
      });
    }
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

  //Add Customer to sale
  $(".addCustomerForm").on("submit", function (e) {
    e.preventDefault();

    var name = $("#name").val(),
      phone = $("#phone").val(),
      email = $("#email").val(),
      address = $("#address").val();

    //Name
    if (name === "") {
      $(".nameError").text("Enter customer name");
      return toastr.error("Enter customer name", "Error", {
        closeButton: !0,
        tapToDismiss: !1,
        rtl: o,
      });
    } else if (name.length < 4) {
      $(".nameError").text("Name too short");
    } else {
      $(".nameError").text("");
    }

    //Phone
    if (phone === "") {
      $(".phoneError").text("Enter customer phone number");
      return toastr.error("Enter customer phone number", "Error", {
        closeButton: !0,
        tapToDismiss: !1,
        rtl: o,
      });
    } else if (phone.length != 10) {
      return $(".phoneError").text("phone number must be 10 digits");
    } else {
      $(".phoneError").text("");

      $.ajax({
        data: $(".addCustomerForm").serialize(),
        method: "POST",
        url: "../php/addCustomerOnSale.php",

        success: function (response) {
          $("#addCustomer").modal("toggle");
          $(".saleCustomerInfo").html(response);
        },
      });
    }
  });

  //Add Category Start
  $(".addSaleForm").on("submit", function (e) {
    e.preventDefault();

    var productName = $("#productName").val(),
      categoryId = $("#categoryId").val(),
      quantity = $("#quantity").val(),
      price = $("#price").val(),
      description = $("#description").val(),
      numbers = /^[0-9]+$/;
    
    var data = $(".addSaleForm").serialize();
    console.log(data);

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
