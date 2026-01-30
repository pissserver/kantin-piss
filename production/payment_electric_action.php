<?php
    require_once 'connection.php';

    try {
        $payment_date = date('Y-m-d');
        $tenant_id = $_POST['tenant_id'];
        $cost_payment = $_POST['cost_payment'];
        $status_payment = 'lunas';

        $query = "INSERT INTO electric_payments (tenant_id, cost_payment, payment_date, status_payment) VALUES ('$tenant_id', '$cost_payment', '$payment_date', '$status_payment')";

        if (mysqli_query($conn, $query)) {
                echo "
                    <script>
                        alert('Pembayaran tenant berhasil disimpan');
                        window.location.href = 'tenant_detail.php?id=$tenant_id';
                    </script>
                ";
            } else {
                echo "
                    <script>
                        alert('Gagal menyimpan pembayaran tenant');
                        window.location.href = 'tenant_detail.php?id=$tenant_id';
                    </script>
                ";
            }
    } catch (\Throwable $th) {
        echo "
            <script>
                alert('Gagal menyimpan pembayaran tenant');
                window.location.href = 'tenant_detail.php?id=$tenant_id';
            </script>
    ";
    }
    