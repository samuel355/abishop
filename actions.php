<?php
include_once("php/config.php");

if (isset($_POST['getCartItems'])) {
    $query = mysqli_query($con, "SELECT a.productId, a.productName, a.price, b.id, b.productId, b.quantity, b.userId FROM products a, cart b WHERE a.productId = b.productId AND b.userId = '{$_SESSION['uid']}' ");
    if (mysqli_num_rows($query) > 0) {

        echo '
            <table class="table">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Unit Price(GHs) </th>
                        <th>Sub Total(Ghs)</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="saleProduct">
        ';
    }

    $n = 0;
    while ($row = mysqli_fetch_array($query)) {
        $n++;
        $productId = $row['productId'];
        $productName = $row['productName'];
        $price = $row['price'];
        $cartId = $row['id'];
        $quantity = $row['quantity'];
        $userId = $row['userId'];
        $subTotal = $price * $quantity;

        echo '
            <tr>
                <td>
                    <a href="javascript:void(0);">' . $productName . '</a>
                </td>
                <td>
                    <div class="increment-decrement">
                        <div class="input-groups">
                            <input type="button" value="-" class="button quantityDecrease">
                            <input type="text" name="child" value="' . $quantity . '" class="quantity-field">
                            <input type="button" value="+" class="button quantityIncrease">
                        </div>
                    </div>
                </td>
                <td>' . $price . '</td>
                <td>' . $subTotal . '</td>
                <td>
                    <a class="deleteDelete"><img src="assets/img/icons/delete.svg" alt="svg"></a>
                </td>
            </tr>
        ';
    }

    echo '
        </tbody>
        </table>
    ';
}
