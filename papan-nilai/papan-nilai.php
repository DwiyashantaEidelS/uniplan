<?php

session_start();

if (!isset($_SESSION["ssLogin"])) {
    header("location: ../auth/login.php");
    exit;
}

require_once "../config.php";

$title = "Papan Nilai - Uniplan";

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

        .tabel-tugas {
            font-family: 'Poppins', sans-serif;
            color: #444;
            border-collapse: collapse;
            width: 100%;
            border: 1px solid #f2f5f7;
            margin-top: 15px;
        }

        .tabel-tugas tr,
        th {
            background: #B20F0F;
            color: #F7EFE5;
            font-weight: 600;
            text-align: center;
            padding: 20px 20px;
        }

        .tabel-tugas td {
            background: #E4E1DD;
            color: black;
            font-weight: 600;
            text-align: center;
            padding: 20px 20px;
        }

        /* ===========================
           ✅ Search + Add Button
        ============================ */
        .top-action {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 20px auto;
            gap: 15px;
        }

        .search-box {
            flex: 1;
            max-width: 1000px;
        }

        .search-box input {
            width: 100%;
            padding: 10px 16px;
            border-radius: 8px;
            border: 1px solid #aaa;
            font-size: 15px;
        }

        .btn-add {
            font-size: 14px;
            color: #F7EFE5;
            background: #B20F0F;
            padding: 10px 30px;
            border-radius: 10px;
            font-weight: 600;
            text-align: center;
            cursor: pointer;
            text-decoration: none;
            white-space: nowrap;
        }
    </style>
</head>

<body>
    <div class="top-wrapper">
        <div class="container">

            <div class="headline">
                <p>Papan Nilai</p>
            </div>

            <div class="separator" style="
                width: 100%;
                max-width: 1200px;
                margin: 20px auto;
                border-top: 2px solid #333;">
            </div>

            <!-- ✅ Search + Add Button -->
            <div class="top-action">
                <div class="search-box">
                    <input type="text" id="searchInput" placeholder="Cari nilai...">
                </div>

                <a class="btn-add" href="add-nilai.php">Tambah Nilai</a>
            </div>

        </div>

        <!-- ✅ TABLE -->
        <table class="tabel-tugas">
            <thead>
                <tr>
                    <th>Periode Semester</th>
                    <th>Mata Kuliah</th>
                    <th>Nilai</th>
                    <th>IP Semester</th>
                    <th>Operasi</th>
                </tr>
            </thead>

            <tbody id="tabelData">
                <?php
                $papanNilai = mysqli_query($koneksi, "CALL DisplayNilai()");
                while ($data = mysqli_fetch_array($papanNilai)) { ?>
                    <tr>
                        <td><?= $data['periode_semester'] ?></td>
                        <td><?= $data['nama_matkul'] ?></td>
                        <td><?= $data['nilai_matkul'] ?></td>
                        <td><?= $data['ip_semester'] ?></td>
                        <td>
                            <a href="hapus-nilai.php?nama_matkul=<?= $data['nama_matkul'] ?>" style="
                            font-size: 15px;
                            width: auto;
                            height: auto;
                            background: #B20F0F;
                            color: #F7EFE5;
                            font-weight: 600;
                            padding: 10px;
                            border-radius: 10px;
                            text-decoration: none;"
                             onclick="return confirm('Apakah kamu yakin ingin menghapus jadwal ini?');">Hapus</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

    </div>

</body>

<script>
    const searchInput = document.getElementById("searchInput");
    const tableBody = document.getElementById("tabelData");

    searchInput.addEventListener("keyup", function () {
        const filter = searchInput.value.toLowerCase();
        const rows = tableBody.getElementsByTagName("tr");

        for (let i = 0; i < rows.length; i++) {
            // Ambil text judul (kolom pertama)
            const firstCol = rows[i].getElementsByTagName("td")[0];

            if (firstCol) {
                const textValue = firstCol.textContent || firstCol.innerText;
                if (textValue.toLowerCase().indexOf(filter) > -1) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none";
                }
            }
        }
    });
</script>

<?php
require_once "../template/footer.php";
?>
