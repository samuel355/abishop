<?php
session_start();
include_once("config.php");
if (isset($_GET['getAmounts'])) {
    $checkCart = mysqli_query($con, "SELECT * FROM cart");
    if(mysqli_num_rows($checkCart) > 0){
        $select = mysqli_query($con, "SELECT * FROM cart WHERE userId = '{$_SESSION['uid']}'");
        $totalQuantity = 0;
        $totalAmount = 0;
        while($data = mysqli_fetch_array($select)){
            $quantity = $data['quantity'];
            $subTotal = $data['subtotal'];
            $totalQuantity = $totalQuantity + $quantity;
            $totalAmount = $totalAmount + $subTotal;
        }
        echo '
            <li>
                <h4>Total Quantity</h4>
                <h5 class="totalQuantity">'.number_format($totalQuantity).'</h5>
            </li>
            <li class="total">
                <h4>Grand Total [GHS.]</h4>
                <h5 class="totalAmount">Ghs '.number_format($totalAmount).'</h5>
                <input type="hidden" name="totalAmount" id="totalAmount" value='.$totalAmount.' />
            </li>
        ';
    }else{
        echo '';
    }

}