<?php
session_start();
require_once "../config.php";

if (isset($_POST["submit"])) {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    // Validasi form kosong
    if ($username === "" || $password === "") {
        header("Location: login.php?error=" . urlencode("Semua kolom wajib diisi."));
        exit;
    }

    // Cek apakah username terdaftar
    $sql = "SELECT * FROM user WHERE username = ?";
    $stmt = mysqli_prepare($koneksi, $sql);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) === 0) {
        // ❌ Username belum terdaftar
        header("Location: login.php?error=" . urlencode("Akun tidak ditemukan."));
        exit;
    }

    // Jika username ada, ambil datanya
    $user = mysqli_fetch_assoc($result);

    // Cek password
    if (!password_verify($password, $user["password"])) {
        // ❌ Password salah
        header("Location: login.php?error=" . urlencode("Password salah."));
        exit;
    }

    // ✅ Login berhasil
    $_SESSION["ssLogin"] = true;
    $_SESSION["user_id"] = $user["id"];
    $_SESSION["username"] = $user["username"];

    header("Location: ../index.php");
    exit;
} else {
    header("Location: login.php?error=" . urlencode("Akses tidak sah."));
    exit;
}
?>
