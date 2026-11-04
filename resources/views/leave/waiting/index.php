<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-bell-o"></i><small> <?php echo lang('manage_waiting_application'); ?></small></h3>
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
                        <li class="<?php if(isset($list)){ echo 'active'; }?>"><a href="#tab_application_list"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-list-ol"></i> <?php echo lang('list'); ?></a> </li>
                        <li class="li-class-list">
                            <?php if(ci()->session->userdata('role_id') == SUPER_ADMIN){  ?>                                  
                                <select  class="form-control col-md-7 col-xs-12 auto-width" name="branch_id_filter" id="branch_id_filter" onchange="get_application_by_school_filter(this.value)">
                                    <option value="<?php echo site_url('leave/waiting/index'); ?>">--<?php echo lang('select_branch'); ?>--</option> 
                                    <?php foreach(ci()->schools as $obj ){ ?>
                                        <option value="<?php echo site_url('leave/waiting/index/'.$obj->id); ?>" <?php if(isset($filter_branch_id) && $filter_branch_id == $obj->id){ echo 'selected="selected"';} ?> > <?php echo $obj->branch_name; ?></option>
                                    <?php } ?>   
                                </select> 
                            <?php } ?>
                        </li> 
                    </ul>
                    <br/>
                    
                    <div class="tab-content">
                        
                        <div  class="tab-pane fade in <?php if(isset($list)){ echo 'active'; }?>" id="tab_application_list" >
                            <div class="x_content">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo lang('sl_no'); ?></th>
                                        <?php if(ci()->session->userdata('role_id') == SUPER_ADMIN){ ?>
                                            <th><?php echo lang('branch'); ?></th>
                                        <?php } ?>
                                        <th><?php echo lang('academic_year'); ?></th>
                                        <th><?php echo lang('applicant_type'); ?></th>
                                        <th><?php echo lang('leave_type'); ?></th>
                                        <th><?php echo lang('applicant'); ?></th>
                                        <th><?php echo lang('action'); ?></th>                                            
                                    </tr>
                                </thead>
                                <tbody>   
                                    <?php $count = 1; if(isset($applications) && !empty($applications)){ ?>
                                        <?php foreach($applications as $obj){ ?>                                       
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <?php if(ci()->session->userdata('role_id') == SUPER_ADMIN){ ?>
                                                <td><?php echo $obj->branch_name; ?></td>
                                            <?php } ?>
                                            <td><?php echo $obj->session_year; ?></td>
                                            <td><?php echo $obj->role_name; ?></td>
                                            <td><?php echo $obj->type; ?></td>
                                            <td>
                                                <?php
                                                    $user = get_user_by_role($obj->role_id, $obj->user_id);
                                                    echo $user->name;
                                                    if($obj->role_id == STUDENT){
                                                        echo '<br/>'.$user->class_name.', '. $user->section.', '.$user->roll_no;
                                                    }
                                                ?>
                                            </td>                                  
                                            <td>                                                
                                                <?php if(has_permission(EDIT, 'leave', 'approve')){ ?>
                                                    <a href="<?php echo site_url('leave/approve/update/'.$obj->id); ?>" title="<?php echo lang('approve'); ?>" class="btn btn-success btn-xs"><i class="fa fa-check-square-o"></i> <?php echo lang('approve'); ?> </a>
                                                <?php } ?>                               
                                                <?php if(has_permission(EDIT, 'leave', 'decline')){ ?>
                                                    <a href="<?php echo site_url('leave/decline/update/'.$obj->id); ?>" title="<?php echo lang('decline'); ?>" class="btn btn-danger btn-xs"><i class="fa fa-close"></i> <?php echo lang('decline'); ?> </a>
                                                <?php } ?>                               
                                                
                                                <?php if(has_permission(VIEW, 'leave', 'waiting')){ ?>
                                                    <a  onclick="get_application_modal(<?php echo $obj->id; ?>);"  data-toggle="modal" data-target=".bs-application-modal-lg"  class="btn btn-success btn-xs"><i class="fa fa-eye"></i> <?php echo lang('view'); ?> </a>
                                                <?php } ?>
                                                <?php if(has_permission(DELETE, 'leave', 'waiting')){ ?>    
                                                    <a href="<?php echo site_url('leave/waiting/delete/'.$obj->id); ?>" onclick="javascript: return confirm('<?php echo lang('confirm_alert'); ?>');" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> <?php echo lang('delete'); ?> </a>
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

<div class="modal fade bs-application-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title"><?php echo lang('detail_information'); ?></h4>
        </div>
        <div class="modal-body fn_application_data">            
        </div>       
      </div>
    </div>
</div>

<script type="text/javascript">
         
    function get_application_modal(application_id){
         
        $('.fn_application_data').html('<p style="padding: 20px;"><p style="padding: 20px;text-align:center;"><img src="<?php echo IMG_URL; ?>loading.gif" /></p>');
        $.ajax({       
          type   : "POST",
          url    : "<?php echo site_url('leave/waiting/get_single_application'); ?>",
          data   : {application_id : application_id},  
          success: function(response){                                                   
             if(response)
             {
                $('.fn_application_data').html(response);
             }
          }
       });
    }
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

       /* Menu Filter Start */   
    function get_application_by_school_filter(url){          
       if(url){
           window.location.href = url; 
       }
    } 
    
</script> 
