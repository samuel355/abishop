<?php session_start();
if ($_SESSION['login']) {
    header('Location: /');
} 
include_once('includes/head.php')
?>


<body class="account-page">

    <div class="main-wrapper">
        <div class="account-content">
            <div class="login-wrapper">
                <div class="login-content">
                    <div class="login-userset ">
                        <div class="login-logo">
                            <img src="assets/img/logo.png" alt="img">
                        </div>
                        <div class="login-userheading">
                            <h3>Forgot password?</h3>
                            <h4>Don’t warry! it happens. Please enter the address <br>
                                associated with your account.</h4>
                        </div>
                        <form action="" id="checkEmail" method="POST">
                            <div class="form-login">
                                <label>Email</label>
                                <div class="form-addons">
                                    <input name="email" id="email" type="email" placeholder="Enter your email address">
                                    <img src="assets/img/icons/mail.svg" alt="img">
                                    <span class="m-1 text-sm text-danger emailError"></span>
                                </div>
                            </div>
                            <div class="form-login">
                                <button type="submit" class="btn btn-login">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="login-img">
                    <img src="assets/img/login.jpg" alt="img">
                </div>
            </div>
        </div>
    </div>


<?php include_once('includes/script.php') ?>