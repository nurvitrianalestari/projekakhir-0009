<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$path_adm=base_url()."an-theme/admin";

?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>SPK Kepuasan Pasien Rawat Inap | Log in</title>

    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/logo-rs-qim.png'); ?>; ?>" />
    <!-- Bootstrap 3.3.4 -->
    <link href="<?php echo $path_adm; ?>/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

    <!-- Font Awesome Icons -->
    <link href="<?php echo $path_adm; ?>/plugins/font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo $path_adm; ?>/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="<?php echo base_url() ?>tenant/login"><img src="<?php echo base_url('assets/images/logo-rs-qim.png');?>" style="border-radius: 10%;"> </a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Silahkan Login</p>
        <?php 
        if($status==1){
          ?>
          <div class="alert alert-danger" role="alert">
            <span class='glyphicon glyphicon-alert'></span> Username atau password salah!
          </div>
          <?php 
        }
        ?>
        <form action="<?php echo base_url() ?>tenant/proseslogin" method="POST">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" required='required' name='npm' placeholder="Username"/>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" required='required' name='password' placeholder="Password"/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
              <div class="col-xs-4">
                <button type="submit" class="btn btn-warning btn-block btn-flat">Masuk</button>
              </div><!-- /.col -->
              <div class="col-xs-8">
                <span class='pull-right' ><a class="btn btn-info-flat text-orange" href="#">Daftar Menjadi Pasien</a></span>
              </div>
            </div>
          </div>

        

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="<?php echo $path_adm; ?>/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo $path_adm; ?>/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

  </body>
</html>