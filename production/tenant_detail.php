<?php
    require_once 'auth.php';
    require_once 'connection.php';

    $id = isset($_GET['id']) ? $_GET['id'] : '';
    $date_now = date("Y-m-d");
    $month_now = date("m");
    $year_now = date("Y");

    $query  = mysqli_query($conn, "SELECT * FROM tenants WHERE id='$id'");
    $row = mysqli_fetch_assoc($query);
    $tenant_id = $row['id'];
?>

<style>
    body {
        background: #f3f4f6;
    }

    /* PROFILE */
    .tenant-profile {
        display: flex;
        align-items: center;
        background: #fff;
        padding: 20px;
        border-radius: 16px;
        box-shadow: 0 8px 22px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }
    .profile-icon {
        width: 72px;
        height: 72px;
        border-radius: 50%;
        background: #337ab7;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 30px;
    }
    .profile-info {
        padding-left: 16px;
    }
    .profile-info h3 {
        margin: 0 0 6px;
        font-weight: 600;
    }
    .profile-info p {
        margin: 0;
        color: #666;
    }

    /* INFO BOX */
    .tenant-info {
        background: #fff;
        padding: 14px 18px;
        border-radius: 14px;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
        margin-bottom: 22px;
    }

    /* FORM PANEL */
    .tenant-form {
        border-radius: 16px;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
        margin-bottom: 18px;
    }
    .tenant-form .panel-heading {
        font-weight: 600;
    }
</style>

