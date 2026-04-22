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

<link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<!-- FONT BARU -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>
body {
    margin:0;
    height:100vh;
    font-family:'Poppins', sans-serif;
    display:flex;
    justify-content:center;
    align-items:center;
    background:#000;
    overflow:hidden;
    color:#fff;
}

/* ===== NEBULA ===== */
.nebula {
    position:absolute;
    width:200%;
    height:200%;
    background:
        radial-gradient(circle at 20% 30%, rgba(138,43,226,0.4), transparent 40%),
        radial-gradient(circle at 80% 70%, rgba(0,191,255,0.3), transparent 40%),
        radial-gradient(circle at 50% 50%, rgba(255,0,150,0.2), transparent 40%);
    animation: nebulaMove 80s linear infinite;
}
@keyframes nebulaMove {
    0%{transform:translate(0,0);}
    50%{transform:translate(-200px,-150px);}
    100%{transform:translate(0,0);}
}

/* ===== STARS TWINKLE ===== */
.stars span {
    position:absolute;
    width:2px;
    height:2px;
    background:#fff;
    border-radius:50%;
    animation: twinkle 2s infinite alternate;
}
@keyframes twinkle {
    from { opacity:0.2; transform:scale(1);}
    to { opacity:1; transform:scale(1.5);}
}

