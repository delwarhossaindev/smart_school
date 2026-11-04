<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-users"></i><small> <?php echo lang('manage_online_admission'); ?></small></h3>
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
                        <li class="<?php if(isset($list)){ echo 'active'; }?>"><a href="#tab_admission_list"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-list-ol"></i> <?php echo lang('list'); ?></a> </li>
                        <?php if(isset($edit)){ ?>
                            <li  class="active"><a href="#tab_edit_admission"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-pencil-square-o"></i> <?php echo lang('approve'); ?></a> </li>                          
                        <?php } ?>  
                            
                        <li class="li-class-list">
                            <?php if(ci()->session->userdata('role_id') != SUPER_ADMIN){  ?> 
                                <select  class="form-control col-md-7 col-xs-12" onchange="get_student_by_class(this.value);">
                                    <?php if(ci()->session->userdata('role_id') != STUDENT){ ?>    
                                        <option value="<?php echo site_url('student/admission/index'); ?>">--<?php echo lang('select'); ?>--</option> 
                                    <?php } ?>
                                    <?php foreach($classes as $obj ){ ?>
                                        <?php if(ci()->session->userdata('role_id') == STUDENT && ci()->session->userdata('class_id') == $obj->id){ ?>
                                            <option value="<?php echo site_url('student/admission/index/'.$obj->id); ?>" <?php if(isset($class_id) && $class_id == $obj->id){ echo 'selected="selected"';} ?> ><?php echo $obj->name; ?></option>
                                        <?php }elseif(ci()->session->userdata('role_id') != STUDENT){ ?>
                                            <option value="<?php echo site_url('student/admission/index/'.$obj->id); ?>" <?php if(isset($class_id) && $class_id == $obj->id){ echo 'selected="selected"';} ?> ><?php echo $obj->name; ?></option>
                                        <?php } ?>
                                    <?php } ?>                                            
                                </select>
                            <?php }else{ ?> 
                            
                                <?php echo form_open(site_url('student/admission/index'), array('name' => 'filter', 'id' => 'filter', 'class'=>'form-horizontal form-label-left'), ''); ?>
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
                            
                            <?php } ?>
                        </li>    
                    </ul>
                    <br/>
                    
                    <div class="tab-content">
                        <div  class="tab-pane fade in <?php if(isset($list)){ echo 'active'; }?>" id="tab_admission_list" >
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
                                        <th><?php echo lang('class'); ?></th>
                                        <th><?php echo lang('status'); ?> </th>
                                        <th><?php echo lang('action'); ?></th>                                            
                                    </tr>
                                </thead>
                                <tbody>   
                                    <?php $count = 1; if(isset($admissions) && !empty($admissions)){ ?>
                                        <?php foreach($admissions as $obj){ ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <?php if(ci()->session->userdata('role_id') == SUPER_ADMIN){ ?>
                                                <td><?php echo $obj->branch_name; ?></td>
                                            <?php } ?>                                                
                                              
                                            <td>
                                                <?php  if($obj->photo != ''){ ?>
                                                    <img src="<?php echo UPLOAD_PATH; ?>admission-photo/<?php echo $obj->photo; ?>" alt="" width="70" /> 
                                                <?php }else{ ?>
                                                    <img src="<?php echo IMG_URL; ?>default-user.png" alt="" width="70" /> 
                                                <?php } ?>  
                                            </td>
                                            <td><?php echo $obj->name; ?></td>
                                            <td><?php echo $obj->class_name; ?></td>
                                            <td>
                                                <?php  if($obj->status == 0){ ?>
                                                    <a href="javascript:void(0);" class="btn btn-default btn-xs"> <?php echo lang('new'); ?> </a>
                                                <?php  }elseif($obj->status == 1){ ?>
                                                    <a href="javascript:void(0);" class="btn btn-info btn-xs"><?php echo lang('waiting'); ?> </a>  
                                                <?php  }elseif($obj->status == 2){ ?>
                                                    <a href="javascript:void(0);" class="btn btn-danger btn-xs"><?php echo lang('declined'); ?> </a>  
                                                <?php  }elseif($obj->status == 3){ ?>
                                                    <a href="javascript:void(0);" class="btn btn-success btn-xs"><?php echo lang('approved'); ?> </a>  
                                                <?php  } ?>
                                            </td>
                                            <td>
                                                <?php if(has_permission(EDIT, 'student', 'admission')){ ?>
                                                
                                                    <?php if($obj->status == 0){ ?>
                                                        <a href="<?php echo site_url('student/admission/approve/'.$obj->id); ?>" onclick="javascript: return confirm('<?php echo lang('confirm_proceed'); ?>');" class="btn btn-success btn-xs"><i class="fa fa-check-square-o"></i> <?php echo lang('approve'); ?> </a>
                                                        <a href="<?php echo site_url('student/admission/waiting/'.$obj->id); ?>" onclick="javascript: return confirm('<?php echo lang('confirm_proceed'); ?>');" class="btn btn-info btn-xs"><i class="fa fa-spinner"></i> <?php echo lang('waiting'); ?> </a>
                                                        <a href="<?php echo site_url('student/admission/decline/'.$obj->id); ?>" onclick="javascript: return confirm('<?php echo lang('confirm_proceed'); ?>');" class="btn btn-danger btn-xs"><i class="fa fa-close"></i> <?php echo lang('decline'); ?> </a>
                                                    <?php }elseif($obj->status == 1){ ?>
                                                        <a href="<?php echo site_url('student/admission/approve/'.$obj->id); ?>" onclick="javascript: return confirm('<?php echo lang('confirm_proceed'); ?>');" class="btn btn-success btn-xs"><i class="fa fa-check-square-o"></i> <?php echo lang('approve'); ?> </a>
                                                        <a href="<?php echo site_url('student/admission/decline/'.$obj->id); ?>" onclick="javascript: return confirm('<?php echo lang('confirm_proceed'); ?>');" class="btn btn-danger btn-xs"><i class="fa fa-close"></i> <?php echo lang('decline'); ?> </a>
                                                    <?php }elseif($obj->status == 2){ ?>
                                                        <a href="<?php echo site_url('student/admission/waiting/'.$obj->id); ?>" onclick="javascript: return confirm('<?php echo lang('confirm_proceed'); ?>');" class="btn btn-info btn-xs"><i class="fa fa-spinner"></i> <?php echo lang('waiting'); ?> </a>
                                                    <?php } ?>
                                                    
                                                <?php } ?>
                                                    
                                                <?php if(has_permission(VIEW, 'student', 'admission')){ ?>
                                                    <a  onclick="get_admission_modal(<?php echo $obj->id; ?>);"  data-toggle="modal" data-target=".bs-admission-modal-lg"  class="btn btn-success btn-xs"><i class="fa fa-eye"></i> <?php echo lang('view'); ?> </a>
                                                <?php } ?>
                                                <?php if(has_permission(DELETE, 'student', 'admission')){ ?>
                                                    <a href="<?php echo site_url('student/admission/delete/'.$obj->id); ?>" onclick="javascript: return confirm('<?php echo lang('confirm_alert'); ?>');" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> <?php echo lang('delete'); ?> </a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                            </div>
                        </div>
                        
                        <?php if(isset($edit)){ ?>
                        <div class="tab-pane fade in active" id="tab_edit_admission">
                              <div class="x_content"> 
                            <?php echo form_open_multipart(site_url('student/admission/approve/'. $admission->id), array('name' => 'edit', 'id' => 'edit', 'class'=>'form-horizontal form-label-left'), ''); ?>
                             
                               <div class="row">                  
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <h5  class="column-title"><strong><?php echo lang('basic_information'); ?>:</strong></h5>
                                    </div>
                                </div>
                                
                                <div class="row">                  
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="name"><?php echo lang('name'); ?> <span class="required">*</span></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="name"  id="name" value="<?php echo isset($admission->name) ?  $admission->name : ''; ?>" placeholder="<?php echo lang('name'); ?>" required="required" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('name'); ?></div> 
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="admission_no"><?php echo lang('admission_no'); ?> <span class="required">*</span></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="admission_no"  id="admission_no" value="<?php echo isset($admission->admission_no) ?  $admission->admission_no : ''; ?>" placeholder="<?php echo lang('admission_no'); ?>" required="required" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('admission_no'); ?></div> 
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="admission_date"><?php echo lang('admission_date'); ?><span class="required">*</span></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="admission_date"  id="edit_admission_date" value="<?php echo isset($admission->created_at) ?   date('d-m-Y', strtotime($admission->created_at)) : ''; ?>" placeholder="<?php echo lang('admission_date'); ?>" required="required" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('admission_date'); ?></div> 
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                            <label  for="dob"><?php echo lang('birth_date'); ?> <span class="required">*</span></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="dob"  id="edit_dob" value="<?php echo isset($admission->dob) ?  date('d-m-Y', strtotime($admission->dob)) : ''; ?>" placeholder="<?php echo lang('birth_date'); ?>" required="required" type="text" autocomplete="off">
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
                                                    <option value="<?php echo $key; ?>" <?php if($admission->gender == $key){ echo 'selected="selected"';} ?>><?php echo $value; ?></option>
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
                                                    <option value="<?php echo $key; ?>" <?php if($admission->blood_group == $key){ echo 'selected="selected"';} ?>><?php echo $value; ?></option>
                                                <?php } ?>
                                                </select>
                                            <div class="help-block"><?php echo form_error('blood_group'); ?></div>
                                         </div>
                                     </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                              <label for="religion"><?php echo lang('religion'); ?></label>
                                              <input  class="form-control col-md-7 col-xs-12"  name="religion"  id="add_religion" value="<?php echo isset($admission->religion) ?  $admission->religion : ''; ?>" placeholder="<?php echo lang('religion'); ?>" type="text" autocomplete="off">
                                               <div class="help-block"><?php echo form_error('religion'); ?></div>
                                         </div>
                                     </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                              <label for="caste"><?php echo lang('caste'); ?></label>
                                              <input  class="form-control col-md-7 col-xs-12"  name="caste"  id="add_caste" value="<?php echo isset($admission->caste) ?  $admission->caste : ''; ?>" placeholder="<?php echo lang('caste'); ?>" type="text" autocomplete="off">
                                               <div class="help-block"><?php echo form_error('caste'); ?></div>
                                         </div>
                                     </div>
                                </div>   
                                  
                                <div class="row">       
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                            <label for="email"><?php echo lang('email'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="email"   id="email" value="<?php echo isset($admission->email) ?  $admission->email : ''; ?>" placeholder="<?php echo lang('email'); ?>" type="email" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('email'); ?></div>
                                         </div>
                                     </div>
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                             <label for="phone"><?php echo lang('phone'); ?> <span class="required">*</span></label>
                                             <input  class="form-control col-md-7 col-xs-12"  name="phone"  id="add_phone" value="<?php echo isset($admission->phone) ?  $admission->phone : ''; ?>" placeholder="<?php echo lang('phone'); ?>" required="required" type="number" autocomplete="off">
                                             <div class="help-block"><?php echo form_error('phone'); ?></div>
                                         </div>
                                     </div>                                    
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                             <label for="national_id"><?php echo lang('national_id'); ?> </label>
                                             <input  class="form-control col-md-7 col-xs-12"  name="national_id"  id="national_id" value="<?php echo isset($admission->national_id) ?  $admission->national_id : ''; ?>" placeholder="<?php echo lang('national_id'); ?>" type="text" autocomplete="off">
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
                                             <label for="academic_year_id"><?php echo lang('academic_year'); ?> <span class="required">*</span></label>
                                             <select  class="form-control col-md-7 col-xs-12 quick-field" name="academic_year_id" id="academic_year_id" required="required">
                                                <option value="">--<?php echo lang('select'); ?>--</option>
                                                <?php foreach(ci()->academic_years as $obj){ ?>
                                                    <option value="<?php echo $obj->id; ?>"><?php echo $obj->session_year; if($obj->is_running){ echo ' ['.lang('running_year').']'; } ?></option>
                                                <?php } ?>
                                            </select>
                                            <div class="help-block"><?php echo form_error('academic_year_id'); ?></div>
                                         </div>
                                     </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                             <label for="type_id"><?php echo lang('student_type'); ?></label>
                                             <select  class="form-control col-md-7 col-xs-12 quick-field" name="type_id" id="type_id">
                                                <option value="">--<?php echo lang('select'); ?>--</option>
                                                <?php foreach($types as $obj){ ?>
                                                    <option value="<?php echo $obj->id; ?>" <?php if($admission->type_id == $obj->id){ echo 'selected="selected"';} ?>><?php echo $obj->type; ?></option>
                                                <?php } ?>
                                            </select>
                                            <div class="help-block"><?php echo form_error('type_id'); ?></div>
                                         </div>
                                     </div>
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                             <label for="class_id"><?php echo lang('class'); ?> <span class="required">*</span></label>
                                             <select  class="form-control col-md-7 col-xs-12 quick-field" name="class_id" id="edit_class_id" required="required" disabled="disabled">
                                                <option value="">--<?php echo lang('select'); ?>--</option>
                                                <?php foreach($classes as $obj){ ?>
                                                    <option value="<?php echo $obj->id; ?>" <?php if($admission->class_id == $obj->id){ echo 'selected="selected"';} ?>><?php echo $obj->name; ?></option>
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
                                </div>
                                
                               <div class="row">        
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                            <label for="group"><?php echo lang('group'); ?> </label>
                                            <select  class="form-control col-md-7 col-xs-12" name="group" id="group">
                                                <option value="">--<?php echo lang('select'); ?>--</option>
                                                <?php $groups = get_groups(); ?>
                                                <?php foreach($groups as $key=>$value){ ?>
                                                    <option value="<?php echo $key; ?>" <?php if($admission->group == $key){ echo 'selected="selected"';} ?>><?php echo $value; ?></option>
                                                <?php } ?>
                                            </select>
                                            <div class="help-block"><?php echo form_error('group'); ?></div>
                                         </div>
                                     </div>
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                             <label for="roll_no"><?php echo lang('roll_no'); ?> <span class="required">*</span></label>
                                             <input  class="form-control col-md-7 col-xs-12"  name="roll_no"  id="roll_no" value="" placeholder="<?php echo lang('roll_no'); ?>" required="required" type="text" autocomplete="off">
                                             <div class="help-block"><?php echo form_error('roll_no'); ?></div>
                                         </div>
                                     </div>
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                            <label for="registration_no"><?php echo lang('registration_no'); ?></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="registration_no"  id="registration_no" value="" placeholder="<?php echo lang('registration_no'); ?>" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('registration_no'); ?></div>
                                         </div>
                                     </div>                                     
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                            <label for="discount_id"><?php echo lang('discount'); ?></label>
                                            <select  class="form-control col-md-7 col-xs-12 quick-field" name="discount_id" id="edit_discount_id">
                                                <option value="">--<?php echo lang('select'); ?>--</option>
                                                <?php foreach($discounts as $obj){ ?>                                                    
                                                    <option value="<?php echo $obj->id; ?>" ><?php echo $obj->title; ?> [<?php echo $obj->amount; ?>%]</option>                                                   
                                                <?php } ?>
                                            </select>
                                            <div class="help-block"><?php echo form_error('discount_id'); ?></div>
                                         </div>
                                     </div>
                               </div>
                                  
                                <div class="row">      
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                            <label for="second_language"><?php echo lang('second_language'); ?></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="second_language"  id="second_language" value="<?php echo isset($admission->second_language) ?  $admission->second_language : ''; ?>" placeholder="<?php echo lang('second_language'); ?>" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('second_language'); ?></div>
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
                                              <textarea  class="form-control col-md-7 col-xs-12 textarea-4column"  name="present_address"  id="add_present_address"  placeholder="<?php echo lang('present_address'); ?>"><?php echo isset($admission->present_address) ?  $admission->present_address : ''; ?></textarea>
                                              <div class="help-block"><?php echo form_error('present_address'); ?></div>
                                         </div>
                                     </div>                                    
                                     <div class="col-md-6 col-sm-6 col-xs-12">
                                         <div class="item form-group">
                                            <label for="permanent_address"><?php echo lang('permanent_address'); ?></label>
                                            <textarea  class="form-control col-md-7 col-xs-12 textarea-4column"  name="permanent_address"  id="add_permanent_address"  placeholder="<?php echo lang('permanent_address'); ?>"><?php echo isset($admission->permanent_address) ?  $admission->permanent_address : ''; ?></textarea>
                                            <div class="help-block"><?php echo form_error('permanent_address'); ?></div>
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
                                            <input  class="form-control col-md-7 col-xs-12"  name="father_name"  id="father_name" value="<?php echo isset($admission->father_name) ?  $admission->father_name : ''; ?>" placeholder="<?php echo lang('father_name'); ?>" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('father_name'); ?></div>
                                         </div>
                                     </div>
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                            <label for="father_phone"><?php echo lang('father_phone'); ?></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="father_phone"  id="father_phone" value="<?php echo isset($admission->father_phone) ?  $admission->father_phone : ''; ?>" placeholder="<?php echo lang('father_phone'); ?>"  type="number" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('father_phone'); ?></div>
                                         </div>
                                     </div>
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                            <label for="father_education"><?php echo lang('father_education'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="father_education"  id="father_education" value="<?php echo isset($admission->father_education) ?  $admission->father_education : ''; ?>" placeholder="<?php echo lang('father_education'); ?>"  type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('father_education'); ?></div>
                                         </div>
                                     </div>
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                            <label for="father_profession"><?php echo lang('father_profession'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="father_profession"  id="father_profession" value="<?php echo isset($admission->father_profession) ?  $admission->father_profession : ''; ?>" placeholder="<?php echo lang('father_profession'); ?>"  type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('father_profession'); ?></div>
                                         </div>
                                     </div>
                                </div>
                                  
                                <div class="row">  
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                            <label for="father_designation"><?php echo lang('father_designation'); ?></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="father_designation"  id="father_designation" value="<?php echo isset($admission->father_designation) ?  $admission->father_designation : ''; ?>" placeholder="<?php echo lang('father_designation'); ?>"  type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('father_designation'); ?></div>
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
                                            <label for="mother_name"><?php echo lang('mother_name'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="mother_name"  id="mother_name" value="<?php echo isset($admission->mother_name) ?  $admission->mother_name : ''; ?>" placeholder="<?php echo lang('mother_name'); ?>" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('mother_name'); ?></div>
                                         </div>
                                     </div>
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                            <label for="mother_phone"><?php echo lang('mother_phone'); ?></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="mother_phone"  id="mother_phone" value="<?php echo isset($admission->mother_phone) ?  $admission->mother_phone : ''; ?>" placeholder="<?php echo lang('mother_phone'); ?>"  type="number" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('mother_phone'); ?></div>
                                         </div>
                                     </div>
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                            <label for="mother_education"><?php echo lang('mother_education'); ?></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="mother_education"  id="mother_education" value="<?php echo isset($admission->mother_education) ?  $admission->mother_education : ''; ?>" placeholder="<?php echo lang('mother_education'); ?>"  type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('mother_education'); ?></div>
                                         </div>
                                     </div>
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                            <label for="mother_profession"><?php echo lang('mother_profession'); ?></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="mother_profession"  id="mother_profession" value="<?php echo isset($admission->mother_profession) ?  $admission->mother_profession : ''; ?>" placeholder="<?php echo lang('mother_profession'); ?>"  type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('mother_profession'); ?></div>
                                         </div>
                                     </div>
                                </div>
                                <div class="row">    
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                            <label for="mother_designation"><?php echo lang('mother_designation'); ?></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="mother_designation"  id="mother_designation" value="<?php echo isset($admission->mother_designation) ?  $admission->mother_designation : ''; ?>" placeholder="<?php echo lang('mother_designation'); ?>"  type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('mother_designation'); ?></div>
                                         </div>
                                     </div>                                                                     
                                </div>
                                                             
                                
                                <?php if($admission->guardian_id){ ?>  
                                 <div class="row">                  
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <h5  class="column-title"><strong><?php echo lang('guardian_information'); ?>:</strong></h5>
                                        <input type="hidden" name="guardian_id" id="guardian_id" value="<?php echo $admission->guardian_id; ?>" />
                                    </div>
                                </div>
                                  
                                <div class="row"> 
                                     
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="gud_relation"><?php echo lang('relation_with_guardian'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="gud_relation"  id="gud_relation" readonly="readonly" value="<?php echo isset($admission->gud_relation) ?  lang($admission->gud_relation) : ''; ?>" placeholder="<?php echo lang('relation_with_guardian'); ?>" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('gud_relation'); ?></div>
                                        </div>
                                    </div>    
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                             <label for="guardian_name"><?php echo lang('name'); ?> <span class="required">*</span></label>
                                             <input  class="form-control col-md-7 col-xs-12"  name="guardian_name"  id="guardian_name" readonly="readonly" value="<?php echo isset($admission->gud_name) ?  $admission->gud_name : ''; ?>" placeholder="<?php echo lang('name'); ?>" required="required" type="text" autocomplete="off">
                                             <div class="help-block"><?php echo form_error('guardian_name'); ?></div>
                                         </div>
                                     </div>                                    
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                             <label for="guardian_phone"><?php echo lang('phone'); ?> <span class="required">*</span></label>
                                             <input  class="form-control col-md-7 col-xs-12"  name="guardian_phone"  id="guardian_phone" readonly="readonly" value="<?php echo isset($admission->gud_phone) ?  $admission->gud_phone : ''; ?>" placeholder="<?php echo lang('phone'); ?>" required="required" type="number" autocomplete="off">
                                             <div class="help-block"><?php echo form_error('guardian_phone'); ?></div>
                                         </div>
                                     </div>
                                     
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                             <label for="gud_email"><?php echo lang('email'); ?> </label>
                                             <input  class="form-control col-md-7 col-xs-12"  name="gud_email"  id="gud_email" readonly="readonly" value="<?php echo isset($admission->gud_email) ?  $admission->gud_email : ''; ?>" placeholder="<?php echo lang('email'); ?>" type="text" autocomplete="off">
                                             <div class="help-block"><?php echo form_error('gud_email'); ?></div>
                                         </div>
                                     </div>
                                </div>
                                <?php }else{ ?>   
                                  
                                <div class="row">                  
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <h5  class="column-title"><strong><?php echo lang('guardian_information'); ?>:</strong></h5>
                                    </div>
                                </div>
                                  
                                <div class="row"> 
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="gud_relation"><?php echo lang('relation_with_guardian'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="gud_relation"  id="gud_relation" readonly="readonly" value="<?php echo isset($admission->gud_relation) ?  $admission->gud_relation : ''; ?>" placeholder="<?php echo lang('relation_with_guardian'); ?>" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('gud_relation'); ?></div>
                                        </div>
                                    </div> 
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                             <label for="guardian_name"><?php echo lang('name'); ?> <span class="required">*</span></label>
                                             <input  class="form-control col-md-7 col-xs-12"  name="guardian_name"  id="guardian_name" value="<?php echo isset($admission->gud_name) ?  $admission->gud_name : ''; ?>" placeholder="<?php echo lang('name'); ?>" required="required" type="text" autocomplete="off">
                                             <div class="help-block"><?php echo form_error('guardian_name'); ?></div>
                                         </div>
                                     </div>                                       
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                             <label for="guardian_phone"><?php echo lang('phone'); ?> <span class="required">*</span></label>
                                             <input  class="form-control col-md-7 col-xs-12"  name="guardian_phone"  id="guardian_phone" value="<?php echo isset($admission->gud_phone) ?  $admission->gud_phone : ''; ?>" placeholder="<?php echo lang('phone'); ?>" required="required" type="number" autocomplete="off">
                                             <div class="help-block"><?php echo form_error('guardian_phone'); ?></div>
                                         </div>
                                     </div>                                     
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                             <label for="gud_email"><?php echo lang('email'); ?> </label>
                                             <input  class="form-control col-md-7 col-xs-12"  name="gud_email"  id="gud_email" value="<?php echo isset($admission->gud_email) ?  $admission->gud_email : ''; ?>" placeholder="<?php echo lang('email'); ?>" type="email" autocomplete="off">
                                             <div class="help-block"><?php echo form_error('gud_email'); ?></div>
                                         </div>
                                     </div>
                                </div>
                                  
                                <div class="row">  
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                             <label for="gud_national_id"><?php echo lang('national_id'); ?> </label>
                                             <input  class="form-control col-md-7 col-xs-12"  name="gud_national_id"  id="gud_national_id" value="<?php echo isset($admission->gud_national_id) ?  $admission->gud_national_id : ''; ?>" placeholder="<?php echo lang('national_id'); ?>" type="text" autocomplete="off">
                                             <div class="help-block"><?php echo form_error('gud_national_id'); ?></div>
                                         </div>
                                     </div>
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                             <label for="gud_profession"><?php echo lang('profession'); ?> </label>
                                             <input  class="form-control col-md-7 col-xs-12"  name="gud_profession"  id="gud_profession" value="<?php echo isset($admission->gud_profession) ?  $admission->gud_profession : ''; ?>" placeholder="<?php echo lang('profession'); ?>" type="text" autocomplete="off">
                                             <div class="help-block"><?php echo form_error('gud_profession'); ?></div>
                                         </div>
                                     </div>
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                             <label for="gud_religion"><?php echo lang('religion'); ?> </label>
                                             <input  class="form-control col-md-7 col-xs-12"  name="gud_religion"  id="gud_religion" value="<?php echo isset($admission->gud_religion) ?  $admission->gud_religion : ''; ?>" placeholder="<?php echo lang('religion'); ?>" type="text" autocomplete="off">
                                             <div class="help-block"><?php echo form_error('gud_religion'); ?></div>
                                         </div>
                                     </div>
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                             <label for="gud_other_info"><?php echo lang('other_info'); ?> </label>
                                             <input  class="form-control col-md-7 col-xs-12"  name="gud_other_info"  id="gud_other_info" value="<?php echo isset($admission->gud_other_info) ?  $admission->gud_other_info : ''; ?>" placeholder="<?php echo lang('other_info'); ?>" type="text" autocomplete="off">
                                             <div class="help-block"><?php echo form_error('gud_other_info'); ?></div>
                                         </div>
                                     </div>
                                </div>
                                  
                                <div class="row">  
                                     <div class="col-md-6 col-sm-6 col-xs-12">
                                         <div class="item form-group">
                                             <label for="gud_present_address"><?php echo lang('present_address'); ?> </label>
                                              <textarea  class="form-control col-md-7 col-xs-12 textarea-4column"  name="gud_present_address"  id="gud_present_address"  placeholder="<?php echo lang('present_address'); ?>"><?php echo isset($admission->gud_present_address) ?  $admission->gud_present_address : ''; ?></textarea>
                                              <div class="help-block"><?php echo form_error('gud_present_address'); ?></div>
                                         </div>
                                     </div>                                    
                                     <div class="col-md-6 col-sm-6 col-xs-12">
                                         <div class="item form-group">
                                            <label for="gud_permanent_address"><?php echo lang('permanent_address'); ?></label>
                                            <textarea  class="form-control col-md-7 col-xs-12 textarea-4column"  name="gud_permanent_address"  id="gud_permanent_address"  placeholder="<?php echo lang('permanent_address'); ?>"><?php echo isset($admission->gud_permanent_address) ?  $admission->gud_permanent_address : ''; ?></textarea>
                                            <div class="help-block"><?php echo form_error('gud_permanent_address'); ?></div>
                                         </div>
                                     </div>
                                </div>
                                <?php } ?>  
                                  
                                
                               <div class="row">                  
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <h5 class="column-title"><strong><?php echo lang('previous_school'); ?>:</strong></h5>
                                    </div>
                                </div>   
                                <div class="row">
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                            <label for="previous_school"><?php echo lang('school_name'); ?></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="previous_school"  id="previous_school" value="<?php echo isset($admission->previous_school) ?  $admission->previous_school : ''; ?>" placeholder="<?php echo lang('school_name'); ?>"  type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('previous_school'); ?></div>
                                         </div>
                                     </div>
                                    
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                            <label for="previous_class"><?php echo lang('previous_class'); ?></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="previous_class"  id="previous_class" value="<?php echo isset($admission->previous_class) ?  $admission->previous_class : ''; ?>" placeholder="<?php echo lang('previous_class'); ?>"  type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('previous_class'); ?></div>
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
                                            <label for="username"><?php echo lang('username'); ?> <span class="required">*</span></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="username"  id="username" required="required" value="" placeholder="<?php echo lang('username'); ?>" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('username'); ?></div>
                                         </div>
                                     </div>
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                            <label for="password"><?php echo lang('password'); ?> <span class="required">*</span></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="password"  id="password" value="" required="required" placeholder="<?php echo lang('password'); ?>" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('password'); ?></div>
                                         </div>
                                     </div>
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                            <label for="health_condition"><?php echo lang('health_condition'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="health_condition"  id="health_condition" value="<?php echo isset($admission->health_condition) ?  $admission->health_condition : ''; ?>" placeholder="<?php echo lang('health_condition'); ?>" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('health_condition'); ?></div>
                                         </div>
                                     </div>
                                </div>
                                  
                                <div class="row">     
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="item form-group">
                                           <label for="other_info"><?php echo lang('other_info'); ?></label> 
                                           <textarea  class="form-control col-md-6 col-xs-12 textarea-4column"  name="other_info"  id="other_info" placeholder="<?php echo lang('other_info'); ?>"></textarea>
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
                                             <input type="hidden" name="prev_photo" id="prev_photo" value="<?php echo $admission->photo; ?>" />
                                            <?php if($admission->photo){ ?>
                                            <img src="<?php echo UPLOAD_PATH; ?>admission-photo/<?php echo $admission->photo; ?>" alt="" width="70" /><br/><br/>
                                            <?php } ?>
                                         </div>
                                     </div>                                    
                                </div>
                                                                
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <input type="hidden" name="branch_id" id="branch_id" value="<?php echo $admission->branch_id; ?>" />
                                        <input type="hidden" name="class_id" id="class_id" value="<?php echo $admission->class_id; ?>" />
                                        <input type="hidden" name="id" id="id" value="<?php echo $admission->id; ?>" />
                                         <input type="hidden" name="role_id" id="role_id" value="<?php echo STUDENT; ?>" />
                                        <a href="<?php echo site_url('student/index'); ?>" class="btn btn-primary"><?php echo lang('cancel'); ?></a>
                                        <button id="send" type="submit" class="btn btn-success"><?php echo lang('approve'); ?></button>
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


<div class="modal fade bs-admission-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title"><?php echo lang('detail_information'); ?></h4>
        </div>
        <div class="modal-body fn_admission_data">
            
        </div>       
      </div>
    </div>
</div>
<script type="text/javascript">
         
    function get_admission_modal(admission_id){
         
        $('.fn_admission_data').html('<p style="padding: 20px;"><p style="padding: 20px;text-align:center;"><img src="<?php echo IMG_URL; ?>loading.gif" /></p>');
        $.ajax({       
          type   : "POST",
          url    : "<?php echo site_url('student/admission/get_single_admission'); ?>",
          data   : {admission_id : admission_id},  
          success: function(response){                                                   
             if(response)
             {
                $('.fn_admission_data').html(response);
             }
          }
       });
    }
</script>


<!-- bootstrap-datetimepicker -->
<link href="<?php echo VENDOR_URL; ?>datepicker/datepicker.css" rel="stylesheet">
 <script src="<?php echo VENDOR_URL; ?>datepicker/datepicker.js"></script>
 
 <script type="text/javascript">     
  
  var currentDate = new Date(); 
  $('#edit_admission_date').datepicker({endDate: "currentDate", maxDate: currentDate });
  $('#edit_dob').datepicker({ startView: 2, endDate: "currentDate", maxDate: currentDate });
 
  
    <?php if(isset($admission) && isset($admission)){ ?>
        get_section_by_class(<?php echo $admission->branch_id; ?>, '<?php echo $admission->class_id; ?>', '');
    <?php } ?>
    
    function get_section_by_class(branch_id, class_id, section_id){       
               
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_section_by_class'); ?>",
            data   : { branch_id : branch_id, class_id : class_id , section_id: section_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                  $('#edit_section_id').html(response);
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
    
    $("#edit").validate();   
</script>
 