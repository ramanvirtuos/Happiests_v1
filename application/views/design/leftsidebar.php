<ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="<?php echo ($page == 'Dashboard')?'active':'';?> treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="active"><a href="<?php echo base_url();?>dashboard/"><i class="fa fa-check-square"></i> Dashboard v1</a></li>
                <li><a href="index2.html"><i class="fa fa-check-square"></i> Dashboard v2</a></li>
              </ul>
            </li>
            <li class="<?php echo ($page == 'Notice Board')?'active':'';?> treeview">
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span>Notice Board</span>
                <span class="label label-primary pull-right">4</span>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/layout/top-nav.html"><i class="fa fa-check-square"></i> Add New Post</a></li>
                <li><a href="pages/layout/boxed.html"><i class="fa fa-check-square"></i> View Archive Post</a></li>
               <!-- <li><a href="pages/layout/fixed.html"><i class="fa fa-check-square"></i> Fixed</a></li>
                  <li><a href="pages/layout/collapsed-sidebar.html"><i class="fa fa-circle-o"></i> Collapsed Sidebar</a></li>-->
              </ul>
            </li>
            <li class="<?php echo ($page == 'Message')?'active':'';?> treeview">
              <a href="<?php echo base_url();?>messages">
               
               <i class="fa fa-envelope"></i> <span>Mailbox</span>
               <?php 
                if ($page != 'Message'){
               ?> 
               <small class="label pull-right bg-yellow"><?php echo ($count > 0)? $count:''?></small>
                <?php } ?>
              </a>
              <ul class="treeview-menu">
                <li class="active"><a href="<?php echo base_url();?>messages/index"><i class="fa fa-inbox"></i>Inbox
                <?php 
                if ($page == 'Message'){
               ?> 
               <span class="label label-primary pull-right"><?php echo ($count > 0)? $count:''?></span>
                <?php } ?> 
                
                </a></li>
                <li><a href="<?php echo base_url();?>messages/compose"><i class="fa fa-paper-plane"></i>Compose</a></li>
                <li><a href="<?php echo base_url();?>messages/sentmail"><i class="fa fa-paper-plane"></i>Sent</a></li>
                <!-- <li><a href="<?php echo base_url();?>messages/read">Read</a></li>-->
              </ul>
            </li>
            <li>
              <a href="pages/widgets.html">
                <i class="fa fa-th"></i> <span>Projects</span> <small class="label pull-right bg-green">new</small>
              </a>
            </li>
            <li>
              <a href="pages/mailbox/mailbox.html">
                <i class="fa fa-user"></i> <span>List of Employees</span>
                <small class="label pull-right bg-yellow">12</small>
                <ul class="treeview-menu">
          		<li><a href="<?php echo base_url();?>employees/add"><i class="fa fa-user"></i>Add New Employee</a></li>
          		<li><a href="<?php echo base_url();?>employees/list"><i class="fa fa-users"></i>Employee List</a></li>
          		<!-- <li><a href="pages/tables/simple.html"><i class="fa fa-check-square"></i>Add New Employee</a></li>-->
              </ul>
              </a>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-pie-chart"></i>
                <span>Reports</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/charts/chartjs.html"><i class="fa fa-check-square"></i> ChartJS</a></li>
                <li><a href="pages/charts/morris.html"><i class="fa fa-check-square"></i> Morris</a></li>
                <li><a href="pages/charts/flot.html"><i class="fa fa-check-square"></i> Flot</a></li>
                <li><a href="pages/charts/inline.html"><i class="fa fa-check-square"></i> Inline charts</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>Documents</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/UI/general.html"><i class="fa fa-check-square"></i>Upload New Document</a></li>
                <li><a href="pages/UI/icons.html"><i class="fa fa-check-square"></i> My Documents</a></li>
                <li><a href="pages/UI/buttons.html"><i class="fa fa-check-square"></i>Public Documents</a></li>
                <!-- <li><a href="pages/UI/sliders.html"><i class="fa fa-circle-o"></i> Sliders</a></li>
                <li><a href="pages/UI/timeline.html"><i class="fa fa-circle-o"></i> Timeline</a></li>
                <li><a href="pages/UI/modals.html"><i class="fa fa-circle-o"></i> Modals</a></li>-->
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-edit"></i> <span>Important Lists</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/forms/general.html"><i class="fa fa-check-square"></i> Extension List</a></li>
                <li><a href="pages/forms/advanced.html"><i class="fa fa-check-square"></i> Holidays List</a></li>
                <li><a href="pages/forms/editors.html"><i class="fa fa-check-square"></i> Manage Holiday</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-table"></i> <span>Leave Request</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
              <li><a href="pages/tables/simple.html"><i class="fa fa-check-square"></i>Available Leave Report</a></li>
                <li><a href="pages/tables/simple.html"><i class="fa fa-check-square"></i>New Leave Request</a></li>
                <li><a href="pages/tables/data.html"><i class="fa fa-check-square"></i> Applied Leave Lists</a></li>
              </ul>
            </li>
            <li>
              <a href="pages/calendar.html">
                <i class="fa fa-calendar"></i> <span>Calendar</span>
                <small class="label pull-right bg-red">3</small>
              </a>
            </li>
            <li>
              <a href="pages/mailbox/mailbox.html">
                <i class="fa fa-envelope"></i> <span>Issues/Repair</span>
                <small class="label pull-right bg-yellow">12</small>
                <ul class="treeview-menu">
          		<li><a href="pages/tables/simple.html"><i class="fa fa-check-square"></i>Add New Issue</a></li>
              </ul>
              </a>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-folder"></i> <span>Expenses</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/examples/invoice.html"><i class="fa fa-check-square"></i> Invoice</a></li>
                <li><a href="pages/examples/profile.html"><i class="fa fa-check-square"></i> Profile</a></li>
                <li><a href="pages/examples/login.html"><i class="fa fa-check-square"></i> Login</a></li>
                <li><a href="pages/examples/register.html"><i class="fa fa-check-square"></i> Register</a></li>
                <li><a href="pages/examples/lockscreen.html"><i class="fa fa-check-square"></i> Lockscreen</a></li>
                <li><a href="pages/examples/404.html"><i class="fa fa-check-square"></i> 404 Error</a></li>
                <li><a href="pages/examples/500.html"><i class="fa fa-check-square"></i> 500 Error</a></li>
                <li><a href="pages/examples/blank.html"><i class="fa fa-check-square"></i> Blank Page</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-share"></i> <span>Attendence</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-check-square"></i> Level One</a></li>
                <li>
                  <a href="#"><i class="fa fa-check-square"></i> Level One <i class="fa fa-angle-left pull-right"></i></a>
                  
                </li>
                <li><a href="#"><i class="fa fa-check-square"></i> Level One</a></li>
              </ul>
            </li>
            <li>
              <a href="pages/calendar.html">
                <i class="fa fa-calendar"></i> <span>Email Templates</span>
              </a>
            </li>
            <li>
              <a href="pages/calendar.html">
                <i class="fa fa-calendar"></i> <span>Outdoor Visit</span>
                <small class="label pull-right bg-red">3</small>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-check-square"></i> New Outdoor Request</a></li>
                <li>
                  <a href="#"><i class="fa fa-check-square"></i> All Outdoor Visit Requests</i></a>
                  
                </li>
              </ul>
            </li>
            
          </ul>