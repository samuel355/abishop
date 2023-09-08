$(document).ready(function () {
  var t,
    o = "rtl" === $("html").attr("data-textdirection"),
    n = $("#type-success"),
    a = $(".btn-outline-danger");

  getCustomers();

  function getCustomers() {
    $.ajax({
      type: "GET",
      url: "../php/customers.php",
      data: { getCustomers: 1 },

      success: function (data) {
        $(".customersTable").html(data);
      },
    });
  }

  //Delete Customer
  $("body").delegate(".deleteCustomer", "click", function (event) {
    var customerId = $(this).attr("customerId");
    $(".deleteCustomerF").attr("dataId", customerId);
  });

  $(".deleteCustomerF").on("click", function () {
    var customerId = $(this).attr("dataId");

    $.ajax({
      url: "../php/deleteCustomer.php",
      type: "GET",
      data: { customerId: customerId },

      success: function (data) {
        if (data === "success") {
            $('#deleteCustomer').modal('toggle')
          toastr.success(
            "You have deleted a customer successfully",
            "Success",
            {
              closeButton: !0,
              tapToDismiss: !1,
              rtl: o,
            }
          );
          getCustomers();
        }else{
            return toastr.error(data, "Error", {
              closeButton: !0,
              tapToDismiss: !1,
              rtl: o,
            });
        }
      },
    });
  });

  //Add Customer
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
        url: "../php/addCustomer.php",

        success: function (response) {
          console.log(response);
          if (response == "success") {
            getCustomers();
            $(".addCustomerForm")[0].reset();
            $("#addCustomer").modal("toggle");
            toastr.success("You have added customer successfully", "Success", {
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
});
