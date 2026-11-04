 <span><?php echo lang('quick_link'); ?>:</span>
<?php if(has_permission(VIEW, 'message', 'mail')){ ?>
    <a href="<?php echo site_url('message/mail/index'); ?>"><?php echo lang('manage_email'); ?></a> |
<?php } ?>
<?php if(has_permission(VIEW, 'message', 'text')){ ?>
    <a href="<?php echo site_url('message/text/index'); ?>"><?php echo lang('manage_sms'); ?></a>                    
<?php } ?>