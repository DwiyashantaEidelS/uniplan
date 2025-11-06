<?php

require_once "../config.php";

if (isset($_POST['submit'])) {
    $judul_catatan = trim(htmlspecialchars($_POST['judul_catatan']));
    $isi_catatan = trim(htmlspecialchars($_POST['isi_catatan']));

    $query = mysqli_query($koneksi, "CALL InsertCatatan ('$judul_catatan', '$isi_catatan')");

    if ($query) {
        header("location: catatan.php");
        exit;
    }
} else if (isset($_POST['update'])) {
    $judul_catatan = $_POST['judul_catatan'];
    $isi_catatan = $_POST['isi_catatan'];

    mysqli_query($koneksi, "CALL UpdateCatatan('$judul_catatan', '$isi_catatan')");

    header("location:catatan.php");
}
