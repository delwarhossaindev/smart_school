<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-lock"></i><small> <?php echo lang('my_profile'); ?></small></h3>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
            
             <div class="x_content quick-link">
                <?php ci()->load->view('profile/quick-link'); ?>                  
            </div>
            
            
            <div class="x_content">
                <div class="" data-example-id="togglable-tabs">                    
                    <ul  class="nav nav-tabs bordered">
                        <li class="<?php if(isset($info)){ echo 'active'; }?>"><a href="#tab_profile"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-eye"></i> <?php echo lang('profile'); ?></a> </li>
                        <li  class="<?php if(isset($update)){ echo 'active'; }?>"><a href="#tab_update"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-pencil-square-o"></i> <?php echo lang('update'); ?></a> </li>                          
                    </ul>
                    <br/>
                    
                    <div class="tab-content">                  

                        <div  class="tab-pane fade in <?php if(isset($info)){ echo 'active'; }?>" id="tab_profile">
                            <div class="x_content">  
                                
                                <div class="col-md-12">
                                    <div class="profile_img">
                                        <?php if($profile->photo){ ?>
                                            <img src="<?php echo UPLOAD_PATH; ?>employee-photo/<?php echo $profile->photo; ?>" alt="" width="100" />
                                        <?php }else{ ?>
                                            <img class="" src="<?php echo IMG_URL; ?>default-user.png" width="100" alt="Avatar" title="Avatar">
                                        <?php } ?>
                                        <h3><?php echo $profile->name; ?></h3><br/>
                                      </div>
                                </div>                                
                                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                    <tbody>
                                        <tr>
                                            <th><?php echo lang('name'); ?></th>
                                            <td><?php echo $profile->name; ?></td>
                                            <th><?php echo lang('national_id'); ?></th>
                                            <td><?php echo $profile->national_id; ?></td>
                                        </tr>                                                                                
                                        <tr>
                                            <th><?php echo lang('email'); ?></th>
                                            <td><?php echo $profile->email; ?></td>
                                            <th><?php echo lang('phone'); ?></th>
                                            <td><?php echo $profile->phone; ?></td>
                                        </tr>                                                                                
                                        <tr>
                                            <th><?php echo lang('present_address'); ?></th>
                                            <td><?php echo $profile->present_address; ?></td>
                                            <th><?php echo lang('permanent_address'); ?></th>
                                            <td><?php echo $profile->permanent_address; ?></td>
                                        </tr>                                                                                
                                        <tr>
                                            <th><?php echo lang('gender'); ?></th>
                                            <td><?php echo lang($profile->gender); ?></td>
                                            <th><?php echo lang('blood_group'); ?></th>
                                            <td><?php echo lang($profile->blood_group); ?></td>
                                        </tr>                                                                                
                                        <tr>
                                            <th><?php echo lang('religion'); ?></th>
                                            <td><?php echo $profile->religion; ?></td>
                                            <th><?php echo lang('birth_date'); ?></th>
                                            <td><?php echo date('M j,Y', strtotime($profile->dob)); ?></td>
                                        </tr>                                                                                
                                        <tr>                                            
                                            <th><?php echo lang('other_info'); ?></th>
                                            <td><?php echo $profile->other_info; ?></td>                                        
                                            <th><?php echo lang('resume'); ?></th>
                                            <td>
                                                 <?php if($profile->resume){ ?>
                                                <a target="_blank" href="<?php echo UPLOAD_PATH; ?>employee-resume/<?php echo $profile->resume; ?>" class="btn btn-success btn-xs"><i class="fa fa-download"></i> <?php echo lang('download'); ?></a> 
                                                <?php } ?>
                                            </td>
                                        </tr>                                                                                
                                        
                                    </tbody> 
                                </table> 
                            </div>
                        </div>  

                       
                        <div class="tab-pane fade in" id="tab_update">
                           <div class="x_content"> 
                            <?php echo form_open_multipart(site_url('profile/update/'. $profile->id), array('name' => 'profile', 'id' => 'profile', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"><?php echo lang('name'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="name"  id="name" value="<?php echo isset($profile->name) ?  $profile->name : ''; ?>" placeholder="<?php echo lang('name'); ?>" required="required" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('name'); ?></div>
                                    </div>
                                </div>                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone"><?php echo lang('phone'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="phone"  id="phone" value="<?php echo isset($profile->phone) ?  $profile->phone : '' ?>" placeholder="<?php echo lang('phone'); ?>" required="required" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('phone'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="present_address"><?php echo lang('present_address'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control col-md-7 col-xs-12"  name="present_address"  id="present_address" placeholder="<?php echo lang('present_address'); ?>"><?php echo isset($profile->present_address) ?  $profile->present_address : '' ?></textarea>
                                        <div class="help-block"><?php echo form_error('present_address'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="permanent_address"><?php echo lang('permanent_address'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control col-md-7 col-xs-12"  name="permanent_address"  id="permanent_address" placeholder="<?php echo lang('permanent_address'); ?>"><?php echo isset($profile->permanent_address) ?  $profile->permanent_address : ''; ?></textarea>
                                        <div class="help-block"><?php echo form_error('permanent_address'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="gender"><?php echo lang('gender'); ?>  <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="gender"  id="gender" required="required">
                                            <option value="">--<?php echo lang('select'); ?>--</option>
                                            <?php $genders = get_genders(); ?>
                                            <?php foreach($genders as $key=>$value){ ?>
                                                <option value="<?php echo $key; ?>" <?php if($profile->gender == $key){ echo 'selected="selected"';} ?>><?php echo $value; ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="help-block"><?php echo form_error('gender'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="blood_group"><?php echo lang('blood_group'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12" name="blood_group" id="blood_group">
                                            <option value="">--<?php echo lang('select'); ?>--</option>
                                            <?php $bloods = get_blood_group(); ?>
                                            <?php foreach($bloods as $key=>$value){ ?>
                                                <option value="<?php echo $key; ?>" <?php if($profile->blood_group == $key){ echo 'selected="selected"';} ?>><?php echo $value; ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="help-block"><?php echo form_error('blood_group'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="religion"><?php echo lang('religion'); ?>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="religion"  id="religion" value="<?php echo isset($profile->religion) ?  $profile->religion : ''; ?>" placeholder="<?php echo lang('religion'); ?>"  type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('religion'); ?></div>
                                    </div>
                                </div>
                               
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"><?php echo lang('birth_date'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="dob"  id="dob" value="<?php echo isset($profile->dob) ?   date('d-m-Y', strtotime($profile->dob)) : ''; ?>" placeholder="<?php echo lang('birth_date'); ?>" required="required" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('dob'); ?></div>
                                    </div>
                                </div>                                                              
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email"><?php echo lang('email'); ?>  </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="email" id="email" value="<?php echo isset($profile->email) ?  $profile->email : ''; ?>" placeholder="<?php echo lang('email'); ?>" type="email" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('email'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"><?php echo lang('photo'); ?>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="hidden" name="prev_photo" id="prev_photo" value="<?php echo $profile->photo; ?>" />
                                        <?php if($profile->photo){ ?>
                                        <img src="<?php echo UPLOAD_PATH; ?>employee-photo/<?php echo $profile->photo; ?>" alt="" width="70" /><br/><br/>
                                        <?php } ?>
                                        
                                        <div class="btn btn-default btn-file">
                                            <i class="fa fa-paperclip"></i> <?php echo lang('upload'); ?>
                                        <input  class="form-control col-md-7 col-xs-12"  name="photo"  id="photo" type="file">
                                        </div>
                                        <div class="text-info"><?php echo lang('valid_file_format_img'); ?></div>
                                        <div class="help-block"><?php echo form_error('photo'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"><?php echo lang('resume'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="hidden" name="prev_resume" id="prev_resume" value="<?php echo $profile->resume; ?>" />
                                        <?php if($profile->resume){ ?>
                                        <a href="<?php echo UPLOAD_PATH; ?>employee-resume/<?php echo $profile->resume; ?>"  class="btn btn-success btn-xs"><i class="fa fa-download"></i> <?php echo lang('resume'); ?></a> <br/><br/>
                                        <?php } ?>
                                        <div class="btn btn-default btn-file">
                                            <i class="fa fa-paperclip"></i> <?php echo lang('upload'); ?>
                                            <input  class="form-control col-md-7 col-xs-12"  name="resume"  id="resume" type="file">
                                        </div>
                                        <div class="text-info"><?php echo lang('valid_file_format_doc'); ?></div>
                                        <div class="help-block"><?php echo form_error('resume'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="other_info"><?php echo lang('other_info'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control col-md-7 col-xs-12"  name="other_info"  id="other_info" placeholder="<?php echo lang('other_info'); ?>"><?php echo isset($profile->other_info) ?  $profile->other_info : ''; ?></textarea>
                                        <div class="help-block"><?php echo form_error('other_info'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <a href="<?php echo site_url('profile'); ?>" class="btn btn-primary"><?php echo lang('cancel'); ?></a>
                                        <input type="hidden" name="id" id="id" value="<?php echo $profile->id; ?>" />
                                        <input type="hidden" name="user_type" id="user_type" value="system_admin" />
                                        <button id="send" type="submit" class="btn btn-success"><?php echo lang('update'); ?></button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div> 
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

  <!-- bootstrap-datetimepicker -->
 <link href="<?php echo VENDOR_URL; ?>datepicker/datepicker.css" rel="stylesheet">
 <script src="<?php echo VENDOR_URL; ?>datepicker/datepicker.js"></script>
 <script type="text/javascript">
     
  $('#dob').datepicker();
  $('#joining_date').datepicker();
  $("#profile").validate();     
  </script> 