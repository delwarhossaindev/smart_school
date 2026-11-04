<?php $arr = array('student_copy', 'school_copy', 'bank_copy'); ?> 
<?php $count = 1; $total_count = count($arr);  foreach($arr as $key=>$value){ ?>   
   <section class="content invoice profile_img layout-box">
       <!-- title row -->
      <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12 invoice-header_ text-center" style="text-align: center !important;">
               <?php if($school->logo){ ?>
                  <img src="<?php echo UPLOAD_PATH; ?>logo/<?php echo $school->logo; ?>" alt="" width="100" /> 
               <?php }else if($school->frontend_logo){ ?>
                  <img src="<?php echo UPLOAD_PATH; ?>logo/<?php echo $school->frontend_logo; ?>" alt="" width="100"/> 
               <?php }else{ ?>                                                        
                  <img src="<?php echo UPLOAD_PATH; ?>logo/<?php echo ci()->global_setting->brand_logo; ?>" alt="" width="100"/>
               <?php } ?> 
          </div>
      </div>
      <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12 invoice-header_" style="text-align: center !important;">
              <address>
                  <h3><?php echo $school->branch_name; ?></h3>
                   <?php echo $school->address; ?>
                  <br><?php echo lang('phone'); ?>: <?php echo $school->phone; ?>,
                  <?php echo lang('email'); ?>: <?php echo $school->email; ?>
              </address>
          </div>            
      </div>

      <!-- info row -->
      <div class="row invoice-info">          
          <div class="col-md-6 col-sm-6 col-xs-6 invoice-col_">                
            <address>
               <strong><?php echo lang('student'); ?>:</strong>: <?php echo $student->student_name; ?>
               <br><strong><?php echo lang('class'); ?>:</strong> <?php echo $student->class_name; ?>,
               <strong><?php echo lang('section'); ?>:</strong> <?php echo $student->section; ?>
               <br><strong><?php echo lang('phone'); ?>:</strong> <?php echo $student->phone; ?>
            </address>
          </div>
          <!-- /.col -->
          <div class="col-md-6 col-sm-6 col-xs-6 invoice-col">
            <address>
               <strong><?php echo lang('invoice'); ?>: </strong> #<?php echo $invoice->custom_invoice_id; ?>                                                     
               <br><strong><?php echo lang('status'); ?>:</strong> <?php echo get_paid_status($invoice->paid_status); ?>
               <br><strong><?php echo lang('date'); ?>:</strong> <?php echo date(ci()->global_setting->date_format, strtotime($invoice->date)); ?>
            </address>
          </div>
          <!-- /.col -->
      </div>   
      <div class="row">
           <div class="col-md-12 col-sm-12 col-xs-12 invoice-header_" style="text-align: center !important;">
               <address>
                   <h4><span  class="btn-info" style="border-radius: 3px;padding: 4px 6px;"><?php  echo lang($value); ?></span></h4>                                     
               </address>
           </div>            
       </div>
   </section>    
   <section class="content invoice"> 
       <!-- Table row -->
       <div class="row">
           <div class="col-xs-12 table">
               <table class="table table-striped">
                   <thead>
                       <tr>
                           <th><?php echo lang('sl_no'); ?></th>
                           <th><?php echo lang('fee_type'); ?></th>
                           <th><?php echo lang('gross_amount'); ?></th>
                           <th><?php echo lang('discount'); ?></th>
                           <th><?php echo lang('net_amount'); ?></th>
                       </tr>
                   </thead>
                   <tbody> 
                       <?php if(isset($receipt_items) && !empty($receipt_items)){ ?>
                           <?php $counter = 1; foreach($receipt_items as $item){ ?>
                           <tr>
                               <td  style="width:10%"><?php echo $counter++; ?></td>
                               <td  style="width:25%"> <?php echo $item->title; ?></td>
                               <td> <?php echo $school->currency_symbol; ?><?php echo number_format($item->gross_amount,2); ?></td>
                               <td><?php echo $school->currency_symbol; ?><?php echo number_format($item->discount,2); ?></td>
                               <td><?php echo $school->currency_symbol; ?><?php echo number_format($item->net_amount, 2); ?></td>
                           </tr> 
                           <?php } ?>
                       <?php } ?>
                   </tbody>
               </table>
           </div>
           <!-- /.col -->
       </div>

       <div class="row">
           <!-- accepted payments column -->
           <div class="col-xs-6">
               <p class="lead"><?php echo lang('payment_method'); ?>:</p>
               <img src="<?php echo IMG_URL; ?>visa.png" alt="Visa">
               <img src="<?php echo IMG_URL; ?>mastercard.png" alt="Mastercard">
               <img src="<?php echo IMG_URL; ?>american-express.png" alt="American Express">
               <img src="<?php echo IMG_URL; ?>paypal.png" alt="Paypal">                       
           </div>
           <!-- /.col -->
           <div class="col-xs-6">
               <div class="table-responsive">
                   <table class="table">
                       <tbody>
                           <tr>
                               <th style="width:56%"><?php echo lang('subtotal'); ?>:</th>
                               <td><?php echo $school->currency_symbol; ?><?php echo number_format($invoice->gross_amount,2); ?></td>
                           </tr>
                           <tr>
                               <th><?php echo lang('discount'); ?></th>
                               <td><?php echo $school->currency_symbol; ?><?php  echo number_format($invoice->discount,2); ?></td>
                           </tr>
                           <tr>
                               <th><?php echo lang('total'); ?>:</th>
                               <td><?php echo $school->currency_symbol; ?><?php echo number_format($invoice->net_amount,2); ?></td>
                           </tr>
                           <tr>
                               <th><?php echo lang('paid_amount'); ?>:</th>
                               <td><?php echo $school->currency_symbol; ?><?php echo $paid_amount ? number_format($paid_amount,2) : 0.00; ?></td>
                           </tr>
                           <tr>
                               <th><?php echo lang('due_amount'); ?>:</th>
                               <td><span class="btn-danger" style="padding: 5px;border-radius: 4px;"><?php echo $school->currency_symbol; ?><?php echo number_format($invoice->net_amount-$paid_amount,2); ?></span></td>
                           </tr>                       
                       </tbody>
                   </table>
               </div>
           </div>
           <!-- /.col -->
       </div>
       <!-- /.row -->

        <div class="row">
            <div class="col-xs-12"></div>
        </div>
       <!-- /.row -->
       <div class="row">       
           <p class="white text-center">
                <?php if(isset(ci()->branch_setting->footer) && ci()->branch_setting->footer != ''){ ?>
                   <?php echo ci()->branch_setting->footer; ?>
                <?php }else{ ?>
                   <?php echo ci()->global_setting->brand_footer ? ci()->global_setting->brand_footer : 'Copyright © '. date('Y').' <a target="_blank" href="https://codecanyon.net/user/codetroopers">Codetroopers Team.</a> All rights reserved.'; ?> 
                <?php } ?>
           </p> 
       </div>

   </section>  

<?php if($count < $total_count){ ?>
       <hr/><div class="pagebreak">&nbsp;</div> 
    <?php } ?>
 <?php $count++; } ?>   
       
<!-- this row will not appear when printing -->
<div class="row no-print">
    <div class="col-xs-12">
        <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> <?php echo lang('print'); ?></button>
    </div>
</div>