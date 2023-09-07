$(document).ready(function () {
  var t,
    o = "rtl" === $("html").attr("data-textdirection"),
    n = $("#type-success"),
    a = $(".btn-outline-danger");

  $(".editButton").on("click", function (e) {
    e.preventDefault();
    var catId = $(this).attr("categoryId");
    console.log(catId);

    $.ajax({
      data: { catId: catId },
      method: "GET",
      url: "../php/loadCategory.php",

      success: function (response) {
        $('.editModal').html(response);
      },
    });
  });


});
