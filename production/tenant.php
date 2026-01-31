<?php
require_once 'auth.php';
?>


<style>
/* WRAPPER */
.tenant-list{
    display:flex;
    flex-direction:column;
    gap:12px; /* jarak konsisten antar card */
}

/* CARD */
.tenant-item{
    background:#fff;
    border-radius:14px;
    padding:14px 16px;
    box-shadow:0 8px 20px rgba(0,0,0,.1);
}

/* TOP SECTION */
.tenant-top{
    display:flex;
    align-items:center;
    gap:12px;
}

.tenant-icon{
    width:44px;
    height:44px;
    border-radius:50%;
    background:#337ab7;
    color:#fff;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:20px;
}

.tenant-name{
    font-weight:600;
    font-size:15px;
}

.tenant-owner{
    font-size:13px;
    color:#777;
}

/* BOTTOM */
.tenant-bottom{
    margin-top:10px;
    padding-top:10px;
    border-top:1px dashed #e5e5e5;
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.tenant-date{
    font-size:12px;
    color:#777;
}

/* DESKTOP GRID */
@media (min-width:768px){
    .tenant-list{
        display:grid;
        grid-template-columns:repeat(3,1fr);
        gap:16px;
    }
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

        <title>Tenant || Kantin PISS</title>
        <link rel="icon" type="image/png" href="images/icon.png" />

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
                                    Daftar Tenant &nbsp;<i
                                        class="fa fa-users"
                                    ></i>
                                </h3><br>
                            </div>
                        </div>

                        <div class="clearfix"></div>

                        <?php
                        include 'connection.php';

                        $query  = "SELECT * FROM tenants ORDER BY registration_date DESC";
                        $result = mysqli_query($conn, $query);
                        ?>

                        <div class="tenant-list">
                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                            <div class="tenant-item">

                                <!-- TOP -->
                                <div class="tenant-top">
                                    <div class="tenant-icon">
                                        <i class="fa fa-cutlery"></i>
                                    </div>

                                    <div class="tenant-info">
                                        <div class="tenant-name">
                                            <?php echo $row['tenant_name']; ?>
                                        </div>
                                        <div class="tenant-owner">
                                            <i class="fa fa-user"></i>
                                            <?php echo $row['tenant_owner']; ?>
                                        </div>
                                        <div class="tenant-owner">
                                            <i class="text-<?php echo $row['status'] == 'active' ? 'success' : 'danger'; ?> fa fa-<?php echo $row['status'] == 'active' ? 'check-circle' : 'times-circle'; ?>"></i>
                                            <?php echo $row['status']; ?>
                                        </div>
                                    </div>
                                </div>

                                <!-- BOTTOM -->
                                <div class="tenant-bottom">
                                    <span class="tenant-date">
                                        <i class="fa fa-calendar"></i>
                                        <?php echo date("d M Y", strtotime($row['registration_date'])); ?>
                                    </span>

                                    <?php 
                                    $status = $row['status'];
                                    if ($status == 'active') { ?>
                                        <a href="tenant_action.php?tenant_id=<?php echo $row['id']; ?>&action=deactivate"
                                        class="btn btn-danger btn-xs" style="padding: 5px 10px; border-radius: 20px;">
                                            <i class="fa fa-times-circle"></i>&nbsp; Nonaktifkan
                                        </a>
                                    <?php } else { ?>
                                        <a href="tenant_action.php?tenant_id=<?php echo $row['id']; ?>&action=activate"
                                        class="btn btn-success btn-xs" style="padding: 5px 10px; border-radius: 20px;">
                                            <i class="fa fa-check-circle"></i>&nbsp; Aktifkan
                                        </a>
                                    <?php } ?>

                                    <?php if ($status == 'active') { ?>
                                        <a href="tenant_detail.php?id=<?php echo $row['id']; ?>"
                                        class="btn btn-primary btn-xs" style="padding: 5px 10px; border-radius: 20px;">
                                            <i class="fa fa-info-circle"></i>&nbsp; Detail
                                        </a>
                                    <?php } ?>
                                </div>

                            </div>
                        <?php } ?>
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
