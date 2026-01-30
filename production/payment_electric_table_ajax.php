<?php
include 'connection.php';

$tenant_id = $_POST['tenant_id'];
$page      = isset($_POST['page']) ? (int)$_POST['page'] : 1;

// PAGINATION
$limit = 5;
$page  = ($page < 1) ? 1 : $page;
$start = ($page - 1) * $limit;

// TOTAL DATA
$total_q = mysqli_query($conn, "
    SELECT COUNT(*) AS total 
    FROM electric_payments 
    WHERE tenant_id = '$tenant_id'
");
$total_data = mysqli_fetch_assoc($total_q)['total'];
$total_page = ceil($total_data / $limit);

// DATA
$query = mysqli_query($conn, "
    SELECT * FROM electric_payments
    WHERE tenant_id = '$tenant_id'
    ORDER BY payment_date DESC
    LIMIT $start, $limit
");

$no = $start + 1;
?>

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th style="text-align:center; width:5%;">No</th>
            <th style="text-align:center;">Tanggal</th>
            <th style="text-align:center;">Biaya Pembayaran</th>
            <th style="text-align:center;">Status</th>
            <th style="text-align:center;">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($total_data == 0) { ?>
            <tr>
                <td colspan="4" style="text-align:center;">
                    Tidak ada data
                </td>
            </tr>
        <?php } else { ?>
            <?php while ($row = mysqli_fetch_assoc($query)) {
                $status = strtolower($row['status_payment']);
                setlocale(LC_TIME, 'id_ID.utf8', 'id_ID');
            ?>
            <tr>
                <td align="center" style="vertical-align: middle;"><?php echo $no++; ?></td>
                <td align="center" style="vertical-align: middle;">
                    <?php echo strftime('%A, %d %b %Y', strtotime($row['payment_date'])); ?>
                </td>
                <td align="center" style="vertical-align: middle;">
                    <?php echo format_rupiah($row['cost_payment']); ?>
                </td>
                <td align="center" style="vertical-align: middle;">
                    <span class="label <?php echo ($status == 'lunas') ? 'label-success' : 'label-danger'; ?>"
                    style="text-transform:capitalize;">
                    <?php echo $row['status_payment']; ?>
                    </span>
                </td>
                <td align="center" style="vertical-align: middle;">
                    <a href="payment_electric_print.php?payment_id=<?php echo $row['id']; ?>"
                    target="_blank"
                    class="btn btn-primary btn-xs"
                    style="padding:5px 10px; border-radius:20px;">
                    <i class="fa fa-print"></i> Cetak
                    </a>
                </td>
            </tr>
            <?php } ?>
        <?php } ?>
    </tbody>
</table>

<!-- PAGINATION -->
<?php if ($total_page > 1) { ?>
<nav style="text-align:center;">
    <ul class="pagination pagination-sm payment-electric-pagination">

        <li class="<?php echo ($page <= 1) ? 'disabled' : ''; ?>">
            <a href="#" data-page="<?php echo $page - 1; ?>">&laquo;</a>
        </li>

        <?php for ($i = 1; $i <= $total_page; $i++) { ?>
            <li class="<?php echo ($page == $i) ? 'active' : ''; ?>">
                <a href="#" data-page="<?php echo $i; ?>">
                    <?php echo $i; ?>
                </a>
            </li>
        <?php } ?>

        <li class="<?php echo ($page >= $total_page) ? 'disabled' : ''; ?>">
            <a href="#" data-page="<?php echo $page + 1; ?>">&raquo;</a>
        </li>

    </ul>
</nav>
<?php } ?>
