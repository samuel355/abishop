<?php session_start();
include_once('includes/head.php'); ?>

<body class="account-page">


    <div class="main-wrapper">
        <div class="account-content">
            <div class="login-wrapper">
                <div class="login-content">
                    <div class="login-userset">
                        <form action="" class="signupForm">
                            <div class="login-logo logo-normal">
                                <img src="assets/img/logo.png" alt="img">
                            </div>
                            <a href="index.html" class="login-logo logo-white">
                                <img src="assets/img/logo-white.png" alt>
                            </a>
                            <div class="login-userheading">
                                <h3>Create an Account</h3>
                                <h4>Continue where you left off</h4>
                            </div>
                            <div class="form-login">
                                <label>First Name</label>
                                <div class="form-addons">
                                    <input name="firstName" id="firstName" type="text" placeholder="Enter your first name">
                                    <img src="assets/img/icons/users1.svg" alt="img">
                                    <span class="firstNameError text-danger m-1"></span>
                                </div>
                            </div>
                            <div class="form-login">
                                <label>Last Name</label>
                                <div class="form-addons">
                                    <input name="lastName" id="lastName" type="text" placeholder="Enter your full name">
                                    <img src="assets/img/icons/users1.svg" alt="img">
                                    <span class="lastNameError text-danger m-1"></span>
                                </div>
                            </div>
                            <div class="form-login">
                                <label>Phone</label>
                                <div class="form-addons">
                                    <input name="phone" id="phone" type="number" placeholder="Enter your phone">
                                    <span class="phoneError text-danger m-1"></span>
                                </div>
                            </div>
                            <div class="form-login">
                                <label>Email</label>
                                <div class="form-addons">
                                    <input name="email" id="email" type="email" placeholder="Enter your email address">
                                    <img src="assets/img/icons/mail.svg" alt="img">
                                    <span class="emailError text-danger m-1"></span>
                                </div>
                            </div>
                            <div class="form-login">
                                <label>Address</label>
                                <div class="form-addons">
                                    <input name="address" id="address" type="text" placeholder="Enter your email address">
                                    <span class="addressError text-danger m-1"></span>
                                </div>
                            </div>
                            <div class="form-login">
                                <label>Password</label>
                                <div class="pass-group">
                                    <input name="password" id="password" type="password" class="pass-input" placeholder="Enter your password">
                                    <span class="fas toggle-password fa-eye-slash"></span>
                                    <span class="passwordError text-danger m-1"></span>
                                </div>
                            </div>
                            <div class="form-login">
                                <label>Confirm Password</label>
                                <div class="pass-group">
                                    <input name="confirmPassword" id="confirmPassword" type="password" class="pass-input" placeholder="Enter your password">
                                    <span class="fas toggle-password fa-eye-slash"></span>
                                    <span class="confirmPasswordError text-danger m-1"></span>
                                </div>
                            </div>
                            <div class="form-login">
                                <button class="btn btn-login">Sign Up</button>
                            </div>
                            <div class="signinform text-center">
                                <h4>Already a user? <a href="signin.php" class="hover-a">Sign In</a></h4>
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