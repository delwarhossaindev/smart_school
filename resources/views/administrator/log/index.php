<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-users"></i><small> <?php echo lang('manage_activity_log'); ?></small></h3>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
             <div class="x_content quick-link">
                 <?php ci()->load->view('quick-link'); ?>
            </div>
            
            <div class="x_content"> 
                <?php echo form_open_multipart(site_url('administrator/activitylog/index'), array('name' => 'activitylog', 'id' => 'activitylog', 'class' => 'form-horizontal form-label-left'), ''); ?>
                <div class="row">
                  
                    <?php ci()->load->view('layout/school_list_filter'); ?>
                    
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <div class="item form-group"> 
                            <div><?php echo lang('user_type'); ?></div>
                            <select  class="form-control col-md-7 col-xs-12"  name="role_id"  id="role_id" onchange="get_user_by_role(this.value, '', '');">
                                <option value="">--<?php echo lang('select'); ?>--</option> 
                                
                                <?php foreach($roles as $obj ){ ?>                                
                                   <?php if(ci()->session->userdata('role_id') != SUPER_ADMIN && $obj->id == SUPER_ADMIN){ continue; } ?>  
                                    <option value="<?php echo $obj->id; ?>" <?php if(isset($role_id) && $role_id == $obj->id){ echo 'selected="selected"'; } ?>><?php echo $obj->name; ?></option>
                                <?php } ?> 
                                
                            </select>
                            <div class="help-block"><?php echo form_error('role_id'); ?></div>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-12 display" style="display:<?php if(isset($class_id)){ echo 'block';} ?>">
                        <div class="item form-group"> 
                            <div><?php echo lang('class'); ?></div>
                            <select  class="form-control col-md-7 col-xs-12"  name="class_id"  id="class_id"  onchange="get_user('', this.value,'');">
                                <option value="">--<?php echo lang('select'); ?>--</option>  
                                
                            </select>
                            <div class="help-block"><?php echo form_error('class_id'); ?></div>
                        </div>
                    </div>
                    
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="item form-group"> 
                            <div><?php echo lang('user'); ?></div>
                            <select  class="form-control col-md-12 col-xs-12"  name="user_id"  id="user_id" >
                                <option value="">--<?php echo lang('select'); ?>--</option>                                                                                         
                            </select>
                            <div class="help-block"><?php echo form_error('user_id'); ?></div>
                        </div>
                    </div>                    
                   
                
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <div class="form-group"><br/>
                            <button id="send" type="submit" class="btn btn-success"><?php echo lang('find'); ?></button>
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
            
             <div class="x_content">
                <div class="" data-example-id="togglable-tabs">                    
                    <ul  class="nav nav-tabs bordered">                 
                        <li  class="active"><a href="#tab_activitylog_list" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-users"></i> <?php echo lang('activity_log'); ?> <?php echo lang('list'); ?></a></li>                          
                    </ul>
                    <br/>
                     <div class="tab-content">
                        <div  class="tab-pane fade in active" id="tab_user_list" >
                           
                            <div class="x_content">
                                <?php echo form_open_multipart(site_url('administrator/activitylog/multidelete'), array('name' => 'delete', 'id' => 'delete', 'class' => 'form-horizontal form-label-left'), ''); ?>
                                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th><?php echo lang('sl_no'); ?></th>
                                            <?php if(has_permission(DELETE, 'administrator', 'activitylog')){ ?> 
                                                <th><?php echo lang('check_all'); ?></th>
                                            <?php } ?>
                                            <?php if(ci()->session->userdata('role_id') == SUPER_ADMIN){ ?>
                                                <th><?php echo lang('branch'); ?></th>
                                            <?php } ?>    
                                            <th><?php echo lang('name'); ?></th>
                                            <th><?php echo lang('phone'); ?></th>
                                            <th><?php echo lang('email'); ?></th>
                                            <th><?php echo lang('activity_log'); ?></th> 
                                            <th><?php echo lang('action'); ?> </th>                                            
                                        </tr>
                                    </thead>
                                    <tbody>   
                                        <?php
                                        $count = 1;
                                        if (isset($activity_logs) && !empty($activity_logs)) {
                                        ?>
                                            <?php foreach ($activity_logs as $obj) { ?>

                                                <tr>
                                                    <td><?php echo $count++;  ?></td>
                                                    <?php if(has_permission(DELETE, 'administrator', 'activitylog')){ ?> 
                                                        <td>
                                                            <input class="log_check" type="checkbox" name="log[<?php echo $obj->id; ?>]" value="<?php echo $obj->id; ?>" />
                                                        </td>    
                                                    <?php } ?>
                                                    <?php if(ci()->session->userdata('role_id') == SUPER_ADMIN){ ?>
                                                        <td><?php echo $obj->branch_name; ?></td>
                                                    <?php } ?>    
                                                    <td><?php echo ucfirst($obj->name); ?></td>
                                                    <td><?php echo $obj->phone; ?></td>
                                                    <td><?php echo $obj->email; ?></td>   
                                                    <td><?php echo $obj->activity; ?> at <?php echo date(ci()->global_setting->date_format.' H:i:s a', strtotime($obj->created_at)); ?></td>   
                                                    <td>                                                 
                                                        <?php if(has_permission(DELETE, 'administrator', 'activitylog')){ ?>    
                                                            <a href="<?php echo site_url('administrator/activitylog/delete/'.$obj->id); ?>"  onclick="javascript: return confirm('<?php echo lang('confirm_alert'); ?>');" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> <?php echo lang('delete'); ?> </a>
                                                        <?php } ?> 
                                                    </td>   
                                                </tr>
                                            <?php } ?>
                                        <?php } ?> 

                                    </tbody>
                                </table>
                                <?php if(has_permission(DELETE, 'administrator', 'activitylog')){ ?> 
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <a class="btn btn-success"  href="javascript:void(0);" onclick="check_all();"><?php echo lang('check_all'); ?></a>
                                            <a class="btn btn-success"  href="javascript:void(0);" onclick="uncheck_all();"><?php echo lang('uncheck_all'); ?></a>
                                            <button id="send" type="submit" class="btn btn-success" ><?php echo lang('delete'); ?> <?php echo lang('all'); ?></button>
                                        </div>
                                    </div>
                                <?php } ?>
                                <?php echo form_close(); ?>
                            </div> 
                        </div>
                 </div>
            </div>

            
        </div>
    </div>
