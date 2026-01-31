<?php
require_once 'connection.php';
session_start();

$payment_id = $_GET['payment_id'];
$nama_user  = $_SESSION['username'];

// Ambil data user
$user_q = mysqli_query($conn, "SELECT fullname FROM users WHERE username = '$nama_user'");
$user = mysqli_fetch_assoc($user_q);

// Ambil data payment
$q = mysqli_query($conn, "
    SELECT tp.*, t.tenant_name
    FROM tenant_payments tp
    JOIN tenants t ON tp.tenant_id = t.id
    WHERE tp.id = '$payment_id'
");
$data = mysqli_fetch_assoc($q);

// Header raw text supaya RawBT bisa fetch
header("Content-Type: text/plain; charset=UTF-8");
header("Cache-Control: no-cache");

// ESC/POS
echo "\x1B\x40";          // Initialize
echo "\x1B\x61\x01";       // Center
echo "\x1B\x45\x01";       // Bold
echo "KANTIN PISS\n";
echo "\x1B\x45\x00";       // Normal
echo "Bukti Pembayaran Tenant\n";
echo "------------------------------\n";

echo "\x1B\x61\x00";       // Left align
echo "Tenant  : " . $data['tenant_name'] . "\n";
echo "Tanggal : " . date('d M Y', strtotime($data['payment_date'])) . "\n";
echo "Kasir   : " . $user['fullname'] . "\n";

echo "------------------------------\n";
echo "\x1B\x45\x01";       // Bold
echo "TOTAL   : Rp " . number_format($data['cost_payment'], 0, ',', '.') . "\n";
echo "\x1B\x45\x00";       // Normal
echo "Status  : " . strtoupper($data['status_payment']) . "\n";

echo "------------------------------\n";
echo "\x1B\x61\x01";       // Center
echo "Terima Kasih\n\n";
echo "\x1D\x56\x00";       // Cut paper
