<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-hotel"></i><small> <?php echo lang('manage_room'); ?></small></h3>
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
                        <li class="<?php if(isset($list)){ echo 'active'; }?>"><a href="#tab_room_list"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-list-ol"></i> <?php echo lang('list'); ?></a> </li>
                        <?php if(has_permission(ADD, 'hostel', 'room')){ ?>
                        
                             <?php if(isset($edit)){ ?>
                                <li  class="<?php if(isset($add)){ echo 'active'; }?>"><a href="<?php echo site_url('hostel/room/add'); ?>"  aria-expanded="false"><i class="fa fa-plus-square-o"></i> <?php echo lang('add'); ?></a> </li>                          
                             <?php }else{ ?>
                                <li  class="<?php if(isset($add)){ echo 'active'; }?>"><a href="#tab_add_room"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-plus-square-o"></i> <?php echo lang('add'); ?></a> </li>                          
                             <?php } ?>
                        <?php } ?> 
                        <?php if(isset($edit)){ ?>
                            <li  class="active"><a href="#tab_edit_room"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-pencil-square-o"></i> <?php echo lang('edit'); ?></a> </li>                          
                        <?php } ?> 
                            
                         <li class="li-class-list">
                           <?php if(ci()->session->userdata('role_id') == SUPER_ADMIN){  ?>                                 
                                <select  class="form-control col-md-7 col-xs-12" onchange="get_room_by_school(this.value);">
                                        <option value="<?php echo site_url('hostel/room/index'); ?>">--<?php echo lang('select_branch'); ?>--</option> 
                                    <?php foreach($schools as $obj ){ ?>
                                        <option value="<?php echo site_url('hostel/room/index/'.$obj->id); ?>" <?php if(isset($filter_branch_id) && $filter_branch_id == $obj->id){ echo 'selected="selected"';} ?> > <?php echo $obj->branch_name; ?></option>
                                    <?php } ?>   
                                </select>
                            <?php } ?>  
                        </li>        
                            
                            
                    </ul>
                    <br/>
                    
                    <div class="tab-content">
                        <div  class="tab-pane fade in <?php if(isset($list)){ echo 'active'; }?>" id="tab_room_list" >
                            <div class="x_content">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo lang('sl_no'); ?></th>
                                         <?php if(ci()->session->userdata('role_id') == SUPER_ADMIN){ ?>
                                            <th><?php echo lang('branch'); ?></th>
                                        <?php } ?>
                                        <th><?php echo lang('room_no'); ?></th>
                                        <th><?php echo lang('room_type'); ?></th>
                                        <th><?php echo lang('seat_total'); ?></th>
                                        <th><?php echo lang('hostel'); ?></th>
                                        <th><?php echo lang('cost_per_seat'); ?></th>
                                        <th><?php echo lang('action'); ?></th>                                            
                                    </tr>
                                </thead>
                                <tbody>   
                                    <?php $count = 1; if(isset($rooms) && !empty($rooms)){ ?>
                                        <?php foreach($rooms as $obj){ ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <?php if(ci()->session->userdata('role_id') == SUPER_ADMIN){ ?>
                                                <td><?php echo $obj->branch_name; ?></td>
                                            <?php } ?>
                                            <td><?php echo $obj->room_no; ?></td>
                                            <td><?php echo lang($obj->room_type); ?></td>
                                            <td><?php echo $obj->total_seat; ?></td>
                                            <td><?php echo $obj->hostel_name; ?></td>
                                            <td><?php echo $obj->cost; ?></td>
                                            <td>
                                                <?php if(has_permission(EDIT, 'hostel', 'room')){ ?>
                                                    <a href="<?php echo site_url('hostel/room/edit/'.$obj->id); ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil-square-o"></i> <?php echo lang('edit'); ?> </a>
                                                <?php } ?>
                                                <?php if(has_permission(VIEW, 'hostel', 'room')){ ?>
                                                    <a  onclick="get_room_modal(<?php echo $obj->id; ?>);"  data-toggle="modal" data-target=".bs-room-modal-lg"  class="btn btn-success btn-xs"><i class="fa fa-eye"></i> <?php echo lang('view'); ?> </a>
                                                <?php } ?>
                                                <?php if(has_permission(DELETE, 'hostel', 'room')){ ?>
                                                    <a href="<?php echo site_url('hostel/room/delete/'.$obj->id); ?>" onclick="javascript: return confirm('<?php echo lang('confirm_alert'); ?>');" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> <?php echo lang('delete'); ?> </a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                            </div>
                        </div>

                        <div  class="tab-pane fade in <?php if(isset($add)){ echo 'active'; }?>" id="tab_add_room">
                            <div class="x_content"> 
                               <?php echo form_open(site_url('hostel/room/add'), array('name' => 'add', 'id' => 'add', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                
                                <?php ci()->load->view('layout/school_list_form'); ?> 
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="room_no"><?php echo lang('room_no'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="room_no"  id="room_no" value="<?php echo isset($post['room_no']) ?  $post['room_no'] : ''; ?>" placeholder="<?php echo lang('room_no'); ?>" required="required" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('room_no'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="room_type"><?php echo lang('room_type'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12" name="room_type" id="room_type" required="required">
                                            <option value="">--<?php echo lang('select'); ?>--</option>
                                            <?php $types = get_room_types(); ?>
                                            <?php foreach($types as $key=>$value){ ?>
                                                <option value="<?php echo $key; ?>" <?php echo isset($post['room_type']) && $post['room_type'] == $key ?  'selected="selected"' : ''; ?>><?php echo $value; ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="help-block"><?php echo form_error('room_type'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="total_seat"><?php echo lang('seat_total'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="total_seat"  id="total_seat" value="<?php echo isset($post['total_seat']) ?  $post['total_seat'] : ''; ?>" placeholder="<?php echo lang('seat_total'); ?>" required="required" type="number" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('total_seat'); ?></div>
                                    </div>
                                </div>                               
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostel_id"><?php echo lang('hostel'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="hostel_id"  id="add_hostel_id" required="required" >
                                            <option value="">--<?php echo lang('select'); ?>--</option> 
                                            <?php foreach($hostels as $obj ){ ?>
                                            <option value="<?php echo $obj->id; ?>" <?php echo isset($post['hostel_id']) && $post['hostel_id'] == $obj->id ?  'selected="selected"' : ''; ?>><?php echo $obj->name; ?></option>
                                            <?php } ?>                                            
                                        </select>
                                        <div class="help-block"><?php echo form_error('hostel_id'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cost"><?php echo lang('cost_per_seat'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="cost"  id="cost" value="<?php echo isset($post['cost']) ?  $post['cost'] : ''; ?>" placeholder="<?php echo lang('cost_per_seat'); ?>" type="number" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('cost'); ?></div>
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
                                        <a href="<?php echo site_url('hostel/room/index'); ?>" class="btn btn-primary"><?php echo lang('cancel'); ?></a>
                                        <button id="send" type="submit" class="btn btn-success"><?php echo lang('submit'); ?></button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>  

                        <?php if(isset($edit)){ ?>
                        <div class="tab-pane fade in active" id="tab_edit_room">
                            <div class="x_content"> 
                               <?php echo form_open(site_url('hostel/room/edit/'.$room->id), array('name' => 'edit', 'id' => 'edit', 'class'=>'form-horizontal form-label-left'), ''); ?>
                               
                                <?php ci()->load->view('layout/school_list_edit_form'); ?> 
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="room_no"><?php echo lang('room_no'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="room_no"  id="room_no" value="<?php echo isset($room->room_no) ?  $room->room_no : ''; ?>" placeholder="<?php echo lang('room_no'); ?>" required="required" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('room_no'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="room_type"><?php echo lang('room_type'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12" name="room_type" id="room_type" required="required">
                                            <option value="">--<?php echo lang('select'); ?>--</option>
                                            <?php $types = get_room_types(); ?>
                                            <?php foreach($types as $key=>$value){ ?>
                                                <option value="<?php echo $key; ?>" <?php if($room->room_type == $key){ echo 'selected="selected"';} ?>><?php echo $value; ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="help-block"><?php echo form_error('room_type'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="total_seat"><?php echo lang('seat_total'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="total_seat"  id="total_seat" value="<?php echo isset($room->total_seat) ?  $room->total_seat : ''; ?>" placeholder="<?php echo lang('seat_total'); ?>" required="required" type="number" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('total_seat'); ?></div>
                                    </div>
                                </div>
                                
                                                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="hostel_id"><?php echo lang('hostel'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="hostel_id"  id="edit_hostel_id" required="required" >
                                            <option value="">--<?php echo lang('select'); ?>--</option> 
                                            <?php if(isset($hostels) && !empty($hostels)){ ?>
                                                <?php foreach($hostels as $obj ){ ?>
                                                <option value="<?php echo $obj->id; ?>" <?php if($room->hostel_id == $obj->id){ echo 'selected="selected"';} ?>><?php echo $obj->name; ?></option>
                                                <?php } ?>                                            
                                            <?php } ?>                                            
                                        </select>
                                        <div class="help-block"><?php echo form_error('hostel_id'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cost"><?php echo lang('cost_per_seat'); ?>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="cost"  id="cost" value="<?php echo isset($room->cost) ?  $room->cost : ''; ?>" placeholder="<?php echo lang('cost_per_seat'); ?>" type="number" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('cost'); ?></div>
                                    </div>
                                </div>
                             
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="note"><?php echo lang('note'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control col-md-7 col-xs-12"  name="note"  id="note" placeholder="<?php echo lang('note'); ?>"><?php echo isset($room->note) ?  $room->note : ''; ?></textarea>
                                        <div class="help-block"><?php echo form_error('note'); ?></div>
                                    </div>
                                </div>
                                                             
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <input type="hidden" value="<?php echo isset($room) ? $room->id : $id; ?>" name="id" />
                                        <a  href="<?php echo site_url('hostel/room/index'); ?>" class="btn btn-primary"><?php echo lang('cancel'); ?></a>
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


<div class="modal fade bs-room-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title"><?php echo lang('detail_information'); ?></h4>
        </div>
        <div class="modal-body fn_room_data"></div>       
      </div>
    </div>
</div>
<script type="text/javascript">
         
    function get_room_modal(room_id){
         
        $('.fn_room_data').html('<p style="padding: 20px;"><p style="padding: 20px;text-align:center;"><img src="<?php echo IMG_URL; ?>loading.gif" /></p>');
        $.ajax({       
          type   : "POST",
          url    : "<?php echo site_url('hostel/room/get_single_room'); ?>",
          data   : {room_id : room_id},  
          success: function(response){                                                   
             if(response)
             {
                $('.fn_room_data').html(response);
             }
          }
       });
    }
</script>



 <!-- Super admin js START  -->
 <script type="text/javascript">
     
    $("document").ready(function() {
         <?php if(isset($edit) && !empty($edit)){ ?>
            $("#edit_branch_id").trigger('change');
         <?php } ?>
    });
    
    $('.fn_branch_id').on('change', function(){
      
        var branch_id = $(this).val(); 
        var hostel_id = '';
        <?php if(isset($edit) && !empty($edit)){ ?>
            hostel_id =  '<?php echo $room->hostel_id; ?>';
         <?php } ?> 
             
        if(!branch_id){
           toastr.error('<?php echo lang('select_branch'); ?>');
           return false;
        }
       
       $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('hostel/room/get_hostel_by_school'); ?>",
            data   : { branch_id:branch_id, hostel_id:hostel_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {    
                   if(hostel_id){
                       $('#edit_hostel_id').html(response);   
                   }else{                       
                        $('#add_hostel_id').html(response);                                    
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
    
    function get_room_by_school(url){          
       if(url){
          window.location.href = url; 
        }
    }  
    
</script>