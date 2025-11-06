<?php
session_start();

if (!isset($_SESSION["ssLogin"])) {
    header("location: ../auth/login.php");
    exit;
}

require_once "../config.php";

$title = "Tambah - Uniplan";

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

        .form-tambah label {
            font-size: 20px;
            font-weight: 600;
            text-align: center;
            color: #B20F0F;
        }

        .form-tambah input,
        select {
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
            margin: 15px;
            font-weight: 600;
            cursor: pointer;
            border: none;
        }

        input[type="datetime-local"] {
            text-align: center;
        }
    </style>
</head>

<div class="top-wrapper">
    <div class="headline">
        <p>Tambah Tugas</p>
    </div>
    <div class="separator" style="
        width: 100%;
        max-width: 1200px;
        margin: 20px auto;
        border-top: 2px solid #333;">
    </div>

    <form action="proses-tugas.php" method="POST">
        <div class="form-tambah">
            <div class="form-1" style="display: flex; flex-direction: column; align-items: center;">
                <label for="nama_tugas">Nama Tugas</label>
                <input type="text" id="nama_tugas" name="nama_tugas" maxlength="30" placeholder="Ketik di sini.." required>
            </div>

            <div class="form-2" style="display: flex; flex-direction: column; align-items: center;">
                <label for="tempat_kumpul">Tempat Pengumpulan</label>
                <input type="text" id="tempat_kumpul" name="tempat_kumpul" maxlength="30" placeholder="Ketik di sini.." required>
            </div>

            <div class="form-3" style="display: flex; flex-direction: column; align-items: center;">
                <label for="tenggat">Tenggat</label>
                <p style="padding: 10px 10px 0 10px; font-size: 12px; font-weight: 600;">format : YYYY/MM/DD HH:MM:SS</p>
                <input type="datetime-local" id="tenggat" name="tenggat" required>
                <input type="hidden" id="formatted_tenggat" name="formatted_tenggat">
            </div>

            <div class="form-4" style="display: flex; flex-direction: column; align-items: center;">
                <label for="status">Status</label>
                <select name="status" id="status">
                    <option value="To Do" selected>To Do</option>
                    <option value="Doing">Doing</option>
                    <option value="Done">Done</option>
                </select>
            </div>
        </div>

        <div class="btn-tambah" style="display: flex; flex-direction: column; align-items: center;">
            <button type="submit" name="submit">Kirim</button>
        </div>
    </form>
</div>

<script>
    // Ubah hasil datepicker ke format YYYY/MM/DD HH:MM:SS sebelum dikirim ke database
    const form = document.querySelector('form');
    form.addEventListener('submit', function (e) {
        // Tampilkan konfirmasi sebelum melanjutkan
        const konfirmasi = confirm("Apakah Anda yakin ingin menyimpan data tugas ini?");
        if (!konfirmasi) {
            e.preventDefault(); // Batalkan pengiriman form
            return;
        }

        const datetimeInput = document.getElementById('tenggat');
        const formattedField = document.getElementById('formatted_tenggat');
        const date = new Date(datetimeInput.value);

        if (!isNaN(date)) {
            const yyyy = date.getFullYear();
            const mm = String(date.getMonth() + 1).padStart(2, '0');
            const dd = String(date.getDate()).padStart(2, '0');
            const hh = String(date.getHours()).padStart(2, '0');
            const min = String(date.getMinutes()).padStart(2, '0');
            const ss = String(date.getSeconds()).padStart(2, '0');

            formattedField.value = `${yyyy}/${mm}/${dd} ${hh}:${min}:${ss}`;
        }
    });
</script>

<?php require_once "../template/footer.php"; ?>
