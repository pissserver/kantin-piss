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

        <!-- bootstrap-progressbar -->
        <link
            href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css"
            rel="stylesheet"
        />
        <!-- JQVMap -->
        <link href="../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet" />
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
                    <!-- top tiles -->
                    <div class="row tile_count">
                        <div
                            class="col-md-2 col-sm-4 col-xs-6 tile_stats_count"
                        >
                            <span class="count_top"
                                ><i class="fa fa-user"></i> Total Users</span
                            >
                            <div class="count">2500</div>
                            <span class="count_bottom"
                                ><i class="green">4% </i> From last Week</span
                            >
                        </div>
                        <div
                            class="col-md-2 col-sm-4 col-xs-6 tile_stats_count"
                        >
                            <span class="count_top"
                                ><i class="fa fa-clock-o"></i> Average
                                Time</span
                            >
                            <div class="count">123.50</div>
                            <span class="count_bottom"
                                ><i class="green"
                                    ><i class="fa fa-sort-asc"></i>3%
                                </i>
                                From last Week</span
                            >
                        </div>
                        <div
                            class="col-md-2 col-sm-4 col-xs-6 tile_stats_count"
                        >
                            <span class="count_top"
                                ><i class="fa fa-user"></i> Total Males</span
                            >
                            <div class="count green">2,500</div>
                            <span class="count_bottom"
                                ><i class="green"
                                    ><i class="fa fa-sort-asc"></i>34%
                                </i>
                                From last Week</span
                            >
                        </div>
                        <div
                            class="col-md-2 col-sm-4 col-xs-6 tile_stats_count"
                        >
                            <span class="count_top"
                                ><i class="fa fa-user"></i> Total Females</span
                            >
                            <div class="count">4,567</div>
                            <span class="count_bottom"
                                ><i class="red"
                                    ><i class="fa fa-sort-desc"></i>12%
                                </i>
                                From last Week</span
                            >
                        </div>
                        <div
                            class="col-md-2 col-sm-4 col-xs-6 tile_stats_count"
                        >
                            <span class="count_top"
                                ><i class="fa fa-user"></i> Total
                                Collections</span
                            >
                            <div class="count">2,315</div>
                            <span class="count_bottom"
                                ><i class="green"
                                    ><i class="fa fa-sort-asc"></i>34%
                                </i>
                                From last Week</span
                            >
                        </div>
                        <div
                            class="col-md-2 col-sm-4 col-xs-6 tile_stats_count"
                        >
                            <span class="count_top"
                                ><i class="fa fa-user"></i> Total
                                Connections</span
                            >
                            <div class="count">7,325</div>
                            <span class="count_bottom"
                                ><i class="green"
                                    ><i class="fa fa-sort-asc"></i>34%
                                </i>
                                From last Week</span
                            >
                        </div>
                    </div>
                    <!-- /top tiles -->

                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="dashboard_graph">
                                <div class="row x_title">
                                    <div class="col-md-6">
                                        <h3>
                                            Network Activities
                                            <small>Graph title sub-title</small>
                                        </h3>
                                    </div>
                                    <div class="col-md-6">
                                        <div
                                            id="reportrange"
                                            class="pull-right"
                                            style="
                                                background: #fff;
                                                cursor: pointer;
                                                padding: 5px 10px;
                                                border: 1px solid #ccc;
                                            "
                                        >
                                            <i
                                                class="glyphicon glyphicon-calendar fa fa-calendar"
                                            ></i>
                                            <span
                                                >December 30, 2014 - January 28,
                                                2015</span
                                            >
                                            <b class="caret"></b>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <div
                                        id="chart_plot_01"
                                        class="demo-placeholder"
                                    ></div>
                                </div>
                                <div
                                    class="col-md-3 col-sm-3 col-xs-12 bg-white"
                                >
                                    <div class="x_title">
                                        <h2>Top Campaign Performance</h2>
                                        <div class="clearfix"></div>
                                    </div>

                                    <div class="col-md-12 col-sm-12 col-xs-6">
                                        <div>
                                            <p>Facebook Campaign</p>
                                            <div class="">
                                                <div
                                                    class="progress progress_sm"
                                                    style="width: 76%"
                                                >
                                                    <div
                                                        class="progress-bar bg-green"
                                                        role="progressbar"
                                                        data-transitiongoal="80"
                                                    ></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <p>Twitter Campaign</p>
                                            <div class="">
                                                <div
                                                    class="progress progress_sm"
                                                    style="width: 76%"
                                                >
                                                    <div
                                                        class="progress-bar bg-green"
                                                        role="progressbar"
                                                        data-transitiongoal="60"
                                                    ></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-6">
                                        <div>
                                            <p>Conventional Media</p>
                                            <div class="">
                                                <div
                                                    class="progress progress_sm"
                                                    style="width: 76%"
                                                >
                                                    <div
                                                        class="progress-bar bg-green"
                                                        role="progressbar"
                                                        data-transitiongoal="40"
                                                    ></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <p>Bill boards</p>
                                            <div class="">
                                                <div
                                                    class="progress progress_sm"
                                                    style="width: 76%"
                                                >
                                                    <div
                                                        class="progress-bar bg-green"
                                                        role="progressbar"
                                                        data-transitiongoal="50"
                                                    ></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="clearfix"></div>
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
        <!-- Chart.js -->
        <script src="../vendors/Chart.js/dist/Chart.min.js"></script>
        <!-- gauge.js -->
        <script src="../vendors/gauge.js/dist/gauge.min.js"></script>
        <!-- bootstrap-progressbar -->
        <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
        <!-- iCheck -->
        <script src="../vendors/iCheck/icheck.min.js"></script>
        <!-- Skycons -->
        <script src="../vendors/skycons/skycons.js"></script>
        <!-- Flot -->
        <script src="../vendors/Flot/jquery.flot.js"></script>
        <script src="../vendors/Flot/jquery.flot.pie.js"></script>
        <script src="../vendors/Flot/jquery.flot.time.js"></script>
        <script src="../vendors/Flot/jquery.flot.stack.js"></script>
        <script src="../vendors/Flot/jquery.flot.resize.js"></script>
        <!-- Flot plugins -->
        <script src="../vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
        <script src="../vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
        <script src="../vendors/flot.curvedlines/curvedLines.js"></script>
        <!-- DateJS -->
        <script src="../vendors/DateJS/build/date.js"></script>
        <!-- JQVMap -->
        <script src="../vendors/jqvmap/dist/jquery.vmap.js"></script>
        <script src="../vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
        <script src="../vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
        <!-- bootstrap-daterangepicker -->
        <script src="../vendors/moment/min/moment.min.js"></script>
        <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

        <!-- Custom Theme Scripts -->
        <script src="../build/js/custom.min.js"></script>
    </body>
</html>
