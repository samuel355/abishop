<?php
session_start();
include_once("config.php");

if (isset($_POST['customerId'])) {
    $invoiceId = mysqli_real_escape_string($con, $_POST['invoiceId']);
    $customerId = mysqli_real_escape_string($con, $_POST['customerId']);
    $customerEmail = mysqli_real_escape_string($con, $_POST['customerEmail']);
    $customerAddress = mysqli_real_escape_string($con, $_POST['address']);
    $customerPhone = mysqli_real_escape_string($con, $_POST['customerPhone']);
    $paymentOption = mysqli_real_escape_string($con, $_POST['paymentOptions']);

    $totalAmount = mysqli_real_escape_string($con, $_POST['totalAmount']);
    $amountPaid = mysqli_real_escape_string($con, $_POST['amountPaid']);
    $amountRemaining = mysqli_real_escape_string($con, $_POST['amountRemaining']);

    $paymentDate = date('d-m-Y');
    $now = date('d-m-Y');
    $nextPaymentDate = mysqli_real_escape_string($con, $_POST['nextPaymentDate']);
    $shortNote = mysqli_real_escape_string($con, $_POST['shortNote']);

    $userId = $_SESSION['uid'];

    //select customer name using his id 
    $selectCustomer = mysqli_query($con, "SELECT * FROM customers WHERE customerId = '{$customerId}' ");
    if ($selectCustomer) {
        $customerData = mysqli_fetch_assoc($selectCustomer);
        $customerName = $customerData['customerName'];


        //save purchased products to sales database and save all details to invoice database
        $insertDetails = mysqli_query($con, "INSERT INTO invoices(invoiceId, customerId, customerName, customerPhone, customerEmail, customerAddress, userId, userName, totalAmount, amountPaid, amountRemaining, dateCreated, paymentOption, paymentDate, nextPaymentDate, shortNote) 
                                VALUES('{$invoiceId}', '{$customerId}', '{$customerName}', '{$customerPhone}', '{$customerEmail}', '{$customerAddress}', '{$userId}', '{$_SESSION['name']}', '{$totalAmount}', '{$amountPaid}', '{$amountRemaining}', '{$now}', '{$paymentOption}', '{$paymentDate}', '{$nextPaymentDate}', '{$shortNote}')");

        if ($insertDetails) {
            //get all cart items from cart and it's corresponding product details
            $getDetails = mysqli_query($con, "SELECT a.id, a.productId, a.quantity, a.price, a.subtotal, a.userId, b.productId, b.productName, b.productDescription, b.categoryName FROM cart a, products b WHERE a.productId = b.productId and a.userId = '{$userId}' ");
            if (mysqli_num_rows($getDetails) > 0) {
                $stmt = $con->prepare("INSERT INTO sales(invoiceId, productId, productName, quantity, price, subtotal, customerId, userId, dateCreated) 
                              VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)");
                if (!$stmt) {
                    echo "Prepared statement error: " . $con->error;
                }
                while ($saleData = mysqli_fetch_array($getDetails)) {
                    $productId = (int) $saleData['productId'];
                    $productName = mysqli_real_escape_string($con, $saleData['productName']);
                    $quantity = (int) $saleData['quantity'];
                    $price = (float) $saleData['price'];
                    $subTotal = (float) $saleData['subtotal'];
                    $saleUserId = (int) $userId;

                    $stmt->bind_param("sisiddsis", $invoiceId, $productId, $productName, $quantity, $price, $subTotal, $customerId, $userId, $now);

                    $insertSale = $stmt->execute();

                    if (!$insertSale) {
                        echo "Error inserting into sales: " . $stmt->error . "<br>";
                    } else {
                        //echo "Sale inserted successfully for product: " . $productName . "<br>";
                    }
                }

                $stmt->close();
                //clear cart details using userId
                $clearCart = mysqli_query($con, "DELETE FROM cart WHERE userId = '{$userId}' ");
                if ($clearCart) {
                    echo 'success';
                } else {
                    echo "Error clearing cart: " . $con->error . "<br>";
                }
            }
        } else {
            echo "Error inserting into invoices: " . mysqli_error($con) . "<br>";
        }
    }
}
