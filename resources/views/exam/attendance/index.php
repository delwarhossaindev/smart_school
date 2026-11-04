<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-graduation-cap"></i><small> <?php echo lang('manage_exam_attendance'); ?></small></h3>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
          <div class="x_content quick-link">
                 <?php ci()->load->view('quick-link'); ?> 
            </div>
            <div class="x_content"> 
                <?php echo form_open_multipart(site_url('exam/attendance/index'), array('name' => 'student', 'id' => 'student', 'class' => 'form-horizontal form-label-left'), ''); ?>
                <div class="row">
                    
                    <div class="col-md-10 col-sm-10 col-xs-12">
                        
                        <?php ci()->load->view('layout/school_list_filter'); ?>  
                        
                        <div class="col-md-2 col-sm-2 col-xs-12">
                            <div class="item form-group"> 
                                <div><?php echo lang('exam'); ?> <span class="required">*</span></div>
                                <select  class="form-control col-md-7 col-xs-12" name="exam_id" id="exam_id"  required="required">
                                    <option value="">--<?php echo lang('select'); ?>--</option>
                                    <?php foreach ($exams as $obj) { ?>
                                    <option value="<?php echo $obj->id; ?>" <?php if(isset($exam_id) && $exam_id == $obj->id){ echo 'selected="selected"';} ?>><?php echo $obj->title; ?></option>
                                    <?php } ?>
                                </select>
                                <div class="help-block"><?php echo form_error('exam_id'); ?></div>
                            </div>
                        </div>
                        
                        <div class="col-md-2 col-sm-2 col-xs-12">
                            <div class="item form-group"> 
                                <?php $teacher_student_data = get_teacher_access_data(); ?>
                                <?php $guardian_class_data = get_guardian_access_data('class'); ?>
                                <div><?php echo lang('class'); ?> <span class="required">*</span></div>
                                <select  class="form-control col-md-7 col-xs-12" name="class_id" id="class_id"  required="required" onchange="get_section_subject_by_class(this.value,'','');">
                                    <option value="">--<?php echo lang('select'); ?>--</option>
                                    <?php foreach ($classes as $obj) { ?>
                                        <?php if(ci()->session->userdata('role_id') == TEACHER && !in_array($obj->id, $teacher_student_data)){ continue;  ?>
                                    <?php }elseif(ci()->session->userdata('role_id') == GUARDIAN && !in_array($obj->id, $guardian_class_data)){ continue; } ?>
                                        <option value="<?php echo $obj->id; ?>" <?php if(isset($class_id) && $class_id == $obj->id){ echo 'selected="selected"';} ?>><?php echo $obj->name; ?></option>
                                    <?php } ?>
                                </select>
                                <div class="help-block"><?php echo form_error('class_id'); ?></div>
                            </div>
                        </div>

                        <div class="col-md-2 col-sm-2 col-xs-12">
                            <div class="item form-group"> 
                                <div><?php echo lang('section'); ?> </div>
                                <select  class="form-control col-md-7 col-xs-12" name="section_id" id="section_id">                                
                                    <option value="">--<?php echo lang('select'); ?>--</option>
                                </select>
                                <div class="help-block"><?php echo form_error('section_id'); ?></div>
                            </div>
                        </div>
                        
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="item form-group"> 
                                <div><?php echo lang('subject'); ?> <span class="required">*</span></div>
                                <select  class="form-control col-md-7 col-xs-12" name="subject_id" id="subject_id" required="required">                                
                                    <option value="">--<?php echo lang('select'); ?>--</option>
                                </select>
                                <div class="help-block"><?php echo form_error('subject_id'); ?></div>
                            </div>
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

           <?php  if (isset($students) && !empty($students)) { ?>
            <div class="x_content">             
                <div class="row">
                    <div class="col-sm-4  col-sm-offset-4 layout-box">
                        <p>
                            <h4><?php echo lang('exam_attendance'); ?></h4>                            
                        </p>
                    </div>
                </div>            
            </div>
             <?php } ?>
            
            <div class="x_content">
                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th><?php echo lang('sl_no'); ?></th>
                            <th><?php echo lang('name'); ?></th>
                            <th><?php echo lang('phone'); ?></th>
                            <th><?php echo lang('roll_no'); ?></th>
                            <th><?php echo lang('photo'); ?></th>
                            <th>
                                <?php if(has_permission(VIEW, 'exam', 'attendance') && !has_permission(EDIT, 'exam', 'attendance')){ ?>
                                    <input type="checkbox" value="1" name="present" id="fn_present" disabled="disabled" class=""/> <?php echo lang('attend_all'); ?>
                                <?php }else if(has_permission(EDIT, 'exam', 'attendance')){ ?> 
                                    <input type="checkbox" value="1" name="present" id="fn_present" class="fn_all_attendnce"/> <?php echo lang('attend_all'); ?>
                                <?php } ?> 
                                    
                            </th>                                            
                        </tr>
                    </thead>
                    <tbody id="fn_attendance">   
                        <?php
                        $count = 1;
                        if (isset($students) && !empty($students)) {
                            ?>
                            <?php foreach ($students as $obj) { ?>
                            <?php $attendance = get_exam_attendance($branch_id, $obj->student_id, $academic_year_id, $exam_id, $class_id, $section_id, $subject_id); ?>
                                <tr>
                                    <td><?php echo $count++;  ?></td>
                                    <td><?php echo ucfirst($obj->student_name); ?></td>
                                    <td><?php echo $obj->phone; ?></td>
                                    <td><?php echo $obj->roll_no; ?></td>
                                    <td>
                                        <?php if ($obj->photo != '') { ?>
                                            <img src="<?php echo UPLOAD_PATH; ?>student-photo/<?php echo $obj->photo; ?>" alt="" width="60" /> 
                                        <?php } else { ?>
                                            <img src="<?php echo IMG_URL; ?>default-user.png" alt="" width="60" /> 
                                        <?php } ?>
                                    </td>  
                                    <td>
                                        <?php if(has_permission(VIEW, 'exam', 'attendance') && !has_permission(EDIT, 'exam', 'attendance')){ ?>
                                            <input type="checkbox" value="1" itemid="<?php echo $obj->student_id; ?>" name="student_<?php echo $obj->id; ?>"  disabled="disabled" class="" <?php if($attendance){ echo 'checked="checked"'; } ?> />
                                        <?php }else if(has_permission(EDIT, 'exam', 'attendance')){ ?> 
                                            <input type="checkbox" value="1" itemid="<?php echo $obj->student_id; ?>" name="student_<?php echo $obj->id; ?>" class="present fn_single_attendnce" <?php if($attendance){ echo 'checked="checked"'; } ?> />
                                        <?php } ?> 
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php }else{ ?>
                                <tr>
                                    <td colspan="9" align="center"><?php echo lang('no_data_found'); ?></td>
                                </tr>
                        <?php } ?>
                    </tbody>
                </table>                
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="instructions"><strong><?php echo lang('instruction'); ?>: </strong> <?php echo lang('exam_attendance_instruction'); ?></div>
                </div>
            </div> 
            
        </div>
    </div>
</div>

<!-- Super admin js START  -->
 <script type="text/javascript">
        
     $("document").ready(function() {
         <?php if(isset($branch_id) && !empty($branch_id)){ ?>               
            $(".fn_branch_id").trigger('change');
         <?php } ?>
    });
    
    $('.fn_branch_id').on('change', function(){
      
        var branch_id = $(this).val();
        var exam_id = '';
        var class_id = '';
        
        <?php if(isset($branch_id) && !empty($branch_id)){ ?>
            exam_id =  '<?php echo $exam_id; ?>';           
            class_id =  '<?php echo $class_id; ?>';           
         <?php } ?> 
           
        if(!branch_id){
           toastr.error('<?php echo lang('select_branch'); ?>');
           return false;
        }
       
       $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_exam_by_school'); ?>",
            data   : { exam_id:exam_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               { 
                    $('#exam_id').html(response);  
                   get_class_by_school(branch_id,class_id); 
               }
            }
        });
    }); 

   function get_class_by_school(branch_id, class_id){       
         
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
  
   
  </script>
<!-- Super admin js end -->

 <script type="text/javascript">

    <?php if(isset($class_id) && isset($section_id)){ ?>
        get_section_subject_by_class('<?php echo $class_id; ?>', '<?php echo $section_id; ?>', '<?php echo $subject_id; ?>');
    <?php } ?>
    
    function get_section_subject_by_class(class_id, section_id, subject_id){       
           
        var branch_id = $('#branch_id').val();      
             
        if(!branch_id){
           toastr.error('<?php echo lang('select_branch'); ?>');
           return false;
        } 
         
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_section_by_class'); ?>",
            data   : {branch_id:branch_id, class_id : class_id , section_id: section_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                  $('#section_id').html(response);
               }
            }
        }); 
        
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_subject_by_class'); ?>",
            data   : {branch_id:branch_id, class_id : class_id , subject_id: subject_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                  $('#subject_id').html(response);
               }
            }
        }); 
        
        
    }
  
  $(document).ready(function(){
  
       $('#fn_present').click(function(){
           
           if($(this).prop('checked')) {   
               $('input:checkbox').removeAttr('checked');
               $(this).prop('checked', true);
               $('.present').prop('checked', true);
           }else{
               $('.present').prop('checked', false);
           }           
       });
       
       
       $('.fn_single_attendnce').click(function(){
           
          var status     = $(this).prop('checked') ? $(this).val() : '';
          var student_id = $(this).attr('itemid');
          var branch_id   = $('#branch_id').val();
          var class_id   = $('#class_id').val();
          var section_id = $('#section_id').val();        
          var subject_id = $('#subject_id').val(); 
          var exam_id   = $('#exam_id').val();
          var obj        = $(this);
          
          if(!student_id){
           toastr.error('<?php echo lang('select_student'); ?>');
           return false;
          } 
          
          $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('exam/attendance/update_single'); ?>",
            data   : {branch_id:branch_id, status : status , exam_id:exam_id, student_id: student_id, class_id:class_id, section_id:section_id, subject_id:subject_id},               
            async  : false,
            success: function(response){ 
                if(response == 'ay'){
                    
                    toastr.error('<?php echo lang('please_set_academic_year'); ?>'); 
                    $(obj).prop('checked', false);
                    
                }else if(response == 1){
                    toastr.success('<?php echo lang('update_success'); ?>'); 
                }else{
                    toastr.error('<?php echo lang('update_failed'); ?>'); 
                    $(obj).prop('checked', false);
                }               
            }
        }); 
                      
       });
       
         $('.fn_all_attendnce').click(function(){
           
          var status     = $(this).prop('checked') ? $(this).val() : '';         
          var branch_id   = $('#branch_id').val();
          var exam_id   = $('#exam_id').val();
          var class_id   = $('#class_id').val();
          var section_id = $('#section_id').val();
          var subject_id = $('#subject_id').val();
          var obj        = $(this);
          
          $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('exam/attendance/update_all'); ?>",
            data   : {branch_id:branch_id, status : status , exam_id:exam_id, class_id:class_id, section_id:section_id, subject_id:subject_id },               
            async  : false,
            success: function(response){
                
                if(response == 'ay'){
                    
                    toastr.error('<?php echo lang('please_set_academic_year'); ?>'); 
                    $('.fn_single_attendnce').prop('checked', false);
                    $(obj).prop('checked', false);
                    
                }else if(response == 1){
                    toastr.success('<?php echo lang('update_success'); ?>'); 
                }else{
                    toastr.error('<?php echo lang('update_failed'); ?>'); 
                    $('.fn_single_attendnce').prop('checked', false);
                    $(obj).prop('checked', false);
                }              
            }
        }); 
                      
       });
  });  
   $("#student").validate();    
</script>


