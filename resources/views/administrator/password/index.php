<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-pencil-square-o"></i><small> <?php echo lang('reset_user_password'); ?></small></h3>
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
                        <li  class="active"><a href="#tab_password_reset" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-gear"></i> <?php echo lang('reset_password'); ?></a></li>                          
                    </ul>
                    <br/>
                     <div class="tab-content">
                        <div  class="tab-pane fade in active" id="tab_password_reset" >
                            <div class="x_content">
                                <?php echo form_open(site_url('administrator/password/index'), array('name' => 'add', 'id' => 'add', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                
                                <?php ci()->load->view('layout/school_list_form'); ?> 
                                
                                <div class="item form-group"> 
                                     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="role_id"><?php echo lang('user_type'); ?> <span class="required">*</span></label>
                                     <div class="col-md-6 col-sm-6 col-xs-12">
                                         <select  class="form-control col-md-12 col-xs-12"  name="role_id"  id="role_id" required="required" onchange="get_user_by_role(this.value, '');">
                                             <option value="">--<?php echo lang('select'); ?>--</option> 
                                             <?php foreach($roles as $obj ){ ?>
                                             <option value="<?php echo $obj->id; ?>"><?php echo $obj->name; ?></option>
                                             <?php } ?>                                            
                                         </select>
                                         <div class="help-block"><?php echo form_error('role_id'); ?></div>
                                     </div>
                                 </div>

                                <div class="item form-group display"> 
                                     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="class_id"><?php echo lang('class'); ?> <span class="required">*</span></label>
                                     <div class="col-md-6 col-sm-6 col-xs-12">
                                         <select  class="form-control col-md-12 col-xs-12"  name="class_id"  id="class_id"  onchange="get_user('', this.value,'', '');">
                                             <option value="">--<?php echo lang('select'); ?>--</option>  
                                         </select>
                                         <div class="help-block"><?php echo form_error('class_id'); ?></div>
                                     </div>
                                 </div>

                                 <div class="item form-group">  
                                     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="user_id"><?php echo lang('user'); ?> <span class="required">*</span></label>
                                     <div class="col-md-6 col-sm-6 col-xs-12">
                                         <select  class="form-control col-md-12 col-xs-12"  name="user_id"  id="user_id" required="required" >
                                             <option value="">--<?php echo lang('select'); ?>--</option>                                                                                         
                                         </select>
                                         <div class="help-block"><?php echo form_error('user_id'); ?></div>
                                     </div>
                                 </div>
                                 <div class="item form-group">
                                     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password"><?php echo lang('password'); ?> <span class="required">*</span>
                                     </label>
                                     <div class="col-md-6 col-sm-6 col-xs-12">
                                         <input  class="form-control col-md-7 col-xs-12"  name="password"  id="password" value="" placeholder="<?php echo lang('password'); ?>" required="required" type="password" autocomplete="off">
                                         <div class="help-block"><?php echo form_error('password'); ?></div>
                                     </div>
                                 </div>
                                 <div class="item form-group">
                                     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="conf_password"><?php echo lang('confirm_password'); ?> <span class="required">*</span>
                                     </label>
                                     <div class="col-md-6 col-sm-6 col-xs-12">
                                         <input  class="form-control col-md-7 col-xs-12"  name="conf_password"  id="conf_password" value="" placeholder="<?php echo lang('confirm_password'); ?>" required="required" type="password" autocomplete="off">
                                         <div class="help-block"><?php echo form_error('conf_password'); ?></div>
                                     </div>
                                 </div>

                                 <div class="ln_solid"></div>
                                 <div class="form-group">
                                     <div class="col-md-6 col-md-offset-3">
                                         <a href="<?php echo site_url('administrator/user/index'); ?>" class="btn btn-primary"><?php echo lang('cancel'); ?></a>
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
<script type="text/javascript">
    
    $('.fn_branch_id').on('change', function(){
        $('#role_id').prop('selectedIndex',0);
        $('#user_id').prop('selectedIndex',0);        
         get_class_by_school();        
    });
    
    <?php if (ci()->session->userdata('role_id') != SUPER_ADMIN) { ?> 
         get_class_by_school();
    <?php } ?>    
    
    function get_user_by_role(role_id, user_id){       
       
       var branch_id =  $('.fn_branch_id').val();
       
       if(!branch_id){
           toastr.error('<?php echo lang('select_branch'); ?>');
           return false;
       }
       
       if(role_id == <?php echo STUDENT; ?>){
           $('.display').show();
           $('#class_id').prop('required', true);
           $('#user_id').html('<option value="">--<?php echo lang('select'); ?>--</option>'); 
       }else{
           get_user(role_id, '', user_id, branch_id);
           $('#class_id').prop('required', false);
           $('.display').hide();
       }       
   }
   
   function get_user(role_id, class_id, user_id, branch_id){
       
       if(role_id == ''){
           role_id = $('#role_id').val();
       }
       if(branch_id == ''){
           branch_id = $('#add_branch_id').val();
       }
            
       
       $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_user_by_role'); ?>",
            data   : { branch_id:branch_id, role_id : role_id , class_id: class_id, user_id:user_id, message : true},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                   $('#user_id').html(response); 
               }
            }
        }); 
   }
   
    function get_class_by_school(){
       
        var branch_id = $('#add_branch_id').val();       
       
       $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_class_by_school'); ?>",
            data   : { branch_id:branch_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                   $('#class_id').html(response); 
               }
            }
        }); 
   }
   
    $("#add").validate({
        rules: {
        password: {
            required: true,
            minlength: 6
        },
        conf_password: {
            required: true,
            minlength: 6,
            equalTo: "#password"
        }
        }  
    }); 

</script> 
