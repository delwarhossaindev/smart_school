<span><?php echo lang('quick_link'); ?>:</span>
<?php if(has_permission(VIEW, 'exam', 'mark')){ ?>
    <a href="<?php echo site_url('exam/mark/index'); ?>"><?php echo lang('manage_mark'); ?></a>
<?php } ?>
<?php if(has_permission(VIEW, 'exam', 'examresult')){ ?>
   | <a href="<?php echo site_url('exam/examresult/index'); ?>"><?php echo lang('exam_term_result'); ?></a>                 
<?php } ?>
<?php if(has_permission(VIEW, 'exam', 'finalresult')){ ?>
   | <a href="<?php echo site_url('exam/finalresult/index'); ?>"><?php echo lang('exam_final_result'); ?></a>                 
<?php } ?>
<?php if(has_permission(VIEW, 'exam', 'meritlist')){ ?>
   | <a href="<?php echo site_url('exam/meritlist/index'); ?>"><?php echo lang('merit_list'); ?></a>                 
<?php } ?>   
<?php if(has_permission(VIEW, 'exam', 'marksheet')){ ?>
   | <a href="<?php echo site_url('exam/marksheet/index'); ?>"><?php echo lang('mark_sheet'); ?></a>
<?php } ?>
 <?php if(has_permission(VIEW, 'exam', 'resultcard')){ ?>
   | <a href="<?php echo site_url('exam/resultcard/index'); ?>"><?php echo lang('result_card'); ?></a>
<?php } ?>   
<?php if(has_permission(VIEW, 'exam', 'resultcard') && ci()->session->userdata('role_id') != STUDENT){ ?>
   | <a href="<?php echo site_url('exam/resultcard/all'); ?>"><?php echo lang('all_result_card'); ?></a>
<?php } ?>     
<?php if(has_permission(VIEW, 'exam', 'mail')){ ?>
   | <a href="<?php echo site_url('exam/mail/index'); ?>"><?php echo lang('mark_send_by_email'); ?></a>                    
<?php } ?>
<?php if(has_permission(VIEW, 'exam', 'text')){ ?>
   | <a href="<?php echo site_url('exam/text/index'); ?>"><?php echo lang('mark_send_by_sms'); ?></a>                  
<?php } ?>
<?php if(has_permission(VIEW, 'exam', 'resultemail')){ ?>
   | <a href="<?php echo site_url('exam/resultemail/index'); ?>"> <?php echo lang('result_email'); ?></a>                    
<?php } ?>
<?php if(has_permission(VIEW, 'exam', 'resultsms')){ ?>
   | <a href="<?php echo site_url('exam/resultsms/index'); ?>"> <?php echo lang('result_sms'); ?></a>                  
<?php } ?>