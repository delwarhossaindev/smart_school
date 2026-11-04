<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-bus"></i><small> <?php echo lang('manage_route'); ?></small></h3>
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
                        <li class="<?php if(isset($list)){ echo 'active'; }?>"><a href="#tab_route_list"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-list-ol"></i> <?php echo lang('list'); ?></a> </li>
                        <?php if(has_permission(ADD, 'transport', 'route')){ ?>
                             <?php if(isset($edit)){ ?>
                                <li  class="<?php if(isset($add)){ echo 'active'; }?>"><a href="<?php echo site_url('transport/route/add'); ?>"  aria-expanded="false"><i class="fa fa-plus-square-o"></i> <?php echo lang('add'); ?></a> </li>                          
                             <?php }else{ ?>
                                <li  class="<?php if(isset($add)){ echo 'active'; }?>"><a href="#tab_add_route"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-plus-square-o"></i> <?php echo lang('add'); ?></a> </li>                          
                             <?php } ?>
                        <?php } ?>  
                        <?php if(isset($edit)){ ?>
                            <li  class="active"><a href="#tab_edit_route"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-pencil-square-o"></i> <?php echo lang('edit'); ?></a> </li>                          
                        <?php } ?> 
                            
                        <li class="li-class-list">
                           <?php if(ci()->session->userdata('role_id') == SUPER_ADMIN){  ?>                                 
                                <select  class="form-control col-md-7 col-xs-12" onchange="get_route_by_school(this.value);">
                                        <option value="<?php echo site_url('transport/route/index'); ?>">--<?php echo lang('select_branch'); ?>--</option> 
                                    <?php foreach($schools as $obj ){ ?>
                                        <option value="<?php echo site_url('transport/route/index/'.$obj->id); ?>" <?php if(isset($filter_branch_id) && $filter_branch_id == $obj->id){ echo 'selected="selected"';} ?> > <?php echo $obj->branch_name; ?></option>
                                    <?php } ?>   
                                </select>
                            <?php } ?>  
                        </li>     
                            
                    </ul>
                    <br/>
                    
                    <div class="tab-content">
                        <div  class="tab-pane fade in <?php if(isset($list)){ echo 'active'; }?>" id="tab_route_list" >
                            <div class="x_content">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo lang('sl_no'); ?></th>
                                        <?php if(ci()->session->userdata('role_id') == SUPER_ADMIN){ ?>
                                            <th><?php echo lang('branch'); ?></th>
                                        <?php } ?>
                                        <th><?php echo lang('route_name'); ?></th>
                                        <th><?php echo lang('route_start'); ?></th>
                                        <th><?php echo lang('route_end'); ?></th>
                                        <th><?php echo lang('vehicle_for_route'); ?></th>
                                        <th><?php echo lang('action'); ?></th>                                            
                                    </tr>
                                </thead>
                                <tbody>   
                                    <?php $count = 1; if(isset($routes) && !empty($routes)){ ?>
                                        <?php foreach($routes as $obj){ ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <?php if(ci()->session->userdata('role_id') == SUPER_ADMIN){ ?>
                                                <td><?php echo $obj->branch_name; ?></td>
                                            <?php } ?>
                                            <td><?php echo $obj->title; ?></td>
                                            <td><?php echo $obj->route_start; ?></td>
                                            <td><?php echo $obj->route_end; ?></td>
                                            <td><?php echo get_vehicle_by_ids($obj->vehicle_ids); ?></td>
                                            <td>
                                                <?php if(has_permission(EDIT, 'transport', 'route')){ ?>
                                                    <a href="<?php echo site_url('transport/route/edit/'.$obj->id); ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil-square-o"></i> <?php echo lang('edit'); ?> </a>
                                                <?php } ?>
                                                <?php if(has_permission(VIEW, 'transport', 'route')){ ?>
                                                    <a href="javascript:void(0);" onclick="get_route_modal(<?php echo $obj->id; ?>);"  data-toggle="modal" data-target=".bs-route-modal-lg" class="btn btn-success btn-xs"><i class="fa fa-eye"></i> <?php echo lang('view'); ?> </a><br/>
                                                <?php } ?>
                                                <?php if(has_permission(DELETE, 'transport', 'route')){ ?>
                                                    <a href="<?php echo site_url('transport/route/delete/'.$obj->id); ?>" onclick="javascript: return confirm('<?php echo lang('confirm_alert'); ?>');" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> <?php echo lang('delete'); ?> </a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                            </div>
                        </div>

                        <div  class="tab-pane fade in <?php if(isset($add)){ echo 'active'; }?>" id="tab_add_route">
                            <div class="x_content"> 
                               <?php echo form_open(site_url('transport/route/add'), array('name' => 'add', 'id' => 'add', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                
                                <?php ci()->load->view('layout/school_list_form'); ?> 
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title"><?php echo lang('route_name'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="title"  id="title" value="<?php echo isset($post['title']) ?  $post['title'] : ''; ?>" placeholder="<?php echo lang('route_name'); ?>" required="required" type="text">
                                        <div class="help-block"><?php echo form_error('title'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="route_start"><?php echo lang('route_start'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="route_start"  id="route_start" value="<?php echo isset($post['route_start']) ?  $post['route_start'] : ''; ?>" placeholder="<?php echo lang('route_start'); ?>" required="required" type="text">
                                        <div class="help-block"><?php echo form_error('route_start'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="route_end"><?php echo lang('route_end'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="route_end"  id="route_end" value="<?php echo isset($post['route_end']) ?  $post['route_end'] : ''; ?>" placeholder="<?php echo lang('route_end'); ?>" required="required" type="text">
                                        <div class="help-block"><?php echo form_error('route_end'); ?></div>
                                    </div>
                                </div>                                
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="vehicle_ids"><?php echo lang('vehicle_for_route'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                                        <div class="fn_add_vehicles">
                                            <?php if(isset($add_vehicles) && !empty($add_vehicles)){ ?>
                                                <?php foreach($add_vehicles as $obj){ ?>
                                                    <input  class=""  name="vehicle_ids[]" id="vehicle_ids[]" value="<?php echo $obj->id; ?>" type="checkbox" required="required"> <?php echo $obj->number; ?> <br/>
                                                <?php } ?>
                                            <?php } ?>
                                        </div>
                                        <label id="vehicle_ids[]-error" class="error" for="vehicle_ids[]" style="display: inline-block;"></label>
                                        <div class="help-block"><?php echo form_error('vehicle_ids'); ?></div>
                                    </div>
                                </div>
                                 
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"><?php echo lang('route_stop_fare'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                         <table style="width:100%;" class="fn_add_stop_container responsive"> 
                                             <tr>               
                                                 <td><?php echo lang('stop_name'); ?></td>
                                                 <td><?php echo lang('stop_km'); ?></td>
                                                 <td><?php echo lang('stop_fare'); ?></td>
                                             </tr>
                                            <tr>               
                                              <td>
                                                  <input  class="form-control col-md-12 col-xs-12" style="width:auto;" type="text" name="stop_name[]" placeholder="<?php echo lang('stop_name'); ?>" />
                                              </td>
                                              <td>
                                                  <input  class="form-control col-md-12 col-xs-12" style="width:auto;" type='text' name="stop_km[]" value="" placeholder="<?php echo lang('stop_km'); ?>"/>
                                              </td>
                                              <td>
                                                  <input  class="form-control col-md-12 col-xs-12" style="width:auto;" type='text' name="stop_fare[]" value="" placeholder="<?php echo lang('stop_fare'); ?>"/>
                                              </td>
                                              <td>
                                              </td>
                                            </tr>                                           
                                          </table>
                                        <div class="help-block">
                                            <?php echo form_error('answer'); ?>
                                            <a href="javascript:void(0);" class="btn btn-success btn-xs" onclick="add_more('fn_add_stop_container');"><?php echo lang('add_more'); ?></a>
                                        </div>
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
                                        <a href="<?php echo site_url('transport/route/index'); ?>" class="btn btn-primary"><?php echo lang('cancel'); ?></a>
                                        <button id="send" type="submit" class="btn btn-success"><?php echo lang('submit'); ?></button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>  

                        <?php if(isset($edit)){ ?>
                        <div class="tab-pane fade in active" id="tab_edit_route">
                            <div class="x_content"> 
                               <?php echo form_open(site_url('transport/route/edit/'.$route->id), array('name' => 'edit', 'id' => 'edit', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                
                                <?php ci()->load->view('layout/school_list_edit_form'); ?>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title"><?php echo lang('route_name'); ?><span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="title"  id="title" value="<?php echo isset($route->title) ?  $route->title : ''; ?>" placeholder="<?php echo lang('route_name'); ?>" required="required" type="text">
                                        <div class="help-block"><?php echo form_error('title'); ?></div>
                                    </div>
                                </div>                          
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="route_start"><?php echo lang('route_start'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="route_start"  id="route_start" value="<?php echo isset($route->route_start) ?  $route->route_start : ''; ?>" placeholder="<?php echo lang('route_start'); ?>" required="required" type="text">
                                        <div class="help-block"><?php echo form_error('route_start'); ?></div>
                                    </div>
                                </div>                          
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="route_end"><?php echo lang('route_end'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="route_end"  id="route_end" value="<?php echo isset($route->route_end) ?  $route->route_end : ''; ?>" placeholder="<?php echo lang('route_end'); ?>" required="required" type="text">
                                        <div class="help-block"><?php echo form_error('route_end'); ?></div>
                                    </div>
                                </div>                          
                                                     
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="vehicle_ids"><?php echo lang('vehicle_for_route'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="fn_edit_vehicles">
                                        <?php if(isset($edit_vehicles) && !empty($edit_vehicles)){ ?>
                                            <?php $ids = explode(',', $route->vehicle_ids); ?>
                                            <?php foreach($edit_vehicles as $obj){ ?>
                                                <input  class=""  name="vehicle_ids[]" id="vehicle_ids[]"  value="<?php echo $obj->id; ?>" <?php if(in_array($obj->id, $ids)){ echo 'checked="checked"';} ?>  type="checkbox" required="required"> <?php echo $obj->number; ?> <br/>
                                            <?php } ?> 
                                        <?php } ?> 
                                        </div>   
                                        <label id="vehicle_ids[]-error" class="error" for="vehicle_ids[]" style="display: inline-block;"></label>
                                        <div class="help-block"><?php echo form_error('vehicle_ids'); ?></div>
                                    </div>
                                </div>                         
                                
                                   
                                   <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"><?php echo lang('route_stop_fare'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                         <table style="width:100%;" class="fn_edit_stop_container responsive"> 
                                             <tr>               
                                                 <td><?php echo lang('stop_name'); ?></td>
                                                 <td><?php echo lang('stop_km'); ?></td>
                                                 <td><?php echo lang('stop_fare'); ?></td>
                                             </tr>
                                            <?php $couter = 1; foreach($route_stops as $obj){ ?> 
                                            <tr>               
                                              <td>                                                  
                                                  <input type="hidden" name="stop_id[]" value="<?php echo $obj->id; ?>" />
                                                  <input  class="form-control col-md-12 col-xs-12" style="width:auto;" type="text" name="stop_name[]" value="<?php echo $obj->stop_name; ?>" placeholder="<?php echo lang('stop_name'); ?>" />
                                              </td>
                                              <td>
                                                  <input  class="form-control col-md-12 col-xs-12" style="width:auto;" type='text' name="stop_km[]" value="<?php echo $obj->stop_km; ?>" placeholder="<?php echo lang('stop_km'); ?>"/>
                                              </td>
                                              <td>
                                                  <input  class="form-control col-md-12 col-xs-12" style="width:auto;" type='text' name="stop_fare[]" value="<?php echo $obj->stop_fare; ?>" placeholder="<?php echo lang('stop_fare'); ?>"/>
                                              </td>
                                              <td>
                                                  <?php if($couter > 1){ ?>
                                                  <a  class="btn btn-danger btn-md " onclick="remove(this, <?php echo $obj->id; ?>);" style="margin-bottom: -0px;" > - </a>
                                                  <?php } ?>
                                              </td>
                                            </tr> 
                                            <?php $couter++; } ?>
                                            
                                          </table>
                                        <div class="help-block">
                                            <?php echo form_error('answer'); ?>
                                            <a href="javascript:void(0);" class="btn btn-success btn-xs" onclick="add_more('fn_edit_stop_container');"><?php echo lang('add_more'); ?></a>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="note"><?php echo lang('note'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control col-md-7 col-xs-12"  name="note"  id="note" placeholder="<?php echo lang('note'); ?>"><?php echo isset($route->note) ?  $route->note : ''; ?></textarea>
                                        <div class="help-block"><?php echo form_error('note'); ?></div>
                                    </div>
                                </div>
                                                             
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <input type="hidden" value="<?php echo isset($route) ? $route->id : $id; ?>" name="id" />
                                        <a  href="<?php echo site_url('transport/route/index'); ?>"  class="btn btn-primary"><?php echo lang('cancel'); ?></a>
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




<script type="text/javascript">
     function add_more(fn_stop_container){
         var data = '<tr>'                
                    +'<td style="width:50%;">'                   
                    +'<input  class="form-control col-md-12 col-xs-12" style="width:auto;" type="text" name="stop_name[]" class="answer" placeholder="<?php echo lang('stop_name'); ?>" />' 
                    +'</td>'
                    +'<td>'  
                    +'<input  class="form-control col-md-12 col-xs-12" style="width:auto;" type="text" name="stop_km[]" value="" placeholder="<?php echo lang('stop_km'); ?>"/>'
                    +'</td>'
                    +'<td>'  
                    +'<input  class="form-control col-md-12 col-xs-12" style="width:auto;" type="text" name="stop_fare[]" value="" placeholder="<?php echo lang('stop_fare'); ?>"/>'
                    +'</td>'
                    +'<td>'  
                    +'<a  class="btn btn-danger btn-md " onclick="remove(this);" style="margin-bottom: -0px;" > - </a>'
                    +'</td>'
                    +'</tr>';
            $('.'+fn_stop_container).append(data);
     }
     
     
     function remove(obj, stop_id){ 
        
        // remove stop from database
        if(stop_id)
        {
            if(confirm('<?php echo lang('confirm_alert'); ?>')){
                $.ajax({       
                    type   : "POST",
                    url    : "<?php echo site_url('transport/route/remove_stop'); ?>",
                    data   : { stop_id : stop_id},               
                    async  : false,
                    success: function(response){                                                   
                       if(response)
                       {
                          $(obj).parent().parent('tr').remove();   
                       }
                    }
                });   
            }            
        }else{
            
            $(obj).parent().parent('tr').remove(); 
        }
     }
     
    
    
</script>

<div class="modal fade bs-route-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title"><?php echo lang('detail_information'); ?></h4>
        </div>
        <div class="modal-body fn_route_data">            
        </div>       
      </div>
    </div>
</div>
<script type="text/javascript">
         
    function get_route_modal(route_id){
         
        $('.fn_route_data').html('<p style="padding: 20px;"><p style="padding: 20px;text-align:center;"><img src="<?php echo IMG_URL; ?>loading.gif" /></p>');
        $.ajax({       
          type   : "POST",
          url    : "<?php echo site_url('transport/route/get_single_route'); ?>",
          data   : {route_id : route_id},  
          success: function(response){                                                   
             if(response)
             {
                $('.fn_route_data').html(response);
             }
          }
       });
    }
</script>


 <!-- Super admin js START  -->
 <script type="text/javascript">
     
     var edit = false;
    <?php if(isset($edit)){ ?>
        edit = true;
    <?php } ?>
         
    $("document").ready(function() {
         <?php if(isset($route) && !empty($route)){ ?>
            $(".fn_branch_id").trigger('change');
         <?php } ?>
    });
     
    $('.fn_branch_id').on('change', function(){
      
        var branch_id = $(this).val();        
        var route_id = '';      
        
        <?php if(isset($route) && !empty($route)){ ?>
            route_id =  '<?php echo $route->id; ?>';
         <?php } ?> 
       
       $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('transport/route/get_vehicle_by_school'); ?>",
            data   : { branch_id:branch_id, route_id:route_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {      
                   if(edit){
                       $('.fn_edit_vehicles').html(response);  
                   }else{
                       $('.fn_add_vehicles').html(response);  
                   }                                                     
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
        
    $("#add").validate();     
    $("#edit").validate();
    
    function get_route_by_school(url){          
        if(url){
            window.location.href = url; 
        }
    }  
    
</script>