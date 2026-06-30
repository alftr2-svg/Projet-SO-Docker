<?php
/*
=========================================================
File : navbar.php

Navbar utama website.

Menyesuaikan tampilan berdasarkan status login user.
=========================================================
*/

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!-- =====================================================
     Navbar
===================================================== -->

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-3">

    <div class="container">

        <!-- =========================
             Logo
        ========================== -->

        <a class="navbar-brand fw-bold text-primary d-flex align-items-center"
            href="index.php">

            <i class="bi bi-check2-square fs-4 me-2"></i>

            <span>TaskFlow</span>

        </a>

        <!-- =========================
             Tombol Mobile
        ========================== -->

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#menu">

            <span class="navbar-toggler-icon"></span>

        </button>

        <!-- =========================
             Menu
        ========================== -->

        <div
            class="collapse navbar-collapse"
            id="menu">

            <ul class="navbar-nav ms-auto align-items-lg-center">

                <?php if (isset($_SESSION["user"])) : ?>

                    <!-- Nama User -->

                    <li class="nav-item me-lg-4 mb-2 mb-lg-0">

                        <span class="text-secondary">

                            <i class="bi bi-person-circle me-1"></i>

                            Halo,

                        </span>

                        <strong>

                            <?= htmlspecialchars($_SESSION["user"]["nama"]) ?>

                        </strong>

                    </li>

                    <!-- Dashboard -->

                    <li class="nav-item me-lg-2 mb-2 mb-lg-0">

                        <a
                            href="dashboard.php"
                            class="btn btn-outline-primary">

                            <i class="bi bi-speedometer2 me-1"></i>

                            Dashboard

                        </a>

                    </li>

                    <!-- Logout -->

                    <li class="nav-item">

                        <a
                            href="logout.php"
                            class="btn btn-danger">

                            <i class="bi bi-box-arrow-right me-1"></i>

                            Logout

                        </a>

                    </li>

                <?php else : ?>

                    <!-- Landing Page -->

                    <li class="nav-item">

                        <a
                            href="index.php#fitur"
                            class="nav-link">

                            <i class="bi bi-stars me-1"></i>

                            Fitur

                        </a>

                    </li>

                    <!-- Login -->

                    <li class="nav-item me-lg-2 mb-2 mb-lg-0">

                        <a
                            href="login.php"
                            class="btn btn-outline-primary">

                            <i class="bi bi-box-arrow-in-right me-1"></i>

                            Login

                        </a>

                    </li>

                    <!-- Register -->

                    <li class="nav-item">

                        <a
                            href="register.php"
                            class="btn btn-primary">

                            <i class="bi bi-person-plus me-1"></i>

                            Daftar

                        </a>

                    </li>

                <?php endif; ?>

            </ul>

        </div>

    </div>

</nav>