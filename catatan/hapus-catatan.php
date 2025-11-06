<?php

session_start();

if (!isset($_SESSION['ssLogin'])) {
    header("location:../auth/login.php");
    exit;
}

require_once "../config.php";

$judul_catatan = $_GET['judul_catatan'];

$query = mysqli_query($koneksi, "CALL HapusCatatan('$judul_catatan')");

if ($query) {
    header("location:catatan.php");
    exit;
}

return;
