<?php
session_start();
require_once 'connection.php';

if (!isset($_POST['username'], $_POST['password'])) {
    header("Location: login.php");
    exit;
}

$username = trim($_POST['username']);
$password = trim($_POST['password']);

if ($username == '' || $password == '') {
    $_SESSION['error'] = "Username dan password wajib diisi";
    header("Location: login.php");
    exit;
}

$stmt = $conn->prepare("
    SELECT id, username, password
    FROM users
    WHERE username = ? AND status = 'active'
    LIMIT 1
");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    $_SESSION['error'] = "Username tidak ditemukan";
    header("Location: login.php");
    exit;
}

$user = $result->fetch_assoc();

if ($password != $user['password']) {
    $_SESSION['error'] = "Password salah";
    header("Location: login.php");
    exit;
}

$_SESSION['user_id']  = $user['id'];
$_SESSION['username'] = $user['username'];
$_SESSION['login'] = true;

header("Location: registration.php");
exit;
