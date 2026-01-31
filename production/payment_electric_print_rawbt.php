<?php
session_start();
require_once 'connection.php';

$payment_id = $_GET['payment_id'];

$q = mysqli_query($conn, "
    SELECT ep.*, t.tenant_name
    FROM electric_payments ep
    JOIN tenants t ON ep.tenant_id = t.id
    WHERE ep.id = '$payment_id'
");

$nama_user  = $_SESSION['username'];
// Ambil data user
$user_q = mysqli_query($conn, "SELECT fullname FROM users WHERE username = '$nama_user'");
$user = mysqli_fetch_assoc($user_q);

$data = mysqli_fetch_assoc($q);
?>


<!DOCTYPE html>
<html>
<head>
    <title>Struk Pembayaran</title>
    <style>
        body {
            width: 58mm;
            font-family: monospace;
            font-size: 12px;
        }
        .center { text-align: center; }
        .line { border-top: 1px dashed #000; margin: 5px 0; }
        table { width: 100%; }
    </style>
</head>
<body onload="window.print()">

<div class="center">
    <strong>KANTIN PISS</strong><br><br><br>
    Bukti Pembayaran <br>
    Air & Listrik<br>
    <div class="line"></div>
</div>

<table>
    <tr>
        <td>Tenant</td>
        <td>: <?php echo $data['tenant_name']; ?></td>
    </tr>
    <tr>
        <td>Tanggal</td>
        <td>: <?php echo date('d M Y', strtotime($data['payment_date'])); ?></td>
    </tr>
    <tr>
        <td>Kasir</td>
        <td>: <?php echo $user['fullname']; ?></td>
    </tr>
</table>

<div class="line"></div>

<table>
    <tr>
        <td>Total</td>
        <td align="right"><?php echo format_rupiah($data['cost_payment']); ?></td>
    </tr>
    <tr>
        <td>Status</td>
        <td align="right"><?php echo strtoupper($data['status_payment']); ?></td>
    </tr>
</table>

<div class="line"></div>

<div class="center">
    Terima Kasih!
</div>

</body>
</html>
