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
                <h3><?php echo $school->branch_name; ?></h3>
                 <?php echo $school->address; ?>
                <br><?php echo lang('phone'); ?>: <?php echo $school->phone; ?>,
                <?php echo lang('email'); ?>: <?php echo $school->email; ?>              
          </div>            
      </div>
       <div class="row"><hr/></div>
      <!-- info row -->
      <div class="row invoice-info">          
          <div class="col-md-6 col-sm-6 col-xs-6 invoice-col_"> 
                <strong><?php echo lang('student'); ?>:</strong> <?php echo $invoice->name; ?>
                <br><strong><?php echo lang('class'); ?>:</strong> <?php echo $invoice->class_name; ?>
                <br><strong><?php echo lang('phone'); ?>:</strong> <?php echo $invoice->phone; ?>            
          </div>
          <!-- /.col -->
          <div class="col-md-6 col-sm-6 col-xs-6 invoice-col">             
                <strong><?php echo lang('invoice'); ?>: </strong> #<?php echo $invoice->custom_invoice_id; ?>                                                     
                <br><strong><?php echo lang('status'); ?>:</strong> <?php echo get_paid_status($invoice->paid_status); ?>
                <br><strong><?php echo lang('date'); ?>:</strong> <?php echo date(ci()->global_setting->date_format, strtotime($invoice->date)); ?>
          </div>
          <!-- /.col -->
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
                        <?php if(isset($invoice_items) && !empty($invoice_items)){ ?>
                            <?php $counter = 1; foreach($invoice_items as $item){ ?>
                            <tr>
                                <td  style="width:10%"><?php echo $counter++; ?></td>
                                <td  style="width:25%"> <?php echo $item->title; ?></td>
                                <td> <?php echo $school->currency_symbol; ?><?php echo $item->gross_amount; ?></td>
                                <td><?php echo $school->currency_symbol; ?><?php echo round($item->discount,2); ?></td>
                                <td><?php echo $school->currency_symbol; ?><?php echo round($item->net_amount, 2); ?></td>
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
                                <td><?php echo $school->currency_symbol; ?><?php echo $invoice->gross_amount; ?></td>
                            </tr>
                            <tr>
                                <th><?php echo lang('discount'); ?></th>
                                <td><?php echo $school->currency_symbol; ?><?php  echo $invoice->inv_discount; ?></td>
                            </tr>
                            <tr>
                                <th><?php echo lang('total'); ?>:</th>
                                <td><?php echo $school->currency_symbol; ?><?php echo $invoice->net_amount; ?></td>
                            </tr>
                            <tr>
                                <th><?php echo lang('paid_amount'); ?>:</th>
                                <td><?php echo $school->currency_symbol; ?><?php echo $paid_amount ? $paid_amount : 0.00; ?></td>
                            </tr>
                            <tr>
                                <th><?php echo lang('due_amount'); ?>:</th>
                                <td><span class="btn-danger" style="padding: 5px;border-radius: 4px;"><?php echo $school->currency_symbol; ?><?php echo $invoice->net_amount-$paid_amount; ?></span></td>
                            </tr>
                            <?php if($invoice->paid_status == 'paid'){ ?>
                                <tr>
                                    <th><?php echo lang('paid_date'); ?>:</th>
                                    <td><?php echo date(ci()->global_setting->date_format, strtotime($invoice->date)); ?></td>
                                </tr>
                            <?php } ?>
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
  
       
<!-- this row will not appear when printing -->
    <div class="row no-print">
        <div class="col-xs-12">
            <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> <?php echo lang('print'); ?></button>
            <?php if($invoice->paid_status != 'paid'){ ?>
                <a href="<?php echo site_url('accounting/payment/index/'.$invoice->inv_id); ?>"><button class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> <?php echo lang('pay_now'); ?></button></a>
            <?php } ?>
        </div>
    </div>