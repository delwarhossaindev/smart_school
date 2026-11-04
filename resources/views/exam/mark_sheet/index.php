<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-file-text-o"></i><small> <?php echo lang('manage_mark_sheet'); ?></small></h3>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
                                      
            <div class="x_content quick-link no-print">
                 <?php ci()->load->view('quick-link-exam'); ?> 
            </div>  
            
            <div class="x_content no-print"> 
                <?php echo form_open_multipart(site_url('exam/marksheet/index'), array('name' => 'marksheet', 'id' => 'marksheet', 'class' => 'form-horizontal form-label-left'), ''); ?>
                <div class="row"> 
                        
                    <?php ci()->load->view('layout/school_list_filter'); ?>  
                    
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="item form-group"> 
                            <div><?php echo lang('academic_year'); ?>  <span class="required">*</span></div>
                            <select  class="form-control col-md-7 col-xs-12" name="academic_year_id" id="academic_year_id" required="required">
                                <option value="">--<?php echo lang('select'); ?>--</option>
                                <?php foreach (ci()->academic_years as $obj) { ?>
                                <?php $running = $obj->is_running ? ' ['.lang('running_year').']' : ''; ?>
                                <option value="<?php echo $obj->id; ?>" <?php if(isset($academic_year_id) && $academic_year_id == $obj->id){ echo 'selected="selected"';} ?>><?php echo $obj->session_year; echo $running; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                        
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="item form-group"> 
                            <div><?php echo lang('exam'); ?>  <span class="required">*</span></div>
                            <select  class="form-control col-md-7 col-xs-12" name="exam_id" id="exam_id"  required="required">
                                <option value="">--<?php echo lang('select'); ?>--</option>
                                <?php foreach ($exams as $obj) { ?>
                                <option value="<?php echo $obj->id; ?>" <?php if(isset($exam_id) && $exam_id == $obj->id){ echo 'selected="selected"';} ?>><?php echo $obj->title; ?></option>
                                <?php } ?>
                            </select>
                            <div class="help-block"><?php echo form_error('exam_id'); ?></div>
                        </div>
                    </div>
                    
                    <?php if(ci()->session->userdata('role_id') != STUDENT ){ ?>    
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <div class="item form-group"> 
                                <?php $teacher_student_data = get_teacher_access_data(); ?>
                                <?php $guardian_class_data = get_guardian_access_data('class'); ?>
                                <div><?php echo lang('class'); ?> <span class="required">*</span></div>
                                <select  class="form-control col-md-7 col-xs-12" name="class_id" id="class_id"  required="required" onchange="get_section_by_class(this.value,'','');">
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
                            <div><?php echo lang('section'); ?>  <span class="required">*</span></div>
                            <select  class="form-control col-md-7 col-xs-12" name="section_id" id="section_id" required="required" onchange="get_student_by_section(this.value,'');">                                
                                <option value="">--<?php echo lang('select'); ?>--</option>
                            </select>
                            <div class="help-block"><?php echo form_error('section_id'); ?></div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="item form-group"> 
                            <div><?php echo lang('student'); ?>  <span class="required">*</span></div>
                            <select  class="form-control col-md-7 col-xs-12" name="student_id" id="student_id" required="required">                                
                                <option value="">--<?php echo lang('select'); ?>--</option>
                            </select>
                            <div class="help-block"><?php echo form_error('student_id'); ?></div>
                        </div>
                    </div>
                    <?php } ?>    
                                   
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <div class="form-group"><br/>
                            <button id="send" type="submit" class="btn btn-success"><?php echo lang('find'); ?></button>
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>

            <?php  if (isset($student) && !empty($student)) { ?>
            <div class="x_content">             
                <div class="row">
                    <div class="col-sm-6 col-xs-6  col-sm-offset-3  col-xs-offset-3 layout-box">
                     
                            <?php if(isset($school)){ ?>
                            <div>
                                <?php if($school->logo){ ?>
                                    <img class="report-logo" src="<?php echo UPLOAD_PATH; ?>logo/<?php echo $school->logo; ?>" alt="" /> 
                                 <?php }else if($school->frontend_logo){ ?>
                                    <img class="report-logo" src="<?php echo UPLOAD_PATH; ?>logo/<?php echo $school->frontend_logo; ?>" alt="" /> 
                                 <?php }else{ ?>                                                        
                                    <img class="report-logo" src="<?php echo UPLOAD_PATH; ?>logo/<?php echo ci()->global_setting->brand_logo; ?>" alt=""  />
                                 <?php } ?>
                            </div>
                            <h4><?php echo $school->branch_name; ?></h4>
                            <p> <?php echo $school->address; ?></p>
                            <?php } ?>
                            <h4><?php echo lang('mark_sheet'); ?></h4> 
                            <?php echo lang('name'); ?> : <?php echo $student->name; ?><br/>
                            <?php echo lang('exam'); ?> : <?php echo $exam->title; ?><br/>
                            <?php echo lang('class'); ?> : <?php echo $student->class_name; ?>,
                            <?php echo lang('section'); ?> : <?php echo $student->section; ?>,
                            <?php echo lang('roll_no'); ?> : <?php echo $student->roll_no; ?>                       
                    </div>
                </div>            
            </div>
             <?php } ?>
            
            <div class="x_content">
                
                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                   <thead>
                        <tr>
                            <th rowspan="2"><?php echo lang('sl_no'); ?></th>
                            <th rowspan="2"><?php echo lang('subject'); ?></th>
                            <th colspan="2"><?php echo lang('written'); ?></th>                                            
                            <th colspan="2"><?php echo lang('tutorial'); ?></th>                                            
                            <th colspan="2"><?php echo lang('practical'); ?></th>                                            
                            <th colspan="2"><?php echo lang('viva'); ?></th>                                            
                            <th colspan="2"><?php echo lang('total'); ?></th>                                            
                            <th rowspan="2"><?php echo lang('letter_grade'); ?></th>                                            
                            <th rowspan="2"><?php echo lang('grade_point'); ?></th>                                            
                            <th rowspan="2"><?php echo lang('lowest'); ?></th>                                            
                            <th rowspan="2"><?php echo lang('height'); ?></th>                                            
                            <th rowspan="2"><?php echo lang('position'); ?></th>                                              
                        </tr>
                        <tr>                           
                            <th><?php echo lang('mark'); ?></th>                                            
                            <th><?php echo lang('obtain'); ?></th>                                            
                            <th><?php echo lang('mark'); ?></th>                                            
                            <th><?php echo lang('obtain'); ?></th>                                            
                            <th><?php echo lang('mark'); ?></th>                                            
                            <th><?php echo lang('obtain'); ?></th>                                            
                            <th><?php echo lang('mark'); ?></th>                                            
                            <th><?php echo lang('obtain'); ?></th>                                            
                            <th><?php echo lang('mark'); ?></th>                                            
                            <th><?php echo lang('obtain'); ?></th> 
                        </tr>
                    </thead>
                    <tbody id="fn_mark">   
                        <?php
                        $count = 1;
                        if (isset($subjects) && !empty($subjects)) {
                            ?>
                            <?php foreach ($subjects as $obj) { ?>
                            <?php $lh = get_lowet_height_mark($branch_id, $academic_year_id, $exam_id, $class_id, $section_id, $obj->subject_id ); ?>
                            <?php $position = get_position_in_subject($branch_id, $academic_year_id, $exam_id, $class_id, $section_id, $obj->subject_id , $obj->obtain_total_mark); ?>
                                <tr>
                                    <td><?php echo $count++;  ?></td>
                                    <td><?php echo ucfirst($obj->subject); ?></td>
                                    <td><?php echo $obj->written_mark; ?></td>
                                    <td><?php echo $obj->written_obtain; ?></td>
                                    <td><?php echo $obj->tutorial_mark; ?></td>
                                    <td><?php echo $obj->tutorial_obtain; ?></td>
                                    <td><?php echo $obj->practical_mark; ?></td>
                                    <td><?php echo $obj->practical_obtain; ?></td>
                                    <td><?php echo $obj->viva_mark; ?></td>
                                    <td><?php echo $obj->viva_obtain; ?></td>
                                    <td><?php echo $obj->exam_total_mark; ?></td>
                                    <td><?php echo $obj->obtain_total_mark; ?></td>
                                    <td><?php echo $obj->name; ?></td>
                                    <td><?php echo $obj->point; ?></td>                               
                                    <td><?php echo $lh->lowest; ?></td>                               
                                    <td><?php echo $lh->height; ?></td>                               
                                    <td><?php echo $position; ?></td>                               
                                </tr>
                            <?php } ?>
                        <?php }else{ ?>
                                <tr>
                                    <td colspan="17" align="center"><?php echo lang('no_data_found'); ?></td>
                                </tr>
                        <?php } ?>
                    </tbody>
                </table>             
            </div> 
            <div class="row no-print">
                <div class="col-xs-12 text-right">
                    <button class="btn btn-default " onclick="window.print();"><i class="fa fa-print"></i> <?php echo lang('print'); ?></button>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 no-print">
                <div class="instructions"><strong><?php echo lang('instruction'); ?>: </strong> <?php echo lang('mark_sheet_instruction'); ?></div>
            </div>
        </div>
    </div>
</div>

 
<!-- Super admin js START  -->
 <script type="text/javascript">
        
     $("document").ready(function() {
         <?php if(isset($branch_id) && !empty($branch_id)  && ci()->session->userdata('role_id') == SUPER_ADMIN){ ?>               
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
            data   : { branch_id:branch_id, exam_id:exam_id},               
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
        get_section_by_class('<?php echo $class_id; ?>', '<?php echo $section_id; ?>');
    <?php } ?>
    
    
    function get_section_by_class(class_id, section_id){       
       
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
    }
 
    <?php if(isset($class_id) && isset($section_id)){ ?>
        get_student_by_section('<?php echo $section_id; ?>', '<?php echo $student_id; ?>');
    <?php } ?>
    
    function get_student_by_section(section_id, student_id){       
        
        var branch_id = $('#branch_id').val();  
        if(!branch_id){
           toastr.error('<?php echo lang('select_branch'); ?>');
           return false;
        } 
           
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_student_by_section'); ?>",
            data   : {branch_id:branch_id, section_id: section_id, student_id: student_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                  $('#student_id').html(response);
               }
            }
        });         
    }
 
  $("#marksheet").validate(); 
</script>
<style>
.table>thead>tr>th {
    padding: 4px;
}
</style>



