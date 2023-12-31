<?php
include('php/config.php');
$userId = $_SESSION['uid'];

$fetchUser = mysqli_query($con, "SELECT * FROM users WHERE userId='{$userId}' ");

if ($fetchUser) {
    $userData = mysqli_fetch_assoc($fetchUser);
    $firstName = $userData['firstName'];
    $lastName = $userData['lastName'];
    $email = $userData['email'];
    $userType = $userData['userType'];
}
?>

<div class="header">

    <div class="header-left active">
        <a href="index.html" class="logo logo-normal">
            <img src="assets/img/logo.png" alt>
        </a>
        <a href="index.html" class="logo logo-white">
            <img src="assets/img/logo-white.png" alt>
        </a>
        <a href="index.html" class="logo-small">
            <img src="assets/img/logo-small.png" alt>
        </a>
        <a id="toggle_btn" href="javascript:void(0);">
            <i data-feather="chevrons-left" class="feather-16"></i>
        </a>
    </div>

    <a id="mobile_btn" class="mobile_btn" href="#sidebar">
        <span class="bar-icon">
            <span></span>
            <span></span>
            <span></span>
        </span>
    </a>

    <ul class="nav user-menu">

        <li class="nav-item nav-searchinputs">
            <div class="top-nav-search">
                <a href="javascript:void(0);" class="responsive-search">
                    <i class="fa fa-search"></i>
                </a>
                <form action="#">
                    <div class="searchinputs">
                        <input type="text" placeholder="Search">
                        <div class="search-addon">
                            <span><i data-feather="search" class="feather-14"></i></span>
                        </div>
                    </div>

                </form>
            </div>
        </li>


        <li class="nav-item dropdown has-arrow flag-nav nav-item-box">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="javascript:void(0);" role="button">
                <i data-feather="globe"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="javascript:void(0);" class="dropdown-item active">
                    <img src="assets/img/flags/us.png" alt height="16"> English
                </a>
                <a href="javascript:void(0);" class="dropdown-item">
                    <img src="assets/img/flags/fr.png" alt height="16"> French
                </a>
                <a href="javascript:void(0);" class="dropdown-item">
                    <img src="assets/img/flags/es.png" alt height="16"> Spanish
                </a>
                <a href="javascript:void(0);" class="dropdown-item">
                    <img src="assets/img/flags/de.png" alt height="16"> German
                </a>
            </div>
        </li>

        <li class="nav-item nav-item-box">
            <a href="javascript:void(0);" id="btnFullscreen">
                <i data-feather="maximize"></i>
            </a>
        </li>
        <li class="nav-item nav-item-box">
            <a href="email.html">
                <i data-feather="mail"></i>
                <span class="badge rounded-pill">1</span>
            </a>
        </li>

        <li class="nav-item dropdown nav-item-box">
            <a href="javascript:void(0);" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                <i data-feather="bell"></i><span class="badge rounded-pill">2</span>
            </a>
            <div class="dropdown-menu notifications">
                <div class="topnav-dropdown-header">
                    <span class="notification-title">Notifications</span>
                    <a href="javascript:void(0)" class="clear-noti"> Clear All </a>
                </div>
                <div class="noti-content">
                    <ul class="notification-list">
                        <li class="notification-message">
                            <a href="activities.html">
                                <div class="media d-flex">
                                    <span class="avatar flex-shrink-0">
                                        <img alt src="assets/img/profiles/avatar-02.jpg">
                                    </span>
                                    <div class="media-body flex-grow-1">
                                        <p class="noti-details"><span class="noti-title">John Doe</span> added new task <span class="noti-title">Patient appointment booking</span></p>
                                        <p class="noti-time"><span class="notification-time">4 mins ago</span></p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="notification-message">
                            <a href="activities.html">
                                <div class="media d-flex">
                                    <span class="avatar flex-shrink-0">
                                        <img alt src="assets/img/profiles/avatar-03.jpg">
                                    </span>
                                    <div class="media-body flex-grow-1">
                                        <p class="noti-details"><span class="noti-title">Tarah Shropshire</span> changed the task name <span class="noti-title">Appointment booking with payment gateway</span></p>
                                        <p class="noti-time"><span class="notification-time">6 mins ago</span></p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="notification-message">
                            <a href="activities.html">
                                <div class="media d-flex">
                                    <span class="avatar flex-shrink-0">
                                        <img alt src="assets/img/profiles/avatar-06.jpg">
                                    </span>
                                    <div class="media-body flex-grow-1">
                                        <p class="noti-details"><span class="noti-title">Misty Tison</span> added <span class="noti-title">Domenic Houston</span> and <span class="noti-title">Claire Mapes</span> to project <span class="noti-title">Doctor available module</span></p>
                                        <p class="noti-time"><span class="notification-time">8 mins ago</span></p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="notification-message">
                            <a href="activities.html">
                                <div class="media d-flex">
                                    <span class="avatar flex-shrink-0">
                                        <img alt src="assets/img/profiles/avatar-17.jpg">
                                    </span>
                                    <div class="media-body flex-grow-1">
                                        <p class="noti-details"><span class="noti-title">Rolland Webber</span> completed task <span class="noti-title">Patient and Doctor video conferencing</span></p>
                                        <p class="noti-time"><span class="notification-time">12 mins ago</span></p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="notification-message">
                            <a href="activities.html">
                                <div class="media d-flex">
                                    <span class="avatar flex-shrink-0">
                                        <img alt src="assets/img/profiles/avatar-13.jpg">
                                    </span>
                                    <div class="media-body flex-grow-1">
                                        <p class="noti-details"><span class="noti-title">Bernardo Galaviz</span> added new task <span class="noti-title">Private chat module</span></p>
                                        <p class="noti-time"><span class="notification-time">2 days ago</span></p>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="topnav-dropdown-footer">
                    <a href="activities.html">View all Notifications</a>
                </div>
            </div>
        </li>

        <li class="nav-item nav-item-box">
            <a href="generalsettings.html"><i data-feather="settings"></i></a>
        </li>
        <li class="nav-item dropdown has-arrow main-drop">
            <a href="javascript:void(0);" class="dropdown-toggle nav-link userset" data-bs-toggle="dropdown">
                <span class="user-info">
                    <span class="user-letter">
                        <img src="assets/img/profiles/avator1.jpg" alt class="img-fluid">
                    </span>
                    <span class="user-detail">
                        <span class="user-name text-capitalize"><?php echo $firstName ?></span>
                        <span class="user-role">
                            <?php
                                if ($userType === 'normalUser') {
                                    echo 'Admin';
                                } elseif ($userType === 'superAdmin') {
                                    echo 'Super Admin';
                                } else {
                                    echo '';
                                }
                                ?></span>
                    </span>
                </span>
            </a>
            <div class="dropdown-menu menu-drop-user">
                <div class="profilename">
                    <div class="profileset">
                        <span class="user-img"><img src="assets/img/profiles/avator1.jpg" alt>
                            <span class="status online"></span></span>
                        <div class="profilesets">
                            <h6><?php echo $firstName ?></h6>
                            <h5>
                                <?php
                                if ($userType === 'normalUser') {
                                    echo 'Admin';
                                } elseif ($userType === 'superAdmin') {
                                    echo 'Super Admin';
                                } else {
                                    echo '';
                                }
                                ?>
                            </h5>
                        </div>
                    </div>
                    <hr class="m-0">
                    <a class="dropdown-item" href="profile"> <i class="me-2" data-feather="user"></i> My Profile</a>
                    <a class="dropdown-item" href="generalsettings.html"><i class="me-2" data-feather="settings"></i>Settings</a>
                    <hr class="m-0">
                    <button dataEmail='<?php echo $_SESSION['email'] ?>' class="dropdown-item logoutButton pb-0"><img src="assets/img/icons/log-out.svg" class="me-2" alt="img">Logout</button>
                </div>
            </div>
        </li>
    </ul>


    <div class="dropdown mobile-user-menu">
        <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
        <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="profile">My Profile</a>
            <a class="dropdown-item" href="generalsettings.html">Settings</a>
            <a dataEmail='<?php echo $_SESSION['email'] ?>' class="dropdown-item logoutButton">Logout</a>
        </div>
    </div>

</div>