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
                            <h2>Bonek</h2>
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
                                        <li><a href="<?php echo site_url('Belicontroller/')?>">Dashboard</a>
                                        </li>
                                        <li><a href="<?php echo site_url('Belicontroller/jadwal')?>">Jadwal Pertandingan</a>
                                        </li>
                                        <?php if ($login['NoMember'] != ""){ ?>
                                        <li><a href="<?php echo site_url('Belicontroller/promo')?>">Promo</a>
                                        </li>
                                        <?php } ?>
                                        <li><a href="<?php echo site_url('Belicontroller/pembelian')?>">Pembelian</a>
                                        </li>
                                        <li><a href="<?php echo site_url('Belicontroller/editprofile')?>">Edit Profile</a>
                                        </li>
                                        <li><a href="<?php echo site_url('loginController/logoutUser')?>">Logout</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>

                    </div>
                    <!-- /sidebar menu -->

                    <!-- /menu footer buttons -->
                    <div class="sidebar-footer hidden-small">
                        <!-- <a data-toggle="tooltip" data-placement="top" title="Settings">
                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                            <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Lock">
                            <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                        </a> -->
                        <a href="<?php echo site_url('loginController/logoutUser')?>" data-toggle="tooltip" data-placement="top" title="Logout">
                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                        </a>
                    </div>
                    <!-- /menu footer buttons -->
                </div>
            </div>

            <!-- top navigation -->
            <!-- <div class="top_nav">

                <div class="nav_menu">
                    <nav class="" role="navigation">
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>

                        <ul class="nav navbar-nav navbar-right">
                            <li class="">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <img src="images/img.jpg" alt="">John Doe
                                    <span class=" fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                                    <li><a href="javascript:;">  Profile</a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <span class="badge bg-red pull-right">50%</span>
                                            <span>Settings</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">Help</a>
                                    </li>
                                    <li><a href="login.html"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                                    </li>
                                </ul>
                            </li>

                            <li role="presentation" class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-envelope-o"></i>
                                    <span class="badge bg-green">6</span>
                                </a>
                                <ul id="menu1" class="dropdown-menu list-unstyled msg_list animated fadeInDown" role="menu">
                                    <li>
                                        <a>
                                            <span class="image">
                                        <img src="images/img.jpg" alt="Profile Image" />
                                    </span>
                                            <span>
                                        <span>John Smith</span>
                                            <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where... 
                                    </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <span class="image">
                                        <img src="images/img.jpg" alt="Profile Image" />
                                    </span>
                                            <span>
                                        <span>John Smith</span>
                                            <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where... 
                                    </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <span class="image">
                                        <img src="images/img.jpg" alt="Profile Image" />
                                    </span>
                                            <span>
                                        <span>John Smith</span>
                                            <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where... 
                                    </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <span class="image">
                                        <img src="images/img.jpg" alt="Profile Image" />
                                    </span>
                                            <span>
                                        <span>John Smith</span>
                                            <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where... 
                                    </span>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="text-center">
                                            <a>
                                                <strong>See All Alerts</strong>
                                                <i class="fa fa-angle-right"></i>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </li>

                        </ul>
                    </nav>
                </div>

            </div> -->
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