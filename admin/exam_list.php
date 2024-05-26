<?php require 'includes/admin_header.php'; ?>
<?php
$selected_c_code = '';
$selected_cu_id = '';

if (isset($_GET['selected_c_code'])) {
    $selected_c_code = $_GET['selected_c_code'];
}

if (isset($_GET['selected_cu_id'])) {
    $selected_cu_id = $_GET['selected_cu_id'];
}

?>
<main class="d-flex flex-column container mx-auto">

    <div class="d-flex w-100 bg-white shadow-sm rounded-3 mt-3 ms-3 me-3 p-3 border-start border-5 border-warning">
        <h3 class="fw-bolder">รายการสอบ</h3>
    </div>

    <div class="d-flex flex-column w-100 bg-white shadow-sm rounded-3 mt-3 ms-3 me-3 p-3">
        <?php
        $all_exam = "SELECT `exam_code`,`exam_start`, `exam_end`, c.name AS c_name, cu.name AS cu_name
                    FROM `exam_logs` AS exl
                    INNER JOIN course_units AS cu ON cu.id = exl.course_unit_id
                    INNER JOIN courses AS c ON c.code = cu.course_code";
        $q_all_exam = mysqli_query($conn, $all_exam);

        if ($q_all_exam) {
            if (mysqli_num_rows($q_all_exam) > 0) {
                $count = 0;
        ?>
                <table class="table table-striped">
                    <thead>
                        <th>ลำดับ</th>
                        <th>วิชา</th>
                        <th>หน่วยการสอบ</th>
                        <th>รหัสเข้าสอบ</th>
                        <th>เริ่ม</th>
                        <th>สิ้นสุด</th>
                        <th>เวลาที่เหลือ</th>
                    </thead>
                    <tbody>

                        <?php
                        while ($row_all_exam = mysqli_fetch_array($q_all_exam)) {
                            $count += 1;

                            $exam_end = new DateTime($row_all_exam['exam_end']);

                            // เวลาปัจจุบัน
                            $current_time = new DateTime();

                            // คำนวณความแตกต่างระหว่างเวลาสิ้นสุดและเวลาปัจจุบัน
                            $interval = $current_time->diff($exam_end);

                            // ตรวจสอบว่าสอบจบแล้วหรือยัง
                            if ($current_time > $exam_end) {
                                $time_remaining = "Exam has ended.";
                            } else {
                                $time_remaining = $interval->format('%H : %I : %S');
                            }
                        ?>
                            <tr>
                                <td><?= $count ?></td>
                                <td><?= $row_all_exam['c_name'] ?></td>
                                <td><?= $row_all_exam['cu_name'] ?></td>
                                <td><?= $row_all_exam['exam_code'] ?></td>
                                <td><?= $row_all_exam['exam_start'] ?></td>
                                <td><?= $row_all_exam['exam_end'] ?></td>
                                <td><?= $time_remaining ?></td>
                            </tr>
                        <?php
                        }
                        ?>

                    </tbody>
                </table>
        <?php
            }
        }
        ?>
    </div>
</main>
<?php require 'includes/admin_footer.php'; ?>