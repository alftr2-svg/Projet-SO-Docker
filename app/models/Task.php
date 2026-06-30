<?php
/*
=========================================================
File    : Task.php
Folder  : app/models/

Fungsi :
Model Task
Seluruh query tabel tasks berada di sini.
=========================================================
*/

require_once __DIR__ . '/../config/database.php';

class Task
{
    private $conn;

    public function __construct()
    {
        $database = new Database();

        $this->conn = $database->connect();
    }

    /* =================================================
       Mengambil semua tugas berdasarkan user
    ================================================= */

    public function getAllByUser($userId)
    {
        $sql = "
            SELECT *
            FROM tasks
            WHERE user_id = ?
            ORDER BY deadline ASC
        ";

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param("i", $userId);

        $stmt->execute();

        return $stmt->get_result();
    }

    /* =================================================
       Menghitung Total Tugas
    ================================================= */

    public function countAll($userId)
    {
        $sql = "
            SELECT COUNT(*) total
            FROM tasks
            WHERE user_id = ?
        ";

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param("i", $userId);

        $stmt->execute();

        return $stmt->get_result()->fetch_assoc();
    }

    /* =================================================
       Menghitung Tugas Aktif
    ================================================= */

    public function countActive($userId)
    {
        $sql = "
            SELECT COUNT(*) total
            FROM tasks
            WHERE
                user_id = ?
            AND
                status = 'Belum'
        ";

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param("i", $userId);

        $stmt->execute();

        return $stmt->get_result()->fetch_assoc();
    }

    /* =================================================
       Menghitung Tugas Selesai
    ================================================= */

    public function countDone($userId)
    {
        $sql = "
            SELECT COUNT(*) total
            FROM tasks
            WHERE
                user_id = ?
            AND
                status='Selesai'
        ";

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param("i", $userId);

        $stmt->execute();

        return $stmt->get_result()->fetch_assoc(); }

            /* =================================================
       Menambahkan Tugas
    ================================================= */

    public function create(
        $userId,
        $judul,
        $mataKuliah,
        $deskripsi,
        $deadline,
        $prioritas
    )
    {

        $sql = "
        INSERT INTO tasks
        (
            user_id,
            judul,
            mata_kuliah,
            deskripsi,
            deadline,
            prioritas
        )
        VALUES
        (
            ?,?,?,?,?,?
        )
        ";

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param(
            "isssss",
            $userId,
            $judul,
            $mataKuliah,
            $deskripsi,
            $deadline,
            $prioritas
        );

        return $stmt->execute();

    }

    /* =================================================
       Mengambil satu tugas
    ================================================= */

    public function find($id)
    {

        $sql = "SELECT * FROM tasks WHERE id=?";

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param("i",$id);

        $stmt->execute();

        return $stmt->get_result()->fetch_assoc();

    }

    /* =================================================
       Update Tugas
    ================================================= */

    public function update(

        $id,

        $judul,

        $mataKuliah,

        $deskripsi,

        $deadline,

        $prioritas,

        $status

    )
    {

        $sql = "

        UPDATE tasks

        SET

        judul=?,

        mata_kuliah=?,

        deskripsi=?,

        deadline=?,

        prioritas=?,

        status=?

        WHERE id=?

        ";

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param(

            "ssssssi",

            $judul,

            $mataKuliah,

            $deskripsi,

            $deadline,

            $prioritas,

            $status,

            $id

        );

        return $stmt->execute();

    }
    /* =================================================
   Mengambil satu tugas milik user
================================================= */

public function findById($id, $userId)
{
    $sql = "
        SELECT *
        FROM tasks
        WHERE id = ?
        AND user_id = ?
    ";

    $stmt = $this->conn->prepare($sql);

    $stmt->bind_param("ii", $id, $userId);

    $stmt->execute();

    return $stmt->get_result()->fetch_assoc();
}

    /* =================================================
       Hapus
    ================================================= */

    public function delete($id)
    {

        $sql="DELETE FROM tasks WHERE id=?";

        $stmt=$this->conn->prepare($sql);

        $stmt->bind_param("i",$id);

        return $stmt->execute();

    }

    /* =================================================
        Mengubah Status Tugas
       ================================================= */

        public function updateStatus($id, $userId, $status)
        {
            $sql = "
                UPDATE tasks
                SET status = ?
                WHERE id = ?
                AND user_id = ?
            ";

            $stmt = $this->conn->prepare($sql);

            $stmt->bind_param(
                "sii",
                $status,
                $id,
                $userId
            );

            return $stmt->execute();
        }

        /* =================================================
            Mencari Tugas
           ================================================= */

            public function search($userId, $keyword)
            {
                $sql = "
                    SELECT *
                    FROM tasks
                    WHERE user_id = ?
                    AND
                    (
                        judul LIKE ?
                        OR
                        mata_kuliah LIKE ?
                    )
                    ORDER BY deadline ASC
                ";

                $stmt = $this->conn->prepare($sql);

                $keyword = "%".$keyword."%";

                $stmt->bind_param(
                    "iss",
                    $userId,
                    $keyword,
                    $keyword
                );

                $stmt->execute();

                return $stmt->get_result();
            }
            /* =================================================
                Filter Data
               ================================================= */

                public function filter($userId, $status, $prioritas)
                {
                    $sql = "
                        SELECT *
                        FROM tasks
                        WHERE user_id = ?
                    ";

                    $params = [$userId];
                    $types = "i";

                    if ($status != "") {
                        $sql .= " AND status = ?";
                        $params[] = $status;
                        $types .= "s";
                    }

                    if ($prioritas != "") {
                        $sql .= " AND prioritas = ?";
                        $params[] = $prioritas;
                        $types .= "s";
                    }

                    $sql .= " ORDER BY deadline ASC";

                    $stmt = $this->conn->prepare($sql);

                    $stmt->bind_param($types, ...$params);

                    $stmt->execute();

                    return $stmt->get_result();
                }

            /* =================================================
                 Search + Filter
             ================================================= */

        public function searchFilter($userId, $search, $status, $prioritas)
        {
            $sql = "
                SELECT *
                FROM tasks
                WHERE user_id = ?
            ";

            $types = "i";
            $params = [$userId];

            /*
            =================================================
            Search
            =================================================
            */

            if ($search != "") {

                $sql .= "
                    AND
                    (
                        judul LIKE ?
                        OR mata_kuliah LIKE ?
                    )
                ";

                $keyword = "%".$search."%";

                $types .= "ss";

                $params[] = $keyword;
                $params[] = $keyword;
            }

            /*
            =================================================
            Status
            =================================================
            */

            if ($status != "") {

                $sql .= " AND status = ?";

                $types .= "s";

                $params[] = $status;

            }

            /*
            =================================================
            Prioritas
            =================================================
            */

            if ($prioritas != "") {

                $sql .= " AND prioritas = ?";

                $types .= "s";

                $params[] = $prioritas;

            }

            $sql .= "
                ORDER BY
                deadline ASC,
                created_at DESC
            ";

            $stmt = $this->conn->prepare($sql);

            $stmt->bind_param($types, ...$params);

            $stmt->execute();

            return $stmt->get_result();
        }

        /* =================================================
   Menghitung Deadline Hari Ini
================================================= */

        public function countTodayDeadline($userId)
        {
            $sql = "
                SELECT COUNT(*) AS total
                FROM tasks
                WHERE user_id = ?
                AND deadline = CURDATE()
                AND status = 'Belum'
            ";

            $stmt = $this->conn->prepare($sql);

            $stmt->bind_param("i", $userId);

            $stmt->execute();

            return $stmt->get_result()->fetch_assoc();
        }

    
    
}