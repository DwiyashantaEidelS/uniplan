<?php
session_start();

if (!isset($_SESSION["ssLogin"])) {
    header("location: ../auth/login.php");
    exit;
}

require_once "../config.php";

$title = "Daftar Tugas - Uniplan";

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

        /* -------- NEW CSS -------- */
        .top-action {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto 20px auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 40px; /* jarak besar antara search dan kanan */
        }

        .search-box {
            flex: 1;
        }

        .search-box input {
            width: 100%;
            padding: 10px 16px;
            border-radius: 8px;
            border: 1px solid #aaa;
            font-size: 15px;
        }

        .right-group {
            display: flex;
            align-items: center;
            gap: 10px; /* jarak antara filter dan tombol tambah */
        }

        .filter-box select {
            font-size: 14px;
            color: #B20F0F;
            background: #E2E2E2;
            padding: 10px 24px;
            border-radius: 10px;
            font-weight: 600;
            text-align: center;
            cursor: pointer;
            border: 1px solid gray;
        }

        .btn-add {
            font-size: 14px;
            color: #F7EFE5;
            background: #B20F0F;
            padding: 10px 24px;
            border-radius: 10px;
            font-weight: 600;
            text-align: center;
            cursor: pointer;
            text-decoration: none;
            white-space: nowrap;
        }

        /* Responsif */
        @media (max-width: 768px) {
            .top-action {
                flex-direction: column;
                align-items: stretch;
                gap: 10px;
            }

            .right-group {
                justify-content: flex-end;
            }

            .search-box input {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="top-wrapper">
        <div class="container">

            <div class="headline">
                <p>Daftar Tugas</p>
            </div>

            <div class="separator" style="
                width: 100%;
                max-width: 1200px;
                margin: 20px auto;
                border-top: 2px solid #333;">
            </div>

            <!-- ✅ Search + Filter + Add Button -->
            <div class="top-action">
                <div class="search-box">
                    <input type="text" id="searchInput" placeholder="Cari tugas...">
                </div>

                <div class="right-group">
                    <div class="filter-box">
                        <select id="filterStatus">
                            <option value="">Semua Status</option>
                            <option value="To Do">To Do</option>
                            <option value="Doing">Doing</option>
                            <option value="Done">Done</option>
                        </select>
                    </div>

                    <a class="btn-add" href="add-tugas.php">Tambah Tugas</a>
                </div>
            </div>
        </div>

        <!-- ✅ TABLE -->
        <table class="tabel-tugas">
            <thead>
                <tr>
                    <th>Kode Tugas</th>
                    <th>Nama Tugas</th>
                    <th>Tempat Pengumpulan</th>
                    <th>Tenggat</th>
                    <th>Status</th>
                    <th colspan="2">Operasi</th>
                </tr>
            </thead>

            <tbody id="tabelData">
                <?php
                $daftarTugas = mysqli_query($koneksi, "CALL DisplayTugas()");
                while ($data = mysqli_fetch_array($daftarTugas)) { ?>
                    <tr>
                        <td><?= $data['kode_tugas'] ?></td>
                        <td><?= $data['nama_tugas'] ?></td>
                        <td><?= $data['tempat_kumpul'] ?></td>
                        <td><?= $data['tenggat'] ?></td>
                        <td><?= $data['status'] ?></td>
                        <td>
                            <a href="edit-tugas.php?kode_tugas=<?= $data['kode_tugas'] ?>" style="
                            font-size: 15px;
                            width: auto;
                            height: auto;
                            background: #B20F0F;
                            color: #F7EFE5;
                            font-weight: 600;
                            padding: 10px;
                            border-radius: 10px;
                            text-decoration: none;">Edit</a>
                        </td>
                        <td>
                            <a href="hapus-tugas.php?kode_tugas=<?= $data['kode_tugas'] ?>" style="
                            font-size: 15px;
                            width: auto;
                            height: auto;
                            background: #B20F0F;
                            color: #F7EFE5;
                            font-weight: 600;
                            padding: 10px;
                            border-radius: 10px;
                            text-decoration: none;"
                            onclick="return confirm('Apakah Anda yakin ingin menghapus tugas ini?');">Hapus</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>

<script>
    const searchInput = document.getElementById("searchInput");
    const filterStatus = document.getElementById("filterStatus");
    const tableBody = document.getElementById("tabelData");

    // ✅ Fungsi gabungan search + filter
    function applyFilters() {
        const filter = searchInput.value.toLowerCase();
        const selectedStatus = filterStatus.value.toLowerCase();
        const rows = tableBody.getElementsByTagName("tr");

        for (let i = 0; i < rows.length; i++) {
            const kodeCol = rows[i].getElementsByTagName("td")[0];
            const statusCol = rows[i].getElementsByTagName("td")[4];

            if (kodeCol && statusCol) {
                const kodeText = kodeCol.textContent.toLowerCase();
                const statusText = statusCol.textContent.toLowerCase();

                const matchSearch = kodeText.includes(filter);
                const matchStatus = selectedStatus === "" || statusText.includes(selectedStatus);

                rows[i].style.display = (matchSearch && matchStatus) ? "" : "none";
            }
        }
    }

    searchInput.addEventListener("keyup", applyFilters);
    filterStatus.addEventListener("change", applyFilters);
</script>

<?php
require_once "../template/footer.php";
?>
