<span><?php echo lang('quick_link'); ?>:</span>
<?php if(has_permission(VIEW, 'library', 'book')){ ?>
    <a href="<?php echo site_url('library/book/index'); ?>"><?php echo lang('manage_book'); ?></a>
<?php } ?>
<?php if(has_permission(VIEW, 'library', 'member')){ ?>
   | <a href="<?php echo site_url('library/member/index'); ?>"><?php echo lang('library_member'); ?></a>
<?php } ?>
<?php if(has_permission(VIEW, 'library', 'issue')){ ?>
   | <a href="<?php echo site_url('library/issue/index'); ?>"><?php echo lang('issue_and_return'); ?></a>                    
<?php } ?>
<?php if(has_permission(VIEW, 'library', 'ebook')){ ?>
   | <a href="<?php echo site_url('library/ebook/index'); ?>"><?php echo lang('e_book'); ?></a>                    
<?php } ?>  