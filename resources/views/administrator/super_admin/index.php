<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-user-md"></i><small> <?php echo lang('manage_super_admin'); ?></small></h3>
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
                        
                        <li class="<?php if(isset($list)){ echo 'active'; }?>"><a href="#tab_super_admin_list"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-list-ol"></i> <?php echo lang('list'); ?></a> </li>
                        
                        <?php if(has_permission(ADD, 'hrm', 'employee')){ ?>
                            <?php if(isset($edit)){ ?>
                                <li  class="<?php if(isset($add)){ echo 'active'; }?>"><a href="<?php echo site_url('administrator/superadmin/add'); ?>"  aria-expanded="false"><i class="fa fa-plus-square-o"></i> <?php echo lang('add'); ?></a> </li>                          
                             <?php }else{ ?>
                                <li  class="<?php if(isset($add)){ echo 'active'; }?>"><a href="#tab_add_super_admin"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-plus-square-o"></i> <?php echo lang('add'); ?></a> </li>                          
                             <?php } ?>                         
                        <?php } ?>  
                                
                        <?php if(isset($edit)){ ?>
                            <li  class="active"><a href="#tab_edit_super_admin"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-pencil-square-o"></i> <?php echo lang('edit'); ?></a> </li>                          
                        <?php } ?>                            
                        
                    </ul>
                    <br/>
                    
                    <div class="tab-content">
                        <div  class="tab-pane fade in <?php if(isset($list)){ echo 'active'; }?>" id="tab_super_admin_list" >
                            <div class="x_content">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo lang('sl_no'); ?></th>                                        
                                        <th><?php echo lang('photo'); ?></th>
                                        <th><?php echo lang('name'); ?></th>
                                        <th><?php echo lang('phone'); ?></th>
                                        <th><?php echo lang('email'); ?></th>
                                        <th><?php echo lang('action'); ?></th>                                            
                                    </tr>
                                </thead>
                                <tbody>   
                                    <?php  $count = 1; if(isset($superadmins) && !empty($superadmins)){ ?>
                                        <?php foreach($superadmins as $obj){ ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>                                            
                                            <td>
                                                <?php  if($obj->photo != ''){ ?>
                                                <img src="<?php echo UPLOAD_PATH; ?>employee-photo/<?php echo $obj->photo; ?>" alt="" width="70" /> 
                                                <?php }else{ ?>
                                                <img src="<?php echo IMG_URL; ?>default-user.png" alt="" width="70" /> 
                                                <?php } ?>
                                            </td>
                                            <td><?php echo ucfirst($obj->name); ?></td>
                                            <td><?php echo $obj->phone; ?></td>
                                            <td><?php echo $obj->email; ?></td>
                                            <td>
                                                <?php if(has_permission(EDIT, 'administrator', 'superadmin')){ ?> 
                                                    <a href="<?php echo site_url('administrator/superadmin/edit/'.$obj->id); ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil-square-o"></i> <?php echo lang('edit'); ?> </a><br/>
                                                <?php } ?> 
                                                <?php if(has_permission(VIEW, 'administrator', 'superadmin')){ ?>
                                                    <a  onclick="get_super_admin_modal(<?php echo $obj->id; ?>);"  data-toggle="modal" data-target=".bs-super_admin-modal-lg"  class="btn btn-success btn-xs"><i class="fa fa-eye"></i> <?php echo lang('view'); ?> </a><br/>
                                                <?php } ?>
                                                <?php if(has_permission(DELETE, 'administrator', 'superadmin')){ ?> 
                                                    <?php if(!$obj->is_default){ ?> 
                                                        <a href="<?php echo site_url('administrator/superadmin/delete/'.$obj->id); ?>" onclick="javascript: return confirm('<?php echo lang('confirm_alert'); ?>');" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> <?php echo lang('delete'); ?> </a>
                                                    <?php } ?>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                            </div>
                        </div>

                        <div  class="tab-pane fade in <?php if(isset($add)){ echo 'active'; }?>" id="tab_add_super_admin">
                            <div class="x_content"> 
                               <?php echo form_open_multipart(site_url('administrator/superadmin/add'), array('name' => 'add', 'id' => 'add', 'class'=>'form-horizontal form-label-left'), ''); ?>
                              
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
                                            <label for="phone"><?php echo lang('phone'); ?> <span class="required">*</span></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="phone"  id="phone" value="<?php echo isset($post['phone']) ?  $post['phone'] : ''; ?>" placeholder="<?php echo lang('phone'); ?>" required="required" type="number" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('phone'); ?></div> 
                                        </div>
                                    </div>
                                                                    
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="gender"><?php echo lang('gender'); ?> <span class="required">*</span></label>
                                             <select  class="form-control col-md-7 col-xs-12"  name="gender"  id="gender" required="required">
                                                <option value="">--<?php echo lang('select'); ?>--</option>
                                                <?php $genders = get_genders(); ?>
                                                <?php foreach($genders as $key=>$value){ ?>
                                                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                                <?php } ?>
                                            </select>
                                        <div class="help-block"><?php echo form_error('gender'); ?></div> 
                                        </div>
                                    </div>
                                    
                                </div> 
                                
                                <div class="row">    
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="blood_group"><?php echo lang('blood_group'); ?> </label>
                                            <select  class="form-control col-md-7 col-xs-12" name="blood_group" id="blood_group">
                                                <option value="">--<?php echo lang('select'); ?>--</option> 
                                                <?php $bloods = get_blood_group(); ?>
                                                <?php foreach($bloods as $key=>$value){ ?>
                                                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
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
                                            <label for="present_address"><?php echo lang('present_address'); ?> </label>
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
                                            <label for="role_id"><?php echo lang('role'); ?> <span class="required">*</span></label>
                                            <select  class="form-control col-md-7 col-xs-12 quick-field" name="role_id" id="role_id" required="required">
                                                <option value="">--<?php echo lang('select'); ?>--</option>
                                                <?php foreach($roles as $obj){ ?>
                                                    <?php if(in_array($obj->id, array(SUPER_ADMIN))){ ?>
                                                    <option value="<?php echo $obj->id; ?>"><?php echo $obj->name; ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                            <div class="help-block"><?php echo form_error('role_id'); ?></div>
                                        </div>
                                    </div>
                                    
                                </div>
                                
                                <div class="row">                                    
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
                                                <input  class="form-control col-md-7 col-xs-12"  name="photo"  id="photo" value="" type="file">
                                            </div>
                                            <div class="text-info"><?php echo lang('valid_file_format_img'); ?></div>
                                            <div class="help-block"><?php echo form_error('photo'); ?></div>
                                        </div>
                                    </div>                                    
                                </div>
                                
                                
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <a href="<?php echo site_url('administrator/superadmin/index'); ?>" class="btn btn-primary"><?php echo lang('cancel'); ?></a>
                                        <button id="send" type="submit" class="btn btn-success"><?php echo lang('submit'); ?></button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>                             
                            </div>
                        </div>  

                        <?php if(isset($edit)){ ?>
                        
                        <div class="tab-pane fade in active" id="tab_edit_super_admin">
                            <div class="x_content"> 
                            <?php echo form_open_multipart(site_url('administrator/superadmin/edit/'. $superadmin->id), array('name' => 'edit', 'id' => 'edit', 'class'=>'form-horizontal form-label-left'), ''); ?>
                             
                                 <div class="row">                  
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <h5  class="column-title"><strong><?php echo lang('basic_information'); ?>:</strong></h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="name"><?php echo lang('name'); ?> <span class="required">*</span></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="name"  id="name" value="<?php echo isset($superadmin->name) ?  $superadmin->name : ''; ?>" placeholder="<?php echo lang('name'); ?>" required="required" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('name'); ?></div> 
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="national_id"><?php echo lang('national_id'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="national_id"  id="national_id" value="<?php echo isset($superadmin->national_id) ?  $superadmin->national_id : ''; ?>" placeholder="<?php echo lang('national_id'); ?>" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('national_id'); ?></div> 
                                        </div>
                                    </div>
                                   
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="phone"><?php echo lang('phone'); ?> <span class="required">*</span></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="phone"  id="phone" value="<?php echo isset($superadmin->phone) ?  $superadmin->phone : ''; ?>" placeholder="<?php echo lang('phone'); ?>" required="required" type="number" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('phone'); ?></div> 
                                        </div>
                                    </div>                                    
                                
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="gender"><?php echo lang('gender'); ?> <span class="required">*</span></label>
                                             <select  class="form-control col-md-7 col-xs-12"  name="gender"  id="gender" required="required">
                                                <option value="">--<?php echo lang('select'); ?>--</option>
                                                <?php $genders = get_genders(); ?>
                                                <?php foreach($genders as $key=>$value){ ?>
                                                    <option value="<?php echo $key; ?>" <?php if($superadmin->gender == $key){ echo 'selected="selected"';} ?>><?php echo $value; ?></option>
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
                                                    <option value="<?php echo $key; ?>" <?php if($superadmin->blood_group == $key){ echo 'selected="selected"';} ?>><?php echo $value; ?></option>
                                                <?php } ?>
                                            </select>
                                        <div class="help-block"><?php echo form_error('blood_group'); ?></div> 
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="religion"><?php echo lang('religion'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="religion"  id="religion" value="<?php echo isset($superadmin->religion) ?  $superadmin->religion : ''; ?>" placeholder="<?php echo lang('religion'); ?>" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('religion'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="dob"><?php echo lang('birth_date'); ?> <span class="required">*</span></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="dob"  id="edit_dob" value="<?php echo isset($superadmin->dob) ?  date('d-m-Y', strtotime($superadmin->dob)) : ''; ?>" placeholder="<?php echo lang('birth_date'); ?>" required="required" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('dob'); ?></div>
                                        </div>
                                    </div>
                                    
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="item form-group">
                                            <label for="present_address"><?php echo lang('present_address'); ?> </label>
                                            <textarea  class="form-control col-md-7 col-xs-12 textarea-4column"  name="present_address"  id="present_address" placeholder="<?php echo lang('present_address'); ?>"><?php echo isset($superadmin->present_address) ?  $superadmin->present_address : ''; ?></textarea>
                                            <div class="help-block"><?php echo form_error('present_address'); ?></div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="item form-group">
                                            <label for="permanent_address"><?php echo lang('permanent_address'); ?></label>
                                            <textarea  class="form-control col-md-7 col-xs-12 textarea-4column"  name="permanent_address"  id="permanent_address"  placeholder="<?php echo lang('permanent_address'); ?>"><?php echo isset($superadmin->permanent_address) ?  $superadmin->permanent_address : ''; ?></textarea>
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
                                            <input  class="form-control col-md-7 col-xs-12"  name="email"  id="email" value="<?php echo isset($superadmin->email) ?  $superadmin->email :''; ?>" placeholder="<?php echo lang('email'); ?>" type="email" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('email'); ?></div>
                                        </div>
                                    </div>                                    
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="username"><?php echo lang('username'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="username"  id="username" readonly="readonly" value="<?php echo isset($superadmin->username) ?  $superadmin->username :''; ?>" placeholder="<?php echo lang('username'); ?>" required="required" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('username'); ?></div>
                                        </div>
                                    </div>                          
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="role_id"><?php echo lang('role'); ?> <span class="required">*</span></label>
                                            <select  class="form-control col-md-7 col-xs-12 quick-field" name="role_id" id="role_id" required="required">
                                                <option value="">--<?php echo lang('select'); ?>--</option>
                                                <?php foreach($roles as $obj){ ?>
                                                    <?php if(in_array($obj->id, array(SUPER_ADMIN))){ ?>
                                                        <option value="<?php echo $obj->id; ?>" <?php if($superadmin->role_id == $obj->id){ echo 'selected="selected"';} ?>><?php echo $obj->name; ?></option>
                                                    <?php } ?>
                                                <?php } ?>                                              
                                            </select>
                                            <div class="help-block"><?php echo form_error('role_id'); ?></div>
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
                                             <input type="hidden" name="prev_resume" id="prev_resume" value="<?php echo $superadmin->resume; ?>" />
                                             <?php if($superadmin->resume){ ?>
                                                <a target="_blank" class="btn btn-success" href="<?php echo UPLOAD_PATH; ?>employee-resume/<?php echo $superadmin->resume; ?>"><i class="fa fa-download"></i> <?php echo lang('download'); ?></a> <br/>
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
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="item form-group">
                                            <label for="other_info"><?php echo lang('other_info'); ?> </label>
                                            <textarea  class="form-control col-md-7 col-xs-12 textarea-4column"  name="other_info"  id="other_info" placeholder="<?php echo lang('other_info'); ?>"><?php echo isset($superadmin->other_info) ?  $superadmin->other_info : ''; ?></textarea>
                                            <div class="help-block"><?php echo form_error('other_info'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="photo"><?php echo lang('photo'); ?> </label>                                           
                                                <div class="btn btn-default btn-file">
                                                <i class="fa fa-paperclip"></i> <?php echo lang('upload'); ?>
                                                <input  class="form-control col-md-7 col-xs-12"  name="photo"  id="photo" value="" placeholder="" type="file">
                                            </div>
                                            <div class="text-info"><?php echo lang('valid_file_format_img'); ?></div>
                                            <div class="help-block"><?php echo form_error('photo'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <input type="hidden" name="prev_photo" id="prev_photo" value="<?php echo $superadmin->photo; ?>" />
                                            <?php if($superadmin->photo){ ?>
                                            <img src="<?php echo UPLOAD_PATH; ?>employee-photo/<?php echo $superadmin->photo; ?>" alt="" width="70" /><br/><br/>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    
                                </div>                 
                                
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <input type="hidden" name="id" id="edit_id" value="<?php echo $superadmin->id; ?>" />
                                        <a href="<?php echo site_url('administrator/superadmin/index'); ?>" class="btn btn-primary"><?php echo lang('cancel'); ?></a>
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


<div class="modal fade bs-super_admin-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title"><?php echo lang('detail_information'); ?></h4>
        </div>
        <div class="modal-body fn_super_admin_data">            
        </div>       
      </div>
    </div>
</div>
<script type="text/javascript">
         
    function get_super_admin_modal(super_admin_id){
         
        $('.fn_employee_data').html('<p style="padding: 20px;"><p style="padding: 20px;text-align:center;"><img src="<?php echo IMG_URL; ?>loading.gif" /></p>');
        $.ajax({       
          type   : "POST",
          url    : "<?php echo site_url('administrator/superadmin/get_single_super_admin'); ?>",
          data   : {super_admin_id : super_admin_id},  
          success: function(response){                                                   
             if(response)
             {
                $('.fn_super_admin_data').html(response);
             }
          }
       });
    }
</script>
  



<link href="<?php echo VENDOR_URL; ?>datepicker/datepicker.css" rel="stylesheet">
 <script src="<?php echo VENDOR_URL; ?>datepicker/datepicker.js"></script>
 
  
  <!-- datatable with buttons -->
  <script type="text/javascript">
 
    var currentDate = new Date();
    $('#add_dob').datepicker({ startView: 2, endDate: "currentDate", maxDate: currentDate });
    $('#edit_dob').datepicker({ startView: 2, endDate: "currentDate", maxDate: currentDate });
  
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
        
    $("#add").validate();     
    $("#edit").validate();     
</script>