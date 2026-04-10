<?php
session_start();

// ambil cookie
$username_cookie = isset($_COOKIE['username']) ? $_COOKIE['username'] : '';
$password_cookie = isset($_COOKIE['password']) ? $_COOKIE['password'] : '';
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login || Kantin PISS</title>
    <link rel="icon" type="image/png" href="images/icon.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome (WAJIB biar icon muncul) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        /* ===== BACKGROUND ===== */
        body {
            margin: 0;
            height: 100vh;
            font-family: 'Segoe UI', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(270deg, #141e30, #243b55, #1a1a2e);
            background-size: 600% 600%;
            animation: gradientMove 12s ease infinite;
            color: #fff;
        }

        @keyframes gradientMove {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        /* ===== CARD ===== */
        .login-card {
            width: 360px;
            padding: 40px 30px;
            border-radius: 20px;
            background: rgba(20, 20, 30, 0.85);
            backdrop-filter: blur(15px);
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.7);
            animation: fadeUp 0.8s ease;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ===== TITLE ===== */
        .login-title {
            text-align: center;
            margin-bottom: 30px;
        }

        /* ===== INPUT ===== */
        .input-group {
            position: relative;
            width: 100%;
            margin-bottom: 18px;
        }

        .icon-left {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #aaa;
        }

        .icon-right {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #aaa;
            cursor: pointer;
            z-index: 2;
        }

        .form-control {
            width: 100%;
            height: 42px;
            border: none;
            background: rgba(255, 255, 255, 0.05);
            color: #fff;

            padding-left: 38px;
            padding-right: 38px;
            box-sizing: border-box;
            transition: 0.3s;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.08);
            box-shadow: 0 0 0 1px #6a5af9;
            color: #fff;
        }

        /* ===== BUTTON ===== */
        .btn-login {
            width: 100%;
            height: 42px;
            border-radius: 12px;
            border: none;
            font-weight: 600;
            background: linear-gradient(135deg, #6a5af9, #8360c3);
            transition: 0.3s;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(106, 90, 249, 0.4);
        }

        /* ===== REMEMBER ===== */
        .remember {
            display: flex;
            align-items: center;
            font-size: 13px;
            color: #ccc;
            margin-bottom: 15px;
        }

        /* ===== FOOTER ===== */
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #777;
        }

        .alert {
            font-size: 13px;
        }
    </style>
</head>

<body>

    <div class="login-card">

        <?php
        if (isset($_SESSION['error'])) {
            echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
            unset($_SESSION['error']);
        }
        ?>

        <form action="checklogin.php" method="POST">

            <div class="login-title">
                <h4><i class="fa fa-utensils"></i>&nbsp; KANTIN PISS</h4>
            </div>

            <!-- USERNAME -->
            <div class="input-group">
                <i class="fa fa-user icon-left"></i>
                <input type="text" name="username" class="form-control"
                    placeholder="Username"
                    value="<?= htmlspecialchars($username_cookie) ?>" required>
            </div>

            <!-- PASSWORD -->
            <div class="input-group">
                <i class="fa fa-lock icon-left"></i>

                <input type="password" id="password" name="password"
                    class="form-control"
                    placeholder="Password"
                    value="<?= htmlspecialchars($password_cookie) ?>" required>

                <i class="fa fa-eye icon-right" id="togglePass"></i>
            </div>

            <!-- REMEMBER -->
            <div class="remember">
                <input type="checkbox" name="remember"
                    <?= $username_cookie ? 'checked' : '' ?>>
                &nbsp;&nbsp;<span class="ml-2">Ingat Saya</span>
            </div>

            <!-- BUTTON -->
            <button type="submit" class="btn btn-login">
                Login
            </button>

            <div class="footer">
                ©2026 Kantin PISS
            </div>

        </form>
    </div>

    <script>
        // show / hide password
        document.getElementById("togglePass").addEventListener("click", function() {
            const pass = document.getElementById("password");

            if (pass.type === "password") {
                pass.type = "text";
                this.classList.replace("fa-eye", "fa-eye-slash");
            } else {
                pass.type = "password";
                this.classList.replace("fa-eye-slash", "fa-eye");
            }
        });
    </script>

</body>

</html>