<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Lockscreen</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="<?=base_url('assets/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <!--<link href="<?=base_url('assets/bootstrap/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css" />

	<!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link href="<?=base_url('assets/dist/css/AdminLTE.min.css');?>" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="<?=base_url('assets/plugins/iCheck/square/blue.css');?>" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition lockscreen">
    <!-- Automatic element centering -->
    <div class="lockscreen-wrapper">
      <div class="lockscreen-logo">
        <!-- <a href="../../assets/index2.html"><b>Admin</b>LTE</a> -->
        <a href="<?=base_url();?>"><img src="<?=base_url();?>assets/images/happiests-logo.png" /></a>
      </div>
      <!-- User name -->
      <div class="lockscreen-name">John Doe</div>

      <!-- START LOCK SCREEN ITEM -->
      <div class="lockscreen-item">
        <!-- lockscreen image -->
        <div class="lockscreen-image">
          <img src="../../assets/dist/img/user1-128x128.jpg" alt="User Image">
        </div>
        <!-- /.lockscreen-image -->

        <!-- lockscreen credentials (contains the form) -->
        <form class="lockscreen-credentials">
          <div class="input-group">
            <input type="password" class="form-control" placeholder="New password">
            <input type="password" class="form-control" placeholder="Confirm password">
           
            <div class="input-group-btn">
              <button class="btn"><i class="fa fa-arrow-right text-muted"></i></button>
            </div>
          </div>
        </form><!-- /.lockscreen credentials -->

      </div><!-- /.lockscreen-item -->
      <div class="help-block text-center">
        Enter your password to retrieve your session
      </div>
     <!--  <div class="text-center">
        <a href="login.html">Or sign in as a different user</a>
      </div> -->
      <div class="lockscreen-footer text-center">
        Copyright &copy; 2014-2015 <b><a href="http://virtuos.com" class="text-black">Virtuos.com</a></b><br>
        All rights reserved
      </div>
    </div><!-- /.center -->

    <!-- jQuery 2.1.4 -->
    <script src="../../assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../../assets/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
