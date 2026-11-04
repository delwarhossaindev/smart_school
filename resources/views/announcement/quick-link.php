<span><?php echo lang('quick_link'); ?>:</span>
<?php if(has_permission(VIEW, 'announcement', 'notice')){ ?>
    <a href="<?php echo site_url('announcement/notice/index'); ?>"><?php echo lang('manage_notice'); ?></a>
<?php } ?>    
<?php if(has_permission(VIEW, 'announcement', 'news')){ ?>
   | <a href="<?php echo site_url('announcement/news/index'); ?>"><?php echo lang('manage_news'); ?></a>
<?php } ?>    
<?php if(has_permission(VIEW, 'announcement', 'holiday')){ ?>
   | <a href="<?php echo site_url('announcement/holiday/index'); ?>"><?php echo lang('manage_holiday'); ?></a>                    
<?php } ?>   