<!doctype html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <title>Gentelella Alela! |</title>

        <!-- Bootstrap -->
        <link
            href="../vendors/bootstrap/dist/css/bootstrap.min.css"
            rel="stylesheet"
        />
        <!-- Font Awesome -->
        <link
            href="../vendors/font-awesome/css/font-awesome.min.css"
            rel="stylesheet"
        />
        <!-- NProgress -->
        <link href="../vendors/nprogress/nprogress.css" rel="stylesheet" />
        <!-- iCheck -->
        <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet" />
        <!-- bootstrap-wysiwyg -->
        <link
            href="../vendors/google-code-prettify/bin/prettify.min.css"
            rel="stylesheet"
        />
        <!-- Select2 -->
        <link
            href="../vendors/select2/dist/css/select2.min.css"
            rel="stylesheet"
        />
        <!-- Switchery -->
        <link
            href="../vendors/switchery/dist/switchery.min.css"
            rel="stylesheet"
        />
        <!-- starrr -->
        <link href="../vendors/starrr/dist/starrr.css" rel="stylesheet" />
        <!-- bootstrap-daterangepicker -->
        <link
            href="../vendors/bootstrap-daterangepicker/daterangepicker.css"
            rel="stylesheet"
        />

        <!-- Custom Theme Style -->
        <link href="../build/css/custom.min.css" rel="stylesheet" />
    </head>

    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                <div class="col-md-3 left_col">
                    <?php include "fixed_sidebar.php"; ?>
                </div>

                <?php include "fixed_navbar.php"; ?>

                <!-- page content -->
                <div class="right_col" role="main">
                    <!-- PROFILE TENANT -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="tenant-profile">
                                <div class="profile-icon">
                                    <i class="fa fa-cutlery"></i>
                                </div>
                                <div class="profile-info">
                                    <h3><?php echo $row['tenant_name']; ?></h3>
                                    <p>
                                        <i class="fa fa-user"></i> <?php echo
                                        $row['tenant_owner']; ?> &nbsp; | &nbsp;
                                        <i class="fa fa-calendar"></i>
                                        <?php echo date("d M Y",
                                        strtotime($row['registration_date']));
                                        ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br />

                    <!-- 3 FORM -->
                    <div class="row">
                        <!-- ABSEN -->
                        <div class="col-md-4 col-sm-12 col-xs-12">
                            <div class="panel panel-default tenant-form">
                                <div class="panel-heading">
                                    <i class="fa fa-calendar-check-o"></i> Form
                                    Absen
                                </div>
                                <div class="panel-body">
                                    <form method="POST" action="presence_action.php">

                                        <input
                                            type="hidden"
                                            name="tenant_id"
                                            value="<?php echo $tenant_id; ?>"
                                        />

                                        <div class="form-group">
                                            <label>Absensi</label>

                                            <div class="row">
                                                <!-- TANGGAL -->
                                                <div class="col-xs-7">
                                                    <input
                                                        type="date"
                                                        name="presence_date"
                                                        class="form-control"
                                                        value="<?php echo $date_now; ?>"
                                                        required
                                                        readonly
                                                    />
                                                </div>

                                                <!-- STATUS -->
                                                <div class="col-xs-5">
                                                    <select
                                                        name="status_presence"
                                                        class="form-control"
                                                        required
                                                    >
                                                        <option value="">Status</option>
                                                        <option value="hadir">Hadir</option>
                                                        <option value="tidak hadir">Tidak Hadir</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <?php
                                            $queryPresence = mysqli_query($conn, "SELECT * FROM presences WHERE tenant_id='$tenant_id' AND presence_date='$date_now'");
                                            $countPresence = mysqli_num_rows($queryPresence);

                                        if ($countPresence == 0) { ?>
                                            <button type="submit" class="btn btn-success btn-block btn-sm">
                                                Simpan Absensi &nbsp;<i class="fa fa-save"></i>
                                            </button>

                                        <?php } else { ?>
                                            <button type="button" class="btn btn-default btn-block btn-sm" disabled>
                                                Sudah Melakukan Absensi Hari Ini &nbsp;<i class="fa fa-check"></i>
                                            </button>
                                        <?php } ?>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- PEMBAYARAN TENANT-->
                        <div class="col-md-4 col-sm-12 col-xs-12">
                            <div class="panel panel-default tenant-form">
                                <div class="panel-heading">
                                    <i class="fa fa-money"></i> Pembayaran
                                    Tenant
                                </div>
                                <div class="panel-body">
                                    <form
                                        method="POST"
                                        action="payment_tenant_action.php"
                                    >
                                        <input
                                            type="hidden"
                                            name="tenant_id"
                                            value="<?php echo $tenant_id; ?>"
                                        />

                                        <div class="form-group">
                                            <label>Jumlah Bayar</label>
                                            <!-- TAMPILAN (Rp 50.000) -->
                                            <input
                                                type="text"
                                                class="form-control"
                                                value="Rp 50.000"
                                                readonly
                                            />

                                            <!-- DATA ASLI (50000) -->
                                            <input
                                                type="hidden"
                                                name="cost_payment"
                                                value="50000"
                                            />
                                        </div>

                                        <?php
                                            $queryPaymentTenant = mysqli_query($conn, "SELECT * FROM tenant_payments WHERE tenant_id='$tenant_id' AND payment_date='$date_now'");
                                            $countPaymentTenant = mysqli_num_rows($queryPaymentTenant);

                                        if ($countPaymentTenant == 0) { ?>
                                            <button type="submit" class="btn btn-primary btn-block btn-sm">
                                                Bayar Tenant &nbsp;<i class="fa fa-money"></i>
                                            </button>

                                        <?php } else { ?>
                                            <button type="button" class="btn btn-default btn-block btn-sm" disabled>
                                                Sudah Melakukan Pembayaran Hari Ini &nbsp;<i class="fa fa-check"></i>
                                            </button>
                                        <?php } ?>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- AIR & LISTRIK -->
                        <div class="col-md-4 col-sm-12 col-xs-12">
                            <div class="panel panel-default tenant-form">
                                <div class="panel-heading">
                                    <i class="fa fa-tint"></i> Air & Listrik
                                </div>
                                <div class="panel-body">
                                    <form
                                        method="POST"
                                        action="payment_electric_action.php"
                                    >
                                        <input
                                            type="hidden"
                                            name="tenant_id"
                                            value="<?php echo $tenant_id; ?>"
                                        />

                                        <div class="form-group">
                                            <label>Total Rupiah</label>
                                            <!-- TAMPILAN (Rp 50.000) -->
                                            <input
                                                type="text"
                                                class="form-control"
                                                value="Rp 25.000"
                                                readonly
                                            />

                                            <!-- DATA ASLI (50000) -->
                                            <input
                                                type="hidden"
                                                name="cost_payment"
                                                value="25000"
                                            />
                                        </div>

                                        <?php
                                            $queryPaymentElectric = mysqli_query($conn, "SELECT * FROM electric_payments WHERE tenant_id='$tenant_id' AND MONTH(payment_date)='$month_now' AND YEAR(payment_date)='$year_now'");
                                            $countPaymentElectric = mysqli_num_rows($queryPaymentElectric);

                                        if ($countPaymentElectric == 0) { ?>
                                            <button type="submit" class="btn btn-info btn-block btn-sm">
                                                Bayar Air & Listik &nbsp;<i class="fa fa-money"></i>
                                            </button>

                                        <?php } else { ?>
                                            <button type="button" class="btn btn-default btn-block btn-sm" disabled>
                                                Sudah Melakukan Pembayaran Bulan Ini &nbsp;<i class="fa fa-check"></i>
                                            </button>
                                        <?php } ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div><br>

                    <!-- ROW TABEL (SWITCH / TAB) -->
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <!-- TAB SWITCH -->
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#tab_absen" data-toggle="tab">
                                        <i class="fa fa-calendar-check-o"></i>
                                        Absen
                                    </a>
                                </li>
                                <li>
                                    <a href="#tab_payment" data-toggle="tab">
                                        <i class="fa fa-money"></i> Pembayaran
                                        Tenant
                                    </a>
                                </li>
                                <li>
                                    <a href="#tab_utility" data-toggle="tab">
                                        <i class="fa fa-tint"></i> Air & Listrik
                                    </a>
                                </li>
                            </ul>

                            <!-- TAB CONTENT -->
                            <div class="tab-content" style="margin-top: 15px">
                                <!-- TAB ABSEN -->
                                <div
                                    class="tab-pane fade in active"
                                    id="tab_absen"
                                >
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <strong>Riwayat Absen</strong>
                                        </div>
                                        <div class="panel-body">
                                            <!-- CONTAINER AJAX -->
                                            <div id="absen-data">
                                                <div style="text-align:center; padding:20px;">
                                                    Memuat data...
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- TAB PEMBAYARAN TENANT -->
                                <div class="tab-pane fade" id="tab_payment">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <strong
                                                >Riwayat Pembayaran
                                                Tenant</strong
                                            >
                                        </div>
                                        <div class="panel-body">
                                            <!-- CONTAINER AJAX -->
                                            <div id="payment-tenant-data" style="overflow-x: auto;">
                                                <div style="text-align:center; padding:20px;">
                                                    Memuat data...
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- TAB AIR & LISTRIK -->
                                <div class="tab-pane fade" id="tab_utility">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <strong
                                                >Riwayat Air & Listrik</strong
                                            >
                                        </div>
                                        <div class="panel-body">
                                            <!-- CONTAINER AJAX -->
                                            <div id="payment-electric-data" style="overflow-x: auto;">
                                                <div style="text-align:center; padding:20px;">
                                                    Memuat data...
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /page content -->

                <?php include "fixed_footer.php"; ?>
            </div>
        </div>


        <!-- jQuery -->
        <script src="../vendors/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- FastClick -->
        <script src="../vendors/fastclick/lib/fastclick.js"></script>
        <!-- NProgress -->
        <script src="../vendors/nprogress/nprogress.js"></script>
        <!-- bootstrap-progressbar -->
        <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
        <!-- iCheck -->
        <script src="../vendors/iCheck/icheck.min.js"></script>
        <!-- bootstrap-daterangepicker -->
        <script src="../vendors/moment/min/moment.min.js"></script>
        <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
        <!-- bootstrap-wysiwyg -->
        <script src="../vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
        <script src="../vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
        <script src="../vendors/google-code-prettify/src/prettify.js"></script>
        <!-- jQuery Tags Input -->
        <script src="../vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
        <!-- Switchery -->
        <script src="../vendors/switchery/dist/switchery.min.js"></script>
        <!-- Select2 -->
        <script src="../vendors/select2/dist/js/select2.full.min.js"></script>
        <!-- Parsley -->
        <script src="../vendors/parsleyjs/dist/parsley.min.js"></script>
        <!-- Autosize -->
        <script src="../vendors/autosize/dist/autosize.min.js"></script>
        <!-- jQuery autocomplete -->
        <script src="../vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
        <!-- starrr -->
        <script src="../vendors/starrr/dist/starrr.js"></script>
        <!-- Custom Theme Scripts -->
        <script src="../build/js/custom.min.js"></script>

        <!-- AJAX -->
        <script>
            $(document).ready(function(){
                loadAbsen(1);

                // klik pagination
                $(document).on('click', '.absen-pagination a', function(e){
                    e.preventDefault();
                    let page = $(this).data('page');
                    loadAbsen(page);
                });

                function loadAbsen(page){
                    $.ajax({
                        url: 'presence_table_ajax.php',
                        type: 'POST',
                        data: {
                            tenant_id: '<?php echo $tenant_id; ?>',
                            page: page
                        },
                        success: function(data){
                            $('#absen-data').html(data);
                        }
                    });
                }
            });
        </script>

        <script>
            $(document).ready(function(){
                loadAbsen(1);

                // klik pagination
                $(document).on('click', '.payment-tenant-pagination a', function(e){
                    e.preventDefault();
                    let page = $(this).data('page');
                    loadAbsen(page);
                });

                function loadAbsen(page){
                    $.ajax({
                        url: 'payment_tenant_table_ajax.php',
                        type: 'POST',
                        data: {
                            tenant_id: '<?php echo $tenant_id; ?>',
                            page: page
                        },
                        success: function(data){
                            $('#payment-tenant-data').html(data);
                        }
                    });
                }
            });
        </script>

        <script>
            $(document).ready(function(){
                loadAbsen(1);

                // klik pagination
                $(document).on('click', '.payment-electric-pagination a', function(e){
                    e.preventDefault();
                    let page = $(this).data('page');
                    loadAbsen(page);
                });

                function loadAbsen(page){
                    $.ajax({
                        url: 'payment_electric_table_ajax.php',
                        type: 'POST',
                        data: {
                            tenant_id: '<?php echo $tenant_id; ?>',
                            page: page
                        },
                        success: function(data){
                            $('#payment-electric-data').html(data);
                        }
                    });
                }
            });
        </script>
    </body>
</html>
