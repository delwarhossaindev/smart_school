<span><?php echo lang('quick_link'); ?>:</span> 
<?php if(has_permission(VIEW, 'administrator', 'smstemplate')){ ?>
   <a href="<?php echo site_url('administrator/smstemplate/index'); ?>"><?php echo lang('sms_template'); ?></a>                  
<?php } ?>   
<?php if(has_permission(VIEW, 'administrator', 'emailtemplate')){ ?>
  | <a href="<?php echo site_url('administrator/emailtemplate/index'); ?>"><?php echo lang('email_template'); ?></a>                  
<?php } ?>
