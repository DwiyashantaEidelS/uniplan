<?php

session_start();

if (!isset($_SESSION['ssLogin'])) {
    header("location:../auth/login.php");
    exit;
}

require_once "../config.php";

$nama_matkul = $_GET['nama_matkul'];

$query = mysqli_query($koneksi, "CALL HapusNilai('$nama_matkul')");

if ($query) {
    header("location:papan-nilai.php");
    exit;
}

return;
