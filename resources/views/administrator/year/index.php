<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-calendar"></i><small> <?php echo lang('manage_academic_year'); ?></small></h3>
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
                        <li class="<?php if(isset($list)){ echo 'active'; }?>"><a href="#tab_year_list"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-list-ol"></i> <?php echo lang('list'); ?></a> </li>
                        
                        <?php if(has_permission(ADD, 'administrator', 'year')){ ?>
                                <?php if(isset($edit)){ ?>
                                    <li  class="<?php if(isset($add)){ echo 'active'; }?>"><a href="<?php echo site_url('administrator/year/add'); ?>" aria-expanded="false"><i class="fa fa-plus-square-o"></i> <?php echo lang('add'); ?></a> </li>                          
                                <?php }else{ ?>
                                    <li  class="<?php if(isset($add)){ echo 'active'; }?>"><a href="#tab_add_year"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-plus-square-o"></i> <?php echo lang('add'); ?></a> </li>                          
                                <?php } ?> 
                        <?php } ?> 
                            
                        <?php if(isset($edit)){ ?>
                            <li  class="active"><a href="#tab_edit_year"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-pencil-square-o"></i> <?php echo lang('edit'); ?></a> </li>                          
                        <?php } ?>   
                                                    
                    </ul>
                    <br/>
                    
                    <div class="tab-content">
                        <div  class="tab-pane fade in <?php if(isset($list)){ echo 'active'; }?>" id="tab_year_list" >
                            <div class="x_content">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo lang('sl_no'); ?></th>                                        
                                        <th><?php echo lang('academic_year'); ?></th>
                                        <th><?php echo lang('is_running'); ?></th>
                                        <th width="25%"><?php echo lang('note'); ?></th>
                                        <th><?php echo lang('action'); ?></th>                                            
                                    </tr>
                                </thead>
                                <tbody>   
                                    <?php $count = 1; if(isset($years) && !empty($years)){ ?>
                                        <?php foreach($years as $obj){ ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>                                            
                                            <td><?php echo ucfirst($obj->session_year); ?></td>
                                            <td><?php echo $obj->is_running ? lang('yes') : lang('no'); ?></td>
                                            <td><?php echo $obj->note; ?></td>
                                            <td>
                                                <?php if(has_permission(EDIT, 'administrator', 'year')){ ?>
                                                    <a href="<?php echo site_url('administrator/year/edit/'.$obj->id); ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil-square-o"></i> <?php echo lang('edit'); ?> </a>
                                                <?php } ?>
                                                <?php if(has_permission(DELETE, 'administrator', 'year')){ ?>
                                                    <?php if(!$obj->is_running){ ?>
                                                    <a href="<?php echo site_url('administrator/year/delete/'.$obj->id); ?>" onclick="javascript: return confirm('<?php echo lang('confirm_alert'); ?>');" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> <?php echo lang('delete'); ?> </a>
                                                    <?php } ?>
                                                <?php } ?>
                                                <?php if(has_permission(EDIT, 'administrator', 'year')){ ?>    
                                                    <a href="<?php echo site_url('administrator/year/activate/'.$obj->id); ?>"><button class="btn btn-success  btn-xs">  <?php echo ($obj->is_running) ? '<i class="fa fa-check"></i> '. lang('active') : lang('activate'); ?></button></a>     
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    <?php } ?>
                                </tbody>
                            </table>                               
                            </div>
                        </div>

                        <div  class="tab-pane fade in <?php if(isset($add)){ echo 'active'; }?>" id="tab_add_year">
                            <div class="x_content"> 
                               <?php echo form_open(site_url('administrator/year/add'), array('name' => 'add', 'id' => 'add', 'class'=>'form-horizontal form-label-left'), ''); ?>
                              
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="session_year">&nbsp;</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="help-block"><?php echo form_error('session_year'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="session_start"><?php echo lang('session_start'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text"  class="form-control col-md-7 col-xs-12"  name="session_start"  id="add_session_start" value="<?php echo isset($session_start) ? $session_start : ''; ?>"  placeholder="<?php echo lang('session_start'); ?>" required="required" autocomplete="off"/>
                                        <div class="help-block"><?php echo form_error('session_start'); ?></div>
                                    </div>
                                </div>
                                                              
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="session_end"><?php echo lang('session_end'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text"  class="form-control col-md-7 col-xs-12"  name="session_end"  id="add_session_end" value="<?php echo isset($session_end) ? $session_end : ''; ?>"  placeholder="<?php echo lang('session_end'); ?>" required="required" autocomplete="off"/>
                                        <div class="help-block"><?php echo form_error('session_end'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="note"><?php echo lang('note'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control col-md-7 col-xs-12"  name="note"  id="note" placeholder="<?php echo lang('note'); ?>"><?php echo isset($note) ?  $note : ''; ?></textarea>
                                        <div class="help-block"><?php echo form_error('note'); ?></div>
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <a href="<?php echo site_url('administrator/year/index'); ?>" class="btn btn-primary"><?php echo lang('cancel'); ?></a>
                                        <button id="send" type="submit" class="btn btn-success"><?php echo lang('submit'); ?></button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>  

                        <?php if(isset($edit)){ ?>
                        <div class="tab-pane fade in active" id="tab_edit_year">
                            <div class="x_content"> 
                               <?php echo form_open(site_url('administrator/year/edit/'.$year->id), array('name' => 'edit', 'id' => 'edit', 'class'=>'form-horizontal form-label-left'), ''); ?>
                             
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="session_year">&nbsp;</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="help-block"><?php echo form_error('session_year'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="session_start"><?php echo lang('session_start'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text"  class="form-control col-md-7 col-xs-12"  name="session_start"  id="edit_session_start" value="<?php echo isset($session_start) ? $session_start : ''; ?>"  placeholder="<?php echo lang('session_start'); ?>" required="required" autocomplete="off"/>
                                        <div class="help-block"><?php echo form_error('session_start'); ?></div>
                                    </div>
                                </div>
                                                              
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="session_end"><?php echo lang('session_end'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text"  class="form-control col-md-7 col-xs-12"  name="session_end"  id="edit_session_end" value="<?php echo isset($session_end) ? $session_end : ''; ?>"  placeholder="<?php echo lang('session_end'); ?>" required="required" autocomplete="off"/>
                                        <div class="help-block"><?php echo form_error('session_end'); ?></div>
                                    </div>
                                </div>
                                                              
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="note"><?php echo lang('note'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control col-md-7 col-xs-12"  name="note"  id="note" placeholder="<?php echo lang('note'); ?>"><?php echo isset($year) ? $year->note : ''; ?></textarea>
                                        <div class="help-block"><?php echo form_error('note'); ?></div>
                                    </div>
                                </div>
                               
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <input type="hidden" value="<?php echo isset($year) ? $year->id : $id; ?>" name="id" />
                                        <a href="<?php echo site_url('administrator/year/index'); ?>" class="btn btn-primary"><?php echo lang('cancel'); ?></a>
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

<link href="<?php echo VENDOR_URL; ?>datepicker/datepicker.css" rel="stylesheet">
<script src="<?php echo VENDOR_URL; ?>datepicker/datepicker.js"></script>
 <script type="text/javascript">     
     
  $('#add_session_start').datepicker({
      viewMode: 'years',
       startView: 'year', 
       minViewMode: 'months',
      format: 'MM yyyy'
  });
  $('#edit_session_start').datepicker({
      viewMode: 'years',
       startView: 'year', 
       minViewMode: 'months',
      format: 'MM yyyy'
  });
  
  $('#add_session_end').datepicker({
      viewMode: 'years',
       startView: 'year', 
       minViewMode: 'months',
      format: 'MM yyyy'
  });
  $('#edit_session_end').datepicker({
      viewMode: 'years',
       startView: 'year', 
       minViewMode: 'months',
      format: 'MM yyyy'
  });
  
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
        
       $("#add").validate();  
       $("#edit").validate();  
       
</script>