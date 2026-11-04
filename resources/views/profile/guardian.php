<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title no-print">
                <h3 class="head-title"><i class="fa fa-lock"></i><small> <?php echo lang('my_profile'); ?></small></h3>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
             <div class="x_content quick-link no-print">
                 <?php ci()->load->view('profile/quick-link'); ?>                
            </div>
            
            <div class="x_content">
                <div class="" data-example-id="togglable-tabs">
                    
                    <ul  class="nav nav-tabs bordered no-print">
                        <li class="<?php if(isset($info)){ echo 'active'; }?>"><a href="#tab_profile"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-eye"></i> <?php echo lang('profile'); ?></a> </li>
                        <li  class="<?php if(isset($update)){ echo 'active'; }?>"><a href="#tab_update"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-pencil-square-o"></i> <?php echo lang('update'); ?></a> </li>                          
                        <li  class="<?php if(isset($student)){ echo 'active'; }?>"><a href="#tab_student"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-list-ol"></i> <?php echo lang('student_list'); ?></a> </li>                          
                    </ul>
                    <br/>
                    
                    <div class="tab-content">                  

                        <div  class="tab-pane fade in <?php if(isset($info)){ echo 'active'; }?> no-print" id="tab_profile">
                            <div class="x_content">  
                                <div class="col-md-12">
                                    <div class="profile_img">
                                        <?php if($profile->photo){ ?>
                                            <img src="<?php echo UPLOAD_PATH; ?>guardian-photo/<?php echo $profile->photo; ?>" alt="" width="100" />
                                        <?php }else{ ?>
                                            <img class="" src="<?php echo IMG_URL; ?>default-user.png" width="100" alt="Avatar" title="Avatar">
                                        <?php } ?>
                                        <h3><?php echo $profile->name; ?></h3><br/>
                                      </div>
                                  </div>
                                
                                <table  class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                    <tbody>
                                        <tr>
                                            <th><?php echo lang('name'); ?></th>
                                            <td><?php echo $profile->name; ?></td>
                                            <th><?php echo lang('username'); ?></th>
                                            <td><?php echo $profile->username; ?></td>                                            
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
                                            <th><?php echo lang('religion'); ?></th>
                                            <td><?php echo $profile->religion; ?></td>
                                            <th><?php echo lang('profession'); ?></th>
                                            <td><?php echo $profile->profession; ?></td>
                                        </tr>                                                                      
                                        <tr>
                                            <th><?php echo lang('national_id'); ?></th>
                                            <td><?php echo $profile->national_id; ?></td>
                                            <th><?php echo lang('other_info'); ?></th>
                                            <td><?php echo $profile->other_info; ?></td>
                                        </tr>                                                                      
                                        <tr>                                            
                                            <th><?php echo lang('created'); ?></th>
                                            <td><?php echo  date('M j,Y', strtotime($profile->created_at)); ?></td>
                                            <th><?php echo lang('modified'); ?></th>
                                            <td><?php echo  date('M j,Y', strtotime($profile->modified_at)); ?></td>
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
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="national_id"><?php echo lang('national_id'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="national_id"  id="national_id" value="<?php echo isset($profile->national_id) ?  $profile->national_id : '' ?>" placeholder="<?php echo lang('national_id'); ?>" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('national_id'); ?></div>
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
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="profession"><?php echo lang('profession'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="profession"  id="profession" value="<?php echo isset($profile->profession) ?  $profile->profession : '' ?>" placeholder="<?php echo lang('profession'); ?>" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('profession'); ?></div>
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
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="religion"><?php echo lang('religion'); ?>  </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="religion"  id="religion" value="<?php echo isset($profile->religion) ?  $profile->religion : ''; ?>" placeholder="<?php echo lang('religion'); ?>"  type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('religion'); ?></div>
                                    </div>
                                </div>
                                                            
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email"><?php echo lang('email'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="email"  id="email" value="<?php echo isset($profile->email) ?  $profile->email : ''; ?>" placeholder="<?php echo lang('email'); ?>" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('email'); ?></div>
                                    </div>
                                </div>
                               
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="username"><?php echo lang('username'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="username"  id="username" value="<?php echo isset($profile->username) ?  $profile->username : ''; ?>" placeholder="<?php echo lang('username'); ?>" type="text" readonly="readonly" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('username'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"><?php echo lang('photo'); ?>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="hidden" name="prev_photo" id="prev_photo" value="<?php echo $profile->photo; ?>" />
                                        <?php if($profile->photo){ ?>
                                        <img src="<?php echo UPLOAD_PATH; ?>guardian-photo/<?php echo $profile->photo; ?>" alt="" width="70" /><br/><br/>
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
                                        <input type="hidden" name="user_type" id="user_type" value="guardian" />
                                        <button id="send" type="submit" class="btn btn-success"><?php echo lang('update'); ?></button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>    
                        
                        
                          <div class="tab-pane fade in no-print" id="tab_student">
                            <div class="x_content no-print">
                             <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo lang('sl_no'); ?></th>
                                        <th><?php echo lang('name'); ?></th>
                                        <th><?php echo lang('class'); ?></th>
                                        <th><?php echo lang('section'); ?></th>
                                        <th><?php echo lang('group'); ?></th>
                                        <th><?php echo lang('gender'); ?></th>
                                        <th><?php echo lang('blood_group'); ?></th>
                                        <th><?php echo lang('photo'); ?></th>
                                        <th><?php echo lang('action'); ?></th>                                            
                                    </tr>
                                </thead>
                                <tbody>   
                                    <?php  $count = 1; if(isset($students) && !empty($students)){ ?>
                                        <?php foreach($students as $obj){ ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td><?php echo ucfirst($obj->name); ?></td>
                                            <td><?php echo $obj->class_name; ?></td>
                                            <td><?php echo $obj->section; ?></td>
                                            <td><?php echo lang($obj->group); ?></td>
                                            <td><?php echo lang($obj->gender); ?></td>
                                            <td><?php echo lang($obj->blood_group); ?></td>
                                            <td>
                                                <?php  if($obj->photo != ''){ ?>
                                                <img src="<?php echo UPLOAD_PATH; ?>student-photo/<?php echo $obj->photo; ?>" alt="" width="70" /> 
                                                <?php }else{ ?>
                                                <img src="<?php echo IMG_URL; ?>default-user.png" alt="" width="70" /> 
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php if(has_permission(VIEW, 'student', 'student')){ ?>
                                                    <a onclick="get_student_modal(<?php echo $obj->id; ?>);"  data-toggle="modal" data-target=".bs-student-modal-lg" class="btn btn-success btn-xs"><i class="fa fa-eye"></i> <?php echo lang('view'); ?> </a>
                                                <?php } ?>
                                            </td>
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
        </div>
    </div>
</div>

<?php ci()->load->view('accounting/invoice/invoice-modal'); ?>  


<div class="modal fade bs-student-modal-lg no-print" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header no-print">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title"><?php echo lang('detail_information'); ?></h4>
        </div>
        <div class="modal-body fn_student_data">
            
        </div>       
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
  

<div class="modal fade bs-activity-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title"><?php echo lang('detail_information'); ?></h4>
        </div>
        <div class="modal-body fn_activity_data">
            
        </div>       
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
   
   $("#profile").validate(); 
</script>
