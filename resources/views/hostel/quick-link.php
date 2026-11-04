 <span><?php echo lang('quick_link'); ?>:</span>
<?php if(has_permission(VIEW, 'hostel', 'hostel')){ ?>
    <a href="<?php echo site_url('hostel/index'); ?>"><?php echo lang('manage_hostel'); ?></a>
<?php } ?>
<?php if(has_permission(VIEW, 'hostel', 'room')){ ?>
   | <a href="<?php echo site_url('hostel/room/index'); ?>"><?php echo lang('manage_room'); ?></a>
<?php } ?>
<?php if(has_permission(VIEW, 'hostel', 'member')){ ?>
   | <a href="<?php echo site_url('hostel/member/index'); ?>"><?php echo lang('hostel_member'); ?></a>                    
<?php } ?>