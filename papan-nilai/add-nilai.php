<?php
session_start();

if (!isset($_SESSION["ssLogin"])) {
    header("location: ../auth/login.php");
    exit;
}

require_once "../config.php";

$title = "Tambah Daftar Nilai - Uniplan";

require_once "../template/header.php";
require_once "../template/navbar.php";
?>

<head>
    <style type="text/css">
        .top-wrapper {
            padding: 100px 0 400px 0;
            background: #F7EFE5;
        }

        .headline {
            font-size: 30px;
            font-weight: 800;
            text-align: center;
            padding: 10px;
            margin: 20px 0;
        }

        .form-tambah {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .form-tambah label {
            font-size: 20px;
            font-weight: 600;
            color: #B20F0F;
            margin-top: 15px;
        }

        .form-tambah input,
        .form-tambah select {
            font-size: 18px;
            padding: 10px;
            width: 400px;
            color: #B20F0F;
            font-weight: 600;
            border-radius: 10px;
            background: #E2E2E2;
            margin: 10px 0;
            text-align: center;
            border: none;
        }

        .btn-tambah button {
            font-size: 20px;
            color: #F7EFE5;
            background: #B20F0F;
            padding: 10px;
            border-radius: 10px;
            width: 420px;
            margin-top: 25px;
            font-weight: 600;
            cursor: pointer;
            border: none;
        }

        .btn-tambah button:hover {
            background: #9c0d0d;
        }

        .hint {
            font-size: 12px;
            font-weight: 600;
            padding: 5px 10px 0 10px;
            color: #333;
        }

        .separator {
            width: 100%;
            max-width: 1200px;
            margin: 20px auto;
            border-top: 2px solid #333;
        }
    </style>
</head>

<div class="top-wrapper">
    <div class="headline">
        <p>Tambah Daftar Nilai</p>
    </div>
    <div class="separator"></div>
    <form action="proses-nilai.php" method="POST">
        <div class="form-tambah">
            <label for="periode_semester">Periode Semester</label>
            <p class="hint">contoh : Ganjil 2022/2023</p>
            <input type="text" id="periode_semester" name="periode_semester" maxlength="20" placeholder="Ketik di sini.." required>

            <label for="nama_matkul">Nama Matkul</label>
            <input type="text" id="nama_matkul" name="nama_matkul" maxlength="50" placeholder="Ketik di sini.." required>

            <label for="nilai_matkul">Nilai</label>
            <p class="hint">pilih salah satu</p>
            <select id="nilai_matkul" name="nilai_matkul" required>
                <option value="" disabled selected>Pilih Nilai</option>
                <option value="E">E</option>
                <option value="D">D</option>
                <option value="D+">D+</option>
                <option value="C">C</option>
                <option value="C+">C+</option>
                <option value="B">B</option>
                <option value="B+">B+</option>
                <option value="A">A</option>
            </select>

            <label for="ip_semester">IP Semester</label>
            <p class="hint">contoh : 3,98</p>
            <input type="text" id="ip_semester" name="ip_semester" placeholder="Ketik di sini.." required>

            <div class="btn-tambah">
                <button type="submit" name="submit">Kirim</button>
            </div>
        </div>
    </form>
</div>

<script>
    // Saat form dikirim, tampilkan konfirmasi
    document.querySelector("form").addEventListener("submit", function(event) {
        const konfirmasi = confirm("Apakah kamu yakin ingin menambahkan data ini?");
        if (!konfirmasi) {
            event.preventDefault(); // hentikan submit kalau user tekan 'Cancel'
        }
    });
</script>

<?php
require_once "../template/footer.php";
?>
