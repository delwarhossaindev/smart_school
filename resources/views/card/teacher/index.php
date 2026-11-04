<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-barcode"></i><small> <?php echo lang('generate_teacher_id_card'); ?></small></h3>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
             
            <div class="x_content quick-link no-print">
                <?php ci()->load->view('quick-link'); ?>     
            </div>
            

            <div class="x_content no-print"> 
                <?php echo form_open_multipart(site_url('card/teacher/index'), array('name' => 'generate', 'id' => 'generate', 'class' => 'form-horizontal form-label-left'), ''); ?>
                <div class="row">

                    <?php ci()->load->view('layout/school_list_filter'); ?>

                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="item form-group"> 
                            <div><?php echo lang('teacher'); ?> <span class="required">*</span></div>
                            <select  class="form-control col-md-7 col-xs-12"  name="teacher_id"  id="teacher_id">
                                <option value="0"><?php echo lang('all'); ?> <?php echo lang('teacher'); ?></option>  
                                <?php if (isset($teachers) && !empty($teachers)) { ?>
                                    <?php foreach ($teachers as $obj) { ?>
                                        <option value="<?php echo $obj->id; ?>" <?php if (isset($teacher_id) && $teacher_id == $obj->id) { echo 'selected="selected"'; } ?>><?php echo $obj->name; ?></option>
                                    <?php } ?> 
                                <?php } ?> 
                            </select>
                            <div class="help-block"><?php echo form_error('teacher_id'); ?></div>
                        </div>
                    </div>                
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="form-group"><br/>
                            <button id="send" type="submit" class="btn btn-success"><?php echo lang('generate'); ?></button>
                        </div>
                    </div>

                </div>
                <?php echo form_close(); ?>
            </div>

            <div class="x_content">
                <div class="" data-example-id="togglable-tabs">                    
                    <ul  class="nav nav-tabs bordered no-print">                 
                        <li  class="active"><a href="#tab_teacher_list" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa fa fa-users"></i> <?php echo lang('list'); ?></a></li>                          
                    </ul>
                    <br/>
                    <div class="tab-content">
                        <div  class="tab-pane fade in active" id="tab_teacher_list">
                            <div class="x_content">
                                
                               <div class="row">
                                   
                                   <?php if(isset($cards) && !empty($cards)){ ?>
                                        <?php $counter = 1; foreach($cards as $obj){ ?>  

                                            <div class="card-block">
                                                <div class="card-top">
                                                    <div class="card-logo">
                                                        <?php  if($setting->branch_logo != ''){ ?>
                                                           <img src="<?php echo UPLOAD_PATH; ?>logo/<?php echo $setting->branch_logo; ?>" alt="" /> 
                                                        <?php }else if($school->logo){ ?>
                                                           <img src="<?php echo UPLOAD_PATH; ?>logo/<?php echo $school->logo; ?>" alt="" /> 
                                                        <?php }else if($school->frontend_logo){ ?>
                                                           <img src="<?php echo UPLOAD_PATH; ?>logo/<?php echo $school->frontend_logo; ?>" alt="" /> 
                                                        <?php }else{ ?>                                                        
                                                           <img src="<?php echo UPLOAD_PATH; ?>logo/<?php echo ci()->global_setting->brand_logo; ?>" alt=""  />
                                                        <?php } ?>                                                          
                                                    </div>
                                                    <div class="card-school">
                                                        <h2><?php echo isset($setting->branch_name) ? $setting->branch_name : $school->branch_name; ?></h2>
                                                        <p><?php echo isset($setting->branch_address) && $setting->branch_address != '' ? $setting->branch_address : $school->address;; ?></p>
                                                        <p><?php echo lang('phone'); ?>: <?php echo isset($setting->phone) && $setting->phone != '' ? $setting->phone : $school->phone;; ?></p>
                                                    </div>
                                                </div>
                                                <div class="std-id">
                                                    <h3><span><?php echo lang('teacher_id'); ?>: <?php echo $obj->user_id; ?></span> </h3>
                                                </div>
                                                <div class="card-main">
                                                    <div class="card-photo">
                                                        <?php  if($obj->photo != ''){ ?>
                                                        <img src="<?php echo UPLOAD_PATH; ?>teacher-photo/<?php echo $obj->photo; ?>" alt="" /> 
                                                        <?php }else{ ?>
                                                        <img src="<?php echo IMG_URL; ?>default-user.png" alt=""  /> 
                                                        <?php } ?>
                                                    </div>
                                                    <div class="card-info">
                                                        <p><span class="card-title"><?php echo lang('teacher_name'); ?></span><span class="card-value">: <?php echo $obj->name; ?></span></p>
                                                        <p><span class="card-title"><?php echo lang('responsibility'); ?></span><span class="card-value">: <?php echo $obj->responsibility; ?></span></p>
                                                        <p><span class="card-title"><?php echo lang('blood_group'); ?></span><span class="card-value">: <?php echo lang($obj->blood_group); ?></span></p>
                                                        <p><span class="card-title"><?php echo lang('birth_date'); ?></span><span class="card-value">: <?php echo date(ci()->global_setting->date_format, strtotime($obj->dob)); ?></span></p>
                                                        <p><span class="card-title"><?php echo lang('join_date'); ?></span><span class="card-value">: <?php echo date(ci()->global_setting->date_format, strtotime($obj->joining_date)); ?></span></p>
                                                    </div>
                                                </div>
                                                <div class="card-bottom">
                                                    <p><?php echo isset($setting->bottom_text) ? $setting->bottom_text : ''; ?></p>
                                                </div>
                                            </div>

                                        <?php if($counter%4 == 0){ ?>                                               
                                              <div class="pagebreak">&nbsp;</div>                                              
                                        <?php } ?>
                                       <?php $counter++; } ?>
                                   <?php } ?>
                                    
                               </div>
                                
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
            <div class="row no-print"></div>
            <div class="ln_solid no-print"></div>
            <div class="row no-print">
                <div class="col-xs-12 text-right">
                    <button class="btn btn-default " onclick="window.print();"><i class="fa fa-print"></i> <?php echo lang('print'); ?></button>
                </div>
            </div>
            
        </div>
    </div>
</div>

<link href="<?php echo CSS_URL; ?>card.css" rel="stylesheet">
<?php ci()->load->view('layout/card'); ?>   
<!-- Super admin js START  -->
<script type="text/javascript">

    $("document").ready(function () {
        <?php if (isset($branch_id) && !empty($branch_id)) { ?>
            $("#branch_id").trigger('change');
        <?php } ?>
    });

    $('#branch_id').on('change', function () {

        var branch_id = $(this).val();
        var teacher_id = '';
        <?php if (isset($branch_id) && !empty($branch_id)) { ?>
            teacher_id = '<?php echo $teacher_id; ?>';
        <?php } ?>

        if (!branch_id) {
            toastr.error('<?php echo lang('select_branch'); ?>');
           return false;
        }
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('ajax/get_teacher_by_school'); ?>",
            data: {branch_id: branch_id, teacher_id: teacher_id, is_all:true},
            async: false,
            success: function (response) {
                if (response)
                {
                    $('#teacher_id').html(response);
                }
            }
        });
    });

</script>
<!-- Super admin js end -->


<script type="text/javascript">
    $("#generate").validate();
</script> 
