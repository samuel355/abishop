<?php session_start();
include_once('includes/head.php'); ?>

<body class="account-page">

    <div class="main-wrapper">
        <div class="account-content">
            <div class="login-wrapper">
                <div class="login-content">
                    <div class="login-userset">
                        <form class="signinForm" action="">
                            <div class="login-logo logo-normal">
                                <img src="assets/img/logo.png" alt="img">
                            </div>
                            <a href="index.html" class="login-logo logo-white">
                                <img src="assets/img/logo-white.png" alt>
                            </a>
                            <div class="login-userheading">
                                <h3>Sign In</h3>
                                <h4>Please login to your account</h4>
                            </div>
                            <div class="form-login">
                                <label>Email</label>
                                <div class="form-addons">
                                    <input id="email" name="email" type="email" placeholder="Enter your email address">
                                    <img src="assets/img/icons/mail.svg" alt="img">
                                    <span class="emailError text-danger m-1"></span>
                                </div>
                            </div>
                            <div class="form-login">
                                <label>Password</label>
                                <div class="pass-group">
                                    <input id="password" name="password" type="password" class="pass-input" placeholder="Enter your password">
                                    <span class="fas toggle-password fa-eye-slash"></span>
                                    <span class="passwordError text-danger m-1"></span>
                                </div>
                            </div>
                            <div class="form-login">
                                <div class="alreadyuser">
                                    <h4><a href="forgetpassword.php" class="hover-a">Forgot Password?</a></h4>
                                </div>
                            </div>
                            <div class="form-login">
                                <button type="submit" class="btn btn-login">Sign In</button>
                            </div>
                            <div class="signinform text-center">
                                <h4>Don’t have an account? <a href="signup.php" class="hover-a">Sign Up</a></h4>
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