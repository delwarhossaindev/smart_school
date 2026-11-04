<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-calculator"></i><small> <?php echo lang('manage_expenditure'); ?></small></h3>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
             <div class="x_content quick-link">
                <?php ci()->load->view('quick-link'); ?>   
            </div>                
           
            <div class="x_content">
                <div class="" data-example-id="togglable-tabs">
                    
                    <ul  class="nav nav-tabs bordered">
                        <li class="<?php if(isset($list)){ echo 'active'; }?>"><a href="#tab_expenditure_list"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-list-ol"></i> <?php echo lang('list'); ?></a> </li>
                        <?php if(has_permission(ADD, 'accounting', 'expenditure')){ ?>
                            <?php if(isset($edit)){ ?>
                                <li  class="<?php if(isset($add)){ echo 'active'; }?>"><a href="<?php echo site_url('accounting/expenditure/add'); ?>"  aria-expanded="false"><i class="fa fa-plus-square-o"></i> <?php echo lang('add'); ?></a> </li>                          
                             <?php }else{ ?>
                                <li  class="<?php if(isset($add)){ echo 'active'; }?>"><a href="#tab_add_expenditure"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-plus-square-o"></i> <?php echo lang('add'); ?></a> </li>                          
                             <?php } ?>
                        <?php } ?>
                        <?php if(isset($edit)){ ?>
                            <li  class="active"><a href="#tab_edit_expenditure"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-pencil-square-o"></i> <?php echo lang('edit'); ?></a> </li>                          
                        <?php } ?>   
                            
                        <li class="li-class-list">
                        <?php if(ci()->session->userdata('role_id') == SUPER_ADMIN){  ?>                                 
                             <select  class="form-control col-md-7 col-xs-12" onchange="get_exp_by_school(this.value);">
                                     <option value="<?php echo site_url('accounting/expenditure/index'); ?>">--<?php echo lang('select_branch'); ?>--</option> 
                                 <?php foreach($schools as $obj ){ ?>
                                     <option value="<?php echo site_url('accounting/expenditure/index/'.$obj->id); ?>" <?php if(isset($filter_branch_id) && $filter_branch_id == $obj->id){ echo 'selected="selected"';} ?> > <?php echo $obj->branch_name; ?></option>
                                 <?php } ?>   
                             </select>
                         <?php } ?>  
                         </li>      
                            
                    </ul>
                    <br/>
                    
                    <div class="tab-content">
                        <div  class="tab-pane fade in <?php if(isset($list)){ echo 'active'; }?>" id="tab_expenditure_list" >
                            <div class="x_content">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo lang('sl_no'); ?></th>
                                        <?php if(ci()->session->userdata('role_id') == SUPER_ADMIN){ ?>
                                            <th><?php echo lang('branch'); ?></th>
                                        <?php } ?>
                                        <th><?php echo lang('session_year'); ?></th>
                                        <th><?php echo lang('expenditure_head'); ?></th>
                                        <th><?php echo lang('expenditure_method'); ?></th>
                                        <th><?php echo lang('amount'); ?></th>
                                        <th><?php echo lang('date'); ?></th>
                                        <th><?php echo lang('action'); ?></th>                                            
                                    </tr>
                                </thead>
                                <tbody>   
                                    <?php $count = 1; if(isset($expenditures) && !empty($expenditures)){ ?>
                                        <?php foreach($expenditures as $obj){ ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <?php if(ci()->session->userdata('role_id') == SUPER_ADMIN){ ?>
                                                <td><?php echo $obj->branch_name; ?></td>
                                            <?php } ?>
                                            <td><?php echo $obj->session_year; ?></td>
                                            <td><?php echo $obj->head; ?></td>
                                            <td><?php echo lang($obj->expenditure_via); ?></td>
                                            <td><?php echo $obj->amount; ?></td>
                                            <td><?php echo date(ci()->global_setting->date_format, strtotime($obj->date)); ?></td>
                                            <td>
                                                <?php if(has_permission(VIEW, 'accounting', 'expenditure')){ ?>
                                                    <a  onclick="get_expenditure_modal(<?php echo $obj->id; ?>);"  data-toggle="modal" data-target=".bs-expenditure-modal-lg"  class="btn btn-success btn-xs"><i class="fa fa-eye"></i> <?php echo lang('view'); ?> </a>
                                                <?php } ?>
                                                    
                                                <?php if($obj->expenditure_type != 'salary'){ ?>
                                                    <?php if(has_permission(EDIT, 'accounting', 'expenditure')){ ?>
                                                        <a href="<?php echo site_url('accounting/expenditure/edit/'.$obj->id); ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil-square-o"></i> <?php echo lang('edit'); ?> </a>
                                                    <?php } ?>
                                                    <?php if(has_permission(DELETE, 'accounting', 'expenditure')){ ?>
                                                        <a href="<?php echo site_url('accounting/expenditure/delete/'.$obj->id); ?>" onclick="javascript: return confirm('<?php echo lang('confirm_alert'); ?>');" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> <?php echo lang('delete'); ?> </a>
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

                        <div  class="tab-pane fade in <?php if(isset($add)){ echo 'active'; }?>" id="tab_add_expenditure">
                            <div class="x_content"> 
                               <?php echo form_open_multipart(site_url('accounting/expenditure/add'), array('name' => 'add', 'id' => 'add', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                
                                <?php ci()->load->view('layout/school_list_form'); ?>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="expenditure_head_id"><?php echo lang('expenditure_head'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="expenditure_head_id"  id="add_expenditure_head_id" required="required" >
                                            <option value="">--<?php echo lang('select'); ?>--</option> 
                                            <?php if(isset($expenditure_heads) && !empty($expenditure_heads)){ ?>
                                                <?php foreach($expenditure_heads as $obj ){ ?>
                                                <option value="<?php echo $obj->id; ?>"  <?php echo isset($post['expenditure_head_id']) && $post['expenditure_head_id'] == $obj->id ?  'selected="selected"' : ''; ?>><?php echo $obj->title; ?></option>
                                                <?php } ?>                                            
                                            <?php } ?>                                            
                                        </select>
                                        <div class="help-block"><?php echo form_error('expenditure_head_id'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="expenditure_via"><?php echo lang('expenditure_method'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="expenditure_via"  id="add_expenditure_via" required="required" >
                                            <option value="">--<?php echo lang('select'); ?>--</option>                                             
                                            <?php if(isset($payments) && !empty($payments)){ ?>
                                                <?php foreach($payments as $key=>$value ){ ?>
                                                   <option value="<?php echo $key; ?>"  <?php echo isset($post['expenditure_via']) && $post['expenditure_via'] == $key ?  'selected="selected"' : ''; ?>><?php echo $value; ?></option>
                                                <?php } ?>                                            
                                            <?php } ?>                                            
                                        </select>
                                        <div class="help-block"><?php echo form_error('expenditure_via'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="reference"><?php echo lang('reference'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="reference"  id="reference" value="<?php echo isset($post['reference']) ?  $post['reference'] : ''; ?>" placeholder="<?php echo lang('reference'); ?>" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('reference'); ?></div>
                                    </div>
                                </div>  
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="amount"><?php echo lang('amount'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="amount"  id="amount" value="<?php echo isset($post['amount']) ?  $post['amount'] : ''; ?>" placeholder="<?php echo lang('amount'); ?>" required="required" type="number" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('amount'); ?></div>
                                    </div>
                                </div>  
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="date"><?php echo lang('date'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="date"  id="add_date" value="<?php echo isset($post['date']) ?  $post['date'] : ''; ?>" placeholder="<?php echo lang('date'); ?>" required="required" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('date'); ?></div>
                                    </div>
                                </div>  
                                
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="note"><?php echo lang('note'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control col-md-7 col-xs-12"  name="note"  id="note" placeholder="<?php echo lang('note'); ?>"><?php echo isset($post['note']) ?  $post['note'] : ''; ?></textarea>
                                        <div class="help-block"><?php echo form_error('note'); ?></div>
                                    </div>
                                </div>
                               
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <a href="<?php echo site_url('accounting/expenditure'); ?>" class="btn btn-primary"><?php echo lang('cancel'); ?></a>
                                        <button id="send" type="submit" class="btn btn-success"><?php echo lang('submit'); ?></button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>  

                        
                        <?php if(isset($edit)){ ?>
                        <div class="tab-pane fade in active" id="tab_edit_expenditure">
                            <div class="x_content"> 
                               <?php echo form_open(site_url('accounting/expenditure/edit/'.$expenditure->id), array('name' => 'edit', 'id' => 'edit', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                
                                <?php ci()->load->view('layout/school_list_edit_form'); ?>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="expenditure_head_id"><?php echo lang('expenditure_head'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="expenditure_head_id"  id="edit_expenditure_head_id" required="required">
                                            <option value="">--<?php echo lang('select'); ?>--</option> 
                                            <?php if(isset($expenditure_heads) && !empty($expenditure_heads)){ ?>
                                                <?php foreach($expenditure_heads as $obj ){ ?>
                                                <option value="<?php echo $obj->id; ?>" <?php if($expenditure->expenditure_head_id == $obj->id){ echo 'selected="selected"';} ?>><?php echo $obj->title; ?></option>
                                                <?php } ?>                                            
                                            <?php } ?>                                            
                                        </select>
                                        <div class="help-block"><?php echo form_error('expenditure_head_id'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="expenditure_via"><?php echo lang('expenditure_method'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="expenditure_via"  id="edit_expenditure_via" required="required" >
                                            <option value="">--<?php echo lang('select'); ?>--</option> 
                                            <?php if(isset($payments) && !empty($payments)){ ?>
                                                <?php foreach($payments as $key=>$value ){ ?>
                                                <option value="<?php echo $key; ?>" <?php if($expenditure->expenditure_via == $key){ echo 'selected="selected"';} ?>><?php echo $value; ?></option>
                                                <?php } ?>                                            
                                            <?php } ?>                                            
                                        </select>
                                        <div class="help-block"><?php echo form_error('expenditure_via'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="reference"><?php echo lang('reference'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="reference"  id="reference" value="<?php echo isset($expenditure->reference) ?  $expenditure->reference : ''; ?>" placeholder="<?php echo lang('reference'); ?>" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('reference'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="amount"><?php echo lang('amount'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="amount"  id="amount" value="<?php echo isset($expenditure->amount) ?  $expenditure->amount : ''; ?>" placeholder="<?php echo lang('amount'); ?>" required="required" type="number" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('amount'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="date"><?php echo lang('date'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="date"  id="edit_date" value="<?php echo isset($expenditure->date) ?  date('d-m-Y', strtotime($expenditure->date)) : ''; ?>" placeholder="<?php echo lang('date'); ?>" required="required" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('date'); ?></div>
                                    </div>
                                </div>
                             
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="note"><?php echo lang('note'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control col-md-7 col-xs-12"  name="note"  id="note" placeholder="<?php echo lang('note'); ?>"><?php echo isset($expenditure->note) ?  $expenditure->note : ''; ?></textarea>
                                        <div class="help-block"><?php echo form_error('note'); ?></div>
                                    </div>
                                </div>
                                                             
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <input type="hidden" value="<?php echo isset($expenditure) ? $expenditure->id : $id; ?>" name="id" />
                                        <a  href="<?php echo site_url('accounting/expenditure'); ?>" class="btn btn-primary"><?php echo lang('cancel'); ?></a>
                                        <button id="send" type="submit" class="btn btn-success"><?php echo lang('update'); ?></button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>  
                        <?php } ?>
                                          
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade bs-expenditure-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title"><?php echo lang('detail_information'); ?></h4>
        </div>
        <div class="modal-body fn_expenditure_data">            
        </div>       
      </div>
    </div>
</div>
<script type="text/javascript">
         
    function get_expenditure_modal(expenditure_id){
         
        $('.fn_expenditure_data').html('<p style="padding: 20px;"><p style="padding: 20px;text-align:center;"><img src="<?php echo IMG_URL; ?>loading.gif" /></p>');
        $.ajax({       
          type   : "POST",
          url    : "<?php echo site_url('accounting/expenditure/get_single_expenditure'); ?>",
          data   : {expenditure_id : expenditure_id},  
          success: function(response){                                                   
             if(response)
             {
                $('.fn_expenditure_data').html(response);
             }
          }
       });
    }
</script>


<link href="<?php echo VENDOR_URL; ?>datepicker/datepicker.css" rel="stylesheet">
 <script src="<?php echo VENDOR_URL; ?>datepicker/datepicker.js"></script>
 <script type="text/javascript">
     
  $('#add_date').datepicker();
  $('#edit_date').datepicker();
  
    $("document").ready(function() {
         <?php if(isset($edit) && !empty($edit)){ ?>
            $("#edit_branch_id").trigger('change');
         <?php } ?>
    });
     
    $('.fn_branch_id').on('change', function(){
      
        var branch_id = $(this).val();
        var expenditure_head_id = '';
        var expenditure_via = '';
        
        <?php if(isset($edit) && !empty($edit)){ ?>
            expenditure_head_id =  '<?php echo $expenditure->expenditure_head_id; ?>';
            expenditure_via =  '<?php echo $expenditure->expenditure_via; ?>';
         <?php } ?> 
        
        if(!branch_id){
           toastr.error('<?php echo lang('select_branch'); ?>');
           return false;
        }
       
       $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('accounting/expenditure/get_expenditure_head_by_school'); ?>",
            data   : { branch_id:branch_id, expenditure_head_id:expenditure_head_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {  
                   if(expenditure_head_id){
                       $('#edit_expenditure_head_id').html(response);   
                   }else{
                       $('#add_expenditure_head_id').html(response);   
                   }                                    
               }
            }
        });
        
        get_payment_method_by_school(branch_id, expenditure_via);
        
    });     
    
           
    function get_payment_method_by_school(branch_id, expenditure_via){ 
        
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('accounting/expenditure/get_payment_method_by_school'); ?>",
            data   : { branch_id : branch_id, expenditure_via : expenditure_via},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {  
                   if(expenditure_via){
                       $('#edit_expenditure_via').html(response);   
                   }else{
                       $('#add_expenditure_via').html(response);   
                   }                                 
               }
            }
        });
    }   
    
  
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
    
    $("#add").validate();     
    $("#edit").validate();
    
    function get_exp_by_school(url){          
        if(url){
            window.location.href = url; 
        }
    } 
    
</script>
