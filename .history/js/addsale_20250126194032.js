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
  showPaymentOptions();

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

  function showPaymentOptions() {
    $.ajax({
      type: "GET",
      data: { showOptions: 1 },
      url: "../php/showPaymentOptions.php",

      success: function (response) {
        if (response === "success") {
          return $("#paymentOptionsToChoose").css("display", "block");
        } else {
          return $("#paymentOptionsToChoose").css("display", "none");
        }
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
        showPaymentOptions();
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
          showPaymentOptions();
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
          showPaymentOptions();
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
          showPaymentOptions();
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
        showPaymentOptions();
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

      $(".paymentOptionError").text("");
      $(".readyCash").css("display", "block");
      $(".forCredit").css("display", "none");
      $(".installments").css("display", "none");
    } else if (paymentOption === "For Credit") {

      $(".paymentOptionError").text("");
      $(".forCredit").css("display", "block");
      $(".readyCash").css("display", "none");
      $(".installments").css("display", "none");
    } else if (paymentOption === "Installments") {

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

  //Print invoice
  function printSaleInvoice(customerId, invoiceId){
    $.ajax({
      data: {customerId, invoiceId},
      type: "GET",
      url: "../saleinvoice",
    })
  }

  //Add Sale 
  $(".addSaleForm").on("submit", function (e) {
    e.preventDefault();

    //Customer Details
    var customerId = $("#customerId").val(),
      customerEmail = $("#email").val(),
      customerAddress = $("#address").val(),
      customerPhone = $("#phone").val(),
      totalAmount = $("#totalAmount").val(),
      paymentOptions = $("#paymentOptions").val();
      var invoiceId = Date.now();

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
      shortNoteFC = $("#shortNoteFC").val();

    //Installments
    var initialPayment = $("#amountPaidI").val(),
      amountRemainingI = $("#amountRemainingI").val(),
      nextPaymentDateI = $("#nextPaymentDateI").val(),
      shortNoteI = $("#shortNoteI").val();

    if (paymentOptions === "Ready Cash") {
      amountPaid = amountPaidRC;
      if (amountPaid === 0 || amountPaid === undefined || amountPaid === "") {
        return $(".amountPaidRCError").text("Enter Amount Paid");
      } else {
        $(".amountPaidRCError").text("");
      }
      amountRemaining = amountRemainingRC;
      shortNote = shortNoteRC;
      paymentDate = "today date";
      nextPaymentDate = "";
    } else if (paymentOptions === "For Credit") {
      paymentDate = paymentDateFC;

      if (paymentDate === "") {
        return $(".paymentDateFCError").text("Click to set payment Date");
      } else {
        $(".paymentDateFCError").text("");
      }
      amountPaid = 0;
      amountRemaining = totalAmount;
      shortNote = shortNoteFC;

      nextPaymentDate = "";
    } else if (paymentOptions === "Installments") {
      amountPaid = initialPayment;
      if (amountPaid === 0 || amountPaid === undefined || amountPaid === "") {
        return $(".initialPaymentError").text("Enter Initial Amount");
      } else {
        $(".initialPaymentError").text("");
      }

      amountRemaining = amountRemainingI;
      nextPaymentDate = nextPaymentDateI;
      shortNote = shortNoteI;
      paymentDate = "today date";

      if (nextPaymentDate === "") {
        return $(".nextPaymentDateError").text("Choose Next Payment Date");
      } else {
        $(".nextPaymentDateError").text("");
      }
    }

    if (customerId === undefined || customerId === "") {
      $(".customerSelectionError").text("Select Customer or Add customer");
      $(".customerSelectionError").get(0).scrollIntoView();
      return toastr.error("Select or Add Customer", "Error", {
        closeButton: !0,
        tapToDismiss: !1,
        rtl: o,
      });
    } else {
      $(".customerSelectionError").text("");
    }

    if (paymentOptions === "Choose Payment Option") {
      $(".paymentOptionError").text("choose payment option");
      return toastr.error("choose payment option", "Error", {
        closeButton: !0,
        tapToDismiss: !1,
        rtl: o,
      });
    } else {
      $(".paymentOptionError").text("");
    }

    var data = {
      invoiceId,
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
      nextPaymentDate,
    };

    $.ajax({
      data: data,
      method: "POST",
      url: "../php/addCustomerSale.php",

      success: function (response) {
        console.log(response);
        if (response === "success") {
          printSaleInvoice(customerId, invoiceId)
          window.alert("Sales made successfully");
          location.href = '../saleinvoice?customerId='+customerId+'&invoiceId='+invoiceId;
          toastr.success("You have added sale successfully", "Success", {
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
