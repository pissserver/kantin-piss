<?php
require_once '../html2pdf/html2pdf.class.php';
require_once '../connection.php';

$first_date = $_POST['first_date'];
$last_date  = $_POST['last_date'];

$query = mysqli_query($conn, "
    SELECT 
        t.tenant_name,
        p.presence_date,
        p.status_presence
    FROM presences p
    JOIN tenants t ON t.id = p.tenant_id
    WHERE p.presence_date BETWEEN '$first_date' AND '$last_date'
    ORDER BY p.presence_date ASC
");

if (!$query) {
    die(mysqli_error($conn));
}

ob_start();
?>

<style>
body { font-family: Arial; font-size: 11px; }
.header { text-align: center; margin-bottom: 10px; }
.print-date { text-align: right; font-size: 10px; margin-bottom: 5px; }
table { width: 100%; border-collapse: collapse; margin-top: 8px; }
th, td { border: 1px solid #000; padding: 5px; }
th { background: #f0f0f0; text-align: center; }
.center { text-align: center; }
.signature td { border: none; text-align: center; width: 50%; }
.footer { text-align: center; font-size: 10px; }
</style>

<div class="print-date">
    Dicetak: <?= date('d M Y'); ?>
</div>

<div class="header">
    <h3>LAPORAN ABSENSI TENANT</h3>
    <h4>(PASAR INDUK SURABAYA SIDOTOPO)</h4>
</div>

<p>
    Periode:
    <b><?= date('d M Y', strtotime($first_date)); ?></b>
    s/d
    <b><?= date('d M Y', strtotime($last_date)); ?></b>
</p>

<table>
<tr>
    <th width="5%">No</th>
    <th width="40%">Nama Tenant</th>
    <th width="25%">Tanggal</th>
    <th width="30%">Status</th>
</tr>

<?php
$no = 1;
$line = 0;

while ($row = mysqli_fetch_assoc($query)) {
    $line++;

    if ($line % 25 == 0) {
        echo '</table>';
        echo '<page />';
        echo '<table>
            <tr>
                <th width="5%">No</th>
                <th width="40%">Nama Tenant</th>
                <th width="25%">Tanggal</th>
                <th width="30%">Status</th>
            </tr>';
    }
?>
<tr>
    <td class="center"><?= $no++; ?></td>
    <td><?= $row['tenant_name']; ?></td>
    <td class="center"><?= date('d M Y', strtotime($row['presence_date'])); ?></td>
    <td class="center" style="text-transform: capitalize"><?= $row['status_presence']; ?></td>
</tr>
<?php } ?>
</table>

<br><br>

<table class="signature">
<tr>
    <td>
        Mengetahui,<br>Manajemen<br><br><br><br>
        ( ____________________ )
    </td>
    <td>
        Surabaya, <?= date('d M Y'); ?><br>Tim Kantin<br><br><br><br>
        ( ____________________ )
    </td>
</tr>
</table>

<page_footer>
    <div class="footer">
        Halaman [[page_cu]] / [[page_nb]]
    </div>
</page_footer>

<?php
$html = ob_get_clean();

$pdf = new HTML2PDF('P', 'A4', 'en');
$pdf->setDefaultFont('Arial');
$pdf->writeHTML($html);
$pdf->Output('laporan_absensi_tenant.pdf', 'I');
exit;
