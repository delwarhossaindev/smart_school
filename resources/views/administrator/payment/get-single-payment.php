<div class="" data-example-id="togglable-tabs">
    <ul  class="nav nav-tabs bordered">
        <li  class="active"><a href="#tab_pop_dbbl_setting"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-gear"></i> <?php echo lang('dbbl'); ?> [BD]</a> </li>                          
        <li  class=""><a href="#tab_pop_paypal_setting"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-gear"></i> <?php echo lang('paypal'); ?></a> </li>                          
        <!--<li  class=""><a href="#tab_pop_stripe_setting"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-gear"></i> <?php echo lang('stripe'); ?></a> </li>-->                          
        <li  class=""><a href="#tab_pop_pumoney_setting"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-gear"></i> <?php echo lang('payumoney'); ?></a> </li>                          
        <!--<li  class=""><a href="#tab_pop_ccavenue_setting"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-gear"></i> <?php echo lang('ccavenue'); ?></a> </li>-->                        
        <li  class=""><a href="#tab_pop_paytm_setting"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-gear"></i> <?php echo lang('paytm'); ?></a> </li>                          
        <li  class=""><a href="#tab_pop_paystack_setting"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-gear"></i> <?php echo lang('pay_stack'); ?></a> </li>                          
    </ul>
    <br/>
    
     <div class="tab-content">   
         
        <div  class="tab-pane fade in active" id="tab_pop_dbbl_setting" > 
            <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <tbody>           
                <tr>
                    <th width="30%"><?php echo lang('userid'); ?></th>
                    <td><?php echo $payment_setting->dbbl_userid; ?></td> 
                </tr>
                <tr>
                    <th ><?php echo lang('password'); ?></th>
                    <td><?php echo $payment_setting->dbbl_password; ?></td> 
                </tr>
                <tr>
                    <th ><?php echo lang('submer_name'); ?></th>
                    <td><?php echo $payment_setting->dbbl_submername; ?></td> 
                </tr>
                <tr>
                    <th ><?php echo lang('submer_id'); ?></th>
                    <td><?php echo $payment_setting->dbbl_submerid; ?></td> 
                </tr>
                <tr>
                    <th ><?php echo lang('terminal_id'); ?></th>
                    <td><?php echo $payment_setting->dbbl_terminalid; ?></td> 
                </tr>                                
                <tr>
                    <th><?php echo lang('extra_charge'); ?> (%)</th>
                    <td><?php echo $payment_setting->dbbl_extra_charge; ?></td>
                </tr> 
                 <tr>
                    <th><?php echo lang('is_demo'); ?></th>
                    <td><?php  echo $payment_setting->dbbl_demo ? lang('yes'): lang('no'); ?></td>
                </tr>
                <tr>
                    <th><?php echo lang('is_active'); ?></th>
                    <td><?php echo $payment_setting->dbbl_status ? lang('yes'): lang('no'); ?></td>
                </tr>               
               
            </tbody>
        </table>
        </div> 
         
        <div  class="tab-pane fade in " id="tab_pop_paypal_setting" > 
            <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <tbody>           
                <tr>
                    <th width="30%"><?php echo lang('paypal_email'); ?></th>
                    <td><?php echo $payment_setting->paypal_email; ?></td> 
                </tr>
                                
                <tr>
                    <th><?php echo lang('extra_charge'); ?> (%)</th>
                    <td><?php echo $payment_setting->paypal_extra_charge; ?></td>
                </tr> 
                 <tr>
                    <th><?php echo lang('is_demo'); ?></th>
                    <td><?php  echo $payment_setting->paypal_demo ? lang('yes'): lang('no'); ?></td>
                </tr>
                <tr>
                    <th><?php echo lang('is_active'); ?></th>
                    <td><?php echo $payment_setting->paypal_status ? lang('yes'): lang('no'); ?></td>
                </tr>               
               
            </tbody>
        </table>
        </div>         
         
        <div  class="tab-pane fade in display" id="tab_pop_stripe_setting" > 
            <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <tbody>           
                <tr>
                    <th width="30%"><?php echo lang('secret_key'); ?></th>
                    <td><?php echo $payment_setting->stripe_secret; ?></td> 
                </tr>         
                      
                <tr>
                    <th><?php echo lang('extra_charge'); ?> (%)</th>
                    <td><?php echo $payment_setting->stripe_extra_charge; ?></td>
                </tr> 
                 <tr>
                    <th> <?php echo lang('is_demo'); ?></th>
                    <td><?php echo $payment_setting->stripe_demo ? lang('yes') : lang('no') ?></td> 
                </tr>  
                <tr>
                    <th><?php echo lang('is_active'); ?></th>
                    <td><?php echo $payment_setting->stripe_status ? lang('yes'): lang('no'); ?></td>
                </tr> 
            </tbody>
            </table>
        </div>
         
        <div  class="tab-pane fade in" id="tab_pop_pumoney_setting" > 
            <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <tbody>           
                <tr>
                    <th width="30%"><?php echo lang('payumoney_key'); ?></th>
                    <td><?php echo $payment_setting->payumoney_key; ?></td> 
                </tr>                    
                <tr>
                    <th><?php echo lang('key_salt'); ?></th>
                    <td><?php echo $payment_setting->payumoney_salt; ?></td> 
                </tr>                    
                                 
                <tr>
                    <th><?php echo lang('extra_charge'); ?> (%)</th>
                    <td><?php echo $payment_setting->payu_extra_charge; ?></td> 
                </tr> 
                 <tr>
                    <th><?php echo lang('is_demo'); ?></th>
                    <td><?php echo $payment_setting->payumoney_demo ? lang('yes'): lang('no'); ?></td> 
                </tr>  
                <tr>
                    <th><?php echo lang('is_active'); ?></th>
                    <td><?php echo $payment_setting->payumoney_status ? lang('yes'): lang('no'); ?></td>
                </tr>               
               
            </tbody>
        </table>
        </div>
                
         
        <div  class="tab-pane fade in display" id="tab_pop_ccavenue_setting" > 
            <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <tbody>           
                <tr>
                    <th width="30%"><?php echo lang('ccavenue_key'); ?></th>
                    <td><?php echo $payment_setting->ccavenue_key; ?></td> 
                </tr>         
                <tr>
                    <th><?php echo lang('key_salt'); ?></th>
                    <td><?php echo $payment_setting->ccavenue_salt; ?></td> 
                </tr>  
                
                <tr>
                    <th><?php echo lang('extra_charge'); ?> (%)</th>
                    <td><?php echo $payment_setting->ccavenue_extra_charge; ?></td> 
                </tr>
                <tr>
                    <th><?php echo lang('is_demo'); ?></th>
                    <td><?php echo $payment_setting->ccavenue_demo  ? lang('yes'): lang('no'); ?></td> 
                </tr>  
                <tr>
                    <th><?php echo lang('is_active'); ?></th>
                    <td><?php echo $payment_setting->ccavenue_status ? lang('yes'): lang('no'); ?></td>
                </tr> 
            </tbody>
            </table>
        </div>
         
        <div  class="tab-pane fade in" id="tab_pop_paytm_setting" > 
            <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <tbody>           
                <tr>
                    <th width="30%"><?php echo lang('merchant_key'); ?></th>
                    <td><?php echo $payment_setting->paytm_merchant_key; ?></td> 
                </tr> 
                <tr>
                    <th><?php echo lang('merchant_mid'); ?></th>
                    <td><?php echo $payment_setting->paytm_merchant_mid; ?></td> 
                </tr> 
                <tr>
                    <th><?php echo lang('website'); ?></th>
                    <td><?php echo $payment_setting->paytm_merchant_website; ?></td> 
                </tr> 
                <tr>
                    <th><?php echo lang('industry_type'); ?></th>
                    <td><?php echo $payment_setting->paytm_industry_type; ?></td> 
                </tr> 
                <tr>
                    <th><?php echo lang('extra_charge'); ?> (%)</th>
                    <td><?php echo $payment_setting->paytm_extra_charge; ?></td> 
                </tr> 
                <tr>
                    <th><?php echo lang('is_demo'); ?></th>
                    <td><?php echo $payment_setting->paytm_demo ? lang('yes'): lang('no'); ?></td>
                </tr> 
                <tr>
                    <th><?php echo lang('is_active'); ?></th>
                    <td><?php echo $payment_setting->paytm_status ? lang('yes'): lang('no'); ?></td>
                </tr> 
            </tbody>
            </table>
        </div>  
         
            
        <div  class="tab-pane fade in" id="tab_pop_paystack_setting" > 
            <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <tbody>           
                <tr>
                    <th width="30%"><?php echo lang('secret_key'); ?></th>
                    <td><?php echo $payment_setting->stack_secret_key; ?></td> 
                </tr>             
                <tr>
                    <th width="40%"><?php echo lang('public_key'); ?></th>
                    <td><?php echo $payment_setting->stack_public_key; ?></td> 
                </tr>             
            
                <tr>
                    <th><?php echo lang('extra_charge'); ?> (%)</th>
                    <td><?php echo $payment_setting->stack_extra_charge; ?></td> 
                </tr> 
                <tr>
                    <th><?php echo lang('is_demo'); ?></th>
                    <td><?php echo $payment_setting->stack_demo ? lang('yes'): lang('no'); ?></td>
                </tr> 
                <tr>
                    <th><?php echo lang('is_active'); ?></th>
                    <td><?php echo $payment_setting->stack_status ? lang('yes'): lang('no'); ?></td>
                </tr> 
            </tbody>
            </table>
        </div>     
         
    </div>
</div>
