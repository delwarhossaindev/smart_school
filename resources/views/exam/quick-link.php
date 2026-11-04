<span><?php echo lang('quick_link'); ?>:</span>
<?php if(has_permission(VIEW, 'exam', 'grade')){ ?>
    <a href="<?php echo site_url('exam/grade/index'); ?>"><?php echo lang('exam_grade'); ?></a>
<?php } ?> 
<?php if(has_permission(VIEW, 'exam', 'exam')){ ?>
   | <a href="<?php echo site_url('exam/index'); ?>"><?php echo lang('exam_term'); ?></a>
<?php } ?> 
<?php if(has_permission(VIEW, 'exam', 'schedule')){ ?>
   | <a href="<?php echo site_url('exam/schedule/index'); ?>"><?php echo lang('exam_schedule'); ?></a>
<?php } ?> 
<?php if(has_permission(VIEW, 'exam', 'suggestion')){ ?>
   | <a href="<?php echo site_url('exam/suggestion/index'); ?>"><?php echo lang('exam_suggestion'); ?> </a>
<?php } ?> 
<?php if(has_permission(VIEW, 'exam', 'attendance')){ ?>
   | <a href="<?php echo site_url('exam/attendance/index'); ?>"><?php echo lang('exam_attendance'); ?></a>                    
<?php } ?> 