 <span><?php echo lang('quick_link'); ?>:</span>
<?php if(has_permission(VIEW, 'leave', 'type')){ ?>
    <a href="<?php echo site_url('leave/type/index'); ?>"> <?php echo lang('leave_type'); ?></a>
<?php } ?>
<?php if(has_permission(VIEW, 'leave', 'application')){ ?>
   | <a href="<?php echo site_url('leave/application/index'); ?>">  <?php echo lang('leave_application'); ?></a>
<?php } ?>               
<?php if(has_permission(VIEW, 'leave', 'approve')){ ?>
   | <a href="<?php echo site_url('leave/approve/index'); ?>"> <?php echo lang('approved_application'); ?> </a>
<?php } ?>               
<?php if(has_permission(VIEW, 'leave', 'waiting')){ ?>
   | <a href="<?php echo site_url('leave/waiting/index'); ?>"> <?php echo lang('waiting_application'); ?> </a>
<?php } ?>               
<?php if(has_permission(VIEW, 'leave', 'decline')){ ?>
   | <a href="<?php echo site_url('leave/decline/index'); ?>"> <?php echo lang('declined_application'); ?> </a>
<?php } ?>    