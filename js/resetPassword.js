$(function () {
  "use strict";

  var t,
    o = "rtl" === $("html").attr("data-textdirection"),
    n = $("#type-success"),
    a = $(".btn-outline-danger");

  //Signup Start
  $(".resetPasswordForm").on("submit", function (e) {
    e.preventDefault();

    var 
      email = $("#email").val(),
      password = $("#password").val(),
      confirmPassword = $("#confirmPassword").val();

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

    //Password
    if (password === "") {
      $(".passwordError").text("Enter your new password");
      return toastr.error("Enter your new password", "Error", {
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
        $(".confirmPasswordError").text("Your passwords do not match");
      return toastr.error("Your passwords do not match", "Error", {
        closeButton: !0,
        tapToDismiss: !1,
        rtl: o,
      });
    } else {
      $(".passwordError").text("");
      $(".confirmPasswordError").text("");

      $.ajax({
        data: $(".resetPasswordForm").serialize(),
        method: "POST",
        url: "../php/resetPassword.php",

        success: function (response) {
          console.log(response);
          if (response == "success") {
            $(".resetPasswordForm")[0].reset();
            toastr.success("Password changed successfully, login with your new password", "Success", {
              closeButton: !0,
              tapToDismiss: !1,
              rtl: o,
            });
            window.location.href = 'signin'
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
