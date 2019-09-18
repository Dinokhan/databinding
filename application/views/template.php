<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>E-Tiket </title>

    <!-- Bootstrap core CSS -->

    <link href="<?php echo base_url() ?>asset/css/bootstrap.min.css" rel="stylesheet">

    <link href="<?php echo base_url() ?>asset/fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>asset/css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="<?php echo base_url() ?>asset/css/custom.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>asset/css/icheck/flat/green.css" rel="stylesheet">


    <script src="<?php echo base_url() ?>asset/js/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>asset/js/jszip.min.js"></script>

    <!-- knockout -->
    <script src="<?php echo base_url() ?>asset/js/knockout/knockout-3.1.0.js"></script>
    <script src="<?php echo base_url() ?>asset/js/knockout/knockout.mapping-latest.js"></script>
    <script src="<?php echo base_url() ?>asset/js/linq.js"></script>
    <script src="<?php echo base_url() ?>asset/js/underscore.min.js"></script>
    <script src="<?php echo base_url() ?>asset/js/moment.min.js"></script>
    <script src="<?php echo base_url() ?>asset/js/FileSaver.min.js"></script>
  <script src="<?php echo base_url() ?>asset/js/knockout/knockout-file-bindings.js"></script>
  <link href="<?php echo base_url() ?>asset/js/knockout/knockout-file-bindings.css" rel="stylesheet">

    <link href="<?php echo base_url() ?>asset/css/datatables/tools/css/dataTables.tableTools.css" rel="stylesheet">

    <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>

<script>
    var model = {
        Processing: ko.observable(true)
    }

</script>

<body class="nav-md">

    <div class="container body">


        <div class="main_container">

            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">

                    <div class="navbar nav_title" style="border: 0;">
                        <a href="index.html" class="site_title"> <span>E-Tiket</span></a>
                    </div>
                    <div class="clearfix"></div>

                    <!-- menu prile quick info -->
                    <div class="profile">
                        <div class="profile_pic">
