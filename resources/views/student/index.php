<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-users"></i><small> <?php echo lang('manage_student'); ?></small></h3>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
          
            <div class="x_content quick-link no-print">
                <?php ci()->load->view('quick-link'); ?> 
            </div>
            <div class="x_content no-print">
                <div class="" data-example-id="togglable-tabs">
                    
                    <ul  class="nav nav-tabs bordered">
                        
                        <?php if(isset($detail)){ ?>
                        
                            <li class="<?php if(isset($list)){ echo 'active'; }?>"><a href="<?php echo site_url('student/index'); ?>"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-list-ol"></i> <?php echo lang('list'); ?></a> </li>
                            
                            <?php if(has_permission(ADD, 'student', 'student')){ ?>
                                <li  class="<?php if(isset($add)){ echo 'active'; }?>"><a href="<?php echo site_url('student/add'); ?>"  aria-expanded="false"><i class="fa fa-plus-square-o"></i> <?php echo lang('add'); ?></a> </li>                          
                            <?php } ?>                           
                            <li  class="active"><a href="#tab_view_student"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-pencil-square-o"></i> <?php echo lang('view'); ?></a> </li>                          
                                                      
                        <?php }else{ ?> 
                            <li class="<?php if(isset($list)){ echo 'active'; }?>"><a href="#tab_student_list"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-list-ol"></i> <?php echo lang('list'); ?></a> </li>
                            <?php if(has_permission(ADD, 'student', 'student')){ ?>
                                <?php if(isset($edit)){ ?>
                                    <li  class="<?php if(isset($add)){ echo 'active'; }?>"><a href="<?php echo site_url('student/add'); ?>"  aria-expanded="false"><i class="fa fa-plus-square-o"></i> <?php echo lang('add'); ?></a> </li>                          
                                 <?php }else{ ?>
                                     <li  class="<?php if(isset($add)){ echo 'active'; }?>"><a href="#tab_add_student"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-plus-square-o"></i> <?php echo lang('add'); ?></a> </li>                          
                                 <?php } ?>
                            <?php } ?>

                            <?php if(isset($edit)){ ?>
                                <li  class="active"><a href="#tab_edit_student"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-pencil-square-o"></i> <?php echo lang('edit'); ?></a> </li>                          
                            <?php } ?>
                        <?php } ?>     
                            
                         
                        <li class="li-class-list">
                            <?php if(ci()->session->userdata('role_id') == SUPER_ADMIN){  ?>
                            
                                <?php echo form_open(site_url('student/index'), array('name' => 'filter', 'id' => 'filter', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                    <select  class="form-control col-md-7 col-xs-12" style="width:auto;" name="branch_id"  onchange="get_class_by_school(this.value, '');">
                                            <option value="">--<?php echo lang('select_branch'); ?>--</option> 
                                        <?php foreach($schools as $obj ){ ?>
                                            <option value="<?php echo $obj->id; ?>" <?php if(isset($filter_branch_id) && $filter_branch_id == $obj->id){ echo 'selected="selected"';} ?> > <?php echo $obj->branch_name; ?></option>
                                        <?php } ?>   
                                    </select>
                                    <select  class="form-control col-md-7 col-xs-12" id="filter_class_id" name="class_id"  style="width:auto;" onchange="this.form.submit();">
                                         <option value="">--<?php echo lang('select'); ?>--</option> 
                                        <?php if(isset($class_list) && !empty($class_list)){ ?>
                                            <?php foreach($class_list as $obj ){ ?>
                                                <option value="<?php echo $obj->id; ?>"><?php echo $obj->name; ?></option> 
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                   <?php echo form_close(); ?>
                            
                            <?php }else{  ?> 
                                <select  class="form-control col-md-7 col-xs-12" onchange="get_student_by_class(this.value);">
                                    <?php if(ci()->session->userdata('role_id') != STUDENT){ ?>    
                                        <option value="<?php echo site_url('student/index'); ?>">--<?php echo lang('select'); ?>--</option> 
                                    <?php } ?>
                                    <?php $teacher_student_data = get_teacher_access_data(); ?>     
                                    <?php $guardian_class_data = get_guardian_access_data('class'); ?>      
                                    <?php foreach($classes as $obj ){ ?>
                                        <?php if(ci()->session->userdata('role_id') == STUDENT){ ?>
                                            <?php if ($obj->id != ci()->session->userdata('class_id')){ continue; } ?>
                                            <option value="<?php echo site_url('student/index/'.$obj->id); ?>" <?php if(isset($class_id) && $class_id == $obj->id){ echo 'selected="selected"';} ?> ><?php echo $obj->name; ?></option>
                                        <?php }elseif(ci()->session->userdata('role_id') == GUARDIAN){ ?>
                                            <?php if (!in_array($obj->id, $guardian_class_data)) { continue; } ?>
                                            <option value="<?php echo site_url('student/index/'.$obj->id); ?>" <?php if(isset($class_id) && $class_id == $obj->id){ echo 'selected="selected"';} ?> ><?php echo $obj->name; ?></option>
                                        <?php }elseif(ci()->session->userdata('role_id') == TEACHER){ ?>
                                            <?php if (!in_array($obj->id, $teacher_student_data)) { continue; } ?>
                                            <option value="<?php echo site_url('student/index/'.$obj->id); ?>" <?php if(isset($class_id) && $class_id == $obj->id){ echo 'selected="selected"';} ?> ><?php echo $obj->name; ?></option>
                                        <?php }else{ ?>
                                            <option value="<?php echo site_url('student/index/'.$obj->id); ?>" <?php if(isset($class_id) && $class_id == $obj->id){ echo 'selected="selected"';} ?> ><?php echo $obj->name; ?></option>
                                        <?php } ?>
                                    <?php } ?>                                            
                                </select>                                
                            <?php } ?>
                        </li>
                    </ul>
                    <br/>
                    
                    <div class="tab-content">
                        <div  class="tab-pane fade in <?php if(isset($list)){ echo 'active'; }?>" id="tab_student_list" >
                            <div class="x_content">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo lang('sl_no'); ?></th>
                                         <?php if(ci()->session->userdata('role_id') == SUPER_ADMIN){ ?>
                                            <th><?php echo lang('branch'); ?></th>
                                        <?php } ?>
                                        <th><?php echo lang('photo'); ?></th>
                                        <th><?php echo lang('name'); ?></th>
                                        <th><?php echo lang('group'); ?></th>
                                        <th><?php echo lang('class'); ?></th>
                                        <th><?php echo lang('section'); ?></th>
                                        <th><?php echo lang('roll_no'); ?></th>
                                        <th><?php echo lang('email'); ?></th>
                                        <th><?php echo lang('action'); ?></th>                                            
                                    </tr>
                                </thead>
                                <tbody>  
                                    <?php $guardian_student_data = get_guardian_access_data('student'); ?> 
                                    <?php  $count = 1; if(isset($students) && !empty($students)){ ?>
                                        <?php foreach($students as $obj){ ?>
                                        <?php 
                                            if(ci()->session->userdata('role_id') == GUARDIAN){
                                                if (!in_array($obj->id, $guardian_student_data)) { continue; }
                                            }elseif(ci()->session->userdata('role_id') == TEACHER){
                                                if (!in_array($obj->class_id, $teacher_student_data)) { continue; }
                                            }
                                        ?>
                                    <tr style="<?php if($obj->status_type !='regular'){ echo 'background:#f9bfbf; color:#000000;';} ?>">
                                            <td><?php echo $count++; ?></td>
                                            <?php if(ci()->session->userdata('role_id') == SUPER_ADMIN){ ?>
                                                <td><?php echo $obj->branch_name; ?></td>
                                            <?php } ?>
                                            <td>
                                                <?php  if($obj->photo != ''){ ?>
                                                <img src="<?php echo UPLOAD_PATH; ?>student-photo/<?php echo $obj->photo; ?>" alt="" width="70" /> 
                                                <?php }else{ ?>
                                                <img src="<?php echo IMG_URL; ?>default-user.png" alt="" width="70" /> 
                                                <?php } ?>
                                            </td>
                                            <td><?php echo ucfirst($obj->name); ?></td>
                                            <td><?php echo lang($obj->group); ?></td>
                                            <td><?php echo $obj->class_name; ?></td>
                                            <td><?php echo $obj->section; ?></td>
                                            <td><?php echo $obj->roll_no; ?></td>
                                            <td><?php echo $obj->email; ?></td>
                                            <td>
                                                <?php if(has_permission(EDIT, 'student', 'student') && $obj->status_type == 'regular'){ ?>
                                                    <a href="<?php echo site_url('student/edit/'.$obj->id); ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil-square-o"></i> <?php echo lang('edit'); ?> </a>
                                                <?php } ?>
                                               <?php if(has_permission(VIEW, 'student', 'student')){ ?>
                                                        <a href="javascript:void(0);" onclick="get_student_modal(<?php echo $obj->id; ?>);"  data-toggle="modal" data-target=".bs-student-modal-lg" class="btn btn-success btn-xs"><i class="fa fa-eye"></i> <?php echo lang('view'); ?> </a>
                                                    <?php } ?>
                                                <?php if(has_permission(DELETE, 'student', 'student') && $obj->status_type == 'regular'){ ?>
                                                        <br/><a href="<?php echo site_url('student/delete/'.$obj->id); ?>" onclick="javascript: return confirm('<?php echo lang('confirm_alert'); ?>');" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> <?php echo lang('delete'); ?> </a>
                                                <?php } ?>
                                                 <?php if(has_permission(EDIT, 'student', 'student')){ ?>
                                                    <select  class="form-control col-md-7 col-xs-12 status-type"  name="status_type"  id="status_type" onchange="update_status_type('<?php echo $obj->id; ?>', this.value);">
                                                        <option value="regular" <?php echo $obj->status_type == 'regular' ?  'selected="selected"' : ''; ?>><?php echo lang('regular'); ?></option>
                                                        <option value="drop" <?php echo $obj->status_type == 'drop' ?  'selected="selected"' : ''; ?>><?php echo lang('drop'); ?></option>
                                                        <option value="transfer" <?php echo $obj->status_type == 'transfer' ?  'selected="selected"' : ''; ?>><?php echo lang('transfer'); ?></option>
                                                        <option value="passed" <?php echo $obj->status_type == 'passed' ?  'selected="selected"' : ''; ?>><?php echo lang('passed'); ?></option>
                                                    </select>
                                                <?php } ?>    
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                            </div>
                        </div>

                        <div  class="tab-pane fade in <?php if(isset($add)){ echo 'active'; }?>" id="tab_add_student">
                            <div class="x_content"> 
                               <?php echo form_open_multipart(site_url('student/add'), array('name' => 'add', 'id' => 'add', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                
                                <?php ci()->load->view('layout/school_list_form'); ?>
                                
                               <div class="row">                  
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <h5  class="column-title"><strong><?php echo lang('basic_information'); ?>:</strong></h5>
                                    </div>
                                </div>
                                
                                <div class="row">                  
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="name"><?php echo lang('name'); ?> <span class="required">*</span></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="name"  id="name" value="<?php echo isset($post['name']) ?  $post['name'] : ''; ?>" placeholder="<?php echo lang('name'); ?>" required="required" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('name'); ?></div> 
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="admission_no"><?php echo lang('admission_no'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="admission_no"  id="admission_no" value="<?php echo isset($post['admission_no']) ?  $post['admission_no'] : ''; ?>" placeholder="<?php echo lang('admission_no'); ?>" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('admission_no'); ?></div> 
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="admission_date"><?php echo lang('admission_date'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="admission_date"  id="add_admission_date" value="<?php echo isset($post['admission_date']) ?  $post['admission_date'] : ''; ?>" placeholder="<?php echo lang('admission_date'); ?>" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('admission_date'); ?></div> 
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                            <label  for="dob"><?php echo lang('birth_date'); ?> <span class="required">*</span></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="dob"  id="add_dob" value="<?php echo isset($post['dob']) ?  $post['dob'] : ''; ?>" placeholder="<?php echo lang('birth_date'); ?>" required="required" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('dob'); ?></div>
                                         </div>
                                    </div>
                                </div>
                                
                                 <div class="row">                                        
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                             <label for="gender"><?php echo lang('gender'); ?> <span class="required">*</span></label>
                                              <select  class="form-control col-md-7 col-xs-12"  name="gender"  id="gender" required="required">
                                                <option value="">--<?php echo lang('select'); ?>--</option>
                                                <?php $genders = get_genders(); ?>
                                                <?php foreach($genders as $key=>$value){ ?>
                                                    <option value="<?php echo $key; ?>" <?php echo isset($post['gender']) && $post['gender'] == $key ?  'selected="selected"' : ''; ?>><?php echo $value; ?></option>
                                                <?php } ?>
                                            </select>
                                            <div class="help-block"><?php echo form_error('gender'); ?></div>
                                         </div>
                                     </div>                                    
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                             <label for="blood_group"><?php echo lang('blood_group'); ?></label>
                                              <select  class="form-control col-md-7 col-xs-12" name="blood_group" id="blood_group">
                                                <option value="">--<?php echo lang('select'); ?>--</option>
                                                <?php $bloods = get_blood_group(); ?>
                                                <?php foreach($bloods as $key=>$value){ ?>
                                                    <option value="<?php echo $key; ?>" <?php echo isset($post['blood_group']) && $post['blood_group'] == $key ?  'selected="selected"' : ''; ?>><?php echo $value; ?></option>
                                                <?php } ?>
                                                </select>
                                            <div class="help-block"><?php echo form_error('blood_group'); ?></div>
                                         </div>
                                     </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                              <label for="religion"><?php echo lang('religion'); ?></label>
                                              <input  class="form-control col-md-7 col-xs-12"  name="religion"  id="add_religion" value="<?php echo isset($post['religion']) ?  $post['religion'] : ''; ?>" placeholder="<?php echo lang('religion'); ?>" type="text" autocomplete="off">
                                               <div class="help-block"><?php echo form_error('religion'); ?></div>
                                         </div>
                                     </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                              <label for="caste"><?php echo lang('caste'); ?></label>
                                              <input  class="form-control col-md-7 col-xs-12"  name="caste"  id="caste" value="<?php echo isset($post['caste']) ?  $post['caste'] : ''; ?>" placeholder="<?php echo lang('caste'); ?>" type="text" autocomplete="off">
                                               <div class="help-block"><?php echo form_error('caste'); ?></div>
                                         </div>
                                     </div>
                                </div>
                                    
                                <div class="row"> 
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                             <label for="phone"><?php echo lang('phone'); ?> </label>
                                             <input  class="form-control col-md-7 col-xs-12"  name="phone"  id="add_phone" value="<?php echo isset($post['phone']) ?  $post['phone'] : ''; ?>" placeholder="<?php echo lang('phone'); ?>" type="number" autocomplete="off">
                                             <div class="help-block"><?php echo form_error('phone'); ?></div>
                                         </div>
                                     </div>
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                           <label for="email"><?php echo lang('email'); ?> </label>
                                           <input  class="form-control col-md-7 col-xs-12"  name="email"  id="email" value="<?php echo isset($post['email']) ?  $post['email'] : ''; ?>" placeholder="<?php echo lang('email'); ?>" type="email" autocomplete="off">
                                           <div class="help-block"><?php echo form_error('email'); ?></div>
                                        </div>
                                    </div>                                    
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                             <label for="national_id"><?php echo lang('national_id'); ?> </label>
                                             <input  class="form-control col-md-7 col-xs-12"  name="national_id"  id="national_id" value="<?php echo isset($post['national_id']) ?  $post['national_id'] : ''; ?>" placeholder="<?php echo lang('national_id'); ?>" type="text" autocomplete="off">
                                             <div class="help-block"><?php echo form_error('national_id'); ?></div>
                                         </div>
                                     </div>
                                </div>
                                
                                  
                                <div class="row">                  
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <h5  class="column-title"><strong><?php echo lang('academic_information'); ?>:</strong></h5>
                                    </div>
                                </div>
                                
                                <div class="row">  
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                             <label for="type_id"><?php echo lang('student_type'); ?></label>
                                                <select  class="form-control col-md-7 col-xs-12" name="type_id" id="add_type_id">
                                                    <option value="">--<?php echo lang('select'); ?>--</option>
                                                <?php foreach($types as $obj){ ?>
                                                    <option value="<?php echo $obj->id; ?>" <?php echo isset($post['type_id']) && $post['type_id'] == $obj->id ?  'selected="selected"' : ''; ?>><?php echo $obj->type; ?></option>
                                                <?php } ?>
                                                </select>
                                             <div class="help-block"><?php echo form_error('type_id'); ?></div>
                                         </div>
                                     </div>                                    
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="class_id"><?php echo lang('class'); ?> <span class="required">*</span></label>
                                            <select  class="form-control col-md-7 col-xs-12 quick-field" name="class_id" id="add_class_id" required="required" onchange="get_section_by_class(this.value, '');">
                                               <option value="">--<?php echo lang('select'); ?>--</option>
                                               <?php foreach($classes as $obj){ ?>
                                                   <option value="<?php echo $obj->id; ?>" <?php echo isset($post['class_id']) && $post['class_id'] == $obj->id ?  'selected="selected"' : ''; ?>><?php echo $obj->name; ?></option>
                                               <?php } ?>
                                           </select>
                                           <div class="help-block"><?php echo form_error('class_id'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                           <label for="section_id"><?php echo lang('section'); ?> <span class="required">*</span></label>
                                           <select  class="form-control col-md-7 col-xs-12 quick-field" name="section_id" id="add_section_id" required="required">
                                               <option value="">--<?php echo lang('select'); ?>--</option>
                                           </select>
                                           <div class="help-block"><?php echo form_error('section_id'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                            <label for="group"><?php echo lang('group'); ?> </label>
                                            <select  class="form-control col-md-7 col-xs-12" name="group" id="group">
                                                <option value="">--<?php echo lang('select'); ?>--</option>
                                                <?php $groups = get_groups(); ?>
                                                <?php foreach($groups as $key=>$value){ ?>
                                                    <option value="<?php echo $key; ?>" <?php echo isset($post['group']) && $post['group'] == $key ?  'selected="selected"' : ''; ?>><?php echo $value; ?></option>
                                                <?php } ?>
                                            </select>
                                            <div class="help-block"><?php echo form_error('group'); ?></div>
                                         </div>
                                     </div>
                                </div>
                                
                                <div class="row"> 
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                             <label for="roll_no"><?php echo lang('roll_no'); ?> <span class="required">*</span></label>
                                             <input  class="form-control col-md-7 col-xs-12"  name="roll_no"  id="roll_no" value="<?php echo isset($post['roll_no']) ?  $post['roll_no'] : ''; ?>" placeholder="<?php echo lang('roll_no'); ?>" required="required" type="text" autocomplete="off">
                                             <div class="help-block"><?php echo form_error('roll_no'); ?></div>
                                         </div>
                                     </div> 
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                            <label for="registration_no"><?php echo lang('registration_no'); ?></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="registration_no"  id="registration_no" value="<?php echo isset($post['registration_no']) ?  $post['registration_no'] : ''; ?>" placeholder="<?php echo lang('registration_no'); ?>" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('registration_no'); ?></div>
                                         </div>
                                     </div>
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                            <label for="discount_id"><?php echo lang('discount'); ?></label>
                                            <select  class="form-control col-md-7 col-xs-12 quick-field" name="discount_id" id="add_discount_id">
                                                <option value="">--<?php echo lang('select'); ?>--</option>
                                                <?php foreach($discounts as $obj){ ?>                                                    
                                                    <option value="<?php echo $obj->id; ?>"><?php echo $obj->title; ?> [<?php echo $obj->amount; ?>%]</option>                                                   
                                                <?php } ?>
                                            </select>
                                            <div class="help-block"><?php echo form_error('discount_id'); ?></div>
                                         </div>
                                     </div>
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                            <label for="second_language"><?php echo lang('second_language'); ?></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="second_language"  id="second_language" value="<?php echo isset($post['second_language']) ?  $post['second_language'] : ''; ?>" placeholder="<?php echo lang('second_language'); ?>" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('second_language'); ?></div>
                                         </div>
                                     </div>
                                </div>
                                
                               
                                <div class="row">                  
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <h5 class="column-title"><strong><?php echo lang('father_information'); ?>:</strong></h5>
                                    </div>
                                </div> 
                                <div class="row">  
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                            <label for="father_name"><?php echo lang('father_name'); ?></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="father_name"  id="father_name" value="<?php echo isset($post['father_name']) ?  $post['father_name'] : ''; ?>" placeholder="<?php echo lang('father_name'); ?>" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('father_name'); ?></div>
                                         </div>
                                     </div>
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                            <label for="father_phone"><?php echo lang('father_phone'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="father_phone"  id="father_phone" value="<?php echo isset($post['father_phone']) ?  $post['father_phone'] : ''; ?>" placeholder="<?php echo lang('father_phone'); ?>"  type="number" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('father_phone'); ?></div>
                                         </div>
                                     </div>
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                            <label for="father_education"><?php echo lang('father_education'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="father_education"  id="father_education" value="<?php echo isset($post['father_education']) ?  $post['father_education'] : ''; ?>" placeholder="<?php echo lang('father_education'); ?>"  type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('father_education'); ?></div>
                                         </div>
                                     </div>
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                            <label for="father_profession"><?php echo lang('father_profession'); ?></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="father_profession"  id="father_profession" value="<?php echo isset($post['father_profession']) ?  $post['father_profession'] : ''; ?>" placeholder="<?php echo lang('father_profession'); ?>"  type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('father_profession'); ?></div>
                                         </div>
                                     </div>
                                </div>
                                
                                 <div class="row">    
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                            <label for="father_designation"><?php echo lang('father_designation'); ?></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="father_designation"  id="father_designation" value="<?php echo isset($post['father_designation']) ?  $post['father_profession'] : ''; ?>" placeholder="<?php echo lang('father_designation'); ?>"  type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('father_designation'); ?></div>
                                         </div>
                                     </div>
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                            <label ><?php echo lang('father_photo'); ?></label>
                                            <div class="btn btn-default btn-file">
                                                <i class="fa fa-paperclip"></i> <?php echo lang('upload'); ?>
                                                <input  class="form-control col-md-7 col-xs-12"  name="father_photo"  id="father_photo" type="file">
                                            </div>
                                            <div class="text-info"><?php echo lang('valid_file_format_img'); ?></div>
                                            <div class="help-block"><?php echo form_error('father_photo'); ?></div>
                                         </div>
                                     </div>
                                </div>
                                
                                <div class="row">                  
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <h5 class="column-title"><strong><?php echo lang('mother_information'); ?>:</strong></h5>
                                    </div>
                                </div> 
                                <div class="row">  
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                            <label for="mother_name"><?php echo lang('mother_name'); ?></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="mother_name"  id="mother_name" value="<?php echo isset($post['mother_name']) ?  $post['mother_name'] : ''; ?>" placeholder="<?php echo lang('mother_name'); ?>" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('mother_name'); ?></div>
                                         </div>
                                     </div>
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                            <label for="mother_phone"><?php echo lang('mother_phone'); ?></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="mother_phone"  id="mother_phone" value="<?php echo isset($post['mother_phone']) ?  $post['mother_phone'] : ''; ?>" placeholder="<?php echo lang('mother_phone'); ?>"  type="number" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('mother_phone'); ?></div>
                                         </div>
                                     </div>
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                            <label for="mother_education"><?php echo lang('mother_education'); ?></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="mother_education"  id="mother_education" value="<?php echo isset($post['mother_education']) ?  $post['mother_education'] : ''; ?>" placeholder="<?php echo lang('mother_education'); ?>"  type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('mother_education'); ?></div>
                                         </div>
                                     </div>
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                            <label for="mother_profession"><?php echo lang('mother_profession'); ?></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="mother_profession"  id="mother_profession" value="<?php echo isset($post['mother_profession']) ?  $post['mother_profession'] : ''; ?>" placeholder="<?php echo lang('mother_profession'); ?>"  type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('mother_profession'); ?></div>
                                         </div>
                                     </div>
                                </div>
                                
                                 <div class="row">    
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                            <label for="mother_designation"><?php echo lang('mother_designation'); ?></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="mother_designation"  id="mother_designation" value="<?php echo isset($post['mother_designation']) ?  $post['mother_profession'] : ''; ?>" placeholder="<?php echo lang('mother_designation'); ?>"  type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('mother_designation'); ?></div>
                                         </div>
                                     </div>
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                            <label ><?php echo lang('mother_photo'); ?></label>
                                            <div class="btn btn-default btn-file">
                                                <i class="fa fa-paperclip"></i> <?php echo lang('upload'); ?>
                                                <input  class="form-control col-md-7 col-xs-12"  name="mother_photo"  id="mother_photo" type="file">
                                            </div>
                                            <div class="text-info"><?php echo lang('valid_file_format_img'); ?></div>
                                            <div class="help-block"><?php echo form_error('mother_photo'); ?></div>
                                         </div>
                                     </div>
                                </div>
                                
                                <div class="row">                  
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <h5  class="column-title"><strong><?php echo lang('guardian_information'); ?>:</strong></h5>
                                    </div>
                                </div>                                
                                <div class="row"> 
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="is_guardian"><?php echo lang('is_guardian'); ?> <span class="required">*</span></label>
                                            <select  class="form-control col-md-7 col-xs-12 quick-field" name="is_guardian" id="is_guardian" required="required" onchange="check_guardian_type(this.value);">
                                                <option value="">--<?php echo lang('select'); ?>--</option>
                                                <option value="father" <?php echo isset($post['is_guardian']) && $post['is_guardian'] == 'father' ?  'selected="selected"' : ''; ?>><?php echo lang('father'); ?></option>
                                                <option value="mother" <?php echo isset($post['is_guardian']) && $post['is_guardian'] == 'mother' ?  'selected="selected"' : ''; ?>><?php echo lang('mother'); ?></option>
                                                <option value="other" <?php echo isset($post['is_guardian']) && $post['is_guardian'] == 'other' ?  'selected="selected"' : ''; ?>><?php echo lang('other'); ?></option>
                                                <option value="exist_guardian" <?php echo isset($post['is_guardian']) && $post['is_guardian'] == 'exist_guardian' ?  'selected="selected"' : ''; ?>><?php echo lang('guardian_exist'); ?></option>
                                            </select>
                                            <div class="help-block"><?php echo form_error('is_guardian'); ?></div>
                                        </div>
                                    </div>
                                    
                                    <div class="fn_existing_guardian <?php if(isset($post['is_guardian']) && $post['is_guardian'] == 'exist_guardian'){'';}else{ echo 'display'; } ?>">
                                        <div class="col-md-3 col-sm-3 col-xs-12"> 
                                            <div class="item form-group">
                                                <label for="guardian_id"><?php echo lang('guardian'); ?> <span class="required">*</span></label>
                                                <select  class="form-control col-md-7 col-xs-12 quick-field" name="guardian_id" id="add_guardian_id" onchange="get_guardian_by_id(this.value);">
                                                    <option value="">--<?php echo lang('select'); ?>--</option>
                                                    <?php foreach($guardians as $obj){ ?>
                                                        <option value="<?php echo $obj->id; ?>" <?php echo isset($post['guardian_id']) && $post['guardian_id'] == $obj->id ?  'selected="selected"' : ''; ?>><?php echo $obj->name; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <div class="help-block"><?php echo form_error('guardian_id'); ?></div>
                                            </div>
                                        </div>                                  
                                    </div>
                                                                        
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="relation_with"><?php echo lang('relation_with_guardian'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="relation_with"  id="add_relation_with" value="<?php echo isset($post['relation_with']) ?  $post['relation_with'] : ''; ?>" placeholder="<?php echo lang('relation_with_guardian'); ?>" type="text">
                                            <div class="help-block"><?php echo form_error('relation_with'); ?></div>
                                        </div>
                                    </div> 
                                </div> 
                                   
                                
                                <div class="<?php echo isset($post['is_guardian']) && $post['is_guardian'] != 'exist_guardian' ? '' :'display'; ?> fn_except_exist"> 
                                    
                                    <div class="row"> 

                                        <div class="col-md-3 col-sm-3 col-xs-12">
                                            <div class="item form-group">
                                                <label for="gud_name"><?php echo lang('name'); ?> <span class="required">*</span></label>
                                                <input  class="form-control col-md-7 col-xs-12"  name="gud_name"  id="add_gud_name" value="<?php echo isset($post['gud_name']) ?  $post['gud_name'] : ''; ?>" placeholder="<?php echo lang('name'); ?>" required="required" type="text">
                                                <div class="help-block"><?php echo form_error('gud_name'); ?></div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-12">
                                            <div class="item form-group">
                                                <label for="gud_phone"><?php echo lang('phone'); ?> <span class="required">*</span></label>
                                                <input  class="form-control col-md-7 col-xs-12"  name="gud_phone"  id="add_gud_phone" value="<?php echo isset($post['gud_phone']) ?  $post['gud_phone'] : ''; ?>" placeholder="<?php echo lang('phone'); ?>" required="required" type="number">
                                                <div class="help-block"><?php echo form_error('phone'); ?></div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-12">
                                            <div class="item form-group">
                                                <label for="gud_email"><?php echo lang('email'); ?> </label>
                                                <input  class="form-control col-md-7 col-xs-12"  name="gud_email"  id="add_gud_email" value="<?php echo isset($post['gud_email']) ?  $post['gud_email'] : ''; ?>" placeholder="<?php echo lang('email'); ?>"  type="email">
                                                <div class="help-block"><?php echo form_error('gud_email'); ?></div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-12">
                                            <div class="item form-group">
                                                <label for="gud_profession"><?php echo lang('profession'); ?></label>
                                                <input  class="form-control col-md-7 col-xs-12"  name="gud_profession"  id="add_gud_profession" value="<?php echo isset($post['gud_profession']) ?  $post['gud_profession'] : ''; ?>" placeholder="<?php echo lang('profession'); ?>"  type="text">
                                                <div class="help-block"><?php echo form_error('gud_profession'); ?></div>
                                            </div>
                                        </div>  
                                    </div>
                                    
                                    <div class="row">    
                                        <div class="col-md-3 col-sm-3 col-xs-12">
                                            <div class="item form-group">
                                                <label for="gud_religion"><?php echo lang('religion'); ?> </label>
                                                <input  class="form-control col-md-7 col-xs-12"  name="gud_religion"  id="add_gud_religion" value="<?php echo isset($post['gud_religion']) ?  $post['gud_religion'] : ''; ?>" placeholder="<?php echo lang('religion'); ?>" type="text">
                                                <div class="help-block"><?php echo form_error('gud_religion'); ?></div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-12">
                                            <div class="item form-group">
                                                <label for="gud_national_id"><?php echo lang('national_id'); ?></label>
                                                <input  class="form-control col-md-7 col-xs-12"  name="gud_national_id"  id="add_gud_national_id" value="<?php echo isset($post['gud_national_id']) ?  $post['gud_national_id'] : ''; ?>" placeholder="<?php echo lang('national_id'); ?>"  type="text">
                                                <div class="help-block"><?php echo form_error('gud_national_id'); ?></div>
                                            </div>
                                        </div>  
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="item form-group">
                                                <label for="other_info"><?php echo lang('other_info'); ?> </label>
                                                <textarea  class="form-control col-md-7 col-xs-12 textarea-4column"  name="gud_other_info"  id="add_gud_other_info" placeholder="<?php echo lang('other_info'); ?>"><?php echo isset($post['gud_other_info']) ?  $post['gud_other_info'] : ''; ?></textarea>
                                                <div class="help-block"><?php echo form_error('gud_other_info'); ?></div>
                                            </div>
                                        </div>  
                                    </div>
                                    
                                    <div class="row">    
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="item form-group">
                                                <label for="gud_present_address"><?php echo lang('present_address'); ?></label>
                                                <textarea  class="form-control col-md-7 col-xs-12 textarea-4column"  name="gud_present_address"  id="add_gud_present_address" placeholder="<?php echo lang('present_address'); ?>"><?php echo isset($post['gud_present_address']) ?  $post['gud_present_address'] : ''; ?></textarea>
                                                <div class="help-block"><?php echo form_error('gud_present_address'); ?></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="item form-group">
                                                <label for="gud_permanent_address"><?php echo lang('permanent_address'); ?></label>
                                                <textarea  class="form-control col-md-7 col-xs-12 textarea-4column"  name="gud_permanent_address"  id="add_gud_permanent_address" placeholder="<?php echo lang('permanent_address'); ?>"><?php echo isset($post['gud_permanent_address']) ?  $post['gud_permanent_address'] : ''; ?></textarea>
                                                <div class="help-block"><?php echo form_error('gud_permanent_address'); ?></div>
                                            </div>
                                        </div>  
                                    </div>                                
                                    
                                </div>
                                
                                <div class="row">                  
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <h5  class="column-title">
                                            <strong>
                                            <?php echo lang('address_information'); ?>: 
                                            </strong>
                                            <?php echo lang('same_as_guarduan_address'); ?> <input  class=""  name="same_as_guardian"  id="same_as_guardian" value="1"  type="checkbox" <?php echo isset($post['same_as_guardian']) ?  'checked="checked"' : ''; ?>>
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">   
                                     <div class="col-md-6 col-sm-6 col-xs-12">
                                         <div class="item form-group">
                                             <label for="present_address"><?php echo lang('present_address'); ?> </label>
                                              <textarea  class="form-control col-md-7 col-xs-12 textarea-4column"  name="present_address"  id="add_present_address"  placeholder="<?php echo lang('present_address'); ?>"><?php echo isset($post['present_address']) ?  $post['present_address'] : ''; ?></textarea>
                                              <div class="help-block"><?php echo form_error('present_address'); ?></div>
                                         </div>
                                     </div>                                    
                                     <div class="col-md-6 col-sm-6 col-xs-12">
                                         <div class="item form-group">
                                            <label for="permanent_address"><?php echo lang('permanent_address'); ?></label>
                                            <textarea  class="form-control col-md-7 col-xs-12 textarea-4column"  name="permanent_address"  id="add_permanent_address"  placeholder="<?php echo lang('permanent_address'); ?>"><?php echo isset($post['permanent_address']) ?  $post['permanent_address'] : ''; ?></textarea>
                                            <div class="help-block"><?php echo form_error('permanent_address'); ?></div>
                                         </div>
                                     </div>
                                </div>
                           
                                
                                <div class="row">                  
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <h5  class="column-title"><strong><?php echo lang('previous_school'); ?>:</strong></h5>
                                    </div>
                                </div>
                                <div class="row"> 
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                            <label for="previous_school"><?php echo lang('school_name'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="previous_school"  id="previous_school" value="<?php echo isset($post['previous_school']) ?  $post['previous_school'] : ''; ?>" placeholder="<?php echo lang('school_name'); ?>"  type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('previous_school'); ?></div>
                                         </div>
                                     </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                            <label for="previous_class"><?php echo lang('class'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="previous_class"  id="previous_class" value="<?php echo isset($post['previous_class']) ?  $post['previous_class'] : ''; ?>" placeholder="<?php echo lang('previous_class'); ?>"  type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('previous_class'); ?></div>
                                         </div>
                                     </div>
                                    
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                            <label ><?php echo lang('transfer_certificate'); ?> </label>
                                            <div class="btn btn-default btn-file">
                                                <i class="fa fa-paperclip"></i> <?php echo lang('upload'); ?>
                                                <input  class="form-control col-md-7 col-xs-12"  name="transfer_certificate"  id="transfer_certificate" type="file">
                                            </div>
                                            <div class="text-info"><?php echo lang('valid_file_format_img'); ?></div>
                                            <div class="help-block"><?php echo form_error('transfer_certificate'); ?></div>
                                         </div>
                                     </div>                                    
                                </div>                                   
                                
                               <div class="row">                  
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <h5 class="column-title"><strong> <?php echo lang('other_information'); ?>:</strong></h5>
                                    </div>
                                </div>    
                                <div class="row">
                                 
                                 <div class="col-md-3 col-sm-3 col-xs-12">
                                     <div class="item form-group">
                                        <label for="username"><?php echo lang('username'); ?> <span class="required">*</span></label>
                                        <input  class="form-control col-md-7 col-xs-12"  name="username"  id="username" value="<?php echo isset($post['username']) ?  $post['username'] : ''; ?>" placeholder="<?php echo lang('username'); ?>" required="required" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('username'); ?></div>
                                     </div>
                                 </div>
                                 <div class="col-md-3 col-sm-3 col-xs-12">
                                     <div class="item form-group">
                                        <label for="password"><?php echo lang('password'); ?> <span class="required">*</span></label>
                                        <input  class="form-control col-md-7 col-xs-12"  name="password"  id="password" value="<?php echo isset($post['password']) ?  $post['password'] : ''; ?>" placeholder="<?php echo lang('password'); ?>" required="required" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('password'); ?></div>
                                     </div>
                                 </div>
                                 <div class="col-md-3 col-sm-3 col-xs-12">
                                     <div class="item form-group">
                                        <label for="health_condition"><?php echo lang('health_condition'); ?> </label>
                                        <input  class="form-control col-md-7 col-xs-12"  name="health_condition"  id="health_condition" value="<?php echo isset($post['health_condition']) ?  $post['health_condition'] : ''; ?>" placeholder="<?php echo lang('health_condition'); ?>" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('health_condition'); ?></div>
                                     </div>
                                 </div>
                            </div>
                                
                             <div class="row">                                     
                                     <div class="col-md-6 col-sm-6 col-xs-12">
                                         <div class="item form-group">
                                            <label for="other_info"><?php echo lang('other_info'); ?></label> 
                                            <textarea  class="form-control col-md-6 col-xs-12 textarea-4column"  name="other_info"  id="other_info" placeholder="<?php echo lang('other_info'); ?>"><?php echo isset($post['other_info']) ?  $post['other_info'] : ''; ?></textarea>
                                            <div class="help-block"><?php echo form_error('other_info'); ?></div>
                                         </div>
                                     </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label ><?php echo lang('photo'); ?></label>
                                            <div class="btn btn-default btn-file">
                                                <i class="fa fa-paperclip"></i> <?php echo lang('upload'); ?>
                                                <input  class="form-control col-md-7 col-xs-12"  name="photo"  id="photo" type="file">
                                            </div>
                                            <div class="text-info"><?php echo lang('valid_file_format_img'); ?></div>
                                            <div class="help-block"><?php echo form_error('photo'); ?></div>
                                        </div>
                                    </div>
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                         </div>
                                     </div>                                    
                                </div>
                                                                
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <input type="hidden" id="role_id" name="role_id" value="<?php echo STUDENT; ?>" />
                                        <a  href="<?php echo site_url('student/index'); ?>" class="btn btn-primary"><?php echo lang('cancel'); ?></a>
                                        <button id="send" type="submit" class="btn btn-success"><?php echo lang('submit'); ?></button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                                
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="instructions"><strong><?php echo lang('instruction'); ?>: </strong> <?php echo lang('add_student_instruction'); ?></div>
                                </div>
                                
                            </div>
                        </div>  

                        <?php if(isset($edit)){ ?>
                        
                        <div class="tab-pane fade in active" id="tab_edit_student">
                            <div class="x_content"> 
                            <?php echo form_open_multipart(site_url('student/edit/'. $student->id), array('name' => 'edit', 'id' => 'edit', 'class'=>'form-horizontal form-label-left'), ''); ?>
                               
                                <?php ci()->load->view('layout/school_list_edit_form'); ?>
                                
                                <div class="row">                  
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <h5  class="column-title"><strong><?php echo lang('basic_information'); ?>:</strong></h5>
                                    </div>
                                </div>
                                
                                <div class="row">                  
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="name"><?php echo lang('name'); ?> <span class="required">*</span></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="name"  id="name" value="<?php echo isset($student->name) ?  $student->name : ''; ?>" placeholder="<?php echo lang('name'); ?>" required="required" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('name'); ?></div> 
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="admission_no"><?php echo lang('admission_no'); ?></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="admission_no"  id="admission_no" value="<?php echo isset($student->admission_no) ?  $student->admission_no : ''; ?>" placeholder="<?php echo lang('admission_no'); ?>" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('admission_no'); ?></div> 
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="admission_date"><?php echo lang('admission_date'); ?></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="admission_date"  id="edit_admission_date" value="<?php echo isset($student->admission_date) ?   date('d-m-Y', strtotime($student->admission_date)) : ''; ?>" placeholder="<?php echo lang('admission_date'); ?>" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('admission_date'); ?></div> 
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                            <label  for="dob"><?php echo lang('birth_date'); ?> <span class="required">*</span></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="dob"  id="edit_dob" value="<?php echo isset($student->dob) ?  date('d-m-Y', strtotime($student->dob)) : ''; ?>" placeholder="<?php echo lang('birth_date'); ?>" required="required" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('dob'); ?></div>
                                         </div>
                                    </div>
                                 </div>
                                    
                                <div class="row">    
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                             <label for="gender"><?php echo lang('gender'); ?> <span class="required">*</span></label>
                                              <select  class="form-control col-md-7 col-xs-12"  name="gender"  id="gender" required="required">
                                                <option value="">--<?php echo lang('select'); ?>--</option>
                                                <?php $genders = get_genders(); ?>
                                                <?php foreach($genders as $key=>$value){ ?>
                                                    <option value="<?php echo $key; ?>" <?php if($student->gender == $key){ echo 'selected="selected"';} ?>><?php echo $value; ?></option>
                                                <?php } ?>
                                            </select>
                                            <div class="help-block"><?php echo form_error('gender'); ?></div>
                                         </div>
                                     </div>
                                    
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                             <label for="blood_group"><?php echo lang('blood_group'); ?></label>
                                              <select  class="form-control col-md-7 col-xs-12" name="blood_group" id="blood_group">
                                                <option value="">--<?php echo lang('select'); ?>--</option>
                                                <?php $bloods = get_blood_group(); ?>
                                                <?php foreach($bloods as $key=>$value){ ?>
                                                    <option value="<?php echo $key; ?>" <?php if($student->blood_group == $key){ echo 'selected="selected"';} ?>><?php echo $value; ?></option>
                                                <?php } ?>
                                                </select>
                                            <div class="help-block"><?php echo form_error('blood_group'); ?></div>
                                         </div>
                                     </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                              <label for="religion"><?php echo lang('religion'); ?></label>
                                              <input  class="form-control col-md-7 col-xs-12"  name="religion"  id="add_religion" value="<?php echo isset($student->religion) ?  $student->religion : ''; ?>" placeholder="<?php echo lang('religion'); ?>" type="text" autocomplete="off">
                                               <div class="help-block"><?php echo form_error('religion'); ?></div>
                                         </div>
                                     </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                              <label for="caste"><?php echo lang('caste'); ?></label>
                                              <input  class="form-control col-md-7 col-xs-12"  name="caste"  id="caste" value="<?php echo isset($student->caste) ?  $student->caste : ''; ?>" placeholder="<?php echo lang('caste'); ?>" type="text" autocomplete="off">
                                               <div class="help-block"><?php echo form_error('caste'); ?></div>
                                         </div>
                                     </div>
                                </div>
                                
                                <div class="row"> 
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                             <label for="phone"><?php echo lang('phone'); ?></label>
                                             <input  class="form-control col-md-7 col-xs-12"  name="phone"  id="add_phone" value="<?php echo isset($student->phone) ?  $student->phone : ''; ?>" placeholder="<?php echo lang('phone'); ?>" type="number" autocomplete="off">
                                             <div class="help-block"><?php echo form_error('phone'); ?></div>
                                         </div>
                                     </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                            <label for="email"><?php echo lang('email'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="email"   id="email" value="<?php echo isset($student->email) ?  $student->email : ''; ?>" placeholder="<?php echo lang('email'); ?>" type="email" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('email'); ?></div>
                                         </div>
                                     </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                             <label for="national_id"><?php echo lang('national_id'); ?> </label>
                                             <input  class="form-control col-md-7 col-xs-12"  name="national_id"  id="national_id" value="<?php echo isset($student->national_id) ?  $student->national_id : ''; ?>" placeholder="<?php echo lang('national_id'); ?>" type="text" autocomplete="off">
                                             <div class="help-block"><?php echo form_error('national_id'); ?></div>
                                         </div>
                                     </div>                                    
                                </div>
                                
                                <div class="row">                  
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <h5  class="column-title"><strong><?php echo lang('academic_information'); ?>:</strong></h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                             <label for="type_id"><?php echo lang('student_type'); ?></label>
                                                <select  class="form-control col-md-7 col-xs-12" name="type_id" id="edit_type_id">
                                                <option value="">--<?php echo lang('select'); ?>--</option>
                                                <?php foreach($types as $obj){ ?>
                                                    <option value="<?php echo $obj->id; ?>" <?php echo isset($student) && $student->type_id == $obj->id ?  'selected="selected"' : ''; ?>><?php echo $obj->type; ?></option>
                                                <?php } ?>
                                                </select>
                                             <div class="help-block"><?php echo form_error('type_id'); ?></div>
                                         </div>
                                     </div>
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                            <label for="class_id"><?php echo lang('class'); ?> <span class="required">*</span></label>
                                            <select  class="form-control col-md-7 col-xs-12 quick-field" name="class_id" id="edit_class_id" required="required"  onchange="get_section_by_class(this.value, '');">
                                                <option value="">--<?php echo lang('select'); ?>--</option>
                                                <?php foreach($classes as $obj){ ?>
                                                    <option value="<?php echo $obj->id; ?>" <?php if($student->class_id == $obj->id){ echo 'selected="selected"';} ?>><?php echo $obj->name; ?></option>
                                                <?php } ?>
                                            </select>
                                            <div class="help-block"><?php echo form_error('class_id'); ?></div>
                                         </div>
                                     </div>
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                            <label for="section_id"><?php echo lang('section'); ?> <span class="required">*</span></label>
                                            <select  class="form-control col-md-7 col-xs-12 quick-field" name="section_id" id="edit_section_id" required="required">
                                                <option value="">--<?php echo lang('select'); ?>--</option>
                                            </select>
                                            <div class="help-block"><?php echo form_error('section_id'); ?></div>
                                         </div>
                                     </div>
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                            <label for="group"><?php echo lang('group'); ?> </label>
                                            <select  class="form-control col-md-7 col-xs-12" name="group" id="group">
                                                <option value="">--<?php echo lang('select'); ?>--</option>
                                                <?php $groups = get_groups(); ?>
                                                <?php foreach($groups as $key=>$value){ ?>
                                                    <option value="<?php echo $key; ?>" <?php if($student->group == $key){ echo 'selected="selected"';} ?>><?php echo $value; ?></option>
                                                <?php } ?>
                                            </select>
                                            <div class="help-block"><?php echo form_error('group'); ?></div>
                                         </div>
                                     </div>                                     
                                </div>
                                    
                                <div class="row"> 
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                             <label for="roll_no"><?php echo lang('roll_no'); ?> <span class="required">*</span></label>
                                             <input  class="form-control col-md-7 col-xs-12"  name="roll_no"  id="roll_no"  value="<?php echo isset($student->roll_no) ?  $student->roll_no : ''; ?>" placeholder="<?php echo lang('roll_no'); ?>" required="required" type="text" autocomplete="off">
                                             <div class="help-block"><?php echo form_error('roll_no'); ?></div>
                                         </div>
                                     </div>
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                            <label for="registration_no"><?php echo lang('registration_no'); ?></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="registration_no"  id="registration_no" value="<?php echo isset($student->registration_no) ?  $student->registration_no : ''; ?>" placeholder="<?php echo lang('registration_no'); ?>" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('registration_no'); ?></div>
                                         </div>
                                     </div>                                     
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                            <label for="discount_id"><?php echo lang('discount'); ?></label>
                                            <select  class="form-control col-md-7 col-xs-12 quick-field" name="discount_id" id="edit_discount_id">
                                                <option value="">--<?php echo lang('select'); ?>--</option>
                                                <?php foreach($discounts as $obj){ ?>                                                    
                                                    <option value="<?php echo $obj->id; ?>" <?php if($student->discount_id == $obj->id){ echo 'selected="selected"';} ?>><?php echo $obj->title; ?> [<?php echo $obj->amount; ?>%]</option>                                                   
                                                <?php } ?>
                                            </select>
                                            <div class="help-block"><?php echo form_error('discount_id'); ?></div>
                                         </div>
                                     </div>
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                            <label for="second_language"><?php echo lang('second_language'); ?></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="second_language"  id="second_language" value="<?php echo isset($student->second_language) ?  $student->second_language : ''; ?>" placeholder="<?php echo lang('second_language'); ?>" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('second_language'); ?></div>
                                         </div>
                                     </div>
                                </div>
                                                                  
                                <div class="row">                  
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <h5 class="column-title"><strong><?php echo lang('father_information'); ?>:</strong></h5>
                                    </div>
                                </div> 
                                <div class="row">  
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                            <label for="father_name"><?php echo lang('father_name'); ?></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="father_name"  id="father_name" value="<?php echo isset($student->father_name) ?  $student->father_name : ''; ?>" placeholder="<?php echo lang('father_name'); ?>" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('father_name'); ?></div>
                                         </div>
                                     </div>
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                            <label for="father_phone"><?php echo lang('father_phone'); ?></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="father_phone"  id="father_phone" value="<?php echo isset($student->father_phone) ?  $student->father_phone : ''; ?>" placeholder="<?php echo lang('father_phone'); ?>"  type="number" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('father_phone'); ?></div>
                                         </div>
                                     </div>
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                            <label for="father_education"><?php echo lang('father_education'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="father_education"  id="father_education" value="<?php echo isset($student->father_education) ?  $student->father_education : ''; ?>" placeholder="<?php echo lang('father_education'); ?>"  type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('father_education'); ?></div>
                                         </div>
                                     </div>
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                            <label for="father_profession"><?php echo lang('father_profession'); ?></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="father_profession"  id="father_profession" value="<?php echo isset($student->father_profession) ?  $student->father_profession : ''; ?>" placeholder="<?php echo lang('father_profession'); ?>"  type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('father_profession'); ?></div>
                                         </div>
                                     </div>
                                </div>
                                
                                 <div class="row">    
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                            <label for="father_designation"><?php echo lang('father_designation'); ?></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="father_designation"  id="father_designation" value="<?php echo isset($student->father_designation) ?  $student->father_designation : ''; ?>" placeholder="<?php echo lang('father_designation'); ?>"  type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('father_designation'); ?></div>
                                         </div>
                                     </div>
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                            <label ><?php echo lang('father_photo'); ?></label>
                                            <div class="btn btn-default btn-file">
                                                <i class="fa fa-paperclip"></i> <?php echo lang('upload'); ?>
                                                <input  class="form-control col-md-7 col-xs-12"  name="father_photo"  id="father_photo" type="file">
                                            </div>
                                            <div class="text-info"><?php echo lang('valid_file_format_img'); ?></div>
                                            <div class="help-block"><?php echo form_error('father_photo'); ?></div>
                                         </div>
                                     </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                             <input type="hidden" name="prev_father_photo" id="prev_father_photo" value="<?php echo $student->father_photo; ?>" />
                                            <?php if($student->father_photo){ ?>
                                            <img src="<?php echo UPLOAD_PATH; ?>father-photo/<?php echo $student->father_photo; ?>" alt="" width="70" /><br/><br/>
                                            <?php } ?>
                                         </div>
                                     </div> 
                                </div>
                                
                                <div class="row">                  
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <h5 class="column-title"><strong><?php echo lang('mother_information'); ?>:</strong></h5>
                                    </div>
                                </div> 
                                <div class="row">  
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                            <label for="mother_name"><?php echo lang('mother_name'); ?></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="mother_name"  id="mother_name" value="<?php echo isset($student->mother_name) ?  $student->mother_name : ''; ?>" placeholder="<?php echo lang('mother_name'); ?>" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('mother_name'); ?></div>
                                         </div>
                                     </div>
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                            <label for="mother_phone"><?php echo lang('mother_phone'); ?></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="mother_phone"  id="mother_phone" value="<?php echo isset($student->mother_phone) ?  $student->mother_phone : ''; ?>" placeholder="<?php echo lang('mother_phone'); ?>"  type="number" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('mother_phone'); ?></div>
                                         </div>
                                     </div>
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                            <label for="mother_education"><?php echo lang('mother_education'); ?></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="mother_education"  id="mother_education" value="<?php echo isset($student->mother_education) ?  $student->mother_education : ''; ?>" placeholder="<?php echo lang('mother_education'); ?>"  type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('mother_education'); ?></div>
                                         </div>
                                     </div>
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                            <label for="mother_profession"><?php echo lang('mother_profession'); ?></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="mother_profession"  id="mother_profession" value="<?php echo isset($student->mother_profession) ?  $student->mother_profession : ''; ?>" placeholder="<?php echo lang('mother_profession'); ?>"  type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('mother_profession'); ?></div>
                                         </div>
                                     </div>
                                </div>
                                
                                 <div class="row">    
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                            <label for="mother_designation"><?php echo lang('mother_designation'); ?></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="mother_designation"  id="mother_designation" value="<?php echo isset($student->mother_designation) ?  $student->mother_designation : ''; ?>" placeholder="<?php echo lang('mother_designation'); ?>"  type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('mother_designation'); ?></div>
                                         </div>
                                     </div>
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                            <label ><?php echo lang('mother_photo'); ?></label>
                                            <div class="btn btn-default btn-file">
                                                <i class="fa fa-paperclip"></i> <?php echo lang('upload'); ?>
                                                <input  class="form-control col-md-7 col-xs-12"  name="mother_photo"  id="mother_photo" type="file">
                                            </div>
                                            <div class="text-info"><?php echo lang('valid_file_format_img'); ?></div>
                                            <div class="help-block"><?php echo form_error('mother_photo'); ?></div>
                                         </div>
                                     </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                             <input type="hidden" name="prev_mother_photo" id="prev_mother_photo" value="<?php echo $student->mother_photo; ?>" />
                                            <?php if($student->mother_photo){ ?>
                                            <img src="<?php echo UPLOAD_PATH; ?>mother-photo/<?php echo $student->mother_photo; ?>" alt="" width="70" /><br/><br/>
                                            <?php } ?>
                                         </div>
                                     </div>
                                </div>
                                
                                
                                <div class="row">                  
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <h5  class="column-title"><strong><?php echo lang('guardian_information'); ?>:</strong></h5>
                                    </div>
                                </div>
                                                               
                                <div class="row"> 
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="guardian_id"><?php echo lang('guardian_name'); ?> <span class="required">*</span></label>
                                            <select  class="form-control col-md-7 col-xs-12 quick-field" name="guardian_id" id="edit_guardian_id" required="required">
                                                <option value="">--<?php echo lang('select'); ?>--</option>
                                                <?php foreach($guardians as $obj){ ?>
                                                    <option value="<?php echo $obj->id; ?>" <?php if($student->guardian_id == $obj->id){ echo 'selected="selected"';} ?>><?php echo $obj->name; ?></option>
                                                <?php } ?>
                                            </select>
                                            <div class="help-block"><?php echo form_error('guardian_id'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="relation_with"><?php echo lang('relation_with_guardian'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="relation_with"  id="relation_with" value="<?php echo isset($student->relation_with) ?  $student->relation_with : ''; ?>" placeholder="<?php echo lang('relation_with_guardian'); ?>"  type="text">
                                            <div class="help-block"><?php echo form_error('relation_with'); ?></div>
                                        </div>
                                    </div>                                       
                                </div>
                                
                                
                                <div class="row">                  
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <h5  class="column-title"><strong><?php echo lang('address_information'); ?>:</strong></h5>
                                    </div>
                                </div>
                                <div class="row">    
                                     <div class="col-md-6 col-sm-6 col-xs-12">
                                         <div class="item form-group">
                                             <label for="present_address"><?php echo lang('present_address'); ?></label>
                                              <textarea  class="form-control col-md-7 col-xs-12 textarea-4column"  name="present_address"  id="add_present_address"  placeholder="<?php echo lang('present_address'); ?>"><?php echo isset($student->present_address) ?  $student->present_address : ''; ?></textarea>
                                              <div class="help-block"><?php echo form_error('present_address'); ?></div>
                                         </div>
                                     </div>                                    
                                     <div class="col-md-6 col-sm-6 col-xs-12">
                                         <div class="item form-group">
                                            <label for="permanent_address"><?php echo lang('permanent_address'); ?></label>
                                            <textarea  class="form-control col-md-7 col-xs-12 textarea-4column"  name="permanent_address"  id="add_permanent_address"  placeholder="<?php echo lang('permanent_address'); ?>"><?php echo isset($student->permanent_address) ?  $student->permanent_address : ''; ?></textarea>
                                            <div class="help-block"><?php echo form_error('permanent_address'); ?></div>
                                         </div>
                                     </div>
                                </div>
                                                                
                              
                                
                                <div class="row">                  
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <h5  class="column-title"><strong><?php echo lang('previous_school'); ?>:</strong></h5>
                                    </div>
                                </div>
                                <div class="row">                 
                                    
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                            <label for="previous_school"><?php echo lang('branch_name'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="previous_school"  id="previous_school" value="<?php echo isset($student->previous_school) ?  $student->previous_school : ''; ?>" placeholder="<?php echo lang('branch_name'); ?>"  type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('previous_school'); ?></div>
                                         </div>
                                     </div>                                    
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                            <label for="previous_class"><?php echo lang('previous_class'); ?></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="previous_class"  id="previous_class" value="<?php echo isset($student->previous_class) ?  $student->previous_class : ''; ?>" placeholder="<?php echo lang('previous_class'); ?>"  type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('previous_class'); ?></div>
                                         </div>
                                     </div>                                   
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                            <label ><?php echo lang('transfer_certificate'); ?></label>
                                            <div class="btn btn-default btn-file">
                                                <i class="fa fa-paperclip"></i> <?php echo lang('upload'); ?>
                                                <input  class="form-control col-md-7 col-xs-12"  name="transfer_certificate"  id="transfer_certificate" type="file">
                                            </div>
                                            <div class="text-info"><?php echo lang('valid_file_format_img'); ?></div>
                                            <div class="help-block"><?php echo form_error('transfer_certificate'); ?></div>
                                         </div>
                                     </div>
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                             <input type="hidden" name="prev_transfer_certificate" id="prev_transfer_certificate" value="<?php echo $student->transfer_certificate; ?>" />
                                            <?php if($student->transfer_certificate){ ?>
                                            <img src="<?php echo UPLOAD_PATH; ?>transfer-certificate/<?php echo $student->transfer_certificate; ?>" alt="" width="70" /><br/><br/>
                                            <?php } ?>
                                         </div>
                                     </div>                                    
                                </div>
                              
                                                                
                               <div class="row">                  
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <h5 class="column-title"><strong><?php echo lang('other_information'); ?>:</strong></h5>
                                    </div>
                                </div>    
                                <div class="row">                  
                                                                         
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                            <label for="username"><?php echo lang('username'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="username"  id="username" readonly="readonly" value="<?php echo isset($student->username) ?  $student->username : ''; ?>" placeholder="<?php echo lang('username'); ?>" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('username'); ?></div>
                                         </div>
                                     </div>
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                            <label for="health_condition"><?php echo lang('health_condition'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="health_condition"  id="health_condition" value="<?php echo isset($student->health_condition) ?  $student->health_condition : ''; ?>" placeholder="<?php echo lang('health_condition'); ?>" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('health_condition'); ?></div>
                                         </div>
                                     </div>
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                            <label for="status_type"><?php echo lang('status'); ?> </label>
                                            <select  class="form-control col-md-7 col-xs-12"  name="status_type"  id="status_type">
                                                <option value="regular" <?php echo $student->status_type == 'regular' ?  'selected="selected"' : ''; ?>><?php echo lang('regular'); ?></option>
                                                <option value="drop" <?php echo $student->status_type == 'drop' ?  'selected="selected"' : ''; ?>><?php echo lang('drop'); ?></option>
                                                <option value="transfer" <?php echo $student->status_type == 'transfer' ?  'selected="selected"' : ''; ?>><?php echo lang('transfer'); ?></option>
                                                <option value="passed" <?php echo $student->status_type == 'passed' ?  'selected="selected"' : ''; ?>><?php echo lang('passed'); ?></option>
                                            </select>
                                            <div class="help-block"><?php echo form_error('status_type'); ?></div>
                                         </div>
                                     </div>
                                </div>
                                <div class="row">     
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="item form-group">
                                           <label for="other_info"><?php echo lang('other_info'); ?></label> 
                                           <textarea  class="form-control col-md-6 col-xs-12 textarea-4column"  name="other_info"  id="other_info" placeholder="<?php echo lang('other_info'); ?>"><?php echo isset($student->other_info) ?  $student->other_info : ''; ?></textarea>
                                           <div class="help-block"><?php echo form_error('other_info'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label ><?php echo lang('photo'); ?></label>
                                            <div class="btn btn-default btn-file">
                                                <i class="fa fa-paperclip"></i> <?php echo lang('upload'); ?>
                                                <input  class="form-control col-md-7 col-xs-12"  name="photo"  id="photo" type="file">
                                            </div>
                                            <div class="text-info"><?php echo lang('valid_file_format_img'); ?></div>
                                            <div class="help-block"><?php echo form_error('photo'); ?></div>
                                        </div>
                                    </div>
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                             <input type="hidden" name="prev_photo" id="prev_photo" value="<?php echo $student->photo; ?>" />
                                            <?php if($student->photo){ ?>
                                            <img src="<?php echo UPLOAD_PATH; ?>student-photo/<?php echo $student->photo; ?>" alt="" width="70" /><br/><br/>
                                            <?php } ?>
                                         </div>
                                     </div>                                    
                                </div>
                                                                
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <input type="hidden" name="id" id="id" value="<?php echo $student->id; ?>" />
                                        <a href="<?php echo site_url('student/index'); ?>" class="btn btn-primary"><?php echo lang('cancel'); ?></a>
                                        <button id="send" type="submit" class="btn btn-success"><?php echo lang('update'); ?></button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div> 
                        <?php } ?>
                        
                         <?php if(isset($detail)){ ?>
                             <div class="tab-pane fade in active" id="tab_view_student">
                                <div class="x_content"> 
                                  <?php ci()->load->view('get-single-student'); ?>
                                </div>
                             </div>
                        <?php } ?>
                        
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php ci()->load->view('accounting/invoice/invoice-modal'); ?>  

<div class="modal fade bs-student-modal-lg no-print" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content no-print">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title"><?php echo lang('detail_information'); ?></h4>
        </div>
        <div class="modal-body fn_student_data"></div>       
      </div>
    </div>
</div>
<script type="text/javascript">
         
    function get_student_modal(student_id){
         
        $('.fn_student_data').html('<p style="padding: 20px;"><p style="padding: 20px;text-align:center;"><img src="<?php echo IMG_URL; ?>loading.gif" /></p>');
        $.ajax({       
          type   : "POST",
          url    : "<?php echo site_url('student/get_single_student'); ?>",
          data   : {student_id : student_id},  
          success: function(response){                                                   
             if(response)
             {
                $('.fn_student_data').html(response);
             }
          }
       });
    }
</script>


<div class="modal fade bs-activity-modal-lg no-print" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title"><?php echo lang('detail_information'); ?></h4>
        </div>
        <div class="modal-body fn_activity_data"></div>       
      </div>
    </div>
</div>
<script type="text/javascript">
         
    function get_activity_modal(activity_id){
         
        $('.fn_activity_data').html('<p style="padding: 20px;"><p style="padding: 20px;text-align:center;"><img src="<?php echo IMG_URL; ?>loading.gif" /></p>');
        $.ajax({       
          type   : "POST",
          url    : "<?php echo site_url('student/activity/get_single_activity'); ?>",
          data   : {activity_id : activity_id},  
          success: function(response){                                                   
             if(response)
             {
                $('.fn_activity_data').html(response);
             }
          }
       });
    }
</script>


<!-- bootstrap-datetimepicker -->
<link href="<?php echo VENDOR_URL; ?>datepicker/datepicker.css" rel="stylesheet">
<script src="<?php echo VENDOR_URL; ?>datepicker/datepicker.js"></script>

 
<!-- Super admin js START  -->
 <script type="text/javascript">
     
    var edit = false;
         
    $("document").ready(function() {
        <?php if(isset($student) && !empty($student)){ ?>
            $("#edit_branch_id").trigger('change'); 
        <?php } ?>
        <?php if(isset($post) && !empty($post)){ ?>
             $("#add_branch_id").trigger('change');  
         <?php } ?>
    });
    
     <?php if(isset($student) && !empty($student)){ ?>
          edit = true; 
     <?php } ?>
         
    $('.fn_branch_id').on('change', function(){
      
        var branch_id = $(this).val();        
        var class_id = '';
        var guardian_id = '';       
        var discount_id = ''; 
        var type_id = ''; 
        
        <?php if(isset($edit) && !empty($edit)){ ?>
                class_id =  '<?php echo $student->class_id; ?>';
                guardian_id =  '<?php echo $student->guardian_id; ?>';
                discount_id =  '<?php echo $student->discount_id; ?>';
                type_id =  '<?php echo $student->type_id; ?>';
                
        <?php } ?>         
        <?php if(isset($post) && !empty($post)){ ?>
                class_id =  '<?php echo $post['class_id']; ?>';
                guardian_id =  '<?php echo $post['guardian_id']; ?>';
                discount_id =  '<?php echo $post['discount_id']; ?>';
                type_id =  '<?php echo $post['type_id']; ?>';
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
                   if(edit){
                       $('#edit_class_id').html(response);   
                   }else{
                       $('#add_class_id').html(response);   
                   }
                                    
                   get_guardian_by_school(branch_id, guardian_id);
                   get_discount_by_school(branch_id, discount_id);
                   get_student_type_by_school(type_id);
               }
            }
        });
    }); 
    
    
    function get_guardian_by_school(branch_id, guardian_id){
    
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_guardian_by_school'); ?>",
            data   : { branch_id:branch_id, guardian_id: guardian_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {    
                   if(edit){
                       $('#edit_guardian_id').html(response);
                   }else{
                       $('#add_guardian_id').html(response); 
                   }
               }
            }
        });
    }
        
    function get_discount_by_school(branch_id, discount_id){
    
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_discount_by_school'); ?>",
            data   : { branch_id:branch_id, discount_id: discount_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {    
                   if(edit){
                       $('#edit_discount_id').html(response);
                   }else{
                       $('#add_discount_id').html(response); 
                   }
               }
            }
        });
    }
    
    function get_student_type_by_school(type_id){
    
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_student_type_by_school'); ?>",
            data   : { type_id: type_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {    
                   if(edit){
                       $('#edit_type_id').html(response);
                   }else{
                       $('#add_type_id').html(response); 
                   }
               }
            }
        });
    }
    
    var currentDate = new Date(); 
    $('#add_admission_date').datepicker({endDate: "currentDate", maxDate: currentDate });
    $('#edit_admission_date').datepicker({endDate: "currentDate", maxDate: currentDate });
    $('#add_dob').datepicker({ startView: 2, endDate: "currentDate", maxDate: currentDate });
    $('#edit_dob').datepicker({ startView: 2, endDate: "currentDate", maxDate: currentDate });
  
    <?php if(isset($edit)){ ?>
        get_section_by_class('<?php echo $student->class_id; ?>', '<?php echo $student->section_id; ?>');
    <?php } ?>
        
    <?php if(isset($post) && !empty($post)){ ?>
        get_section_by_class('<?php echo $post['class_id']; ?>', '<?php echo $post['section_id']; ?>');
    <?php } ?>
    
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
            data   : { branch_id:branch_id, class_id : class_id , section_id: section_id},               
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
  
  <!-- datatable with buttons -->
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
        
        
      
        function check_guardian_type(guardian_type){
           
            $('#add_relation_with').val('');  
            $('#add_gud_name').val('');  
            $('#add_gud_phone').val('');  
            $('#add_gud_present_address').val('');  
            $('#add_gud_permanent_address').val('');  
            $('#add_gud_religion').val(''); 
            $('#add_gud_profession').val(''); 
            $('#add_gud_national_id').val(''); 
            $('#add_gud_email').val(''); 
            $('#add_gud_other_info').val(''); 
                    
           if(guardian_type == 'father'){
               
               $('#add_relation_with').val('<?php echo lang('father'); ?>'); 
               $('.fn_existing_guardian').hide();
               $('.fn_except_exist').show();
               $('#guardian_id').prop('required', false);               
               $('#add_gud_name').prop('required', true);               
               $('#add_gud_phone').prop('required', true);               
               $('#add_gud_email').prop('required', true);               
               
               var f_name = $('#add_father_name').val();
               var f_phone = $('#add_father_phone').val(); 
               var f_education = $('#add_father_education').val(); 
               var f_profession = $('#add_father_profession').val(); 
               var f_designation = $('#add_father_designation').val(); 
               
               $('#add_gud_name').val(f_name);  
               $('#add_gud_phone').val(f_phone); 
               $('#add_gud_profession').val(f_profession); 
               
           }else if(guardian_type == 'mother'){
               
               $('#add_relation_with').val('<?php echo lang('mother'); ?>');   
               $('.fn_existing_guardian').hide();
               $('.fn_except_exist').show();
               $('#guardian_id').prop('required', false);
               $('#add_gud_name').prop('required', true);               
               $('#add_gud_phone').prop('required', true);               
               $('#add_gud_email').prop('required', true); 
               
               var m_name = $('#add_mother_name').val();
               var m_phone = $('#add_mother_phone').val(); 
               var m_education = $('#add_mother_education').val(); 
               var m_profession = $('#add_mother_profession').val(); 
               var m_designation = $('#add_mother_designation').val(); 
               
               $('#add_gud_name').val(m_name);  
               $('#add_gud_phone').val(m_phone); 
               $('#add_gud_profession').val(m_profession); 
               
           }else if(guardian_type == 'other'){
               $('#add_relation_with').val('<?php echo lang('other'); ?>');    
               $('.fn_existing_guardian').hide();
               $('.fn_except_exist').show();
               $('#guardian_id').prop('required', false);
               $('#add_gud_name').prop('required', true);               
               $('#add_gud_phone').prop('required', true);               
               $('#add_gud_email').prop('required', true); 
                              
           }else if(guardian_type == 'exist_guardian'){
               $('.fn_existing_guardian').show();
               $('.fn_except_exist').hide();
               $('#guardian_id').prop('required', true);   
               $('#add_gud_name').prop('required', false);               
               $('#add_gud_phone').prop('required', false);               
               $('#add_gud_email').prop('required', false); 
               
           }else{
                $('#add_relation_with').val('');   
                $('.fn_existing_guardian').hide();
                $('.fn_except_exist').show();
                $('#guardian_id').prop('required', false);
                $('#add_gud_name').prop('required', true);               
                $('#add_gud_phone').prop('required', true);               
                $('#add_gud_email').prop('required', true); 
           }
        
        }
        
        function get_guardian_by_id(guardian_id){                       
            
            $.ajax({       
            type   : "POST",
            dataType: "json",
            url    : "<?php echo site_url('ajax/get_guardian_by_id'); ?>",
            data   : { guardian_id : guardian_id},               
            async  : true,
            success: function(response){ 
               if(response)
               {
                    $('#add_gud_name').val(response.name);  
                    $('#add_gud_phone').val(response.phone);  
                    $('#add_gud_present_address').val(response.present_address);  
                    $('#add_gud_permanent_address').val(response.permanent_address);  
                    $('#add_gud_religion').val(response.religion);  
                    $('#add_gud_profession').val(response.profession);  
                    $('#add_gud_national_id').val(response.national_id);  
                    $('#add_gud_email').val(response.email);  
                    $('#add_gud_other_info').val(response.other_info);  
               }
               else
               {
                    $('#add_relation_with').val('');  
                    $('#add_gud_name').val('');  
                    $('#add_gud_phone').val('');  
                    $('#add_gud_present_address').val('');  
                    $('#add_gud_permanent_address').val('');  
                    $('#add_gud_religion').val(''); 
                    $('#add_gud_profession').val(''); 
                    $('#add_gud_national_id').val(''); 
                    $('#add_gud_email').val(''); 
                    $('#add_gud_other_info').val(''); 
               }
            }
        });  
        
        }
        
             
    $('#same_as_guardian').on('click', function(){
        
        if($(this).is(":checked")) {
            var present =  $('#add_gud_present_address').val();  
            var permanent = $('#add_gud_permanent_address').val();  
            $('#add_present_address').val(present);  
            $('#add_permanent_address').val(permanent);  
        }else{
             $('#add_present_address').val('');  
             $('#add_permanent_address').val(''); 
        }
    });
        
        
     /* Menu Filter Start */   
    function get_student_by_class(url){          
        if(url){
            window.location.href = url; 
        }
    }         
       
        
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
    
    function update_status_type(student_id, status){
        
        
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/update_student_status_type'); ?>",
            data   : { student_id : student_id, status : status},               
            async  : false,
            success: function(response){                                                   
               if(response)
               { 
                   toastr.success('<?php echo lang('update_success'); ?>');
                   location.reload();
                   return false;                    
               }
            }
        });
    }    
             
    $("#add").validate();     
    $("#edit").validate();   
    
</script>

 