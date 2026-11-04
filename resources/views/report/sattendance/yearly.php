<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-bar-chart"></i><small> <?php echo lang('student_yearly_attendance_report'); ?></small></h3>                
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
            
            <?php ci()->load->view('quick_report'); ?>   
            
             <div class="x_content filter-box no-print"> 
                <?php echo form_open_multipart(site_url('report/syattendance'), array('name' => 'sattendance', 'id' => 'sattendance', 'class' => 'form-horizontal form-label-left'), ''); ?>
                 <div class="row">                    
                    <div class="col-md-10 col-sm-10 col-xs-12">
                        
                        <?php ci()->load->view('layout/school_list_filter'); ?>
                        
                        <div class="col-md-2 col-sm-2 col-xs-12">
                            <div class="item form-group"> 
                                <div><?php echo lang('academic_year'); ?> <span class="required">*</span></div>
                                <select  class="form-control col-md-7 col-xs-12" name="academic_year_id" id="academic_year_id" required="required">
                                    <option value="">--<?php echo lang('select'); ?>--</option>
                                    <?php foreach (ci()->academic_years as $obj) { ?>
                                    <?php $running = $obj->is_running ? ' ['.lang('running_year').']' : ''; ?>
                                    <option value="<?php echo $obj->id; ?>" <?php if(isset($academic_year_id) && $academic_year_id == $obj->id){ echo 'selected="selected"';} ?>><?php echo $obj->session_year; echo $running; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                            <div class="item form-group"> 
                                <div><?php echo lang('class'); ?> <span class="required">*</span></div>
                                <select  class="form-control col-md-7 col-xs-12" name="class_id" id="class_id"  required="required" onchange="get_section_by_class('', this.value,'');">
                                    <option value="">--<?php echo lang('select'); ?>--</option>
                                    <?php if(isset($classes) && !empty($classes)) { ?>
                                        <?php foreach ($classes as $obj) { ?>
                                        <option value="<?php echo $obj->id; ?>" <?php if(isset($class_id) && $class_id == $obj->id){ echo 'selected="selected"';} ?>><?php echo $obj->name; ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                            <div class="item form-group"> 
                                <div><?php echo lang('section'); ?> <span class="required">*</span></div>
                                <select  class="form-control col-md-7 col-xs-12" name="section_id" id="section_id"  required="required" onchange="get_student_by_section('', this.value, '');">
                                    <option value="">--<?php echo lang('select'); ?>--</option>                                    
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="item form-group"> 
                                <div><?php echo lang('student'); ?> <span class="required">*</span></div>
                                <select  class="form-control col-md-7 col-xs-12" name="student_id" id="student_id"  required="required">
                                    <option value="">--<?php echo lang('select'); ?>--</option>                                    
                                </select>
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

            <div class="x_content">
                <div class="" data-example-id="togglable-tabs">
                    
                    
                    <?php if(isset($school) && !empty($school)){ ?>
                    <div class="x_content">             
                       <div class="row">
                           <div class="col-sm-3 col-xs-3">&nbsp;</div>
                           <div class="col-sm-6  col-xs-6 layout-box">
                               <div>
                                  <?php if($school->logo){ ?>
                                    <img class="logo-identifier" src="<?php echo UPLOAD_PATH; ?>logo/<?php echo $school->logo; ?>" alt="" /> 
                                 <?php }else if($school->frontend_logo){ ?>
                                    <img class="logo-identifier" src="<?php echo UPLOAD_PATH; ?>logo/<?php echo $school->frontend_logo; ?>" alt="" /> 
                                 <?php }else{ ?>                                                        
                                    <img class="logo-identifier" src="<?php echo UPLOAD_PATH; ?>logo/<?php echo ci()->global_setting->brand_logo; ?>" alt=""  />
                                 <?php } ?>
                                   <h4><?php echo $school->branch_name; ?></h4>
                                   <div><?php echo $school->address; ?></div>
                                   <div><?php echo lang('student_name'); ?> : <?php echo $student->name; ?></div>
                                   <div><?php echo lang('class'); ?> : <?php echo $student->class_name; ?>, <?php echo lang('section'); ?> : <?php echo $student->section; ?>, <?php echo lang('roll_no'); ?> : <?php echo $student->roll_no; ?></div>
                                   <h3 class="head-title ptint-title" style="width: 100%;"><i class="fa fa-bar-chart"></i><small> <?php echo lang('student_yearly_attendance_report'); ?></small></h3>                
                                   <div class="clearfix">&nbsp;</div>
                               </div>
                           </div>
                            <div class="col-sm-3  col-xs-3">&nbsp;</div>
                       </div>            
                    </div>
                    <?php } ?>
                    
                    <ul  class="nav nav-tabs bordered no-print">
                        <li class="active"><a href="#tab_tabular"   role="tab" data-toggle="tab"   aria-expanded="true"><i class="fa fa-list-ol"></i> <?php echo lang('tabular_report'); ?></a> </li>
                    </ul>
                    <br/>
                    
                    <div class="tab-content">
                        <div  class="tab-pane fade in active" id="tab_tabular" >
                            <div class="x_content">
                                                            
                            <table class="datatable-responsive table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <td><?php echo lang('month'); ?> <i class="fa fa-long-arrow-down"></i> - <?php echo lang('date'); ?> <i class="fa fa-long-arrow-right"></i></td>
                                        <?php for($i = 1; $i<=$days; $i++ ){ ?>
                                            <td><?php echo $i; ?></td>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>   
                                    <?php  $months = get_months(); ?>
                                    <?php foreach($months as $key=>$value){ ?>
                                        <?php 
                                            $month_number = date('m',strtotime($key)); 
                                            $attendance = @get_student_monthly_attendance($branch_id, $student_id, $academic_year_id, $class_id, $section_id, $month_number ,$days);
                                           ?>
                                        <?php if(!empty($attendance)){ ?>
                                         <tr>
                                             <td><?php echo $value; ?></td> 
                                             <?php foreach($attendance AS $key ){ ?>
                                                 <td> <?php echo $key ? $key : '<i style="color:red;">--</i>'; ?></td>
                                             <?php } ?>
                                         </tr>
                                         <?php } ?>  
                                        <?php } ?>  
                                </tbody>
                            </table>
                            </div>
                        </div>                      
                    </div>
                </div>
            </div>
            
             <div class="row no-print">
                <div class="col-xs-12 text-right">
                    <button class="btn btn-default " onclick="window.print();"><i class="fa fa-print"></i> <?php echo lang('print'); ?></button>
                </div>
            </div>
            
        </div>
    </div>
</div>

<script type="text/javascript">
         
    $("document").ready(function() {
         <?php if(isset($branch_id) && !empty($branch_id)){ ?>
            $(".fn_branch_id").trigger('change');
         <?php } ?>
    });
     
    $('.fn_branch_id').on('change', function(){
      
        var branch_id = $(this).val();
        var class_id = '';
        var section_id = '';
        var academic_year_id = '';
        
        <?php if(isset($branch_id) && !empty($branch_id)){ ?>
            class_id =  '<?php echo $class_id; ?>';
            section_id =  '<?php echo $section_id; ?>';
            academic_year_id =  '<?php echo $academic_year_id; ?>'; 
         <?php } ?> 
        
        if(!branch_id){
           toastr.error('<?php echo lang('select_branch'); ?>');
           return false;
        }
        
        get_academic_year_by_school(branch_id, academic_year_id);
        get_class_by_school(branch_id, class_id, section_id);
       
       $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_class_by_school'); ?>",
            data   : { branch_id:branch_id, class_id:class_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {  
                   
                    $('#class_id').html(response);                                      
                   //get_section_by_class(class_id, section_id);
               }
            }
        });
    }); 
    
    
    function get_academic_year_by_school(branch_id, academic_year_id){       
         
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_academic_year_by_school'); ?>",
            data   : { branch_id:branch_id, academic_year_id :academic_year_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               { 
                    $('#academic_year_id').html(response); 
               }
            }
        });
   }  
    
    function get_class_by_school(branch_id, class_id, section_id){       
        
        if(!branch_id){
            branch_id = $('#branch_id').val();
        }
        
        if(!branch_id){
           toastr.error('<?php echo lang('select_branch'); ?>');
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
                   get_section_by_class(branch_id, class_id, section_id);
               }
            }
        });         
    }
    
    
    function get_section_by_class(branch_id, class_id, section_id){       
       
        if(!branch_id){
            branch_id = $('#branch_id').val();
        }
        
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_section_by_class'); ?>",
            data   : { branch_id:branch_id, class_id : class_id , section_id: section_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                  $('#section_id').html(response);
               }
            }
        });          
    }
    
    <?php if(isset($student_id) && isset($section_id)){ ?>
        get_student_by_section('<?php echo $branch_id; ?>', '<?php echo $section_id; ?>', '<?php echo $student_id; ?>');
    <?php } ?>
    
    function get_student_by_section(branch_id, section_id, student_id){       
        
        if(!branch_id){
            branch_id = $('#branch_id').val();
        }
        
        if(!branch_id){
           toastr.error('<?php echo lang('select_branch'); ?>');
           return false;
        }
        
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_student_by_section'); ?>",
            data   : {branch_id:branch_id, section_id: section_id, student_id : student_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                  $('#student_id').html(response);
               }
            }
        });          
    }
    
    $("#sattendance").validate();  
</script>

