<?php
require '../../../controllers/conn.php';
date_default_timezone_set('Asia/Bangkok');

$data = json_decode(file_get_contents('php://input'), true);

if ($data) {
    $userID = isset($data['userID']) ? $data['userID'] : null;
    $courseUnitID = isset($data['courseUnitID']) ? $data['courseUnitID'] : null;
    $exam_code = generateRandomString();

    $exam_start = new DateTime();
    $exam_start_formatted = $exam_start->format('Y-m-d H:i:s');

    $exam_start->add(new DateInterval('PT1H'));
    $exam_end = $exam_start->format('Y-m-d H:i:s');


    $insert_new_exam = "INSERT INTO `exam_logs`(`user_create`, `course_unit_id`, `exam_code`, `exam_start`, `exam_end`) 
                        VALUES ('$userID','$courseUnitID','$exam_code','$exam_start_formatted','$exam_end')";
    $q_insert_exam = mysqli_query($conn, $insert_new_exam);

    if ($q_insert_exam) {
        echo "รหัสเข้าสอบ : <strong>" . $exam_code . "</strong><br>เริ่ม " . $exam_start_formatted . "<br>สิ้นสุด " . $exam_end;
    } else {
        echo "create fail";
    }
} else {
    echo 'fail';
}



function generateRandomString()
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $randomString = '';

    for ($i = 0; $i < 6; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}
