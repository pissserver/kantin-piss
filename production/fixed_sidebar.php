<?php
    include 'connection.php';

    $username = $_SESSION['username'];
    $query = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
    $data = mysqli_fetch_assoc($query);
?>

<div class="main_container">
    <div class="col-md-3 left_col menu_fixed">
        <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0">
                <a href="index.php" class="site_title"
                    ><i class="fa fa-cutlery"></i> <span>KANTIN PISS</span></a
                >
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
                <div class="profile_pic">
                    <img
                        src="images/default-avatar.jpg"
                        alt="..."
                        class="img-circle profile_img"
                    />
                </div>
                <div class="profile_info">
                    <span>Welcome,</span>
                    <h2 style="text-transform: capitalize;"><?= $data['username'] ?></h2>
                </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div
                id="sidebar-menu"
                class="main_menu_side hidden-print main_menu"
            >
                <div class="menu_section">
                    <ul class="nav side-menu">
                        <li>
                            <a href="dashboard.php"
                                ><i class="fa fa-dashboard"></i> Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="registration.php"
                                ><i class="fa fa-edit"></i> Pendaftaran Tenant</a>
                        </li>
                        <li>
                            <a href="tenant.php"
                                ><i class="fa fa-users"></i> Tenant</a>
                        </li>
                        <li>
                            <a>
                                <i class="fa fa-file-text"></i> Laporan <span class="fa fa-chevron-down"></span>
                            </a>
                            <ul class="nav child_menu">
                                <li><a href="report_presence.php"><i class="fa fa-file-text"></i>&nbsp;Absensi</a></li>
                                <li><a href="report_tenant.php"><i class="fa fa-file-text"></i>&nbsp;Pembayaran Tenant</a></li>
                                <li><a href="report_electric.php"><i class="fa fa-file-text"></i>&nbsp;Pembayaran Air & Listik</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- /sidebar menu -->
        </div>
    </div>
</div>
