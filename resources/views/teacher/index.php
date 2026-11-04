<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-users"></i><small> <?php echo lang('manage_teacher'); ?></small></h3>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>      
            
            <div class="x_content">
                <div class="" data-example-id="togglable-tabs">
                    
                    <ul  class="nav nav-tabs bordered">
                        <li class="<?php if(isset($list)){ echo 'active'; }?>"><a href="#tab_teacher_list"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-list-ol"></i> <?php echo lang('list'); ?></a> </li>
                        
                        <?php if(has_permission(ADD, 'teacher', 'teacher')){ ?>
                        
                            <?php if(isset($edit)){ ?>
                                <li  class="<?php if(isset($add)){ echo 'active'; }?>"><a href="<?php echo site_url('teacher/add'); ?>"  aria-expanded="false"><i class="fa fa-plus-square-o"></i> <?php echo lang('add'); ?></a> </li>                          
                             <?php }else{ ?>
                                <li  class=""><a href="#tab_add_teacher"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-plus-square-o"></i> <?php echo lang('add'); ?></a> </li>                          
                             <?php } ?>
                        
                        <?php } ?>  
                        
                        <?php if(isset($edit)){ ?>
                            <li  class="active"><a href="#tab_edit_teacher"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-pencil-square-o"></i> <?php echo lang('edit'); ?></a> </li>                          
                        <?php } ?> 
                            
                        <?php if(isset($detail)){ ?>
                            <li  class="active"><a href="#tab_view_teacher"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-pencil-square-o"></i> <?php echo lang('view'); ?></a> </li>                          
                        <?php } ?> 
                         
                        <li class="li-class-list">
                           <?php if(ci()->session->userdata('role_id') == SUPER_ADMIN){  ?>                                 
                                <select  class="form-control col-md-7 col-xs-12" id="filter_branch_id" onchange="get_teacher_by_school(this.value);">
                                        <option value="<?php echo site_url('teacher/index'); ?>">--<?php echo lang('select_branch'); ?>--</option> 
                                    <?php foreach(ci()->schools as $obj ){ ?>
                                        <option value="<?php echo site_url('teacher/index/'.$obj->id); ?>" <?php if(isset($filter_branch_id) && $filter_branch_id == $obj->id){ echo 'selected="selected"';} ?> > <?php echo $obj->branch_name; ?></option>
                                    <?php } ?>   
                                </select>
                            <?php } ?>  
                        </li>     
                            
                    </ul>
                    <br/>
                    
                    <div class="tab-content">
                        <div  class="tab-pane fade in <?php if(isset($list)){ echo 'active'; }?>" id="tab_teacher_list" >
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
                                        <th><?php echo lang('responsibility'); ?></th>
                                        <th><?php echo lang('phone'); ?></th>
                                        <th><?php echo lang('email'); ?></th>
                                        <th><?php echo lang('join_date'); ?></th>
                                        <th><?php echo lang('is_view_on_web'); ?></th>
                                        <th><?php echo lang('display_order'); ?></th>
                                        <th><?php echo lang('action'); ?></th>                                            
                                    </tr>
                                </thead>
                                <tbody>   
                                    <?php  $count = 1; if(isset($teachers) && !empty($teachers)){ ?>
                                        <?php foreach($teachers as $obj){ ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <?php if(ci()->session->userdata('role_id') == SUPER_ADMIN){ ?>
                                                <td><?php echo $obj->branch_name; ?></td>
                                            <?php } ?>
                                            <td>
                                                <?php  if($obj->photo != ''){ ?>
                                                    <img src="<?php echo UPLOAD_PATH; ?>teacher-photo/<?php echo $obj->photo; ?>" alt="" width="60" /> 
                                                <?php }else{ ?>
                                                    <img src="<?php echo IMG_URL; ?>default-user.png" alt="" width="60" /> 
                                                <?php } ?>
                                            </td>
                                            <td><?php echo ucfirst($obj->name); ?></td>
                                            <td><?php echo $obj->responsibility; ?></td>
                                            <td><?php echo $obj->phone; ?></td>
                                            <td><?php echo $obj->email; ?></td>
                                            <td><?php echo $obj->joining_date; ?></td>
                                            <td><?php echo $obj->is_view_on_web ? lang('yes') : lang('no'); ?></td>
                                            <td>
                                                <input  class="col-md-7 col-xs-12" itemid="<?php echo $obj->id; ?>"  name="display_order[]"  value="<?php echo $obj->display_order; ?>"  type="text" autocomplete="off" />
                                            </td>
                                            <td>
                                                <?php if(has_permission(EDIT, 'teacher', 'teacher')){ ?>
                                                    <a href="<?php echo site_url('teacher/edit/'.$obj->id); ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil-square-o"></i> <?php echo lang('edit'); ?> </a><br/>
                                                <?php } ?> 
                                                <?php if(has_permission(VIEW, 'teacher', 'teacher')){ ?>
                                                    <a  onclick="get_teacher_modal(<?php echo $obj->id; ?>);"  data-toggle="modal" data-target=".bs-teacher-modal-lg"  class="btn btn-success btn-xs"><i class="fa fa-eye"></i> <?php echo lang('view'); ?> </a><br/>
                                                <?php } ?>
                                                <?php if(has_permission(DELETE, 'teacher', 'teacher')){ ?>
                                                    <a href="<?php echo site_url('teacher/delete/'.$obj->id); ?>" onclick="javascript: return confirm('<?php echo lang('confirm_alert'); ?>');" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> <?php echo lang('delete'); ?> </a>
                                                <?php } ?> 
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                               <?php if(has_permission(EDIT, 'teacher', 'teacher')){ ?> 
                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-12 text-right">
                                            <button type="button" id="fn_display_order" class="btn btn-success" style="margin-bottom:10px;"><?php echo lang('update_order'); ?></button>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>

                        <div  class="tab-pane fade in <?php if(isset($add)){ echo 'active'; }?>" id="tab_add_teacher">
                            <div class="x_content"> 
                               <?php echo form_open_multipart(site_url('teacher/add'), array('name' => 'add', 'id' => 'add', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                
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
                                            <label for="national_id"><?php echo lang('national_id'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="national_id"  id="national_id" value="<?php echo isset($post['national_id']) ?  $post['national_id'] : ''; ?>" placeholder="<?php echo lang('national_id'); ?>" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('national_id'); ?></div> 
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="responsibility"><?php echo lang('responsibility'); ?> <span class="required">*</span></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="responsibility"  id="responsibility" value="<?php echo isset($post['responsibility']) ?  $post['responsibility'] : ''; ?>" placeholder="<?php echo lang('responsibility'); ?>" required="required" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('responsibility'); ?></div> 
                                        </div>
                                    </div>                                    
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="phone"><?php echo lang('phone'); ?></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="phone"  id="phone" value="<?php echo isset($post['phone']) ?  $post['phone'] : ''; ?>" placeholder="<?php echo lang('phone'); ?>" type="number" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('phone'); ?></div> 
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
                                                    <option value="<?php echo $key; ?>" <?php if(isset($post['gender']) && $post['gender'] == $key){ echo 'selected="selected"'; } ?>><?php echo $value; ?></option>
                                                <?php } ?>
                                            </select>
                                        <div class="help-block"><?php echo form_error('gender'); ?></div> 
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="blood_group"><?php echo lang('blood_group'); ?> </label>
                                            <select  class="form-control col-md-7 col-xs-12" name="blood_group" id="blood_group">
                                                <option value="">--<?php echo lang('select'); ?>--</option> 
                                                <?php $bloods = get_blood_group(); ?>
                                                <?php foreach($bloods as $key=>$value){ ?>
                                                    <option value="<?php echo $key; ?>" <?php if(isset($post['blood_group']) && $post['blood_group'] == $key){ echo 'selected="selected"'; } ?>><?php echo $value; ?></option>
                                                <?php } ?>
                                            </select>
                                        <div class="help-block"><?php echo form_error('blood_group'); ?></div> 
                                        </div>
                                    </div>                                    
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="religion"><?php echo lang('religion'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="religion"  id="religion" value="<?php echo isset($post['religion']) ?  $post['religion'] : ''; ?>" placeholder="<?php echo lang('religion'); ?>" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('religion'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="dob"><?php echo lang('birth_date'); ?> <span class="required">*</span></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="dob"  id="add_dob" value="<?php echo isset($post['dob']) ?  $post['dob'] : ''; ?>" placeholder="<?php echo lang('birth_date'); ?>" required="required" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('dob'); ?></div>
                                        </div>
                                    </div>
                                    
                                </div> 
                                
                                <div class="row">    
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="item form-group">
                                            <label for="present_address"><?php echo lang('present_address'); ?></label>
                                            <textarea  class="form-control col-md-7 col-xs-12 textarea-4column"  name="present_address"  id="present_address" placeholder="<?php echo lang('present_address'); ?>"><?php echo isset($post['present_address']) ?  $post['present_address'] : ''; ?></textarea>
                                            <div class="help-block"><?php echo form_error('present_address'); ?></div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="item form-group">
                                            <label for="permanent_address"><?php echo lang('permanent_address'); ?></label>
                                            <textarea  class="form-control col-md-7 col-xs-12 textarea-4column"  name="permanent_address"  id="permanent_address"  placeholder="<?php echo lang('permanent_address'); ?>"><?php echo isset($post['permanent_address']) ?  $post['permanent_address'] : ''; ?></textarea>
                                        <div class="help-block"><?php echo form_error('permanent_address'); ?></div>
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
                                            <label for="email"><?php echo lang('email'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="email"  id="email" value="<?php echo isset($post['email']) ?  $post['email'] : ''; ?>" placeholder="<?php echo lang('email'); ?>" type="email" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('email'); ?></div>
                                        </div>
                                    </div>
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
                                            <input  class="form-control col-md-7 col-xs-12"  name="password"  id="password" value="" placeholder="<?php echo lang('password'); ?>" required="required" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('password'); ?></div>
                                        </div>
                                    </div>  
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="salary_grade_id"><?php echo lang('salary_grade'); ?> </label>
                                            <select  class="form-control col-md-7 col-xs-12 quick-field" name="salary_grade_id" id="add_salary_grade_id">
                                                <option value="">--<?php echo lang('select'); ?>--</option>                                                                                    
                                                <?php foreach($grades as $obj){ ?>                                           
                                                <option value="<?php echo $obj->id; ?>" <?php if(isset($post['salary_grade_id']) && $post['salary_grade_id'] == $obj->id){ echo 'selected="selected"'; } ?>><?php echo $obj->grade_name; ?></option>
                                                <?php } ?>           
                                            </select>
                                            <div class="help-block"><?php echo form_error('salary_grade_id'); ?></div>
                                        </div>
                                    </div>  
                                </div>
                                
                                <div class="row">
                                    
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="salary_type"><?php echo lang('salary_type'); ?> </label>
                                            <select  class="form-control col-md-7 col-xs-12" name="salary_type" id="salary_type" >
                                                <option value="">--<?php echo lang('select'); ?>--</option>                                                                                    
                                                <option value="monthly" <?php if(isset($post['salary_type']) && $post['salary_type'] == 'monthly'){ echo 'selected="selected"'; } ?>><?php echo lang('monthly'); ?></option>                                           
                                                <option value="hourly" <?php if(isset($post['salary_type']) && $post['salary_type'] == 'hourly'){ echo 'selected="selected"'; } ?>><?php echo lang('hourly'); ?></option>                                           
                                            </select>
                                            <div class="help-block"><?php echo form_error('salary_type'); ?></div>
                                        </div>
                                    </div>                                    
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="role_id"><?php echo lang('role'); ?> <span class="required">*</span></label>
                                            <select  class="form-control col-md-7 col-xs-12 quick-field" name="role_id" id="role_id" required="required">                                                
                                                <?php foreach($roles as $obj){ ?>
                                                    <?php if(in_array($obj->id, array(TEACHER))){ ?>
                                                    <option value="<?php echo $obj->id; ?>" <?php if(isset($post['role_id']) && $post['role_id'] == $obj->id){ echo 'selected="selected"'; } ?>><?php echo $obj->name; ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                            <div class="help-block"><?php echo form_error('role_id'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="joining_date"><?php echo lang('join_date'); ?> <span class="required">*</span></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="joining_date"  id="add_joining_date" value="<?php echo isset($post['joining_date']) ?  $post['joining_date'] : ''; ?>" placeholder="<?php echo lang('join_date'); ?>" required="required" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('joining_date'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="resume"><?php echo lang('resume'); ?> </label>                                           
                                            <div class="btn btn-default btn-file">
                                                <i class="fa fa-paperclip"></i> <?php echo lang('upload'); ?>
                                                <input  class="form-control col-md-7 col-xs-12"  name="resume"  id="resume" type="file">
                                            </div>
                                            <div class="text-info"><?php echo lang('valid_file_format_doc'); ?></div>
                                            <div class="help-block"><?php echo form_error('resume'); ?></div>
                                        </div>
                                    </div>  
                                </div>
                                
                                <div class="row">                  
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <h5  class="column-title"><strong><?php echo lang('other_information'); ?>:</strong></h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="is_view_on_web"><?php echo lang('is_view_on_web'); ?> </label>
                                            <select  class="form-control col-md-7 col-xs-12" name="is_view_on_web" id="is_view_on_web">
                                                <option value="">--<?php echo lang('select'); ?>--</option>                                                                                    
                                                <option value="1" <?php if(isset($post['is_view_on_web']) && $post['is_view_on_web'] == '1'){ echo 'selected="selected"'; } ?>><?php echo lang('yes'); ?></option>                                           
                                                <option value="0" <?php if(isset($post['is_view_on_web']) && $post['is_view_on_web'] == '0'){ echo 'selected="selected"'; } ?>><?php echo lang('no'); ?></option>                                           
                                            </select>
                                            <div class="help-block"><?php echo form_error('is_view_on_web'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="facebook_url"><?php echo lang('facebook_url'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="facebook_url"  id="facebook_url" value="<?php echo isset($post['facebook_url']) ?  $post['facebook_url'] : ''; ?>" placeholder="<?php echo lang('facebook_url'); ?>" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('facebook_url'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="linkedin_url"><?php echo lang('linkedin_url'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="linkedin_url"  id="linkedin_url" value="<?php echo isset($post['linkedin_url']) ?  $post['linkedin_url'] : ''; ?>" placeholder="<?php echo lang('linkedin_url'); ?>" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('linkedin_url'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="twitter_url"><?php echo lang('twitter_url'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="twitter_url"  id="twitter_url" value="<?php echo isset($post['twitter_url']) ?  $post['twitter_url'] : ''; ?>" placeholder="<?php echo lang('twitter_url'); ?>" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('twitter_url'); ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="instagram_url"><?php echo lang('instagram_url'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="instagram_url"  id="instagram_url" value="<?php echo isset($post['instagram_url']) ?  $post['instagram_url'] : ''; ?>" placeholder="<?php echo lang('instagram_url'); ?>" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('instagram_url'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="youtube_url"><?php echo lang('youtube_url'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="youtube_url"  id="youtube_url" value="<?php echo isset($post['youtube_url']) ?  $post['youtube_url'] : ''; ?>" placeholder="<?php echo lang('youtube_url'); ?>" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('youtube_url'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="pinterest_url"><?php echo lang('pinterest_url'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="pinterest_url"  id="pinterest_url" value="<?php echo isset($post['pinterest_url']) ?  $post['pinterest_url'] : ''; ?>" placeholder="<?php echo lang('pinterest_url'); ?>" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('pinterest_url'); ?></div>
                                        </div>
                                    </div>
                                    
                                 </div>
                                
                                <div class="row">    
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="item form-group">
                                            <label for="other_info"><?php echo lang('other_info'); ?> </label>
                                            <textarea  class="form-control col-md-7 col-xs-12 textarea-4column"  name="other_info"  id="other_info" placeholder="<?php echo lang('other_info'); ?>"><?php echo isset($post['other_info']) ?  $post['other_info'] : ''; ?></textarea>
                                            <div class="help-block"><?php echo form_error('other_info'); ?></div>
                                        </div>
                                    </div>
                               
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="photo"><?php echo lang('photo'); ?> </label>                                           
                                                <div class="btn btn-default btn-file">
                                                <i class="fa fa-paperclip"></i> <?php echo lang('upload'); ?>
                                                <input  class="form-control col-md-7 col-xs-12"  name="photo"  id="photo" type="file">
                                            </div>
                                            <div class="text-info"><?php echo lang('valid_file_format_img'); ?></div>
                                            <div class="help-block"><?php echo form_error('photo'); ?></div>
                                        </div>
                                    </div>
                                    
                                </div>
                                
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <a href="<?php echo site_url('teacher/index'); ?>" class="btn btn-primary"><?php echo lang('cancel'); ?></a>
                                        <button id="send" type="submit" class="btn btn-success"><?php echo lang('submit'); ?></button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>  

                        <?php if(isset($edit)){ ?>
                        
                        <div class="tab-pane fade in active" id="tab_edit_teacher">
                            <div class="x_content"> 
                            <?php echo form_open_multipart(site_url('teacher/edit/'. $teacher->id), array('name' => 'editteacher', 'id' => 'editteacher', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                
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
                                            <input  class="form-control col-md-7 col-xs-12"  name="name"  id="name" value="<?php echo isset($teacher->name) ?  $teacher->name : ''; ?>" placeholder="<?php echo lang('name'); ?>" required="required" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('name'); ?></div> 
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="national_id"><?php echo lang('national_id'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="national_id"  id="national_id" value="<?php echo isset($teacher->national_id) ?  $teacher->national_id : ''; ?>" placeholder="<?php echo lang('national_id'); ?>" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('national_id'); ?></div> 
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="responsibility"><?php echo lang('responsibility'); ?> <span class="required">*</span></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="responsibility"  id="responsibility" value="<?php echo isset($teacher->responsibility) ?  $teacher->responsibility : ''; ?>" placeholder="<?php echo lang('responsibility'); ?>" required="required" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('designation_id'); ?></div> 
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="phone"><?php echo lang('phone'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="phone"  id="phone" value="<?php echo isset($teacher->phone) ?  $teacher->phone : ''; ?>" placeholder="<?php echo lang('phone'); ?>"  type="number" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('phone'); ?></div> 
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
                                                    <option value="<?php echo $key; ?>" <?php if($teacher->gender == $key){ echo 'selected="selected"';} ?>><?php echo $value; ?></option>
                                                <?php } ?>
                                            </select>
                                        <div class="help-block"><?php echo form_error('gender'); ?></div> 
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="blood_group"><?php echo lang('blood_group'); ?> </label>
                                            <select  class="form-control col-md-7 col-xs-12" name="blood_group" id="blood_group">
                                                <option value="">--<?php echo lang('select'); ?>--</option> 
                                                <?php $bloods = get_blood_group(); ?>
                                                <?php foreach($bloods as $key=>$value){ ?>
                                                    <option value="<?php echo $key; ?>" <?php if($teacher->blood_group == $key){ echo 'selected="selected"';} ?>><?php echo $value; ?></option>
                                                <?php } ?>
                                            </select>
                                        <div class="help-block"><?php echo form_error('blood_group'); ?></div> 
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="religion"><?php echo lang('religion'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="religion"  id="religion" value="<?php echo isset($teacher->religion) ?  $teacher->religion : ''; ?>" placeholder="<?php echo lang('religion'); ?>" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('religion'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="dob"><?php echo lang('birth_date'); ?> <span class="required">*</span></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="dob"  id="edit_dob" value="<?php echo isset($teacher->dob) ?  date('d-m-Y', strtotime($teacher->dob)) : ''; ?>" placeholder="<?php echo lang('birth_date'); ?>" required="required" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('dob'); ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="item form-group">
                                            <label for="present_address"><?php echo lang('present_address'); ?> </label>
                                            <textarea  class="form-control col-md-7 col-xs-12 textarea-4column"  name="present_address"  id="present_address" placeholder="<?php echo lang('present_address'); ?>"><?php echo isset($teacher->present_address) ?  $teacher->present_address : ''; ?></textarea>
                                            <div class="help-block"><?php echo form_error('present_address'); ?></div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="item form-group">
                                            <label for="permanent_address"><?php echo lang('permanent_address'); ?></label>
                                            <textarea  class="form-control col-md-7 col-xs-12 textarea-4column"  name="permanent_address"  id="permanent_address"  placeholder="<?php echo lang('permanent_address'); ?>"><?php echo isset($teacher->permanent_address) ?  $teacher->permanent_address : ''; ?></textarea>
                                        <div class="help-block"><?php echo form_error('permanent_address'); ?></div>
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
                                            <label for="email"><?php echo lang('email'); ?></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="email"  id="email" value="<?php echo isset($teacher->email) ?  $teacher->email : ''; ?>" placeholder="<?php echo lang('email'); ?>" type="email" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('email'); ?></div>
                                        </div>
                                    </div> 
                                    
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="username"><?php echo lang('username'); ?> <span class="required">*</span></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="username"  readonly="readonly"  id="username" value="<?php echo isset($teacher->username) ?  $teacher->username : ''; ?>" placeholder="<?php echo lang('username'); ?>" required="required" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('username'); ?></div>
                                        </div>
                                    </div>                                    
                                    
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="salary_grade_id"><?php echo lang('salary_grade'); ?> </label>
                                            <select  class="form-control col-md-7 col-xs-12 quick-field" name="salary_grade_id" id="edit_salary_grade_id" >
                                                <option value="">--<?php echo lang('select'); ?>--</option>                                                                                    
                                                <?php foreach($grades as $obj){ ?>                                           
                                                <option value="<?php echo $obj->id; ?>" <?php if($teacher->salary_grade_id == $obj->id){ echo 'selected="selected"';} ?>><?php echo $obj->grade_name; ?></option>
                                                <?php } ?>           
                                            </select>
                                            <div class="help-block"><?php echo form_error('salary_grade_id'); ?></div>
                                        </div>
                                    </div>  
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="salary_type"><?php echo lang('salary_type'); ?> </label>
                                            <select  class="form-control col-md-7 col-xs-12" name="salary_type" id="edit_salary_type" >
                                                <option value="">--<?php echo lang('select'); ?>--</option>                                                                                    
                                                <option value="monthly" <?php if($teacher->salary_type == 'monthly'){ echo 'selected="selected"';} ?>><?php echo lang('monthly'); ?></option>                                           
                                                <option value="hourly" <?php if($teacher->salary_type == 'hourly'){ echo 'selected="selected"';} ?>><?php echo lang('hourly'); ?></option>                                           
                                            </select>
                                            <div class="help-block"><?php echo form_error('salary_type'); ?></div>
                                        </div>
                                    </div>                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="role_id"><?php echo lang('role'); ?> <span class="required">*</span></label>
                                            <select  class="form-control col-md-7 col-xs-12 quick-field" name="role_id" id="role_id" required="required">
                                                <option value="">--<?php echo lang('select'); ?>--</option>
                                                <?php foreach($roles as $obj){ ?>
                                                   <?php if(in_array($obj->id, array(TEACHER))){ ?>
                                                    <option value="<?php echo $obj->id; ?>" <?php if($teacher->role_id == $obj->id){ echo 'selected="selected"';} ?>><?php echo $obj->name; ?></option>
                                                    <?php } ?>
                                                <?php } ?>                                              
                                            </select>
                                            <div class="help-block"><?php echo form_error('role_id'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="joining_date"><?php echo lang('join_date'); ?> <span class="required">*</span></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="joining_date"  id="edit_joining_date" value="<?php echo isset($teacher->joining_date) ?  date('d-m-Y', strtotime($teacher->joining_date)) : ''; ?>" placeholder="<?php echo lang('join_date'); ?>" required="required" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('joining_date'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="resume"><?php echo lang('resume'); ?> </label>                                           
                                            <div class="btn btn-default btn-file">
                                                <i class="fa fa-paperclip"></i> <?php echo lang('upload'); ?>
                                                <input  class="form-control col-md-7 col-xs-12"  name="resume"  id="resume" type="file">
                                            </div>
                                            <div class="text-info"><?php echo lang('valid_file_format_doc'); ?></div>                                            <div class="help-block"><?php echo form_error('resume'); ?></div>
                                              
                                        </div>
                                    </div> 
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="resume">&nbsp;</label>   
                                            <input type="hidden" name="prev_resume" id="prev_resume" value="<?php echo $teacher->resume; ?>" />
                                             <?php if($teacher->resume){ ?>
                                            <a target="_blank" class="btn btn-success"  href="<?php echo UPLOAD_PATH; ?>teacher-resume/<?php echo $teacher->resume; ?>"><i class="fa fa-download"></i> <?php echo lang('download'); ?></a> <br/>
                                             <?php } ?>  
                                        </div>
                                    </div> 
                                </div>
                                
                                <div class="row">                  
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <h5  class="column-title"><strong><?php echo lang('other_information'); ?>:</strong></h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="is_view_on_web"><?php echo lang('is_view_on_web'); ?> </label>
                                            <select  class="form-control col-md-7 col-xs-12" name="is_view_on_web" id="is_view_on_web">
                                                <option value="">--<?php echo lang('select'); ?>--</option>                                                                                    
                                                <option value="1" <?php if($teacher->is_view_on_web == 1){ echo 'selected="selected"';} ?>><?php echo lang('yes'); ?></option>                                           
                                                <option value="0" <?php if($teacher->is_view_on_web == 0){ echo 'selected="selected"';} ?>><?php echo lang('no'); ?></option>                                           
                                            </select>
                                            <div class="help-block"><?php echo form_error('is_view_on_web'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="facebook_url"><?php echo lang('facebook_url'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="facebook_url"  id="facebook_url" value="<?php echo isset($teacher->facebook_url) ?  $teacher->facebook_url : ''; ?>" placeholder="<?php echo lang('facebook_url'); ?>" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('facebook_url'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="linkedin_url"><?php echo lang('linkedin_url'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="linkedin_url"  id="linkedin_url" value="<?php echo isset($teacher->linkedin_url) ?  $teacher->linkedin_url : ''; ?>" placeholder="<?php echo lang('linkedin_url'); ?>" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('linkedin_url'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="twitter_url"><?php echo lang('twitter_url'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="twitter_url"  id="twitter_url" value="<?php echo isset($teacher->twitter_url) ?  $teacher->twitter_url : ''; ?>" placeholder="<?php echo lang('twitter_url'); ?>" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('twitter_url'); ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="instagram_url"><?php echo lang('instagram_url'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="instagram_url"  id="instagram_url" value="<?php echo isset($teacher->instagram_url) ?  $teacher->instagram_url : ''; ?>" placeholder="<?php echo lang('instagram_url'); ?>" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('instagram_url'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="youtube_url"><?php echo lang('youtube_url'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="youtube_url"  id="youtube_url" value="<?php echo isset($teacher->youtube_url) ?  $teacher->youtube_url : ''; ?>" placeholder="<?php echo lang('youtube_url'); ?>" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('youtube_url'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="pinterest_url"><?php echo lang('pinterest_url'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="pinterest_url"  id="pinterest_url" value="<?php echo isset($teacher->pinterest_url) ?  $teacher->pinterest_url : ''; ?>" placeholder="<?php echo lang('pinterest_url'); ?>" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('pinterest_url'); ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="item form-group">
                                            <label for="other_info"><?php echo lang('other_info'); ?> </label>
                                            <textarea  class="form-control col-md-7 col-xs-12 textarea-4column"  name="other_info"  id="other_info" placeholder="<?php echo lang('other_info'); ?>"><?php echo isset($teacher->other_info) ?  $teacher->other_info : ''; ?></textarea>
                                            <div class="help-block"><?php echo form_error('other_info'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="photo"> <?php echo lang('photo'); ?> </label>                                           
                                                <div class="btn btn-default btn-file">
                                                <i class="fa fa-paperclip"></i> <?php echo lang('upload'); ?>
                                                <input  class="form-control col-md-7 col-xs-12"  name="photo"  id="photo"  type="file">
                                            </div>
                                            <div class="text-info"><?php echo lang('valid_file_format_img'); ?></div>
                                            <div class="help-block"><?php echo form_error('photo'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <input type="hidden" name="prev_photo" id="prev_photo" value="<?php echo $teacher->photo; ?>" />
                                            <?php if($teacher->photo){ ?>
                                            <img src="<?php echo UPLOAD_PATH; ?>teacher-photo/<?php echo $teacher->photo; ?>" alt="" width="70" /><br/><br/>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    
                                </div>
                                
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <input type="hidden" name="id" id="id" value="<?php echo $teacher->id; ?>" />
                                        <a href="<?php echo site_url('teacher/index'); ?>" class="btn btn-primary"><?php echo lang('cancel'); ?></a>
                                        <button id="send" type="submit" class="btn btn-success"><?php echo lang('update'); ?></button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>  
                        <?php } ?>
                        
                        
                        <?php if(isset($detail)){ ?>
                             <div class="tab-pane fade in active" id="tab_view_teacher">
                                <div class="x_content"> 
                                  <?php ci()->load->view('get-single-teacher'); ?>
                                </div>
                             </div>
                        <?php } ?>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade bs-teacher-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title"><?php echo lang('detail_information'); ?></h4>
        </div>
        <div class="modal-body fn_teacher_data">
            
        </div>       
      </div>
    </div>
</div>
<script type="text/javascript">
         
    function get_teacher_modal(teacher_id){
         
        $('.fn_teacher_data').html('<p style="padding: 20px;"><p style="padding: 20px;text-align:center;"><img src="<?php echo IMG_URL; ?>loading.gif" /></p>');
        $.ajax({       
          type   : "POST",
          url    : "<?php echo site_url('teacher/get_single_teacher'); ?>",
          data   : {teacher_id : teacher_id},  
          success: function(response){                                                   
             if(response)
             {
                $('.fn_teacher_data').html(response);
             }
          }
       });
    }
</script>
  

<!-- datatable with buttons -->
<link href="<?php echo VENDOR_URL; ?>datepicker/datepicker.css" rel="stylesheet">
 <script src="<?php echo VENDOR_URL; ?>datepicker/datepicker.js"></script>
 
 
 
 
<!-- Super admin js START  -->
 <script type="text/javascript">
     
    $("document").ready(function() {
         <?php if(isset($edit) && !empty($edit)){ ?>
            $(".fn_branch_id").trigger('change');
         <?php } ?>
    });
     
    $('.fn_branch_id').on('change', function(){
      
        var branch_id = $(this).val();       
        var salary_grade_id = '';
        <?php if(isset($edit) && !empty($edit)){ ?>         
            salary_grade_id =  '<?php echo $teacher->salary_grade_id; ?>';
         <?php } ?> 
        
        if(!branch_id){
           toastr.error('<?php echo lang('select_branch'); ?>');
           return false;
        }
        
         $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_salary_grade_by_school'); ?>",
            data   : { branch_id:branch_id, salary_grade_id:salary_grade_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {    
                   if(salary_grade_id){
                       $('#edit_salary_grade_id').html(response);
                   }else{
                       $('#add_salary_grade_id').html(response); 
                   }
               }
            }
        }); 
        
     
    }); 
    
    
    $('#fn_display_order').on('click', function(){
    
       var branch_id = $('#filter_branch_id').val();   
       
       <?php if(ci()->session->userdata('role_id') != SUPER_ADMIN){ ?>
           branch_id = '<?php echo ci()->session->userdata('role_id'); ?>';
       <?php } ?> 
           
       if(!branch_id){
           toastr.error('<?php echo lang('select_branch'); ?>');
           return false;
       }
       var ids = '';
       var orders = '';
        $("input[name^='display_order']").each(function() {
            orders += $(this).val()+',';
            ids += $(this).attr('itemid')+',';
        });
             
       
       $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('teacher/update_display_order'); ?>",
            data   : { branch_id:branch_id, ids:ids, orders:orders },               
            async  : false,
            success: function(response){                                                   
               if(response)
               {    
                    toastr.success('<?php echo lang('update_success'); ?>');                    
                    location.reload();
               }else{
                    toastr.error('<?php echo lang('update_failed'); ?>');
                    return false;
               }
            }
        }); 
       
       
    }); 

    
  </script>
  <!-- Super admin js end -->
  
 
<!-- datatable with buttons -->
 <script type="text/javascript">
     
    var currentDate = new Date();
    $('#add_dob').datepicker({ startView: 2, endDate: "currentDate", maxDate: currentDate });
    $('#add_joining_date').datepicker({endDate: "currentDate", maxDate: currentDate });
    $('#edit_dob').datepicker({ startView: 2, endDate: "currentDate", maxDate: currentDate });
    $('#edit_joining_date').datepicker({ endDate: "currentDate", maxDate: currentDate });
    
        $(document).ready(function() {
          $('#datatable-responsive').DataTable({
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
        
    $("#add").validate();     
    $("#edit").validate();    
    
    
    function get_teacher_by_school(url){          
        if(url){
            window.location.href = url; 
        }
    }  
    
</script>