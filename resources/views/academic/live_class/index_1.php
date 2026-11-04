<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-headphones"></i><small> <?php echo lang('manage_live_class'); ?></small></h3>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
            
            <div class="x_content">
                <div class="" data-example-id="togglable-tabs">
                    
                    <ul  class="nav nav-tabs bordered">
                        <li class="<?php if(isset($list)){ echo 'active'; }?>"><a href="#tab_liveclass_list"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-list-ol"></i> <?php echo lang('list'); ?></a> </li>
                        <?php if(has_permission(ADD, 'academic', 'liveclass')){ ?>                        
                            <?php if(isset($edit)){ ?>
                                <li  class="<?php if(isset($add)){ echo 'active'; }?>"><a href="<?php echo site_url('academic/liveclass/add'); ?>"  aria-expanded="false"><i class="fa fa-plus-square-o"></i> <?php echo lang('add'); ?></a> </li>                          
                             <?php }else{ ?>
                                <li  class="<?php if(isset($add)){ echo 'active'; }?>"><a href="#tab_add_liveclass"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-plus-square-o"></i> <?php echo lang('add'); ?></a> </li>                          
                             <?php } ?>
                        <?php } ?> 
                        <?php if(isset($edit)){ ?>
                            <li  class="active"><a href="#tab_edit_liveclass"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-pencil-square-o"></i> <?php echo lang('edit'); ?></a> </li>                          
                        <?php } ?>               
                        
                         
                            <li class="li-class-list">
                                
                            <?php $teacher_access_data = get_teacher_access_data(); ?> 
                            <?php $guardian_access_data = get_guardian_access_data('class'); ?>    
                                
                            <?php if(ci()->session->userdata('role_id') == SUPER_ADMIN){  ?>
                                
                                <?php echo form_open(site_url('academic/liveclass/index'), array('name' => 'filter', 'id' => 'filter', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                    <select  class="form-control col-md-7 col-xs-12" style="width:auto;" name="branch_id"  onchange="get_class_by_school_filter(this.value, '');">
                                            <option value="">--<?php echo lang("select_branch"); ?>--</option> 
                                        <?php foreach(ci()->schools as $obj ){ ?>
                                            <option value="<?php echo $obj->id; ?>" <?php if(isset($filter_branch_id) && $filter_branch_id == $obj->id){ echo 'selected="selected"';} ?> > <?php echo $obj->branch_name; ?></option>
                                        <?php } ?>   
                                    </select>
                                    <select  class="form-control col-md-7 col-xs-12" id="filter_class_id" name="class_id"  style="width:auto;" onchange="this.form.submit();">
                                         <option value="">--<?php echo lang('select'); ?>--</option> 
                                    </select>
                                   <?php echo form_close(); ?>
                                
                            <?php }else{  ?>
                                
                                    <select  class="form-control col-md-7 col-xs-12" onchange="get_live_class_list_by_class(this.value);">
                                        <option value="<?php echo site_url('academic/liveclass/index'); ?>">--<?php echo lang('select'); ?>--</option> 
                                        <?php foreach($class_list as $obj ){ ?>
                                            <?php if(ci()->session->userdata('role_id') == STUDENT){ ?>
                                                <?php if ($obj->id != ci()->session->userdata('class_id')){ continue; } ?> 
                                                <option value="<?php echo site_url('academic/liveclass/index/'.$obj->id); ?>" <?php if(isset($class_id) && $class_id == $obj->id){ echo 'selected="selected"';} ?> ><?php echo $obj->name; ?></option>
                                            <?php }elseif(ci()->session->userdata('role_id') == GUARDIAN){ ?>
                                                <?php if (!in_array($obj->id, $guardian_access_data)) { continue; } ?>
                                                <option value="<?php echo site_url('academic/liveclass/index/'.$obj->id); ?>" <?php if(isset($class_id) && $class_id == $obj->id){ echo 'selected="selected"';} ?> ><?php echo $obj->name; ?></option>
                                            <?php }elseif(ci()->session->userdata('role_id') == TEACHER){ ?>
                                                <?php if (!in_array($obj->id, $teacher_access_data)) { continue; } ?>
                                                <option value="<?php echo site_url('academic/liveclass/index/'.$obj->id); ?>" <?php if(isset($class_id) && $class_id == $obj->id){ echo 'selected="selected"';} ?> ><?php echo $obj->name; ?></option>
                                            <?php }else{ ?>
                                                <option value="<?php echo site_url('academic/liveclass/index/'.$obj->id); ?>" <?php if(isset($class_id) && $class_id == $obj->id){ echo 'selected="selected"';} ?> ><?php echo $obj->name; ?></option>
                                            <?php } ?> 

                                        <?php } ?>                                            
                                    </select>                                      
                                <?php } ?>
                            </li>    
                    </ul>
                    <br/>
                    
                    <div class="tab-content">
                        <div  class="tab-pane fade in <?php if(isset($list)){ echo 'active'; }?>" id="tab_liveclass_list" >                            
                            <div class="x_content">
                                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th><?php echo lang('sl_no'); ?></th>
                                            <?php if(ci()->session->userdata('role_id') == SUPER_ADMIN){ ?>
                                                <th><?php echo lang('branch'); ?></th>
                                            <?php } ?>
                                            <th><?php echo lang('class'); ?></th>                                       
                                            <th><?php echo lang('section'); ?></th>                                       
                                            <th><?php echo lang('subject'); ?></th>                                       
                                            <th><?php echo lang('teacher'); ?></th>                                       
                                            <th><?php echo lang('class_date'); ?></th>
                                            <th><?php echo lang('start_time'); ?></th>
                                            <th><?php echo lang('end_time'); ?></th>
                                            <th><?php echo lang('status'); ?></th>                                            
                                            <th><?php echo lang('action'); ?></th>                                            
                                        </tr>
                                    </thead>
                                    <tbody>   
                                                                                
                                        <?php $count = 1; if(isset($live_classes) && !empty($live_classes)){ ?>
                                            <?php foreach($live_classes as $obj){ ?>                                        
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
                                                <td><?php echo $obj->class_name; ?></td>
                                                <td><?php echo $obj->section; ?></td>
                                                <td><?php echo $obj->subject; ?></td>
                                                <td><?php echo $obj->teacher; ?></td>
                                                <td><?php echo date(ci()->global_setting->date_format, strtotime($obj->class_date)); ?></td>
                                                 <td><?php echo $obj->start_time; ?></td>
                                                <td><?php echo $obj->end_time; ?></td>
                                                <td>
                                                    
                                                    <?php  
                                                        $class_type = '';
                                                        
                                                        if($obj->class_type == 'zoom'){ $class_type = 'Zoom';
                                                        }else if($obj->class_type == 'jitsi'){ $class_type = 'Jitsi';}
                                                        
                                                        $flag = 1;
                                                        $status = '<i class="fa fa-spinner"></i> ' . lang('waiting');
                                                        $button = 'btn btn-info btn-xs';
                                                        if (strtotime($obj->class_date) == strtotime(date('Y-m-d')) && (strtotime(date('Y-m-d') .' '. $obj->start_time)) <= (strtotime(date('Y-m-d g:i A'))) && (strtotime(date('Y-m-d') .' '. $obj->end_time)) >= (strtotime(date('Y-m-d g:i A')))) {
                                                            $status = '<i class="fa fa-video-camera"></i> ' . lang('live');
                                                            $button = 'btn btn-success btn-xs';
                                                            $flag = 2;
                                                        }else if (strtotime($obj->class_date) < strtotime(date('Y-m-d')) || (strtotime(date('Y-m-d') .' '. $obj->end_time)) < (strtotime(date('Y-m-d g:i A')))) {
                                                            $status = '<i class="fa fa-check-square"></i> ' . lang('expire');
                                                            $button = 'btn btn-danger btn-xs';
                                                            $flag = 3;
                                                        }
                                                        echo "<span class=' " . $button . " '>" . $status . "</span>";
                                                        ?>
                                                </td>
                                                <td>                                                    
                                                    <?php if(has_permission(VIEW, 'academic', 'liveclass') && (ci()->session->userdata('role_id') == STUDENT || ci()->session->userdata('role_id') == GUARDIAN)){ ?>
                                                        
                                                        <?php if($flag == 2){ ?>
                                                                <a  href="<?php echo site_url('academic/liveclass/start/'.$obj->id); ?>"   class="btn btn-success btn-xs"><i class="fa fa-sitemap"></i> <?php echo lang('join_class'); ?>  [ <?php echo $class_type; ?> ]</a>
                                                        <?php }elseif($flag == 1){ ?>
                                                                <a  onclick="javascript: return confirm('<?php echo lang('waiting'); ?>');"   class="btn btn-info btn-xs"><i class="fa fa-hand-o-up"></i> <?php echo lang('join_class'); ?> [ <?php echo $class_type; ?> ]</a>
                                                        <?php }else{ ?>
                                                                <a  onclick="javascript: return confirm('<?php echo lang('expire'); ?>');"   class="btn btn-danger btn-xs"><i class="fa fa-hand-o-up"></i> <?php echo lang('join_class'); ?> [ <?php echo $class_type; ?> ]</a>
                                                        <?php } ?>
                                                                
                                                    <?php }else{ ?>
                                                                
                                                        <?php if($flag == 2){ ?>
                                                                <a  href="<?php echo site_url('academic/liveclass/start/'.$obj->id); ?>"   class="btn btn-success btn-xs"><i class="fa fa-sitemap"></i> <?php echo lang('host_class'); ?> [ <?php echo $class_type; ?> ]</a>
                                                        <?php }elseif($flag == 1){ ?>
                                                                <a  onclick="javascript: return confirm('<?php echo lang('waiting'); ?>');"   class="btn btn-info btn-xs"><i class="fa fa-hand-o-up"></i> <?php echo lang('host_class'); ?> [ <?php echo $class_type; ?> ]</a>
                                                        <?php }else{ ?>
                                                                <a  onclick="javascript: return confirm('<?php echo lang('expire'); ?>');"   class="btn btn-danger btn-xs"><i class="fa fa-hand-o-up"></i> <?php echo lang('host_class'); ?> [ <?php echo $class_type; ?> ]</a>
                                                        <?php } ?>
                                                                
                                                    <?php } ?>  
                                                        
                                                    <?php if(has_permission(EDIT, 'academic', 'liveclass')){ ?>
                                                        <a href="<?php echo site_url('academic/liveclass/edit/'.$obj->id); ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil-square-o"></i> <?php echo lang('edit'); ?> </a>
                                                    <?php } ?>                                                    
                                                    <?php if(has_permission(DELETE, 'academic', 'liveclass')){ ?>
                                                        <a href="<?php echo site_url('academic/liveclass/delete/'.$obj->id); ?>" onclick="javascript: return confirm('<?php echo lang('conirm_alert'); ?>');" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> <?php echo lang('delete'); ?> </a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div> <!-- End first tab -->
                        
                        

                        <div  class="tab-pane fade in <?php if(isset($add)){ echo 'active'; }?>" id="tab_add_liveclass">
                            <div class="x_content"> 
                               <?php echo form_open(site_url('academic/liveclass/add'), array('name' => 'add', 'id' => 'add', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                
                                <?php ci()->load->view('layout/school_list_form'); ?>  
                                                               
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="class_id"><?php echo lang('class'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="class_id" id="add_class_id" required="required" onchange="get_subject_by_class(this.value, ''); get_section_by_class(this.value, '');">
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
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="section_id"><?php echo lang('section'); ?> <span class="required">*</span> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="section_id" id="add_section_id" required="required">
                                            <option value="">--<?php echo lang('select'); ?>--</option>                                                                                       
                                        </select>
                                        <div class="help-block"><?php echo form_error('section_id'); ?></div>
                                    </div>
                                </div>
                                                                                               
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="subject_id"><?php echo lang('subject'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12 data_subject"  name="subject_id" id="add_subject_id" required="required" >
                                            <option value="">--<?php echo lang('select'); ?>--</option>                                                                                         
                                        </select>
                                        <div class="help-block"><?php echo form_error('subject_id'); ?></div>
                                    </div>
                                </div>
                                
                                <?php if(ci()->session->userdata('role_id') != TEACHER){ ?>  
                                
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="teacher_id"><?php echo lang('teacher'); ?> <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select  class="form-control col-md-7 col-xs-12 data_subject"  name="teacher_id" id="add_teacher_id" required="required" >
                                                <option value="">--<?php echo lang('select'); ?>--</option> 
                                                <?php if(isset($teachers) && !empty($teachers)){ ?>
                                                    <?php foreach($teachers as $obj ){ ?>                                                   
                                                       <option value="<?php echo $obj->id; ?>" <?php echo isset($post['teacher_id']) && $post['teacher_id'] == $obj->id ?  'selected="selected"' : ''; ?>><?php echo $obj->name; ?></option>
                                                    <?php } ?>                                            
                                                <?php } ?>  
                                            </select>
                                            <div class="help-block"><?php echo form_error('teacher_id'); ?></div>
                                        </div>
                                    </div>
                                
                                <?php }else{ ?>
                                
                                    <div class="item form-group">                                       
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="hidden" name="teacher_id" id="add_teacher_id" value="<?php echo logged_in_user_id(); ?>" />
                                        </div>
                                    </div>
                                <?php } ?>
                                
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="class_type"><?php echo lang('class_type'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12 data_subject"  name="class_type" id="add_class_type" required="required" onchange="set_live_class_type(this.value, 'add');">
                                            <option value="">--<?php echo lang('select'); ?>--</option>                                                                                         
                                            <option value="zoom">Zoom Meet</option>                                                                                         
                                            <option value="jitsi">Jitsi Meet</option>                                                                                         
                                        </select>
                                        <div class="help-block"><?php echo form_error('class_type'); ?></div>
                                    </div>
                                </div>
                                
                                
                                <div class="fn_add_zoom_setting display">
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="zoom_meeting_id"><?php echo lang('meeting_id'); ?> <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input  class="form-control col-md-7 col-xs-12"  name="zoom_meeting_id"  id="add_zoom_meeting_id" value="<?php echo isset($post['zoom_meeting_id']) ?  $post['zoom_meeting_id'] : ''; ?>" placeholder="<?php echo lang('meeting_id'); ?>" required="required" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('zoom_meeting_id'); ?></div>
                                        </div>
                                    </div>

                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="zoom_meeting_password"><?php echo lang('meeting_password'); ?> <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input  class="form-control col-md-7 col-xs-12"  name="zoom_meeting_password"  id="add_zoom_meeting_password" value="<?php echo isset($post['zoom_meeting_password']) ?  $post['zoom_meeting_password'] : ''; ?>" placeholder="<?php echo lang('meeting_password'); ?>" required="required" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('zoom_meeting_password'); ?></div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="fn_add_bbb_setting display">
                                    
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="bbb_meeting_id"><?php echo lang('meeting_id'); ?> <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input  class="form-control col-md-7 col-xs-12"  name="bbb_meeting_id"  id="add_bbb_meeting_id" value="<?php echo isset($post['bbb_meeting_id']) ?  $post['bbb_meeting_id'] : ''; ?>" placeholder="<?php echo lang('meeting_id'); ?>" required="required" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('bbb_meeting_id'); ?></div>
                                        </div>
                                    </div>

                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="max_participant"><?php echo lang('participant_number'); ?></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input  class="form-control col-md-7 col-xs-12"  name="max_participant"  id="add_max_participant" value="<?php echo isset($post['max_participant']) ?  $post['max_participant'] : ''; ?>" placeholder="<?php echo lang('participant_number'); ?>" type="number" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('max_participant'); ?></div>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12 chk-label" for="set_record"><?php echo lang('set_record'); ?></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="checkbox" value="1" checked="checked" name="set_record" id="add_set_record" />
                                            <div class="help-block"><?php echo form_error('set_record'); ?></div>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12 chk-label" for="mute_on_start"><?php echo lang('mute_on_start'); ?></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="checkbox" value="1" checked="checked" name="mute_on_start" id="add_mute_on_start" />
                                            <div class="help-block"><?php echo form_error('mute_on_start'); ?></div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="class_date"><?php echo lang('class_date'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="class_date"  id="add_class_date" value="<?php echo isset($post['class_date']) ?  $post['class_date'] : ''; ?>" placeholder="<?php echo lang('class_date'); ?>" required="required" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('class_date'); ?></div>
                                    </div>
                                </div>
                                                               
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="start_time"><?php echo lang('start_time'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="start_time"  id="add_start_time" value="<?php echo isset($post['start_time']) ?  $post['start_time'] : ''; ?>" placeholder="<?php echo lang('start_time'); ?>" required="required" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('start_time'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="end_time"><?php echo lang('end_time'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="end_time"  id="add_end_time" value="<?php echo isset($post['end_time']) ?  $post['end_time'] : ''; ?>" placeholder="<?php echo lang('end_time'); ?>" required="required" type="text"  autocomplete="off">
                                        <div class="help-block"><?php echo form_error('end_time'); ?></div>
                                    </div>
                                </div>
                                                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="note"><?php echo lang('note'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control col-md-7 col-xs-12"  name="note"  id="note" placeholder="<?php echo lang('note'); ?>"><?php echo isset($post['note']) ?  $post['note'] : ''; ?></textarea>
                                        <div class="help-block"><?php echo form_error('note'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12 chk-label" for="send_notification"><?php echo lang('send_notification'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="checkbox" value="1" name="send_notification" id="add_send_notification" />
                                        <div class="help-block"><?php echo form_error('send_notification'); ?></div>
                                    </div>
                                </div>
                               
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <a href="<?php echo site_url('academic/liveclass/index/'.$class_id); ?>" class="btn btn-primary"><?php echo lang('cancel'); ?></a>
                                        <button id="send" type="submit" class="btn btn-success"><?php echo lang('submit'); ?></button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>                              
                            </div>
                        </div>  

                        <?php if(isset($edit)){ ?>
                        <div class="tab-pane fade in active" id="tab_edit_liveclass">
                            <div class="x_content"> 
                               <?php echo form_open(site_url('academic/liveclass/edit/'.$live_class->id), array('name' => 'edit', 'id' => 'edit', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                 
                                <?php ci()->load->view('layout/school_list_edit_form'); ?> 
                                
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="class_id"><?php echo lang('class'); ?> <span class="required">*</span> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="class_id" id="edit_class_id" required="required" onchange="get_subject_by_class(this.value, ''); get_section_by_class(this.value, '');">
                                            <option value="">--<?php echo lang('select'); ?>--</option> 
                                            <?php foreach($classes as $obj ){ ?>
                                                <?php
                                                if(ci()->session->userdata('role_id') == TEACHER){
                                                   if (!in_array($obj->id, $teacher_access_data)) {continue; }
                                                } 
                                                ?>
                                                    <option value="<?php echo $obj->id; ?>" <?php if($obj->id == $live_class->class_id){ echo 'selected="selected"'; } ?>><?php echo $obj->name; ?></option>
                                            <?php } ?>                                            
                                        </select>
                                        <div class="help-block"><?php echo form_error('class_id'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="section_id"><?php echo lang('section'); ?> <span class="required">*</span> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="section_id" id="edit_section_id" required="required">
                                            <option value="">--<?php echo lang('select'); ?>--</option>                                                                                       
                                        </select>
                                        <div class="help-block"><?php echo form_error('section_id'); ?></div>
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
                                
                                <?php if(ci()->session->userdata('role_id') != TEACHER){ ?>  
                                
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="teacher_id"><?php echo lang('teacher'); ?> <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select  class="form-control col-md-7 col-xs-12 data_subject"  name="teacher_id" id="edit_teacher_id" required="required" >
                                                <option value="">--<?php echo lang('select'); ?>--</option> 
                                                <?php if(isset($teachers) && !empty($teachers)){ ?>
                                                    <?php foreach($teachers as $obj ){ ?>                                                   
                                                       <option value="<?php echo $obj->id; ?>" <?php echo isset($live_class->teacher_id) && $live_class->teacher_id == $obj->id ?  'selected="selected"' : ''; ?>><?php echo $obj->name; ?></option>
                                                    <?php } ?>                                            
                                                <?php } ?>  
                                            </select>
                                            <div class="help-block"><?php echo form_error('teacher_id'); ?></div>
                                        </div>
                                    </div>
                                
                                <?php }else{ ?>
                                
                                    <div class="item form-group">                                       
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="hidden" name="teacher_id" id="edit_teacher_id" value="<?php echo logged_in_user_id(); ?>" />
                                        </div>
                                    </div>
                                
                                <?php } ?>
                                
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="class_type"><?php echo lang('class_type'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12 data_subject"  name="class_type" id="add_class_type" required="required" onchange="set_live_class_type(this.value, 'edit');">
                                            <option value="">--<?php echo lang('select'); ?>--</option>                                                                                         
                                            <option value="zoom" <?php echo isset($live_class->class_type) && $live_class->class_type == 'zoom' ?  'selected="selected"' : ''; ?>>Zoom Meet</option>                                                                                         
                                            <option value="jitsi" <?php echo isset($live_class->class_type) && $live_class->class_type == 'jitsi' ?  'selected="selected"' : ''; ?>>Jitsi Meet</option>                                                                                         
                                            <option value="bbb" <?php echo isset($live_class->class_type) && $live_class->class_type == 'bbb' ?  'selected="selected"' : ''; ?>>BigBlueButton</option>                                                                                         
                                        </select>
                                        <div class="help-block"><?php echo form_error('class_type'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="fn_edit_zoom_setting <?php echo isset($live_class->class_type) && $live_class->class_type == 'zoom' ? '' : 'display'; ?>">
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="zoom_meeting_id"><?php echo lang('meeting_id'); ?> <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input  class="form-control col-md-7 col-xs-12"  name="zoom_meeting_id"  id="edit_zoom_meeting_id" value="<?php echo isset($live_class->zoom_meeting_id) ?  $live_class->zoom_meeting_id : ''; ?>" placeholder="<?php echo lang('meeting_id'); ?>" required="required" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('zoom_meeting_id'); ?></div>
                                        </div>
                                    </div>

                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="zoom_meeting_password"><?php echo lang('meeting_password'); ?> <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input  class="form-control col-md-7 col-xs-12"  name="zoom_meeting_password"  id="edit_zoom_meeting_password" value="<?php echo isset($live_class->zoom_meeting_password) ?  $live_class->zoom_meeting_password : ''; ?>" placeholder="<?php echo lang('meeting_password'); ?>" required="required" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('zoom_meeting_password'); ?></div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="fn_edit_bbb_setting <?php echo isset($live_class->class_type) && $live_class->class_type == 'bbb' ? '' : 'display'; ?>">
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="bbb_meeting_id"><?php echo lang('meeting_id'); ?> <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input  class="form-control col-md-7 col-xs-12"  name="bbb_meeting_id"  id="edit_bbb_meeting_id" value="<?php echo isset($live_class->bbb_meeting_id) ?  $live_class->bbb_meeting_id : ''; ?>" placeholder="<?php echo lang('meeting_id'); ?>" required="required" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('bbb_meeting_id'); ?></div>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="max_participant"><?php echo lang('participant_number'); ?></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input  class="form-control col-md-7 col-xs-12"  name="max_participant"  id="edit_max_participant" value="<?php echo isset($live_class->max_participant) ?  $live_class->max_participant : ''; ?>" placeholder="<?php echo lang('participant_number'); ?>" type="number" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('max_participant'); ?></div>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12 chk-label" for="mute_on_start"><?php echo lang('mute_on_start'); ?></label>
                                       <div class="col-md-6 col-sm-6 col-xs-12">
                                           <input type="checkbox" value="1" name="mute_on_start" id="edit_mute_on_start" <?php echo isset($live_class->mute_on_start) && $live_class->mute_on_start == 1 ?  'checked="checked"' : ''; ?>/>
                                           <div class="help-block"><?php echo form_error('mute_on_start'); ?></div>
                                       </div>
                                   </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12 chk-label" for="set_record"><?php echo lang('set_record'); ?></label>
                                       <div class="col-md-6 col-sm-6 col-xs-12">
                                           <input type="checkbox" value="1" name="set_record" id="edit_set_record" <?php echo isset($live_class->set_record) && $live_class->set_record == 1 ?  'checked="checked"' : ''; ?>/>
                                           <div class="help-block"><?php echo form_error('set_record'); ?></div>
                                       </div>
                                   </div>
                                    
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="class_date"><?php echo lang('class_date'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="class_date"  id="edit_class_date" value="<?php echo isset($live_class->class_date) ?  date('d-m-Y', strtotime($live_class->class_date)) : ''; ?>" placeholder="<?php echo lang('class_date'); ?>" required="required" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('class_date'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="start_time"><?php echo lang('start_time'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="start_time"  id="edit_start_time" value="<?php echo isset($live_class->start_time) ?  $live_class->start_time : ''; ?>" placeholder="<?php echo lang('start_time'); ?>" required="required" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('start_time'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="end_time"><?php echo lang('end_time'); ?> <span class="required">*</span> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="end_time"  id="edit_end_time" value="<?php echo isset($live_class->end_time) ?  $live_class->end_time : ''; ?>" placeholder="<?php echo lang('end_time'); ?>" required="required" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('end_time'); ?></div>
                                    </div>
                                </div>
                                                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="note"><?php echo lang('note'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control col-md-7 col-xs-12"  name="note"  id="note" placeholder="<?php echo lang('note'); ?>"><?php echo isset($live_class->note) ?  $live_class->note : ''; ?></textarea>
                                        <div class="help-block"><?php echo form_error('note'); ?></div>
                                    </div>
                                </div>
                                
                                 <div class="item form-group">
                                     <label class="control-label col-md-3 col-sm-3 col-xs-12 chk-label" for="send_notification"><?php echo lang('send_notification'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="checkbox" value="1" name="send_notification" id="add_send_notification" <?php echo isset($live_class->send_notification) && $live_class->send_notification == 1 ?  'checked="checked"' : ''; ?>/>
                                        <div class="help-block"><?php echo form_error('send_notification'); ?></div>
                                    </div>
                                </div>
                                                             
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <input type="hidden" value="<?php echo isset($live_class) ? $live_class->id : $id; ?>" name="id" />
                                        <a  href="<?php echo site_url('academic/liveclass/index/'.$class_id); ?>"  class="btn btn-primary"><?php echo lang('cancel'); ?></a>
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
        var teacher_id = '';
        var class_id = '';
        
        <?php if(isset($edit) && !empty($edit)){ ?>
            teacher_id =  '<?php echo $live_class->teacher_id; ?>';           
            class_id =  '<?php echo $live_class->class_id; ?>';           
         <?php } ?> 
        
        if(!branch_id){
           toastr.error('<?php echo lang('select_branch'); ?>');
           return false;
        }
        
        get_class_by_school(branch_id, class_id);  
        get_teacher_by_school(branch_id, teacher_id);
        
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
  
   function get_teacher_by_school(branch_id, teacher_id){       
         
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_teacher_by_school'); ?>",
            data   : { branch_id:branch_id, teacher_id:teacher_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {  
                   if(edit){
                       $('#edit_teacher_id').html(response);   
                   }else{
                       $('#add_teacher_id').html(response);   
                   }                  
               }
            }
        });                  
        
   }
  
   
  </script>
<!-- Super admin js end -->
 
 
 <script type="text/javascript">
     
  $('#add_class_date').datepicker();  
  $('#add_start_time').timepicker();
  $('#add_end_time').timepicker();
  
  $('#edit_class_date').datepicker();
  $('#edit_start_time').timepicker();
  $('#edit_end_time').timepicker();
  
    function set_live_class_type(class_type, form_mode){
        
        if(class_type == 'zoom'){
            
            $('.fn_'+form_mode+'_bbb_setting').hide();
            $('#'+form_mode+'_bbb_meeting_id').prop('required', false);  
            $('.fn_'+form_mode+'_zoom_setting').show();
            $('#'+form_mode+'_zoom_meeting_id').prop('required', true);  
            $('#'+form_mode+'_zoom_meeting_password').prop('required', true); 
            
        }else if(class_type == 'bbb'){
            
            $('.fn_'+form_mode+'_zoom_setting').hide();
            $('#'+form_mode+'_zoom_meeting_id').prop('required', false); 
            $('#'+form_mode+'_zoom_meeting_password').prop('required', false);  
            $('.fn_'+form_mode+'_bbb_setting').show();
            $('#'+form_mode+'_bbb_meeting_id').prop('required', true);  
            
        }else{
            
            $('.fn_'+form_mode+'_zoom_setting').hide();
            $('.fn_'+form_mode+'_bbb_setting').hide();
            $('#'+form_mode+'_zoom_meeting_id').prop('required', false);  
            $('#'+form_mode+'_zoom_meeting_password').prop('required', false);
            $('#'+form_mode+'_bbb_meeting_id').prop('required', false);  
        }
    }
  
    <?php if(isset($edit)){ ?>
        edit = true;
        get_subject_by_class('<?php echo $live_class->class_id; ?>', '<?php echo $live_class->subject_id; ?>');
    <?php } ?>
         
    function get_subject_by_class(class_id, subject_id){       
         
        var branch_id = '';
       
        <?php if(isset($edit)){ ?>                
            branch_id = $('#edit_branch_id').val();
         <?php }else{ ?> 
            branch_id = $('#add_branch_id').val();
         <?php } ?> 
             
        if(!branch_id){
           toastr.error('<?php echo lang("select_branch"); ?>');
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
   
    <?php if(isset($edit)){ ?>
        edit = true;
        get_section_by_class('<?php echo $live_class->class_id; ?>', '<?php echo $live_class->section_id; ?>');
    <?php } ?>
         
    function get_section_by_class(class_id, section_id){       
         
        var branch_id = '';
       
        <?php if(isset($edit)){ ?>                
            branch_id = $('#edit_branch_id').val();
         <?php }else{ ?> 
            branch_id = $('#add_branch_id').val();
         <?php } ?> 
             
        if(!branch_id){
           toastr.error('<?php echo lang("select_branch"); ?>');
           return false;
        } 
         
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_section_by_class'); ?>",
            data   : {branch_id:branch_id, class_id : class_id,  section_id : section_id},               
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
    
    function get_live_class_list_by_class(url){          
       if(url){
           window.location.href = url; 
       }
    }        
        
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

        
    $("#add").validate();     
    $("#edit").validate(); 
</script>