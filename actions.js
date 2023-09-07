$(document).ready(function () {
  getCartItem();

  function net_total() {
    var net_total = 0;
    $(".qty").each(function () {
      var row = $(this).parent().parent().parent();
      var price = row.find(".price").val();
      var total = price * $(this).val() - 0;
      row.find(".total").val(total);
    });
    $(".total").each(function () {
      net_total += $(this).val() - 0;
      console.log(net_total);
    });
    $(".net_total").html("GHS. " + Number(net_total).toLocaleString());
  }

  function getCartItem() {
    $.ajax({
      url: "action.php",
      method: "GET",
      data: { getCartItems: 1 },
      success: function (data) {
        $(".tableProducts").html(data);
        //net_total();
      },
    });
  }
});
