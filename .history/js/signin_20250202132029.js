$(function () {
  "use strict";

  //Signup Start
  $(".signinForm").on("submit", function (e) {
    e.preventDefault();

    var email = $("#email").val(),
      password = $("#password").val();

    //Email
    if (email === "") {
      $(".emailError").text("Enter your email address");
      return toastr.error("Enter your email address", "Error", {
      });
    } else {
      $(".emailError").text("");
    }

    //Password
    if (password === "") {
      $(".passwordError").text("Enter your password");
      return toastr.error("Enter your password", "Error", {
      });
    } else {
      $(".passwordError").text("");
    }

    $.ajax({
      data: $(".signinForm").serialize(),
      method: "POST",
      url: "php/signin.php",

      success: function (response) {
        console.log(response);
        if (response === "success") {
          $(".signinForm")[0].reset();
          window.location.href = "/";
          toastr.success("You have signed up successfully", "Success", {
            closeButton: !0,
            tapToDismiss: !1,
            rtl: o,
          });
        } else {
          return toastr.error(response, "Error", {
          });
        }
      },
    });
  });
});
