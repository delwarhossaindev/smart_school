<div class="no-print" data-example-id="togglable-tabs">
    <ul  class="nav nav-tabs bordered">
        <li class="active"><a href="#tab_guardian"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-info-circle"></i> <?php echo lang('profile'); ?></a> </li>
        <li class=""><a href="#tab_student_list"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-male"></i> <?php echo lang('student_list'); ?></a> </li>
        <li class=""><a href="#tab_invoice_list"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-dollar"></i> <?php echo lang('invoice'); ?></a> </li>
    </ul>
    <br/>
    <div class="tab-content">
        <div  class="tab-pane fade in active no-print" id="tab_guardian" >    
            <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <tbody>
                    <tr>
                        <th width=""><?php echo lang('branch_name'); ?></th>
                        <td colspan="3"><?php echo $guardian->branch_name; ?></td>                       
                    </tr>
                    <tr>                       
                        <th width="20%"><?php echo lang('name'); ?> </th>
                        <td width="30%"><?php echo $guardian->name; ?></td>
                        <th width="20%"><?php echo lang('username'); ?> </th>
                        <td width="30%"><?php echo $guardian->username; ?></td>
                    </tr>
                    
                    <tr>
                        <th><?php echo lang('national_id'); ?></th>
                        <td><?php echo $guardian->national_id; ?></td>                    
                        <th><?php echo lang('phone'); ?></th>
                        <td><?php echo $guardian->phone; ?></td>
                    </tr>
                    
                    <tr>
                        <th><?php echo lang('profession'); ?></th>
                        <td><?php echo $guardian->profession; ?></td>                    
                        <th><?php echo lang('religion'); ?></th>
                        <td><?php echo $guardian->religion; ?></td>
                    </tr>
                    
                    <tr>
                        <th><?php echo lang('present_address'); ?></th>
                        <td><?php echo $guardian->present_address; ?></td>
                        <th><?php echo lang('permanent_address'); ?></th>
                        <td><?php echo $guardian->permanent_address; ?></td>
                    </tr>
                   
                    <tr>
                        <th><?php echo lang('role'); ?></th>
                        <td><?php echo $guardian->role; ?></td>                   
                        <th><?php echo lang('email'); ?></th>
                        <td><?php echo $guardian->email; ?></td>
                    </tr>

                    <tr>
                        <th><?php echo lang('photo'); ?></th>
                        <td>
                            <?php if($guardian->photo){ ?>
                            <img class="detail-img" src="<?php echo UPLOAD_PATH; ?>guardian-photo/<?php echo $guardian->photo; ?>" alt="" width="70" /><br/><br/>
                            <?php }else{ ?>
                            <img class="detail-img" src="<?php echo IMG_URL; ?>default-user.png" alt="" width="70" /> 
                            <?php } ?> 
                        </td>                    
                        <th><?php echo lang('other_info'); ?></th>
                        <td><?php echo $guardian->other_info; ?>   </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
         <div  class="tab-pane fade in no-print" id="tab_student_list" >
            <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                   <tr>
                        <th><?php echo lang('sl_no'); ?></th>
                        <th><?php echo lang('name'); ?></th>
                        <th><?php echo lang('class'); ?></th>
                        <th><?php echo lang('section'); ?></th>
                        <th><?php echo lang('group'); ?></th>
                        <th><?php echo lang('gender'); ?></th>
                        <th><?php echo lang('blood_group'); ?></th>
                        <th><?php echo lang('photo'); ?></th>
                        <th><?php echo lang('action'); ?></th>                                            
                    </tr>
                </thead>
                 <tbody>   
                    <?php  $count = 1; if(isset($students) && !empty($students)){ ?>
                        <?php foreach($students as $obj){ ?>
                        <tr>
                            <td><?php echo $count++; ?></td>
                            <td><?php echo ucfirst($obj->name); ?></td>
                            <td><?php echo $obj->class_name; ?></td>
                            <td><?php echo $obj->section; ?></td>
                            <td><?php echo lang($obj->group); ?></td>
                            <td><?php echo lang($obj->gender); ?></td>
                            <td><?php echo lang($obj->blood_group); ?></td>
                            <td>
                                <?php  if($obj->photo != ''){ ?>
                                <img class="detail-img" src="<?php echo UPLOAD_PATH; ?>student-photo/<?php echo $obj->photo; ?>" alt="" width="70" /> 
                                <?php }else{ ?>
                                <img class="detail-img" src="<?php echo IMG_URL; ?>default-user.png" alt="" width="70" /> 
                                <?php } ?>
                            </td>
                            <td>
                                <?php if(has_permission(VIEW, 'student', 'student')){ ?>
                                    <a onclick="get_student_modal(<?php echo $obj->id; ?>);"  data-toggle="modal" data-target=".bs-student-modal-lg" class="btn btn-success btn-xs"><i class="fa fa-eye"></i> View </a>
                                <?php } ?>
                            </td>
                        </tr>
                        <?php } ?>
                    <?php } ?>
                </tbody>                   
            </table>  
        </div> 
        
          <div  class="tab-pane fade in no-print" id="tab_invoice_list" >
            <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th><?php echo lang('sl_no'); ?></th>
                        <th><?php echo lang('invoice_number'); ?></th>
                        <th><?php echo lang('student'); ?></th>
                        <th><?php echo lang('class'); ?></th>
                        <th><?php echo lang('gross_amount'); ?></th>
                        <th><?php echo lang('discount'); ?></th>
                        <th><?php echo lang('net_amount'); ?></th>
                        <th><?php echo lang('status'); ?></th>
                        <th><?php echo lang('action'); ?></th>                                            
                    </tr>
                </thead>
                 <tbody>   
                    <?php $count = 1; if(isset($invoices) && !empty($invoices)){ ?>
                        <?php foreach($invoices as $obj){ ?>
                        <tr>
                            <td><?php echo $count++; ?></td>
                            <td><?php echo $obj->custom_invoice_id; ?></td>
                            <td><?php echo $obj->student_name; ?></td>
                            <td><?php echo $obj->class_name; ?></td>
                            <td><?php echo $obj->gross_amount; ?></td>
                            <td><?php echo $obj->discount; ?></td>
                            <td><?php echo $obj->net_amount; ?></td>
                            <td><?php echo get_paid_status($obj->paid_status); ?></td>
                            <td>
                                <?php if(has_permission(VIEW, 'accounting', 'invoice')){ ?>
                                    <a  onclick="get_invoice_modal(<?php echo $obj->id; ?>);"  data-toggle="modal" data-target=".bs-invoice-modal-lg"  class="btn btn-success btn-xs"><i class="fa fa-eye"></i> <?php echo lang('view'); ?> </a>
                               <?php } ?>
                                <?php if(has_permission(DELETE, 'accounting', 'invoice')){ ?>
                                    <?php if($obj->paid_status == 'unpaid'){ ?>
                                        <a target="_blank" href="<?php echo site_url('accounting/invoice/delete/'.$obj->id); ?>" onclick="javascript: return confirm('<?php echo lang('confirm_alert'); ?>');" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> <?php echo lang('delete'); ?> </a>
                                    <?php } ?>
                                <?php } ?>
                            </td>
                        </tr>
                        <?php } ?>
                    <?php } ?>
                </tbody>                   
            </table>  
        </div>  
    </div>
</div>
    
    
