<?php
require_once "../config.php";

if (isset($_POST['submit'])) {
    // Ambil data dari form
    $nama_tugas = trim(htmlspecialchars($_POST['nama_tugas']));
    $tempat_kumpul = trim(htmlspecialchars($_POST['tempat_kumpul']));
    $tenggat = trim(htmlspecialchars($_POST['formatted_tenggat']));
    $status = $_POST["status"];

    // Ambil kode terakhir dari tabel
    $result = mysqli_query($koneksi, "SELECT kode_tugas FROM daftar_tugas ORDER BY kode_tugas DESC LIMIT 1");
    $data = mysqli_fetch_assoc($result);
    $kode_terakhir = $data ? $data['kode_tugas'] : null;

    // Buat kode baru otomatis (misalnya TGS001, TGS002, dst)
    if ($kode_terakhir) {
        $urutan = (int) substr($kode_terakhir, 3);
        $urutan++;
        $kode_tugas = 'TGS' . str_pad($urutan, 3, '0', STR_PAD_LEFT);
    } else {
        $kode_tugas = 'TGS001'; // jika belum ada data
    }

    // Jalankan stored procedure untuk insert
    $query = mysqli_query($koneksi, "CALL InsertTugas('$kode_tugas', '$nama_tugas', '$tempat_kumpul', '$tenggat', '$status')");

    if ($query) {
        header("location: tugas.php");
        exit;
    } else {
        die("Gagal menambah data: " . mysqli_error($koneksi));
    }

} else if (isset($_POST['update'])) {
    // Update data tugas
    $kode_tugas = $_POST['kode_tugas'];
    $nama_tugas = $_POST['nama_tugas'];
    $tempat_kumpul = $_POST['tempat_kumpul'];
    $tenggat = $_POST['tenggat'];
    $status = $_POST['status'];

    mysqli_query($koneksi, "CALL UpdateTugas('$kode_tugas', '$nama_tugas', '$tempat_kumpul', '$tenggat', '$status')");

    header("location:tugas.php");
    exit;
}
?>
