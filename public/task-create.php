<?php
/*
=========================================================
File : task-create.php

Fungsi :
Menambahkan tugas baru.
=========================================================
*/

require_once "../app/middleware/auth.php";
require_once "../app/models/Task.php";

$task = new Task();

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{

    $judul = trim($_POST["judul"]);

    $mataKuliah = trim($_POST["mata_kuliah"]);

    $deskripsi = trim($_POST["deskripsi"]);

    $deadline = $_POST["deadline"];

    $prioritas = $_POST["prioritas"];

    if(

        $task->create(

            $_SESSION["user"]["id"],

            $judul,

            $mataKuliah,

            $deskripsi,

            $deadline,

            $prioritas

        )

    ){

        header("Location: dashboard.php?success=create");

        exit;

    }

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

Tambah Tugas

</h3>

<form method="POST">

<div class="mb-3">

<label>

Judul

</label>

<input

type="text"

class="form-control"

name="judul"

required>

</div>

<div class="mb-3">

<label>

Mata Kuliah

</label>

<input

type="text"

class="form-control"

name="mata_kuliah">

</div>

<div class="mb-3">

<label>

Deskripsi

</label>

<textarea

class="form-control"

rows="5"

name="deskripsi"></textarea>

</div>

<div class="row">

<div class="col-md-6">

<label>

Deadline

</label>

<input

type="date"

class="form-control"

name="deadline">

</div>

<div class="col-md-6">

<label>

Prioritas

</label>

<select

class="form-select"

name="prioritas">

<option>Rendah</option>

<option selected>Sedang</option>

<option>Tinggi</option>

</select>

</div>

</div>

<div class="mt-4">

<button

class="btn btn-primary">

Simpan

</button>

<a

href="dashboard.php"

class="btn btn-secondary">

Kembali

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