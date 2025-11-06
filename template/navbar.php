<head>
    <style type="text/css">
        * {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        header {
            height: 90px;
            width: 100%;
            background-color: #EEE0C9;
            position: absolute;
            top: 0;
            z-index: 10;
        }

        .header-list li {
            float: left;
            list-style: none;
            margin: 30px 45px;
            padding: 5px 10px;
            border-radius: 10px;
            transition: 0.5s;
            color: black;
            font-weight: 600;
        }

        .header-right {
            float: right;
            background-color: #B20F0F;
            padding: 5px 15px;
            border-radius: 10px;
            margin: 30px 90px 30px 0;
            color: #fff;
            font-weight: 600;
        }

        .header-right a {
            color: #dee7ec;

        }

        .header-right:active {
            top: 5px;
            box-shadow: none;
        }
    </style>
</head>

<body>
    <header>
        <div class="container">
            <div class="header-left">
                <p style="
                font-size: 40px;
                font-weight: 1000;
                font-style: italic;
                padding: 10px;
                margin-left: 80px;
                margin-right: 50px;
                float: left;"><a href="<?= $main_url ?>index.php" style="text-decoration: none; color: #B20F0F;">Uniplan</a></p>
            </div>
            <span class="fa fa-bars menu-icon"></span>
            <div class="header-list">
                <ul>
                    <li><a href="<?= $main_url ?>index.php" style="text-decoration: none; color: black;">Home</a></li>
                    <li><a href="<?= $main_url ?>tugas/tugas.php" style="text-decoration: none; color: black;">Daftar Tugas</li>
                    <li><a href="<?= $main_url ?>jadwal/jadwal.php" style="text-decoration: none; color: black;">Jadwal Kegiatan</li>
                    <li><a href="<?= $main_url ?>catatan/catatan.php" style="text-decoration: none; color: black;">Catatan</li>
                    <li><a href="<?= $main_url ?>papan-nilai/papan-nilai.php" style="text-decoration: none; color: black;">Papan Nilai</li>
                </ul>
            </div>
            <div class="header-right">
                <a href="<?= $main_url ?>auth/logout.php" class="logout" style="text-decoration: none;">Log Out</a>
            </div>
        </div>
    </header>