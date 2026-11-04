<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-envelope-o"></i><small> <?php echo lang('manage_opening_hour'); ?></small></h3>
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
                        <li class="<?php if(isset($list)){ echo 'active'; }?>"><a href="#tab_hour_list"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-list-ol"></i> <?php echo lang('list'); ?></a> </li>
                        <?php if(has_permission(ADD, 'administrator', 'openinghour')){ ?>
                            <?php if(isset($edit)){ ?>
                                <li  class="<?php if(isset($add)){ echo 'active'; }?>"><a href="<?php echo site_url('administrator/openinghour/add'); ?>" aria-expanded="false"><i class="fa fa-plus-square-o"></i> <?php echo lang('add'); ?></a> </li>                          
                            <?php }else{ ?>
                                <li  class="<?php if(isset($add)){ echo 'active'; }?>"><a href="#tab_add_hour"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-plus-square-o"></i> <?php echo lang('add'); ?></a> </li>                          
                            <?php } ?>     
                        <?php } ?>     
                        <?php if(isset($edit)){ ?>
                            <li  class="active"><a href="#tab_edit_hour"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-pencil-square-o"></i> <?php echo lang('edit'); ?></a> </li>                          
                        <?php } ?>  
                    </ul>
                    <br/>
                    
                    <div class="tab-content">
                        
                        <div  class="tab-pane fade in <?php if(isset($list)){ echo 'active'; }?>" id="tab_hour_list" >
                            <div class="x_content">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo lang('sl_no'); ?></th>
                                         <?php if(ci()->session->userdata('role_id') == SUPER_ADMIN){ ?>
                                            <th><?php echo lang('branch'); ?></th>
                                        <?php } ?>
                                        <th><?php echo lang('monday'); ?></th>
                                        <th><?php echo lang('tuesday'); ?></th>
                                        <th><?php echo lang('wednesday'); ?></th>
                                        <th><?php echo lang('thursday'); ?></th>
                                        <th><?php echo lang('friday'); ?></th>
                                        <th><?php echo lang('saturday'); ?></th>
                                        <th><?php echo lang('sunday'); ?></th>
                                        <th><?php echo lang('action'); ?></th>                                            
                                    </tr>
                                </thead>
                                <tbody>   
                                    <?php $count = 1; if(isset($opening_hours) && !empty($opening_hours)){ ?>
                                        <?php foreach($opening_hours as $obj){ ?>                                       
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <?php if(ci()->session->userdata('role_id') == SUPER_ADMIN){ ?>
                                                <td><?php echo $obj->branch_name; ?></td>
                                            <?php } ?>
                                            <td><?php echo $obj->monday; ?></td>
                                            <td><?php echo $obj->tuesday; ?></td>                                           
                                            <td><?php echo $obj->wednesday; ?></td>                                           
                                            <td><?php echo $obj->thursday; ?></td>                                           
                                            <td><?php echo $obj->friday; ?></td>                                           
                                            <td><?php echo $obj->saturday; ?></td>                                           
                                            <td><?php echo $obj->sunday; ?></td>                                           
                                            <td>
                                                <?php if(has_permission(VIEW, 'administrator', 'openinghour')){ ?>
                                                   <!--<a  onclick="get_opening_hour_modal(<?php echo $obj->id; ?>);"  data-toggle="modal" data-target=".bs-opening-hour-modal-lg"  class="btn btn-success btn-xs"><i class="fa fa-eye"></i> <?php echo lang('view'); ?> </a>-->
                                                <?php } ?>
                                                <?php if(has_permission(EDIT, 'administrator', 'openinghour')){ ?>
                                                    <a href="<?php echo site_url('administrator/openinghour/edit/'.$obj->id); ?>" class="btn btn-success btn-xs"><i class="fa fa-edit"></i> <?php echo lang('edit'); ?> </a>
                                                <?php } ?>
                                                <?php if(has_permission(DELETE, 'administrator', 'openinghour')){ ?>
                                                    <a href="<?php echo site_url('administrator/openinghour/delete/'.$obj->id); ?>" onclick="javascript: return confirm('<?php echo lang('confirm_alert'); ?>');" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> <?php echo lang('delete'); ?> </a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                            </div>
                        </div>

                        <div  class="tab-pane fade in <?php if(isset($add)){ echo 'active'; }?>" id="tab_add_hour">
                            <div class="x_content"> 
                               <?php echo form_open_multipart(site_url('administrator/openinghour/add'), array('name' => 'add', 'id' => 'add', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                
                                <?php ci()->load->view('layout/school_list_form'); ?>
                                                                
                                   
                                <div class="form-group"> 
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="monday"><?php echo lang('monday'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-3 col-xs-6 timepicker"  name="monday_1"  id="monday_1" value="" type="text" autocomplete="off">
                                        <span class="separate"> <=> </span>
                                        <input  class="form-control col-md-3 col-xs-6 timepicker"  name="monday_2"  id="monday_2" value="" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('monday'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="form-group"> 
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tuesday"><?php echo lang('tuesday'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-3 col-xs-6 timepicker"  name="tuesday_1"  id="tuesday_1" value="" type="text" autocomplete="off">
                                        <span class="separate"> <=> </span>
                                        <input  class="form-control col-md-3 col-xs-6 timepicker"  name="tuesday_2"  id="tuesday_2" value="" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('tuesday'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="form-group"> 
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="wednesday"><?php echo lang('wednesday'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-3 col-xs-6 timepicker"  name="wednesday_1"  id="wednesday_1" value="" type="text" autocomplete="off">
                                        <span class="separate"> <=> </span>
                                        <input  class="form-control col-md-3 col-xs-6 timepicker"  name="wednesday_2"  id="wednesday_2" value="" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('wednesday'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="form-group"> 
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="thursday"><?php echo lang('thursday'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-3 col-xs-6 timepicker"  name="thursday_1"  id="thursday_1" value="" type="text" autocomplete="off">
                                        <span class="separate"> <=> </span>
                                        <input  class="form-control col-md-3 col-xs-6 timepicker"  name="thursday_2"  id="thursday_2" value="" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('thursday'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="form-group"> 
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="friday"><?php echo lang('friday'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-3 col-xs-6 timepicker"  name="friday_1"  id="friday_1" value="" type="text" autocomplete="off">
                                        <span class="separate"> <=> </span>
                                        <input  class="form-control col-md-3 col-xs-6 timepicker"  name="friday_2"  id="friday_2" value="" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('friday'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="form-group"> 
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="saturday"><?php echo lang('saturday'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-3 col-xs-6 timepicker"  name="saturday_1"  id="saturday_1" value="" type="text" autocomplete="off">
                                        <span class="separate"> <=> </span>
                                        <input  class="form-control col-md-3 col-xs-6 timepicker"  name="saturday_2"  id="saturday_2" value="" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('saturday'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="form-group"> 
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sunday"><?php echo lang('sunday'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-3 col-xs-6 timepicker"  name="sunday_1"  id="sunday_1" value="" type="text" autocomplete="off">
                                        <span class="separate"> <=> </span>
                                        <input  class="form-control col-md-3 col-xs-6 timepicker"  name="sunday_2"  id="sunday_2" value="" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('sunday'); ?></div>
                                    </div>
                                </div>
                                
                               
                                  
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <a href="<?php echo site_url('administrator/openinghour/index'); ?>" class="btn btn-primary"><?php echo lang('cancel'); ?></a>
                                        <button id="send" type="submit" class="btn btn-success"><?php echo lang('submit'); ?></button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>  
                        
                        <div  class="tab-pane fade in <?php if(isset($edit)){ echo 'active'; }?>" id="tab_edit_hour">
                            <div class="x_content"> 
                               <?php echo form_open_multipart(site_url('administrator/openinghour/edit/'.$opening_hour->id), array('name' => 'edit', 'id' => 'edit', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                
                                <?php ci()->load->view('layout/school_list_edit_form'); ?> 
                                
                                <div class="form-group"> 
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="monday"><?php echo lang('monday'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12"> 
                                        
                                        <?php
                                           $monday = explode('-', $opening_hour->monday);
                                           $monday_1 = isset($monday[0]) ? $monday[0] : '';
                                           $monday_2 = isset($monday[1]) ? $monday[1] : '';
                                        ?>
                                        
                                        <input  class="form-control col-md-3 col-xs-6 timepicker"  name="monday_1"  id="monday_1" value="<?php if(isset($opening_hour->monday)){ echo $monday_1;} ?>" type="text" autocomplete="off">
                                        <span class="separate"> <=> </span>
                                        <input  class="form-control col-md-3 col-xs-6 timepicker"  name="monday_2"  id="monday_2" value="<?php if(isset($opening_hour->monday)){ echo $monday_2;} ?>" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('monday'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="form-group"> 
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="monday"><?php echo lang('tuesday'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12"> 
                                        
                                        <?php
                                           $tuesday = explode('-', $opening_hour->tuesday);
                                           $tuesday_1 = isset($tuesday[0]) ? $tuesday[0] : '';
                                           $tuesday_2 = isset($tuesday[1]) ? $tuesday[1] : '';
                                        ?>
                                        
                                        <input  class="form-control col-md-3 col-xs-6 timepicker"  name="tuesday_1"  id="tuesday_1" value="<?php echo $tuesday_1; ?>" type="text" autocomplete="off">
                                        <span class="separate"> <=> </span>
                                        <input  class="form-control col-md-3 col-xs-6 timepicker"  name="tuesday_2"  id="tuesday_2" value="<?php echo $tuesday_2; ?>" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('tuesday'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="form-group"> 
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="wednesday"><?php echo lang('wednesday'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12"> 
                                        
                                        <?php
                                           $wednesday = explode('-', $opening_hour->wednesday);
                                           $wednesday_1 = isset($wednesday[0]) ? $wednesday[0] : '';
                                           $wednesday_2 = isset($wednesday[1]) ? $wednesday[1] : '';
                                        ?>
                                        
                                        <input  class="form-control col-md-3 col-xs-6 timepicker"  name="wednesday_1"  id="wednesday_1" value="<?php  echo $wednesday_1; ?>" type="text" autocomplete="off">
                                        <span class="separate"> <=> </span>
                                        <input  class="form-control col-md-3 col-xs-6 timepicker"  name="wednesday_2"  id="wednesday_2" value="<?php  echo $wednesday_2; ?>" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('wednesday'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="form-group"> 
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="thursday"><?php echo lang('thursday'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12"> 
                                        
                                        <?php
                                           $thursday = explode('-', $opening_hour->thursday);
                                           $thursday_1 = isset($thursday[0]) ? $thursday[0] : '';
                                           $thursday_2 = isset($thursday[1]) ? $thursday[1] : '';
                                        ?>
                                        
                                        <input  class="form-control col-md-3 col-xs-6 timepicker"  name="thursday_1"  id="thursday_1" value="<?php echo $thursday_1; ?>" type="text" autocomplete="off">
                                        <span class="separate"> <=> </span>
                                        <input  class="form-control col-md-3 col-xs-6 timepicker"  name="thursday_2"  id="thursday_2" value="<?php echo $thursday_2; ?>" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('thursday'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="form-group"> 
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="friday"><?php echo lang('friday'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12"> 
                                        
                                        <?php
                                           $friday = explode('-', $opening_hour->friday);
                                           $friday_1 = isset($friday[0]) ? $friday[0] : '';
                                           $friday_2 = isset($friday[1]) ? $friday[1] : '';
                                        ?>
                                        
                                        <input  class="form-control col-md-3 col-xs-6 timepicker"  name="friday_1"  id="friday_1" value="<?php echo $friday_1; ?>" type="text" autocomplete="off">
                                        <span class="separate"> <=> </span>
                                        <input  class="form-control col-md-3 col-xs-6 timepicker"  name="friday_2"  id="friday_2" value="<?php echo $friday_2; ?>" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('friday'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="form-group"> 
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="saturday"><?php echo lang('saturday'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12"> 
                                        
                                        <?php
                                           $saturday = explode('-', $opening_hour->saturday);
                                           $saturday_1 = isset($saturday[0]) ? $saturday[0] : '';
                                           $saturday_2 = isset($saturday[1]) ? $saturday[1] : '';
                                        ?>
                                        
                                        <input  class="form-control col-md-3 col-xs-6 timepicker"  name="saturday_1"  id="saturday_1" value="<?php echo $saturday_1; ?>" type="text" autocomplete="off">
                                        <span class="separate"> <=> </span>
                                        <input  class="form-control col-md-3 col-xs-6 timepicker"  name="saturday_2"  id="saturday_2" value="<?php echo $saturday_2; ?>" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('saturday'); ?></div>
                                    </div>
                                </div>
                              
                                <div class="form-group"> 
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sunday"><?php echo lang('sunday'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12"> 
                                        
                                        <?php
                                           $sunday = explode('-', $opening_hour->sunday);
                                           $sunday_1 = isset($sunday[0]) ? $sunday[0] : '';
                                           $sunday_2 = isset($sunday[1]) ? $sunday[1] : '';
                                        ?>
                                        
                                        <input  class="form-control col-md-3 col-xs-6 timepicker"  name="sunday_1"  id="sunday_1" value="<?php echo $sunday_1; ?>" type="text" autocomplete="off">
                                        <span class="separate"> <=> </span>
                                        <input  class="form-control col-md-3 col-xs-6 timepicker"  name="sunday_2"  id="sunday_2" value="<?php echo $sunday_2; ?>" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('sunday'); ?></div>
                                    </div>
                                </div>
                                                                
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <input type="hidden" id="id" name="id" value="<?php if(isset($opening_hour)){ echo $opening_hour->id;} ?>"/>
                                        <a href="<?php echo site_url('administrator/openinghour/index'); ?>" class="btn btn-primary"><?php echo lang('cancel'); ?></a>
                                        <button id="send" type="submit" class="btn btn-success"><?php echo lang('update'); ?></button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>  

                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal fade bs-email-setting-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title"><?php echo lang('detail_information'); ?></h4>
        </div>
        <div class="modal-body fn_opening_hour_data">            
        </div>       
      </div>
    </div>
</div>
<script type="text/javascript">
         
    function get_opening_hour_modal(setting_id){
         
        $('.fn_opening_hour_data').html('<p style="padding: 20px;"><p style="padding: 20px;text-align:center;"><img src="<?php echo IMG_URL; ?>loading.gif" /></p>');
        $.ajax({       
          type   : "POST",
          url    : "<?php echo site_url('administrator/openinghour/get_single_opening_hour'); ?>",
          data   : {setting_id : setting_id},  
          success: function(response){                                                   
             if(response)
             {
                $('.fn_opening_hour_data').html(response);
             }
          }
       });
    }
</script>

<style type="text/css">
    .timepicker{
       width: 30%;
       margin-right: 10px;
    }
    .separate{
        float: left;
        padding-right: 10px;
        padding-top: 5px;
    }
</style>
 <link href="<?php echo VENDOR_URL; ?>timepicker/timepicker.css" rel="stylesheet">
 <script src="<?php echo VENDOR_URL; ?>timepicker/timepicker.js"></script>
  <script type="text/javascript">
  $('.timepicker').timepicker({defaultTime: ''});   
  </script>

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
      
    $("#add").validate();   
    $("#edit").validate();   
    
</script> 
