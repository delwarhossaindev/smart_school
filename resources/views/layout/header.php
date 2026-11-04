<div class="top_nav">
    <div class="nav_menu">
        <nav>
            <div class="col-md-1">
                <div class="nav toggle">
                    <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                </div>
            </div>
            <div class="col-md-7 ">
                <div class="school-name">
                    <?php  if(ci()->session->userdata('role_id') != SUPER_ADMIN){ ?>
                        <?php echo ci()->session->userdata('branch_name'); ?>
                    <?php }else{ ?>
                         <?php echo ci()->global_setting->brand_title ? ci()->global_setting->brand_title : SMS; ?>
                    <?php } ?>
                </div>
            </div>
            <div class="col-md-4">
                <ul class="nav navbar-nav <?php echo ci()->global_setting->enable_rtl ? 'navbar-left' : 'navbar-right'; ?>">
                    <li class="">
                        <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <?php
                                $photo = ci()->session->userdata('photo');
                                $role_id = ci()->session->userdata('role_id');
                                $path = '';
                                if($role_id == STUDENT){ $path = 'student'; }
                                elseif($role_id == GUARDIAN){ $path = 'guardian'; }
                                elseif($role_id == TEACHER){ $path = 'teacher'; }
                                else{ $path = 'employee'; }
                            ?>
                            <?php if ($photo != '') { ?>                                        
                                <img src="<?php echo UPLOAD_PATH; ?><?php echo $path; ?>-photo/<?php echo $photo; ?>" alt="" width="60" /> 
                            <?php } else { ?>
                                <img src="<?php echo IMG_URL; ?>default-user.png" alt="" width="60" /> 
                            <?php } ?>                            
                            <?php echo ci()->session->userdata('name'); ?>
                            <span class=" fa fa-angle-down"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-usermenu pull-right">
                            <li><a href="<?php echo site_url('profile/index'); ?>"> <?php echo lang('profile'); ?></a></li>
                            <li><a href="<?php echo site_url('profile/password'); ?>"><?php echo lang('reset_password'); ?></a></li>
                            <li><a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out pull-right"></i> <?php echo lang('logout'); ?></a></li>
                        </ul>
                    </li>
                    
                    <?php $messages = get_inbox_message(); ?>
                    <?php if(isset($messages) && !empty($messages)){ ?>
                    <li role="presentation" class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-envelope-o"></i>
                            <span class="badge bg-green"><?php echo count($messages); ?></span>
                        </a>
                        <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                            
                           <?php foreach($messages as $obj){ ?> 
                            <li>
                                <?php $user = get_user_by_id($obj->sender_id); ?>
                                <a href="<?php echo site_url('message/view/'.$obj->id); ?>">
                                    <span class="image"><img src="<?php echo IMG_URL; ?>default-user.png" alt="Profile Image" /></span>
                                    <span>
                                        <span><?php echo @$user->name; ?></span>
                                        <span class="time"><?php echo get_nice_time($obj->created_at); ?></span>
                                    </span>
                                    <span class="message">
                                        <?php echo $obj->subject; ?>
                                    </span>
                                </a>
                            </li>                    
                            <?php } ?>
                            <li>
                                <div class="text-center">
                                    <a href="<?php echo site_url('message/inbox'); ?>">
                                        <strong><?php echo lang('view_all'); ?></strong>
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <?php } ?>                     
                    <?php if(ci()->global_setting->enable_frontend){ ?>
                        <li>
                            <?php if(ci()->session->userdata('role_id') != SUPER_ADMIN){ ?>                            
                                    <?php if(ci()->branch_setting->enable_frontend){ ?>
                                        <a href="<?php echo site_url(ci()->branch_setting->branch_url); ?>"><i class="fa fa-globe"></i> <?php echo lang('web'); ?></a>
                                    <?php } ?> 
                            <?php }else{ ?>  
                                <a href="<?php echo site_url(); ?>"><i class="fa fa-globe"></i> <?php echo lang('web'); ?></a>
                            <?php } ?>  
                        </li>
                    <?php } ?>  
                        <li style="display: none;"><a href="https://codecanyon.net/item/global-multi-school-management-system-express/21975378" target="_blank" style="background: red;border-radius: 50%;font-weight: bold;">Buy Now</a></li>
                </ul>
            </div>
        </nav>
    </div>
