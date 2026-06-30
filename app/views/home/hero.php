<?php
/*
=========================================================
File    : hero.php
Folder  : app/views/home/

Fungsi :
Hero Section Landing Page
=========================================================
*/
?>

<!-- ================================================= -->
<!-- HERO SECTION -->
<!-- ================================================= -->

<section class="hero">

    <div class="container">

        <div class="row align-items-center">

            <!-- ========================================= -->
            <!-- Hero Text -->
            <!-- ========================================= -->

            <div class="col-lg-6">

                <span class="badge bg-primary mb-3">

                    🚀 Aplikasi Produktivitas Mahasiswa

                </span>

                <h1 class="hero-title">

                    Kelola Tugas Kuliahmu

                    <span class="text-primary">

                        Lebih Mudah

                    </span>

                </h1>

                <p class="hero-description">

                    TaskFlow membantu mahasiswa mencatat,
                    mengatur, dan menyimpan seluruh tugas
                    kuliah secara aman. Data tetap tersimpan
                    meskipun kamu berganti perangkat.

                </p>

                <div class="mt-4">

                    <a href="dashboard.php"
                        class="btn btn-primary btn-lg me-2">

                        <i class="bi bi-play-fill"></i>

                        Coba Sekarang

                    </a>

                    <a href="login.php"
                        class="btn btn-outline-primary btn-lg">

                        <i class="bi bi-box-arrow-in-right"></i>

                        Login

                    </a>

                </div>

            </div>

            <!-- ========================================= -->
            <!-- Hero Card -->
            <!-- ========================================= -->

            <div class="col-lg-6 mt-5 mt-lg-0">

                <div class="hero-card">

                    <div class="card shadow-lg border-0 rounded-4">

                        <div class="card-body p-4">

                            <h4 class="fw-bold mb-4">

                                Dashboard Preview

                            </h4>

                            <div class="task-item success">

                                <i class="bi bi-check-circle-fill text-success"></i>

                                Praktikum Docker

                            </div>

                            <div class="task-item warning">

                                <i class="bi bi-clock-history text-warning"></i>

                                Tugas Basis Data

                            </div>

                            <div class="task-item danger">

                                <i class="bi bi-exclamation-circle text-danger"></i>

                                Deadline AI Besok

                            </div>

                            <hr>

                            <div class="row text-center">

                                <div class="col">

                                    <h3>20</h3>

                                    <small>Total</small>

                                </div>

                                <div class="col">

                                    <h3 class="text-success">

                                        15

                                    </h3>

                                    <small>Selesai</small>

                                </div>

                                <div class="col">

                                    <h3 class="text-danger">

                                        5

                                    </h3>

                                    <small>Aktif</small>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>