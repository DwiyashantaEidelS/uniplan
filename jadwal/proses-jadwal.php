<?php

require_once "../config.php";

if (isset($_POST['submit'])) {
    require_once "../config.php";

    $nama_kegiatan = $_POST['nama_kegiatan'];
    $deskripsi_kegiatan = $_POST['deskripsi_kegiatan'];
    $lokasi_kegiatan = $_POST['lokasi_kegiatan'];
    $waktu_kegiatan = $_POST['waktu_kegiatan'];

    // 🔹 Buat kode otomatis (KDG + random 6 digit)
    $kode_kegiatan = 'KDG' . rand(100000, 999999);

    // Cek apakah kode sudah ada
    $cek = mysqli_query($koneksi, "SELECT * FROM jadwal_kegiatan WHERE kode_kegiatan = '$kode_kegiatan'");
    while (mysqli_num_rows($cek) > 0) {
        $kode_kegiatan = 'KDG' . rand(100000, 999999);
        $cek = mysqli_query($koneksi, "SELECT * FROM jadwal_kegiatan WHERE kode_kegiatan = '$kode_kegiatan'");
    }

    // Masukkan data
    $insert = mysqli_query($koneksi, "CALL InsertJadwal('$kode_kegiatan', '$nama_kegiatan', '$deskripsi_kegiatan', '$lokasi_kegiatan', '$waktu_kegiatan')");

    if ($insert) {
        header("location: jadwal.php");
        exit;
    } else {
        echo "<script>
                alert('Gagal menambahkan data.');
                document.location.href = 'add-jadwal.php';
              </script>";
    }
}

