<?php

session_start();

if (!isset($_SESSION['ssLogin'])) {
    header("location:../auth/login.php");
    exit;
}

require_once "../config.php";

$kode_kegiatan = $_GET['kode_kegiatan'];

$query = mysqli_query($koneksi, "CALL HapusJadwal('$kode_kegiatan')");

if ($query) {
    header("location:jadwal.php");
    exit;
}

return;
