<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-dollar"></i><small> <?php echo lang('paid_salary'); ?></small></h3>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content quick-link">
               <?php ci()->load->view('quick-link'); ?> 
                
            </div>
            
            <div class="x_content"> 
                <?php echo form_open_multipart(site_url('payroll/history/index'), array('name' => 'payment', 'id' => 'payment', 'class' => 'form-horizontal form-label-left'), ''); ?>
                <div class="row">
                  
                    <?php ci()->load->view('layout/school_list_filter'); ?>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="item form-group"> 
                            <div><?php echo lang('user_type'); ?> <span class="required"> *</span></div>
                            <select  class="form-control col-md-7 col-xs-12"  name="user_type"  id="user_type" onchange="get_user_list(this.value);" required="required">
                                <option value="">--<?php echo lang('select'); ?>--</option> 
                                <option value="employee" <?php if(isset($user_type) && $user_type == 'employee'){ echo 'selected="selected"'; } ?>><?php echo lang('employee'); ?></option>
                                <option value="teacher" <?php if(isset($user_type) && $user_type == 'teacher'){ echo 'selected="selected"'; } ?>><?php echo lang('teacher'); ?></option>
                            </select>
                            <div class="help-block"><?php echo form_error('user_type'); ?></div>
                        </div>
                    </div>  
                    
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="item form-group"> 
                            <div><?php echo lang('payment_to'); ?></div>
                            <select  class="form-control col-md-12 col-xs-12"  name="user_id"  id="user_id" >
                                <option value="">--<?php echo lang('select'); ?>--</option>                                                                                         
                            </select>
                            <div class="help-block"><?php echo form_error('user_id'); ?></div>
                        </div>
                    </div> 
                
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="form-group"><br/>
                            <button id="send" type="submit" class="btn btn-success"><?php echo lang('find'); ?></button>
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
            
            <div class="x_content">
                <div class="" data-example-id="togglable-tabs">
                    
                    <ul  class="nav nav-tabs bordered">
                        <li class="<?php if(isset($list)){ echo 'active'; }?>"><a href="#tab_grade_list"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-list-ol"></i> <?php echo lang('payment'); ?></a> </li>
                    </ul>
                    <br/>
                    
                    <div class="tab-content">
                        <div  class="tab-pane fade in <?php if(isset($list)){ echo 'active'; }?>" id="tab_grade_list" >
                            <div class="x_content">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo lang('sl_no'); ?></th>
                                        <th><?php echo lang('photo'); ?></th>                                                                    
                                        <th><?php echo lang('name'); ?></th>
                                        <th><?php echo lang('month'); ?></th>
                                        <th><?php echo lang('grade_name'); ?></th>
                                        <th><?php echo lang('salary_type'); ?></th>
                                        <th><?php echo lang('total_allowance'); ?></th>
                                        <th><?php echo lang('total_deduction'); ?></th>
                                        <th><?php echo lang('gross_salary'); ?></th>
                                        <th><?php echo lang('net_salary'); ?></th>
                                        <th><?php echo lang('action'); ?></th>                                            
                                    </tr>
                                </thead>
                                <tbody>   
                                    <?php $count = 1; if(isset($payments) && !empty($payments)){ ?>
                                        <?php foreach($payments as $obj){ ?>
                                        <?php
                                        $path = '';
                                        if($user_type == 'teacher'){ $path = 'teacher'; }                                           
                                        else{ $path = 'employee'; }
                                        ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td>
                                                  <?php if ($obj->photo != '') { ?>                                        
                                                      <img src="<?php echo UPLOAD_PATH; ?><?php echo $obj->user_type; ?>-photo/<?php echo $obj->photo; ?>" alt="" width="60" /> 
                                                  <?php } else { ?>
                                                      <img src="<?php echo IMG_URL; ?>default-user.png" alt="" width="60" /> 
                                                  <?php } ?>
                                            </td>
                                            <td><?php echo ucfirst($obj->name); ?></td>
                                            <td><?php echo date('M, Y', strtotime('1-'.$obj->salary_month)); ?></td>
                                            <td><?php echo $obj->grade_name; ?></td>
                                            <td><?php echo $obj->salary_type; ?></td>
                                            <td><?php echo $obj->total_allowance; ?></td>
                                            <td><?php echo $obj->total_deduction; ?></td>
                                            <td><?php echo $obj->gross_salary; ?></td>
                                            <td><?php echo $obj->net_salary; ?></td>
                                            <td>
                                                <?php if(has_permission(VIEW, 'payroll', 'history')){ ?>
                                                    <a href="javascript:void(0);" class="btn btn-success btn-xs" onclick="getPaymentModal(<?php echo $obj->id; ?>, '<?php echo $obj->user_type; ?>');"  data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-eye"></i> <?php echo lang('view'); ?> </a>
                                                <?php } ?>
                                                <?php if(has_permission(DELETE, 'payroll', 'history')){ ?>
                                                    <a href="<?php echo site_url('payroll/history/delete/'.$obj->id); ?>" onclick="javascript: return confirm('<?php echo lang('confirm_alert'); ?>');" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> <?php echo lang('delete'); ?> </a>
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
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title" id="myModalLabel"><?php echo lang('detail_payment'); ?></h4>
        </div>
        <div class="modal-body"></div>       
      </div>
    </div>
</div>

 <script type="text/javascript">
    function getPaymentModal(payment_id,user_type){
         
         $('.modal-body').html('<p style="padding: 20px;"><p style="padding: 20px;text-align:center;"><img src="<?php echo IMG_URL; ?>loading.gif" /></p>');
          $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('payroll/history/get_single_payment'); ?>",
            data   : {payment_id : payment_id, user_type : user_type},  
            success: function(response){                                                   
               if(response)
               {
                  $('.modal-body').html(response);
               }
            }
         });
    }
</script>
 
<!-- datatable with buttons -->
 <script type="text/javascript">
  
     
        $(document).ready(function() {
          $('#datatable-responsive').DataTable( {
              dom: 'Bfrtip',
              iDisplayLength: 15,
              buttons: [
                  'copyHtml5',
                  'excelHtml5',
                  'csvHtml5',
                  'pdfHtml5',
                  'pageLength'
              ],
              search: true,             
              responsive: true
          });
        });

    <?php if(isset($user_type) && isset($user_id)){ ?>
        get_user_list('<?php echo $user_type; ?>', <?php echo $user_id; ?>)
    <?php } ?>
    function get_user_list(user_type, user_id){
       
       var branch_id = $('#branch_id').val(); 
       if(!branch_id){
           toastr.error('<?php echo lang('select_branch'); ?>');
           $('#user_type').prop('selectedIndex',0);
           return false;
        }
       
       $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_user_list_by_type'); ?>",
            data   : {branch_id:branch_id, user_type : user_type, user_id : user_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                   $('#user_id').html(response); 
               }
            }
        }); 
   } 
   
   $('#payment').validate();
</script>