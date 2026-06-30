<?php

/*
=========================================================
REGISTER PAGE
=========================================================
*/

require_once "../app/models/User.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $nama = trim($_POST["nama"]);

    $email = trim($_POST["email"]);

    $password = trim($_POST["password"]);

    $user = new User();

    $checkEmail = $user->findByEmail($email);

    if ($checkEmail->num_rows > 0)
    {
        $message = "
        <div class='alert alert-danger'>
            Email sudah digunakan.
        </div>";
    }
    else
    {
        $hashPassword =
            password_hash(
                $password,
                PASSWORD_DEFAULT
            );

        $save = $user->create(
            $nama,
            $email,
            $hashPassword
        );

        if ($save)
        {
            $message = "
            <div class='alert alert-success'>
                Registrasi berhasil.
            </div>";
        }
    }
}

require "../app/views/layouts/header.php";
require "../app/views/partials/navbar.php";
?>

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card shadow">

                <div class="card-body p-4">

                    <h2 class="mb-4 text-center">

                        Daftar Akun

                    </h2>

                    <?= $message ?>

                    <form method="POST">

                        <div class="mb-3">

                            <label class="form-label">

                                Nama

                            </label>

                            <input
                                type="text"
                                name="nama"
                                class="form-control"
                                required>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">

                                Email

                            </label>

                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                required>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">

                                Password

                            </label>

                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                required>

                        </div>

                        <button
                            type="submit"
                            class="btn btn-primary w-100">

                            Daftar

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