<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam System</title>
    <link href="./node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="./node_modules/jquery/dist/jquery.min.js"></script>
    <link href="./assets/css/style.css" rel="stylesheet">
    <link href="./node_modules/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="./assets/fontawesome-6.5.2/css/fontawesome.css">
    <link rel="stylesheet" href="./assets/fontawesome-6.5.2/css/solid.min.css">

</head>

<body>
    <?php require './controllers/conn.php' ?>
    <?php
    session_start();

    if (!isset($_SESSION['user_id']) && basename($_SERVER['PHP_SELF']) != 'login.php') {
        header('location:login.php');
    }
    ?>
    <div class="min-vh-100">
        <?php
        if (basename($_SERVER['PHP_SELF']) != 'login.php') {
            require 'navbar.php';
        }
        ?>