/* ===== SHOOTING STAR ===== */
.shoot {
    position:absolute;
    width:2px;
    height:80px;
    background:linear-gradient(-45deg,#fff,transparent);
    transform:rotate(45deg);
    animation:shoot 5s linear infinite;
}
@keyframes shoot {
    0%{opacity:0; transform:translate(0,0) rotate(45deg);}
    10%{opacity:1;}
    100%{transform:translate(-800px,800px) rotate(45deg); opacity:0;}
}

/* ===== PLANET + RING ===== */
.planet {
    position:absolute;
    width:130px;
    height:130px;
    border-radius:50%;
    background:radial-gradient(circle at 30% 30%, #6a5af9, #1a1a2e);
    top:15%;
    left:10%;
    box-shadow:0 0 60px rgba(106,90,249,0.7);
    animation:float 8s ease-in-out infinite;
}
.ring {
    position:absolute;
    width:180px;
    height:40px;
    border-radius:50%;
    border:3px solid rgba(255,255,255,0.3);
    top:50%;
    left:50%;
    transform:translate(-50%,-50%) rotate(25deg);
}

@keyframes float {
    0%,100%{transform:translateY(0);}
    50%{transform:translateY(-20px);}
}

/* ===== LOGIN CARD ===== */
.login-card {
    width:360px;
    padding:40px 30px;
    border-radius:20px;
    background:rgba(20,20,30,0.7);
    backdrop-filter:blur(20px);
    box-shadow:0 20px 60px rgba(0,0,0,0.8);
    animation:fadeIn 1s ease;
    position:relative;
    z-index:10;
}
@keyframes fadeIn {
    from {opacity:0; transform:scale(0.8);}
    to {opacity:1; transform:scale(1);}
}

.login-title {
    text-align:center;
    margin-bottom:25px;
}
.login-title h4 {
    font-weight:600;
}

/* INPUT */
.input-group {
    position:relative;
    margin-bottom:18px;
    width: 100%;
}
.form-control {
    height:45px;
    border:none;
    background:rgba(255,255,255,0.08);
    color:#fff;
    padding-left:40px;
    padding-right:40px;
}
.form-control:focus {
    box-shadow:0 0 0 2px #6a5af9;
}

.icon-left {
    position:absolute;
    left:12px;
    top:50%;
    transform:translateY(-50%);
    color:#aaa;
}
.icon-right {
    position:absolute;
    right:12px;
    top:50%;
    transform:translateY(-50%);
    cursor:pointer;
    z-index:20; /* PENTING */
    pointer-events:auto; /* pastikan bisa diklik */
}

/* BUTTON */
.btn-login {
    width:100%;
    height:45px;
    border-radius:25px;
    border:none;
    font-weight:600;
    background:linear-gradient(135deg,#6a5af9,#00c6ff);
    transition:.3s;
}
.btn-login:hover {
    transform:translateY(-2px);
}

/* FOOTER */
.footer {
    text-align:center;
    margin-top:15px;
    font-size:12px;
    color:#aaa;
}

.remember {
    font-size:13px;
    margin-bottom:15px;
}

/* PARALLAX */
.parallax {
    position:absolute;
    width:100%;
    height:100%;
    pointer-events:none;
}

/* ===== MOUSE TRAIL ===== */
.trail {
    position:fixed;
    width:15px;
    height:15px;
    border-radius:50%;
    pointer-events:none;
    background:radial-gradient(circle, #00c6ff, transparent);
    box-shadow:0 0 15px #00c6ff, 0 0 30px #6a5af9;
    animation: fadeTrail 0.6s linear forwards;
    z-index:9999;
}
@keyframes fadeTrail {
    to {
        transform:scale(2);
        opacity:0;
    }
}

/* ===== PLANET 2 + ORBIT ===== */
.planet2 {
    position:absolute;
    width:70px;
    height:70px;
    border-radius:50%;
    background:radial-gradient(circle at 30% 30%, #00c6ff, #001f3f);
    top:60%;
    right:10%;
    box-shadow:0 0 40px rgba(0,198,255,0.6);
}

.orbit {
    position:absolute;
    width:200px;
    height:200px;
    border:1px dashed rgba(255,255,255,0.2);
    border-radius:50%;
    top:60%;
    right:10%;
    transform:translate(50%,-50%);
    animation: rotateOrbit 20s linear infinite;
}

.orbit .planet-small {
    position:absolute;
    width:20px;
    height:20px;
    border-radius:50%;
    background:#fff;
    top:-10px;
    left:50%;
    transform:translateX(-50%);
    box-shadow:0 0 10px #fff;
}

@keyframes rotateOrbit {
    from {transform:translate(50%,-50%) rotate(0deg);}
    to {transform:translate(50%,-50%) rotate(360deg);}
}
</style>
</head>

<body>

<div class="nebula parallax" data-speed="2"></div>

<!-- STARS -->
<div class="stars parallax" data-speed="5">
<?php for($i=0;$i<80;$i++): ?>
<span style="top:<?=rand(0,100)?>%; left:<?=rand(0,100)?>%; animation-delay:<?=rand(0,5)?>s;"></span>
<?php endfor; ?>
</div>

<!-- SHOOTING -->
<div class="shoot parallax" data-speed="8" style="top:10%; left:80%;"></div>
<div class="shoot parallax" data-speed="6" style="top:40%; left:70%; animation-delay:2s;"></div>

<!-- PLANET -->
<div class="planet parallax" data-speed="3">
    <div class="ring"></div>
</div>

<!-- PLANET 2 + ORBIT -->
<div class="planet2 parallax" data-speed="6"></div>
<div class="orbit parallax" data-speed="4">
    <div class="planet-small"></div>
</div>

<!-- LOGIN -->
<div class="login-card">

<?php
if (isset($_SESSION['error'])) {
    echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
    unset($_SESSION['error']);
}
?>

<form action="checklogin.php" method="POST">

<div class="login-title">
    <h4><i class="fa fa-rocket"></i> Kantin PISS 🚀</h4>
</div>

<div class="input-group">
    <i class="fa fa-user-astronaut icon-left"></i>
    <input type="text" name="username" class="form-control"
        placeholder="Username"
        value="<?= htmlspecialchars($username_cookie) ?>" required>
</div>

<div class="input-group">
    <i class="fa fa-key icon-left"></i>
    <input type="password" id="password" name="password"
        class="form-control"
        placeholder="Password"
        value="<?= htmlspecialchars($password_cookie) ?>" required>
    <i class="fa fa-eye icon-right" id="togglePass"></i>
</div>

<div class="remember">
    <input type="checkbox" name="remember"
        <?= $username_cookie ? 'checked' : '' ?>> Ingat Saya
</div>

<button type="submit" class="btn btn-login">🚀 Login</button>

<div class="footer">©2026 Kantin PISS</div>

</form>
</div>

<script>
// toggle password
document.getElementById("togglePass").onclick = function() {
    const p = document.getElementById("password");
    p.type = p.type === "password" ? "text" : "password";
};

// ===== PARALLAX LEBIH DALAM =====
document.addEventListener("mousemove", e => {
    document.querySelectorAll(".parallax").forEach(el => {
        const speed = el.getAttribute("data-speed");
        const x = (window.innerWidth/2 - e.pageX) * speed / 40;
        const y = (window.innerHeight/2 - e.pageY) * speed / 40;
        el.style.transform = `translate(${x}px, ${y}px)`;
    });
});

// ===== MOUSE TRAIL =====
document.addEventListener("mousemove", e => {
    const trail = document.createElement("div");
    trail.className = "trail";
    trail.style.left = e.pageX + "px";
    trail.style.top = e.pageY + "px";
    document.body.appendChild(trail);

    setTimeout(() => {
        trail.remove();
    }, 600);
});
</script>

</body>
</html>