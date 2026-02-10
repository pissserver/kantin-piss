<?php
require_once '../html2pdf/html2pdf.class.php';
require_once '../connection.php';

$first_date = $_POST['first_date'];
$last_date  = $_POST['last_date'];

$query = mysqli_query($conn, "
    SELECT 
        t.tenant_name,
        p.payment_date,
        p.status_payment,
        p.cost_payment
    FROM tenant_payments p
    JOIN tenants t ON t.id = p.tenant_id
    WHERE p.payment_date BETWEEN '$first_date' AND '$last_date'
    ORDER BY p.payment_date ASC
");

if (!$query) {
    die(mysqli_error($conn));
}

$total_payment = 0;

ob_start();
?>

<style>
body { font-family: Arial; font-size: 11px; }
.header { text-align: center; margin-bottom: 10px; }
.print-date { text-align: right; font-size: 10px; margin-bottom: 5px; }
h3 { margin: 0; margin-top: 30px; }
h4 { margin: 3px 0 10px 0; font-weight: normal; }
table { width: 100%; border-collapse: collapse; margin-top: 8px; table-layout: fixed; }
th, td { border: 1px solid #000; padding: 5px; }
th { background-color: #f0f0f0; text-align: center; }
.center { text-align: center; }
.right { text-align: right; }
.signature { width: 100%; margin-top: 40px; }
.signature td { border: none; text-align: center; width: 50%; }
.footer { text-align: center; font-size: 10px; }
</style>

<page>

<div class="print-date">
    Dicetak: <?= date('d M Y'); ?>
</div>

<div class="header">
    <h3>LAPORAN PEMBAYARAN TENANT - SEMUA TENANT</h3>
    <h4>(PASAR INDUK SURABAYA SIDOTOPO)</h4>
</div>

<p>
    Periode:
    <b><?= date("d M Y", strtotime($first_date)); ?></b>
    s/d
    <b><?= date("d M Y", strtotime($last_date)); ?></b>
</p>

<table>
<tr>
    <th width="5%">No</th>
    <th width="20%">Nama Tenant</th>
    <th width="25%">Tanggal Pembayaran</th>
    <th width="25%">Jumlah Pembayaran (Rp)</th>
    <th width="25%">Status</th>
</tr>

<?php
$no = 1;
$line = 0;

while ($row = mysqli_fetch_assoc($query)) {
    $line++;
    $total_payment += $row['cost_payment'];

    if ($line % 25 == 0) {
        echo '</table>';
        echo '</page>';
        echo '<page>';
        echo '
        <table>
        <tr>
            <th width="5%">No</th>
            <th width="20%">Nama Tenant</th>
            <th width="25%">Tanggal Pembayaran</th>
            <th width="25%">Jumlah Pembayaran (Rp)</th>
            <th width="25%">Status</th>
        </tr>';
    }
?>
<tr>
    <td class="center"><?= $no++; ?></td>
    <td><?= $row['tenant_name']; ?></td>
    <td class="center"><?= date("d M Y", strtotime($row['payment_date'])); ?></td>
    <td class="right"><?= number_format($row['cost_payment'],0,',','.'); ?></td>
    <td class="center"><?= $row['status_payment']; ?></td>
</tr>
<?php } ?>

<tr>
    <td colspan="3" class="center"><strong>TOTAL</strong></td>
    <td colspan="2" class="right"><strong><?= number_format($total_payment,0,',','.'); ?></strong></td>
</tr>
</table>

<br><br>

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

<page_footer>
    <div class="footer">
        Halaman [[page_cu]] / [[page_nb]]
    </div>
</page_footer>

</page>

<?php
$html = ob_get_clean();

try {
    $pdf = new HTML2PDF('P', 'A4', 'en');
    $pdf->setDefaultFont('Arial');
    $pdf->writeHTML($html);
    $pdf->Output('laporan_pembayaran_tenant.pdf', 'I');
} catch (HTML2PDF_exception $e) {
    echo $e;
}
exit;
