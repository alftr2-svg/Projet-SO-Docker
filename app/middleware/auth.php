<?php
/*
=========================================================
File    : auth.php
Folder  : app/middleware/

Fungsi :
Melindungi halaman yang hanya boleh diakses
oleh pengguna yang sudah login.
=========================================================
*/

session_start();

if (!isset($_SESSION["user"])) {

    header("Location: login.php");

    exit;

}