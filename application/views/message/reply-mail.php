<!-- fullCalendar 2.2.5-->
    <link rel="stylesheet" href="<?=base_url();?>assets/plugins/fullcalendar/fullcalendar.min.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/plugins/fullcalendar/fullcalendar.print.css" media="print">
      <!-- iCheck -->
    <link rel="stylesheet" href="<?=base_url();?>assets/plugins/iCheck/flat/blue.css">
  
    
<link href="<?=base_url();?>assets/plugins/bootstrap-fileinput/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
<!-- canvas-to-blob.min.js is only needed if you wish to resize images before upload.
     This must be loaded before fileinput.min.js -->
<script src="<?=base_url();?>assets/plugins/bootstrap-fileinput/js/plugins/canvas-to-blob.min.js" type="text/javascript"></script>
<script src="<?=base_url();?>assets/plugins/bootstrap-fileinput/js/fileinput.min.js"></script>

 
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
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Mailbox</li>
          </ol>
        </section>

<?php 

echo form_open_multipart('messages/replyMessage');?>

<input type="hidden" name="message_id" value="<?php echo $message_detail['id'];?>" />
<input type="hidden" name="reply_to_id" value = "<?php echo $message_detail['reply_id'];?>"/>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-3">
              <a href="<?php echo base_url();?>messages/index" class="btn btn-primary btn-block margin-bottom">Back to Inbox</a>
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
                    <li><a href="#"><i class="fa fa-filter"></i> Junk <span class="label label-warning pull-right">65</span></a></li>
                    -->
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
                </div><!-- /.box-header -->
               <!--   <div class="box-body no-padding">
                  <ul class="nav nav-pills nav-stacked">
                    <li><a href="#"><i class="fa fa-circle-o text-red"></i> Important</a></li>
                    <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> Promotions</a></li>
                    <li><a href="#"><i class="fa fa-circle-o text-light-blue"></i> Social</a></li>
                  </ul>
                </div><!-- /.box-body -->
             <!--  </div><!-- /.box -->
            </div><!-- /.col -->
            <div class="col-md-9">
            <?php 
            echo validation_errors('<div class="alert alert-danger"><button class="close" data-dismiss="alert" type="button">Ã—</button>','</div>');
           // print_r($message_detail);
          
            $user_o_email = getUserDetails($message_detail['reply_id'],'user_o_email');
            $suser_o_email = getUserDetails($message_detail['sender_id'],'user_o_email');
            ?>
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Reply TO: <?php echo $user_o_email;?></h3>
                  <span class="mailbox-read-time pull-right"><input type="checkbox" name="all_participant" id="all_participant" value="1" checked />&nbsp;<strong>Reply to All Participant</strong></span>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="form-group">
                    <input class="form-control" placeholder="To:" id="ms-complex-templating" name="sendEmail">
                    <input type="hidden" name="send_to" id="send_to" />
                    <input type="hidden" name="upload_images" id="attachment" />
                  </div>
                  <div class="form-group">
                    <input class="form-control" disabled placeholder="Subject:" name="subject" value="Re:&nbsp;<?php echo $message_detail['subject'];?>">
                  </div>
                  
                  <?php 
                  $str_text = "#############################################################";
                  $str_text .= "\n\n";
                  $str_text .= 'On '. date('D, M d, Y h:i a',strtotime($message_detail['cdate'])).', '.$message_detail['user_name'].' '.'<'.$suser_o_email.'> wrote:';
                  $str_text .= "\n\n";
                  ?>
                  <div class="form-group">
                  <textarea disabled name="compose-textarea" rows="10" cols="80">
                                            <?php echo $str_text.$message_detail['body'];?>
                    </textarea>
                  
                  </div>
                  <div class="form-group">
                    <textarea id="reply-textarea" name="reply-textarea" rows="10" cols="80">
                    </textarea>
                    
                  </div>
                  <div class="form-group">
                    <div class="btn btn-default btn-file">
                      <i class="fa fa-paperclip"></i> Attachment
                      <input id="input-24" name="userfile[]" type="file" multiple class="file-loading">
                    </div>
                    <p class="help-block">Max. 10MB</p>
                  </div>
                  <div class="form-group">
                      <label>Priority</label>
                      <select class="form-control" name="priority">
                        <option <?php if ($message_detail['priority'] == PRIORITY_LOW) { echo "selected";}?> value="<?php echo PRIORITY_LOW;;?>">Low</option>
                        <option <?php if ($message_detail['priority'] == PRIORITY_NORMAL) { echo "selected";}?> value="<?php echo PRIORITY_NORMAL;?>">Normal</option>
                        <option <?php if ($message_detail['priority'] == PRIORITY_HIGH) { echo "selected";}?> value="<?php echo PRIORITY_HIGH;?>">High</option>
                        <option <?php if ($message_detail['priority'] == PRIORITY_URGENT) { echo "selected";}?> value="<?php echo PRIORITY_URGENT;?>">Urgent</option>
                        
                      </select>
                </div>
                </div><!-- /.box-body -->
                
                <div class="box-footer">
                  <div class="pull-right">
                    <!-- <button class="btn btn-default"><i class="fa fa-pencil"></i> Draft</button>-->
                    <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Send</button>
                  </div>
                  <button class="btn btn-default"><i class="fa fa-times"></i> Discard</button>
                </div><!-- /.box-footer -->
              </div><!-- /. box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
        </form>
      </div><!-- /.content-wrapper -->
      <?php 
                    $subclass = '';
                    $preview_text = '';
                    foreach ($attachment as $file){
                        $file_parts = pathinfo($file['attachment_name']);
                        $name = base_url().'uploads/messages/'.$file['attachment_name'];
                        switch($file_parts['extension'])
                        {
                            case "pdf":
                                $class = "file-preview-other";
                                // for other files
                                $preview_text .= "'<div class='file-preview-text'><h2><i class='glyphicon glyphicon-file'></i></h2>".$file['attachment_name']."</div>'";
                                $subclass = "";
                                break;
                        
                            case "docx":
                                $class = "file-preview-other";
                                $subclass = "";
                                break;
                                
                            case "doc":
                                $class = "file-preview-other";
                                $subclass = "";
                                break;
                            
                            case "jpg":
                               $class = "file-preview-image";
                               $subclass = "has-img";
                               $preview_text .=  '\'<img src="'.$name.'" class="'.$class.'" alt="The Moon" title="The Moon">\'';
                                break;
                            
                            case "png":
                                $class = "file-preview-image";
                                $preview_text .=  '\'<img src="'.$name.'" class="'.$class.'" alt="The Moon" title="The Moon">\'';
                                $subclass = "has-img";
                                break;
                            
                            case "gif":
                                $class = "file-preview-image";
                                $preview_text .=  '\'<img src="'.$name.'" class="'.$class.'" alt="The Moon" title="The Moon">\'';
                                $subclass = "has-img";
                                break;
                            
                            case "txt":
                                $class = "file-preview-text";
                                // for text files
                                $preview_text .= "'<div class='file-preview-text' title='".$file['attachment_name']."'>" .
                                "This is the sample text file content upto wrapTextLength of 250 characters" .
                                "<span class='wrap-indicator' onclick='$(\"#show-detailed-text\").modal(\"show\")' title='".$file['attachment_name']."'>[…]</span>" .
                                "</div>'";
                                $subclass = "";
                                break;
                            case "": // Handle file extension for files ending in '.'
                            case NULL: // Handle no file extension
                                break;
                        }
                       
                       $preview_text .= ',';
                       // for image files
                       
                       
                       
                    }
                    $preview_text = substr($preview_text,0,-1);
                    ?>
      <script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>
       <script src="<?=base_url();?>assets/plugins/iCheck/icheck.min.js"></script>
   <script>
   var user_photo;
   var sendemail;
   var sendphoto;
      $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('reply-textarea');
        //bootstrap WYSIHTML5 - text editor
        $(".reply-textarea").wysihtml5();

        // note that it would be a lot more proper to use CSS classes here instead of inline style
        var ms = $('#ms-complex-templating').magicSuggest({
       	 	value: ['<?php echo $user_o_email;?>'],
            data: '<?php echo base_url();?>messages/getComplexData/<?php echo $user_id?>',
            allowFreeEntries: false,
            renderer: function(data){
			
				
             /*   if (data.user_photo != '' || data.user_photo != 'null'){
                    user_photo = data.user_photo;
                }else{
					user_photo = 'User_No-Frame.png';
                }*/
                return '<div style="padding: 5px; overflow:hidden;">' +
                    '<div style="float: left;"><img src="<?php echo base_url();?>uploads/profile/' + data.user_photos + '" width="32" height = "32" /></div>' +
                    '<div style="float: left; margin-left: 5px">' +
                        '<div style="font-weight: bold; color: #333; font-size: 11px; line-height: 11px">' + data.name + '</div>' +
                        '<div style="color: #999; font-size: 9px">' + data.email + '</div>' +
                    '</div>' +
                '</div><div style="clear:both;"></div>'; // make sure we have closed our dom stuff
            },
            selectionRenderer: function(data){
                //return '<img src="img/flags/' + data.countryCode.toLowerCase() + '.png" />' +
                //        '<div class="name">' + data.countryName + '</div>';
                //alert(data.email);
                sendemail = $('#send_to').val();
                arr =  $.unique(sendemail.split(','));
                sendemail = arr.join(","); //get unique string back with 
                sendemail += ','+data.id
                $('#send_to').val(sendemail);
           	 	//$('#send_to')[0].value += data.email;
                return data.name;
            }
                
        
        });
        //ms.setValue(returnedVal);
      
        //Enable iCheck plugin for checkboxes
        //iCheck for checkbox and radio inputs
        $('.box-primary input[type="checkbox"]').iCheck({
          checkboxClass: 'icheckbox_flat-blue',
          radioClass: 'iradio_flat-blue'
        });
        
      });


      $(document).on('ready', function() {
  	    $("#input-24").fileinput({
  	    	uploadUrl: "<?php echo base_url();?>messages/UploadBatchFile/id/<?php echo $user_id?>", // server upload action
    	    uploadAsync: false,
  	    	allowedFileTypes: ["image","text","video","pdf","doc"],
  	    	initialPreview: [
    	    	               <?php echo $preview_text;?>
    	    	           ],
    	    overwriteInitial: true,
  	        browseClass: "btn btn-success",
  	        browseLabel: "Pick Image",
  	        browseIcon: "<i class=\"glyphicon glyphicon-picture\"></i> ",
  	        removeClass: "btn btn-danger",
  	        removeLabel: "Delete",
  	        removeIcon: "<i class=\"glyphicon glyphicon-trash\"></i> ",
  	        uploadClass: "btn btn-info",
  	        uploadLabel: "Upload",
    	    allowedFileExtensions: ["txt", "jpg", "png", "text","doc","pdf","gif"],
    	    maxFileCount: 5,
    	    maxFileSize: 10024,
    	    //showUpload: false,
    	   // showRemove: false,
  	        uploadIcon: "<i class=\"glyphicon glyphicon-upload\"></i> "
  	    }).on({
  	    	filebatchuploadsuccess:function(event, data){  //see above
  	    		var formdata = data.form, files = data.files, 
    	          extradata = data.extra, responsedata = data.response;
  	    		visit(responsedata.extra);

    	  	    },
      	  	  filebatchpreupload:function(event, data){ //see above

        	  		var n = data.files.length, files = n > 1 ? n + ' files' : 'one file';
        	  	    if (!window.confirm("Are you sure you want to upload " + files + "?")) {
        	  	        return {
        	  	            message: "Upload aborted!", // upload error message
        	  	            data:{} // any other data to send that can be referred in `filecustomerror`
        	  	        };
        	  	    }
    	  	    }
    	  	   
    	 });
  	    
  	    
    	  function visit(object) {
    	  	    if (isIterable(object)) {
    	  	        forEachIn(object, function (accessor, child) {
    	  	            visit(child);
    	  	        });
    	  	    }
    	  	    else {
    	  	        var value = object;
      	  	      sendphoto = $('#attachment').val();
                  sendphoto += ','+value
    	  	        $('#attachment').val(sendphoto);
    	  	        console.log(value);
    	  	    }
    	  	}

    	  	function forEachIn(iterable, functionRef) {
    	  	    for (var accessor in iterable) {
    	  	        functionRef(accessor, iterable[accessor]);
    	  	    }
    	  	}

    	  	function isIterable(element) {
    	  	    return isArray(element) || isObject(element);
    	  	}

    	  	function isArray(element) {
    	  	    return element.constructor == Array;
    	  	}

    	  	function isObject(element) {
    	  	    return element.constructor == Object;
    	  	}
  	    
  	    
  	    /*.on('filebatchpreupload', function(event, data) {
    	      var n = data.files.length, files = n > 1 ? n + ' files' : 'one file';
    	  	    if (!window.confirm("Are you sure you want to upload " + files + "?")) {
    	  	        return {
    	  	            message: "Upload aborted!", // upload error message
    	  	            data:{} // any other data to send that can be referred in `filecustomerror`
    	  	        };
    	  	    }
    	  	});
    	  */
  	});
      
    </script>
    
    <!-- CK Editor -->
    
 