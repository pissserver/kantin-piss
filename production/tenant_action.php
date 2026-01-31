<?php
session_start();
require_once 'connection.php';

$tenant_id = isset($_GET['tenant_id']) ? (int)$_GET['tenant_id'] : 0;
$action    = $_GET['action'];

if ($tenant_id <= 0) {
    $_SESSION['error'] = "Tenant ID tidak valid";
    header("Location: tenant.php");
    exit;
}

if (!in_array($action, ['activate', 'deactivate'])) {
    $_SESSION['error'] = "Aksi tidak valid";
    header("Location: tenant.php");
    exit;
}

$status = $action === 'activate' ? 'active' : 'inactive';

$stmt = $conn->prepare("UPDATE tenants SET status = ? WHERE id = ?");
$stmt->bind_param("si", $status, $tenant_id);

if ($stmt->execute()) {
    $_SESSION['success'] = "Tenant telah berhasil " . ($action === 'activate' ? 'diaktifkan' : 'dinonaktifkan');
} else {
    $_SESSION['error'] = "Gagal mengubah status tenant";
}

$stmt->close();
$conn->close();

header("Location: tenant.php");
exit;