</div>
</div>

 <script type="text/javascript">
     
     $('#branch_id').on('change', function(){
        $('#role_id').prop('selectedIndex',0);
        $('#user_id').prop('selectedIndex',0);
        $('#class_id').prop('selectedIndex',0);
     });
     
    <?php if(isset($role_id)){ ?>
      get_user_by_role('<?php echo $role_id;  ?>', '<?php echo $class_id; ?>', '<?php echo $user_id; ?>');
    <?php } ?>
        
    function get_user_by_role(role_id, class_id, user_id){       
       
       if(role_id == <?php echo STUDENT; ?>){
           $('.display').show();
           get_class_by_school(class_id);
            
           $('#class_id').attr("required");
           $('#user_id').html('<option value="">--<?php echo lang('select'); ?>--</option>'); 
           if(class_id !='' ){
                get_user(role_id, class_id, user_id);
           }
       }else{
           get_user(role_id, '', user_id);
           $('#class_id').removeAttr("required");
           $('.display').hide();
       }       
   }
   
   
   function get_user(role_id, class_id, user_id){
       
       if(role_id == ''){
           role_id = $('#role_id').val();
       }
       
       var branch_id =  $('.fn_branch_id').val();       
       if(!branch_id){
          // toastr.error('<?php echo lang('select_branch'); ?>');
            $('#role_id').prop('selectedIndex',0);
            $('#user_id').prop('selectedIndex',0);
           return false;
       }
       
       $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_user_by_role'); ?>",
            data   : {branch_id:branch_id, role_id : role_id , class_id: class_id, user_id:user_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                   $('#user_id').html(response); 
               }
            }
        }); 
   }
   
   
      
  function get_class_by_school(class_id){        
        
       var branch_id =  $('.fn_branch_id').val();       
       if(!branch_id){
           toastr.error('<?php echo lang('select_branch'); ?>');
            $('#role_id').prop('selectedIndex',0);
            $('#user_id').prop('selectedIndex',0);
            $('#class_id').prop('selectedIndex',0);
           return false;
       }
        
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_class_by_school'); ?>",
            data   : { branch_id:branch_id, class_id:class_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               { 
                    $('#class_id').html(response);                     
               }
            }
        });
    }
   
   
   
   $('.fn_update_status').click(function(){
   
       var user_id = $(this).attr('id');    
       var status = $(this).attr('itemid');    
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/update_user_status'); ?>",
            data   : { user_id:user_id,  status : status },               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                   toastr.success('Success'); 
                   location.reload();
               }
            }
        }); 
   });
    
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
        
     $("#activitylog").validate();  
     
     function check_all(){         
          $('.log_check').prop('checked', true);
     }
     function uncheck_all(){
        $('.log_check').prop('checked', false);;
     }
     
</script> 
