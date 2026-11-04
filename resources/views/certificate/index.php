<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-certificate"></i><small> <?php echo lang('manage_certificate'); ?></small></h3>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content quick-link">
                <?php ci()->load->view('quick-link'); ?> 
            </div>
            
            
            <div class="x_content"> 
                <?php echo form_open_multipart(site_url('certificate/index'), array('name' => 'generate', 'id' => 'generate', 'class' => 'form-horizontal form-label-left'), ''); ?>
                <div class="row">
                
                     <?php ci()->load->view('layout/school_list_filter'); ?>
                    
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="item form-group"> 
                            <div><?php echo lang('class'); ?> <span class="required">*</span></div>
                            <select  class="form-control col-md-7 col-xs-12"  name="class_id"  id="class_id" required="required">
                                <option value="">--<?php echo lang('select'); ?>--</option>  
                                <?php if(isset($classes) && !empty($classes)){ ?>
                                    <?php foreach($classes as $obj ){ ?>
                                    <option value="<?php echo $obj->id; ?>" <?php if(isset($class_id) && $class_id == $obj->id){ echo 'selected="selected"'; } ?>><?php echo $obj->name; ?></option>
                                    <?php } ?> 
                                <?php } ?> 
                            </select>
                            <div class="help-block"><?php echo form_error('class_id'); ?></div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="item form-group"> 
                            <div><?php echo lang('certificate_type'); ?> <span class="required">*</span></div>
                            <select  class="form-control col-md-7 col-xs-12"  name="certificate_id"  id="certificate_id" required="required">
                                <option value="">--<?php echo lang('select'); ?>--</option>  
                                <?php if(isset($certificates) && !empty($certificates)){ ?>
                                    <?php foreach($certificates as $obj ){ ?>
                                    <option value="<?php echo $obj->id; ?>" <?php if(isset($certificate_id) && $certificate_id == $obj->id){ echo 'selected="selected"'; } ?>><?php echo $obj->name; ?></option>
                                    <?php } ?> 
                                <?php } ?> 
                            </select>
                            <div class="help-block"><?php echo form_error('certificate_id'); ?></div>
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
                        <li  class="active"><a href="#tab_user_list" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-group"></i> <?php echo lang('student'); ?> <?php echo lang('list'); ?></a></li>                          
                    </ul>
                    <br/>
                     <div class="tab-content">
                        <div  class="tab-pane fade in active" id="tab_user_list" >
                           
                            <div class="x_content">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo lang('sl_no'); ?></th>
                                        <th><?php echo lang('photo'); ?></th>                                                                    
                                        <th><?php echo lang('name'); ?></th>
                                        <th><?php echo lang('phone'); ?></th>
                                        <th><?php echo lang('email'); ?></th>
                                        <th><?php echo lang('created'); ?></th>                                            
                                        <th><?php echo lang('action'); ?></th>                                            
                                    </tr>
                                </thead>
                                <tbody id="fn_mark">   
                                    <?php
                                    $count = 1;
                                    if (isset($students) && !empty($students)) {
                                        ?>
                                        <?php foreach ($students as $obj) { ?>
                                         
                                            <tr>
                                                <td><?php echo $count++;  ?></td>
                                                <td>
                                                    <?php if ($obj->photo != '') { ?>                                        
                                                        <img src="<?php echo UPLOAD_PATH; ?>student-photo/<?php echo $obj->photo; ?>" alt="" width="60" /> 
                                                    <?php } else { ?>
                                                        <img src="<?php echo IMG_URL; ?>default-user.png" alt="" width="60" /> 
                                                    <?php } ?>
                                                </td>
                                                <td><?php echo ucfirst($obj->name); ?></td>
                                                <td><?php echo $obj->phone; ?></td>
                                                <td><?php echo $obj->email; ?></td>   
                                                <td><?php echo date(ci()->global_setting->date_format, strtotime($obj->created_at)); ?></td>   
                                                <td>    
                                                    <?php if(has_permission(VIEW, 'certificate', 'certificate')){ ?>
                                                    <a target="_blank" href="<?php echo site_url('certificate/generate/'.$obj->branch_id.'/'.$obj->id.'/'.$class_id .'/'.$certificate_id); ?>"  class="btn btn-success btn-xs"><i class="fa fa-certificate"> <?php echo lang('generate'); ?></i></a>
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

<!-- Super admin js START  -->
 <script type="text/javascript">
     
    $("document").ready(function() {
         <?php if(isset($branch_id) && !empty($branch_id)){ ?>
            $("#branch_id").trigger('change');
         <?php } ?>
    });
     
    $('#branch_id').on('change', function(){
      
        var branch_id = $(this).val();
        var class_id = '';
        var certificate_id = '';
        <?php if(isset($branch_id) && !empty($branch_id)){ ?>
            class_id =  '<?php echo $class_id; ?>';
            certificate_id =  '<?php echo $certificate_id; ?>';
         <?php } ?> 
        
        if(!branch_id){
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

  </script>
<!-- Super admin js end -->
  

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
        
     $("#generate").validate();    
</script> 
