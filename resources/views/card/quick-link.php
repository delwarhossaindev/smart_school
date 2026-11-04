 <span><?php echo lang('quick_link'); ?>:</span>                
<?php if(has_permission(VIEW, 'card', 'idsetting')){ ?>
     <a href="<?php echo site_url('card/idsetting/index'); ?>"><?php echo lang('id_card_setting'); ?></a>
<?php } ?>    
 <?php if(has_permission(VIEW, 'card', 'admitsetting')){ ?>
      |  <a href="<?php echo site_url('card/admitsetting/index'); ?>"><?php echo lang('admit_card_setting'); ?></a>
<?php } ?>                        
<?php if(has_permission(VIEW, 'card', 'schoolidsetting')){ ?>
    <a href="<?php echo site_url('card/schoolidsetting/index'); ?>"><?php echo lang('id_card_setting'); ?></a>
<?php } ?>       
<?php if(has_permission(VIEW, 'card', 'schooladmitsetting')){ ?>
      | <a href="<?php echo site_url('card/schooladmitsetting/index'); ?>"><?php echo lang('admit_card_setting'); ?></a>
<?php } ?>
<?php if(has_permission(VIEW, 'card', 'teacher')){ ?>
    | <a href="<?php echo site_url('card/teacher/index'); ?>"><?php echo lang('teacher_id_card'); ?></a>
<?php } ?>
<?php if(has_permission(VIEW, 'card', 'employee')){ ?>
   | <a href="<?php echo site_url('card/employee/index'); ?>"><?php echo lang('employee_id_card'); ?></a>
<?php } ?>
<?php if(has_permission(VIEW, 'card', 'student')){ ?>  
   | <a href="<?php echo site_url('card/student/index'); ?>"><?php echo lang('student_id_card'); ?></a>
<?php } ?>  
<?php if(has_permission(VIEW, 'card', 'admit')){ ?>  
   | <a href="<?php echo site_url('card/admit/index'); ?>"><?php echo lang('student_admit_card'); ?></a>
<?php } ?>  
