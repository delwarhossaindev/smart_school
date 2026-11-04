<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-book"></i><small> <?php echo lang('manage_issue_and_return'); ?></small></h3>
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
                        <li class="<?php if(isset($list)){ echo 'active'; }?>"><a href="#tab_issue_list"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-list-ol"></i> <?php echo lang('list'); ?></a> </li>
                        <?php if(has_permission(ADD, 'library', 'issue')){ ?>
                            <li  class="<?php if(isset($add)){ echo 'active'; }?>"><a href="#tab_add_issue"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-plus-square-o"></i> <?php echo lang('new_issue'); ?></a> </li>                          
                        <?php } ?>
                                                       
                        <li class="li-class-list">
                            <?php $teacher_access_data = get_teacher_access_data(); ?> 
                            <?php $guardian_access_data = get_guardian_access_data('class'); ?> 
                            
                            <?php if(ci()->session->userdata('role_id') == SUPER_ADMIN){  ?>
                                <?php echo form_open(site_url('library/issue/index'), array('name' => 'filter', 'id' => 'filter', 'class'=>'form-horizontal form-label-left'), ''); ?>
                            
                                    <select  class="form-control col-md-7 col-xs-12" style="width:auto;" name="branch_id"  onchange="get_class_by_school_filter(this.value, '');">
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
                                
                                <select  class="form-control col-md-7 col-xs-12" id="class_id_filter" name="class_id"  onchange="get_book_list_by_school(this.value);">
                                    <?php if(ci()->session->userdata('role_id') != STUDENT){ ?>
                                    <option value="<?php echo site_url('library/issue/index') ?>">--<?php echo lang('select'); ?>--</option> 
                                     <?php } ?> 
                                    
                                    <?php foreach($classes as $obj ){ ?>
                                        <?php if(ci()->session->userdata('role_id') == STUDENT){ ?>
                                            <?php if ($obj->id != ci()->session->userdata('class_id')){ continue; } ?> 
                                            <option value="<?php echo site_url('library/issue/index/'.$obj->id) ?>" <?php if(isset($class_id) && $class_id == $obj->id){ echo 'selected="selected"';} ?> ><?php echo $obj->name; ?></option>
                                        <?php }elseif(ci()->session->userdata('role_id') == GUARDIAN){ ?>
                                            <?php if (!in_array($obj->id, $guardian_access_data)) { continue; } ?>
                                            <option value="<?php echo site_url('library/issue/index/'.$obj->id) ?>" <?php if(isset($class_id) && $class_id == $obj->id){ echo 'selected="selected"';} ?> ><?php echo $obj->name; ?></option>
                                        <?php }elseif(ci()->session->userdata('role_id') == TEACHER){ ?>
                                            <?php if (!in_array($obj->id, $teacher_access_data)) { continue; } ?>
                                            <option value="<?php echo site_url('library/issue/index/'.$obj->id) ?>" <?php if(isset($class_id) && $class_id == $obj->id){ echo 'selected="selected"';} ?> ><?php echo $obj->name; ?></option>
                                        <?php }else{ ?>
                                            <option value="<?php echo site_url('library/issue/index/'.$obj->id) ?>" <?php if(isset($class_id) && $class_id == $obj->id){ echo 'selected="selected"';} ?> ><?php echo $obj->name; ?></option>
                                        <?php } ?>                                            
                                    <?php } ?>                                            
                                </select>                               
                            
                            <?php } ?>                           
                            
                        </li>     
                           
                    </ul>
                    <br/>
                    
                    <div class="tab-content">
                        <div  class="tab-pane fade in <?php if(isset($list)){ echo 'active'; }?>" id="tab_issue_list" >
                            <div class="x_content">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo lang('sl_no'); ?></th>
                                        <?php if(ci()->session->userdata('role_id') == SUPER_ADMIN){ ?>
                                            <th><?php echo lang('branch'); ?></th>
                                        <?php } ?>
                                        <th><?php echo lang('photo'); ?></th>
                                        <th><?php echo lang('student'); ?></th>
                                        <th><?php echo lang('title'); ?></th>
                                        <th><?php echo lang('book_id'); ?></th>
                                        <th><?php echo lang('issue_date'); ?></th>
                                        <th><?php echo lang('due_date'); ?></th>
                                        <th><?php echo lang('return_date'); ?></th>
                                        <th><?php echo lang('book_cover'); ?></th>
                                        <th><?php echo lang('action'); ?></th>                                            
                                    </tr>
                                </thead>
                                <tbody>   
                                    <?php $count = 1; if(isset($issue_books) && !empty($issue_books)){ ?>
                                        <?php foreach($issue_books as $obj){ ?>
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
                                            <td><?php echo $obj->title; ?></td>
                                            <td><?php echo $obj->custom_id; ?></td>
                                            <td><?php echo date(ci()->global_setting->date_format, strtotime($obj->issue_date)); ?></td>
                                            <td><?php echo date(ci()->global_setting->date_format, strtotime($obj->due_date)); ?></td>
                                            <td><?php echo $obj->return_date && $obj->return_date != '0000-00-00' ? date(ci()->global_setting->date_format, strtotime($obj->return_date)) : ''; ?></td>
                                            <td>
                                                <?php  if($obj->cover != ''){ ?>
                                                <img src="<?php echo UPLOAD_PATH; ?>book-cover/<?php echo $obj->cover; ?>" alt="" width="70" /> 
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php if(has_permission(EDIT, 'library', 'issue')){ ?>
                                                    <?php if($obj->is_returned){ ?>
                                                    <a href="javascript:void(0);" class="btn btn-success btn-xs"><i class="fa fa-retweet"></i> <?php echo lang('return'); ?> </a>
                                                    <?php }else{ ?>
                                                        <?php if(has_permission(EDIT, 'library', 'issue')){ ?>
                                                        <a href="javascript:void(0);" onclick="return_book_by_id('<?php echo $obj->issue_id; ?>', '<?php echo $obj->id; ?>');" class="btn btn-info btn-xs"><i class="fa fa-share"></i> <?php echo lang('return_this'); ?></a>
                                                        <?php } ?>
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

                        <div  class="tab-pane fade in <?php if(isset($add)){ echo 'active'; }?>" id="tab_add_issue">
                            <div class="x_content"> 
                               <?php echo form_open_multipart(site_url('library/issue/add'), array('name' => 'add', 'id' => 'add', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                
                                <?php ci()->load->view('layout/school_list_form'); ?> 
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="book_id"><?php echo lang('book'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12 fn_get_book" name="book_id" id="book_id" required="required">
                                            <option value="">--<?php echo lang('select'); ?>--</option>
                                            <?php if(isset($books) && !empty($books)){ ?>
                                                <?php foreach($books as $obj){ ?>
                                                    <option value="<?php echo $obj->id; ?>"><?php echo $obj->title; ?> [<?php echo $obj->custom_id; ?>]</option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                        <div class="help-block"><?php echo form_error('book_id'); ?></div>
                                    </div>
                                </div>               
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="isbn_no"><?php echo lang('isbn_no'); ?>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="isbn_no"  id="isbn_no" value="" readonly="readonly" placeholder="<?php echo lang('isbn_no'); ?>"  type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('isbn_no'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="edition"><?php echo lang('edition'); ?> 
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="edition"  id="edition" value="" readonly="readonly" placeholder="<?php echo lang('edition'); ?>"  type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('edition'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="author"><?php echo lang('author'); ?> 
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="author"  id="author" value="" readonly="readonly" placeholder="<?php echo lang('author'); ?>"  type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('author'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="language"><?php echo lang('language'); ?> 
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="language"  id="language" value="" readonly="readonly" placeholder="<?php echo lang('language'); ?>"  type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('language'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price"><?php echo lang('price'); ?> 
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="price"  id="price" value="" readonly="readonly" placeholder="<?php echo lang('price'); ?>"  type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('price'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="qty"><?php echo lang('quantity'); ?> 
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="qty"  id="qty" value="" readonly="readonly" placeholder="<?php echo lang('quantity'); ?>"  type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('qty'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="rack_no"><?php echo lang('almira_rack'); ?> 
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="rack_no"  id="rack_no" value="" readonly="readonly" placeholder="<?php echo lang('almira_rack'); ?>"  type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('rack_no'); ?></div>
                                    </div>
                                </div>
                                
                               <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"><?php echo lang('book_cover'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12" id="cover" >
                                        <img src=""  alt="" width="70" />
                                    </div>
                               </div>
                               
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="due_date"><?php echo lang('due_date'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="due_date"  id="due_date" value="" required="required"  placeholder="<?php echo lang('due_date'); ?>"  type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('due_date'); ?></div>
                                    </div>
                                </div>
                                 <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="class_id"><?php echo lang('class'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12" name="class_id" id="add_class_id" required="required" onchange="get_library_member_by_class(this.value);">
                                            <option value="">--<?php echo lang('select'); ?>--</option>
                                            <?php if(isset($classes) && !empty($classes)){ ?>
                                                <?php foreach($classes as $obj){ ?>
                                                    <option value="<?php echo $obj->id; ?>"><?php echo $obj->name; ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                        <div class="help-block"><?php echo form_error('class_id'); ?></div>
                                    </div>
                                </div>    
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="member_id"><?php echo lang('library_member'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12" name="library_member_id" id="library_member_id" required="required">
                                            <option value="">--<?php echo lang('select'); ?>--</option>
                                           <?php if(isset($members) && !empty($members)){ ?>
                                                <?php foreach($members as $obj){ ?>
                                                    <option value="<?php echo $obj->lm_id; ?>"><?php echo $obj->name; ?> [<?php echo $obj->custom_member_id; ?>]</option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                        <div class="help-block"><?php echo form_error('library_member_id'); ?></div>
                                    </div>
                                </div> 
                                
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <a href="<?php echo site_url('library/issue/index'); ?>"  class="btn btn-primary"><?php echo lang('cancel'); ?></a>
                                        <button id="fn_send" type="submit" class="btn btn-success"><?php echo lang('issue'); ?></button>
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
<link href="<?php echo VENDOR_URL; ?>datepicker/datepicker.css" rel="stylesheet">
 <script src="<?php echo VENDOR_URL; ?>datepicker/datepicker.js"></script>
 
 <!-- Super admin js START  -->
 <script type="text/javascript">
     
    $('.fn_branch_id').on('change', function(){
      
        var branch_id = $(this).val(); 
        var class_id = '';
                
        if(!branch_id){
           toastr.error('<?php echo lang('select_branch'); ?>');
           return false;
        }
       
       $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('library/issue/get_book_by_school'); ?>",
            data   : { branch_id:branch_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {                     
                   $('#book_id').html(response);  
                   get_class_by_school(branch_id, class_id);
               }
            }
        });
    }); 
    
    
    function get_library_member_by_class(class_id){
    
        var branch_id = $('#add_branch_id').val(); 
        
        if(!branch_id){
           toastr.error('<?php echo lang('select_branch'); ?>');
           return false;
        }
        
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('library/issue/get_library_member_by_class'); ?>",
            data   : { branch_id:branch_id, class_id:class_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {    
                   $('#library_member_id').html(response);                    
               }
            }
        });
    }
    
    
    function get_class_by_school(branch_id, class_id){       
         
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_class_by_school'); ?>",
            data   : { branch_id:branch_id, class_id:class_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {  
                   $('#add_class_id').html(response);
               }
            }
        });
   }
  
    
  </script>
<!-- Super admin js end -->

 
 <script type="text/javascript">
 
  $('#due_date').datepicker();
     
      $(document).ready(function(){
          
        $('.fn_get_book').change(function(){
           
          var book_id  = $(this).val();           
          
          $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('library/issue/get_book_by_id'); ?>",
            data   : { book_id : book_id},               
            async  : false,
            dataType: 'json',
            success: function(response){ 
                if(response){
                   
                    $('#isbn_no').val(response.isbn_no);
                    $('#edition').val(response.edition);
                    $('#author').val(response.author);
                    $('#language').val(response.language);
                    $('#price').val(response.price);
                    if(response.qty > 0){
                        $('#qty').val(response.qty);
                    }else{
                        $('#qty').val('Out of Stock');
                        $('#fn_send').hide('slow');
                    }                    
                    $('#rack_no').val(response.rack_no);                    
                    $('#cover img').attr('src', '<?php echo UPLOAD_PATH; ?>book-cover/'+response.cover);                    
                   
                }else{
                    $("input[type=text]").val('');
                    $('#cover img').attr('src', '');
                    toastr.error('<?php echo lang('unexpected_error'); ?>'); 
                }
            }
        }); 
                      
       });       
   });
   
   function return_book_by_id(issue_id, book_id){       
           
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('library/issue/return_book_by_id'); ?>",
            data   : { issue_id : issue_id, book_id : book_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                  toastr.success('<?php echo lang('return_success'); ?>'); 
                  location.reload();
               }
            }
        });  
   }
   
    <?php if(isset($filter_class_id)){ ?>
        get_class_by_school_filter('<?php echo $filter_branch_id; ?>', '<?php echo $filter_class_id; ?>');
    <?php } ?>
    function get_class_by_school_filter(branch_id, class_id){
                
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_class_by_school'); ?>",
            data   : { branch_id : branch_id, class_id : class_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               { 
                    $('#class_id_filter').html(response);                     
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
        
    $("#add").validate(); 
    
 
    
    function get_book_list_by_school(url){          
        if(url){
            window.location.href = url; 
        }
    }
    
</script>