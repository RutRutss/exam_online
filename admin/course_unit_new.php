<?php require 'includes/admin_header.php'; ?>

<main class="d-flex flex-column container-xxl mx-auto">

    <div class="d-flex w-100 bg-white shadow-sm rounded-3 mt-3 ms-3 me-3 p-3">
        <h3 class="fw-bolder">เพิ่มหน่วยการทดสอบ</h3>
    </div>

    <div class="d-flex flex-column w-100 bg-white shadow-sm rounded-3 m-3 p-3">
        <form id="addCourseUnitForm" action="" method="post">
            <div class="mb-3">
                <label for="" class="mb-2">วิชา</label>
                <select class="form-select" name="c_code" id="c_code">
                    <option>-เลือกวิชา-</option>
                    <?php
                    $all_course = "SELECT c.code AS c_code, c.name AS c_name FROM courses AS c";
                    $q_all_course = mysqli_query($conn, $all_course);

                    if (mysqli_num_rows($q_all_course) > 0) {
                        while ($row_all_course = mysqli_fetch_array($q_all_course)) {
                    ?>
                            <option value="<?= $row_all_course['c_code'] ?>"><?= $row_all_course['c_code'] ?> - <?= $row_all_course['c_name'] ?></option>

                    <?php
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="" class="mb-2">หมายเลขหน่วยการทดสอบ</label>
                <input type="text" class="form-control" name="cu_number" id="cu_number" placeholder="หมายเลขหน่วยการทดสอบ..." required>
            </div>
            <div class="mb-3">
                <label for="" class="mb-2">ชื่อหน่วยการทดสอบ</label>
                <input type="text" class="form-control" name="cu_name" id="cu_name" placeholder="ชื่อหน่วยการทดสอบ..." required>
            </div>
            <button type="submit" class="btn btn-primary w-100" id="btn-add-course">เพิ่มหน่วยการทดสอบ</button>
        </form>
    </div>

</main>
<script>
    $(document).ready(function() {
        $('#addCourseUnitForm').submit(function(event) {
            event.preventDefault();

            var cCode = $('#c_code').val()
            var cuNumber = $('#cu_number').val()
            var cuName = $('#cu_name').val()

            var dataToSend = {
                cCode: cCode,
                cuNumber: cuNumber,
                cuName: cuName,
            };
            $.ajax({
                url: "controllers/course_unit/course_unit_insert.php",
                type: "POST",
                data: dataToSend,
                success: function(response) {
                    if (response == 'success') {
                        Swal.fire({
                            title: 'สำเร็จ',
                            text: 'เพิ่มหน่วยการทดสอบสำเร็จ',
                            icon: 'success',
                            confirmButtonText: 'ตกลง'
                        })
                    } else if (response == 'false') {
                        Swal.fire({
                            title: 'ไม่สำเร็จ',
                            text: 'หน่วยการทดสอบนี้มีแล้ว',
                            icon: 'error',
                            confirmButtonText: 'ตกลง'
                        })
                    }

                },
                error: function(xhr, status, error) {
                    console.log("Error:", error)
                }
            });
        })
    });
</script>

<?php require 'includes/admin_footer.php'; ?>