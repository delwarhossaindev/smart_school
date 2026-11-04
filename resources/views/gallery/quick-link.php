 <span><?php echo lang('quick_link'); ?>:</span>
<?php if(has_permission(VIEW, 'gallery', 'gallery')){ ?>
    <a href="<?php echo site_url('gallery/index'); ?>"><?php echo lang('manage_gallery'); ?> </a>
<?php } ?>
<?php if(has_permission(VIEW, 'gallery', 'image')){ ?>
  |  <a href="<?php echo site_url('gallery/image/index'); ?>"><?php echo lang('manage_gallery_image'); ?></a>
<?php } ?> 