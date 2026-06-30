<?php
/*
=========================================================
File    : task-delete.php
Folder  : public/

Fungsi :
Menghapus tugas berdasarkan ID milik user yang login.
=========================================================
*/

require_once "../app/middleware/auth.php";
require_once "../app/models/Task.php";

$task = new Task();

if (!isset($_GET["id"])) {
    header("Location: dashboard.php");

    exit;
}

$id = (int) $_GET["id"];
$userId = $_SESSION["user"]["id"];

/*
=========================================================
Pastikan tugas milik user yang sedang login
=========================================================
*/

$data = $task->findById($id, $userId);

if (!$data) {
    header("Location: dashboard.php");

    exit;}

/*
=========================================================
Hapus data
=========================================================
*/

$task->delete($id);

header("Location: dashboard.php?success=delete");
exit;