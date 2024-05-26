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

$question_type = "SELECT qt.id AS qt_id, qt.name AS qt_name FROM `question_types` AS qt";
$q_question_type = mysqli_query($conn, $question_type);
$qt_option = '';
if ($q_question_type) {
    while ($row_qt = mysqli_fetch_array($q_question_type)) {
        $qt_option .= '<option value="' . $row_qt['qt_id'] . '">' . $row_qt["qt_name"] . '</option>';
    }
}
?>
<main class="d-flex flex-column container mx-auto">

    <div class="d-flex w-100 bg-white shadow-sm rounded-3 mt-3 ms-3 me-3 p-3 border-start border-5 border-warning">
        <h3 class="fw-bolder">เพิ่มข้อสอบ</h3>
    </div>

    <div class="d-flex flex-column w-100 bg-white shadow-sm rounded-3 mt-3 ms-3 me-3 p-3">
        <div class="d-flex flex-wrap align-items-center justify-content-center">
            <form action="" method="get" id="select_course_form">
                <div class="d-flex flex-wrap align-items-center justify-content-center me-2">
                    <label for="" class="me-2">วิชา</label>
                    <select class="form-select me-2" name="selected_c_code" id="selected_c_code" style="width: fit-content;">
                        <option value="">-เลือกวิชา-</option>
                        <?php
                        $all_course = "SELECT c.code AS c_code, c.name AS c_name FROM courses AS c";
                        $q_all_course = mysqli_query($conn, $all_course);

                        if (mysqli_num_rows($q_all_course) > 0) {
                            while ($row_all_course = mysqli_fetch_array($q_all_course)) {
                        ?>
                                <option value="<?= $row_all_course['c_code'] ?>" <?= ($selected_c_code == $row_all_course['c_code']) ? 'selected' : '' ?>><?= $row_all_course['c_code'] ?> - <?= $row_all_course['c_name'] ?></option>

                        <?php
                            }
                        }
                        ?>
                    </select>
                    <label for="" class="me-2">หน่วยการทดสอบ</label>
                    <select class="form-select me-2" name="selected_cu_id" id="selected_cu_id" style="width: fit-content;" disabled>
                        <option value="">-เลือกหน่วยการทดสอบ-</option>
                        <?php
                        $selected_course_code = "";
                        if ($selected_c_code != '') {
                            $selected_course_code = "AND course_code = '$selected_c_code'";
                        }
                        $all_course_unit = "SELECT cu.id AS cu_id, cu.number AS cu_number, cu.name AS cu_name FROM `course_units` AS cu WHERE 1 $selected_course_code";
                        $q_course_unit = mysqli_query($conn, $all_course_unit);

                        if (mysqli_num_rows($q_course_unit) > 0) {
                            while ($row_course_unit = mysqli_fetch_array($q_course_unit)) {
                            ?>
                                <option value="<?= $row_course_unit['cu_id'] ?>" <?= ($selected_cu_id == $row_course_unit['cu_id']) ? 'selected' : '' ?>><?= $row_course_unit['cu_number'] ?> : <?= $row_course_unit['cu_name'] ?></option>

                            <?php
                            }
                        } else { ?>
                            <option value="">ไม่พบหน่วยการทดสอบ</option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </form>
            <button class="btn btn-primary" id="btn-add-question" disabled>เพิ่มคำถาม</button>
        </div>
    </div>
    <div class="d-flex flex-wrap w-100 mt-3 ms-3 me-3">
        <?php

        // คำถามทั้งหมด
        $all_question = "SELECT *, q.title AS q_name, q.id AS q_id
                            FROM questions AS q WHERE unit_id = '$selected_cu_id'";
        $q_all_question = mysqli_query($conn, $all_question);

        if ($q_all_question) {
            if (mysqli_num_rows($q_all_question) > 0) { ?>
                <?php
                $q_count = 0;
                while ($row_q = mysqli_fetch_array($q_all_question)) {
                    $q_count += 1;
                ?>
                    <div class="d-flex flex-column bg-white rounded-3 shadow-sm me-3 mb-3 p-3" style="width: 25rem;">
                        <h4 class="fw-bolder"><?= "ข้อที่ " . $q_count . " : " . $row_q['q_name'] ?></h4>
                        <?php
                        $q_id = $row_q['q_id'];
                        $all_choice = "SELECT *, ch.detail AS ch_detail, ch.answer AS ch_aws FROM `choices` AS ch WHERE q_id = '$q_id'";
                        $q_all_choice = mysqli_query($conn, $all_choice); ?>
                        <ol class="list-group list-group-numbered">
                            <?php
                            while ($row_choice = mysqli_fetch_array($q_all_choice)) { ?>
                                <li class="list-group-item"><?= $row_choice['ch_detail'] ?> <?= ($row_choice['ch_aws'] == 1) ? '<i class="fa-solid fa-check ms-2 text-success"></i>' : '' ?></li>
                            <?php
                            } ?>
                        </ol>
                    </div>
            <?php
                }
            } else {
                echo 'ไม่พบคำถาม หรือยังไม่ได้เลือกหน่วยการทดสอบ';
            } ?>


        <?php
        } else {
            echo 'ไม่พบคำถาม';
        }
        ?>
    </div>
</main>
<script>
    $(document).ready(function() {
        $('#selected_c_code').change(function() {
            $('#selected_cu_id').val('')
            $('#select_course_form').submit()
        })
        $('#selected_cu_id').change(function() {
            $('#select_course_form').submit()
        })

        if ($('#selected_c_code').val() != '') {
            $('#selected_cu_id').removeAttr('disabled')
        }

        if ($('#selected_c_code').val() != '' && $('#selected_cu_id').val() != '') {
            $('#btn-add-question').removeAttr('disabled')
        }



        $('#btn-add-question').click(function() {
            const optionsHtml = `<?php echo $qt_option; ?>`;
            var cuID = $('#selected_cu_id').val()

            Swal.fire({
                    title: 'เพิ่มคำถาม',
                    html: '<div class="d-flex flex-column align-items-start">' +
                        '<label class="mb-3">ประเภทคำถาม</label>' +
                        '<select id="q_type" class="form-select mb-3">' +
                        optionsHtml +
                        '</select>' +
                        '<label class="mb-3">คำถาม</label>' +
                        '<input id="question" class="form-control mb-3" placeholder="คำถาม...">' +
                        '<div class="form-check mb-3">' +
                        '<input id="aws-1" type="checkbox" class="form-check-input aws-input" value="aws1">' +
                        '<input id="aws-1-text" class="form-control" placeholder="ตัวเลือกที่ 1 ..."></input>' +
                        '</div>' +
                        '<div class="form-check mb-3">' +
                        '<input id="aws-2" type="checkbox" class="form-check-input aws-input" value="aws2">' +
                        '<input id="aws-2-text" class="form-control" placeholder="ตัวเลือกที่ 2 ..."></input>' +
                        '</div>' +
                        '<div class="form-check mb-3">' +
                        '<input id="aws-3" type="checkbox" class="form-check-input aws-input" value="aws3">' +
                        '<input id="aws-3-text" class="form-control" placeholder="ตัวเลือกที่ 3 ..."></input>' +
                        '</div>' +
                        '<div class="form-check mb-3">' +
                        '<input id="aws-4" type="checkbox" class="form-check-input aws-input" value="aws4">' +
                        '<input id="aws-4-text" class="form-control" placeholder="ตัวเลือกที่ 4 ..."></input>' +
                        '</div>' +
                        '</div>',
                    focusConfirm: false,
                    showCancelButton: true,
                    confirmButtonText: 'Submit',
                    preConfirm: () => {
                        const qType = Swal.getPopup().querySelector('#q_type').value;
                        const question = Swal.getPopup().querySelector('#question').value;
                        const awsInputs = Swal.getPopup().querySelectorAll('.aws-input');
                        const answers = [];

                        let allInputsFilled = true;

                        awsInputs.forEach(input => {
                            const textInput = Swal.getPopup().querySelector(`#${input.id}-text`).value;
                            const isChecked = input.checked ? 1 : 0;
                            if (!textInput) {
                                allInputsFilled = false;
                            }
                            answers.push([textInput, isChecked]);
                        });

                        if (!qType || !question || answers.length !== 4 || !allInputsFilled) {
                            Swal.showValidationMessage(`กรุณากรอกข้อมูลให้ครบทุกช่อง`);
                            return false; // Return false to prevent Swal from closing
                        }


                        return {
                            cuID: cuID,
                            qType: qType,
                            question: question,
                            answers: answers
                        };
                    }
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        const data = result.value;

                        $.ajax({
                            url: 'controllers/question/question_insert.php',
                            type: 'POST',
                            contentType: 'application/json',
                            data: JSON.stringify(data),
                            success: function(response) {
                                Swal.fire({
                                    title: 'Success',
                                    text: 'คำถามถูกบันทึกเรียบร้อยแล้ว!',
                                    icon: 'success'
                                }).then(() => {
                                    location.reload()
                                });
                            },
                            error: function(error) {
                                Swal.fire({
                                    title: 'Error',
                                    text: 'เกิดข้อผิดพลาดในการบันทึกคำถาม!',
                                    icon: 'error'
                                });
                            }
                        });
                    }
                });
        })

    })
</script>

<?php require 'includes/admin_footer.php'; ?>