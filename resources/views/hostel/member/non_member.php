<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-hotel"></i><small> <?php echo lang('manage_hostel_member'); ?></small></h3>
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
                        <li class="<?php if(isset($list)){ echo 'active'; }?>"><a href="<?php echo site_url('hostel/member/index'); ?>"   aria-expanded="true"><i class="fa fa-list-ol"></i> <?php echo lang('member'); ?></a> </li>
                        <?php if(has_permission(ADD, 'hostel', 'member')){ ?>
                            <li  class="<?php if(isset($add)){ echo 'active'; }?>"><a href="<?php echo site_url('hostel/member/add'); ?>"  aria-expanded="false"><i class="fa fa-plus-square-o"></i> <?php echo lang('non_member'); ?></a> </li>                          
                        <?php } ?>
                                                        
                                                          
                        <li class="li-class-list">
                            <?php $teacher_access_data = get_teacher_access_data(); ?> 
                            <?php $guardian_access_data = get_guardian_access_data('class'); ?> 
                            
                            <?php if(ci()->session->userdata('role_id') == SUPER_ADMIN){  ?>
                            
                            <?php echo form_open(site_url('hostel/member/add'), array('name' => 'filter', 'id' => 'filter', 'class'=>'form-horizontal form-label-left'), ''); ?>
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
                                
                                <select  class="form-control col-md-7 col-xs-12" id="class_id_filter" name="class_id" onchange="get_member_list_by_class(this.value);">
                                    <?php if(ci()->session->userdata('role_id') != STUDENT){ ?>
                                    <option value="<?php echo site_url('hostel/member/add'); ?>">--<?php echo lang('select'); ?>--</option> 
                                     <?php } ?> 
                                    
                                    <?php foreach($classes as $obj ){ ?>
                                        <?php if(ci()->session->userdata('role_id') == STUDENT){ ?>
                                            <?php if ($obj->id != ci()->session->userdata('class_id')){ continue; } ?> 
                                            <option value="<?php echo site_url('hostel/member/add/'.$obj->id); ?>" <?php if(isset($class_id) && $class_id == $obj->id){ echo 'selected="selected"';} ?> ><?php echo $obj->name; ?></option>
                                        <?php }elseif(ci()->session->userdata('role_id') == GUARDIAN){ ?>
                                            <?php if (!in_array($obj->id, $guardian_access_data)) { continue; } ?>
                                            <option value="<?php echo site_url('hostel/member/add/'.$obj->id); ?>" <?php if(isset($class_id) && $class_id == $obj->id){ echo 'selected="selected"';} ?> ><?php echo $obj->name; ?></option>
                                        <?php }elseif(ci()->session->userdata('role_id') == TEACHER){ ?>
                                            <?php if (!in_array($obj->id, $teacher_access_data)) { continue; } ?>
                                            <option value="<?php echo site_url('hostel/member/add/'.$obj->id); ?>" <?php if(isset($class_id) && $class_id == $obj->id){ echo 'selected="selected"';} ?> ><?php echo $obj->name; ?></option>
                                        <?php }else{ ?>
                                            <option value="<?php echo site_url('hostel/member/add/'.$obj->id); ?>" <?php if(isset($class_id) && $class_id == $obj->id){ echo 'selected="selected"';} ?> ><?php echo $obj->name; ?></option>
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
                                        <th><?php echo lang('select_hostel'); ?> / <?php echo lang('room_no'); ?> </th>                                            
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
                                            <td>
                                                <div class="col-md-12 col-xs-12" >                                                     
                                                    <input type="hidden" name="branch_id" id="branch_id_<?php echo $obj->user_id; ?>" value="<?php echo $obj->branch_id; ?>" />
                                                </div>
                                                <div class="col-md-12 col-xs-12" >
                                                    <select  class="form-control col-md-7 col-xs-12 alignleft" name="hostel_id" id="hostel_id_<?php echo $obj->user_id; ?>" onchange="get_room_by_hostel(this.value, '<?php echo $obj->user_id; ?>');" required="required">
                                                        <option value="">--<?php echo lang('select_hostel'); ?>--</option>
                                                            <?php $hostels = get_hostel_by_school($obj->branch_id); ?>
                                                            <?php if(isset($hostels) && !empty($hostels)){ ?>
                                                                <?php foreach($hostels as $hostel){ ?>
                                                                    <option value="<?php echo $hostel->id; ?>"><?php echo $hostel->name; ?> [<?php echo lang($hostel->type); ?>]</option>
                                                                <?php } ?>
                                                            <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-12 col-xs-12" >
                                                    <select  class="form-control col-md-7 col-xs-12" name="room_id" id="room_id_<?php echo $obj->user_id; ?>" required="required">
                                                        <option value="">--<?php echo lang('select_room_no'); ?>--</option>                                                    
                                                    </select>
                                                </div>  
                                            </td>
                                            <td>
                                                <?php if(has_permission(ADD, 'hostel', 'member')){ ?>
                                                    <a href="javascript:void(0);" id="<?php echo $obj->user_id; ?>" class="btn btn-success btn-xs fn_add_to_hostel"><i class="fa fa-reply"></i> <?php echo lang('add_to_hostel'); ?></a>
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

 <script type="text/javascript">
     
      $(document).ready(function(){
          
        $('.fn_add_to_hostel').click(function(){
           
          var obj = $(this);  
          var user_id  = $(this).attr('id');         
          var branch_id  = $('#branch_id_'+user_id).val();         
          var hostel_id  = $('#hostel_id_'+user_id).val();         
          var room_id  = $('#room_id_'+user_id).val();         
          if(hostel_id == ''){
               toastr.error('<?php echo lang('select_hostel'); ?>'); 
               return false;
          }
          if(room_id == ''){
               toastr.error('<?php echo lang('select_room_no'); ?>'); 
               return false;
          }
          
          $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('hostel/member/add_to_hostel'); ?>",
            data   : {branch_id:branch_id, user_id : user_id, hostel_id : hostel_id, room_id : room_id},               
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
   
    
    function get_room_by_hostel(hostel_id, user_id){       
           
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_room_by_hostel'); ?>",
            data   : { hostel_id : hostel_id },               
            async  : false,
            success: function(response){                                                   
               if(response)
               {                  
                  $('#room_id_'+user_id).html(response);
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