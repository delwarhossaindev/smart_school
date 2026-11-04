<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-users"></i><small> <?php echo lang('manage_bulk_admission'); ?></small></h3>
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
                        <?php if(has_permission(ADD, 'student', 'student')){ ?>
                            <li  class="active"><a href="#tab_add_bulk_student"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-plus-square-o"></i> <?php echo lang('add'); ?> </a> </li>                          
                        <?php } ?>                        
                    </ul>
                    <br/>
                    
                    <div class="tab-content">
                       
                        <div  class="tab-pane fade in active" id="tab_add_bulk_student">
                            <div class="x_content"> 
                               <?php echo form_open_multipart(site_url('student/bulk/add'), array('name' => 'add', 'id' => 'add', 'class'=>'form-horizontal form-label-left'), ''); ?>
                       
                                <div class="row">                                      
                                
                                    <?php if(ci()->session->userdata('role_id') == SUPER_ADMIN){ ?>
                                        <?php $schools = get_school_list(); ?>                                        
                                       <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                             <label for="branch_id"><?php echo lang('branch'); ?> <span class="required">*</span></label>
                                             <select  class="form-control col-md-7 col-xs-12 fn_branch_id" name="branch_id" id="branch_id" required="required" onchange="get_class_by_school(this.value);">
                                                    <option value="">--<?php echo lang('select_branch'); ?>--</option>
                                                    <?php foreach($schools as $obj){ ?>
                                                        <option value="<?php echo $obj->id; ?>" <?php if(isset($branch_id) && $branch_id == $obj->id){echo 'selected="selected"';} ?>><?php echo $obj->branch_name; ?></option>
                                                    <?php } ?>
                                             </select>
                                            <div class="help-block"><?php echo form_error('branch_id'); ?></div>
                                         </div>
                                     </div>                                    
                                    <?php }else{ ?>                                     
                                        <input class="fn_branch_id" type="hidden" name="branch_id" id="branch_id" value="<?php echo ci()->session->userdata('branch_id'); ?>" />
                                    <?php } ?> 
                                    
                                    
                                        <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                             <label for="academic_year_id"><?php echo lang('academic_year'); ?> <span class="required">*</span></label>
                                             <select  class="form-control col-md-7 col-xs-12" name="academic_year_id" id="academic_year_id" required="required">
                                                <option value="">--<?php echo lang('select'); ?>--</option>
                                                <?php foreach(ci()->academic_years as $obj){ ?>
                                                    <option value="<?php echo $obj->id; ?>" <?php echo isset($post['academic_year_id']) && $post['academic_year_id'] == $obj->id ?  'selected="selected"' : ''; ?>><?php echo $obj->session_year; if($obj->is_running){ echo ' ['.lang('running_year').']'; } ?></option>
                                                <?php } ?>
                                            </select>
                                            <div class="help-block"><?php echo form_error('academic_year_id'); ?></div>
                                         </div>
                                     </div>                                   
                                    
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                             <label for="class_id"><?php echo lang('class'); ?> <span class="required">*</span></label>
                                             <select  class="form-control col-md-7 col-xs-12" name="class_id" id="class_id" required="required" onchange="get_section_by_class(this.value);">
                                                <option value="">--<?php echo lang('select'); ?>--</option>
                                                <?php foreach($classes as $obj){ ?>
                                                    <option value="<?php echo $obj->id; ?>" <?php echo isset($post['class_id']) && $post['class_id'] == $obj->id ?  'selected="selected"' : ''; ?>><?php echo $obj->name; ?></option>
                                                <?php } ?>
                                            </select>
                                            <div class="help-block"><?php echo form_error('class_id'); ?></div>
                                         </div>
                                     </div>
                                     <div class="col-md-2 col-sm-2 col-xs-12">
                                         <div class="item form-group">
                                            <label for="section_id"><?php echo lang('section'); ?> <span class="required">*</span></label>
                                            <select  class="form-control col-md-7 col-xs-12" name="section_id" id="section_id" required="required">
                                                <option value="">--<?php echo lang('select'); ?>--</option>
                                            </select>
                                            <div class="help-block"><?php echo form_error('section_id'); ?></div>
                                         </div>
                                     </div> 
                                     <div class="col-md-2 col-sm-2 col-xs-12">
                                         <div class="item form-group">
                                             <label for="">&nbsp;</label>
                                            <a href="<?php echo ASSET_URL; ?>csv/bulk_student.csv"  class="btn btn-success btn-md"><?php echo lang('generate_csv'); ?></a>
                                         </div>
                                     </div> 
                                    <div class="col-md-2 col-sm-2 col-xs-12">
                                         <div class="item form-group">
                                             <label ><?php echo lang('csv_file'); ?>&nbsp;</label>
                                            <div class="btn btn-default btn-file">
                                                <i class="fa fa-paperclip"></i> <?php echo lang('upload'); ?>
                                                <input  class="form-control col-md-7 col-xs-12"  name="bulk_student"  id="bulk_student" type="file">
                                            </div>
                                         </div>
                                     </div>
                                </div>
                                
                                                            
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <a  href="<?php echo site_url('student'); ?>" class="btn btn-primary"><?php echo lang('cancel'); ?></a>
                                        <button id="send" type="submit" class="btn btn-success"><?php echo lang('submit'); ?></button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                                
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="instructions"><strong><?php echo lang('instruction'); ?>: </strong> 
                                        <ol>
                                            <?php if(ci()->session->userdata('role_id') == SUPER_ADMIN){ ?>
                                                <li><?php echo lang('bulk_student_instruction_1'); ?></li>
                                            <?php }else{ ?>
                                                <li><?php echo lang('bulk_student_instruction_2'); ?></li>
                                            <?php } ?>
                                            <li><?php echo lang('bulk_student_instruction_3'); ?></li>
                                            <li><?php echo lang('bulk_student_instruction_4'); ?> </li>
                                            <li><?php echo lang('gender'); ?>: [ male, female ] <span class="required">*</span></li>
                                            <li><?php echo lang('academic_group'); ?>: [ science, arts, commerce ]</li>
                                            <li><?php echo lang('blood_group'); ?>: [ a_positive, a_negative, b_positive, b_negative, o_positive, o_negative, ab_positive, ab_negative ]</li>
                                            <li>
                                                <?php echo lang('bulk_student_instruction_7'); ?>
                                                <a target="_blank" href="<?php echo site_url('student/type/index'); ?>"><?php echo lang('student_type'); ?></a>
                                            </li>
                                            <li>
                                                <?php echo lang('bulk_student_instruction_8'); ?>
                                                <a target="_blank" href="<?php echo site_url('accounting/discount'); ?>"><?php echo lang('discount'); ?></a>
                                            </li>
                                            <li><?php echo lang('bulk_student_instruction_5'); ?></li>
                                            <li><?php echo lang('bulk_student_instruction_6'); ?></li>
                                        </ol>
                                    </div>
                                </div>
                                
                            </div>
                        </div>  
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- datatable with buttons -->
 <script type="text/javascript">
  
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
    
    function get_section_by_class(class_id){       
       
        var branch_id = $('#branch_id').val();
        if(!branch_id){
           toastr.error('<?php echo lang('select_branch'); ?>');
           return false;
        }
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_section_by_class'); ?>",
            data   : { class_id : class_id, branch_id : branch_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                  $('#section_id').html(response);                  
               }
            }
        }); 
   }
  </script>
  
 <script type="text/javascript">      
    $("#add").validate();     
</script>