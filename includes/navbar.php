<?php
$user_id = $_SESSION['user_id'];
$user_detail = "SELECT * FROM `users` WHERE user_id = '$user_id'";
$q_user_detail = mysqli_query($conn, $user_detail);
$row_user_detail = mysqli_fetch_array($q_user_detail);

?>
<nav class="navbar navbar-expand-lg bg-white shadow-sm pt-3 pb-3">
    <div class="container d-flex justify-content-between">
        <div class="h1 fw-bolder flex-grow-1"><a class="text-decoration-none text-dark" href="index.php">ระบบการสอบ</a></div>
        <div class="d-flex align-items-center justify-centent-center me-3">
            <div class="rounded-circle me-3" style="overflow: hidden; width: 5rem; height: 5rem;">
                <img class="img-fluid" src="<?= $row_user_detail['img'] ?>" alt="" width="100%" height="100%">
            </div>
            <div class="d-flex flex-column justify-content-center">
                <h5 class="fw-bolder mb-1">ผู้ใช้งาน</h5>
                <p class="mb-0"><?= $row_user_detail['user_id'] ?></p>
                <p class="mb-0"><?= $row_user_detail['fname'] ?> <?= $row_user_detail['lname'] ?></p>
            </div>
        </div>
        <div>
            <button class="btn btn-danger" onclick="logout()">ออกจากระบบ<i class="fa-solid fa-right-from-bracket ms-2"></i></button>
        </div>
    </div>
</nav>