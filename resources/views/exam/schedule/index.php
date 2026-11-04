<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-thumb-tack"></i><small> <?php echo lang('manage_exam_schedule'); ?></small></h3>
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
                        <li class="<?php if(isset($list)){ echo 'active'; }?>"><a href="#tab_schedule_list"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-list-ol"></i> <?php echo lang('list'); ?></a> </li>
                        <?php if(has_permission(ADD, 'exam', 'schedule')){ ?>
                        
                            <?php if(isset($edit)){ ?>
                                <li  class="<?php if(isset($add)){ echo 'active'; }?>"><a href="<?php echo site_url('exam/schedule/add'); ?>"  aria-expanded="false"><i class="fa fa-plus-square-o"></i> <?php echo lang('add'); ?></a> </li>                          
                             <?php }else{ ?>
                                <li  class="<?php if(isset($add)){ echo 'active'; }?>"><a href="#tab_add_schedule"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-plus-square-o"></i> <?php echo lang('add'); ?></a> </li>                          
                             <?php } ?>
                        <?php } ?> 
                        <?php if(isset($edit)){ ?>
                            <li  class="active"><a href="#tab_edit_schedule"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-pencil-square-o"></i> <?php echo lang('edit'); ?></a> </li>                          
                        <?php } ?>               
                        
                         
                            <li class="li-class-list">
                                
                            <?php $teacher_access_data = get_teacher_access_data(); ?> 
                            <?php $guardian_access_data = get_guardian_access_data('class'); ?>    
                                
                            <?php echo form_open(site_url('exam/schedule/index'), array('name' => 'filter', 'id' => 'filter', 'class'=>'form-horizontal form-label-left'), ''); ?>
                            <?php if(ci()->session->userdata('role_id') == SUPER_ADMIN){  ?>
                                
                                    <select  class="form-control col-md-7 col-xs-12" style="width:auto;" name="branch_id"  onchange="get_class_by_school_filter(this.value, ''); get_exam_by_school_filter(this.value, '');">
                                            <option value="">--<?php echo lang('select_branch'); ?>--</option> 
                                        <?php foreach($schools as $obj ){ ?>
                                            <option value="<?php echo $obj->id; ?>" <?php if(isset($filter_branch_id) && $filter_branch_id == $obj->id){ echo 'selected="selected"';} ?> > <?php echo $obj->branch_name; ?></option>
                                        <?php } ?>   
                                    </select>
                                   <select  class="form-control col-md-7 col-xs-12" style="width:auto;" name="exam_id" id="filter_exam_id" onchange="reset_class_filter();">
                                            <option value="">--<?php echo lang('select'); ?>--</option>                                         
                                    </select>
                                    <select  class="form-control col-md-7 col-xs-12" id="filter_class_id" name="class_id"  style="width:auto;" onchange="this.form.submit();">
                                         <option value="">--<?php echo lang('select'); ?>--</option> 
                                    </select>                                   
                                
                            <?php }else{  ?>
                                
                                    <input type="hidden" name="branch_id" id="filter_branch_id" value="<?php echo ci()->session->userdata('branch_id'); ?>" />
                                    <select  class="form-control col-md-7 col-xs-12" style="width:auto;" name="exam_id"  id="filter_exam_id" onchange="reset_class_filter();">
                                        <option value="">--<?php echo lang('select'); ?>--</option> 
                                        <?php foreach($exams as $obj ){ ?>
                                            <option value="<?php echo $obj->id; ?>" <?php if(isset($filter_exam_id) && $filter_exam_id == $obj->id){ echo 'selected="selected"';} ?> > <?php echo $obj->title; ?></option>
                                        <?php } ?>   
                                    </select>
                                    <select  class="form-control col-md-7 col-xs-12" name="class_id" id="filter_class_id" onchange="this.form.submit();" style="width:auto;">
                                        <option value="">--<?php echo lang('select'); ?>--</option> 
                                        <?php foreach($class_list as $obj ){ ?>
                                            <?php if(ci()->session->userdata('role_id') == STUDENT){ ?>
                                                <?php if ($obj->id != ci()->session->userdata('class_id')){ continue; } ?>
                                                <option value="<?php echo $obj->id; ?>" <?php if(isset($class_id) && $class_id == $obj->id){ echo 'selected="selected"';} ?> ><?php echo $obj->name; ?></option>
                                            <?php }elseif(ci()->session->userdata('role_id') == GUARDIAN){ ?>
                                                <?php if (!in_array($obj->id, $guardian_access_data)) { continue; } ?>
                                                <option value="<?php echo $obj->id; ?>" <?php if(isset($class_id) && $class_id == $obj->id){ echo 'selected="selected"';} ?> ><?php echo $obj->name; ?></option>
                                            <?php }elseif(ci()->session->userdata('role_id') == TEACHER){ ?>
                                                <?php if (!in_array($obj->id, $teacher_access_data)) { continue; } ?>
                                                <option value="<?php echo $obj->id; ?>" <?php if(isset($class_id) && $class_id == $obj->id){ echo 'selected="selected"';} ?> ><?php echo $obj->name; ?></option>
                                            <?php }else{ ?>
                                                <option value="<?php echo $obj->id; ?>" <?php if(isset($class_id) && $class_id == $obj->id){ echo 'selected="selected"';} ?> ><?php echo $obj->name; ?></option>
                                            <?php } ?> 

                                        <?php } ?>                                            
                                    </select>                                      
                                <?php } ?>
                                <?php echo form_close(); ?>
                            </li>    
                    </ul>
                    <br/>
                    
                    <div class="tab-content">
                        <div  class="tab-pane fade in <?php if(isset($list)){ echo 'active'; }?>" id="tab_schedule_list" >                            
                            <div class="x_content">
                                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th><?php echo lang('sl_no'); ?></th>
                                            <?php if(ci()->session->userdata('role_id') == SUPER_ADMIN){ ?>
                                                <th><?php echo lang('branch'); ?></th>
                                            <?php } ?>
                                            <th><?php echo lang('exam_term'); ?></th>
                                            <th><?php echo lang('class'); ?></th>                                       
                                            <th><?php echo lang('subject'); ?></th>                                       
                                            <th><?php echo lang('date'); ?></th>
                                            <th><?php echo lang('time'); ?></th>
                                            <th><?php echo lang('room_no'); ?></th>
                                            <th><?php echo lang('action'); ?></th>                                            
                                        </tr>
                                    </thead>
                                    <tbody>   
                                                                                
                                        <?php $count = 1; if(isset($schedules) && !empty($schedules)){ ?>
                                            <?php foreach($schedules as $obj){ ?>
                                        
                                            <?php 
                                                if(ci()->session->userdata('role_id') == GUARDIAN){
                                                    if (!in_array($obj->class_id, $guardian_access_data)) { continue; }
                                                }
                                            ?>
                                            <tr>
                                                <td><?php echo $count++; ?></td>
                                                <?php if(ci()->session->userdata('role_id') == SUPER_ADMIN){ ?>
                                                    <td><?php echo $obj->branch_name; ?></td>
                                                <?php } ?>
                                                <td><?php echo $obj->title; ?></td>
                                                <td><?php echo $obj->class_name; ?></td>
                                                <td><?php echo $obj->subject; ?></td>
                                                <td><?php echo date(ci()->global_setting->date_format, strtotime($obj->exam_date)); ?></td>
                                                 <td><?php echo $obj->start_time; ?> - <?php echo $obj->end_time; ?></td>
                                                <td><?php echo $obj->room_no; ?></td>
                                                <td>
                                                    <?php if(has_permission(EDIT, 'exam', 'schedule')){ ?>
                                                        <a href="<?php echo site_url('exam/schedule/edit/'.$obj->id); ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil-square-o"></i> <?php echo lang('edit'); ?> </a>
                                                    <?php } ?>
                                                    <?php if(has_permission(VIEW, 'exam', 'schedule')){ ?>
                                                        <a  onclick="get_schedule_modal(<?php echo $obj->id; ?>);"  data-toggle="modal" data-target=".bs-schedule-modal-lg"  class="btn btn-success btn-xs"><i class="fa fa-eye"></i> <?php echo lang('view'); ?> </a>
                                                    <?php } ?>
                                                    <?php if(has_permission(DELETE, 'exam', 'schedule')){ ?>
                                                        <a href="<?php echo site_url('exam/schedule/delete/'.$obj->id); ?>" onclick="javascript: return confirm('<?php echo lang('conirm_alert'); ?>');" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> <?php echo lang('delete'); ?> </a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div> <!-- End first tab -->
                        
                        

                        <div  class="tab-pane fade in <?php if(isset($add)){ echo 'active'; }?>" id="tab_add_schedule">
                            <div class="x_content"> 
                               <?php echo form_open(site_url('exam/schedule/add'), array('name' => 'add', 'id' => 'add', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                
                                 <?php ci()->load->view('layout/school_list_form'); ?>  
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="exam_id"><?php echo lang('exam_term'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="exam_id" id="add_exam_id" required="required">
                                            <option value="">--<?php echo lang('select'); ?>--</option> 
                                            <?php foreach($exams as $obj ){ ?>
                                            <option value="<?php echo $obj->id; ?>" <?php echo isset($post['exam_id']) && $post['exam_id'] == $obj->id ?  'selected="selected"' : ''; ?>><?php echo $obj->title; ?></option>
                                            <?php } ?>                                            
                                        </select>
                                        <div class="help-block"><?php echo form_error('exam_id'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="class_id"><?php echo lang('class'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="class_id" id="add_class_id" required="required" onchange="get_subject_by_class(this.value, '');">
                                            <option value="">--<?php echo lang('select'); ?>--</option> 
                                            <?php if(isset($classes) && !empty($classes)){ ?>
                                                <?php foreach($classes as $obj ){ ?>
                                                   <?php
                                                    if(ci()->session->userdata('role_id') == TEACHER){
                                                       if (!in_array($obj->id, $teacher_access_data)) {continue; }
                                                    } 
                                                    ?>
                                                   <option value="<?php echo $obj->id; ?>" <?php echo isset($post['class_id']) && $post['class_id'] == $obj->id ?  'selected="selected"' : ''; ?>><?php echo $obj->name; ?></option>
                                                <?php } ?>                                            
                                            <?php } ?>                                            
                                        </select>
                                        <div class="help-block"><?php echo form_error('class_id'); ?></div>
                                    </div>
                                </div>
                                
                                                               
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="subject_id"><?php echo lang('subject'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12 data_subject"  name="subject_id" id="add_subject_id" required="required" >
                                            <option value="">--<?php echo lang('select'); ?>--</option>                                                                                         
                                        </select>
                                        <div class="help-block"><?php echo form_error('subject_id'); ?></div>
                                    </div>
                                </div>
                                
                                                               
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="exam_date"><?php echo lang('exam_date'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="exam_date"  id="add_exam_date" value="<?php echo isset($post['exam_date']) ?  $post['exam_date'] : ''; ?>" placeholder="<?php echo lang('exam_date'); ?>" required="required" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('exam_date'); ?></div>
                                    </div>
                                </div>
                                                               
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="start_time"><?php echo lang('start_time'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="start_time"  id="add_start_time" value="<?php echo isset($post['start_time']) ?  $post['start_time'] : ''; ?>" placeholder="<?php echo lang('start_time'); ?>" required="required" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('start_time'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="end_time"><?php echo lang('end_time'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="end_time"  id="add_end_time" value="<?php echo isset($post['end_time']) ?  $post['end_time'] : ''; ?>" placeholder="<?php echo lang('end_time'); ?>" required="required" type="text"  autocomplete="off">
                                        <div class="help-block"><?php echo form_error('end_time'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="room_no"><?php echo lang('room_no'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="room_no"  id="room_no" value="<?php echo isset($post['room_no']) ?  $post['room_no'] : ''; ?>" placeholder="<?php echo lang('room_no'); ?>" required="required" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('room_no'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="note"><?php echo lang('note'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control col-md-7 col-xs-12"  name="note"  id="note" placeholder="<?php echo lang('note'); ?>"><?php echo isset($post['note']) ?  $post['note'] : ''; ?></textarea>
                                        <div class="help-block"><?php echo form_error('note'); ?></div>
                                    </div>
                                </div>
                               
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <a href="<?php echo site_url('exam/schedule/index/'.$class_id); ?>" class="btn btn-primary"><?php echo lang('cancel'); ?></a>
                                        <button id="send" type="submit" class="btn btn-success"><?php echo lang('submit'); ?></button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                                
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="instructions"><strong><?php echo lang('instruction'); ?>: </strong> <?php echo lang('add_exam_schedule_instruction'); ?></div>
                                </div>
                            </div>
                        </div>  

                        <?php if(isset($edit)){ ?>
                        <div class="tab-pane fade in active" id="tab_edit_schedule">
                            <div class="x_content"> 
                               <?php echo form_open(site_url('exam/schedule/edit/'.$schedule->id), array('name' => 'edit', 'id' => 'edit', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                 
                                <?php ci()->load->view('layout/school_list_edit_form'); ?> 
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="exam_id"><?php echo lang('exam_term'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="exam_id" id="edit_exam_id" required="required">
                                            <option value="">--<?php echo lang('select'); ?>--</option> 
                                            <?php foreach($exams as $obj ){ ?>
                                            <option value="<?php echo $obj->id; ?>" <?php if($obj->id == $schedule->exam_id){ echo 'selected="selected"'; } ?>><?php echo $obj->title; ?></option>
                                            <?php } ?>                                            
                                        </select>
                                        <div class="help-block"><?php echo form_error('exam_id'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="class_id"><?php echo lang('class'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="class_id" id="edit_class_id" required="required" onchange="get_subject_by_class(this.value, '');">
                                            <option value="">--<?php echo lang('select'); ?>--</option> 
                                            <?php foreach($classes as $obj ){ ?>
                                                <?php
                                                if(ci()->session->userdata('role_id') == TEACHER){
                                                   if (!in_array($obj->id, $teacher_access_data)) {continue; }
                                                } 
                                                ?>
                                                    <option value="<?php echo $obj->id; ?>" <?php if($obj->id == $schedule->class_id){ echo 'selected="selected"'; } ?>><?php echo $obj->name; ?></option>
                                            <?php } ?>                                            
                                        </select>
                                        <div class="help-block"><?php echo form_error('class_id'); ?></div>
                                    </div>
                                </div>
                                                               
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="subject_id"><?php echo lang('subject'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12 data_subject"  name="subject_id" id="edit_subject_id" required="required" >
                                            <option value="">--<?php echo lang('select'); ?>--</option>                                                                                         
                                        </select>
                                        <div class="help-block"><?php echo form_error('subject_id'); ?></div>
                                    </div>
                                </div>
                                
                                                          
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="exam_date"><?php echo lang('exam_date'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="exam_date"  id="edit_exam_date" value="<?php echo isset($schedule->exam_date) ?  date('d-m-Y', strtotime($schedule->exam_date)) : ''; ?>" placeholder="<?php echo lang('exam_date'); ?>" required="required" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('exam_date'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="start_time"><?php echo lang('start_time'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="start_time"  id="edit_start_time" value="<?php echo isset($schedule->start_time) ?  $schedule->start_time : ''; ?>" placeholder="<?php echo lang('start_time'); ?>" required="required" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('start_time'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="end_time"><?php echo lang('end_time'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="end_time"  id="edit_end_time" value="<?php echo isset($schedule->end_time) ?  $schedule->end_time : ''; ?>" placeholder="<?php echo lang('end_time'); ?>" required="required" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('end_time'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="room_no"><?php echo lang('room_no'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="room_no"  id="room_no" value="<?php echo isset($schedule->room_no) ?  $schedule->room_no : ''; ?>" placeholder="<?php echo lang('room_no'); ?>" required="required" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('room_no'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="note"><?php echo lang('note'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control col-md-7 col-xs-12"  name="note"  id="note" placeholder="<?php echo lang('note'); ?>"><?php echo isset($schedule->note) ?  $schedule->note : ''; ?></textarea>
                                        <div class="help-block"><?php echo form_error('note'); ?></div>
                                    </div>
                                </div>
                                                             
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <input type="hidden" value="<?php echo isset($schedule) ? $schedule->id : $id; ?>" name="id" />
                                        <a  href="<?php echo site_url('exam/schedule/index/'.$class_id); ?>"  class="btn btn-primary"><?php echo lang('cancel'); ?></a>
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



<div class="modal fade bs-schedule-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title"><?php echo lang('detail_information'); ?></h4>
        </div>
        <div class="modal-body fn_schedule_data">            
        </div>       
      </div>
    </div>
</div>
<script type="text/javascript">
         
    function get_schedule_modal(schedule_id){
         
        $('.fn_schedule_data').html('<p style="padding: 20px;"><p style="padding: 20px;text-align:center;"><img src="<?php echo IMG_URL; ?>loading.gif" /></p>');
        $.ajax({       
          type   : "POST",
          url    : "<?php echo site_url('exam/schedule/get_single_schedule'); ?>",
          data   : {schedule_id : schedule_id},  
          success: function(response){                                                   
             if(response)
             {
                $('.fn_schedule_data').html(response);
             }
          }
       });
    }
</script>



 <link href="<?php echo VENDOR_URL; ?>datepicker/datepicker.css" rel="stylesheet">
 <script src="<?php echo VENDOR_URL; ?>datepicker/datepicker.js"></script>
 <link href="<?php echo VENDOR_URL; ?>timepicker/timepicker.css" rel="stylesheet">
 <script src="<?php echo VENDOR_URL; ?>timepicker/timepicker.js"></script>
 
 
<!-- Super admin js START  -->
 <script type="text/javascript">
     
    var edit = false;
    $("document").ready(function() {
         <?php if(isset($edit) && !empty($edit) && ci()->session->userdata('role_id') != TEACHER){ ?>
           edit = true;       
            $("#edit_branch_id").trigger('change');
         <?php } ?>
    });
     
    $('.fn_branch_id').on('change', function(){
      
        var branch_id = $(this).val();        
        var exam_id = '';
        var class_id = '';
        
        <?php if(isset($edit) && !empty($edit)){ ?>
            exam_id =  '<?php echo $schedule->exam_id; ?>';           
            class_id =  '<?php echo $schedule->class_id; ?>';           
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
                   if(edit){
                       $('#edit_exam_id').html(response);   
                   }else{
                       $('#add_exam_id').html(response);   
                   }
                   
                   get_class_by_school(branch_id, class_id); 
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
                   if(edit){
                       $('#edit_class_id').html(response);   
                   }else{
                       $('#add_class_id').html(response);   
                   }                  
               }
            }
        });                  
        
   }
  
   
  </script>
<!-- Super admin js end -->
 
 
 <script type="text/javascript">
     
  $('#add_exam_date').datepicker();  
  $('#add_start_time').timepicker();
  $('#add_end_time').timepicker();
  
  $('#edit_exam_date').datepicker();
  $('#edit_start_time').timepicker();
  $('#edit_end_time').timepicker();
  
    <?php if(isset($edit)){ ?>
        edit = true;
        get_subject_by_class('<?php echo $schedule->class_id; ?>', '<?php echo $schedule->subject_id; ?>');
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
            data   : {branch_id:branch_id, class_id : class_id,  subject_id : subject_id},               
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
        
    /* Menu Filter Start */ 
      
    <?php if(isset($filter_class_id)){ ?>
        get_class_by_school_filter('<?php echo $filter_branch_id; ?>', '<?php echo $filter_class_id; ?>');
    <?php } ?>
    
    function get_class_by_school_filter(branch_id, class_id){
     
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
    
    <?php if(isset($filter_exam_id)){ ?>
        get_exam_by_school_filter('<?php echo $filter_exam_id; ?>');
    <?php } ?>

    function get_exam_by_school_filter(exam_id){
                
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_exam_by_school'); ?>",
            data   : { exam_id : exam_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               { 
                    $('#filter_exam_id').html(response);                     
               }
            }
        });
    }
    
    function reset_class_filter(){
        $('#filter_class_id')[0].selectedIndex = 0;
    }
        
    $("#add").validate();     
    $("#edit").validate(); 
</script>