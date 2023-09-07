<?php session_start();
include_once('includes/head.php'); ?>

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
                            <h3>Reset Password</h3>
                        </div>
                        <form class="resetPasswordForm" action="" method="POST">
                            <div class="form-login">
                                <label>Password</label>
                                <div class="pass-group">
                                    <input name="password" id="password" type="password" class="pass-input" placeholder="Enter your password">
                                    <span class="fas toggle-password fa-eye-slash"></span>
                                </div>
                                <span class="m-1 text-danger passwordError"></span>
                            </div>
                            <input type="hidden" name="email" id="email" value="<?php echo $_SESSION['emailExist'] ?>">
                            <div class="form-login">
                                <label>Confirm Password</label>
                                <div class="pass-group">
                                    <input name="confirmPassword" id="confirmPassword" type="password" class="pass-inputs" placeholder="Confirm your password">
                                    <span class="fas toggle-passwords fa-eye-slash"></span>
                                </div>
                                <span class="m-1 text-danger confirmPasswordError"></span>
                            </div>
                            <div class="form-login">
                                <button type="submit" class="btn btn-login">Reset Password</button>
                            </div>
                            <div class="signinform text-center">
                                <h4>Remember your password ? <a href="signin.php" class="hover-a">Sign In</a></h4>
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