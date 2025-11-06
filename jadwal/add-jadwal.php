<?php
session_start();

if (!isset($_SESSION["ssLogin"]))  {
    header("location:../auth/login.php");
    exit;
}

require_once "../config.php";

$title = "Tambah Jadwal - Uniplan";

require_once "../template/header.php";
require_once "../template/navbar.php";

// Generate kode kegiatan otomatis (misalnya KDG + timestamp)
$kode_kegiatan = "KDG" . time();
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

        .form-tambah label {
            font-size: 20px;
            font-weight: 600;
            text-align: center;
            color: #B20F0F;
        }

        .form-tambah input,
        textarea {
            font-size: 18px;
            padding: 10px;
            width: 400px;
            height: auto;
            color: #B20F0F;
            font-weight: 600;
            align-items: center;
            border-radius: 10px;
            background: #E2E2E2;
            margin: 15px;
            text-align: center;
        }

        .btn-tambah button {
            font-size: 20px;
            color: #F7EFE5;
            background: #B20F0F;
            padding: 10px;
            border-radius: 10px;
            width: 420px;
            height: auto;
            margin: 15px;
            font-weight: 600;
            cursor: pointer;
            border: none;
        }

        input[type="datetime-local"] {
            background: #E2E2E2;
            color: #B20F0F;
            border-radius: 10px;
            font-size: 18px;
            padding: 10px;
            text-align: center;
            width: 400px;
            font-weight: 600;
        }
    </style>
</head>

<div class="top-wrapper">
    <div class="headline">
        <p>Tambah Jadwal</p>
    </div>

    <div class="separator" style="
        width: 100%;
        max-width: 1200px;
        margin: 20px auto;
        border-top: 2px solid #333;">
    </div>

    <form action="proses-jadwal.php" method="POST">
        <!-- Kode kegiatan disembunyikan -->
        <input type="hidden" name="kode_kegiatan" value="<?= $kode_kegiatan; ?>">

        <div class="form-tambah">
            <div class="form-2" style="display: flex; flex-direction: column; align-items: center;">
                <label for="nama_kegiatan">Kegiatan</label>
                <input type="text" id="nama_kegiatan" name="nama_kegiatan" maxlength="30" placeholder="Ketik di sini.." required>
            </div>

            <div class="form-3" style="display: flex; flex-direction: column; align-items: center;">
                <label for="deskripsi_kegiatan">Deskripsi kegiatan</label>
                <textarea id="deskripsi_kegiatan" name="deskripsi_kegiatan" maxlength="100" placeholder="Ketik di sini.." required></textarea>
            </div>

            <div class="form-4" style="display: flex; flex-direction: column; align-items: center;">
                <label for="lokasi_kegiatan">Lokasi</label>
                <input type="text" id="lokasi_kegiatan" name="lokasi_kegiatan" maxlength="50" placeholder="Ketik di sini.." required>
            </div>

            <div class="form-5" style="display: flex; flex-direction: column; align-items: center;">
                <label for="waktu_kegiatan">Tanggal & Waktu</label>
                <input type="datetime-local" id="waktu_kegiatan" name="waktu_kegiatan" required>
            </div>
        </div>

        <div class="btn-tambah" style="display: flex; flex-direction: column; align-items: center;">
            <button type="submit" name="submit">Kirim</button>
        </div>
    </form>
</div>

<script>
    // Saat form dikirim, tampilkan konfirmasi dulu
    document.querySelector("form").addEventListener("submit", function (e) {
        const confirmSave = confirm("Apakah kamu yakin ingin menyimpan jadwal ini?");
        if (!confirmSave) {
            e.preventDefault(); // Batalkan submit kalau user tekan 'Batal'
            return;
        }

        // Jika user menekan OK, ubah format datetime-local ke format database
        const input = document.querySelector("#waktu_kegiatan");
        const date = new Date(input.value);
        if (!isNaN(date)) {
            // Format ke YYYY-MM-DD HH:MM:SS
            const formatted =
                date.getFullYear() + "-" +
                String(date.getMonth() + 1).padStart(2, "0") + "-" +
                String(date.getDate()).padStart(2, "0") + " " +
                String(date.getHours()).padStart(2, "0") + ":" +
                String(date.getMinutes()).padStart(2, "0") + ":" +
                String(date.getSeconds()).padStart(2, "0");
            input.value = formatted;
        }
    });
</script>


<?php
require_once "../template/footer.php";
?>
