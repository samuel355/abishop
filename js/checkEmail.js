$(function () {
  "use strict";

  var t,
    o = "rtl" === $("html").attr("data-textdirection"),
    n = $("#type-success"),
    a = $(".btn-outline-danger");

  //Signup Start
  $("#checkEmail").on("submit", function (e) {
    e.preventDefault();

    var email = $("#email").val();

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

    $.ajax({
      data: {email},
      method: "POST",
      url: "../php/checkEmail.php",

      success: function (response) {
        console.log(response);
        if (response === "success") {
          $("#checkEmail")[0].reset();
          window.location.href = "../resetpassword";
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
