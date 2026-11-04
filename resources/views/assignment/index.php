<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-file-word-o"></i><small> <?php echo lang('manage_assignment'); ?></small></h3>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
           
            <div class="x_content">
                <div class="" data-example-id="togglable-tabs">
                    
                    <ul  class="nav nav-tabs bordered">
                        <li class="<?php if(isset($list)){ echo 'active'; }?>"><a href="#tab_assignment_list"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-list-ol"></i> <?php echo lang('list'); ?></a> </li>
                        <?php if(has_permission(ADD, 'assignment', 'assignment')){ ?>
                        
                            <?php if(isset($edit)){ ?>
                                <li  class="<?php if(isset($add)){ echo 'active'; }?>"><a href="<?php echo site_url('assignment/add'); ?>"  aria-expanded="false"><i class="fa fa-plus-square-o"></i> <?php echo lang('add'); ?></a> </li>                          
                             <?php }else{ ?>
                                 <li  class="<?php if(isset($add)){ echo 'active'; }?>"><a href="#tab_add_assignment"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-plus-square-o"></i> <?php echo lang('add'); ?></a> </li>                          
                             <?php } ?>
                        <?php } ?>
                                 
                        <?php if(isset($edit)){ ?>
                            <li  class="active"><a href="#tab_edit_assignment"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-pencil-square-o"></i> <?php echo lang('edit'); ?></a> </li>                          
                        <?php } ?>                
                       
                            <li class="li-class-list">
                            
                            <?php $teacher_access_data = get_teacher_access_data(); ?> 
                            <?php $guardian_access_data = get_guardian_access_data('class'); ?>   
                                
                            <?php if(ci()->session->userdata('role_id') == SUPER_ADMIN){  ?>
                            
                                <?php echo form_open(site_url('assignment/index'), array('name' => 'filter', 'id' => 'filter', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                    <select  class="form-control col-md-7 col-xs-12" style="width:auto;" name="branch_id"  onchange="get_class_by_school(this.value, '');">
                                            <option value="">--<?php echo lang('select_branch'); ?>--</option> 
                                        <?php foreach($schools as $obj ){ ?>
                                            <option value="<?php echo $obj->id; ?>" <?php if(isset($filter_branch_id) && $filter_branch_id == $obj->id){ echo 'selected="selected"';} ?> > <?php echo $obj->branch_name; ?></option>
                                        <?php } ?>   
                                    </select>
                                    <select  class="form-control col-md-7 col-xs-12" id="filter_class_id" name="class_id"  style="width:auto;" onchange="this.form.submit();">
                                         <option value="">--<?php echo lang('select'); ?>--</option>                                         
                                    </select>
                                   <?php echo form_close(); ?>
                                                        
                            <?php }else{  ?>
                                
                                <select  class="form-control col-md-7 col-xs-12" onchange="get_assignment_by_class(this.value);">
                                    <?php if(ci()->session->userdata('role_id') != STUDENT){ ?>
                                    <option value="<?php echo site_url('assignment/index'); ?>">--<?php echo lang('select'); ?>--</option> 
                                     <?php } ?> 
                                    
                                    <?php foreach($class_list as $obj ){ ?>
                                        <?php if(ci()->session->userdata('role_id') == STUDENT){ ?>
                                            <?php if ($obj->id != ci()->session->userdata('class_id')){ continue; } ?> 
                                            <option value="<?php echo site_url('assignment/index/'.$obj->id); ?>" <?php if(isset($class_id) && $class_id == $obj->id){ echo 'selected="selected"';} ?> ><?php echo $obj->name; ?></option>
                                        <?php }elseif(ci()->session->userdata('role_id') == GUARDIAN){ ?>
                                            <?php if (!in_array($obj->id, $guardian_access_data)) { continue; } ?>
                                            <option value="<?php echo site_url('assignment/index/'.$obj->id); ?>" <?php if(isset($class_id) && $class_id == $obj->id){ echo 'selected="selected"';} ?> ><?php echo $obj->name; ?></option>
                                        <?php }elseif(ci()->session->userdata('role_id') == TEACHER){ ?>
                                            <?php if (!in_array($obj->id, $teacher_access_data)) { continue; } ?>
                                            <option value="<?php echo site_url('assignment/index/'.$obj->id); ?>" <?php if(isset($class_id) && $class_id == $obj->id){ echo 'selected="selected"';} ?> ><?php echo $obj->name; ?></option>
                                        <?php }else{ ?>
                                            <option value="<?php echo site_url('assignment/index/'.$obj->id); ?>" <?php if(isset($class_id) && $class_id == $obj->id){ echo 'selected="selected"';} ?> ><?php echo $obj->name; ?></option>
                                        <?php } ?>                                            
                                    <?php } ?>                                            
                                </select>                               
                            
                            <?php } ?>
                        </li>    
                    </ul>
                    <br/>
                    
                    <div class="tab-content">
                        <div  class="tab-pane fade in <?php if(isset($list)){ echo 'active'; }?>" id="tab_assignment_list" >
                            <div class="x_content">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo lang('sl_no'); ?></th>
                                        <?php if(ci()->session->userdata('role_id') == SUPER_ADMIN){ ?>
                                            <th><?php echo lang('branch'); ?></th>
                                        <?php } ?>
                                        <th><?php echo lang('title'); ?></th>
                                        <th><?php echo lang('class'); ?></th>
                                        <th><?php echo lang('section'); ?></th>
                                        <th><?php echo lang('subject'); ?></th>
                                        <th><?php echo lang('deadline'); ?></th>
                                        <th><?php echo lang('academic_year'); ?></th>
                                        <th><?php echo lang('action'); ?></th>                                            
                                    </tr>
                                </thead>
                                <tbody> 
                                    
                                    <?php $guardian_access_data = get_guardian_access_data('section'); ?> 
                                    <?php $count = 1; if(isset($assignments) && !empty($assignments)){ ?>
                                        <?php foreach($assignments as $obj){ ?>
                                        <?php 
                                            if(ci()->session->userdata('role_id') == GUARDIAN){
                                                if (!in_array($obj->section_id, $guardian_access_data)){ continue; }
                                            }elseif(ci()->session->userdata('role_id') == TEACHER){
                                                if (!in_array($obj->class_id, $teacher_access_data)){ continue; }
                                            }
                                        ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <?php if(ci()->session->userdata('role_id') == SUPER_ADMIN){ ?>
                                                <td><?php echo $obj->branch_name; ?></td>
                                            <?php } ?>
                                            <td><?php echo $obj->title; ?></td>
                                            <td><?php echo $obj->class_name; ?></td>
                                            <td><?php echo $obj->section; ?></td>
                                            <td><?php echo $obj->subject; ?></td>
                                            <td><?php echo date('d-m-Y', strtotime($obj->deadline)); ?></td>
                                            <td><?php echo $obj->session_year; ?></td>
                                            <td>
                                                <?php if(has_permission(EDIT, 'assignment', 'assignment')){ ?>
                                                    <a href="<?php echo site_url('assignment/edit/'.$obj->id); ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil-square-o"></i> <?php echo lang('edit'); ?> </a>
                                                <?php  } ?>
                                                <?php if(has_permission(VIEW, 'assignment', 'assignment')){ ?>
                                                    <a  onclick="get_assignment_modal(<?php echo $obj->id; ?>);"  data-toggle="modal" data-target=".bs-assignment-modal-lg"  class="btn btn-success btn-xs"><i class="fa fa-eye"></i> <?php echo lang('view'); ?> </a>
                                                    <?php if($obj->assignment){ ?>
                                                    <a target="_blank" href="<?php echo UPLOAD_PATH; ?>assignment/<?php echo $obj->assignment; ?>" class="btn btn-success btn-xs"><i class="fa fa-download"></i> <?php echo lang('download'); ?> </a>
                                                    <?php  } ?>
                                                <?php  } ?>
                                                <?php if(has_permission(DELETE, 'assignment', 'assignment')){ ?>
                                                    <a href="<?php echo site_url('assignment/delete/'.$obj->id); ?>" onclick="javascript: return confirm('<?php echo lang('confirm_alert'); ?>');" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> <?php echo lang('delete'); ?> </a>
                                                <?php  } ?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                            </div>
                        </div>

                        <div  class="tab-pane fade in <?php if(isset($add)){ echo 'active'; }?>" id="tab_add_assignment">
                            <div class="x_content"> 
                               <?php echo form_open_multipart(site_url('assignment/add'), array('name' => 'add', 'id' => 'add', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                
                                 <?php ci()->load->view('layout/school_list_form'); ?>  
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title"><?php echo lang('title'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="title"  id="title" value="<?php echo isset($post['title']) ?  $post['title'] : ''; ?>" placeholder="<?php echo lang('title'); ?>" required="required" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('title'); ?></div>
                                    </div>
                                </div>               
                                                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="class_id"><?php echo lang('class'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="class_id"  id="add_class_id" required="required" onchange="get_subject_by_class(this.value, ''); get_section_by_class(this.value, '');" >
                                            <option value="">--<?php echo lang('select'); ?>--</option> 
                                            <?php if(isset($classes) && !empty($classes)){ ?>
                                                <?php foreach($classes as $obj ){ ?>
                                                   <?php
                                                    if(ci()->session->userdata('role_id') == TEACHER){
                                                       if (!in_array($obj->id, $teacher_access_data)) {continue; }
                                                    }else if(ci()->session->userdata('role_id') == GUARDIAN){
                                                        if (!in_array($obj->id, $guardian_access_data)) {continue; }
                                                    } 
                                                    ?>
                                                  <option value="<?php echo $obj->id; ?>" ><?php echo $obj->name; ?></option>
                                                <?php } ?>                                            
                                            <?php } ?>                                            
                                        </select>
                                        <div class="help-block"><?php echo form_error('class_id'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="section_id"><?php echo lang('section'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="section_id"  id="add_section_id" >
                                            <option value="">--<?php echo lang('select'); ?>--</option>                                                                                      
                                        </select>
                                        <div class="help-block"><?php echo form_error('section_id'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="subject_id"><?php echo lang('subject'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="subject_id"  id="add_subject_id" required="required" >
                                            <option value="">--<?php echo lang('select'); ?>--</option>                                                                                      
                                        </select>
                                        <div class="help-block"><?php echo form_error('subject_id'); ?></div>
                                    </div>
                                </div>
                                
                                 <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="deadline"><?php echo lang('deadline'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="deadline"  id="add_deadline" value="<?php echo isset($post['deadline']) ?  $post['deadline'] : ''; ?>" placeholder="<?php echo lang('deadline'); ?>" required="required" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('deadline'); ?></div>
                                    </div>
                                </div>
                                
                               <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"><?php echo lang('assignment'); ?> 
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="btn btn-default btn-file">
                                            <i class="fa fa-paperclip"></i> <?php echo lang('upload'); ?>
                                            <input  class="form-control col-md-7 col-xs-12"  name="assignment"  id="assignment" type="file" >
                                        </div>
                                        <div class="text-info"><?php echo lang('valid_file_format_doc'); ?></div>
                                        <div class="help-block"><?php echo form_error('assignment'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="note"><?php echo lang('note'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control col-md-7 col-xs-12"  name="note"  id="add_note" placeholder="<?php echo lang('note'); ?>"><?php echo isset($post['note']) ?  $post['note'] : ''; ?></textarea>
                                        <div class="help-block"><?php echo form_error('note'); ?></div>
                                    </div>
                                </div>
                               
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <a href="<?php echo site_url('assignment/index'); ?>" class="btn btn-primary"><?php echo lang('cancel'); ?></a>
                                        <button id="send" type="submit" class="btn btn-success"><?php echo lang('submit'); ?></button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                                
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="instructions"><strong><?php echo lang('instruction'); ?>: </strong> <?php echo lang('add_assignment_instruction'); ?></div>
                                </div>
                            </div>
                        </div>  

                        
                        <?php if(isset($edit)){ ?>
                        <div class="tab-pane fade in active" id="tab_edit_assignment">
                            <div class="x_content"> 
                               <?php echo form_open_multipart(site_url('assignment/edit/'.$assignment->id), array('name' => 'edit', 'id' => 'edit', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                
                                 <?php ci()->load->view('layout/school_list_edit_form'); ?> 
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title"><?php echo lang('title'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="title"  id="title" value="<?php echo isset($assignment->title) ?  $assignment->title : ''; ?>" placeholder="<?php echo lang('title'); ?>" required="required" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('title'); ?></div>
                                    </div>
                                </div>
                                                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="class_id"><?php echo lang('class'); ?> <span class="required">*</span> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="class_id"  id="edit_class_id" required="required" onchange="get_subject_by_class(this.value, ''); get_section_by_class(this.value, '');">
                                            <option value="">--<?php echo lang('select'); ?>--</option> 
                                            <?php if(isset($classes) && !empty($classes)){ ?>
                                                <?php foreach($classes as $obj ){ ?>
                                                    <?php
                                                    if(ci()->session->userdata('role_id') == TEACHER){
                                                       if (!in_array($obj->id, $teacher_access_data)) {continue; }
                                                    } 
                                                    ?>
                                                    <option value="<?php echo $obj->id; ?>" <?php if($assignment->class_id == $obj->id){ echo 'selected="selected"';} ?>><?php echo $obj->name; ?></option>
                                                <?php } ?>                                            
                                            <?php } ?>                                            
                                        </select>
                                        <div class="help-block"><?php echo form_error('class_id'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="section_id"><?php echo lang('section'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="section_id"  id="edit_section_id" >
                                            <option value="">--<?php echo lang('select'); ?>--</option>                                                                                      
                                        </select>
                                        <div class="help-block"><?php echo form_error('section_id'); ?></div>
                                    </div>
                                </div>
					
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="subject_id"><?php echo lang('subject'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="subject_id"  id="edit_subject_id" required="required" >
                                            <option value="">--<?php echo lang('select'); ?>--</option>                                                                                      
                                        </select>
                                        <div class="help-block"><?php echo form_error('subject_id'); ?></div>
                                    </div>
                                </div>
                                                                                        
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="deadline"><?php echo lang('deadline'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="deadline"  id="edit_deadline" value="<?php echo isset($assignment->deadline) ?  date('d-m-Y', strtotime($assignment->deadline)) : ''; ?>" placeholder="<?php echo lang('deadline'); ?>" required="required" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('deadline'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"><?php echo lang('assignment'); ?>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="hidden" name="prev_assignment" id="prev_assignment" value="<?php echo $assignment->assignment; ?>" />
                                        <?php if($assignment->assignment){ ?>
                                            <a target="_blank" href="<?php echo UPLOAD_PATH; ?>assignment/<?php echo $assignment->assignment; ?>"  class="btn btn-success btn-xs"><i class="fa fa-download"></i> <?php echo lang('download'); ?></a> <br/><br/>
                                        <?php } ?>
                                        <div class="btn btn-default btn-file">
                                            <i class="fa fa-paperclip"></i> <?php echo lang('upload'); ?>
                                            <input  class="form-control col-md-7 col-xs-12"  name="assignment"  id="assignment" type="file">
                                        </div>
                                        <div class="text-info"><?php echo lang('valid_file_format_doc'); ?></div>
                                        <div class="help-block"><?php echo form_error('assignment'); ?></div>
                                    </div>
                                </div>
                             
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="note"><?php echo lang('note'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control col-md-7 col-xs-12"  name="note"  id="edit_note" placeholder="<?php echo lang('note'); ?>"><?php echo isset($assignment->note) ?  $assignment->note : ''; ?></textarea>
                                        <div class="help-block"><?php echo form_error('note'); ?></div>
                                    </div>
                                </div>
                                                             
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <input type="hidden" value="<?php echo isset($assignment) ? $assignment->id : $id; ?>" name="id" />
                                        <a  href="<?php echo site_url('assignment/index'); ?>" class="btn btn-primary"><?php echo lang('cancel'); ?></a>
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


<div class="modal fade bs-assignment-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title"><?php echo lang('detail_information'); ?></h4>
        </div>
        <div class="modal-body fn_assignment_data">
            
        </div>       
      </div>
    </div>
</div>
<script type="text/javascript">
         
    function get_assignment_modal(assignment_id){
         
        $('.fn_assignment_data').html('<p style="padding: 20px;"><p style="padding: 20px;text-align:center;"><img src="<?php echo IMG_URL; ?>loading.gif" /></p>');
        $.ajax({       
          type   : "POST",
          url    : "<?php echo site_url('assignment/get_single_assignment'); ?>",
          data   : {assignment_id : assignment_id},  
          success: function(response){                                                   
             if(response)
             {
                $('.fn_assignment_data').html(response);
             }
          }
       });
    }
</script>

  <link href="<?php echo VENDOR_URL; ?>editor/jquery-te-1.4.0.css" rel="stylesheet">
 <script type="text/javascript" src="<?php echo VENDOR_URL; ?>editor/jquery-te-1.4.0.min.js"></script>
 <script type="text/javascript">     
  $('#add_note').jqte();
  $('#edit_note').jqte();
  
  </script>

<link href="<?php echo VENDOR_URL; ?>datepicker/datepicker.css" rel="stylesheet">
<script src="<?php echo VENDOR_URL; ?>datepicker/datepicker.js"></script>


<!-- Super admin js START  -->
 <script type="text/javascript">
     
    $("document").ready(function() {
         <?php if(isset($edit) && !empty($edit)  && ci()->session->userdata('role_id') != TEACHER){ ?>
            $("#edit_branch_id").trigger('change');
         <?php } ?>
    });
     
    $('.fn_branch_id').on('change', function(){
      
        var branch_id = $(this).val();        
        var class_id = '';
        
        <?php if(isset($edit) && !empty($edit)){ ?>
            class_id =  '<?php echo $assignment->class_id; ?>';           
         <?php } ?> 
        
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
                   if(class_id){
                       $('#edit_class_id').html(response);   
                   }else{
                       $('#add_class_id').html(response);   
                   }                  
               }
            }
        });
    }); 

  </script>
<!-- Super admin js end -->

 <script type="text/javascript">
   
  var currentDate = new Date();
  $('#add_deadline').datepicker({startDate: currentDate});
  $('#edit_deadline').datepicker({startDate: currentDate});

    
    var edit = false;
    <?php if(isset($edit)){ ?>
        edit = true;
        get_subject_by_class('<?php echo $assignment->class_id; ?>', '<?php echo $assignment->subject_id; ?>');
        get_section_by_class('<?php echo $assignment->class_id; ?>', '<?php echo $assignment->section_id; ?>');
    <?php } ?>
    
    function get_subject_by_class(class_id, subject_id){       
        
        var branch_id = '';
        
        <?php if(isset($edit)){ ?>                
            branch_id = $('#edit_branch_id').val();
         <?php }else{ ?> 
            branch_id = $('#add_branch_id').val();
         <?php } ?> 
             
        if(!branch_id){
           toastr.error('<?php echo lang('select_branch'); ?>');
           return false;
        }
        
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_subject_by_class'); ?>",
            data   : {branch_id:branch_id, class_id : class_id , subject_id : subject_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                   if(edit){
                        $('#edit_subject_id').html(response);
                   }else{
                        $('#add_subject_id').html(response);
                   }
               }
            }
        });                  
        
   }
   
    function get_section_by_class(class_id, section_id){       
        
        var branch_id = '';
        
        <?php if(isset($edit)){ ?>                
            branch_id = $('#edit_branch_id').val();
         <?php }else{ ?> 
            branch_id = $('#add_branch_id').val();
         <?php } ?> 
             
        if(!branch_id){
           toastr.error('<?php echo lang('select_branch'); ?>');
           return false;
        }
        
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_section_by_class'); ?>",
            data   : {branch_id:branch_id, class_id : class_id , section_id : section_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                   if(edit){
                        $('#edit_section_id').html(response);
                   }else{
                        $('#add_section_id').html(response);
                   }
               }
            }
        });                  
        
   }
   
   
   
   /* Menu Filter Start */
    function get_assignment_by_class(url){          
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
        
        
    <?php if(isset($filter_class_id)){ ?>
        get_class_by_school('<?php echo $filter_branch_id; ?>', '<?php echo $filter_class_id; ?>');
    <?php } ?>
    
    function get_class_by_school(branch_id, class_id){
        
        
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_class_by_school'); ?>",
            data   : { branch_id : branch_id, class_id : class_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               { 
                    $('#filter_class_id').html(response);                     
               }
            }
        });
    }      
        
    $("#add").validate();     
    $("#edit").validate(); 
</script>