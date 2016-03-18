        <link href="//cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/4.0.1/ekko-lightbox.min.css" rel="stylesheet">

<script src="//cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/4.0.1/ekko-lightbox.min.js"></script>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Read Mail
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Mailbox</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-3">
              <a href="<?php echo base_url();?>messages/compose" class="btn btn-primary btn-block margin-bottom">Compose</a>
              <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Folders</h3>
                  <div class="box-tools">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div>
                <div class="box-body no-padding">
                  <ul class="nav nav-pills nav-stacked">
                    <li><a href="<?php echo base_url();?>messages/index"><i class="fa fa-inbox"></i> Inbox <span class="label label-primary pull-right"><?php echo $count;?></span></a></li>
                    <li><a href="<?php echo base_url();?>messages/sentmail"><i class="fa fa-envelope-o"></i> Sent</a></li>
                    <!-- <li><a href="#"><i class="fa fa-file-text-o"></i> Drafts</a></li>
                    <li><a href="#"><i class="fa fa-filter"></i> Junk <span class="label label-warning pull-right">65</span></a></li> -->
                    <li><a href="<?php echo base_url();?>messages/trash"><i class="fa fa-trash-o"></i> Trash</a></li>
                  </ul>
                </div><!-- /.box-body -->
              </div><!-- /. box -->
             <!--  <div class="box box-solid">
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
                  <h3 class="box-title">Read Mail</h3>
                  <div class="box-tools pull-right">
                    <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Previous"><i class="fa fa-chevron-left"></i></a>
                    <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Next"><i class="fa fa-chevron-right"></i></a>
                  </div>
                </div><!-- /.box-header -->
                <?php 
                
                ?>
                <div class="box-body no-padding">
                  <div class="mailbox-read-info">
                    <h3><?php echo $message_detail['subject'];?></h3>
                    <h5>From: <?php echo getUserDetails($message_detail['sender_id'],'user_o_email');?> <span class="mailbox-read-time pull-right"><?php echo date('d M Y h:i a', strtotime($message_detail['cdate']));?></span></h5>
                  </div><!-- /.mailbox-read-info -->
                  <div class="mailbox-controls with-border text-center">
                    <div class="btn-group">
                      <button class="btn btn-default btn-sm" data-toggle="tooltip" title="Delete" id="del_msg1"><i class="fa fa-trash-o"></i></button>
                      <button class="btn btn-default btn-sm" data-toggle="tooltip" title="Reply" id="reply_msg1"><i class="fa fa-reply"></i></button>
                      <!-- <button class="btn btn-default btn-sm" data-toggle="tooltip" title="Forward"><i class="fa fa-share"></i></button>-->
                    </div><!-- /.btn-group -->
                    <button class="btn btn-default btn-sm" data-toggle="tooltip" title="Print"><i class="fa fa-print"></i></button>
                  </div><!-- /.mailbox-controls -->
                  <div class="mailbox-read-message">
                    <?php echo $message_detail['body'];?>
                  </div><!-- /.mailbox-read-message -->
                </div><!-- /.box-body -->
                
                <?php 
                
                if(!empty($attachment) && count($attachment) > 0){
                    
                ?>
                <div class="box-footer">
                  <ul class="mailbox-attachments clearfix">
                    
                    <?php 
                    $subclass = '';
                    foreach ($attachment as $file){
                        $file_parts = pathinfo($file['attachment_name']);
                        $name = './uploads/messages/'.$file['attachment_name'];
                        switch($file_parts['extension'])
                        {
                            case "pdf":
                                $class = "fa-file-pdf-o";
                                $subclass = "";
                                break;
                        
                            case "docx":
                                $class = "fa-file-word-o";
                                $subclass = "";
                                break;
                                
                            case "doc":
                                $class = "fa-file-word-o";
                                $subclass = "";
                                break;
                            
                            case "jpg":
                               $class = "fa-camera";
                               $subclass = "has-img";
                                break;
                            
                            case "png":
                                $class = "fa-camera";
                                $subclass = "has-img";
                                break;
                            
                            case "gif":
                                $class = "fa-camera";
                                $subclass = "has-img";
                                break;
                            
                            case "txt":
                                $class = "fa-camera";
                                $subclass = "";
                                break;
                            case "": // Handle file extension for files ending in '.'
                            case NULL: // Handle no file extension
                                break;
                        }
                        
                    ?>
                    <li>
                      <span class="mailbox-attachment-icon <?php echo $subclass;?>"><i class="fa <?php echo $class;?>"></i></span>
                      <div class="mailbox-attachment-info">
                      <?php 
                      if (!empty($subclass)){
                      ?>
                        <a href="<?php echo base_url().$name;?>" data-toggle="lightbox" data-title="<?php echo $file['attachment_name'];?>" data-footer="A custom footer text" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i> <?php echo $file['attachment_name'];?></a>
                    <?php }else{ ?>  
                    <a href="<?php echo base_url().$name;?>" ><i class="fa fa-paperclip"></i> <?php echo $file['attachment_name'];?></a>
                    <?php } ?>  
                        <span class="mailbox-attachment-size">
                          <?php echo formatSizeUnits(filesize($name));
                          //$data = file_get_contents($name); // Read the file's contents
                         // $name = $file['attachment_name'];
                          
                          ?>
                          <a href="<?php echo base_url();?>messages/downloadfile/<?php echo $file['attachment_name'];?>" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
                        </span>
                      </div>
                    </li>
                    <?php } ?>
                    <!-- <li>
                      <span class="mailbox-attachment-icon"><i class="fa fa-file-word-o"></i></span>
                      <div class="mailbox-attachment-info">
                        <a href="#" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i> App Description.docx</a>
                        <span class="mailbox-attachment-size">
                          1,245 KB
                          <a href="#" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
                        </span>
                      </div>
                    </li>-->
                    
                  </ul>
                </div><!-- /.box-footer -->
                <?php } ?>
                <?php 
                  echo form_open('messages/deleteMessage',array('id' => 'myform'));
                  ?>
                  <input type="hidden" name="del_id[]" id="deleteval" value="<?php echo $message_detail['id'].'_'.$user_id;?>" />
                  </form>
                <div class="box-footer">
                  <div class="pull-right">
                    <button class="btn btn-default" id="reply_msg"><i class="fa fa-reply"></i> Reply</button>
                    <!-- <button class="btn btn-default"><i class="fa fa-share"></i> Forward</button>-->
                  </div>
                  <button class="btn btn-default" id="del_msg"><i class="fa fa-trash-o"></i> Delete</button>
                  <button class="btn btn-default"><i class="fa fa-print"></i> Print</button>
                </div><!-- /.box-footer -->
              </div><!-- /. box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
     <script type="text/javascript">
        	$(document).ready(function ($) {

				// delegate calls to data-toggle="lightbox"
				$(document).delegate('*[data-toggle="lightbox"]:not([data-gallery="navigateTo"])', 'click', function(event) {
					event.preventDefault();
					return $(this).ekkoLightbox({
						onShown: function() {
							if (window.console) {
								return console.log('onShown event fired');
							}
						},
						onContentLoaded: function() {
							if (window.console) {
								return console.log('onContentLoaded event fired');
							}
						},
						onNavigate: function(direction, itemIndex) {
							if (window.console) {
								return console.log('Navigating '+direction+'. Current item: '+itemIndex);
							}
						}
					});
				});

				$('#reply_msg').click(function() {
					  //$( "#myform" ).submit();
					  window.location.href = "<?php echo base_url();?>messages/replymail/<?php echo $message_detail['reply_id'];?>/<?php echo $message_detail['id'];?>";
				});

				$('#del_msg').click(function() {
					  $( "#myform" ).submit();
					  //
				});

				$('#reply_msg1').click(function() {
					  //$( "#myform" ).submit();
					  window.location.href = "<?php echo base_url();?>messages/replymail/<?php echo $message_detail['reply_id'];?>/<?php echo $message_detail['id'];?>";
				});

				$('#del_msg1').click(function() {
					  $( "#myform" ).submit();
					  //
				});
						
        });
    </script>
