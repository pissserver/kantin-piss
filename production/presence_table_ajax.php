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
    FROM presences 
    WHERE tenant_id = '$tenant_id'
");
$total_data = mysqli_fetch_assoc($total_q)['total'];
$total_page = ceil($total_data / $limit);

// DATA
$query = mysqli_query($conn, "
    SELECT * FROM presences
    WHERE tenant_id = '$tenant_id'
    ORDER BY presence_date DESC
    LIMIT $start, $limit
");

$no = $start + 1;
?>

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th style="text-align:center; width:5%;">No</th>
            <th style="text-align:center;">Tanggal</th>
            <th style="text-align:center;">Status</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($total_data == 0) { ?>
            <tr>
                <td colspan="3" style="text-align:center;">
                    Tidak ada data
                </td>
            </tr>
        <?php } else { ?>
            <?php while ($row = mysqli_fetch_assoc($query)) {
                $status = strtolower($row['status_presence']);
                setlocale(LC_TIME, 'id_ID.utf8', 'id_ID');
            ?>
            <tr>
                <td align="center" style="vertical-align: middle;"><?php echo $no++; ?></td>
                <td align="center" style="vertical-align: middle;">
                    <?php echo strftime('%A, %d %b %Y', strtotime($row['presence_date'])); ?>
                </td>
                <td align="center" style="vertical-align: middle;">
                    <span class="label <?php echo ($status == 'hadir') ? 'label-success' : 'label-danger'; ?>"
                        style="text-transform:capitalize;">
                        <?php echo $row['status_presence']; ?>
                    </span>
                </td>
            </tr>
            <?php } ?>
        <?php } ?>
    </tbody>
</table>

<!-- PAGINATION -->
<?php if ($total_page > 1) { ?>
<nav style="text-align:center;">
    <ul class="pagination pagination-sm absen-pagination">

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
