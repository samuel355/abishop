$(function () {
  "use strict";

  var t,
    o = "rtl" === $("html").attr("data-textdirection"),
    n = $("#type-success"),
    a = $(".btn-outline-danger");

  //Signup Start
  $(".logoutButton").on("click", function (e) {
    e.preventDefault();
    var email = $(this).attr("dataEmail");

    if (email != "" && email != undefined) {
      $.ajax({
        data: { email: email },
        method: "GET",
        url: "../php/logout.php",

        success: function (response) {
          console.log(response);
          if (response === "success") {
            window.location.href = "../signin";
          } else {
            toastr.error("Something went wrong login out", "Error", {
              closeButton: !0,
              tapToDismiss: !1,
              rtl: o,
            });
          }
        },
      });
    } else {
      toastr.error("Something went wrong login out", "Error", {
        closeButton: !0,
        tapToDismiss: !1,
        rtl: o,
      });
    }
  });
});
