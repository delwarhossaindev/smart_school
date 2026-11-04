<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-bell-o"></i><small> <?php echo lang('manage_approved_application'); ?></small></h3>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content quick-link">
                <?php ci()->load->view('quick-link'); ?>               
            </div>
            
            <div class="x_content">
                <div class="" data-example-id="togglable-tabs">
                    
                    <ul  class="nav nav-tabs bordered">
                        <li class="<?php if(isset($list)){ echo 'active'; }?>"><a href="#tab_application_list"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-list-ol"></i> <?php echo lang('list'); ?></a> </li>
                        <?php if(isset($edit)){ ?>
                            <li  class="active"><a href="#tab_edit_application"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-pencil-square-o"></i> <?php echo lang('edit'); ?> </a> </li>                          
                        <?php } ?>                        
                        <li class="li-class-list">
                            <?php if(ci()->session->userdata('role_id') == SUPER_ADMIN){  ?>                                  
                                <select  class="form-control col-md-7 col-xs-12 auto-width" name="branch_id_filter" id="branch_id_filter" onchange="get_approved_leave_by_school_filter(this.value)">
                                    <option value="<?php echo site_url('leave/approve/index'); ?>">--<?php echo lang('select_branch'); ?>--</option> 
                                    <?php foreach(ci()->schools as $obj ){ ?>
                                        <option value="<?php echo site_url('leave/approve/index/'.$obj->id); ?>" <?php if(isset($filter_branch_id) && $filter_branch_id == $obj->id){ echo 'selected="selected"';} ?> > <?php echo $obj->branch_name; ?></option>
                                    <?php } ?>   
                                </select>
                            <?php } ?>
                        </li> 
                    </ul>
                    <br/>
                    
                    <div class="tab-content">
                        
                        <div  class="tab-pane fade in <?php if(isset($list)){ echo 'active'; }?>" id="tab_application_list" >
                            <div class="x_content">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo lang('sl_no'); ?></th>
                                        <?php if(ci()->session->userdata('role_id') == SUPER_ADMIN){ ?>
                                            <th><?php echo lang('branch'); ?></th>
                                        <?php } ?>
                                        <th><?php echo lang('academic_year'); ?></th>
                                        <th><?php echo lang('applicant_type'); ?></th>
                                        <th><?php echo lang('leave_type'); ?></th>
                                        <th><?php echo lang('applicant'); ?></th>
                                        <th><?php echo lang('action'); ?></th>                                            
                                    </tr>
                                </thead>
                                <tbody>   
                                    <?php $count = 1; if(isset($applications) && !empty($applications)){ ?>
                                        <?php foreach($applications as $obj){ ?>                                       
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <?php if(ci()->session->userdata('role_id') == SUPER_ADMIN){ ?>
                                                <td><?php echo $obj->branch_name; ?></td>
                                            <?php } ?>
                                            <td><?php echo $obj->session_year; ?></td>
                                            <td><?php echo $obj->role_name; ?></td>
                                            <td><?php echo $obj->type; ?></td>
                                            <td>
                                                <?php
                                                    $user = get_user_by_role($obj->role_id, $obj->user_id);
                                                    echo $user->name;
                                                    if($obj->role_id == STUDENT){
                                                        echo '<br/>'.$user->class_name.','. $user->section.','.$user->roll_no;
                                                    }
                                                ?>
                                            </td>                                
                                            <td>                                                       
                                                <?php if(has_permission(VIEW, 'leave', 'approve')){ ?>
                                                    <a  onclick="get_application_modal(<?php echo $obj->id; ?>);"  data-toggle="modal" data-target=".bs-application-modal-lg"  class="btn btn-success btn-xs"><i class="fa fa-eye"></i> <?php echo lang('view'); ?> </a>
                                                <?php } ?>                                                
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                            </div>
                        </div>

                        <?php if(isset($edit)){ ?>
                            <div  class="tab-pane fade in <?php if(isset($edit)){ echo 'active'; }?>" id="tab_edit_application">
                            <div class="x_content"> 
                               <?php echo form_open_multipart(site_url('leave/approve/update/'.$application->id), array('name' => 'edit', 'id' => 'edit', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                
                                <?php ci()->load->view('layout/school_list_edit_form'); ?>  
                                
                                    <div class="item form-group"> 
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="role_id"><?php echo lang('applicant_type'); ?> <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select  class="form-control col-md-12 col-xs-12" name="role_id"  id="role_id" required="required" onchange="get_user_by_role(this.value, '');">
                                                <option value="">--<?php echo lang('select'); ?> --</option> 
                                                <?php foreach($roles as $obj ){  ?>
                                                     <?php if(in_array($obj->id, array(SUPER_ADMIN, GUARDIAN))){ continue;} ?>
                                                    <option value="<?php echo $obj->id; ?>" <?php echo isset($application) && $application->role_id == $obj->id ? 'selected="selected"' : ''; ?>><?php echo $obj->name; ?></option>
                                                <?php } ?>                                            
                                            </select>
                                            <div class="help-block"><?php echo form_error('role_id'); ?></div>
                                        </div>
                                    </div>

                                    <div class="item form-group display"> 
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="class_id"><?php echo lang('class'); ?> <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select  class="form-control col-md-12 col-xs-12"  name="class_id"  id="class_id"  onchange="get_user('', this.value,'');">
                                                <option value="">--<?php echo lang('select'); ?>--</option>  
                                                <?php foreach($classes as $obj ){ ?>
                                                    <option value="<?php echo $obj->id; ?>" <?php echo $application->class_id == $obj->id ? 'selected="selected"' : ''; ?>><?php echo $obj->name; ?></option>
                                                <?php } ?> 
                                            </select>
                                            <div class="help-block"><?php echo form_error('class_id'); ?></div>
                                        </div>
                                    </div>

                                    <div class="item form-group">  
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="user_id"><?php echo lang('applicant'); ?> <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select  class="form-control col-md-12 col-xs-12" name="user_id"  id="user_id" required="required" >
                                                <option value="">--<?php echo lang('select'); ?>--</option>                                                                                         
                                            </select>
                                            <div class="help-block"><?php echo form_error('user_id'); ?></div>
                                        </div>
                                    </div>

                                    <div class="item form-group">  
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="type_id"><?php echo lang('leave_type'); ?> <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select  class="form-control col-md-12 col-xs-12"  name="type_id"  id="type_id" required="required" onchange="get_type(this.value)">
                                                <option itemid="" value="">--<?php echo lang('select'); ?>--</option>                                                                                         
                                            </select>
                                            <div class="help-block"><?php echo form_error('type_id'); ?></div>
                                        </div>
                                    </div>                                    

                                    <div class="form-group"> 
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="leave_date"><?php echo lang('application_date'); ?> <span class="required"> *</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input  class="form-control col-md-7 col-xs-12" name="leave_date"  id="leave_date" value="<?php echo isset($application->leave_date) ?  date('d-m-Y', strtotime($application->leave_date)) : ''; ?>" placeholder="<?php echo lang('application_date'); ?>" required="required" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('leave_date'); ?></div>
                                        </div>
                                    </div>

                                    <div class="form-group"> 
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="leave_from"><?php echo lang('leave_from'); ?><span class="required"> *</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input  class="form-control col-md-7 col-xs-12" name="leave_from"  id="leave_from" value="<?php echo isset($application->leave_from) ?  date('d-m-Y', strtotime($application->leave_from)) : ''; ?>" placeholder="<?php echo lang('leave_from'); ?>" required="required" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('leave_from'); ?></div>
                                        </div>
                                    </div>

                                    <div class="form-group"> 
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="leave_to"><?php echo lang('leave_to'); ?><span class="required"> *</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input  class="form-control col-md-7 col-xs-12" name="leave_to"  id="leave_to" value="<?php echo isset($application->leave_to) ?  date('d-m-Y', strtotime($application->leave_to)) : ''; ?>" placeholder="<?php echo lang('leave_to'); ?>" required="required" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('leave_to'); ?></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="leave_reason"><?php echo lang('leave_reason'); ?> <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <textarea  class="form-control" name="leave_reason" id="leave_reason" required="required" placeholder="<?php echo lang('leave_reason'); ?> "><?php echo isset($application->leave_reason) ?  $application->leave_reason : ''; ?></textarea>
                                            <div class="help-block"><?php echo form_error('leave_reason'); ?></div>
                                        </div>
                                    </div> 
                                
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="leave_note"><?php echo lang('note'); ?> <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <textarea  class="form-control" name="leave_note" id="leave_note" required="required" placeholder="<?php echo lang('note'); ?>"><?php echo isset($application->leave_note) ?  $application->leave_note : ''; ?></textarea>
                                            <div class="help-block"><?php echo form_error('leave_note'); ?></div>
                                        </div>
                                    </div> 

                                    <?php if($application->attachment){ ?>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12"><?php echo lang('attachment'); ?></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <a class="btn btn-success" target="_blank" href="<?php echo UPLOAD_PATH; ?>leave/<?php echo $application->attachment; ?>"><i class="fa fa-download"></i> <?php echo lang('download'); ?></a> <br/><br/>
                                            </div>
                                        </div>
                                    <?php } ?>                                            
                                
                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-3">
                                            <input type="hidden" value="<?php echo isset($application) ? $application->id : $id; ?>" name="id" />
                                            <a  href="<?php echo site_url('leave/approve/index/'.$application->branch_id); ?>" class="btn btn-primary"><?php echo lang('cancel'); ?></a>
                                            <button id="send" type="submit" class="btn btn-success"><?php echo lang('update'); ?></button>
                                        </div>
                                    </div>
                                    <?php echo form_close(); ?>
                                </div>
                            </div>  
                        <?php } ?>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade bs-application-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title"><?php echo lang('detail_information'); ?></h4>
        </div>
        <div class="modal-body fn_application_data">            
        </div>       
      </div>
    </div>
</div>

<script type="text/javascript">
         
    function get_application_modal(application_id){
         
        $('.fn_application_data').html('<p style="padding: 20px;"><p style="padding: 20px;text-align:center;"><img src="<?php echo IMG_URL; ?>loading.gif" /></p>');
        $.ajax({       
          type   : "POST",
          url    : "<?php echo site_url('leave/approve/get_single_application'); ?>",
          data   : {application_id : application_id},  
          success: function(response){                                                   
             if(response)
             {
                $('.fn_application_data').html(response);
             }
          }
       });
    }
</script>


<!-- bootstrap-datetimepicker -->
<link href="<?php echo VENDOR_URL; ?>datepicker/datepicker.css" rel="stylesheet">
 <script src="<?php echo VENDOR_URL; ?>datepicker/datepicker.js"></script>

 <script type="text/javascript">
  
    $('#leave_date').datepicker();  
    $('#leave_from').datepicker();  
    $('#leave_to').datepicker();  


    $('.fn_branch_id').on('change', function(){      
         
        var branch_id = $(this).val(); 
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
    });
        
    <?php if(isset($application)){ ?>  
         get_user_by_role('<?php echo $application->role_id; ?>', '<?php echo $application->user_id; ?>');
    <?php } ?>
      
    function get_user_by_role(role_id, user_id){     
             
      
        var branch_id = $('.fn_branch_id ').val();
        if( !branch_id){            
           toastr.error('<?php echo lang('select_branch'); ?>');
           $('select#role_id').prop('selectedIndex', 0);
           return false;
        } 
      
       if(role_id == <?php echo STUDENT; ?>){
           $('.display').show();
           $('#class_id').prop('required', true);           
           $('#user_id').html('<option value="">--<?php echo lang('select'); ?>--</option>'); 
       }else{ 
           $('#class_id').prop('required', false);
           $('.display').hide();
       }
       
       
       var type_id = '';       
       <?php if(isset($application)){ ?> 
            get_user(role_id, '<?php echo $application->class_id; ?>', user_id);
            type_id = '<?php echo $application->type_id; ?>';
       <?php } ?>
       get_leave_type_by_school(type_id);
   }
   
   function get_user(role_id, class_id, user_id){
     
        if(role_id == ''){
            role_id = $('#role_id').val();
        }
       
        var branch_id = $('.fn_branch_id').val();
        if( !branch_id){            
           toastr.error('<?php echo lang('select_branch'); ?>');
           return false;
        }       
       
       $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_user_by_role'); ?>",
            data   : { branch_id : branch_id, role_id : role_id , class_id: class_id, user_id : user_id, message:true},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                   $('#user_id').html(response); 
               }
            }
        }); 
   }
   
   
   function get_leave_type_by_school(type_id){
   
        var role_id = $('#role_id').val();
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_leave_type_by_school'); ?>",
            data   : { role_id:role_id, type_id:type_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                   $('#type_id').html(response); 
               }
            }
        }); 
   }   

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
      
    $("#add").validate();   
    $("#edit").validate();   
    
    
       /* Menu Filter Start */   
    function get_approved_leave_by_school_filter(url){          
       if(url){
           window.location.href = url; 
       }
    } 
    
</script> 
