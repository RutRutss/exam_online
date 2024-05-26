<!-- Vertical Navbar on large screens, horizontal on smaller screens -->
<nav class="navbar admin-navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="d-flex flex-column w-100 h-100 p-3">
        <div class="container-fluid flex-lg-column">
            <div class="d-flex justify-content-between">

                <a class="navbar-brand fw-bolder" href="../index.php"><i class="fa-solid fa-angles-left me-2"></i>หน้านักเรียน</a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

            </div>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav flex-lg-column fw-bolder">
                    <li class="nav-item">
                        <a class="nav-link <?= (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active' : '' ?>" aria-current="page" href="index.php"><i class="fa-solid fa-house me-2"></i>หน้าแรก</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= (basename($_SERVER['PHP_SELF']) == 'course_new.php') ? 'active' : '' ?>" href="course_new.php"><i class="fa-solid fa-book me-2"></i>เพิ่มวิชาใหม่</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= (basename($_SERVER['PHP_SELF']) == 'course_unit_new.php') ? 'active' : '' ?>" href="course_unit_new.php"><i class="fa-solid fa-file me-2"></i>เพิ่มหน่วย</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= (basename($_SERVER['PHP_SELF']) == 'question_new.php') ? 'active' : '' ?>" href="question_new.php"><i class="fa-solid fa-file-lines me-2"></i>เพิ่มข้อสอบ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= (basename($_SERVER['PHP_SELF']) == 'exam_start.php') ? 'active' : '' ?>" href="exam_start.php"><i class="fa-solid fa-hourglass-start me-2"></i>เริ่มการสอบ</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>