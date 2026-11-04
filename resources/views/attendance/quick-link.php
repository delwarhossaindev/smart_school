 <span><?php echo lang('quick_link'); ?>:</span>
<?php if(has_permission(VIEW, 'attendance', 'student')){ ?>
    <a href="<?php echo site_url('attendance/student/index'); ?>"><?php echo lang('student_attendance'); ?></a>
<?php } ?>
 <?php if(has_permission(VIEW, 'attendance', 'teacher')){ ?>
   | <a href="<?php echo site_url('attendance/teacher/index'); ?>"><?php echo lang('teacher_attendance'); ?></a>
<?php } ?>
<?php if(has_permission(VIEW, 'attendance', 'employee')){ ?>
   | <a href="<?php echo site_url('attendance/employee/index'); ?>"><?php echo lang('employee_attendance'); ?></a>                    
<?php } ?>
<?php if(has_permission(VIEW, 'attendance', 'absentemail')){ ?>
   | <a href="<?php echo site_url('attendance/absentemail/index'); ?>"><?php echo lang('absent_email'); ?></a>                    
<?php } ?>
<?php if(has_permission(VIEW, 'attendance', 'absentsms')){ ?>
   | <a href="<?php echo site_url('attendance/absentsms/index'); ?>"><?php echo lang('absent_sms'); ?></a>                    
<?php } ?>