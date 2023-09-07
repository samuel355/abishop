$(function () {
  "use strict";

  var t,
    o = "rtl" === $("html").attr("data-textdirection"),
    n = $("#type-success"),
    a = $(".btn-outline-danger");

  //Signup Start
  $(".signupForm").on("submit", function (e) {
    e.preventDefault();

    var firstName = $("#firstName").val(),
      lastName = $("#lastName").val(),
      phone = $("#phone").val(),
      email = $("#email").val(),
      address = $("#address").val(),
      password = $("#password").val(),
      confirmPassword = $("#confirmPassword").val();

    //First Name
    if (firstName === "") {
      $(".firstNameError").text("Enter your first name");
      return toastr.error("Enter your first name", "Error", {
        closeButton: !0,
        tapToDismiss: !1,
        rtl: o,
      });
    } else {
      $(".firstNameError").text("");
    }

    //email address
    if (lastName === "") {
      $(".lastNameError").text("Enter your last name");
      return toastr.error("Enter your last name", "Error", {
        closeButton: !0,
        tapToDismiss: !1,
        rtl: o,
      });
    } else {
      $(".lastNameError").text("");
    }

    //Phone
    if (phone === "") {
      $(".phoneError").text("Enter your phone number");
      return toastr.error("Enter your phone number", "Error", {
        closeButton: !0,
        tapToDismiss: !1,
        rtl: o,
      });
    } else if (phone.length != 10) {
      return $(".phoneError").text("phone number must be 10 digits");
    } else {
      $(".phoneError").text("");
    }

    //Email
    if (email === "") {
      $(".emailError").text("Enter your email address");
      return toastr.error("Enter your email address", "Error", {
        closeButton: !0,
        tapToDismiss: !1,
        rtl: o,
      });
    } else {
      $(".emailError").text("");
    }

    //Address
    if (address === "") {
      $(".addressError").text("Enter your address ");
      return toastr.error("Enter your address", "Error", {
        closeButton: !0,
        tapToDismiss: !1,
        rtl: o,
      });
    } else {
      $(".addressError").text("");
    }

    //Password
    if (password === "") {
      $(".passwordError").text("Enter your password");
      return toastr.error("Enter your password", "Error", {
        closeButton: !0,
        tapToDismiss: !1,
        rtl: o,
      });
    } else {
      $(".passwordError").text("");
    }

    //Password
    if (password.length < 5) {
      $(".passwordError").text("Password is too short");
      return toastr.error("Password is too short", "Error", {
        closeButton: !0,
        tapToDismiss: !1,
        rtl: o,
      });
    } else {
      $(".passwordError").text("");
    }

    //Confirm Password
    if (confirmPassword === "") {
      return $(".confirmPasswordError").text("Confirm your password");
    } else {
      $(".passwordError").text("");
    }

    if (password != confirmPassword) {
      return toastr.error("Your passwords do not match", "Error", {
        closeButton: !0,
        tapToDismiss: !1,
        rtl: o,
      });
    } else {
      $(".passwordError").text("");
      $(".confirmPasswordError").text("");

      $.ajax({
        data: $(".signupForm").serialize(),
        method: "POST",
        url: "../php/signup.php",

        success: function (response) {
          console.log(response);
          if (response == "success") {
            $(".signupForm")[0].reset();
            toastr.success("You have signed up successfully", "Success", {
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
