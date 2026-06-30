<?php

require_once "../app/middleware/auth.php";
require_once "../app/models/Task.php";


$task = new Task();

$userId = $_SESSION["user"]["id"];

 //statistik 

$total = $task->countAll($userId);

$active = $task->countActive($userId);

$done = $task->countDone($userId);

$today = $task->countTodayDeadline($userId);

/*
=================================================
Search + Filter
=================================================
*/

$search = trim($_GET["search"] ?? "");

$status = $_GET["status"] ?? "";

$prioritas = $_GET["prioritas"] ?? "";

$listTask = $task->searchFilter(
    $userId,
    $search,
    $status,
    $prioritas
);


require "../app/views/layouts/header.php";
require "../app/views/partials/navbar.php";

?>

<div class="container py-5">

    <!-- Judul -->

    <div class="mb-4">

        <h2>

            Dashboard

        </h2>

        <p class="text-muted">

            Selamat datang kembali,

            <strong>

                <?= htmlspecialchars($_SESSION["user"]["nama"]) ?>

            </strong>

        </p>

    </div>

    <!-- Statistik -->

    <div class="row">

        <!-- Total -->

        <div class="col-lg-3 col-md-6 mb-4">

            <div class="card stat-card shadow-sm">

                <div class="card-body d-flex justify-content-between align-items-center">

                    <div>

                        <small class="text-muted">

                            Total Tugas

                        </small>

                        <h2>

                            <?= $total["total"]; ?>

                        </h2>

                    </div>

                    <div
                        class="icon-box bg-primary text-white">

                        <i class="bi bi-journal-text"></i>

                    </div>

                </div>

            </div>

        </div>

        <!-- Aktif -->

        <div class="col-lg-3 col-md-6 mb-4">

            <div class="card stat-card shadow-sm">

                <div class="card-body d-flex justify-content-between align-items-center">

                    <div>

                        <small class="text-muted">

                            Aktif

                        </small>

                        <h2>

                            <?= $active["total"]; ?>

                        </h2>

                    </div>

                    <div
                        class="icon-box bg-warning text-white">

                        <i class="bi bi-hourglass-split"></i>

                    </div>

                </div>

            </div>

        </div>

        <!-- Selesai -->

        <div class="col-lg-3 col-md-6 mb-4">

            <div class="card stat-card shadow-sm">

                <div class="card-body d-flex justify-content-between align-items-center">

                    <div>

                        <small class="text-muted">

                            Selesai

                        </small>

                        <h2>

                            <?= $done["total"]; ?>

                        </h2>

                    </div>

                    <div
                        class="icon-box bg-success text-white">

                        <i class="bi bi-check-circle"></i>

                    </div>

                </div>

            </div>

        </div>

        <!-- Deadline -->

        <div class="col-lg-3 col-md-6 mb-4">

            <div class="card stat-card shadow-sm">

                <div class="card-body d-flex justify-content-between align-items-center">

                    <div>

                        <small class="text-muted">

                            Hari Ini

                        </small>

                        <h2>

                            <?= $today["total"]; ?>

                        </h2>

                    </div>

                    <div
                        class="icon-box bg-danger text-white">

                        <i class="bi bi-calendar-event"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- =======================================================
        Progress Penyelesaian
    ======================================================== -->

    <?php

    $totalTask = $total["total"];
    $doneTask  = $done["total"];

    $progress = 0;

    if ($totalTask > 0) {
        $progress = round(($doneTask / $totalTask) * 100);
    }

    ?>

    <div class="card shadow-sm border-0 mb-4">

        <div class="card-body">

            <h5 class="mb-3">
                Progress Penyelesaian
            </h5>

            <div class="progress rounded-pill" style="height:24px;">

                <div
                    class="progress-bar bg-success fw-bold"
                    role="progressbar"
                    style="width: <?= $progress; ?>%;">

                    <?= $progress; ?>%

                </div>

            </div>

            <p class="mt-3 mb-0 text-muted">

                <?= $doneTask; ?>

                dari

                <?= $totalTask; ?>

                tugas telah selesai.

            </p>

        </div>

    </div>

    <!-- Tombol -->

    <div class="my-4">

        <a
            href="task-create.php"
            class="btn btn-primary">

            <i class="bi bi-plus-circle"></i>

            Tambah Tugas

        </a>

    </div>

   <div class="card shadow-sm mb-4">

    <div class="card-body">

        <form method="GET">

            <div class="row g-3">

                <div class="col-md-5">

                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        placeholder="Cari judul atau mata kuliah..."
                        value="<?= htmlspecialchars($search); ?>">

                </div>

                <div class="col-md-2">

                    <select
                        name="status"
                        class="form-select">

                        <option value="">Semua Status</option>

                        <option value="Belum"
                            <?= $status=="Belum" ? "selected" : ""; ?>>

                            Belum

                        </option>

                        <option value="Selesai"
                            <?= $status=="Selesai" ? "selected" : ""; ?>>

                            Selesai

                        </option>

                    </select>

                </div>

                <div class="col-md-2">

                    <select
                        name="prioritas"
                        class="form-select">

                        <option value="">Semua Prioritas</option>

                        <option value="Rendah"
                            <?= $prioritas=="Rendah" ? "selected" : ""; ?>>

                            Rendah

                        </option>

                        <option value="Sedang"
                            <?= $prioritas=="Sedang" ? "selected" : ""; ?>>

                            Sedang

                        </option>

                        <option value="Tinggi"
                            <?= $prioritas=="Tinggi" ? "selected" : ""; ?>>

                            Tinggi

                        </option>

                    </select>

                </div>

                <div class="col-md-2 d-grid">

                    <button
                        class="btn btn-primary">

                        Terapkan

                    </button>

                </div>

                <div class="col-md-1 d-grid">

                    <a
                        href="dashboard.php"
                        class="btn btn-secondary">

                        Reset

                    </a>

                </div>

            </div>

        </form>

    </div>

