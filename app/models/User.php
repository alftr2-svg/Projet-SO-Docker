<?php
/*
=========================================================
File    : User.php

Fungsi :
Model User
=========================================================
*/

require_once __DIR__ . '/../config/database.php';

class User
{
    private $conn;

    public function __construct()
    {
        $database = new Database();

        $this->conn = $database->connect();
    }

    /* =========================================
       Cek Email
    ========================================= */

    public function findByEmail($email)
    {
        $sql = "SELECT * FROM users WHERE email = ?";

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param("s", $email);

        $stmt->execute();

        return $stmt->get_result();
    }

    /* =========================================
       Register User
    ========================================= */

    public function create($nama, $email, $password)
    {
        $sql = "
            INSERT INTO users
            (
                nama,
                email,
                password
            )
            VALUES
            (
                ?,
                ?,
                ?
            )
        ";

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param(
            "sss",
            $nama,
            $email,
            $password
        );

        return $stmt->execute();
    }
    /* =========================================
       Login User
    ========================================= */

    public function login($email)
    {
        $sql = "SELECT * FROM users WHERE email = ?";

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param("s", $email);

        $stmt->execute();

        return $stmt->get_result()->fetch_assoc();
    }
}