<span><?php echo lang('quick_link'); ?>:</span>                
<a href="<?php echo site_url('profile/index'); ?>"><?php echo lang('my_profile'); ?></a>
| <a href="<?php echo site_url('profile/password'); ?>"><?php echo lang('reset_password'); ?></a>

<?php if(ci()->session->userdata('role_id') == GUARDIAN){ ?>
| <a href="<?php echo site_url('guardian/invoice'); ?>"><?php echo lang('invoice'); ?></a>
| <a href="<?php echo site_url('guardian/feedback'); ?>"><?php echo lang('feedback'); ?></a>
<?php } ?>
<?php if(ci()->session->userdata('role_id') == STUDENT){ ?>
| <a href="<?php echo site_url('accounting/invoice/due'); ?>"><?php echo lang('invoice'); ?></a>
<?php } ?>

<?php if(ci()->session->userdata('role_id') != SUPER_ADMIN){ ?>  
   <?php if(has_permission(VIEW, 'usercomplain', 'usercomplain')){ ?>
       | <a href="<?php echo site_url('usercomplain/index'); ?>"><?php echo lang('complain'); ?></a>
   <?php } ?>
   <?php if(has_permission(VIEW, 'userleave', 'userleave')){ ?>
       | <a href="<?php echo site_url('userleave/index'); ?>"><?php echo lang('leave_application'); ?></a>    
   <?php } ?>
<?php } ?>                
| <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><?php echo lang('logout'); ?></a>   