 <span><?php echo lang('quick_link'); ?>:</span>
<?php if(has_permission(VIEW, 'complain', 'type')){ ?>
    <a href="<?php echo site_url('complain/type/index'); ?>"><?php echo lang('complain_type'); ?></a>
<?php } ?>
<?php if(has_permission(VIEW, 'complain', 'complain')){ ?>
   | <a href="<?php echo site_url('complain/index'); ?>"> <?php echo lang('manage_complain'); ?></a>
<?php } ?>  
