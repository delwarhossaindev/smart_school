<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-file-word-o"></i><small> <?php echo lang('manage_complain'); ?></small></h3>
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
                        <li class="<?php if(isset($list)){ echo 'active'; }?>"><a href="#tab_complain_list"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-list-ol"></i> <?php echo lang('list'); ?></a> </li>
                          <?php if(has_permission(ADD, 'complain', 'complain')){ ?>
                            <?php if(isset($edit)){ ?>
                                <li  class="<?php if(isset($add)){ echo 'active'; }?>"><a href="<?php echo site_url('complain/add'); ?>"  aria-expanded="false"><i class="fa fa-plus-square-o"></i> <?php echo lang('add'); ?></a> </li>                          
                             <?php }else{ ?>
                                 <li  class="<?php if(isset($add)){ echo 'active'; }?>"><a href="#tab_add_complain"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-plus-square-o"></i> <?php echo lang('add'); ?></a> </li>                          
                             <?php } ?>
                           
                        <?php } ?>        
                        <?php if(isset($edit)){ ?>
                            <li  class="active"><a href="#tab_edit_complain"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-pencil-square-o"></i> <?php echo lang('edit'); ?></a> </li>                          
                        <?php } ?>                
                                                   
                        <li class="li-class-list">
                            <?php if(ci()->session->userdata('role_id') == SUPER_ADMIN){  ?>                            
                                <select  class="form-control col-md-7 col-xs-12 auto-width" name="branch_id_filter" id="branch_id_filter" onchange="get_complain_by_school(this.value,'')">
                                        <option value="<?php echo site_url('complain/index'); ?>">--<?php echo lang('select_branch'); ?>--</option> 
                                    <?php foreach($schools as $obj ){ ?>
                                        <option value="<?php echo site_url('complain/index/'.$obj->id); ?>" <?php if(isset($filter_branch_id) && $filter_branch_id == $obj->id){ echo 'selected="selected"';} ?> > <?php echo $obj->branch_name; ?></option>
                                    <?php } ?>   
                                </select>  
                            <?php } ?>
                        </li>    
                    </ul>
                    <br/>
                    
                    <div class="tab-content">
                        <div  class="tab-pane fade in <?php if(isset($list)){ echo 'active'; }?>" id="tab_complain_list" >
                            <div class="x_content">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo lang('sl_no'); ?></th>
                                        <?php if(ci()->session->userdata('role_id') == SUPER_ADMIN){ ?>
                                            <th><?php echo lang('branch'); ?></th>
                                        <?php } ?>
                                        <th><?php echo lang('academic_year'); ?></th>
                                        <th><?php echo lang('complain_by'); ?></th>
                                        <th><?php echo lang('complain_type'); ?></th>
                                        <th><?php echo lang('complain_date'); ?></th>
                                        <th><?php echo lang('action_date'); ?></th>
                                        <th><?php echo lang('action'); ?></th>                                             
                                    </tr>
                                </thead>
                                <tbody>   
                                    <?php $count = 1; if(isset($complains) && !empty($complains)){ ?>
                                        <?php foreach($complains as $obj){ ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <?php if(ci()->session->userdata('role_id') == SUPER_ADMIN){ ?>
                                                <td><?php echo $obj->branch_name; ?></td>
                                            <?php } ?>
                                            <td><?php echo $obj->session_year; ?></td>
                                            <td>
                                                <?php
                                                   $user = get_user_by_role($obj->role_id, $obj->user_id);
                                                   echo $user->name;
                                                ?>
                                                <br/>[<?php echo lang('role').': '. $obj->role_name ?> <?php if($obj->role_id == STUDENT){ echo lang('class').': '.$user->class_name.', '.lang('section').': '.$user->section.', '.lang('roll_no').': '.$user->roll_no; } ?>]
                                            </td>
                                            <td><?php echo $obj->type; ?></td>
                                            <td><?php echo date(ci()->global_setting->date_format, strtotime($obj->complain_date)); ?></td>
                                            <td>
                                                <?php if($obj->action_date != ''){ ?>
                                                <?php echo date(ci()->global_setting->date_format, strtotime($obj->action_date)); ?>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php if(has_permission(EDIT, 'complain', 'complain')){ ?>
                                                    <a href="<?php echo site_url('complain/edit/'.$obj->id); ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil-square-o"></i> <?php echo lang('edit'); ?> </a>
                                                <?php  } ?>
                                                <?php if(has_permission(VIEW, 'complain', 'complain')){ ?>
                                                    <a  onclick="get_complain_modal(<?php echo $obj->id; ?>);"  data-toggle="modal" data-target=".bs-complain-modal-lg"  class="btn btn-success btn-xs"><i class="fa fa-eye"></i> <?php echo lang('view'); ?> </a>
                                                <?php  } ?>
                                                <?php if(has_permission(DELETE, 'complain', 'complain')){ ?>
                                                    <a href="<?php echo site_url('complain/delete/'.$obj->id); ?>" onclick="javascript: return confirm('<?php echo lang('confirm_alert'); ?>');" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> <?php echo lang('delete'); ?> </a>
                                                <?php  } ?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                            </div>
                        </div>
               
                        
                        <div  class="tab-pane fade in <?php if(isset($add)){ echo 'active'; }?>" id="tab_add_complain">
                            <div class="x_content"> 
                               <?php echo form_open_multipart(site_url('complain/add'), array('name' => 'add', 'id' => 'add', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                
                                <?php ci()->load->view('layout/school_list_form'); ?>
                                                            

                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="role_id"><?php echo lang('user_type'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="role_id"  id="add_role_id" required="required" onchange="get_user_by_role(this.value, '');">
                                            <option value="">--<?php echo lang('select'); ?>--</option> 
                                            <?php if(isset($roles) &&  !empty($roles)){ ?>
                                                <?php foreach($roles as $obj ){ ?>
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
                                        <select  class="form-control col-md-12 col-xs-12"  name="class_id"  id="add_class_id"  onchange="get_user('', this.value,'');">
                                            <option value="">--<?php echo lang('select'); ?>--</option>  
                                            <?php if(isset($classes) &&  !empty($classes)){ ?>
                                                <?php foreach($classes as $obj ){ ?>
                                                <option value="<?php echo $obj->id; ?>" ><?php echo $obj->name; ?></option>
                                                <?php } ?> 
                                            <?php } ?> 
                                        </select>
                                        <div class="help-block"><?php echo form_error('class_id'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="user_id"><?php echo lang('complain_by'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="user_id"  id="add_user_id" required="required" >
                                            <option value="">--<?php echo lang('select'); ?>--</option>                                                                                         
                                        </select>
                                        <div class="help-block"><?php echo form_error('user_id'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="type_id"><?php echo lang('complain_type'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="type_id"  id="add_type_id" required="required" >
                                            <option value="">--<?php echo lang('select'); ?>--</option> 
                                            <?php if(isset($complain_types) && !empty($complain_types)){ ?>
                                                <?php foreach($complain_types as $obj){ ?>
                                                    <option value="<?php echo $obj->id; ?>"><?php echo $obj->type; ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                        <div class="help-block"><?php echo form_error('type_id'); ?></div>
                                    </div>
                                </div>
                                 
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="complain_date"><?php echo lang('complain_date'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="complain_date"  id="add_complain_date" value="<?php echo isset($complain_date) ?  date('d-m-Y',strtotime($complain_date)) : ''; ?>" placeholder="<?php echo lang('complain_date'); ?>" required="required" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('complain_date'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description"><?php echo lang('complain'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control col-md-7 col-xs-12"  name="description"  id="description" required="required" placeholder="<?php echo lang('complain'); ?>"><?php echo isset($description) ?  $description : ''; ?></textarea>
                                        <div class="help-block"><?php echo form_error('description'); ?></div>
                                    </div>
                                </div> 
                                
                                
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <a href="<?php echo site_url('complain/index'); ?>" class="btn btn-primary"><?php echo lang('cancel'); ?></a>
                                        <button id="send" type="submit" class="btn btn-success"><?php echo lang('submit'); ?></button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>  
                        
                        <?php if(isset($edit)){ ?>
                        <div class="tab-pane fade in active" id="tab_edit_complain">
                            <div class="x_content"> 
                               <?php echo form_open_multipart(site_url('complain/edit/'.$complain->id), array('name' => 'edit', 'id' => 'edit', 'class'=>'form-horizontal form-label-left'), ''); ?>
                          
                                <?php ci()->load->view('layout/school_list_edit_form'); ?>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="role_id"><?php echo lang('user_type'); ?> <?php echo lang('type'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="role_id"  id="edit_role_id" required="required" onchange="get_user_by_role(this.value, '');">
                                            <option value="">--<?php echo lang('select'); ?>--</option> 
                                            <?php if(isset($roles) &&  !empty($roles)){ ?>
                                                <?php foreach($roles as $obj ){ ?>
                                                    <option value="<?php echo $obj->id; ?>" <?php if($complain->role_id == $obj->id){ echo 'selected="selected"';} ?>><?php echo $obj->name; ?></option>
                                                <?php } ?>                                            
                                            <?php } ?>                                            
                                        </select>
                                        <div class="help-block"><?php echo form_error('role_id'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group display"> 
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="class_id"><?php echo lang('class'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-12 col-xs-12"  name="class_id"  id="edit_class_id"  onchange="get_user('', this.value,'');">
                                            <option value="">--<?php echo lang('select'); ?>--</option>  
                                            <?php if(isset($classes) &&  !empty($classes)){ ?>
                                                <?php foreach($classes as $obj ){ ?>
                                                <option value="<?php echo $obj->id; ?>" <?php if($complain->class_id == $obj->id){ echo 'selected="selected"';} ?>><?php echo $obj->name; ?></option>
                                                <?php } ?> 
                                            <?php } ?> 
                                        </select>
                                        <div class="help-block"><?php echo form_error('class_id'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="user_id"><?php echo lang('complain_by'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="user_id"  id="edit_user_id" required="required" >
                                            <option value="">--<?php echo lang('select'); ?>--</option>                                                                                         
                                        </select>
                                        <div class="help-block"><?php echo form_error('user_id'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="type_id"><?php echo lang('complain_type'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="type_id"  id="edit_type_id" required="required" >
                                            <option value="">--<?php echo lang('select'); ?>--</option> 
                                            <?php if(isset($complain_types) && !empty($complain_types)){ ?>
                                                <?php foreach($complain_types as $obj){ ?>
                                                    <option value="<?php echo $obj->id; ?>" <?php if($complain->type_id == $obj->id){ echo 'selected="selected"';} ?>><?php echo $obj->type; ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                        <div class="help-block"><?php echo form_error('type_id'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="complain_date"><?php echo lang('complain_date'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="complain_date"  id="edit_complain_date" value="<?php echo isset($complain->complain_date) ?  date('d-m-Y',strtotime($complain->complain_date)) : ''; ?>" required="required"  placeholder="<?php echo lang('complain_date'); ?>" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('complain_date'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description"><?php echo lang('complain'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control col-md-7 col-xs-12"  name="description"  id="description" required="required" placeholder="<?php echo lang('complain'); ?>"><?php echo isset($complain->description) ?  $complain->description : ''; ?></textarea>
                                        <div class="help-block"><?php echo form_error('description'); ?></div>
                                    </div>
                                </div> 
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="action_note"><?php echo lang('action'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control col-md-7 col-xs-12"  name="action_note"  id="action_note"  placeholder="<?php echo lang('action'); ?>"><?php echo isset($complain->action_note) ?  $complain->action_note : ''; ?></textarea>
                                        <div class="help-block"><?php echo form_error('action_note'); ?></div>
                                    </div>
                                </div> 
                                                        
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <input type="hidden" value="<?php echo isset($complain) ? $complain->id : $id; ?>" name="id" />
                                        <input type="hidden" value="<?php echo isset($complain) ? $complain->branch_id : $id; ?>" name="branch_id" />
                                        <a  href="<?php echo site_url('complain/index'); ?>" class="btn btn-primary"><?php echo lang('cancel'); ?></a>
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


<div class="modal fade bs-complain-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title"><?php echo lang('detail_information'); ?></h4>
        </div>
        <div class="modal-body fn_complain_data">
            
        </div>       
      </div>
    </div>
</div>
<script type="text/javascript">
         
    function get_complain_modal(complain_id){
         
        $('.fn_complain_data').html('<p style="padding: 20px;"><p style="padding: 20px;text-align:center;"><img src="<?php echo IMG_URL; ?>loading.gif" /></p>');
        $.ajax({       
          type   : "POST",
          url    : "<?php echo site_url('complain/get_single_complain'); ?>",
          data   : {complain_id : complain_id},  
          success: function(response){                                                   
             if(response)
             {
                $('.fn_complain_data').html(response);
             }
          }
       });
    }
</script>


<link href="<?php echo VENDOR_URL; ?>datepicker/datepicker.css" rel="stylesheet">
<script src="<?php echo VENDOR_URL; ?>datepicker/datepicker.js"></script>


 <script type="text/javascript">
     
  $('#add_complain_date').datepicker();
  $('#edit_complain_date').datepicker();
  $('#edit_action_date').datepicker();
  
  
    var form = 'add';
   <?php if(isset($post['type_id'])){ ?> 
      form = 'add';
   <?php } ?>
   <?php if(isset($complain)){ ?> 
      form = 'edit';
   <?php } ?> 
    
    $("document").ready(function () {
        <?php if (isset($branch_id) && !empty($branch_id)) { ?>
            $("#edit_branch_id").trigger('change');
        <?php } ?>
    });
    
     $('.fn_branch_id').on('change', function(){   
         
        var class_id = '';
        <?php if(isset($complain)){ ?> 
          class_id = '<?php echo $complain->class_id; ?>';
       <?php } ?>
           
        var branch_id = $(this).val(); 
        
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_class_by_school'); ?>",
            data   : { branch_id:branch_id, class_id:class_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {  
                  $('#'+form+'_class_id').html(response);  
               }
            }
        });     
    });
   
    <?php if(isset($post['role_id'])){ ?>  
         get_user_by_role('<?php echo $post['role_id']; ?>', '<?php echo $post['user_id']; ?>');
    <?php } ?>
        
    <?php if(isset($complain)){ ?>  
         get_user_by_role('<?php echo $complain->role_id; ?>', '<?php echo $complain->user_id; ?>');
    <?php } ?>
        
    
    function get_user_by_role(role_id, user_id){       
    
        var branch_id = $('.fn_branch_id').val();
        if( !branch_id){            
           toastr.error('<?php echo lang('select_branch'); ?>');
           $('select#'+form+'_role_id').prop('selectedIndex', 0);
           return false;
        } 
      
       if(role_id == <?php echo STUDENT; ?>){
        
           $('.display').show();
           $('#'+form+'_class_id').prop('required', true);
           $('select#'+form+'_class_id').prop('selectedIndex', 0);
           $('#'+form+'_user_id').html('<option value="">--<?php echo lang('select'); ?>--</option>'); 
                      
           
       }else{
           get_user(role_id, '', user_id);
           $('#'+form+'_class_id').prop('required', false);
           $('.display').hide();
       }
       
       
       var type_id = '';
       <?php if(isset($post['type_id'])){ ?> 
          type_id = '<?php echo $post['type_id']; ?>';
       <?php } ?>
       <?php if(isset($complain)){ ?> 
          type_id = '<?php echo $complain->type_id; ?>';
       <?php } ?>
       get_complain_type_by_school(type_id);
   }
   
   <?php if(isset($complain)){ ?> 
          get_user('', '<?php echo $complain->class_id; ?>', '<?php echo $complain->user_id; ?>');
    <?php } ?>
   
   function get_user(role_id, class_id, user_id){
       
        if(role_id == ''){
            role_id = $('#'+form+'_role_id').val();
        }
       
        var branch_id = $('.fn_branch_id ').val();
        if( !branch_id){            
           toastr.error('<?php echo lang('select_branch'); ?>');
           return false;
        }       
       
       $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_user_by_role'); ?>",
            data   : { branch_id : branch_id, role_id : role_id , class_id: class_id, user_id : user_id, message:false},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                   $('#'+form+'_user_id').html(response); 
               }
            }
        }); 
   }
   
   
   function get_complain_type_by_school(type_id){
   
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_complain_type_by_school'); ?>",
            data   : {type_id:type_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                   $('#'+form+'_type_id').html(response); 
               }
            }
        }); 
   }   


   /* Menu Filter Start */
    function get_complain_by_school(url){          
        if(url){
            window.location.href = url; 
        }
    }

 </script>
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
        
    $("#add").validate(); 
    $("#edit").validate(); 
</script>