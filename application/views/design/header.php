<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Employee Portal</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="<?=base_url('assets/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css" />
    <link href="<?=base_url();?>assets/plugins/magicsuggest/magicsuggest.css" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link href="<?=base_url('assets/plugins/fontawesome/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link href="<?=base_url('assets/plugins/ionicons/css/ionicons.min.css');?>" rel="stylesheet" type="text/css" />
    <!-- DATA TABLES -->
    <link href="<?=base_url('assets/plugins/datatables/dataTables.bootstrap.css');?>" rel="stylesheet" type="text/css" />
      
    <!-- Theme style -->
    <link href="<?=base_url('assets/dist/css/AdminLTE.css');?>" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?=base_url('assets/dist/css/skins/_all-skins.css');?>" rel="stylesheet" type="text/css" />
	
	<!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="<?=base_url();?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    
    <!-- jQuery 2.1.3 -->
    <script src="<?=base_url('assets/plugins/jQuery/jQuery-2.1.3.min.js');?>"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?=base_url('assets/bootstrap/js/bootstrap.min.js');?>" type="text/javascript"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="<?=base_url('assets/plugins/slimScroll/jquery.slimscroll.min.js');?>" type="text/javascript"></script>    
    <!-- FastClick -->
    <script src='<?=base_url('assets/plugins/fastclick/fastclick.min.js');?>'></script>
    <!-- AdminLTE App -->
    <script src="<?=base_url('assets/dist/js/app.min.js');?>" type="text/javascript"></script>
    <!-- DATA TABES SCRIPT -->
    <script src="<?=base_url('assets/plugins/datatables/jquery.dataTables.js');?>" type="text/javascript"></script>
    <script src="<?=base_url('assets/plugins/datatables/dataTables.bootstrap.js');?>" type="text/javascript"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="<?=base_url();?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
  </head>
  <body class="skin-blue sidebar-mini wysihtml5-supported">
    <div class="wrapper">
      
      <header class="main-header">
        <!-- Logo -->
        <a href="<?=base_url();?>" class="logo">
        <span class="logo-mini">H</span>
        <span class="logo-lg"><img src="<?=base_url();?>assets/images/happiests-logo.png" /></span></a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              <li class="dropdown messages-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-envelope-o"></i>
                  <span class="label label-success"><?php echo is_array($top_messages) ? count($top_messages) : $top_messages;?></span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have <?php echo is_array($top_messages) ? count($top_messages).' messages' :  ($top_messages).' message';?> </li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                    <?php 
                    $department_array = array('VCEX' => 'Executive Management','YMWD' => 'UX & Web Development Team','VCPS' => 'Consultare Proffessional Team','VQA' => 'Consulare Quality Team','YMIM' => 'Internet Marketing Team','YMCD' => 'Content Development Team','HRAA' => 'HR/Account Team','GIFTCART' => 'Giftcart Team','VCBD' => 'Virtuos Cloud Business Team','CSVG' => 'Customer Service Team');
                 if (!empty($top_messages)){   
                    foreach($top_messages as $new_msg){
                       // print_r($new_msg);
                    ?>
                      <li><!-- start message -->
                        <a href="<?php echo base_url(); ?>messages/read/<?php echo $new_msg['notification_type_id'];?>">
                          <div class="pull-left">
                          <?php 
                          if (file_exists('uploads/profile/'.$new_msg['sender_data']['user_photo']) && !empty($new_msg['sender_data']['user_photo'])){
                           ?>
                            <img src="<?=base_url('uploads/profile/'.$new_msg['sender_data']['user_photo']);?>" class="img-circle" alt="<?php echo $new_msg['sender_data']['name'];?>"/>
                           <?php }else{?>
                               <div class="circle">
                                  <div class="inner-circle"><?php echo ucfirst($new_msg['sender_data']['name'][0]);?></div>
                               </div>
                           <?php } ?>
                          </div>
                          <h4>
                            <?php echo $department_array[$new_msg['sender_data']['department']];?>
                            <small><i class="fa fa-clock-o"></i> <?php echo timeAgo($new_msg['time_notification']);?></small>
                          </h4>
                          <p><?php echo $new_msg['notification_message'];?></p>
                        </a>
                      </li><!-- end message -->
                      
                      <?php }
                 }
                      ?>
                      
                    </ul>
                  </li>
                  <li class="footer"><a href="#">See All Messages</a></li>
                </ul>
              </li>
              <!-- Notifications: style can be found in dropdown.less -->
              <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-bell-o"></i>
                  <span class="label label-warning"><?php echo is_array($top_notification) ? count($top_notification) : $top_notification;?></span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have <?php echo is_array($top_notification) ? count($top_notification).' notifications' :  ($top_notification).' notification';?></li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                    <?php 
                    
                if(!empty($top_notification)){    
                    foreach($top_notification as $new_notifications){
                    ?>
                      
                      <?php 
                      if($new_notifications['notification_type'] == "Notice"){
						  ?>
						  <li><a href="<?php echo base_url(); ?>home"><?php echo $new_notifications['notification_message']; ?></a></li>
						  <?php
					  }
					  if($new_notifications['notification_type'] == "Idea"){
					      ?>
					  						  <li><a href="<?php echo base_url(); ?>idea/all"><?php echo $new_notifications['notification_message']; ?></a></li>
					  						  <?php
					  					  }
					  
					  if($new_notifications['notification_type'] == "Repair"){
						  ?>
						  <li><a href="<?php echo base_url(); ?>issues/all"><?php echo $new_notifications['notification_message']; ?></a></li>
						  <?php
					  }
					  if($new_notifications['notification_type'] == "Expense"){
						  ?>
						  <li><a href="<?php echo base_url(); ?>expenses/all"><?php echo $new_notifications['notification_message']; ?></a></li>
						  <?php
					  }
					  if($new_notifications['notification_type'] == "Internet Issue"){
						  ?>
						  <li><a href="<?php echo base_url(); ?>issues/all"><?php echo $new_notifications['notification_message']; ?></a></li>
						  <?php
					  }
					  if($new_notifications['notification_type'] == "Leave"){
						  ?>
						  <li><a href="<?php echo base_url(); ?>leaves/all"><?php echo $new_notifications['notification_message']; ?></a></li>
						  <?php
					  }
					  
					  if($new_notifications['notification_type'] == "Outdoor Visit"){
						  ?>
						  <li class="divider"></li>
						  <li><a href="<?php echo base_url(); ?>outdoor_visits/all"><?php echo $new_notifications['notification_message']; ?></a></li>
						  <li class="divider"></li>
						  <?php
				   }
				   ?>
                     
                      <?php } 
                }
                      ?>
                    </ul>
                  </li>
                  <li class="footer"><a href="#">View all</a></li>
                </ul>
              </li>
              <!-- Tasks: style can be found in dropdown.less -->
              <li class="dropdown tasks-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-flag-o"></i>
                  <span class="label label-danger">9</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 9 tasks</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                      <li><!-- Task item -->
                        <a href="#">
                          <h3>
                            Design some buttons
                            <small class="pull-right">20%</small>
                          </h3>
                          <div class="progress xs">
                            <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                              <span class="sr-only">20% Complete</span>
                            </div>
                          </div>
                        </a>
                      </li><!-- end task item -->
                      <li><!-- Task item -->
                        <a href="#">
                          <h3>
                            Create a nice theme
                            <small class="pull-right">40%</small>
                          </h3>
                          <div class="progress xs">
                            <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                              <span class="sr-only">40% Complete</span>
                            </div>
                          </div>
                        </a>
                      </li><!-- end task item -->
                      <li><!-- Task item -->
                        <a href="#">
                          <h3>
                            Some task I need to do
                            <small class="pull-right">60%</small>
                          </h3>
                          <div class="progress xs">
                            <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                              <span class="sr-only">60% Complete</span>
                            </div>
                          </div>
                        </a>
                      </li><!-- end task item -->
                      <li><!-- Task item -->
                        <a href="#">
                          <h3>
                            Make beautiful transitions
                            <small class="pull-right">80%</small>
                          </h3>
                          <div class="progress xs">
                            <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                              <span class="sr-only">80% Complete</span>
                            </div>
                          </div>
                        </a>
                      </li><!-- end task item -->
                    </ul>
                  </li>
                  <li class="footer">
                    <a href="#">View all tasks</a>
                  </li>
                </ul>
              </li>
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                
                <?php 
                if (!empty($user_photo) && file_exists('uploads/profile/'.$user_photo)){
                ?>
                	<img src="<?=base_url('uploads/profile/'.$user_photo);?>" class="user-image" alt="<?php echo ucfirst($user_first_name);?> <?php echo ucfirst($user_last_name);?>"/>
               <?php }else {?>
               			<div class="circle">
                                  <div class="inner-circle_1"><?php echo ucfirst($user_first_name[0]);?></div>
                        </div>
               <?php } ?> 	
                  <span class="hidden-xs"><?php echo ucfirst($user_first_name);?> <?php echo ucfirst($user_last_name);?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                  
                  <?php 
                if (!empty($user_photo) && file_exists('uploads/profile/'.$user_photo)){
                ?>
                	<img src="<?=base_url('uploads/profile/'.$user_photo);?>" class="img-circle" alt="<?php echo ucfirst($user_first_name);?> <?php echo ucfirst($user_last_name);?>"/>
               <?php }?>
                    <p>
                      <?php echo ucfirst($user_first_name);?> <?php echo ucfirst($user_last_name);?> - <?php echo $department_array[$user_department];?>
                      <small>Member since <?php echo date('M Y', strtotime($user_create_date));?></small>
                    </p>
                  </li>
                  <!-- Menu Body -->
                  <li class="user-body">
                    <div class="col-xs-4 text-center">
                      <a href="#">KPI</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">KRA</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Friends</a>
                    </div>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left bg-red">
                      <a href="<?=base_url();?>users/profile" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right bg-green">
                      <a href="<?=base_url();?>access/logout" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
            <?php 
                if (!empty($user_photo) && file_exists('uploads/profile/'.$user_photo)){
                ?>
                	<img src="<?=base_url('uploads/profile/'.$user_photo);?>" class="img-circle" alt="<?php echo ucfirst($user_first_name);?> <?php echo ucfirst($user_last_name);?>"/>
               <?php }else {?>
               			<div class="circle">
                                  <div class="inner-circle_2"><?php echo ucfirst($user_first_name[0]);?></div>
                        </div>
               <?php } ?> 
            </div>
            <div class="pull-left info">
              <p><?php echo ucfirst($user_first_name);?> <?php echo ucfirst($user_last_name);?></p>

              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- search form -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <?php
			 $this->load->view('design/leftsidebar.php'); 
		  ?>
        </section>


      </aside>

      