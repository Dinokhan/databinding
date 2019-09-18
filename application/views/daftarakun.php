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

    <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>

<body style="background:#F7F7F7;">
    
    <div class="">
        <a class="hiddenanchor" id="toregister"></a>
        <a class="hiddenanchor" id="tologin"></a>

        <div id="wrapper">
            <div id="login" class="animate form">
                <section class="login_content">
                    <form action="<?php echo site_url('Awalcontroller/saveakun') ?>" method="post">
                        <h1>Daftar Akun Bonek</h1>
                        <div>
                            <input type="text" name="nama" class="form-control" placeholder="Nama" required="" autofocus/>
                        </div>
                        <div>
                            <input type="text" name="email" class="form-control" placeholder="Email" required=""/>
                        </div>
                        <div>
                            <input type="text" name="username" class="form-control" placeholder="Username" required=""/>
                        </div>
                        <div>
                            <input type="password" class="form-control" name="password" placeholder="Password" required="" />
                        </div>
                        <div>
                            <button class="btn btn-default submit" type="submit">Save</button>
                        </div>
                        <div class="clearfix"></div>
                        <div class="separator">
                            <br />
                            <div>
                                <h1>E-Tiket</h1>

                                <p>©2018 E-Tiket</p>
                            </div>
                        </div>
                    </form>
                </section>
                <!-- content -->
            </div>
        </div>
    </div>

</body>

</html>