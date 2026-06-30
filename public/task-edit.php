<?php
/*
=========================================================
File    : task-edit.php

Fungsi :
Mengubah data tugas.
=========================================================
*/

require_once "../app/middleware/auth.php";
require_once "../app/models/Task.php";

$task = new Task();

$userId = $_SESSION["user"]["id"];

if (!isset($_GET["id"])) {
    header("Location: dashboard.php");
    exit;
}

$id = (int) $_GET["id"];

$data = $task->findById($id, $userId);

if (!$data) {
    header("Location: dashboard.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $judul = trim($_POST["judul"]);
    $mataKuliah = trim($_POST["mata_kuliah"]);
    $deskripsi = trim($_POST["deskripsi"]);
    $deadline = $_POST["deadline"];
    $prioritas = $_POST["prioritas"];
    $status = $_POST["status"];

    $task->update(
        $id,
        $judul,
        $mataKuliah,
        $deskripsi,
        $deadline,
        $prioritas,
        $status
    );
header("Location: dashboard.php?success=edit");
    exit;
}

require "../app/views/layouts/header.php";
require "../app/views/partials/navbar.php";
?>

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card shadow">

                <div class="card-body">

                    <h3 class="mb-4">

                        Edit Tugas

                    </h3>

                    <form method="POST">

                  

                    <div class="mb-3">

                    <label>Judul</label>

                    <input
                    type="text"
                    name="judul"
                    class="form-control"
                    value="<?= htmlspecialchars($data["judul"]); ?>"
                    required>

                    </div>

                    
                    <div class="mb-3">

                    <label>Mata Kuliah</label>

                    <input
                    type="text"
                    name="mata_kuliah"
                    class="form-control"
                    value="<?= htmlspecialchars($data["mata_kuliah"]); ?>">

                    </div>

                  
                    <div class="mb-3">

                    <label>Deskripsi</label>

                    <textarea
                    name="deskripsi"
                    class="form-control"
                    rows="5"><?= htmlspecialchars($data["deskripsi"]); ?></textarea>

                    </div>

                  
                    <div class="mb-3">

                    <label>Deadline</label>

                    <input
                    type="date"
                    name="deadline"
                    class="form-control"
                    value="<?= $data["deadline"]; ?>">

                    </div>

                    
                    <div class="mb-3">

                    <label>Prioritas</label>

                    <select
                    name="prioritas"
                    class="form-select">

                    <option value="Rendah"
                    <?= $data["prioritas"]=="Rendah"?"selected":""; ?>>

                    Rendah

                    </option>

                    <option value="Sedang"
                    <?= $data["prioritas"]=="Sedang"?"selected":""; ?>>

                    Sedang

                    </option>

                    <option value="Tinggi"
                    <?= $data["prioritas"]=="Tinggi"?"selected":""; ?>>

                    Tinggi

                    </option>

                    </select>

                    </div>

                   
                    <div class="mb-3">

                    <label>Status</label>

                    <select
                    name="status"
                    class="form-select">

                    <option value="Belum"
                    <?= $data["status"]=="Belum"?"selected":""; ?>>

                    Belum

                    </option>

                    <option value="Selesai"
                    <?= $data["status"]=="Selesai"?"selected":""; ?>>

                    Selesai

                    </option>

                    </select>

                    </div>

                    //Tombol

                    <div class="mt-4">

                    <button
                    class="btn btn-primary">

                    Update

                    </button>

                    <a
                    href="dashboard.php"
                    class="btn btn-secondary">

                    Batal

                    </a>

                    </div>

                    </form>

                    </div>

                    </div>

                    </div>

                    </div>

                    </div>

                    <?php

                    require "../app/views/layouts/footer-script.php";

                    ?>