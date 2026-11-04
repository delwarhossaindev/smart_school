<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-bar-chart"></i><small> <?php echo lang('fee_collection_report'); ?></small></h3>                
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
            
            <?php ci()->load->view('quick_report'); ?>   
            
             <div class="x_content filter-box no-print"> 
                <?php echo form_open_multipart(site_url('report/feecollection'), array('name' => 'fee_collection', 'id' => 'fee_collection', 'class' => 'form-horizontal form-label-left'), ''); ?>
                <div class="row">   
                    
                    <?php ci()->load->view('layout/school_list_filter'); ?>
                    
                   <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="item form-group"> 
                            <?php echo lang('academic_year'); ?>
                            <select  class="form-control col-md-7 col-xs-12" name="academic_year_id" id="academic_year_id">
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
                            <div><?php echo lang('class'); ?> </div>
                            <select  class="form-control col-md-7 col-xs-12" name="class_id" id="class_id"  onchange="get_student_by_class(this.value, '');">
                                <option value="">--<?php echo lang('select'); ?>--</option>
                                <?php foreach ($classes as $obj) { ?>
                                <option value="<?php echo $obj->id; ?>" <?php if(isset($class_id) && $class_id == $obj->id){ echo 'selected="selected"';} ?>><?php echo $obj->name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    
                   <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="item form-group"> 
                            <div><?php echo lang('student'); ?> </div>
                            <select  class="form-control col-md-7 col-xs-12" name="student_id" id="student_id" >                                
                                <option value="">--<?php echo lang('select'); ?>--</option>
                            </select>
                        </div>
                    </div> 
                                        
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <div class="item form-group"> 
                            <?php echo lang('from_date'); ?>
                            <input  class="form-control col-md-7 col-xs-12"  name="date_from"  id="date_from" value="<?php echo isset($date_from) && $date_from != '' ?  date('d-m-Y', strtotime($date_from)) : ''; ?>" placeholder="<?php echo lang('from_date'); ?>" type="text" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <div class="item form-group"> 
                            <?php echo lang('to_date'); ?>
                            <input  class="form-control col-md-7 col-xs-12"  name="date_to"  id="date_to" value="<?php echo isset($date_to) && $date_to != '' ?  date('d-m-Y', strtotime($date_to)) : ''; ?>" placeholder="<?php echo lang('to_date'); ?>" type="text" autocomplete="off">
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
                           <div class="col-sm-3  col-xs-3">&nbsp;</div>
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
                                   <h3 class="head-title ptint-title" style="width: 100%;"><i class="fa fa-bar-chart"></i><small> <?php echo lang('fee_collection_report'); ?></small></h3>                
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
                            <table id="datatable-keytable" class="datatable-responsive table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo lang('sl_no'); ?></th>
                                        <th><?php echo lang('academic_year'); ?></th>
                                        <th><?php echo lang('student'); ?></th>
                                        <th><?php echo lang('class'); ?></th>
                                        <th><?php echo lang('payment_method'); ?></th>
                                        <th><?php echo lang('payment_date'); ?></th>
                                        <th><?php echo lang('paid_amount'); ?></th>                                        
                                    </tr>
                                </thead>
                                <tbody>   
                                    <?php 
                                    $amount = 0;                                  
                                    
                                    $count = 1; if(isset($feecollection) && !empty($feecollection)){ ?>
                                        <?php foreach($feecollection as $obj){ ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>  
                                            <td><?php echo $obj->session_year; ?></td>
                                            <td><?php echo $obj->student; ?></td>
                                            <td><?php echo $obj->class_name; ?></td>
                                            <td><?php echo lang($obj->payment_method); ?></td>
                                            <td><?php echo date(ci()->global_setting->date_format, strtotime($obj->payment_date)); ?></td>                    
                                            <td class="green"><?php echo $obj->amount ? $obj->amount : 0; $amount += $obj->amount; ?></td>
                                        </tr>
                                        <?php } ?>
                                        <tr>
                                            <td colspan="6"><strong><?php echo lang('total_amount'); ?></strong></td>
                                            <td class="green"><strong><?php echo number_format($amount,2); ?></strong></td>                                           
                                        </tr>
                                    <?php }else{ ?>
                                        <tr><td colspan="7" class="text-center"><?php echo lang('no_data_found'); ?></td></tr>
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

<link href="<?php echo VENDOR_URL; ?>datepicker/datepicker.css" rel="stylesheet">
 <script src="<?php echo VENDOR_URL; ?>datepicker/datepicker.js"></script>
 <script type="text/javascript">

    $("#fee_collection").validate(); 
    $('#date_from').datepicker();
    $('#date_to').datepicker();
    
    
    
       $("document").ready(function() {
         <?php if(isset($branch_id) && !empty($branch_id)){ ?>               
            $(".fn_branch_id").trigger('change');
         <?php } ?>
    });
    
     $('.fn_branch_id').on('change', function(){

        var branch_id = $(this).val();
        var academic_year_id = '';
        var class_id = '';      

        <?php if(isset($branch_id) && !empty($branch_id)){ ?>
          academic_year_id =  '<?php echo $academic_year_id; ?>';           
        <?php } ?> 
            
        <?php if(isset($class_id) && !empty($class_id)){ ?>
          class_id =  '<?php echo $class_id; ?>';           
        <?php } ?> 
       
           
        if(!branch_id){
           toastr.error('<?php echo lang('select_branch'); ?>');
           return false;
        }
        
        get_academic_year_by_school(branch_id, academic_year_id);
        get_class_by_school(branch_id, class_id);
          
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
   
    
    
    <?php if(isset($class_id) && isset($student_id)){ ?>
        get_student_by_class('<?php echo $class_id; ?>', '<?php echo $student_id; ?>');
    <?php } ?>
        
        
      function get_student_by_class(class_id, student_id){       
        
        var branch_id = $('#branch_id').val();
        if(!branch_id){
           toastr.error('<?php echo lang('select_branch'); ?>');
           return false;
        }
        
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_student_by_class'); ?>",
            data   : {branch_id:branch_id, class_id: class_id, student_id:student_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                  $('#student_id').html(response);
               }
            }
        });         
    }    
    

</script>

