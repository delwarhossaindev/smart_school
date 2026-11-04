<span><?php echo lang('quick_link'); ?>:</span>
<?php if(has_permission(VIEW, 'administrator', 'setting')){ ?>
    <a href="<?php echo site_url('administrator/setting/index'); ?>"><?php echo lang('general_setting'); ?></a>
<?php } ?>
<?php if(has_permission(VIEW, 'administrator', 'school')){ ?>
   | <a href="<?php echo site_url('administrator/school/index'); ?>"><?php echo lang('manage_branch'); ?></a>
<?php } ?>
<?php if(has_permission(VIEW, 'administrator', 'payment')){ ?>
    | <a href="<?php echo site_url('administrator/payment/index'); ?>"><?php echo lang('payment_setting'); ?></a>
<?php } ?>                    
<?php if(has_permission(VIEW, 'administrator', 'sms')){ ?>
    | <a href="<?php echo site_url('administrator/sms/index'); ?>"><?php echo lang('sms_setting'); ?></a>
<?php } ?>      
<?php if(has_permission(VIEW, 'administrator', 'emailsetting')){ ?>
    | <a href="<?php echo site_url('administrator/emailsetting/index'); ?>"><?php echo lang('email_setting'); ?></a>
<?php } ?>      
<?php if(has_permission(VIEW, 'administrator', 'year')){ ?>
    | <a href="<?php echo site_url('administrator/year/index'); ?>"><?php echo lang('academic_year'); ?></a>
<?php } ?>                  
<?php if(has_permission(VIEW, 'administrator', 'role')){ ?>
   | <a href="<?php echo site_url('administrator/role/index'); ?>"><?php echo lang('user_role'); ?></a>
<?php } ?>
<?php if(has_permission(VIEW, 'administrator', 'permission')){ ?>
   | <a href="<?php echo site_url('administrator/permission/index'); ?>"><?php echo lang('role_permission'); ?></a>                   
<?php } ?>
<?php if(has_permission(VIEW, 'administrator', 'superadmin')){ ?>
   | <a href="<?php echo site_url('administrator/superadmin/index'); ?>"><?php echo lang('super_admin'); ?></a>                
<?php } ?>
<?php if(has_permission(VIEW, 'administrator', 'user')){ ?>
   | <a href="<?php echo site_url('administrator/user/index'); ?>"><?php echo lang('manage_user'); ?></a>                
<?php } ?>
<?php if(has_permission(EDIT, 'administrator', 'password')){ ?>
   | <a href="<?php echo site_url('administrator/password/index'); ?>"><?php echo lang('reset_user_password'); ?></a>                   
<?php } ?>                
<?php if(has_permission(EDIT, 'administrator', 'username')){ ?>
   | <a href="<?php echo site_url('administrator/username/index'); ?>"><?php echo lang('reset_username'); ?></a>                   
<?php } ?>                
<?php if(has_permission(VIEW, 'administrator', 'usercredential')){ ?>
   | <a href="<?php echo site_url('administrator/usercredential/index'); ?>"> <?php echo lang('user_credential'); ?></a>                   
<?php } ?>                
<?php if(has_permission(VIEW, 'administrator', 'activitylog')){ ?>
   | <a href="<?php echo site_url('administrator/activitylog/index'); ?>"><?php echo lang('activity_log'); ?></a>                  
<?php } ?>
<?php if(has_permission(VIEW, 'administrator', 'feedback')){ ?>
   | <a href="<?php echo site_url('administrator/feedback/index'); ?>"><?php echo lang('feedback'); ?></a>                  
<?php } ?>
<?php if(has_permission(VIEW, 'administrator', 'openinghour')){ ?>
   | <a href="<?php echo site_url('administrator/openinghour/index'); ?>"><?php echo lang('opening_hour'); ?></a>                  
<?php } ?>
<?php if(has_permission(VIEW, 'administrator', 'backup')){ ?>
   | <a href="<?php echo site_url('administrator/backup/index'); ?>"><?php echo lang('backup'); ?></a>                  
<?php } ?>