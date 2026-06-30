<?php
/*
=========================================================
File    : database.php
Folder  : app/config/

Fungsi :
Membuat koneksi database menggunakan MySQLi.

File ini akan dipanggil oleh seluruh Model
agar koneksi database cukup dibuat satu kali.

=========================================================
*/

class Database
{

    /* ================================================
       Konfigurasi Database
    ================================================= */

    private $host = "mysql";

    private $username = "todo_user";

    private $password = "123456";

    private $database = "todo_db";

    public $conn;

    /* ================================================
       Membuat Koneksi
    ================================================= */

    public function connect()
    {

        $this->conn = new mysqli(

            $this->host,

            $this->username,

            $this->password,

            $this->database

        );

        if ($this->conn->connect_error) {

            die(

                "Koneksi Database Gagal : "

                .

                $this->conn->connect_error

            );

        }

        return $this->conn;

    }

}