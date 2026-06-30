<?php
/*
=========================================================
File    : task-status.php

Fungsi :
Mengubah status tugas.
=========================================================
*/

require_once "../app/middleware/auth.php";
require_once "../app/models/Task.php";

$task = new Task();

if (
    !isset($_GET["id"]) ||
    !isset($_GET["status"])
) {
    header("Location: dashboard.php");
    exit;
}

$id = (int) $_GET["id"];

$status = $_GET["status"];

$userId = $_SESSION["user"]["id"];

/*
=========================================================
Validasi Status
=========================================================
*/

if (
    $status != "Belum" &&
    $status != "Selesai"
) {
    header("Location: dashboard.php");
    exit;
}

$task->updateStatus(
    $id,
    $userId,
    $status
);

header("Location: dashboard.php?success=status");
exit;