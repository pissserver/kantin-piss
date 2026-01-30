<?php
require_once '../html2pdf/html2pdf.class.php';
require_once '../connection.php';

$first_date = $_POST['first_date'];
$last_date  = $_POST['last_date'];
$tenant_id = $_POST['tenant_id'];

$query = mysqli_query($conn, "
    SELECT 
        t.tenant_name,
        p.presence_date,
        p.status_presence
    FROM presences p
    JOIN tenants t ON t.id = p.tenant_id
    WHERE p.presence_date BETWEEN '$first_date' AND '$last_date' AND p.tenant_id = '$tenant_id'
    ORDER BY p.presence_date ASC
");

$tenant = mysqli_fetch_assoc(
    mysqli_query($conn, "
        SELECT tenant_name 
        FROM tenants 
        WHERE id = '$tenant_id'
        LIMIT 1
    ")
);

if (!$query) {
    die(mysqli_error($conn));
}

ob_start();
?>


<style>
    body {
        font-family: Arial;
        font-size: 11px;
    }

    .header {
        text-align: center;
        margin-bottom: 10px;
    }

    .print-date {
        text-align: right;
        font-size: 10px;
        margin-bottom: 5px;
    }

    h3 {
        margin: 0;
        margin-top: 30px;
    }

    h4 {
        margin: 3px 0 10px 0;
        font-weight: normal;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 8px;
        table-layout: fixed;
        margin-left: 0;
        margin-right: 0;
    }

    th, td {
        border: 1px solid #000;
        padding: 5px;
    }

    th {
        background-color: #f0f0f0;
        text-align: center;
    }

    .center {
        text-align: center;
    }

    .signature {
        width: 100%;
        margin-top: 40px;
    }

    .signature td {
        border: none;
        text-align: center;
        width: 50%;
    }

    .footer {
        text-align: center;
        font-size: 10px;
        margin-top: 5px;
    }
</style>

<!-- HEADER -->
<div class="print-date">
    Dicetak: <?= date('d M Y'); ?>
</div>

<div class="header">
    <h3>LAPORAN ABSENSI - Per TENANT</h3>
    <h4>(PASAR INDUK SURABAYA SIDOTOPO)</h4>
</div>

<p>
    Periode:
    <b><?= date("d M Y", strtotime($first_date)); ?></b>
    s/d
    <b><?= date("d M Y", strtotime($last_date)); ?></b>
</p>

<p>
    Nama Tenant:
    <b><?= $tenant['tenant_name']; ?></b>
</p>

<table>
    <tr>
        <th width="5%">No</th>
        <th width="50%">Tanggal</th>
        <th width="45%">Status</th>
    </tr>

<?php
$no = 1;
$line = 0;
while ($row = mysqli_fetch_assoc($query)) {
    $line++;

    // PAGE BREAK SETIAP 25 BARIS
    if ($line % 25 == 0) {
        echo '</table><pagebreak /><table>';
        echo '
        <tr>
            <th>No</th>
            <th>Tanggal Absensi</th>
            <th>Status</th>
        </tr>';
    }
?>
    <tr>
        <td class="center"><?= $no++; ?></td>
        <td class="center"><?= date("d M Y", strtotime($row['presence_date'])); ?></td>
        <td class="center"><?= $row['status_presence']; ?></td>
    </tr>
<?php } ?>
</table><br><br>

<!-- TANDA TANGAN -->
<table class="signature">
    <tr>
        <td>
            Mengetahui,<br>
            Manajemen<br><br><br><br>
            <b>( ____________________ )</b>
        </td>
        <td>
            Surabaya, <?= date('d M Y'); ?><br>
            Tim Kantin<br><br><br><br>
            <b>( ____________________ )</b>
        </td>
    </tr>
</table>

<!-- FOOTER -->
<page_footer>
    <div class="footer">
        Halaman [[page_cu]] / [[page_nb]]
    </div>
</page_footer>

<?php
$html = ob_get_clean();

try {
    $pdf = new HTML2PDF('P', 'A4', 'en');
    $pdf->setDefaultFont('Arial');
    $pdf->writeHTML($html);
    $pdf->Output('laporan_absensi_tenant.pdf', 'I');
} catch (HTML2PDF_exception $e) {
    echo $e;
}
exit;
