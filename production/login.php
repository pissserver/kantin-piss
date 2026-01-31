<!doctype html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <title>Login || Kantin PISS</title>
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
        <!-- Animate.css -->
        <link href="../vendors/animate.css/animate.min.css" rel="stylesheet" />

        <!-- Custom Theme Style -->
        <link href="../build/css/custom.min.css" rel="stylesheet" />
    </head>

    <body class="login">
        <div>
            <div class="login_wrapper">
                <div class="animate form login_form">
                    <section class="login_content">
                        <?php
                        session_start();
                        if (isset($_SESSION['error'])) {
                            echo '<div class="alert alert-danger">'.$_SESSION['error'].'</div>';
                            unset($_SESSION['error']);
                        }
                        ?>

                        <form action="checklogin.php" method="POST">
                            <h1>Login Form</h1>
                            <div>
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Username"
                                    required
                                    name="username"
                                />
                            </div>
                            <div>
                                <input
                                    type="password"
                                    class="form-control"
                                    placeholder="Password"
                                    required
                                    name="password"
                                />
                            </div>
                            <div>
                                <button
                                    type="submit"
                                    class="btn btn-primary submit"
                                >Log in</button>
                                <!-- <a class="reset_pass" href="#"
                                    >Lost your password?</a
                                > -->
                            </div>

                            <div class="clearfix"></div>

                            <div class="separator">
                                <div>
                                    <h1>
                                        <i class="fa fa-cutlery"></i>&nbsp;
                                        Kantin PISS
                                    </h1>
                                    <p>
                                        ©2026 All Rights Reserved. Kantin PISS -
                                        Pasar Induk Surabaya Sidotopo
                                    </p>
                                </div>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </body>
</html>
