<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>DataTables | Gentelella</title>

        <!-- Bootstrap -->
        <link href="<?php echo base_url() . "/public/cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" ?>">
        <link href="<?php echo base_url() . "/public/vendors/bootstrap/dist/css/bootstrap.min.css" ?>" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="<?php echo base_url() . "/public/vendors/font-awesome/css/font-awesome.min.css" ?>" rel="stylesheet">
        <!-- NProgress -->
        <link href="<?php echo base_url() . "/public/vendors/nprogress/nprogress.css" ?>" rel="stylesheet">
        <!-- iCheck -->
        <link href="<?php echo base_url() . "/public/vendors/iCheck/skins/flat/green.css" ?>" rel="stylesheet">
        <!-- Datatables -->

        <link href="<?php echo base_url() . "/public/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" ?>"rel="stylesheet">
        <link href="<?php echo base_url() . "/public/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" ?>" rel="stylesheet">
        <link href="<?php echo base_url() . "/public/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" ?>" rel="stylesheet">
        <link href="<?php echo base_url() . "/public/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" ?>" rel="stylesheet">
        <link href="<?php echo base_url() . "/public/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" ?>"rel="stylesheet">

        <!-- Custom Theme Style -->
        <link href="<?php echo base_url() . "/public/build/css/custom.min.css" ?>" rel="stylesheet">
    </head>
</body>
<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar" style="border: 0;">
                    </div>

                    <div class="clearfix"></div>

                    <!-- menu profile quick info -->
                    <div class="profile clearfix">
                        <div class="profile_pic">
                            <img src="<?=base_url();?>/public/images/img.jpg" alt="..." class="img-circle profile_img">
                        </div>
                        <div class="profile_info">
                            <span>Bienvenido,</span>
                            <h2><?php echo $_SESSION['nombre']; ?></h2>
                        </div>
                    </div>
                    <!-- /menu profile quick info -->

                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                            <h3>General</h3>
                            <?php echo $menu; ?>
                        </div>
                        <div class="menu_section">
                            <h3></h3>
                            <ul class="nav side-menu">
                                <li><a href="<?php echo base_url() ?>/login/cerrar_session"><i class="fa fa-bug"></i> Cerrar Sesión <span class="fa"></span></a>
                                </li>
                            </ul>
                            </li>                  
                            </ul>
                        </div>
                    </div>
                    <!-- /sidebar menu -->

                    <!-- /menu footer buttons -->
                    <!-- /menu footer buttons -->
                </div>
            </div>
            <div class="top_nav">
                <div class="nav_menu">
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>
                    <nav class="nav navbar-nav">

                        </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- /top navigation -->
            <!-- page content -->
            <div class="right_col" role="main" id="contenido_pagina">
                   <?php echo $cont;?>
            </div>
            <!-- /page content -->

            <!-- footer content -->
            <footer>
                <div class="pull-right">
                    Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
                </div>
                <div class="clearfix"></div>
            </footer>
            <!-- /footer content -->
        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="public/vendors/validator/multifield.js"></script>
    <script src="public/vendors/validator/validator.js"></script>

    <!-- Javascript functions	-->
    <script>
        function hideshow() {
            var password = document.getElementById("password1");
            var slash = document.getElementById("slash");
            var eye = document.getElementById("eye");

            if (password.type === 'password') {
                password.type = "text";
                slash.style.display = "block";
                eye.style.display = "none";
            }
            else {
                password.type = "password";
                slash.style.display = "none";
                eye.style.display = "block";
            }

        }
    </script>
    <!-- jQuery -->
    <script src="<?php echo base_url() . "/public/vendors/jquery/dist/jquery.min.js" ?>"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url() . "/public/vendors/bootstrap/dist/js/bootstrap.bundle.min.js" ?>"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url() . "/public/vendors/fastclick/lib/fastclick.js" ?>"></script>
    <!-- NProgress -->
    <script src="<?php echo base_url() . "/public/vendors/nprogress/nprogress.js" ?>"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url() . "/public/vendors/iCheck/icheck.min.js" ?>"></script>
    <!-- Datatables -->
    <script src="<?php echo base_url() . "/public/vendors/datatables.net/js/jquery.dataTables.min.js" ?>"></script>
    <script src="<?php echo base_url() . "/public/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js" ?>"></script>
    <script src="<?php echo base_url() . "/public/vendors/datatables.net-buttons/js/dataTables.buttons.min.js" ?>"></script>
    <script src="<?php echo base_url() . "/public/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js" ?>"></script>
    <script src="<?php echo base_url() . "/public/vendors/datatables.net-buttons/js/buttons.flash.min.js" ?>"></script>
    <script src="<?php echo base_url() . "/public/vendors/datatables.net-buttons/js/buttons.html5.min.js" ?>"></script>
    <script src="<?php echo base_url() . "/public/vendors/datatables.net-buttons/js/buttons.print.min.js" ?>"></script>
    <script src="<?php echo base_url() . "/public/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js" ?>"></script>
    <script src="<?php echo base_url() . "/public/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js" ?>"></script>
    <script src="<?php echo base_url() . "/public/vendors/datatables.net-responsive/js/dataTables.responsive.min.js" ?>"></script>
    <script src="<?php echo base_url() . "/public/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js" ?>"></script>
    <script src="<?php echo base_url() . "/public/vendors/datatables.net-scroller/js/dataTables.scroller.min.js" ?>"></script>
    <script src="<?php echo base_url() . "/public/vendors/jszip/dist/jszip.min.js" ?>"></script>
    <script src="<?php echo base_url() . "/public/vendors/pdfmake/build/pdfmake.min.js" ?>"></script>
    <script src="<?php echo base_url() . "/public/vendors/pdfmake/build/vfs_fonts.js" ?>"></script>

    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url() . "/public/build/js/custom.min.js" ?>"></script>

</body>
</html>