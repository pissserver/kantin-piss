<?php
require_once 'auth.php';
?>

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
                    <div class="">
                        <div class="page-title">
                            <div class="title_left">
                                <h3>
                                    Laporan Absensi&nbsp;<i
                                        class="fa fa-file-text"
                                    ></i>
                                </h3>
                                <br />
                            </div>
                        </div>

                        <div class="clearfix"></div>

                        <!-- All Tenant -->
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="panel panel-primary tenant-form">
                                    <div class="panel-heading">
                                        <i class="fa fa-file-text"></i>&nbsp;
                                        Semua Tenant
                                    </div>
                                    <div class="panel-body">
                                        <form
                                            method="POST"
                                            action="report/report_presence_all.php" target="_blank"
                                        >
                                            <input
                                                type="hidden"
                                                name="tenant_id"
                                                value="<?php echo $tenant_id; ?>"
                                            />

                                            <div class="form-group">
                                                <div class="row">
                                                    <!-- TANGGAL Awal-->
                                                    <div class="col-xs-6">
                                                        <label>Tanggal Awal</label>
                                                        <input
                                                        type="date"
                                                        name="first_date"
                                                        class="form-control"
                                                        required
                                                        />
                                                    </div>
                                                    
                                                    <!-- TANGGAL Akhir-->
                                                    <div class="col-xs-6">
                                                        <label>Tanggal Akhir</label>
                                                        <input
                                                            type="date"
                                                            name="last_date"
                                                            class="form-control"
                                                            required
                                                        />
                                                    </div>
                                                </div>
                                            </div>

                                            
                                            <button
                                                type="submit"
                                                class="btn btn-success btn-block btn-sm"
                                            >
                                                Lihat PDF &nbsp;<i
                                                    class="fa fa-file-pdf-o"
                                                ></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Per Tenant -->
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="panel panel-primary tenant-form">
                                    <div class="panel-heading">
                                        <i class="fa fa-file-text"></i>&nbsp;
                                        Per-Tenant
                                    </div>
                                    <div class="panel-body">
                                        <form
                                            method="POST"
                                            action="report/report_presence_one.php" target="_blank"
                                        >
                                            <input
                                                type="hidden"
                                                name="tenant_id"
                                                value="<?php echo $tenant_id; ?>"
                                            />

                                            <div class="form-group">
                                                <div class="row">
                                                    <!-- TANGGAL Awal-->
                                                    <div class="col-xs-6">
                                                        <label>Tanggal Awal</label>
                                                        <input
                                                        type="date"
                                                        name="first_date"
                                                        class="form-control"
                                                        required
                                                        />
                                                    </div>
                                                    
                                                    <!-- TANGGAL Akhir-->
                                                    <div class="col-xs-6">
                                                        <label>Tanggal Akhir</label>
                                                        <input
                                                            type="date"
                                                            name="last_date"
                                                            class="form-control"
                                                            required
                                                        />
                                                    </div>
                                                </div><br>

                                                <div class="row">
                                                    <!-- TANGGAL Awal-->
                                                    <div class="col-xs-12">
                                                        <label>Nama tenant</label>
                                                        <select name="tenant_id" id="tenant_id" class="form-control">
                                                            <option value="">Pilih Tenant</option>
                                                            <?php
                                                            $q = mysqli_query($conn, "SELECT id, tenant_name FROM tenants ORDER BY tenant_name ASC");
                                                            while ($t = mysqli_fetch_assoc($q)) {
                                                                echo '<option value="'.$t['id'].'">'.$t['tenant_name'].'</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            
                                            <button
                                                type="submit"
                                                class="btn btn-success btn-block btn-sm"
                                            >
                                                Lihat PDF &nbsp;<i
                                                    class="fa fa-file-pdf-o"
                                                ></i>
                                            </button>
                                        </form>
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
    </body>
</html>
