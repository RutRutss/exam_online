<?php
require '../../../controllers/conn.php';
session_start();
$user_id = $_SESSION['user_id'];

if (isset($_POST['cCode']) && isset($_POST['cuNumber']) && isset($_POST['cuName'])) {
    $c_code = $_POST['cCode'];
    $cu_number = $_POST['cuNumber'];
    $cu_name = $_POST['cuName'];

    $insert_course_unit = "INSERT INTO `course_units`(`number`, `name`, `course_code`) 
                            VALUES ('$cu_number','$cu_name','$c_code')";

    $q_course_unit = mysqli_query($conn, $insert_course_unit);

    if ($q_course_unit) {
        echo "success";
    } else {
        echo "false";
    }
} else {
    echo 'no data';
}
