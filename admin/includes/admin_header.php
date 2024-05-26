<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam System</title>
    <link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
    <link href="../node_modules/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../assets/fontawesome-6.5.2/css/fontawesome.css">
    <link rel="stylesheet" href="../assets/fontawesome-6.5.2/css/solid.min.css">
    <!-- JQuery -->
    <script src="../node_modules/jquery/dist/jquery.min.js"></script>

</head>

<body>
    <?php require '../controllers/conn.php' ?>
    <?php
    date_default_timezone_set('Asia/Bangkok');
    session_start();
    $user_id = $_SESSION['user_id'];
    if (!isset($_SESSION['user_id']) && basename($_SERVER['PHP_SELF']) != 'login.php') {
        header('location:login.php');
    }

    $user_role = "SELECT * FROM users WHERE user_id = '$user_id'";
    $q_user_role = mysqli_query($conn, $user_role);
    $row_user_role = mysqli_fetch_array($q_user_role);

    if ($row_user_role['role'] != '05') {
        header('location:../index.php');
    }

    ?>
    <div class="main-container">
        <?php require 'navbar.php' ?>