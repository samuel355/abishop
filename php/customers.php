<?php
session_start();
include_once('config.php');

if(isset($_GET['getCustomers'])){
    $query = mysqli_query($con, "SELECT * FROM customers ORDER BY dateAdded DESC");
    if(mysqli_num_rows($query) > 0){
        echo '
            <table class="table  datanew">
                <thead>
                    <tr>
                        <th>
                            <label class="checkboxs">
                                <input type="checkbox" id="select-all">
                                <span class="checkmarks"></span>
                            </label>
                        </th>
                        <th>Customer Name</th>
                        <th>Phone</th>
                        <th>email</th>
                        <th>Date Added</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
            ';

        while($data = mysqli_fetch_array($query)){
            $customerId = $data['customerId'];
            $name = $data['customerName'];
            $phone = $data['phone'];
            $address = $data['address'];
            $email = $data['email'];
            $dateAdded = $data['dateAdded'];
            echo '
                <tr>
                    <td>
                        <label class="checkboxs">
                            <input type="checkbox">
                            <span class="checkmarks"></span>
                        </label>
                    </td>
                    <td>
                        <a href="javascript:void(0);">'.$name.'</a>
                    </td>
                    <td>'.$phone.' </td>
                    <td>'.$email. '</td>
                    <td>' . $dateAdded . '</td>
                    <td>
                        <a class="me-3">
                            <img customerId="'.$customerId. '" class="editCustomer" src="assets/img/icons/edit.svg" alt="img">
                        </a>
                        <a class="me-3 deleteCustomerLink" href="javascript:void(0);" data-bs-target="#deleteCustomer" data-bs-toggle="modal">
                            <img customerId="' . $customerId . '" class="deleteCustomer" src="assets/img/icons/delete.svg" alt="img">
                        </a>
                    </td>
                </tr>
            ';
        }

        echo '
            </tbody>
                </table>        
        ';
    }
}