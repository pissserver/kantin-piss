<?php
include 'connection.php';

$query = "SELECT * FROM tenants";
$result = mysqli_query($conn, $query);
$no = 0;
?>

<table class="table table-striped">
    <thead>
        <tr>
            <th style="vertical-align: middle; text-align: center;">No</th>
            <th style="vertical-align: middle; text-align: center;">Nama Tenant</th>
            <th style="vertical-align: middle; text-align: center;">Pemilik Tenant</th>
            <th style="vertical-align: middle; text-align: center;">Status</th>
            <th style="vertical-align: middle; text-align: center;">Tanggal Pendaftaran</th>
        </tr>
    </thead>
    <tbody>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            $no++
        ?>
            <tr>
                <th style="vertical-align: middle; text-align: center;" scope="row"><?php echo $no ?></th>
                <td style="vertical-align: middle; text-align: center;"><?php echo $row['tenant_name'] ?></td>
                <td style="vertical-align: middle; text-align: center;"><?php echo $row['tenant_owner'] ?></td>
                <td style="vertical-align: middle; text-align: center;"><?php echo ucwords(strtolower($row['status'])) ?></td>
                <td style="vertical-align: middle; text-align: center;"><?php echo date("d M Y", strtotime($row['registration_date'])) ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>