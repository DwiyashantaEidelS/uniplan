<?php
require_once __DIR__ . '/../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    // ===== VALIDASI PASSWORD =====
    $upper   = preg_match('@[A-Z]@', $password);
    $lower   = preg_match('@[a-z]@', $password);
    $number  = preg_match('@[0-9]@', $password);
    $special = preg_match('@[^\w]@', $password);

    if(!$upper || !$lower || !$number || !$special || strlen($password) < 8){
        echo "<script>
                alert('Password harus minimal 8 karakter & mengandung huruf besar, huruf kecil, angka, dan karakter spesial.');
                window.history.back();
              </script>";
        exit;
    }

    // ===== CEK USERNAME =====
    $sql = "SELECT 1 FROM user WHERE username = ?";
    $stmt = mysqli_prepare($koneksi, $sql);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if(mysqli_stmt_num_rows($stmt) > 0){
        echo "<script>
                alert('Username sudah terdaftar.');
                window.history.back();
              </script>";
        exit;
    }

    // ===== HASH PASSWORD =====
    $hash = password_hash($password, PASSWORD_DEFAULT);

    // ===== INSERT DATA =====
    $sql = "INSERT INTO user (username, password) VALUES (?, ?)";
    $stmt = mysqli_prepare($koneksi, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $username, $hash);

    if(mysqli_stmt_execute($stmt)){
        echo "<script>
                alert('Registrasi berhasil!');
                window.location.href = 'login.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal registrasi.');
                window.history.back();
              </script>";
    }

    exit;
}
?>
