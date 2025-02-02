<?php
session_start();

function login($email, $password, $conn)
{
  // Sanitize inputs
  $email = mysqli_real_escape_string($conn, $email);

  // Get user from database
  $query = "SELECT userId, email, password, firstName, lastName, role
              FROM users 
              WHERE email = '$email'";

  $result = mysqli_query($conn, $query);

  if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);

    if (password_verify($password, $user['password'])) {
      // Set session variables
      $_SESSION['user_id'] = $user['userId'];
      $_SESSION['email'] = $user['email'];
      $_SESSION['fullname'] = $user['firstName'] . ' '. $user['lastName'];
      $_SESSION['role'] = $user['role'];

      if ($_SESSION['role'] === 'admin') {
        header('Location: dashboard');
      }

      return "success";
    }
  }
}


function isLoggedIn()
{
  return isset($_SESSION['user_id']);
}

function isAdmin()
{
  return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

function isSysAdmin()
{
  return (isset($_SESSION['sysadmin']) && $_SESSION['sysadmin'] === true);
}

function isSysAdminOrAdmin()
{
  return (isset($_SESSION['sysadmin']) && $_SESSION['sysadmin'] === true) ||
    (isset($_SESSION['role']) && $_SESSION['role'] === 'admin');
}

function requireLogin()
{
  if (!isLoggedIn()) {
    header('Location: /login');
    exit();
  }
}

function requireAdmin()
{
  requireLogin();
  if (!isAdmin()) {
    header('Location: /pos');
    exit();
  }
}
