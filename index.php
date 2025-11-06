<?php

session_start();

if (!isset($_SESSION["ssLogin"])) {
    header("location:auth/login.php");
    exit;
}

require_once "config.php";

$title = "Home - Uniplan";

require_once "template/header.php";
require_once "template/navbar.php";

?>

<html overflow-y="scroll" scroll-behavior="smooth">

<head>
    <style type="text/css">
        .top-wrapper {
            padding: 200px 0 400px 0;
            background: #F7EFE5;
        }
    </style>
</head>

<div class="top-wrapper">
    <div class="container" style="display: flex; align-items: center; margin-left: 300px;">
        <img src=asset/cover.png.png style="
            max-width: 40%;
            padding-top: 25px;">
        <div class="descript" style="padding:0 10px 10px 10px; margin: 60px 30px; font-weight: 500; font-size: 20px;">
        <p style="
                font-size: 40px;
                font-weight: 1000;
                font-style: italic;
                padding: 10px;
                margin-left: 10px;
                margin-right: 50px;
                color: #B20F0F;
                text-align: center;">Uniplan</p>
        <p>Uniplan merupakan sebuat website yang</p>
            <p>bertujuan untuk membantu mahasiwa dalam</p>
            <p>mengatur kehidupan perkuliahanya melalui</p>
            <p>berbagai fitur yang tersedia di dalamnya</p>
            <br>
            <p>Ingin dunia perkuliahanmu lebih tertata?</p>
            <p>Yuk mulai pakai Uniplan sekarang!</p>
            <br></br>
            <div class="kontak">
                <a style="
    padding: 10px 100px;
            font-size: 20px;
            border-radius: 10px;
            color: black;
            background: #EEE0C9;
            margin: 15px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            border: 1px solid #000000;
            " href="#footer-list">Kontak Kami</a>
            </div>
        </div>
    </div>
</div>

</html>

<?php

require_once "template/footer.php";

?>