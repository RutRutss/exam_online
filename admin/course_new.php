<?php require 'includes/admin_header.php'; ?>

<main class="d-flex flex-column container-xxl mx-auto">
    <div class="d-flex w-100 bg-white shadow-sm rounded-3 mt-3 ms-3 me-3 p-3">
        <h3>เพิ่มรายวิชา</h3>
    </div>
    <div class="d-flex flex-column w-100 bg-white shadow-sm rounded-3 m-3 p-3">
        <form id="addCourseForm" action="" method="post">
            <div class="mb-3">
                <label for="" class="mb-2">รหัสวิชา</label>
                <input type="text" class="form-control" name="c_code" id="c_code" placeholder="รหัสวิชา..." required>
            </div>
            <div class="mb-3">
                <label for="" class="mb-2">ชื่อวิชา</label>
                <input type="text" class="form-control" name="c_name" id="c_name" placeholder="ชื่อวิชา..." required>
            </div>
            <button type="submit" class="btn btn-primary w-100" id="btn-add-course">เพิ่มรายวิชา</button>
        </form>
    </div>

</main>
<script>
    $(document).ready(function() {
        $('#addCourseForm').submit(function(event) {
            event.preventDefault();

            var cCode = $('#c_code').val()
            var cName = $('#c_name').val()

            var dataToSend = {
                cCode: cCode,
                cName: cName
            };

            $.ajax({
                url: "controllers/course/course_insert.php",
                type: "POST",
                data: dataToSend,
                success: function(response) {
                    if (response == 'success') {
                        Swal.fire({
                            title: 'สำเร็จ',
                            text: 'เพิ่มรายวิชาสำเร็จ',
                            icon: 'success',
                            confirmButtonText: 'ตกลง'
                        })
                    } else if (response == 'false') {
                        Swal.fire({
                            title: 'ไม่สำเร็จ',
                            text: 'รหัสวิชาซ้ำ',
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