</div>

    <!-- Table -->

    <div class="card shadow-sm">

        <div class="card-header">

            Daftar Tugas

        </div>

        <div class="card-body">

            <table class="table table-hover">

                <thead>

                    <tr>

                        <th>No</th>

                        <th>Judul</th>

                        <th>Mata Kuliah</th>

                        <th>Deadline</th>

                        <th>Prioritas</th>

                        <th>Status</th>

                        <th>Aksi</th>

                    </tr>

                </thead>

                <tbody>

                    <?php if ($listTask->num_rows > 0): ?>

                        <?php $no = 1; ?>

                         <?php while ($row = $listTask->fetch_assoc()): ?>

                             <tr>

                                <td><?= $no++; ?></td>

                                <td><?= htmlspecialchars($row["judul"]); ?></td>

                                <td><?= htmlspecialchars($row["mata_kuliah"]); ?></td>

                                <td><?= date("d M Y", strtotime($row["deadline"])); ?></td>

                                <td>

                                    <?php if ($row["prioritas"] == "Tinggi"): ?>

                                        <span class="badge bg-danger">
                                            Tinggi
                                        </span>

                                    <?php elseif ($row["prioritas"] == "Sedang"): ?>

                                        <span class="badge bg-warning text-dark">
                                            Sedang
                                        </span>

                                    <?php else: ?>

                                        <span class="badge bg-success">
                                            Rendah
                                        </span>

                                    <?php endif; ?>

                                </td>

                                <td>

                                    <?php if ($row["status"] == "Belum"): ?>

                                        <span class="badge bg-secondary">
                                            Belum
                                        </span>

                                    <?php else: ?>

                                        <span class="badge bg-success">
                                            Selesai
                                        </span>

                                    <?php endif; ?>

                                </td>

                                <td>

                                <?php if ($row["status"] == "Belum"): ?>

                                    <a
                                        href="task-status.php?id=<?= $row["id"]; ?>&status=Selesai"
                                        class="btn btn-sm btn-success">

                                        ✔ Selesai

                                    </a>

                                <?php else: ?>

                                    <a
                                        href="task-status.php?id=<?= $row["id"]; ?>&status=Belum"
                                        class="btn btn-sm btn-secondary">

                                        ↩ Belum

                                    </a>

                                <?php endif; ?>

                                <a
                                    href="task-edit.php?id=<?= $row["id"]; ?>"
                                    class="btn btn-sm btn-warning">

                                    Edit

                                </a>

                                <a href="task-delete.php?id=<?= $row['id']; ?>"
                                class="btn btn-danger btn-sm btn-delete">

                                    Hapus

                                </a>

                                </td>

                            </tr>

                        <?php endwhile; ?>

                    <?php else: ?>

                        <tr>

                            <td colspan="7" class="text-center text-muted">

                                Belum ada tugas yang ditambahkan.

                            </td>

                        </tr>

                    <?php endif; ?>

                    </tbody>
                                </table>

                            </div>

                        </div>

                    </div>

<script>

document.querySelectorAll(".btn-delete").forEach(button => {

    button.addEventListener("click", function(e){

        e.preventDefault();

        const url = this.href;

        Swal.fire({

            title: "Hapus tugas?",

            text: "Data yang dihapus tidak bisa dikembalikan.",

            icon: "warning",

            showCancelButton: true,

            confirmButtonText: "Ya",

            cancelButtonText: "Batal",

            confirmButtonColor: "#dc3545"

        }).then((result)=>{

            if(result.isConfirmed){

                window.location.href = url;

            }

        });

    });

});

</script>

<?php
/*
=========================================================
SweetAlert - Notifikasi Berhasil
Menampilkan popup sukses setelah:
- Tambah Tugas
- Edit Tugas
- Hapus Tugas
- Ubah Status
=========================================================
*/
?>

<?php if (isset($_GET["success"])) : ?>

<script>

document.addEventListener("DOMContentLoaded", function () {

    let pesan = "";

    switch ("<?= $_GET["success"]; ?>") {

        case "create":
            pesan = "Tugas berhasil ditambahkan.";
            break;

        case "edit":
            pesan = "Tugas berhasil diperbarui.";
            break;

        case "delete":
            pesan = "Tugas berhasil dihapus.";
            break;

        case "status":
            pesan = "Status tugas berhasil diperbarui.";
            break;
    }

    if (pesan !== "") {

        Swal.fire({

            icon: "success",

            title: "Berhasil",

            text: pesan,

            confirmButtonText: "OK"

        });

    }

});

</script>

<?php endif; ?>
<?php

require "../app/views/layouts/footer-script.php";

?>