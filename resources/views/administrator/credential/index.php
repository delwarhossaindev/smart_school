<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-asterisk"></i><small> <?php echo lang('manage_user_credential'); ?></small></h3>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content quick-link">
                 <?php ci()->load->view('quick-link'); ?>
            </div>
            
            
            <div class="x_content"> 
                <?php echo form_open_multipart(site_url('administrator/usercredential/index'), array('name' => 'user', 'id' => 'user', 'class' => 'form-horizontal form-label-left'), ''); ?>
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
            
             <div class="x_content">
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
                                        <?php if(ci()->session->userdata('role_id') == SUPER_ADMIN){ ?>
                                            <th><?php echo lang('branch'); ?></th>
                                        <?php } ?>
                                        <th><?php echo lang('photo'); ?></th>                                                                    
                                        <th><?php echo lang('name'); ?></th>
                                        <th><?php echo lang('phone'); ?></th>
                                        <th><?php echo lang('email'); ?></th>
                                        <th><?php echo lang('username'); ?></th>                                            
                                        <th><?php echo lang('password'); ?></th>                                            
                                        <th><?php echo lang('action'); ?></th>                                            
                                    </tr>
                                </thead>
                                <tbody id="fn_mark">   
                                    <?php
                                    $count = 1;
                                    if (isset($users) && !empty($users)) {
                                        ?>
                                        <?php foreach ($users as $obj) { ?>
                                           <?php
                                            $path = '';
                                            $photo = '';
                                            if($role_id == STUDENT){ 
                                                $path = site_url('student/get_single_student');
                                                $photo = 'student-photo';
                                            }elseif($role_id == GUARDIAN){ 
                                                $path = site_url('guardian/get_single_guardian');    
                                                 $photo = 'guardian-photo';
                                            }elseif($role_id == TEACHER){ 
                                                $path = site_url('teacher/get_single_teacher'); 
                                                 $photo = 'teacher-photo';
                                            }else{ 
                                                $path = site_url('hrm/employee/get_single_employee');
                                                $photo = 'employee-photo';
                                            }
                                            ?>
                                            <tr>
                                                <td><?php echo $count++;  ?></td>
                                                <?php if(ci()->session->userdata('role_id') == SUPER_ADMIN){ ?>
                                                    <td><?php echo $obj->branch_name; ?></td>
                                                <?php } ?>
                                                <td>
                                                    <?php if ($obj->photo != '') { ?>                                        
                                                        <img src="<?php echo UPLOAD_PATH; ?><?php echo $photo; ?>/<?php echo $obj->photo; ?>" alt="" width="50" /> 
                                                    <?php } else { ?>
                                                        <img src="<?php echo IMG_URL; ?>default-user.png" alt="" width="50" /> 
                                                    <?php } ?>
                                                </td>
                                                <td><?php echo ucfirst($obj->name); ?></td>
                                                <td><?php echo $obj->phone; ?></td>
                                                <td><?php echo $obj->email; ?></td>   
                                                <td><?php echo $obj->username; ?></td>   
                                                <td><?php echo base64_decode($obj->temp_password); ?></td>   
                                                <td>                                                                                                   
                                                    <a  onclick="get_user_modal(<?php echo $obj->id; ?>,'<?php echo $path; ?>');"  data-toggle="modal" data-target=".bs-user-modal-lg"  class="btn btn-success btn-xs"><i class="fa fa-eye"></i> <?php echo lang('view'); ?> </a><br/>
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



<div class="modal fade bs-user-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title"><?php echo lang('detail_information'); ?></h4>
        </div>
        <div class="modal-body fn_user_data"></div>       
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
<div class="modal fade bs-student-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
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
