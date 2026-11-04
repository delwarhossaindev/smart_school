<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title no-print">
                <h3 class="head-title"><i class="fa fa-users"></i><small> <?php echo lang('manage_user'); ?></small></h3>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
            
             <div class="x_content quick-link no-print">
                <?php ci()->load->view('quick-link'); ?>
            </div>
            
            <div class="x_content no-print"> 
                <?php echo form_open_multipart(site_url('administrator/user/index'), array('name' => 'user', 'id' => 'user', 'class' => 'form-horizontal form-label-left'), ''); ?>
                <div class="row">
                  
                    <?php ci()->load->view('layout/school_list_filter'); ?>
                    
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <div class="item form-group"> 
                            <div><?php echo lang('user_type'); ?> <span class="required"> *</span></div>
                            <select  class="form-control col-md-7 col-xs-12"  name="role_id"  id="role_id" required="required" onchange="get_user_by_role(this.value, '', '');">
                                <option value="">--<?php echo lang('select'); ?>--</option> 
                                <?php foreach($roles as $obj ){ ?>
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
                                <?php if(isset($classes) && !empty($classes)){ ?>
                                    <?php foreach($classes as $obj ){ ?>
                                    <option value="<?php echo $obj->id; ?>" <?php if(isset($class_id) && $class_id == $obj->id){ echo 'selected="selected"'; } ?>><?php echo $obj->name; ?></option>
                                    <?php } ?> 
                                <?php } ?> 
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
            
             <div class="x_content no-print">
                <div class="" data-example-id="togglable-tabs">                    
                    <ul  class="nav nav-tabs bordered">                 
                        <li  class="active"><a href="#tab_user_list" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-users"></i> <?php echo lang('user'); ?></a></li>                          
                    </ul>
                    <br/>
                     <div class="tab-content">
                        <div  class="tab-pane fade in active" id="tab_user_list" >
                           
                            <div class="x_content">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo lang('sl_no'); ?></th>
                                        <th><?php echo lang('photo'); ?></th>                                                                    
                                        <th><?php echo lang('name'); ?></th>
                                        <th><?php echo lang('phone'); ?></th>
                                        <th><?php echo lang('email'); ?></th>
                                        <th><?php echo lang('created'); ?></th>                                            
                                        <th><?php echo lang('status'); ?></th>                                            
                                    </tr>
                                </thead>
                                <tbody id="fn_mark">   
                                    <?php
                                    $count = 1;
                                    if (isset($users) && !empty($users)) {
                                        ?>
                                        <?php foreach ($users as $obj) { ?>
                                            <?php
                                            $view = '';
                                            $img_path = '';
                                            $path_edit = '';
                                            
                                            if($role_id == STUDENT){ 
                                                $view = site_url('student/get_single_student');
                                                $path_edit = site_url('student/edit/'.$obj->id);
                                                $img_path = 'student';
                                            }elseif($role_id == GUARDIAN){ 
                                                $view = site_url('guardian/get_single_guardian');
                                                $path_edit = site_url('guardian/edit/'.$obj->id);
                                                $img_path = 'guardian';
                                            }elseif($role_id == TEACHER){ 
                                                $view = site_url('teacher/get_single_teacher'); 
                                                $path_edit = site_url('teacher/edit/'.$obj->id);
                                                $img_path = 'teacher';
                                            }else{ 
                                                $view = site_url('hrm/employee/get_single_employee');
                                                $path_edit = site_url('hrm/employee/edit/'.$obj->id);
                                                $img_path = 'employee';
                                             }
                                            ?>
                                            <tr>
                                                <td><?php echo $count++;  ?></td>
                                                <td>
                                                    <?php if ($obj->photo != '') { ?>                                        
                                                        <img src="<?php echo UPLOAD_PATH; ?><?php echo $img_path; ?>-photo/<?php echo $obj->photo; ?>" alt="" width="60" /> 
                                                    <?php } else { ?>
                                                        <img src="<?php echo IMG_URL; ?>default-user.png" alt="" width="60" /> 
                                                    <?php } ?>
                                                </td>
                                                <td><?php echo ucfirst($obj->name); ?></td>
                                                <td><?php echo $obj->phone; ?></td>
                                                <td><?php echo $obj->email; ?></td>   
                                                <td><?php echo date(ci()->global_setting->date_format, strtotime($obj->created_at)); ?></td>   
                                                <td>                                                                                                      
                                                    <?php if(has_permission(EDIT, 'administrator', 'user')){ ?>
                                                        <?php if($obj->login_status){ ?>
                                                            <a class="btn btn-success btn-xs">  <i class="fa fa-check"> <?php echo lang('login'); ?> <?php echo lang('active'); ?></i></a>
                                                            <a class="btn btn-danger btn-xs fn_update_status" id="<?php echo $obj->user_id; ?>" itemid="0"><i class="fa fa-ban"> <?php echo lang('in_activate_now'); ?></i></a>
                                                        <?php }else{ ?>
                                                            <a class="btn btn-danger btn-xs" ><i class="fa fa-ban"> <?php echo lang('login'); ?> <?php echo lang('in_active'); ?></i></a>
                                                            <a class="btn btn-success btn-xs fn_update_status"  id="<?php echo $obj->user_id; ?>" itemid="1"><i class="fa fa-check"> <?php echo lang('activate_now'); ?></i></a>
                                                        <?php } ?>                                                        
                                                        <a href="<?php echo $path_edit; ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil-square-o"> <?php echo lang('edit'); ?></i></a>
                                                    <?php } ?>                                          
                                                 
                                                    <a  onclick="get_user_modal(<?php echo $obj->id; ?>,'<?php echo $view; ?>');"  data-toggle="modal" data-target=".bs-user-modal-lg"  class="btn btn-success btn-xs"><i class="fa fa-eye"></i> <?php echo lang('view'); ?> </a><br/>
                                                       
                                                </td>   
                                            </tr>
                                        <?php } ?>
                                    <?php } ?> 

                                </tbody>
                            </table>   

                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="instructions"><strong><?php echo lang('instruction'); ?>: </strong> <?php echo lang('manage_user_instruction'); ?></div>
                            </div>
                        </div> 
                        </div>
                 </div>
            </div>

            
        </div>
        </div>
    </div>
</div>



<div class="modal fade bs-user-modal-lg no-print" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title"><?php echo lang('detail_information'); ?>AA</h4>
        </div>
        <div class="modal-body fn_user_data no-print"></div>       
      </div>
    </div>
</div>
<script type="text/javascript">
         
    function get_user_modal(user_id, path){   
         
        $('.fn_user_data').html('<p style="padding: 20px;"><p style="padding: 20px;text-align:center;"><img src="<?php echo IMG_URL; ?>loading.gif" /></p>');
        $.ajax({       
          type   : "POST",
          url    : path,
          data   : { employee_id: user_id, student_id: user_id, teacher_id: user_id, guardian_id: user_id },  
          success: function(response){                                                   
             if(response)
             {
                $('.fn_user_data').html(response);
             }
          }
       });
    }
</script>



<!-- Student modal -->
<div class="modal fade bs-student-modal-lg no-print" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content no-print">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title"><?php echo lang('detail_information'); ?></h4>
        </div>
        <div class="modal-body fn_student_data"></div>       
      </div>
    </div>
</div>
<script type="text/javascript">
         
    function get_student_modal(student_id){
         
        $('.fn_student_data').html('<p style="padding: 20px;"><p style="padding: 20px;text-align:center;"><img src="<?php echo IMG_URL; ?>loading.gif" /></p>');
        $.ajax({       
          type   : "POST",
          url    : "<?php echo site_url('student/get_single_student'); ?>",
          data   : {student_id : student_id},  
          success: function(response){                                                   
             if(response)
             {
                $('.fn_student_data').html(response);
             }
          }
       });
    }
</script>
<!-- Student modal end -->

<?php ci()->load->view('accounting/invoice/invoice-modal'); ?>  
<?php ci()->load->view('student/activity/student-activity-modal'); ?>    


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
           toastr.error('<?php echo lang('select_branch'); ?>');
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
                   toastr.success('<?php echo lang('update_success') ?>'); 
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
        
     $("#user").validate();    
</script> 
