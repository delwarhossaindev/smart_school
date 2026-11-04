<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-bus"></i><small> <?php echo lang('manage_transport_member'); ?></small></h3>
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
                        <li class="<?php if(isset($list)){ echo 'active'; }?>"><a href="<?php echo site_url('transport/member/index'); ?>"   aria-expanded="true"><i class="fa fa-list-ol"></i> <?php echo lang('member'); ?></a> </li>
                        <?php if(has_permission(ADD, 'transport', 'member')){ ?>
                            <li  class="<?php if(isset($add)){ echo 'active'; }?>"><a href="<?php echo site_url('transport/member/add/'); ?>"  aria-expanded="false"><i class="fa fa-plus-square-o"></i> <?php echo lang('non_member'); ?></a> </li>                          
                        <?php } ?>
                            
                         <li class="li-class-list">
                             
                            <?php $teacher_access_data = get_teacher_access_data(); ?> 
                            <?php $guardian_access_data = get_guardian_access_data('class'); ?> 
                             
                            <?php if(ci()->session->userdata('role_id') == SUPER_ADMIN){  ?>
                             <?php echo form_open(site_url('transport/member/add'), array('name' => 'filter', 'id' => 'filter', 'class'=>'form-horizontal form-label-left'), ''); ?>
                            
                                    <select  class="form-control col-md-7 col-xs-12" style="width:auto;" name="branch_id"  onchange="get_class_by_school(this.value, '');">
                                            <option value="">--<?php echo lang('select_branch'); ?>--</option> 
                                        <?php foreach($schools as $obj ){ ?>
                                            <option value="<?php echo $obj->id; ?>" <?php if(isset($filter_branch_id) && $filter_branch_id == $obj->id){ echo 'selected="selected"';} ?> > <?php echo $obj->branch_name; ?></option>
                                        <?php } ?>   
                                    </select>
                                    <select  class="form-control col-md-7 col-xs-12" id="class_id_filter" name="class_id"  style="width:auto;" onchange="this.form.submit();">
                                         <option value="">--<?php echo lang('select'); ?>--</option>                                         
                                    </select>
                                <?php echo form_close(); ?>   
                                                                                          
                            <?php }else{  ?>
                                
                                <select  class="form-control col-md-7 col-xs-12" id="class_id_filter" name="class_id"  onchange="get_member_list_by_class(this.value);">
                                    <?php if(ci()->session->userdata('role_id') != STUDENT){ ?>
                                         <option value="<?php echo site_url('transport/member/add'); ?>">--<?php echo lang('select'); ?>--</option> 
                                    <?php } ?> 
                                    
                                    <?php foreach($classes as $obj ){ ?>
                                        <?php if(ci()->session->userdata('role_id') == STUDENT){ ?>
                                            <?php if ($obj->id != ci()->session->userdata('class_id')){ continue; } ?> 
                                            <option value="<?php echo site_url('transport/member/add/'.$obj->id); ?>" <?php if(isset($class_id) && $class_id == $obj->id){ echo 'selected="selected"';} ?> ><?php echo $obj->name; ?></option>
                                        <?php }elseif(ci()->session->userdata('role_id') == GUARDIAN){ ?>
                                            <?php if (!in_array($obj->id, $guardian_access_data)) { continue; } ?>
                                            <option value="<?php echo site_url('transport/member/add/'.$obj->id); ?>" <?php if(isset($class_id) && $class_id == $obj->id){ echo 'selected="selected"';} ?> ><?php echo $obj->name; ?></option>
                                        <?php }elseif(ci()->session->userdata('role_id') == TEACHER){ ?>
                                            <?php if (!in_array($obj->id, $teacher_access_data)) { continue; } ?>
                                            <option value="<?php echo site_url('transport/member/add/'.$obj->id); ?>" <?php if(isset($class_id) && $class_id == $obj->id){ echo 'selected="selected"';} ?> ><?php echo $obj->name; ?></option>
                                        <?php }else{ ?>
                                            <option value="<?php echo site_url('transport/member/add/'.$obj->id); ?>" <?php if(isset($class_id) && $class_id == $obj->id){ echo 'selected="selected"';} ?> ><?php echo $obj->name; ?></option>
                                        <?php } ?>                                            
                                    <?php } ?>                                            
                                </select>                               
                            
                            <?php } ?>
                                                                                     
                        </li>     
                            
                    </ul>
                    <br/>
                    
                    <div class="tab-content">                   
                        <div  class="tab-pane fade in <?php if(isset($add)){ echo 'active'; }?>" id="tab_non_member_list" >
                            <div class="x_content">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo lang('sl_no'); ?></th>
                                        <?php if(ci()->session->userdata('role_id') == SUPER_ADMIN){ ?>
                                            <th><?php echo lang('branch'); ?></th>
                                        <?php } ?>
                                        <th><?php echo lang('photo'); ?></th>
                                        <th><?php echo lang('name'); ?></th>
                                        <th><?php echo lang('class'); ?></th>
                                        <th><?php echo lang('section'); ?></th>
                                        <th><?php echo lang('roll_no'); ?></th>
                                        <th><?php echo lang('select'); ?></th>                                            
                                        <th><?php echo lang('action'); ?></th>                                            
                                    </tr>
                                </thead>
                                <tbody>   
                                    <?php $count = 1; if(isset($non_members) && !empty($non_members)){ ?>
                                        <?php foreach($non_members as $obj){ ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <?php if(ci()->session->userdata('role_id') == SUPER_ADMIN){ ?>
                                                <td><?php echo $obj->branch_name; ?></td>
                                            <?php } ?>
                                            <td>
                                               <?php  if($obj->photo != ''){ ?>
                                                <img src="<?php echo UPLOAD_PATH; ?>student-photo/<?php echo $obj->photo; ?>" alt="" width="70" /> 
                                                <?php }else{ ?>
                                                <img src="<?php echo IMG_URL; ?>default-user.png" alt="" width="70" /> 
                                                <?php } ?>
                                            </td>
                                            <td><?php echo $obj->name; ?></td>
                                            <td><?php echo $obj->class_name; ?></td>
                                            <td><?php echo $obj->section; ?></td>
                                            <td><?php echo $obj->roll_no; ?></td>
                                            <td width="25%">
                                                
                                                <?php if(ci()->session->userdata('role_id') == SUPER_ADMIN){ ?>
                                                    <?php $schools = get_school_list(); ?>
                                                    <div class="col-md-12 col-sm-12 col-xs-12">                                                       
                                                        <select  class="form-control col-md-12 col-xs-12 fn_branch_id" itemid="<?php echo $obj->user_id; ?>" name="branch_id" id="branch_id_<?php echo $obj->user_id; ?>" required="required">
                                                            <option value="">--<?php echo lang('select_branch'); ?>--</option>
                                                            <?php foreach($schools as $sc){ ?>
                                                                <option value="<?php echo $sc->id; ?>" <?php if(isset($branch_id) && $branch_id == $sc->id){echo 'selected="selected"';} ?>><?php echo $sc->branch_name; ?></option>
                                                            <?php } ?>
                                                        </select>                                                            
                                                    </div>
                                                <?php }else{ ?>  
                                                     <input type="hidden" name="branch_id" id="branch_id_<?php echo $obj->user_id; ?>" value="<?php echo ci()->session->userdata('branch_id'); ?>" />
                                                <?php } ?>
                                                     
                                                <div class="col-md-12 col-sm-12 col-xs-12"> 
                                                    <select  class="form-control col-md-12 col-xs-12" name="route_id" id="route_id_<?php echo $obj->user_id; ?>"  onchange="get_bus_stop_by_route(this.value, '<?php echo $obj->user_id; ?>');"  required="required">
                                                        <option value="">--<?php echo lang('transport_route'); ?>--</option>
                                                        <?php if(isset($routes) && !empty($routes)){ ?>
                                                            <?php foreach($routes as $route){ ?>
                                                                <option value="<?php echo $route->id; ?>"><?php echo $route->title; ?> [<?php echo get_vehicle_by_ids($route->vehicle_ids); ?>]</option>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </select>
                                                    <select  class="form-control col-md-7 col-xs-12" name="stop_id" id="stop_id_<?php echo $obj->user_id; ?>" required="required">
                                                        <option value="">--<?php echo lang('select_bus_stop'); ?>--</option>                                                    
                                                    </select>
                                                 </div>
                                            </td>
                                            <td>
                                                <?php if(has_permission(ADD, 'transport', 'member')){ ?>
                                                    <a href="javascript:void(0);" id="<?php echo $obj->user_id; ?>" class="btn btn-success btn-xs fn_add_to_transport"><i class="fa fa-reply"></i> <?php echo lang('add_to_transport'); ?></a>
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
     
    $('.fn_branch_id').on('change', function(){
              
        var branch_id = $(this).val();        
        var user_id = $(this).attr('itemid');        
       
       $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('transport/member/get_route_by_school'); ?>",
            data   : { branch_id:branch_id, user_id:user_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               { 
                    $('#route_id_'+user_id).html(response);        
               }
            }
        });
    }); 

  </script>
<!-- Super admin js end -->


 <script type="text/javascript">
     
      $(document).ready(function(){
          
        $('.fn_add_to_transport').click(function(){
           
          var obj = $(this);  
          var user_id  = $(this).attr('id');         
          var route_id  = $('#route_id_'+user_id).val();
          var stop_id  = $('#stop_id_'+user_id).val();
          var branch_id  = $('#branch_id_'+user_id).val();
          
          if(route_id == ''){
               toastr.error('<?php echo lang('please_select_a_route'); ?>'); 
               return false;
          }
          if(stop_id == ''){
               toastr.error('<?php echo lang('select_bus_stop'); ?>'); 
               return false;
          }
          
          $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('transport/member/add_to_transport'); ?>",
            data   : {branch_id:branch_id, user_id : user_id, route_id : route_id, stop_id:stop_id},               
            async  : false,
            success: function(response){ 
                if(response){
                    toastr.success('<?php echo lang('update_success'); ?>');
                    obj.parents('tr').remove();
                }else{
                    toastr.error('<?php echo lang('update_failed'); ?>'); 
                }
            }
        }); 
                      
       });       
   });
   
   function get_bus_stop_by_route(route_id, user_id){ 
   
       var branch_id  = $('#branch_id_'+user_id).val();
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('transport/member/get_bus_stop_by_route'); ?>",
            data   : { branch_id:branch_id, route_id : route_id },               
            async  : false,
            success: function(response){                                                   
               if(response)
               {                  
                  $('#stop_id_'+user_id).html(response);
               }
            }
        });         
    } 
   
</script>
 <script type="text/javascript">
    $(document).ready(function() {
      $('#datatable-responsive, .datatable-responsive').DataTable( {
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
    
    function get_class_by_school(branch_id , class_id){
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_class_by_school'); ?>",
            data   : { branch_id:branch_id, class_id:class_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {                     
                  $('#class_id_filter').html(response); 
               }
            }
        });
    }
    
    
    <?php if(isset($filter_branch_id) && isset($class_id)){ ?>
        get_class_by_school('<?php echo $filter_branch_id; ?>', '<?php echo $class_id; ?>');
    <?php } ?>
      
    function get_member_list_by_class(url){          
        if(url){
            window.location.href = url; 
        }
    }
</script>