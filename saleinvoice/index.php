<?php
session_start();
include_once("includes/redirect.php");
include_once('../php/config.php');
if (isset($_GET['customerId']) && isset($_GET['invoiceId'])) {
  $customerId = $_GET['customerId'];
  $invoiceId = $_GET['invoiceId'];
  $userId =  $_SESSION['uid'];

  $selectDetails = mysqli_query($con, "SELECT * FROM invoices WHERE invoiceId='{$invoiceId}' AND customerId='{$customerId}' ");
  if (mysqli_num_rows($selectDetails) > 0) {
    $data = mysqli_fetch_array($selectDetails);
    $customerName = $data['customerName'];
    $customerPhone = $data['customerPhone'];
    $customerEmail = $data['customerEmail'];
    $customerAddress = $data['customerAddress'];
    $totalAmount = $data['totalAmount'];
    $amountPaid = $data['amountPaid'];
    $date = $data['dateCreated'];
    $amountRemaining = $data['amountRemaining'];
    $paymentOption = $data['paymentOption'];
    $paymentDate = $data['paymentDate'];
    $nextPaymentDate = $data['nextPaymentDate'];
    $shortNote = $data['shortNote'];
    $seller = $_SESSION['name'];
  } else {
    header('Location: ../addsale');
  }
} else {
  header('Location: ../addsale');
}
?>
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
  <!-- Meta Tags -->
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Laralink">
  <!-- Site Title -->
  <title>Customer Invoice</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
  <div class="tm_container">
    <div class="tm_invoice_wrap">
      <div class="tm_invoice tm_style3" id="tm_download_section">
        <div class="tm_invoice_in">
          <div class="tm_invoice_head tm_align_center tm_accent_bg">
            <div class="tm_invoice_left">
              <div class="tm_logo"><img src="assets/img/logo_white.svg" alt="Logo"></div>
            </div>
            <div class="tm_invoice_right">
              <div class="tm_head_address tm_white_color">
                Laralink Ltd <br>
                86-90 Paul Street, London<br>
                Phone: +990 9866 334 2134 <br>
                Email: demo@gmail.com
              </div>
            </div>
            <div class="tm_primary_color tm_text_uppercase tm_watermark_title tm_white_color">Invoice</div>
          </div>
          <div class="tm_invoice_info">
            <div class="tm_invoice_info_left tm_gray_bg">
              <p class="tm_mb2"><b class="tm_primary_color">Receipt:</b></p>
              <p class="tm_mb0">
                <span style="color: black">Name: </span><?php echo $customerName ?> <br>
                <span style="color: black">Phone: </span><?php echo $customerPhone ?> <br>
                <span style="color: black">Address: </span><?php echo $customerAddress ?> <br>
                <span style="color: black">Email: </span><?php echo $customerEmail ?>
              </p>
            </div>
            <div class="tm_invoice_info_right tm_text_right">
              <p class="tm_invoice_number tm_m0">Receipt No: <b class="tm_primary_color"><?php echo $invoiceId ?></b></p>
              <p class="tm_invoice_date tm_m0">Date: <b class="tm_primary_color"><?php echo $date ?></b></p>
            </div>
          </div>
          <div class="tm_invoice_details">
            <div class="tm_table tm_style1 tm_mb30">
              <div class="tm_border">
                <div class="tm_table_responsive">
                  <table class="tm_gray_bg">
                    <thead>
                      <tr>
                        <th class="tm_width_1 tm_semi_bold tm_white_color tm_accent_bg">#</th>
                        <th class="tm_width_5 tm_semi_bold tm_white_color tm_accent_bg">Product</th>
                        <th class="tm_width_1 tm_semi_bold tm_white_color tm_accent_bg tm_border_left">Qty</th>
                        <th class="tm_width_2 tm_semi_bold tm_white_color tm_accent_bg tm_border_left">Price (GHS)</th>
                        <th class="tm_width_2 tm_semi_bold tm_white_color tm_accent_bg tm_border_left">SubTotal (GHS)</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      session_start();
                      include_once('../php/config.php');
                      if (isset($_GET['customerId']) && isset($_GET['invoiceId'])) {
                        $customerId = $_GET['customerId'];
                        $invoiceId = $_GET['invoiceId'];
                        $userId =  $_SESSION['uid'];

                        $selectSale = mysqli_query($con, "SELECT * FROM sales WHERE invoiceId='{$invoiceId}' AND customerId='{$customerId}' ");
                        if (mysqli_num_rows($selectSale) > 0) {
                          $n = 0;
                          while ($data = mysqli_fetch_array($selectSale)) {
                            $productName = $data['productName'];
                            $quantity = $data['quantity'];
                            $price = $data['price'];
                            $subTotal = $data['subtotal'];
                            $n++;
                            echo '
                              <tr>
                                <td class="tm_width_1">' . $n . '</td>
                                <td class="tm_width_5">' . $productName . '</td>
                                <td class="tm_width_1 tm_border_left">' . $quantity . '</td>
                                <td class="tm_width_2 tm_border_left">' . number_format($price) . '</td>
                                <td class="tm_width_2 tm_border_left">' . number_format($subTotal) . '</td>
                              </tr>
                            ';
                          }
                        } else {
                          header('Location: ../addsale');
                        }
                      }
                      ?>

                    </tbody>
                  </table>
                </div>
              </div>
              <div class="tm_invoice_footer">
                <div class="tm_left_footer">
                  <p class="tm_mb2"><b class="tm_primary_color">Payment info:</b></p>
                  <p class="tm_m0">Payment Option: <span class="ml-5"> <?php echo $paymentOption ?> </span></p>
                </div>
                <div class="tm_right_footer">
                  <table class="tm_gray_bg">
                    <tbody>
                      <?php
                      include_once('../php/config.php');
                      if (isset($_GET['customerId']) && isset($_GET['invoiceId'])) {
                        $customerId = $_GET['customerId'];
                        $invoiceId = $_GET['invoiceId'];
                        $userId =  $_SESSION['uid'];

                        $selectTotals = mysqli_query($con, "SELECT * FROM sales WHERE invoiceId='{$invoiceId}' AND customerId='{$customerId}' ");
                        if (mysqli_num_rows($selectTotals) > 0) {
                          $totalQuantity = 0;
                          $totalAmount = 0;

                          while ($data = mysqli_fetch_array($selectTotals)) {
                            $quantity = $data['quantity'];
                            $subTotal = $data['subtotal'];
                            $totalQuantity = $totalQuantity + $quantity;
                            $totalAmount = $totalAmount + $subTotal;
                          }

                          echo '
                            <tr>
                              <td class="tm_width_3 tm_primary_color tm_bold">Quantity</td>
                              <td class="tm_width_3 tm_primary_color tm_text_right tm_bold">' . $totalQuantity . '</td>
                            </tr>
                          ';
                        } else {
                          header('Location: ../addsale');
                        }
                      }
                      ?>

                      <tr>
                        <td class="tm_width_3 tm_primary_color tm_bold">Total (GHS)</td>
                        <td class="tm_width_3 tm_primary_color tm_text_right tm_bold"> <?php echo number_format($totalAmount) ?> </td>
                      </tr>
                      <tr>
                        <td class="tm_width_3 tm_primary_color tm_bold">Paid (GHS)</td>
                        <td class="tm_width_3 tm_primary_color tm_bold tm_text_right"> <?php echo number_format($amountPaid) ?> </td>
                      </tr>
                      <tr class="tm_border_top tm_border_bottom tm_accent_bg">
                        <td class="tm_width_3 tm_border_top_0 tm_bold tm_f16 tm_white_color">Due (GHS)</td>
                        <td class="tm_width_3 tm_border_top_0 tm_bold tm_f16 tm_white_color tm_text_right"> <?php echo number_format($data['amountRemaining']) ?> </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="tm_invoice_btns tm_hide_print">
        <a href="javascript:window.print()" class="tm_invoice_btn tm_color1">
          <span class="tm_btn_icon">
            <img src="./assets/img/print.png" alt="">
          </span>
          <span class="tm_btn_text">Print</span>
        </a>
        <button id="tm_download_btn" class="tm_invoice_btn tm_color2" style="margin-top: 20px;">
          <img src="./assets/img/download.png" alt="">
          <span class="tm_btn_text">Download</span>
        </button>
      </div>
    </div>
  </div>
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/jspdf.min.js"></script>
  <script src="assets/js/html2canvas.min.js"></script>
  <script src="assets/js/main.js"></script>
</body>

</html>