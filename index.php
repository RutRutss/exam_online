<?php require 'includes/header.php' ?>

<main class="container">
    <div class="d-flex flex-column justify-content-center align-items-center" style="height: 60vh;">
        <h3 class="mb-3 fw-bolder">รหัสการสอบ</h3>
        <form id="startTestForm" action="" method="post" class="w-100">
            <div class="d-flex justify-content-center">
                <input type="text" class="form-control fs-4 p-4 w-50 me-3" name="exam_code" id="exam_code" placeholder="รหัสการสอบ..." autofocus required>
                <input type="submit" class="btn btn-primary ps-4 pe-4 fs-4" value="เข้าสอบ">
            </div>
        </form>
    </div>
</main>
<script>
    $(document).ready(function() {
        $('#startTestForm').submit(function() {
            event.preventDefault();

            var userID = '<?= $_SESSION['user_id'] ?>'
            var examCode = $('#exam_code').val()

            $.ajax({
                url: "controllers/check_exam_code.php",
                type: "POST",
                data: JSON.stringify({
                    examCode: examCode,
                }),
                success: function(response) {
                    Swal.fire({
                        title: 'สำเร็จ',
                        text: response,
                        icon: 'success',
                        confirmButtonText: 'ตกลง'
                    })
                },
                error: function(xhr, status, error) {
                    console.log("Error:", error)
                }
            });

            // $.ajax({
            //     url: "controllers/start_test.php",
            //     type: "POST",
            //     data: JSON.stringify({
            //         userID: userID,
            //         examCode: examCode,
            //     }),
            //     success: function(response) {
            //         if (response) {
            //             Swal.fire({
            //                 title: 'สำเร็จ',
            //                 text: response,
            //                 icon: 'success',
            //                 confirmButtonText: 'ตกลง'
            //             })
            //         } else if (response == 'fail') {
            //             Swal.fire({
            //                 title: 'ไม่สำเร็จ',
            //                 text: 'สอบไม่ได้',
            //                 icon: 'error',
            //                 confirmButtonText: 'ตกลง'
            //             })
            //         }

            //     },
            //     error: function(xhr, status, error) {
            //         console.log("Error:", error)
            //     }
            // });
        })
    })
</script>
<?php require 'includes/footer.php' ?>