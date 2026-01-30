<?php
    require_once 'connection.php';

    try {
        $tenant_id = $_POST['tenant_id'];
        $presence_date = $_POST['presence_date'];
        $status_presence = $_POST['status_presence'];

        $query = "INSERT INTO presences (tenant_id, presence_date, status_presence) VALUES ('$tenant_id', '$presence_date', '$status_presence')";

        if (mysqli_query($conn, $query)) {
                echo "
                    <script>
                        alert('Absensi berhasil disimpan');
                        window.location.href = 'tenant_detail.php?id=$tenant_id';
                    </script>
                ";
            } else {
                echo "
                    <script>
                        alert('Gagal menyimpan absensi');
                        window.location.href = 'tenant_detail.php?id=$tenant_id';
                    </script>
                ";
            }
    } catch (\Throwable $th) {
        echo "
            <script>
                alert('Gagal menyimpan absensi');
                window.location.href = 'tenant_detail.php?id=$tenant_id';
            </script>
    ";
    }
    