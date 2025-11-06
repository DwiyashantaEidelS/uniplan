<?php

session_start();

if (!isset($_SESSION['ssLogin'])) {
    header("location:../auth/login.php");
    exit;
}

require_once "../config.php";

$kode_tugas = $_GET['kode_tugas'];

$query = mysqli_query($koneksi, "CALL HapusTugas('$kode_tugas')");

if ($query) {
    header("location:tugas.php");
    exit;
}

return;
