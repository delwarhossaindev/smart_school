<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-file-text-o"></i><small> <?php echo lang('manage_merit_list'); ?></small></h3>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
                            
            <div class="x_content quick-link no-print">
                 <?php ci()->load->view('quick-link-exam'); ?> 
            </div>      
                        
            <div class="x_content no-print"> 
                <?php echo form_open_multipart(site_url('exam/meritlist/index'), array('name' => 'result', 'id' => 'result', 'class' => 'form-horizontal form-label-left'), ''); ?>
                <div class="row">  
                    
                    <?php ci()->load->view('layout/school_list_filter'); ?>
                    
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="item form-group"> 
                            <div><?php echo lang('academic_year'); ?> <span class="red">*</span></div>
                            <select  class="form-control col-md-7 col-xs-12" name="academic_year_id" required="required" id="academic_year_id">
                                <option value="">--<?php echo lang('select'); ?>--</option>
                                <?php foreach (ci()->academic_years as $obj) { ?>
                                <?php $running = $obj->is_running ? ' ['.lang('running_year').']' : ''; ?>
                                <option value="<?php echo $obj->id; ?>" <?php if(isset($academic_year_id) && $academic_year_id == $obj->id){ echo 'selected="selected"';} ?>><?php echo $obj->session_year; echo $running; ?></option>
                                <?php } ?>
                            </select>
                            <div class="help-block"><?php echo form_error('academic_year_id'); ?></div>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <div class="item form-group"> 
                            <?php $teacher_student_data = get_teacher_access_data(); ?>
                            <?php $guardian_class_data = get_guardian_access_data('class'); ?>
                            <div><?php echo lang('class'); ?>  <span class="required">*</span></div>
                            <select  class="form-control col-md-7 col-xs-12" name="class_id" id="class_id"  required="required" onchange="get_section_by_class(this.value,'');">
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
                            <div><?php echo lang('section'); ?></div>
                            <select  class="form-control col-md-7 col-xs-12" name="section_id" id="section_id">                                
                                <option value="">--<?php echo lang('select'); ?>--</option>
                            </select>
                            <div class="help-block"><?php echo form_error('section_id'); ?></div>
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
                <div class="row">                                                      
                    <div class="col-sm-6  col-xs-6 col-sm-offset-3 col-xs-offset-3 layout-box">                       
                            <?php if(isset($school)){ ?>
                            <div><img class="report-logo"  src="<?php echo UPLOAD_PATH; ?>logo/<?php echo $school->logo; ?>" alt="" width="70" /></div>
                            <h4><?php echo $school->branch_name; ?></h4>
                            <p> <?php echo $school->address; ?></p>
                            <?php } ?>
                            <h4 class="head-title_ ptint-title"><small> <?php echo lang('merit_list'); ?> </small></h4>                
                            <?php if(isset($academic_year)){ ?>
                            <div> &nbsp;
                            <?php echo lang('academic_year'); ?>: <?php echo $academic_year; ?>
                            </div>
                            <?php } ?>
                            <div>
                            <?php if(isset($class)){ ?>
                            <?php echo lang('class'); ?>: <?php echo $class; ?>
                            <?php } ?>
                            <?php if(isset($section)){ ?>
                            , <?php echo lang('section'); ?>: <?php echo $section; ?>
                            <?php } ?>
                            </div>                        
                    </div>
                </div>            
            </div>
            
            <div class="x_content">
                <table id="datatable-responsive" class="table table-striped_ table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th><?php echo lang('roll_no'); ?></th>
                            <th><?php echo lang('name'); ?></th>
                            <th><?php echo lang('photo'); ?></th>                            
                            <th><?php echo lang('total_subject'); ?></th>                                            
                            <th><?php echo lang('exam_mark'); ?></th>                                            
                            <th><?php echo lang('obtain_mark'); ?></th> 
                            <th ><?php echo lang('percentage'); ?></th> 
                            <th> <?php echo lang('average_grade_point'); ?></th>                                            
                            <th><?php echo lang('letter_grade'); ?></th>                                            
                            <th><?php echo lang('status'); ?></th>   
                            <?php if(isset($section_id) && !empty($section_id)){ ?>
                            <th ><?php echo lang('position_in_section'); ?></th>  
                            <?php } ?>
                            <th ><?php echo lang('position_in_class'); ?></th>   
                            <th><?php echo lang('remark'); ?></th>  
                        </tr>
                    </thead>
                     <tbody>   
                            <?php 

                            $count = 1; if(isset($examresult) && !empty($examresult)){ ?>
                                <?php foreach($examresult as $obj){ ?>
                                <?php $class_position   = get_student_position($branch_id, $academic_year_id, $class_id, $obj->student_id); ?>    
                                <?php $section_position = get_student_position($branch_id, $academic_year_id, $class_id,$obj->student_id, $obj->section_id); ?> 
                                <tr>
                                    <td><?php echo $obj->roll_no; ?></td>
                                    <td><?php echo $obj->student; ?></td>
                                    <td>
                                        <?php if ($obj->photo != '') { ?>
                                            <img src="<?php echo UPLOAD_PATH; ?>student-photo/<?php echo $obj->photo; ?>" alt="" width="45" /> 
                                        <?php } else { ?>
                                            <img src="<?php echo IMG_URL; ?>default-user.png" alt="" width="45" /> 
                                        <?php } ?>
                                        <input type="hidden" value="<?php echo $obj->id; ?>"  name="students[]" />       
                                    </td>  
                                    <td><?php echo $obj->total_subject; ?></td>
                                    <td><?php echo $obj->total_mark; ?></td>
                                    <td><?php echo $obj->total_obtain_mark; ?></td>
                                    <td><?php echo $obj->total_mark > 0 && $obj->total_obtain_mark > 0 ? number_format($obj->total_obtain_mark/$obj->total_mark*100, 2) : 0; ?>%</td> 
                                    <td><?php echo $obj->avg_grade_point; ?></td>
                                    <td><?php echo $obj->grade; ?></td>
                                    <td><?php echo lang($obj->result_status); ?></td>
                                     <?php if($section_id){ ?>
                                        <td><?php echo $section_position; ?></td> 
                                    <?php } ?>
                                    <td><?php echo $class_position; ?></td> 
                                    <td><?php echo $obj->remark; ?></td>
                                </tr>
                                <?php } ?>                                        
                            <?php }else{ ?>
                                <tr><td colspan="13" class="text-center"><?php echo lang('no_data_found'); ?></td></tr>
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
         <?php if(isset($branch_id) && !empty($branch_id) && ci()->session->userdata('role_id') == SUPER_ADMIN){ ?>               
            $(".fn_branch_id").trigger('change');
         <?php } ?>
    });
    
    $('.fn_branch_id').on('change', function(){
      
        var branch_id = $(this).val();
        var class_id = '';
        
        <?php if(isset($branch_id) && !empty($branch_id)){ ?>
            class_id =  '<?php echo $class_id; ?>';           
         <?php } ?> 
           
        if(!branch_id){
           toastr.error('<?php echo lang('select_branch'); ?>');
           return false;
        }
        
        get_class_by_school(branch_id,class_id);   
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
        
        var branch_id = $('.fn_branch_id').val();     
             
        if(!branch_id){
           toastr.error('<?php echo lang('select_branch'); ?>');
           return false;
        } 
        
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_section_by_class'); ?>",
            data   : {branch_id : branch_id, class_id : class_id , section_id: section_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                  $('#section_id').html(response);
               }
            }
        });         
    } 
    $("#result").validate(); 
 
</script>



