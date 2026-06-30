<?php
/*
=========================================================
File    : login.php

Fungsi :
Login User
=========================================================
*/

session_start();

require_once "../app/models/User.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    $user = new User();

    $data = $user->login($email);

    if ($data) {

        if (password_verify($password, $data["password"])) {

            $_SESSION["user"] = [

                "id" => $data["id"],
                "nama" => $data["nama"],
                "email" => $data["email"]

            ];

            header("Location: dashboard.php");

            exit;

        } else {

            $message = "<div class='alert alert-danger'>
                        Password salah.
                        </div>";

        }

    } else {

        $message = "<div class='alert alert-danger'>
                    Email tidak ditemukan.
                    </div>";

    }

}

require "../app/views/layouts/header.php";
require "../app/views/partials/navbar.php";
?>

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-md-5">

            <div class="card shadow">

                <div class="card-body p-4">

                    <h2 class="text-center mb-4">

                        Login

                    </h2>

                    <?= $message ?>

                    <form method="POST">

                        <div class="mb-3">

                            <label>Email</label>

                            <input
                                type="email"
                                class="form-control"
                                name="email"
                                required>

                        </div>

                        <div class="mb-3">

                            <label>Password</label>

                            <input
                                type="password"
                                class="form-control"
                                name="password"
                                required>

                        </div>

                        <button
                            class="btn btn-primary w-100">

                            Login

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<?php

require "../app/views/layouts/footer-script.php";

?>