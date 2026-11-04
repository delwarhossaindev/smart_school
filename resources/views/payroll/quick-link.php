<span><?php echo lang('quick_link'); ?>:</span>
<?php if(has_permission(VIEW, 'payroll', 'grade')){ ?>
    <a href="<?php echo site_url('payroll/grade/index'); ?>"><?php echo lang('salary_grade'); ?></a>                   
<?php } ?>              
<?php if(has_permission(VIEW, 'payroll', 'payment')){ ?>
  | <a href="<?php echo site_url('payroll/payment/index'); ?>"><?php echo lang('pay_salary'); ?></a>                  
<?php } ?> 
<?php if(has_permission(VIEW, 'payroll', 'history')){ ?>
  | <a href="<?php echo site_url('payroll/history/index'); ?>"><?php echo lang('paid_salary'); ?></a>                  
<?php } ?> 