<!--                             <img src="<?php echo base_url() ?>asset/images/sato1.jpg" alt="..." class="img-circle profile_img"> -->
                        </div>
                        <div class="profile_info">
                            <span>Welcome,</span>
                            <h2>Admin</h2>
                        </div>
                    </div>
                    <!-- /menu prile quick info -->

                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

                        <div class="menu_section">
                            <h3>General</h3>
                            <ul class="nav side-menu">
                                <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="<?php echo site_url('Dashboardcontroller/')?>">Dashboard</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-edit"></i> Master <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="<?php echo site_url('Usercontroller/')?>">Karyawan</a>
                                        </li>
                                        <li><a href="<?php echo site_url('Promocontroller/')?>">Promo</a>
                                        </li>
                                        <li><a href="<?php echo site_url('Membercontroller/')?>">Daftar Member & Cetak Kartu</a>
                                        </li>
                                        <li><a href="<?php echo site_url('Kelascontroller/')?>">Kelas</a>
                                        </li>
                                        <li><a href="<?php echo site_url('Stadioncontroller/')?>">Stadion</a>
                                        </li>
                                        <li><a href="<?php echo site_url('Timcontroller/')?>">Tim</a>
                                        </li>
                                        <li><a href="<?php echo site_url('Jadwalcontroller/')?>">Jadwal</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-desktop"></i> Transaction <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="<?php echo site_url('Penjualannewcontroller/')?>">Penjualan</a>
                                    </ul>
                                </li>
                                <?php if ($login['Role'] == "manager"){ ?>
                                <li><a><i class="fa fa-bar-chart-o"></i> Report <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="<?php echo site_url('Rekappesancontroller/')?>">Laporan Penjualan</a>
                                        </li>
                                        <li><a href="<?php echo site_url('Rekappesancontroller/member')?>">Laporan Member</a>
                                        </li>
                                    </ul>
                                </li>
                                <?php } ?>
                                <li><a href="<?php echo site_url('loginController/logoutUser')?>"><i class="glyphicon glyphicon-off"></i> &nbsp;&nbsp;Logout</a></li>
                            </ul>
                        </div>

                    </div>
                    <!-- /sidebar menu -->

                    <!-- /menu footer buttons -->
                    <div class="sidebar-footer hidden-small">
                        <a href="<?php echo site_url('loginController/logoutUser')?>" data-toggle="tooltip" data-placement="top" title="Logout">
                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                        </a>
                    </div>
                    <!-- /menu footer buttons -->
                </div>
            </div>

            <!-- top navigation -->
            
            <!-- /top navigation -->

            <!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                    <?php if (!empty($page)): ?>
                        <?php $this->load->view($page); ?>
                    <?php else: ?>
                        <?php $this->load->view('error_page'); ?>
                    <?php endif; ?>
                </div>

                <!-- footer content -->
                <footer>
                    <div class="">
                        <p class="pull-right">
                            <span class="lead"> Etiket</span>
                        </p>
                    </div>
                    <div class="clearfix"></div>
                </footer>
                <!-- /footer content -->

            </div>
            <!-- /page content -->
        </div>

    </div>

    <div id="custom_notifications" class="custom-notifications dsp_none">
        <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
        </ul>
        <div class="clearfix"></div>
        <div id="notif-group" class="tabbed_notifications"></div>
    </div>

    <script src="<?php echo base_url() ?>asset/js/bootstrap.min.js"></script>

    <!-- chart js -->
    <script src="<?php echo base_url() ?>asset/js/chartjs/chart.min.js"></script>
    <!-- bootstrap progress js -->
    <script src="<?php echo base_url() ?>asset/js/progressbar/bootstrap-progressbar.min.js"></script>
    <script src="<?php echo base_url() ?>asset/js/nicescroll/jquery.nicescroll.min.js"></script>
    <!-- icheck -->
    <script src="<?php echo base_url() ?>asset/js/icheck/icheck.min.js"></script>

    <script src="<?php echo base_url() ?>asset/js/custom.js"></script>

    <!-- moris js -->
    <script src="<?php echo base_url() ?>asset/js/moris/raphael-min.js"></script>
    <script src="<?php echo base_url() ?>asset/js/moris/morris.js"></script>
    <script src="<?php echo base_url() ?>asset/js/moris/example.js"></script>

    <script src="<?php echo base_url() ?>asset/js/datatables/js/jquery.dataTables.js"></script>
    <script src="<?php echo base_url() ?>asset/js/datatables/tools/js/dataTables.tableTools.js"></script>

</body>

</html>

<script>
    function ajaxPost(url, data, callbackSuccess, callbackError, otherConfig) {
        var startReq = moment();
        var callbackScheduler = function (callback) {
            callback();
        };

        if (typeof callbackSuccess == "object") {
            otherConfig = callbackSuccess;
            callbackSuccess = function () { };
            callbackError = function () { };
        } 

        if (typeof callbackError == "object") {
            otherConfig = callbackError;
            callbackError = function () { };
        } 

        var config = {
            url: url,
            type: 'post',
            dataType: 'json',
            contentType: 'application/json; charset=utf-8',
            data: ko.mapping.toJSON(data),
            success: function (a) {
                callbackScheduler(function () {
                    if (callbackSuccess !== undefined) {
                        callbackSuccess(a);
                    }
                });
            },
            error: function (a, b, c) {
                callbackScheduler(function () {
                    if (callbackError !== undefined) {
                        callbackError(a, b, c);
                    }
                });
            }
        };

        if (data instanceof FormData) {
            delete config.config;
            config.data = data;
            config.async = false;
            config.cache = false;
            config.contentType = false;
            config.processData = false;
        }

        if (otherConfig != undefined) {
            config = $.extend(true, config, otherConfig);
        }

        return $.ajax(config);
    };

    ko.applyBindings(model);

    $(document).ready(function () {
        model.Processing(false);
    });
</script>