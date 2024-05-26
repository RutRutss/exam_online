<?php
require '../../../controllers/conn.php';

// รับข้อมูล JSON ที่ถูกส่งมา
$data = json_decode(file_get_contents('php://input'), true);

if ($data) {
    $qType = isset($data['qType']) ? $data['qType'] : null;
    $question = isset($data['question']) ? $data['question'] : null;
    $cuID = isset($data['cuID']) ? $data['cuID'] : null;
    $choices = isset($data['answers']) ? $data['answers'] : null;

    $insert_question = "INSERT INTO `questions`(`title`, `unit_id`, `question_type`) 
                        VALUES ('$question','$cuID','$qType')";
    $q_insert_question = mysqli_query($conn, $insert_question);


    if ($q_insert_question) {
        $q_id = mysqli_insert_id($conn);
        foreach ($choices as $choice) {
            $detail = $choice[0];
            $isCorrect = $choice[1];
            $insert_choice = "INSERT INTO `choices`(`q_id`, `detail`, `answer`) VALUES ('$q_id','$detail','$isCorrect')";
            $q_insert_choice = mysqli_query($conn, $insert_choice);

            if ($q_insert_choice) {
                $response = [
                    "status" => "success",
                    "message" => "Insert Success"
                ];
            } else {
                $response = [
                    "status" => "error",
                    "message" => "Insert Fail"
                ];
            }
        }
    }
} else {
    $response = [
        "status" => "error",
        "message" => "Invalid data"
    ];
}

// ส่งผลลัพธ์กลับไปเป็น JSON
header('Content-Type: application/json');
echo json_encode($response);
