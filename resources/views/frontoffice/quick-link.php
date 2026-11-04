<span><?php echo lang('quick_link'); ?>:</span>
<?php if(has_permission(VIEW, 'frontoffice', 'purpose')){ ?>   
   <a href="<?php echo site_url('frontoffice/purpose/index'); ?>"><?php echo lang('visitor_purpose'); ?></a>
<?php } ?>
<?php if(has_permission(VIEW, 'frontoffice', 'visitor')){ ?>   
   | <a href="<?php echo site_url('frontoffice/visitor/index'); ?>"><?php echo lang('visitor_info'); ?></a>                         
<?php } ?>                                 
<?php if(has_permission(VIEW, 'frontoffice', 'calllog')){ ?>   
   | <a href="<?php echo site_url('frontoffice/calllog/index'); ?>"><?php echo lang('call_log'); ?></a>                         
<?php } ?>                                 
<?php if(has_permission(VIEW, 'frontoffice', 'dispatch')){ ?>   
   | <a href="<?php echo site_url('frontoffice/dispatch/index'); ?>"><?php echo lang('postal_dispatch'); ?></a>                        
<?php } ?>                                 
<?php if(has_permission(VIEW, 'frontoffice', 'receive')){ ?>   
   | <a href="<?php echo site_url('frontoffice/receive/index'); ?>"><?php echo lang('postal_receive'); ?></a>                        
<?php } ?>  