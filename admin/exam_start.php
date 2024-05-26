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
        <h3 class="fw-bolder">เริ่มการสอบ</h3>
    </div>

    <div class="d-flex flex-column w-100 bg-white shadow-sm rounded-3 mt-3 ms-3 me-3 p-3">
        <form id="examStartForm" action="" method="GET">
            <div class="mb-3">
                <label for="" class="me-2">วิชา</label>
                <select class="form-select me-2" name="selected_c_code" id="selected_c_code">
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
            </div>
            <div class="mb-3">
                <label for="" class="me-2">หน่วยการทดสอบ</label>
                <select class="form-select me-2" name="selected_cu_id" id="selected_cu_id" disabled>
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
        <input type="submit" onclick="startExam()" class="btn btn-primary w-100" value="เริ่มการสอบ">
    </div>
</main>
<script>
    $(document).ready(function() {
        $('#selected_c_code').change(function() {
            $('#selected_cu_id').val('')
            $('#examStartForm').submit()
        })
        $('#selected_cu_id').change(function() {
            $('#examStartForm').submit()
        })

        if ($('#selected_c_code').val() != '') {
            $('#selected_cu_id').removeAttr('disabled')
        }

        if ($('#selected_c_code').val() != '' && $('#selected_cu_id').val() != '') {
            $('#btn-add-question').removeAttr('disabled')
        }
    })

    const startExam = () => {
        var userID = '<?= $_SESSION['user_id'] ?>'
        var courseUnitID = $('#selected_cu_id').val()

        var dataToSend = {
            userID: userID,
            courseUnitID: courseUnitID,
        };
        $.ajax({
            url: "controllers/exam_start/exam_start_insert.php",
            type: "POST",
            data: dataToSend,
            success: function(response) {
                console.log(response)
                if (response) {
                    Swal.fire({
                        title: 'สำเร็จ',
                        text: response,
                        icon: 'success',
                        confirmButtonText: 'ตกลง'
                    })
                } else if (response == 'false') {
                    Swal.fire({
                        title: 'ไม่สำเร็จ',
                        text: 'ไม่สำเร็จ',
                        icon: 'error',
                        confirmButtonText: 'ตกลง'
                    })
                }
            },
            error: function(xhr, status, error) {
                console.log("Error:", error)
            }
        });

    }
</script>

<?php require 'includes/admin_footer.php'; ?>