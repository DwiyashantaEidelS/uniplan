<?php
session_start();

if (!isset($_SESSION["ssLogin"])) {
    header("location: ../auth/login.php");
    exit;
}

require_once "../config.php";

$title = "Edit Catatan - Uniplan";

require_once "../template/header.php";
require_once "../template/navbar.php";

$judul_catatan = $_GET['judul_catatan'];
$catatan = mysqli_query($koneksi, "SELECT * FROM catatan WHERE judul_catatan = '$judul_catatan'");
$data = mysqli_fetch_array($catatan);
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

        .form-tambah input {
            font-size: 18px;
            padding: 10px;
            width: 400px;
            height: auto;
            color: #B20F0F;
            font-weight: 600;
            border-radius: 10px;
            background: #E2E2E2;
            margin: 15px;
            text-align: center;
        }

        .form-tambah textarea {
            font-size: 18px;
            padding: 10px;
            width: 800px;
            height: 800px;
            color: #B20F0F;
            font-weight: 600;
            border-radius: 10px;
            background: #E2E2E2;
            margin: 15px;
            text-align: left;
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

        .btn-tambah button:hover {
            background: #9c0c0c;
        }
    </style>
</head>

<div class="top-wrapper">
    <div class="headline">
        <p><?= htmlspecialchars($data['judul_catatan']) ?></p>
    </div>

    <div class="separator" style="
        width: 100%;
        max-width: 1200px;
        margin: 20px auto;
        border-top: 2px solid #333;">
    </div>

    <form action="proses-catatan.php" method="POST" id="formEditCatatan">
        <div class="form-tambah">
            <div class="form-1" style="display: flex; flex-direction: column; align-items: center;">
                <label for="judul_catatan">Judul Catatan</label>
                <input type="text" id="judul_catatan" name="judul_catatan"
                    maxlength="30" value="<?= htmlspecialchars($data['judul_catatan']) ?>" readonly>
            </div>

            <div class="form-2" style="display: flex; flex-direction: column; align-items: center;">
                <label for="isi_catatan">Isi Catatan</label>
                <textarea id="isi_catatan" name="isi_catatan"
                    maxlength="1000"><?= htmlspecialchars($data['isi_catatan']) ?></textarea>
            </div>
        </div>

        <div class="btn-tambah" style="display: flex; flex-direction: column; align-items: center;">
            <button type="submit" name="update">Simpan</button>
        </div>
    </form>
</div>

<script>
    const form = document.getElementById("formEditCatatan");
    const isiAwal = `<?= addslashes($data['isi_catatan']) ?>`;

    form.addEventListener("submit", function (e) {
        const isiBaru = document.getElementById("isi_catatan").value.trim();

        if (isiBaru !== isiAwal.trim()) {
            // Ada perubahan → tampilkan konfirmasi
            const konfirmasi = confirm("Apakah Anda yakin ingin merubah catatan ini?");
            if (!konfirmasi) {
                e.preventDefault();
            }
        } else {
            // Tidak ada perubahan → langsung ke halaman catatan tanpa alert
            e.preventDefault();
            window.location.href = "catatan.php";
        }
    });
</script>

<?php require_once "../template/footer.php"; ?>
