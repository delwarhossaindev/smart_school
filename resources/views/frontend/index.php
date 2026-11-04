<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa fa-desktop"></i><small> <?php echo lang('manage_frontend_page'); ?></small></h3>
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
                    <li class="<?php if(isset($list)){ echo 'active'; }?>"><a href="#tab_page_list"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-list-ol"></i> <?php echo lang('list'); ?></a> </li>
                        <?php if(has_permission(ADD, 'frontend', 'frontend')){ ?>
                            
                          <?php if(isset($edit)){ ?>
                                <li  class="<?php if(isset($add)){ echo 'active'; }?>"><a href="<?php echo site_url('frontend/add'); ?>"  role="tab"  aria-expanded="false"><i class="fa fa-plus-square-o"></i> <?php echo lang('create_page'); ?></a> </li>                          
                          <?php }else{ ?>
                                <li  class="<?php if(isset($add)){ echo 'active'; }?>"><a href="#tab_add_page"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-plus-square-o"></i> <?php echo lang('create_page'); ?></a> </li>                          
                          <?php } ?>   
                           
                        <?php } ?>                            
                        <?php if(isset($edit)){ ?>
                            <li  class="active"><a href="#tab_edit_page"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-pencil-square-o"></i> <?php echo lang('edit'); ?></a> </li>                          
                        <?php } ?>  
                            
                         <li class="li-class-list">
                        <?php if(ci()->session->userdata('role_id') == SUPER_ADMIN){  ?>                                 
                             <select  class="form-control col-md-7 col-xs-12" onchange="get_page_by_school(this.value);">
                                     <option value="<?php echo site_url('frontend/index'); ?>">--<?php echo lang('select_branch'); ?>--</option> 
                                 <?php foreach($schools as $obj ){ ?>
                                     <option value="<?php echo site_url('frontend/index/'.$obj->id); ?>" <?php if(isset($filter_branch_id) && $filter_branch_id == $obj->id){ echo 'selected="selected"';} ?> > <?php echo $obj->branch_name; ?></option>
                                 <?php } ?>   
                             </select>
                         <?php } ?>  
                         </li>      
                            
                    </ul>
                    <br/>
                    
                    <div class="tab-content">
                        <div  class="tab-pane fade in <?php if(isset($list)){ echo 'active'; }?>" id="tab_page_list" >
                            <div class="x_content">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo lang('sl_no'); ?></th>
                                         <?php if(ci()->session->userdata('role_id') == SUPER_ADMIN){ ?>
                                            <th><?php echo lang('branch'); ?></th>
                                        <?php } ?>
                                        <th><?php echo lang('location'); ?></th>
                                        <th><?php echo lang('title'); ?></th>
                                        <th><?php echo lang('image'); ?></th>
                                        <th><?php echo lang('action'); ?></th>                                            
                                    </tr>
                                </thead>
                                <tbody>   
                                    <?php $count = 1; if(isset($pages) && !empty($pages)){ ?>
                                        <?php foreach($pages as $obj){ ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <?php if(ci()->session->userdata('role_id') == SUPER_ADMIN){ ?>
                                                <td><?php echo $obj->branch_name; ?></td>
                                            <?php } ?>
                                            <td><?php echo lang($obj->page_location); ?></td>
                                            <td><?php echo $obj->page_title; ?></td>
                                            <td>
                                                <?php  if($obj->page_image != ''){ ?>
                                                <img src="<?php echo UPLOAD_PATH; ?>page/<?php echo $obj->page_image; ?>" alt="" width="150" /> 
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php if(has_permission(EDIT, 'frontend', 'frontend')){ ?>
                                                    <a href="<?php echo site_url('frontend/edit/'.$obj->id); ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil-square-o"></i> <?php echo lang('edit'); ?> </a>
                                                <?php } ?>
                                                <?php if(has_permission(VIEW, 'frontend', 'frontend')){ ?>
                                                    <a  onclick="get_frontend_modal(<?php echo $obj->id; ?>);"  data-toggle="modal" data-target=".bs-frontend-modal-lg"  class="btn btn-success btn-xs"><i class="fa fa-eye"></i> <?php echo lang('view'); ?> </a>
                                                <?php  } ?> 
                                                <?php if(has_permission(DELETE, 'frontend', 'frontend')){ ?>
                                                    <a href="<?php echo site_url('frontend/delete/'.$obj->id); ?>" onclick="javascript: return confirm('<?php echo lang('confirm_alert'); ?>');" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> <?php echo lang('delete'); ?> </a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                            </div>
                        </div>

                        <div  class="tab-pane fade in <?php if(isset($add)){ echo 'active'; }?>" id="tab_add_page">
                            <div class="x_content"> 
                               <?php echo form_open_multipart(site_url('frontend/add'), array('name' => 'add', 'id' => 'add', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                
                                 <?php ci()->load->view('layout/school_list_form'); ?>
                               
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="page_location"><?php echo lang('location'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <?php $locations = get_page_location(); ?>
                                        <select  class="form-control col-md-7 col-xs-12 quick-field" name="page_location" id="page_location" required="required">
                                            <option value="">--<?php echo lang('select'); ?>--</option>                                                                                    
                                            <?php foreach($locations as $key=>$value){ ?>                                           
                                            <option value="<?php echo $key; ?>" <?php if(isset($post['page_location']) == $key){ echo 'selected="selected"';} ?>><?php echo $value; ?></option>
                                            <?php } ?>           
                                        </select>
                                        <div class="help-block"><?php echo form_error('page_location'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="page_title"><?php echo lang('title'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="page_title"  id="page_title" value="<?php echo isset($post['page_title']) ?  $post['page_title'] : ''; ?>" placeholder="<?php echo lang('title'); ?>" required="required" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('page_title'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="page_slug"><?php echo lang('url_slug'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="page_slug"  id="page_slug" value="<?php echo isset($post['page_slug']) ?  $post['page_slug'] : ''; ?>" placeholder="<?php echo lang('url_slug'); ?>" required="required" type="text" autocomplete="off">
                                        <div class="text-info">Ex: terms-and-condition. [ Must be english text ]</div>
                                        <div class="help-block"><?php echo form_error('page_slug'); ?></div>
                                    </div>
                                </div>
                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="page_description"><?php echo lang('description'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control col-md-7 col-xs-12"  name="page_description"  id="add_page_description" placeholder="<?php echo lang('description'); ?>"><?php echo isset($post['page_description']) ?  $post['page_description'] : ''; ?></textarea>
                                        <div class="help-block"><?php echo form_error('page_description'); ?></div>
                                    </div>
                                </div>
                               
                                
                               <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"><?php echo lang('image'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="btn btn-default btn-file">
                                            <i class="fa fa-paperclip"></i> <?php echo lang('upload'); ?>
                                            <input  class="form-control col-md-7 col-xs-12"  name="image"  id="image" type="file">
                                        </div>
                                        <div class="text-info"><?php echo lang('valid_file_format_img'); ?></div>
                                        <div class="help-block"><?php echo form_error('page_image'); ?></div>
                                    </div>
                               </div>
                                
                                
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <a href="<?php echo site_url('frontend/index'); ?>" class="btn btn-primary"><?php echo lang('cancel'); ?></a>
                                        <button id="send" type="submit" class="btn btn-success"><?php echo lang('submit'); ?></button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>  

                        <?php if(isset($edit)){ ?>
                        <div class="tab-pane fade in active" id="tab_edit_page">
                            <div class="x_content"> 
                               <?php echo form_open_multipart(site_url('frontend/edit/'.$page->id), array('name' => 'edit', 'id' => 'edit', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                
                                <?php ci()->load->view('layout/school_list_edit_form'); ?>    
                                
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="page_location"><?php echo lang('location'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <?php $locations = get_page_location(); ?>
                                        <select  class="form-control col-md-7 col-xs-12 quick-field" name="page_location" id="page_location" required="required">
                                            <option value="">--<?php echo lang('select'); ?>--</option>                                                                                    
                                            <?php foreach($locations as $key=>$value){ ?>                                           
                                            <option value="<?php echo $key; ?>" <?php if(isset($page->page_location) == $key){ echo 'selected="selected"';} ?>><?php echo $value; ?></option>
                                            <?php } ?>           
                                        </select>
                                        <div class="help-block"><?php echo form_error('page_location'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="page_title"><?php echo lang('title'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="page_title"  id="page_title" value="<?php echo isset($page->page_title) ?  $page->page_title : ''; ?>" placeholder="<?php echo lang('title'); ?>" required="required" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('page_title'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="page_slug"><?php echo lang('url_slug'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="page_slug"  id="page_slug" value="<?php echo isset($page->page_slug) ?  $page->page_slug : ''; ?>" placeholder="<?php echo lang('url_slug'); ?>" required="required" type="text" autocomplete="off">
                                        <div class="text-info">Ex: terms-and-condition. [ Must be english text ]</div>
                                        <div class="help-block"><?php echo form_error('page_slug'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="page_description"><?php echo lang('description'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control col-md-7 col-xs-12"  name="page_description"  id="edit_page_description" placeholder="<?php echo lang('description'); ?>"><?php echo isset($page->page_description) ?  $page->page_description : ''; ?></textarea>
                                        <div class="help-block"><?php echo form_error('page_description'); ?></div>
                                    </div>
                                </div>                                                         
                                                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"><?php echo lang('image'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="hidden" name="prev_image" id="prev_image" value="<?php echo $page->page_image; ?>" />
                                        <?php if($page->page_image){ ?>
                                        <img src="<?php echo UPLOAD_PATH; ?>page/<?php echo $page->page_image; ?>" alt="" width="150" /><br/><br/>
                                        <?php } ?>
                                        <div class="btn btn-default btn-file">
                                            <i class="fa fa-paperclip"></i> <?php echo lang('upload'); ?>
                                            <input  class="form-control col-md-7 col-xs-12"  name="image"  id="image" type="file">
                                        </div>
                                        <div class="text-info"><?php echo lang('valid_file_format_img'); ?></div>
                                        <div class="help-block"><?php echo form_error('page_image'); ?></div>
                                    </div>
                                </div>
                                                         
                                                                                             
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <input type="hidden" value="<?php echo isset($page) ? $page->id : $id; ?>" name="id" />
                                        <a href="<?php echo site_url('frontend/index'); ?>" class="btn btn-primary"><?php echo lang('cancel'); ?></a>
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


<div class="modal fade bs-frontend-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title"><?php echo lang('detail_information'); ?></h4>
        </div>
        <div class="modal-body fn_frontend_data">            
        </div>       
      </div>
    </div>
</div>
<script type="text/javascript">
         
    function get_frontend_modal(frontend_id){
         
        $('.fn_frontend_data').html('<p style="padding: 20px;"><p style="padding: 20px;text-align:center;"><img src="<?php echo IMG_URL; ?>loading.gif" /></p>');
        $.ajax({       
          type   : "POST",
          url    : "<?php echo site_url('frontend/get_single_frontend'); ?>",
          data   : {frontend_id : frontend_id},  
          success: function(response){                                                   
             if(response)
             {
                $('.fn_frontend_data').html(response);
             }
          }
       });
    }
</script>


 <link href="<?php echo VENDOR_URL; ?>editor/jquery-te-1.4.0.css" rel="stylesheet">
 <script type="text/javascript" src="<?php echo VENDOR_URL; ?>editor/jquery-te-1.4.0.min.js"></script>
 <script type="text/javascript">
     
  $('#add_page_description').jqte();
  $('#edit_page_description').jqte();
  
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
    
    function get_page_by_school(url){          
        if(url){
            window.location.href = url; 
        }
    }  
    
    
  </script> 
  
  <style type="text/css">
      .jqte_editor{height: 250px;}
  </style>
  
      