</div>

<?php if(has_permission(VIEW, 'setting', 'globalsearch') || has_permission(VIEW, 'setting', 'sessionchange')){ ?> 

    <div class="<?php echo ci()->global_setting->enable_rtl ? 'left_col' : 'right_col'; ?> fn_header_global no-print">  
    <div class="x_panel" style="padding-bottom: 2px;margin: 0px;">             
        <div class="x_content"> 
            <div class="row">               
               <?php if(has_permission(VIEW, 'setting', 'globalsearch')){ ?> 
                <div class="col-md-8 col-sm-8 col-xs-12">        

                    <div class="row">
                        <?php if (ci()->session->userdata('role_id') == SUPER_ADMIN) { ?>                
                            <div class="col-md-5 col-sm-5 col-xs-12">
                                <div class="item form-group">        
                                    <select  class="form-control col-md-7 col-xs-12" name="search_branch_id" id="search_branch_id" required="required">
                                        <option value="">--<?php echo lang('select_branch'); ?>--</option>
                                        <?php foreach (ci()->schools as $obj) { ?>
                                            <option value="<?php echo $obj->id; ?>" ><?php echo $obj->branch_name; ?></option>
                                        <?php } ?>
                                    </select>       
                                </div>
                            </div>
                        <?php } else { ?>  
                           <div class="col-md-5 col-sm-5 col-xs-12">
                               <label class="text-right" style="padding-top: 5px;"><?php echo lang('global_search'); ?></label>
                                <input type="hidden" class="" name="search_branch_id" id="search_branch_id" value="<?php echo ci()->session->userdata('branch_id'); ?>" />
                           </div>
                        <?php } ?>

                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <div class="item form-group">                                
                                <input type="text"  class="form-control col-md-7 col-xs-12"  name="global_search"  id="global_search" onkeyup="get_search(this.value);" placeholder="<?php echo lang('global_search'); ?>: <?php echo lang('student'); ?>, <?php echo lang('guardian'); ?>, <?php echo lang('teacher'); ?>, <?php echo lang('employee'); ?>" required="required">
                            </div>
                        </div>
                    </div>                       
                </div>
               <?php } ?>
                
            </div>
                        
            <!-- ====================START ======================= -->
            <div class="search_result_container"  style="position: absolute; padding-top: 1px; z-index: 999; background: #000;width: 100%; display: none;">
                <div class="row search_result" style="background: #fff; margin:0px 25px 10px  25px;">                    
                </div>
            </div>
            <!-- ====================END ======================= -->
            
        </div>
    </div>
</div>

<script type="text/javascript">
    
    //================ SEARCH ======================================================
      function get_search(keyword){        
         
        var branch_id = $('#search_branch_id').val(); 
        if(!branch_id){
           toastr.error('<?php echo lang('select_branch'); ?>');           
           return false;
        }
        
        if(!keyword){
            $('.search_result').html(''); 
            $('.search_result_container').hide(); 
            return false;
        }
        
        $('.search_result_container').show();  
        $('.search_result').html('<p style="padding: 20px;text-align:center;"><img src="<?php echo IMG_URL; ?>loading.gif" style="width: 40px;" /></p>');
        
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('dashboard/get_search'); ?>",
            data   : { branch_id : branch_id, keyword : keyword},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {                                                      
                   $('.search_result_container').show();                                     
                   $('.search_result').html(response);                                     
               }else{
                   $('.search_result_container').hide(); 
               }
            }
        }); 
    }

</script>

 <?php } ?>