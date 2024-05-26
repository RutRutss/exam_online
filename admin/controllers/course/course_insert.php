<?php
require '../../../controllers/conn.php';
session_start();
$user_id = $_SESSION['user_id'];

if (isset($_POST['cCode']) && isset($_POST['cName'])) {
    $c_code = $_POST['cCode'];
    $c_name = $_POST['cName'];

    $insert_new_course = "INSERT INTO `courses`(`code`, `name`, `create_user`) VALUES ('$c_code','$c_name','$user_id')";
    $q_new_course = mysqli_query($conn, $insert_new_course);

    if($q_new_course){
        echo "success";
    }else{
        echo "false";
    }
    
} else {
    echo 'no data';
}
