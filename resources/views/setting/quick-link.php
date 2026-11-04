 <span><?php echo lang('quick_link'); ?>:</span>
<?php if(has_permission(VIEW, 'setting', 'setting')  && ci()->session->userdata('role_id') != SUPER_ADMIN){ ?>
    <a href="<?php echo site_url('setting/index'); ?>"><?php echo lang('branch_setting'); ?></a>
<?php } ?>
<?php if(has_permission(VIEW, 'setting', 'payment')){ ?>
   | <a href="<?php echo site_url('setting/payment/index'); ?>"><?php echo lang('payment_setting'); ?></a>
<?php } ?>
<?php if(has_permission(VIEW, 'setting', 'sms')){ ?>
   | <a href="<?php echo site_url('setting/sms/index'); ?>"><?php echo lang('sms_setting'); ?></a>                    
<?php } ?>                
<?php if(has_permission(VIEW, 'setting', 'emailsetting')){ ?>
   | <a href="<?php echo site_url('setting/emailsetting/index'); ?>"><?php echo lang('email_setting'); ?></a>                    
<?php } ?>  
<?php if(has_permission(VIEW, 'setting', 'openinghour')){ ?>
   | <a href="<?php echo site_url('setting/openinghour/index'); ?>"><?php echo lang('opening_hour'); ?></a>                    
<?php } ?>  