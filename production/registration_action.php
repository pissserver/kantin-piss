<?php

    require_once 'connection.php';

    try {
        $tentant_name = $_POST['tenant_name'];
        $tenant_owner = $_POST['tenant_owner'];
        $registration_date = $_POST['registration_date'];

        $query = "INSERT INTO tenants (tenant_name, tenant_owner, status, registration_date) VALUES ('$tentant_name', '$tenant_owner', 'active', '$registration_date')";

        $result = mysqli_query($conn, $query);

        if ($result) {
            header("Location: registration.php?status=success");
        } else {
            header("Location: registration.php?status=error");
        }
    } catch (\Throwable $th) {
        header("Location: registration.php?status=error");
    }