<?php
require '../../../controllers/conn.php';

// รับข้อมูล JSON ที่ถูกส่งมา
$data = json_decode(file_get_contents('php://input'), true);

if ($data) {
    $userID = isset($data['userID']) ? $data['userID'] : null;
    $courseUnitID = isset($data['courseUnitID']) ? $data['courseUnitID'] : null;
    $exam_code = generateRandomString();

    echo $userID;
} else {
    $response = [
        "status" => "error",
        "message" => "Invalid data"
    ];
}



function generateRandomString()
{
    // ตัวเลขและตัวอักษรที่สามารถใช้ได้
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $randomString = '';

    // สุ่มตัวอักษรและตัวเลขตามความยาวที่กำหนด
    for ($i = 0; $i < 6; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $randomString;
}
