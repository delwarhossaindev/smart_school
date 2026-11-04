<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-mobile-phone"></i><small> <?php echo lang('mark_send_by_sms'); ?></small></h3>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content quick-link">
                 <?php ci()->load->view('quick-link-exam'); ?> 
            </div>      
              
            
            <div class="x_content">
                <div class="" data-example-id="togglable-tabs">                    
                    <ul  class="nav nav-tabs bordered">
                        <li class="<?php if(isset($list)){ echo 'active'; }?>"><a href="#tab_send_sms_list"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-list-ol"></i> <?php echo lang('list'); ?></a> </li>
                        <li class="<?php if(isset($add)){ echo 'active'; }?>"><a href="#tab_send_sms"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-location-arrow"></i> <?php echo lang('send_sms'); ?></a> </li>
                        
                        <li class="li-class-list">
                        <?php if(ci()->session->userdata('role_id') == SUPER_ADMIN){  ?>                                 
                             <select  class="form-control col-md-7 col-xs-12" onchange="get_sms_by_school(this.value);">
                                     <option value="<?php echo site_url('exam/text/index'); ?>">--<?php echo lang('select_branch'); ?>--</option> 
                                 <?php foreach($schools as $obj ){ ?>
                                     <option value="<?php echo site_url('exam/text/index/'.$obj->id); ?>" <?php if(isset($filter_branch_id) && $filter_branch_id == $obj->id){ echo 'selected="selected"';} ?> > <?php echo $obj->branch_name; ?></option>
                                 <?php } ?>   
                             </select>
                         <?php } ?>  
                         </li> 
                        
                    </ul>
                    <br/>
                    
                    <div class="tab-content"> 
                        
                        
                            <div  class="tab-pane fade in <?php if(isset($list)){ echo 'active'; }?>" id="tab_send_sms_list" >
                            <div class="x_content">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo lang('sl_no'); ?></th>
                                        <?php if(ci()->session->userdata('role_id') == SUPER_ADMIN){ ?>
                                            <th><?php echo lang('branch'); ?></th>
                                        <?php } ?>                                        
                                        <th><?php echo lang('session_year'); ?></th>
                                        <th><?php echo lang('exam_term'); ?></th>
                                        <th><?php echo lang('class'); ?></th>
                                        <th><?php echo lang('receiver_type'); ?></th>
                                        <th><?php echo lang('gateway'); ?></th>
                                        <th><?php echo lang('send_date'); ?></th>
                                        <th><?php echo lang('action'); ?></th>                                            
                                    </tr>
                                </thead>
                                <tbody>   
                                    <?php $count = 1; if(isset($mark_smses) && !empty($mark_smses)){ ?>
                                        <?php foreach($mark_smses as $obj){ ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <?php if(ci()->session->userdata('role_id') == SUPER_ADMIN){ ?>
                                                <td><?php echo $obj->branch_name; ?></td>
                                            <?php } ?>
                                            <td><?php echo $obj->session_year; ?></td>
                                            <td><?php echo $obj->exam_name; ?></td>
                                            <td><?php echo $obj->class_name; ?></td>
                                            <td><?php echo $obj->receiver_type; ?></td>
                                            <td><?php echo $obj->sms_gateway; ?></td>
                                            <td><?php echo get_nice_time($obj->created_at); ?></td>
                                            <td>
                                                <?php if(has_permission(VIEW, 'exam', 'text')){ ?>
                                                    <a  onclick="get_sms_modal(<?php echo $obj->id; ?>);"  data-toggle="modal" data-target=".bs-sms-modal-lg"  class="btn btn-success btn-xs"><i class="fa fa-eye"></i> <?php echo lang('view'); ?> </a>
                                                <?php } ?>
                                                <?php if(has_permission(DELETE, 'exam', 'text')){ ?>    
                                                    <a href="<?php echo site_url('exam/text/delete/'.$obj->id); ?>" onclick="javascript: return confirm('<?php echo lang('confirm_alert'); ?>');" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> <?php echo lang('delete'); ?> </a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                            </div>
                        </div>
                        
                        
                        <div  class="tab-pane fade in <?php if(isset($add)){ echo 'active'; }?>" id="tab_send_sms">
                            <div class="x_content"> 
                               <?php echo form_open_multipart(site_url('exam/text/send'), array('name' => 'sms', 'id' => 'sms', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                
                                <?php ci()->load->view('layout/school_list_form'); ?> 
                                
                                <div class="item form-group"> 
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="exam_id"><?php echo lang('exam_term'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-12 col-xs-12"  name="exam_id"  id="exam_id" required="required">
                                            <option value="">--<?php echo lang('select'); ?>--</option>  
                                            <?php if(isset($exams) && !empty($exams)){ ?>
                                                <?php foreach($exams as $obj ){ ?>
                                                <option value="<?php echo $obj->id; ?>" ><?php echo $obj->title; ?></option>
                                                <?php } ?> 
                                            <?php } ?> 
                                        </select>
                                        <div class="help-block"><?php echo form_error('exam_id'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group"> 
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="role_id"><?php echo lang('receiver_type'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-12 col-xs-12"  name="role_id"  id="role_id" required="required" onchange="get_user_by_role(this.value);">
                                            <option value="">--<?php echo lang('select'); ?>--</option> 
                                            <?php foreach($roles as $obj ){ ?>
                                            <?php if($obj->id == STUDENT || $obj->id == GUARDIAN){ ?>
                                                    <option value="<?php echo $obj->id; ?>" ><?php echo $obj->name; ?></option>
                                                <?php } ?>
                                            <?php } ?>                                            
                                        </select>
                                        <div class="help-block"><?php echo form_error('role_id'); ?></div>
                                    </div>
                                </div>
                                
                                 <div class="item form-group display"> 
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="class_id"><?php echo lang('class'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-12 col-xs-12"  name="class_id"  id="class_id"  onchange="get_user(this.value,'');">
                                            <option value="">--<?php echo lang('select'); ?>--</option>  
                                            <?php foreach($classes as $obj ){ ?>
                                            <option value="<?php echo $obj->id; ?>" ><?php echo $obj->name; ?></option>
                                            <?php } ?> 
                                        </select>
                                        <div class="help-block"><?php echo form_error('class_id'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">  
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="receiver_id"><?php echo lang('receiver'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-12 col-xs-12"  name="receiver_id"  id="receiver_id" required="required" >
                                            <option value="">--<?php echo lang('select'); ?>--</option>                                                                                         
                                        </select>
                                        <div class="help-block"><?php echo form_error('receiver_id'); ?></div>
                                    </div>
                                </div>   
                                
                                 <div class="item form-group">  
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="template"><?php echo lang('template'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-12 col-xs-12"  name="template"  id="fn_template" onchange="get_template(this.value)">
                                            <option itemid="" value="">--<?php echo lang('select'); ?>--</option>                                                                                         
                                        </select>
                                        <div class="help-block"><?php echo form_error('template'); ?></div>
                                    </div>
                                </div>   
                                
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="body"><?php echo lang('sms'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control" name="body" id="body"  onKeyDown="limitText(this.value);" onKeyUp="limitText(this.value);" maxlength="160"  required="required" placeholder="<?php echo lang('sms'); ?>"></textarea>
                                        <div class="help-block"><?php echo form_error('body'); ?></div>
                                        <div class="help-block fn_countdown"><?php echo lang('you_have_remain_character'); ?>:160</div>
                                    </div>
                                </div> 
                                           
                                <div class="item form-group">  
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sms_gateway"><?php echo lang('gateway'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">                                       
                                        <select  class="form-control col-md-12 col-xs-12"  name="sms_gateway"  id="sms_gateway" required="required" >
                                            <option value="">--<?php echo lang('select'); ?>--</option>                                              
                                        </select>
                                        <div class="help-block"><?php echo form_error('sms_gateway'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"><?php echo lang('dynamic_tag'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12"  id="fn_tag"  style="padding-top: 6px;">[name] [email] [phone] [exam_mark]</div>
                                </div>  
                               
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <a href="<?php echo site_url('exam/sms/index'); ?>" class="btn btn-primary"><?php echo lang('cancel'); ?></a>
                                        <button id="send" type="submit" class="btn btn-success"><?php echo lang('submit'); ?></button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div> 
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade bs-sms-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title"><?php echo lang('detail_information'); ?></h4>
        </div>
        <div class="modal-body fn_sms_data">
            
        </div>       
      </div>
    </div>
</div>
<script type="text/javascript">
         
    function get_sms_modal(sms_id){
         
        $('.fn_sms_data').html('<p style="padding: 20px;"><p style="padding: 20px;text-align:center;"><img src="<?php echo IMG_URL; ?>loading.gif" /></p>');
        $.ajax({       
          type   : "POST",
          url    : "<?php echo site_url('exam/text/get_single_sms'); ?>",
          data   : {sms_id : sms_id},  
          success: function(response){                                                   
             if(response)
             {
                $('.fn_sms_data').html(response);
             }
          }
       });
    }
</script>



<!-- Super admin js START  -->
 <script type="text/javascript">
     
    $('.fn_branch_id').on('change', function(){
      
        var branch_id = $(this).val();  
        
        if(!branch_id){
           toastr.error('<?php echo lang('select_branch'); ?>');
           return false;
        }
       
       $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_exam_by_school'); ?>",
            data   : {},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {  
                   $('#exam_id').html(response); 
                   get_class_by_school(branch_id);
               }
            }
        });
    }); 
    
       
   function get_user_by_role(role_id){       
      
        var branch_id = $('.fn_branch_id').val(); 
        if(!branch_id){
           toastr.error('<?php echo lang('select_branch'); ?>');
           return false;
        }       
      
        $('.display').show();
        $('#class_id').prop('required', true);
        $("select#class_id").prop('selectedIndex', 0);
        $('#receiver_id').html('<option value="">--<?php echo lang('select'); ?>--</option>'); 
              
       
       get_sms_template_by_role(role_id);
       get_sms_gateways(branch_id); 
   }

    function get_user(class_id){
       
        var branch_id = $('.fn_branch_id').val(); 
        var role_id = $('#role_id').val(); 
        
        if(!branch_id){
           toastr.error('<?php echo lang('select_branch'); ?>');
           return false;
        }
       
       $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('/ajax/get_user_by_role'); ?>",
            data   : { branch_id: branch_id, role_id : role_id , class_id: class_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                   $('#receiver_id').html(response); 
               }
            }
        }); 
   } 
 

   function get_class_by_school(branch_id){       
         
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_class_by_school'); ?>",
            data   : { branch_id:branch_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {  
                   $('#class_id').html(response);                                  
               }
            }
        });                  
        
   }
   
   function get_sms_template_by_role(role_id){
   
        $('#body').html('');
        
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_sms_template_by_role'); ?>",
            data   : {role_id : role_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                   $('#fn_template').html(response); 
               }
            }
        }); 
   }
   
   function get_template(template){       
        $('#body').html(template);
   }
   
   function get_sms_gateways(branch_id){       
         
        branch_id = $('#add_branch_id').val();
        if(!branch_id){
           return false;
        }
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_sms_gateways'); ?>",
            data   : { branch_id:branch_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {  
                   $('#sms_gateway').html(response);                                  
               }
            }
        });                  
        
   }
  
   
  </script>
<!-- Super admin js end -->

<script type="text/javascript">
        $(document).ready(function() {
          $('#datatable-responsive').DataTable( {
              dom: 'Bfrtip',
              iDisplayLength: 15,
              buttons: [
                  'copyHtml5',
                  'excelHtml5',
                  'csvHtml5',
                  'pdfHtml5',
                  'pageLength'
              ],
              search: true,              
              responsive: true
          });
        });
        
    $("#sms").validate();
     function limitText(text) {       
       $('.fn_countdown').text('<?php echo lang('you_have_remain_character'); ?>:'+(160 - text.length));        
     }
     
     function get_sms_by_school(url){          
        if(url){
            window.location.href = url; 
        }
    }  
</script>

