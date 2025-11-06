<?php
session_start();

if (isset($_SESSION["ssLogin"])) {
    header("location:../index.php");
    exit;
}

require_once "../config.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Log In - Uniplan</title>
    <style>
        *{
            margin:0; padding:0;
            box-sizing:border-box;
            font-family:"Poppins", sans-serif;
        }

        body{
            display:flex;
            align-items:center;
            justify-content:center;
            min-height:100vh;
            background:#EEE0C9;
        }

        .wrapper{
            width:470px;
            background:#F7EFE5;
            border-radius:10px;
            padding:20px;
        }

        h3{
            text-align:center;
            font-size:30px;
            font-weight:1000;
            font-style:italic;
            color:#B20F0F;
            margin-bottom:20px;
        }

        .form-login{
            display:flex;
            flex-direction:column;
            align-items:center;
        }

        .form-group{
            width:300px;
            display:flex;
            flex-direction:column;
            margin-bottom:15px;
            position:relative;
        }

        label{
            font-size:18px;
            font-weight:600;
            color:#B20F0F;
            margin-bottom:5px;
        }

        input{
            font-size:15px;
            padding:10px 44px 10px 10px;
            border-radius:10px;
            border:none;
            background:#E2E2E2;
            font-weight:600;
            text-align:center;
            color:#B20F0F;
        }

        .text-info{
            font-size:12px;
            color:gray;
            margin-bottom:10px;
        }

        .form-group input {
            width: 100%;
            padding-right: 42px;   /* ruang untuk ikon */
            text-align: center;
        }

        .input-with-icon{
            position:relative;
            width:100%;
            display:flex;
            align-items:center;
            justify-content:center;
        }

        .toggle-password{
            position:absolute;
            right:12px;
            top:50%;
            transform:translateY(-50%);
            background:transparent;
            border:none;
            cursor:pointer;
            padding:0;
            display:flex;
            align-items:center;
            justify-content:center;
        }

        .toggle-password svg{
            width:20px;
            height:20px;
            stroke:#B20F0F;
            stroke-width:1.8;
            fill:none;
        }

        .toggle-password:focus{
            outline:2px solid rgba(178,15,15,0.25);
        }

        .error{
            color:red;
            font-size:14px;
            margin-bottom:15px;
            text-align:center;
        }

        .btn-submit{
            width:300px;
            padding:10px;
            font-size:15px;
            font-weight:600;
            color:#F7EFE5;
            background:#B20F0F;
            border:none;
            border-radius:10px;
            cursor:pointer;
            margin: 5px 0 5px 0;
        }

        .btn-submit:hover{
            opacity:.95;
        }

        .register-direct{
            text-align:center;
            font-size:15px;
            font-weight:600;
            color:#B20F0F;
            margin-top:10px;
        }
    </style>
</head>
<body>
    <div class="wrapper">

        <h3>Uniplan Log In</h3>

        <!-- error feedback -->
        <?php if (isset($_GET['error'])): ?>
            <p class="error"><?= htmlspecialchars($_GET['error']); ?></p>
        <?php endif; ?>

        <form action="proses-login.php" method="post" novalidate>
            <div class="form-login">

                <!-- USERNAME -->
                <div class="form-group">
                    <label for="username">Username</label>
                    <input 
                        type="text" 
                        id="username" 
                        name="username" 
                        maxlength="20" 
                        placeholder="Ketik di sini.." 
                        required>
                </div>

                <!-- PASSWORD -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <p class="text-info">
                        Password harus minimal 8 karakter, mengandung huruf besar, huruf kecil, angka & karakter spesial.
                    </p>

                    <div class="input-with-icon">
                        <input 
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Ketik di sini.."
                            required
                            pattern="(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*\W).{8,}"
                            title="Minimal 8 karakter, harus ada huruf besar, huruf kecil, angka & karakter spesial">
                        
                        <button type="button" class="toggle-password" id="togglePassword">
                            <svg id="eyeIcon" viewBox="0 0 24 24">
                                <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                        </button>
                    </div>
                </div>

                <button type="submit" name="submit" class="btn-submit">Log In</button>

                <div class="register-direct">
                    Belum punya akun? 
                    <a href="register.php">Daftar di sini</a>
                </div>
            </div>
        </form>
    </div>


<script>
(function(){
    const pwd = document.getElementById("password");
    const toggle = document.getElementById("togglePassword");
    const eyeIcon = document.getElementById("eyeIcon");
    const form = document.querySelector("form");

    toggle.addEventListener("click", function(){
        const isPwd = pwd.getAttribute("type") === "password";
        pwd.setAttribute("type", isPwd ? "text" : "password");

        // update icon
        if (isPwd){
            eyeIcon.innerHTML = `
                <path d="M17.94 17.94A10.94 10.94 0 0 1 12 19c-7 0-11-7-11-7a16.2 16.2 0 0 1 3.03-4.24M3 3l18 18"/>
                <path d="M9.88 9.88a3 3 0 0 0 4.24 4.24"/>
            `;
        } else{
            eyeIcon.innerHTML = `
                <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12z"/>
                <circle cx="12" cy="12" r="3"></circle>
            `;
        }
    });

    // cek pattern password
    form.addEventListener("submit", function(e){
        if(!pwd.checkValidity()){
            e.preventDefault();
            alert(pwd.title || "Password tidak sesuai ketentuan.");
            pwd.focus();
        }
    });
})();
</script>

</body>
</html>
