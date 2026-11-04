 <span><?php echo lang('quick_link'); ?>:</span>
<?php if(has_permission(VIEW, 'certificate', 'type')){ ?>
    <a href="<?php echo site_url('certificate/type/index'); ?>"><?php echo lang('certificate_type'); ?></a>
<?php } ?>
<?php if(has_permission(VIEW, 'certificate', 'certificate')){ ?>
   | <a href="<?php echo site_url('certificate/index'); ?>"><?php echo lang('generate_certificate'); ?></a>
<?php } ?>

