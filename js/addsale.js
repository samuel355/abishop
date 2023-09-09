$(function () {
  ("use strict");
  var t,
    o = "rtl" === $("html").attr("data-textdirection"),
    n = $("#type-success"),
    a = $(".btn-outline-danger");

  getCartItem();
  net_total();
  getSaleCustomers();
  paymentOptions();

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
        $(".saleCustomers").html(data);
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

  //Hide Payment Options when page load
  function paymentOptions() {
    var paymentOption = $("#paymentOptions").val();
    if (paymentOption === "Choose Payment Option") {
      $(".readyCash").css("display", "none");
      $(".forCredit").css("display", "none");
      $(".installments").css("display", "none");
    }
  }

  //Choose Payment Options
  $("#paymentOptions").on("change", function (e) {
    var totalAmount = $("#totalAmount").val();
    var paymentOption = $(this).val();
    if (paymentOption === "Choose Payment Option") {
      $(".readyCash").css("display", "none");
      $(".forCredit").css("display", "none");
      $(".installments").css("display", "none");
      $(".paymentOptionError").text("Choose payment Option");
      return toastr.error("Choose Payment Option", "Error", {
        closeButton: !0,
        tapToDismiss: !1,
        rtl: o,
      });
    } else if (paymentOption === "Ready Cash") {
      console.log(totalAmount);
      $(".paymentOptionError").text("");
      $(".readyCash").css("display", "block");
      $(".forCredit").css("display", "none");
      $(".installments").css("display", "none");
    } else if (paymentOption === "For Credit") {
      console.log(totalAmount);
      $(".paymentOptionError").text("");
      $(".forCredit").css("display", "block");
      $(".readyCash").css("display", "none");
      $(".installments").css("display", "none");
    } else if (paymentOption === "Installments") {
      console.log(totalAmount);
      $(".paymentOptionError").text("");
      $(".installments").css("display", "block");
      $(".readyCash").css("display", "none");
      $(".forCredit").css("display", "none");
    }
  });

  //Ready Cash
  $("#amountPaidRC").on("keyup", function () {
    var totalAmount = $("#totalAmount").val();
    var amountPaid = $("#amountPaidRC").val();
    var amountRemaining = totalAmount - amountPaid;
    $("#amountRemainingRC").val(amountRemaining.toLocaleString());

    if (amountRemaining < 0) {
      $(".amountRemainingRCError").text("Check the amount remaining");
    } else {
      $(".amountRemainingRCError").text("");
    }
  });

  //Installments
  $("#amountPaidI").on("keyup", function () {
    var totalAmount = $("#totalAmount").val().toLocaleString();
    var amountPaid = $("#amountPaidI").val();
    var amountRemaining = totalAmount - amountPaid;
    $("#amountRemainingI").val(amountRemaining.toLocaleString());

    if (amountRemaining < 0) {
      $(".amountRemainingIError").text("Check the amount remaining");
    } else {
      $(".amountRemainingIError").text("");
    }
  });

  //Add Category Start
  $(".addSaleForm").on("submit", function (e) {
    e.preventDefault();

    //Customer Details
    var customerId = $("#customerId").val(),
      customerEmail = $("#email").val(),
      customerAddress = $("#address").val(),
      customerPhone = $("#phone").val(),
      totalAmount = $("#totalAmount").val(),
      paymentOptions = $("#paymentOptions").val();

    var amountPaid;
    var amountRemaining;
    var shortNote;
    var paymentDate;
    var nextPaymentDate;

    //Ready Cash
    var amountPaidRC = $("#amountPaidRC").val(),
      amountRemainingRC = $("#amountRemainingRC").val(),
      shortNoteRC = $("#shortNoteRC").val();
      
    //For Credit
    var paymentDateFC = $("#paymentDate").val(),
      shortNoteFC = $("#shortNoteFC");

    //Installments
    var initialPayment = $("#amountPaidI").val(),
      amountRemainingI = $("#amountRemainingI").val(),
      nextPaymentDateI= $("#nextPaymentDateI").val(),
      shortNoteI = $("#shortNoteI").val();

    if (paymentOptions === "Ready Cash") {
      amountPaid = amountPaidRC;
      amountRemaining = amountRemainingRC;
      shortNote = shortNoteRC;
      paymentDate = 'today date';
      nextPaymentDate = '';
    } else if (paymentOptions === "For Credit") {
      amountPaid = 0
      amountRemaining = totalAmount;
      shortNote = shortNoteFC;
      paymentDate = paymentDateFC;
      nextPaymentDate = '';
    }else if(paymentOptions === "Installments"){
      amountPaid = initialPayment;
      amountRemaining = amountRemainingI;
      nextPaymentDate = nextPaymentDateI;
      shortNote = shortNoteI;
      paymentDate = 'today date'
    }

    var data = {
      customerId,
      customerEmail,
      customerAddress,
      customerPhone,
      totalAmount,
      paymentOptions,
      amountPaid,
      amountRemaining,
      shortNote,
      paymentDate,
      nextPaymentDate
    };
    console.log(data);

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
