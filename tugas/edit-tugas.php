<?php
session_start();

if (!isset($_SESSION["ssLogin"])) {
    header("location: ../auth/login.php");
    exit;
}

require_once "../config.php";

$title = "Edit Tugas - Uniplan";

require_once "../template/header.php";
require_once "../template/navbar.php";

$kode_tugas = $_GET['kode_tugas'];
$tugas = mysqli_query($koneksi, "SELECT * FROM daftar_tugas WHERE kode_tugas = '$kode_tugas'");
$data = mysqli_fetch_array($tugas);
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
        <p>Edit Tugas</p>
    </div>
    <div class="separator" style="
        width: 100%;
        max-width: 1200px;
        margin: 20px auto;
        border-top: 2px solid #333;">
    </div>

    <form id="editForm" action="proses-tugas.php" method="POST">
        <div class="form-tambah">
            <div class="form-1" style="display: flex; flex-direction: column; align-items: center;">
                <label for="kode_tugas">Kode Tugas</label>
                <input type="text" id="kode_tugas" name="kode_tugas" maxlength="10" value="<?= $data['kode_tugas'] ?>" readonly>
            </div>

            <div class="form-2" style="display: flex; flex-direction: column; align-items: center;">
                <label for="nama_tugas">Nama Tugas</label>
                <input type="text" id="nama_tugas" name="nama_tugas" maxlength="30" value="<?= $data['nama_tugas'] ?>" required>
            </div>

            <div class="form-3" style="display: flex; flex-direction: column; align-items: center;">
                <label for="tempat_kumpul">Tempat Pengumpulan</label>
                <input type="text" id="tempat_kumpul" name="tempat_kumpul" maxlength="30" value="<?= $data['tempat_kumpul'] ?>" required>
            </div>

            <div class="form-4" style="display: flex; flex-direction: column; align-items: center;">
                <label for="tenggat">Tenggat</label>
                <p style="padding: 10px 10px 0 10px; font-size: 12px; font-weight: 600;">format : YYYY/MM/DD HH:MM:SS</p>
                <?php
                $dbTenggat = $data['tenggat'];
                $tenggatValue = '';
                if (!empty($dbTenggat)) {
                    $timestamp = strtotime($dbTenggat);
                    $tenggatValue = date('Y-m-d\TH:i', $timestamp);
                }
                ?>
                <input type="datetime-local" id="tenggat" name="tenggat" value="<?= $tenggatValue ?>" required>
                <input type="hidden" id="formatted_tenggat" name="formatted_tenggat">
            </div>

            <div class="form-5" style="display: flex; flex-direction: column; align-items: center;">
                <label for="status">Status</label>
                <select name="status" id="status">
                    <?php
                    $statusOptions = ["To Do", "Doing", "Done"];
                    foreach ($statusOptions as $stat) {
                        $selected = ($data['status'] == $stat) ? 'selected' : '';
                        echo "<option value='$stat' $selected>$stat</option>";
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="btn-tambah" style="display: flex; flex-direction: column; align-items: center;">
            <button type="submit" name="update">Simpan</button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('editForm');
    const originalData = {
        nama_tugas: document.getElementById('nama_tugas').value,
        tempat_kumpul: document.getElementById('tempat_kumpul').value,
        tenggat: document.getElementById('tenggat').value,
        status: document.getElementById('status').value
    };

    form.addEventListener('submit', function(e) {
        const currentData = {
            nama_tugas: document.getElementById('nama_tugas').value,
            tempat_kumpul: document.getElementById('tempat_kumpul').value,
            tenggat: document.getElementById('tenggat').value,
            status: document.getElementById('status').value
        };

        // Cek apakah ada perubahan dari nilai awal
        const isChanged = Object.keys(originalData).some(key => originalData[key] !== currentData[key]);

        if (isChanged) {
            const confirmEdit = confirm("Apakah Anda yakin ingin merubah tugas ini?");
            if (!confirmEdit) {
                e.preventDefault();
            }
        } else {
            window.location.href = "tugas.php";
        }

        // Format tanggal untuk database
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
});
</script>

<?php require_once "../template/footer.php"; ?>
