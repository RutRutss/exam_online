<?php
require 'conn.php';
date_default_timezone_set('Asia/Bangkok');

$data = json_decode(file_get_contents('php://input'), true);

if ($data) {
    $examCode = isset($data['examCode']) ? $data['examCode'] : null;

    $exam_code = "SELECT `exam_code`, exam_end FROM `exam_logs` WHERE exam_code = '$examCode'";
    $q_exam_code = mysqli_query($conn, $exam_code);

    if (mysqli_num_rows($q_exam_code) > 0) {
        $row = mysqli_fetch_assoc($q_exam_code);
        $exam_end = new DateTime($row['exam_end']);
        $current_time = new DateTime();

        if ($current_time > $exam_end) {
            echo "เวลาสอบหมดแล้ว";
        } else {
            // คำนวณเวลาที่เหลือ
            $interval = $current_time->diff($exam_end);
            echo "เวลาที่เหลือ: " . $interval->format('%H ชั่วโมง %I นาที %S วินาที');
        }
    } else {
        echo "ไม่พบการสอบ";
    }
} else {
    echo 'fail';
}
