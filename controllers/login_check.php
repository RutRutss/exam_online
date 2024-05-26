<?php
require 'conn.php';
session_start();

if (isset($_POST['username']) && isset($_POST['password'])) {
    $user_id = $_POST['username'];
    $password = $_POST['password'];
    $user = "SELECT * FROM users WHERE user_id = '$user_id' AND password = '$password'";
    $q_user = mysqli_query($conn, $user);
    if ($q_user) {
        $_SESSION['user_id'] = $user_id;
        echo "success";
    } else {
        echo "no user";
    }
} else {
    echo 'invalid';
}
