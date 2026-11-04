<div class="row no-print">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-calculator"></i><small> <?php echo lang('manage_due_receipt'); ?></small></h3>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
                        
            <div class="x_content quick-link no-print">
                <?php ci()->load->view('quick-link'); ?>  
            </div>
            
            <?php if(ci()->session->userdata('role_id') != STUDENT){ ?> 
                <div class="x_content no-print"> 
                    <?php echo form_open_multipart(site_url('accounting/receipt/duereceipt'), array('name' => 'duereceipt', 'id' => 'duereceipt', 'class' => 'form-horizontal form-label-left'), ''); ?>
                    <div class="row">
                        <?php $teacher_access_data = get_teacher_access_data(); ?> 
                        <?php $guardian_access_data = get_guardian_access_data('class'); ?>

                        <?php ci()->load->view('layout/school_list_filter'); ?>

                        <div class="col-md-2 col-sm-2 col-xs-12">
                            <div class="item form-group"> 
                                <div><?php echo lang('class'); ?> <span class="required">*</span></div>
                                <select  class="form-control col-md-7 col-xs-12" name="class_id" id="class_id"  required="required" onchange="get_student_by_class(this.value, '');">
                                    <option value="">--<?php echo lang('select'); ?>--</option>
                                    <?php if(isset($classes) && !empty($classes)) { ?>
                                        <?php foreach ($classes as $obj) { ?>
                                        <?php
                                            if(ci()->session->userdata('role_id') == STUDENT){
                                                if ($obj->id != ci()->session->userdata('class_id')){ continue; }
                                            }else if(ci()->session->userdata('role_id') == TEACHER){
                                              if (!in_array($obj->id, $teacher_access_data)) {continue; }
                                            }else if(ci()->session->userdata('role_id') == GUARDIAN){
                                               if (!in_array($obj->id, $guardian_access_data)) {continue; }
                                            } 
                                           ?>
                                        <option value="<?php echo $obj->id; ?>" <?php if(isset($class_id) && $class_id == $obj->id){ echo 'selected="selected"';} ?>><?php echo $obj->name; ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                                <div class="help-block"><?php echo form_error('class_id'); ?></div>
                            </div>
                        </div>                       
                        <div class="col-md-2 col-sm-2 col-xs-12">
                            <div class="item form-group"> 
                                <div><?php echo lang('student'); ?></div>
                                <select  class="form-control col-md-7 col-xs-12"  name="student_id"  id="student_id">
                                    <option value="">--<?php echo lang('select_student'); ?>--</option> 
                                </select>
                                <div class="help-block"><?php echo form_error('student_id'); ?></div>
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
            <?php } ?>
            
            <div class="x_content">               
                    
                 <div class="" data-example-id="togglable-tabs">
                    
                    <ul  class="nav nav-tabs bordered">                 
                        <li  class="active"><a href="#due_invoice" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-calculator"></i> <?php echo lang('invoice_receipt'); ?></a></li>                          
                    </ul>
                    <br/>
                     <div class="tab-content">
                        <div  class="tab-pane fade in active" id="due_invoice" >
                            <div class="x_content">   
                               <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                   <thead>
                                       <tr>
                                           <th><?php echo lang('sl_no'); ?></th>
                                           <?php if(ci()->session->userdata('role_id') == SUPER_ADMIN){ ?>
                                                <th><?php echo lang('branch'); ?></th>
                                            <?php } ?>
                                           <th><?php echo lang('invoice_number'); ?></th>
                                           <th><?php echo lang('student'); ?></th>
                                           <th><?php echo lang('class'); ?></th>
                                           <th><?php echo lang('status'); ?></th>
                                           <th><?php echo lang('net_amount'); ?></th>
                                           <th><?php echo lang('action'); ?></th>                                            
                                       </tr>
                                   </thead>
                                   <tbody>   
                                       <?php $count = 1; if(isset($receipts) && !empty($receipts)){ ?>
                                           <?php foreach($receipts as $obj){ ?>
                                           <tr>
                                               <td><?php echo $count++; ?></td>
                                                <?php if(ci()->session->userdata('role_id') == SUPER_ADMIN){ ?>
                                                    <td><?php echo $obj->branch_name; ?></td>
                                                <?php } ?>
                                               <td><?php echo $obj->custom_invoice_id; ?></td>
                                               <td><?php echo $obj->student_name; ?></td>
                                               <td><?php echo $obj->class_name; ?></td>
                                               <td><?php echo get_paid_status($obj->paid_status); ?></td>
                                               <td><?php echo $obj->net_amount; ?></td>
                                               <td>
                                                  <a  onclick="get_due_receipt_modal(<?php echo $obj->branch_id; ?>,<?php echo $obj->inv_id; ?>,<?php echo $obj->class_id; ?>,<?php echo $obj->student_id; ?>);"  data-toggle="modal" data-target=".bs-receipt-modal-lg"  class="btn btn-success btn-xs"><i class="fa fa-eye"></i> <?php echo lang('view'); ?> </a>
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


<div class="modal fade bs-receipt-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header  no-print">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title"><?php echo lang('detail_information'); ?></h4>
        </div>
        <div class="modal-body fn_receipt_data">            
        </div>       
      </div>
    </div>
</div>
<script type="text/javascript">
         
    function get_due_receipt_modal(branch_id, inv_id, class_id, student_id){
         
        $('.fn_news_data').html('<p style="padding: 20px;"><p style="padding: 20px;text-align:center;"><img src="<?php echo IMG_URL; ?>loading.gif" /></p>');
        $.ajax({       
          type   : "POST",
          url    : "<?php echo site_url('accounting/receipt/get_single_due_receipt'); ?>",
          data   : {branch_id:branch_id, inv_id:inv_id, class_id:class_id, student_id:student_id},  
          success: function(response){                                                   
             if(response)
             {
                $('.fn_receipt_data').html(response);
             }
          }
       });
    }
</script>


<!-- Super admin js START  -->
<script type="text/javascript">

    $("document").ready(function () {
        <?php if (isset($branch_id) && !empty($branch_id)) { ?>
            $("#branch_id").trigger('change');
        <?php } ?>
    });

    $('#branch_id').on('change', function () {

        var branch_id = $(this).val();        
        var class_id = '';
        
        <?php if(isset($branch_id) && !empty($branch_id)){ ?>
            class_id =  '<?php echo $class_id; ?>';
         <?php } ?> 

        if (!branch_id) {
            toastr.error('<?php echo lang('select_branch'); ?>');
           return false;
        }
        
         $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_class_by_school'); ?>",
            data   : { branch_id:branch_id, class_id:class_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               { 
                   $('#class_id').html(response); 
               }
            }
        });
    });

    <?php if(isset($class_id) && isset($class_id)){ ?>
        get_student_by_class('<?php echo $class_id; ?>', '<?php echo $student_id; ?>');
    <?php } ?>
    
    function get_student_by_class(class_id, student_id){       
        
        var branch_id = $('#branch_id').val();  
        if(!branch_id){
           toastr.error('<?php echo lang('select_branch'); ?>');
           return false;
        } 
           
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_student_by_class'); ?>",
            data   : {branch_id:branch_id, class_id: class_id, student_id: student_id, is_all:true},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                  $('#student_id').html(response);
               }
            }
        });         
    }
 
</script>
<!-- Super admin js end -->


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
    
    $("#duereceipt").validate();
    
</script>