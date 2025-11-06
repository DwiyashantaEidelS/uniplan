<?php

require_once "../config.php";

if (isset($_POST['submit'])) {
    $periode_semester = trim(htmlspecialchars($_POST['periode_semester']));
    $nama_matkul = trim(htmlspecialchars($_POST['nama_matkul']));
    $nilai_matkul = trim(htmlspecialchars($_POST['nilai_matkul']));
    $ip_semester = trim(htmlspecialchars($_POST['ip_semester']));

    $query = mysqli_query($koneksi, "CALL InsertNilai ('$periode_semester', '$nama_matkul', '$nilai_matkul', '$ip_semester')");

    if ($query) {
        header("location: papan-nilai.php");
        exit;
    }
}
