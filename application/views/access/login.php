<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Employee Portal</title>
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
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  
  <body class="login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="<?=base_url();?>"><img src="<?=base_url();?>assets/images/happiests-logo.png" /></a>
      </div><!-- /.login-logo -->
      
      <?php
      if($this->session->flashdata('WrongDetailsUser')){
       /* echo "<div class='alert alert-danger alert-dismissible' role='alert'>".$this->session->flashdata('WrongDetailsUser')."
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        </div>";*/
          echo '<div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                    '.$this->session->flashdata('WrongDetailsUser').'
                  </div>';
      }
      if($this->session->flashdata('AccountNotActive')){
        /*echo "<div class='alert alert-danger alert-dismissible' role='alert'>".$this->session->flashdata('AccountNotActive')."
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        </div>";*/
          echo '<div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                    '.$this->session->flashdata('AccountNotActive').'
                  </div>';
      }
      ?>
      <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <?php 
            echo validation_errors('<div class="alert alert-danger"><button class="close" data-dismiss="alert" type="button">Ã—</button>','</div>');
            echo form_open('access/validate'); 
        ?>
          <div class="form-group has-feedback">
              <input type="text" name="username" 
                     class="form-control" placeholder="Username" autofocus="" value="<?php echo set_value('username'); ?>"/>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
              <input type="password" name="user_password" 
                     class="form-control" placeholder="Password" value="<?php echo set_value('user_password'); ?>"/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">    
              <div class="checkbox icheck">
                <label>
                  <input type="checkbox"> Remember Me
                </label>
              </div>                        
            </div><!-- /.col -->
			  <div class="col-xs-4">
                  <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
              </div><!-- /.col -->
          </div>
        <?php echo form_close();?>
		 <div class="social-auth-links text-center">
          <p>- OR -</p>
          <a href="javascript:void();" class="btn btn-block btn-social btn-facebook btn-flat" id="facebook"><i class="fa fa-facebook"></i> Sign in using Facebook</a>
          <a href="<?php echo $login_url;?>" class="btn btn-block btn-social btn-google btn-flat" id="googleplus" );
  return false;"><i class="fa fa-google-plus"></i> Sign in using Google+</a>
        </div><!-- /.social-auth-links -->
        
        <a href="<?php base_url(); ?>access/forgot_password">I forgot my password</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="<?php base_url(); ?>access/forgot_username">I forgot my username</a><br>
        <div class="social-auth-links text-center">
          <p><a href="http://www.virtuos.com" target="_blank">Virtuos Solution Pvt Ltd</a>. &copy; 2016
              <br>
             Versi 1.0.0 
          </p>
        </div><!-- /.social-auth-links -->
      </div><!-- /.login-box-body -->
      
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.3 -->
    <script src="<?=base_url('assets/plugins/jQuery/jQuery-2.1.3.min.js');?>"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?=base_url('assets/bootstrap/js/bootstrap.min.js');?>" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="<?=base_url('assets/plugins/iCheck/icheck.min.js');?>" type="text/javascript"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
    <div id="fb-root"></div>

   <script type="text/javascript">
  window.fbAsyncInit = function() {
	  //Initiallize the facebook using the facebook javascript sdk
     FB.init({ 
       appId:'<?php echo $this->config->item('appID'); ?>', // App ID 
	   cookie:true, // enable cookies to allow the server to access the session
       status:true, // check login status
	   xfbml:true, // parse XFBML
	   oauth : true //enable Oauth 
     });
   };
   //Read the baseurl from the config.php file
   (function(d){
           var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
           if (d.getElementById(id)) {return;}
           js = d.createElement('script'); js.id = id; js.async = true;
           js.src = "//connect.facebook.net/en_US/all.js";
           ref.parentNode.insertBefore(js, ref);
         }(document));
	//Onclick for fb login
 $('#facebook').click(function(e) {
    FB.login(function(response) {
	  if(response.authResponse) {
		  parent.location ='<?=base_url();?>access/fblogin'; //redirect uri after closing the facebook popup
	  }
 },//{scope: 'email,publish_stream,user_birthday,user_location,user_work_history,user_hometown,user_photos'}
 	{scope: 'email,public_profile,user_friends,user_birthday'}
 ); //permissions for facebook
});
   </script>
  </body>
  
</html>
<?php

/* 
 * ***************************************************************
 * Script : 
 * Version : 
 * Date :
 * Author : Raman.
 * Email : raman.katyal@virtuos.com
 * Description : 
 * ***************************************************************
 */

