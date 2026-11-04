<span><?php echo lang('quick_link'); ?>:</span>
<?php if(has_permission(VIEW, 'accounting', 'discount')){ ?>
     <a href="<?php echo site_url('accounting/discount/index'); ?>"><?php echo lang('discount'); ?></a>                  
 <?php } ?> 

<?php if(has_permission(VIEW, 'accounting', 'feetype')){ ?>
   | <a href="<?php echo site_url('accounting/feetype/index'); ?>"><?php echo lang('fee_type'); ?></a>                  
 <?php } ?> 

 <?php if(has_permission(VIEW, 'accounting', 'invoice')){ ?>

    <?php if(ci()->session->userdata('role_id') == STUDENT || ci()->session->userdata('role_id') == GUARDIAN){ ?>
         | <a href="<?php echo site_url('accounting/invoice/due'); ?>"><?php echo lang('due_invoice'); ?></a>                    
    <?php }else{ ?>
         | <a href="<?php echo site_url('accounting/invoice/add'); ?>"><?php echo lang('fee_collection'); ?></a>
         | <a href="<?php echo site_url('accounting/invoice/index'); ?>"><?php echo lang('manage_invoice'); ?></a>
         | <a href="<?php echo site_url('accounting/invoice/due'); ?>"><?php echo lang('due_invoice'); ?></a>    
     <?php } ?> 
 <?php } ?> 

<?php if(has_permission(VIEW, 'accounting', 'receipt')){ ?>   
       | <a href="<?php echo site_url('accounting/receipt/duereceipt'); ?>"><?php echo lang('due_receipt'); ?></a>
       | <a href="<?php echo site_url('accounting/receipt/paidreceipt'); ?>"><?php echo lang('paid_receipt'); ?></a>
<?php } ?>   
 <?php if(has_permission(VIEW, 'accounting', 'duefeeemail')){ ?>
    | <a href="<?php echo site_url('accounting/duefeeemail/index'); ?>"><?php echo lang('due_fee_email'); ?></a>                  
 <?php } ?>
  <?php if(has_permission(VIEW, 'accounting', 'duefeesms')){ ?>
    | <a href="<?php echo site_url('accounting/duefeesms/index'); ?>"><?php echo lang('due_fee_sms'); ?></a>                  
 <?php } ?>         

  <?php if(has_permission(VIEW, 'accounting', 'incomehead')){ ?>
   | <a href="<?php echo site_url('accounting/incomehead/index'); ?>"><?php echo lang('income_head'); ?></a>                  
 <?php } ?> 
  <?php if(has_permission(VIEW, 'accounting', 'income')){ ?>
    | <a href="<?php echo site_url('accounting/income/index'); ?>"><?php echo lang('income'); ?></a>                     
 <?php } ?>  
 <?php if(has_permission(VIEW, 'accounting', 'exphead')){ ?>
    | <a href="<?php echo site_url('accounting/exphead/index'); ?>"><?php echo lang('expenditure_head'); ?></a>                  
 <?php } ?> 
 <?php if(has_permission(VIEW, 'accounting', 'expenditure')){ ?>
    | <a href="<?php echo site_url('accounting/expenditure/index'); ?>"><?php echo lang('expenditure'); ?></a>                  
 <?php } ?>       

