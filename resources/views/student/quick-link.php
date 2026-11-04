<span><?php echo lang('quick_link'); ?>:</span>
<?php if(has_permission(ADD, 'student', 'type')){ ?>
    <a href="<?php echo site_url('student/type/index'); ?>"> <?php echo lang('student_type'); ?></a>
 <?php } ?>
<?php if(has_permission(VIEW, 'student', 'student')){ ?>
   | <a href="<?php echo site_url('student/index'); ?>"><?php echo lang('manage_student'); ?></a>                    
 <?php } ?>
<?php if(has_permission(ADD, 'student', 'student')){ ?>
   | <a href="<?php echo site_url('student/add'); ?>"><?php echo lang('admit_student'); ?></a>
 <?php } ?>   
<?php if(has_permission(VIEW, 'student', 'bulk')){ ?>
   | <a href="<?php echo site_url('student/bulk/add'); ?>"><?php echo lang('bulk_admission'); ?></a>                    
<?php } ?>
<?php if(has_permission(VIEW, 'student', 'admission')){ ?>
   | <a href="<?php echo site_url('student/admission/index'); ?>"><?php echo lang('online_admission'); ?></a>                    
 <?php } ?>   
<?php if(has_permission(VIEW, 'student', 'activity')){ ?>
   | <a href="<?php echo site_url('student/activity/index'); ?>"> <?php echo lang('student_activity'); ?></a>                    
 <?php } ?>