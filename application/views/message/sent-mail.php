    <!-- iCheck -->
    <link rel="stylesheet" href="<?=base_url();?>assets/plugins/iCheck/flat/blue.css">
    
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Mailbox
            <?php if ($count > 0){ ?>
            <small><?php echo $count;?> new messages</small>
            <?php } ?>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?=base_url();?>dashboard/index"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Mailbox</li>
          </ol>
        </section>
		<?php
      if($this->session->flashdata('MessageSend')){
       /* echo "<div class='alert alert-danger alert-dismissible' role='alert'>".$this->session->flashdata('WrongDetailsUser')."
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        </div>";*/
          echo '<div class="alert alert-success alert-dismissable">
                    <button class="close" data-dismiss="alert" type="button" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                    '.$this->session->flashdata('MessageSend').'
                  </div>';
      }
      ?>
      
      <?php
      if($this->session->flashdata('MessageError')){
       /* echo "<div class='alert alert-danger alert-dismissible' role='alert'>".$this->session->flashdata('WrongDetailsUser')."
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        </div>";*/
          echo '<div class="alert alert-error alert-dismissable">
                    <button class="close" data-dismiss="alert" type="button" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                    '.$this->session->flashdata('MessageError').'
                  </div>';
      }
      ?>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-3">
              <a href="<?=base_url();?>messages/compose" class="btn btn-primary btn-block margin-bottom">Compose</a>
              <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Folders</h3>
                  <div class="box-tools">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div>
                <div class="box-body no-padding">
                  <ul class="nav nav-pills nav-stacked">
                    <li ><a href="<?php echo base_url();?>messages/index"><i class="fa fa-inbox"></i> Inbox <span class="label label-primary pull-right"><?php echo $count;?></span></a></li>
                    <li class="active"><a href="<?php echo base_url();?>messages/sentmail"><i class="fa fa-envelope-o"></i> Sent<span class="label label-primary pull-right"><?php echo $total_records;?></span></a></li>
                   <!--  <li><a href="#"><i class="fa fa-file-text-o"></i> Drafts</a></li>
                    <li><a href="#"><i class="fa fa-filter"></i> Junk <span class="label label-warning pull-right">65</span></a></li>-->
                    <li><a href="<?php echo base_url();?>messages/trash"><i class="fa fa-trash-o"></i> Trash</a></li>
                  </ul>
                </div><!-- /.box-body -->
              </div><!-- /. box -->
              <!-- <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Labels</h3>
                  <div class="box-tools">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div>
                <div class="box-body no-padding">
                  <ul class="nav nav-pills nav-stacked">
                    <li><a href="#"><i class="fa fa-circle-o text-red"></i> Important</a></li>
                    <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> Promotions</a></li>
                    <li><a href="#"><i class="fa fa-circle-o text-light-blue"></i> Social</a></li>
                  </ul>
                </div><!-- /.box-body 
              </div>-->
              <!-- /.box -->
            </div><!-- /.col -->
            <div class="col-md-9">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Sent</h3>
                  <div class="box-tools pull-right">
                    <div class="has-feedback">
                      <input type="text" class="form-control input-sm" placeholder="Search Mail">
                      <span class="glyphicon glyphicon-search form-control-feedback"></span>
                    </div>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                  <div class="mailbox-controls">
                    <!-- Check all button -->
                    <button class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button>
                    <div class="btn-group">
                      <button class="btn btn-default btn-sm" id="del_msg"><i class="fa fa-trash-o"></i></button>
                      <!-- <button class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
                      <button class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>-->
                    </div><!-- /.btn-group -->
                    <!-- <button class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>-->
                    <div class="pull-right">
                      <?php echo $offset?>-<?php echo $limit_page;?>/<?php echo $total_records;?>
                      <?php 
                      if ($total_records > $limit_page) {
                      ?>
                      <div class="btn-group">
                        <button class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                        <button class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                      </div><!-- /.btn-group -->
                      <?php } ?>
                    </div><!-- /.pull-right -->
                  </div>
                  <?php 
                  echo form_open('messages/deleteMessage',array('id' => 'myform'));
                  ?>
                  <div class="table-responsive mailbox-messages">
                    <table class="table table-hover table-striped">
                      <tbody>
                      <?php 
                 if(!empty($inbox)){  
                    
                      foreach($inbox as $display_data){
                          //print_r($display_data); die;
                      ?>
                        <tr>
                          <td><input type="checkbox" name="del_id[]" id="deleteval" value="<?php echo $display_data['id']."_".$display_data['user_id'];?>"></td>
                          <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
                          <td class="mailbox-name"><a href="<?=base_url();?>messages/read/<?php echo $display_data['id'];?>/<?php echo $display_data['user_id'];?>"><?php echo ucwords($display_data['user_name']);?></a></td>
                          <td class="mailbox-subject"><b><?php echo substr($display_data['subject'],0,20);?></b> - <p><?php echo strip_tags(substr($display_data['body'],0,55));?>...</p></td>
                          <td class="mailbox-attachment">
                          <?php 
                          if(isset($display_data['retval']) && (!empty($display_data['retval']) || count($display_data['retval']) > 0)){
                          ?>
                          <i class="fa fa-paperclip"></i>
                          <?php } ?>
                          </td>
                          <td class="mailbox-date"><?php echo timeAgo($display_data['cdate']);?></td>
                        </tr>
                        <?php } 
                     }else{
                        ?>
                        	<tr>
                        	<td colspan="5" align="center">No Message Found</td>
                        	</tr>
                    <?php } ?>    
                       
                      </tbody>
                    </table><!-- /.table -->
                  </div><!-- /.mail-box-messages --></form>
                </div><!-- /.box-body -->
                <div class="box-footer no-padding">
                  <div class="mailbox-controls">
                    <!-- Check all button -->
                    <button class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button>
                    <div class="btn-group">
                      <button class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                      <!-- <button class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
                      <button class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>-->
                    </div><!-- /.btn-group -->
                   <!--   <button class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>-->
                    <div class="pull-right">
                      <?php echo $offset?>-<?php echo $limit_page;?>/<?php echo $total_records;?>
                      <?php 
                      if ($total_records > $limit_page) {
                      ?>
                      <div class="btn-group">
                        <button class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                        <button class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                      </div><!-- /.btn-group -->
                      <?php } ?>
                    </div><!-- /.pull-right -->
                  </div>
                </div>
              </div><!-- /. box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      
      <!-- iCheck -->
    <script src="<?=base_url();?>assets/plugins/iCheck/icheck.min.js"></script>
    <!-- Page Script -->
    <script>
      $(function () {
        //Enable iCheck plugin for checkboxes
        //iCheck for checkbox and radio inputs
        $('.mailbox-messages input[type="checkbox"]').iCheck({
          checkboxClass: 'icheckbox_flat-blue',
          radioClass: 'iradio_flat-blue'
        });

        //Enable check and uncheck all functionality
        $(".checkbox-toggle").click(function () {
          var clicks = $(this).data('clicks');
          if (clicks) {
            //Uncheck all checkboxes
            $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
            $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
          } else {
            //Check all checkboxes
            $(".mailbox-messages input[type='checkbox']").iCheck("check");
            $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
          }
          $(this).data("clicks", !clicks);
        });

        //Handle starring for glyphicon and font awesome
        $(".mailbox-star").click(function (e) {
          e.preventDefault();
          //detect type
          var $this = $(this).find("a > i");
          var glyph = $this.hasClass("glyphicon");
          var fa = $this.hasClass("fa");

          //Switch states
          if (glyph) {
            $this.toggleClass("glyphicon-star");
            $this.toggleClass("glyphicon-star-empty");
          }

          if (fa) {
            $this.toggleClass("fa-star");
            $this.toggleClass("fa-star-o");
          }
        });
        $('#del_msg').click(function() {
			  $( "#myform" ).submit();
		});
      });
    </script>
    <!-- AdminLTE for demo purposes -->
