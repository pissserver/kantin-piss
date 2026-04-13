<?php
session_start();
require_once 'connection.php';

$payment_id = $_GET['payment_id'];
$fullname  = $_GET['user'];

$q = mysqli_query($conn, "
    SELECT ep.*, t.tenant_name
    FROM electric_payments ep
    JOIN tenants t ON ep.tenant_id = t.id
    WHERE ep.id = '$payment_id'
");

$data = mysqli_fetch_assoc($q);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Struk Pembayaran Air & Listrik</title>
    <link rel="icon" type="image/png" href="images/icon.png" />

    <style>
        body {
            font-family: sans-serif;
            font-size: 16px;
            margin: 20px 0;

            display: flex;
            justify-content: center;
            align-items: center;
            background: #f5f5f5;
        }

        .receipt {
            width: 300px;
            background: #fff;
            padding: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .center {
            text-align: center;
        }

        .line {
            border-top: 1px dashed #000;
            margin: 8px 0;
        }

        table {
            width: 100%;
            font-size: 12px;
        }

        @media print {
            body {
                display: block;
                background: none;
                margin: 0;
                padding: 0;
            }

            .receipt {
                width: 58mm;
                max-width: 58mm;
                padding: 5px;
                box-shadow: none;

                font-size: 18px;
                /* 🔥 BESARKAN GLOBAL */
            }

            .center {
                font-size: 20px;
                /* Judul lebih besar */
                font-weight: bold;
            }

            table {
                font-size: 16px;
                /* 🔥 BESARKAN ISI */
            }

            td {
                padding: 2px 0;
            }

            .line {
                margin: 10px 0;
            }
        }

        @page {
            size: 58mm auto;
            margin: 0;
        }
    </style>
</head>

<body>

    <div class="receipt">

        <div class="center">
            <strong>KANTIN PISS</strong><br><br>
            Bukti Pembayaran <br>
            Air & Listrik
        </div>

        <div class="line"></div>

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
                <td>: <?php echo $fullname; ?></td>
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

    </div>

    <script>
        window.onload = function() {
            setTimeout(() => {
                window.print();
            }, 300);
        };
    </script>

</body>

</html>