<?php
require 'conn.php';
date_default_timezone_set('Asia/Bangkok');

$data = json_decode(file_get_contents('php://input'), true);

if ($data) {
    $userID = isset($data['userID']) ? $data['userID'] : null;
    $examCode = isset($data['examCode']) ? $data['examCode'] : null;

    $insert_test_log = "INSERT INTO `std_test_logs`(`user_id`, `exam_code`) 
                        VALUES ('$userID','$examCode')";
    $q_insert_test_log = mysqli_query($conn, $insert_test_log);
    
} else {
    echo 'fail';
}
