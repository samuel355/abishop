<?php
session_start();
include_once("config.php");

if (isset($_GET['getCartProducts'])) {
    $query = mysqli_query($con, "SELECT a.productId, a.productName, a.price, b.id, b.productId, b.quantity, b.userId FROM products a, cart b WHERE a.productId = b.productId AND b.userId = '{$_SESSION['uid']}' ");
    if (mysqli_num_rows($query) > 0) {

        echo mysqli_num_rows($query);

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

    while ($row = mysqli_fetch_array($query)) {
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
                                    <input type="button" value="-" productId = ' . $productId . ' productQuantity=" ' . $quantity . ' " class="button quantityDecrease" subtotal=" ' . $subTotal . ' " price=" ' . $price . ' ">
                                    <input type="text" id="quantity" name="quantity" value="' . $quantity . '" class="quantity-field">
                                    <input type="button" value="+" productId = ' . $productId . ' productQuantity=" ' . $quantity . ' " class="button quantityIncrease" subtotal=" ' . $subTotal . ' " price=" ' . $price . ' ">
                                </div>
                            </div>
                        </td>
                        <td class="productPrice">' . number_format($price) . '</td>
                        <td class="productSubTotal">' . number_format($subTotal). '</td>
                        <td>
                            <a><img class="deleteDelete" productId = ' . $productId . ' src="assets/img/icons/delete.svg" alt="svg"></a>
                        </td>
                    </tr>
                ';
    }

    echo '
        </tbody>
        </table>
    ';
}
