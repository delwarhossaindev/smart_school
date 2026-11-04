<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-file-text-o"></i><small> <?php echo lang('manage_exam_term_result'); ?></small></h3>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
                         
            <div class="x_content quick-link">
                 <?php ci()->load->view('quick-link-exam'); ?> 
            </div>  
            
            <div class="x_content"> 
                <?php echo form_open_multipart(site_url('exam/examresult/index'), array('name' => 'result', 'id' => 'result', 'class' => 'form-horizontal form-label-left'), ''); ?>
                <div class="row"> 
                    
                    <div class="col-md-10 col-sm-10 col-xs-12">
                    
                    <?php ci()->load->view('layout/school_list_filter'); ?> 
                    
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
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="item form-group"> 
                            <div><?php echo lang('class'); ?>  <span class="required">*</span></div>
                            <select  class="form-control col-md-7 col-xs-12" name="class_id" id="class_id"  required="required" onchange="get_section_by_class(this.value,'');">
                                <option value="">--<?php echo lang('select'); ?>--</option>
                                <?php foreach ($classes as $obj) { ?>
                                <option value="<?php echo $obj->id; ?>" <?php if(isset($class_id) && $class_id == $obj->id){ echo 'selected="selected"';} ?>><?php echo $obj->name; ?></option>
                                <?php } ?>
                            </select>
                            <div class="help-block"><?php echo form_error('class_id'); ?></div>
                        </div>
                    </div>
                    
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="item form-group"> 
                            <div><?php echo lang('section'); ?></div>
                            <select  class="form-control col-md-7 col-xs-12" name="section_id" id="section_id">                                
                                <option value="">--<?php echo lang('select'); ?>--</option>
                            </select>
                            <div class="help-block"><?php echo form_error('section_id'); ?></div>
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
                            <h4><?php echo lang('exam_term_result'); ?></h4>                            
                            <?php echo lang('exam_title'); ?>: <?php echo $exam->title; ?>
                        </p>
                    </div>
                </div>            
            </div>
             <?php } ?>
            
            <div class="x_content">
                 <?php echo form_open(site_url('exam/examresult/add'), array('name' => 'add', 'id' => 'add', 'class'=>'form-horizontal form-label-left'), ''); ?>
                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th><?php echo lang('roll_no'); ?></th>
                            <th><?php echo lang('name'); ?></th>
                            <th><?php echo lang('photo'); ?></th>                            
                            <th><?php echo lang('total_subject'); ?></th>                                            
                            <th><?php echo lang('exam_mark'); ?></th>                                            
                            <th><?php echo lang('obtain_mark'); ?></th>                                            
                            <th> <?php echo lang('average_grade_point'); ?></th>                                            
                            <th><?php echo lang('letter_grade'); ?></th>                                            
                            <th><?php echo lang('remark'); ?></th>                                            
                        </tr>
                    </thead>
                    <tbody id="fn_result">   
                        <?php
                        $count = 1;
                        if (isset($students) && !empty($students)) {
                            ?>
                            <?php foreach ($students as $obj) { ?>                           
                            <?php  
                            $result = get_exam_result($branch_id, $exam_id, $obj->id, $academic_year_id,  $class_id, $section_id ); 
                            $mark = get_exam_total_mark($branch_id, $exam->id, $obj->id, $academic_year_id,  $class_id, $section_id );
                            ?>
                                <tr>
                                    <td><?php echo $obj->roll_no; ?></td>
                                    <td><?php echo ucfirst($obj->name); ?></td>
                                    <td>
                                        <?php if ($obj->photo != '') { ?>
                                            <img src="<?php echo UPLOAD_PATH; ?>student-photo/<?php echo $obj->photo; ?>" alt="" width="45" /> 
                                        <?php } else { ?>
                                            <img src="<?php echo IMG_URL; ?>default-user.png" alt="" width="45" /> 
                                        <?php } ?>
                                        <input type="hidden" value="<?php echo $obj->id; ?>"  name="students[]" />       
                                    </td>                                     
                                    <td> 
                                        <?php echo $mark->total_subject; ?>
                                        <input type="hidden" name="total_subject[<?php echo $obj->id; ?>]" value="<?php echo $mark->total_subject; ?>" />
                                    </td>
                                    <td>
                                        <?php echo $mark->exam_mark; ?>
                                        <input type="hidden" name="total_mark[<?php echo $obj->id; ?>]" value="<?php echo $mark->exam_mark; ?>" />
                                    </td>                                    
                                    <td>
                                        <?php echo $mark->obtain_mark; ?>
                                        <input type="hidden" name="total_obtain_mark[<?php echo $obj->id; ?>]" value="<?php echo $mark->obtain_mark; ?>" />
                                    </td>                                
                                    <td>
                                        <input class="form-control col-md-7 col-xs-12 " type="text" name="avg_grade_point[<?php echo $obj->id; ?>]" value="<?php echo (empty($mark->total_subject) ? number_format(0, 2) : number_format($mark->total_point / $mark->total_subject, 2)); ?>" style="width: 60px;"  autocomplete="off"/>
                                    </td>  
                                    <td>
                                        <select class="form-control col-md-7 col-xs-12" name="grade_id[<?php echo $obj->id; ?>]"  required="required">                                
                                            <option value="">--<?php echo lang('select'); ?>--</option>
                                             <?php foreach ($grades as $grade) { ?>
                                            <option value="<?php echo $grade->id; ?>" <?php if(isset($result) && $result->grade_id == $grade->id){ echo 'selected="selected"';} ?>><?php echo $grade->name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
   
                                    <td><input type="text" value="<?php if(isset($result) && $result->remark != ''){ echo $result->remark; } ?>"  name="remark[<?php echo $obj->id; ?>]" class="form-control col-md-7 col-xs-12"  autocomplete="off"/></td>
                                </tr>
                            <?php } ?>
                        <?php }else{ ?>
                                <tr>
                                    <td colspan="12" align="center"><?php echo lang('no_data_found'); ?></td>
                                </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-5">
                        <input type="hidden" value="<?php echo isset($branch_id) ? $branch_id : ''; ?>"  name="branch_id" />
                        <input type="hidden" value="<?php echo isset($exam_id) ? $exam_id : ''; ?>"  name="exam_id" />
                        <input type="hidden" value="<?php echo isset($class_id) ? $class_id : ''; ?>"  name="class_id" />
                        <input type="hidden" value="<?php echo isset($section_id) ? $section_id : ''; ?>"  name="section_id" />
                        <?php  if (isset($students) && !empty($students)) { ?>
                         <a href="<?php echo site_url('exam/examresult'); ?>" class="btn btn-primary"><?php echo lang('cancel'); ?></a>
                         <button id="send" type="submit" class="btn btn-success"><?php echo lang('submit'); ?></button>
                        <?php } ?>
                    </div>
                </div>
                 <?php echo form_close(); ?>
                
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="instructions"><strong><?php echo lang('instruction'); ?>: </strong> <?php echo lang('exam_result_instruction'); ?></div>
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
            data   : {exam_id:exam_id},               
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
       
        var branch_id = $('.fn_branch_id').val();     
             
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
 $("#result").validate(); 
 $("#add").validate(); 
 
</script>
<style>
#datatable-responsive label.error{display: none !important;}
</style>


