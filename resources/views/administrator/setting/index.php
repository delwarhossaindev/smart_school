<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-gears "></i><small> <?php echo lang('general_setting'); ?></small></h3>
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
                        <li  class="active"><a href="#tab_setting"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-gear"></i> <?php echo lang('general_setting'); ?></a> </li> 
                     </ul>
                     <br/>
                     <div class="tab-content">
                         <div class="tab-pane fade in active"id="tab_setting">
                            <div class="x_content"> 
                                <?php $action = isset($setting) ? 'edit' : 'add'; ?>
                                <?php echo form_open_multipart(site_url('administrator/setting/'. $action), array('name' => 'setting', 'id' => 'setting', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                <input type="hidden" value="<?php echo isset($setting) ? $setting->id : ''; ?>" name="id" />
                                  
                                 <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="brand_name"><?php echo lang('brand_name'); ?> <span class="required">*</span></label>
                                   <div class="col-md-6 col-sm-6 col-xs-12">                                      
                                        <input  class="form-control col-md-7 col-xs-12"  name="brand_name"  id="brand_name" value="<?php echo isset($setting) ?  $setting->brand_name : ''; ?>" placeholder="<?php echo lang('brand_name'); ?> " type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('brand_name'); ?></div> 
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="brand_title"><?php echo lang('brand_title'); ?></label>
                                   <div class="col-md-6 col-sm-6 col-xs-12">                                      
                                        <input  class="form-control col-md-7 col-xs-12"  name="brand_title"  id="brand_title" value="<?php echo isset($setting) ?  $setting->brand_title : ''; ?>" placeholder="<?php echo lang('brand_title'); ?> " type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('brand_title'); ?></div> 
                                    </div>
                                </div>
                                
                                 <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="language"><?php echo lang('global_language'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="language"  required="required">
                                            <option value="">--<?php echo lang('select'); ?>--</option>
                                            <?php foreach($fields as $field){ ?>
                                                <?php  if($field == 'id' || $field == 'label'){ continue; } ?>
                                            <option value="<?php echo $field; ?>" <?php if(isset($setting) && $setting->language == $field){ echo 'selected="selected"';} ?>><?php echo ucfirst($field); ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="help-block"><?php echo form_error('language'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="currency"><?php echo lang('currency'); ?></label>
                                   <div class="col-md-6 col-sm-6 col-xs-12">                                      
                                        <input  class="form-control col-md-7 col-xs-12"  name="currency"  id="currency" value="<?php echo isset($setting) ?  $setting->currency : ''; ?>" placeholder="<?php echo lang('currency'); ?> " type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('currency'); ?></div> 
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="currency_symbol"><?php echo lang('currency_symbol'); ?></label>
                                   <div class="col-md-6 col-sm-6 col-xs-12">                                      
                                        <input  class="form-control col-md-7 col-xs-12"  name="currency_symbol"  id="currency_symbol" value="<?php echo isset($setting) ?  $setting->currency_symbol : ''; ?>" placeholder="<?php echo lang('currency_symbol'); ?> " type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('currency_symbol'); ?></div> 
                                    </div>
                                </div>
                                                           
                                <div class="item form-group">
                                   <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="enable_rtl"><?php echo lang('enable_rtl'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="enable_rtl" required="required">
                                            <option value="0" <?php if(isset($setting) && $setting->enable_rtl == 0){ echo 'selected="selected"';} ?>><?php echo lang('no'); ?></option>
                                            <option value="1" <?php if(isset($setting) && $setting->enable_rtl == 1){ echo 'selected="selected"';} ?>><?php echo lang('yes'); ?></option>
                                        </select>
                                        <div class="help-block"><?php echo form_error('enable_rtl'); ?></div> 
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"  for="enable_frontend"><?php echo lang('enable_frontend'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="enable_frontend" required="required">
                                            <option value="1" <?php if(isset($setting) && $setting->enable_frontend == '1'){ echo 'selected="selected"';} ?>><?php echo lang('yes'); ?></option>
                                            <option value="0" <?php if(isset($setting) && $setting->enable_frontend == '0'){ echo 'selected="selected"';} ?>><?php echo lang('no'); ?></option>
                                        </select>
                                        <div class="help-block"><?php echo form_error('enable_frontend'); ?></div> 
                                    </div>
                                </div>
                                
                              
                                <div class="item form-group">
                                    <label   class="control-label col-md-3 col-sm-3 col-xs-12"  for="theme_name"><?php echo lang('theme'); ?> <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="theme_name" required="required">
                                            <option value="">--<?php echo lang('select'); ?>--</option>
                                            <?php foreach($themes AS $obj){ ?>
                                            <option style="color: #FFF;background-color: <?php echo $obj->color_code; ?>;" value="<?php echo $obj->slug; ?>" <?php if(isset($setting) && $setting->theme_name == $obj->slug){ echo 'selected="selected"';} ?>><?php echo $obj->name; ?> </option>
                                            <?php } ?>
                                        </select>
                                        <div class="help-block"><?php echo form_error('theme_name'); ?></div> 
                                    </div>
                                </div>
                                   
                                
                                <div class="item form-group">
                                    <label  class="control-label col-md-3 col-sm-3 col-xs-12"  for="default_time_zone"><?php echo lang('default_time_zone'); ?> <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <?php $timezones = get_timezones(); ?>
                                        <select  class="form-control col-md-7 col-xs-12"  name="time_zone" required="required">
                                            <option value="">--<?php echo lang('select'); ?>--</option>
                                            <?php foreach($timezones as $key=>$value){ ?>
                                                <option value="<?php echo $key; ?>" <?php if(isset($setting) && $setting->time_zone == $key){ echo 'selected="selected"';} ?>><?php echo $value; ?> </option>
                                            <?php } ?>
                                        </select>
                                        <div class="help-block"><?php echo form_error('time_zone'); ?></div> 
                                    </div>
                                </div>
                               

                              
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="date_format"><?php echo lang('date_format'); ?> <span class="required">*</span></label>
                                   <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?php $dates = get_date_format(); ?>
                                    <select  class="form-control col-md-7 col-xs-12"  name="date_format" required="required">
                                        <option value="">--<?php echo lang('select'); ?>--</option>
                                        <?php foreach($dates as $key=>$value){ ?>
                                            <option value="<?php echo $key; ?>" <?php if(isset($setting) && $setting->date_format == $key){ echo 'selected="selected"';} ?>><?php echo $value; ?> </option>
                                        <?php } ?>
                                    </select>
                                    <div class="help-block"><?php echo form_error('date_format'); ?></div> 
                                    </div>
                                </div>
                                
                                                  

                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="logo"><?php echo lang('brand_logo'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                         <?php if(isset($setting) && $setting->brand_logo){ ?>
                                             <img class="logo-identifier" src="<?php echo UPLOAD_PATH; ?>logo/<?php echo $setting->brand_logo; ?>" alt="" width="70" /><br/><br/>
                                             <input name="logo_prev" value="<?php echo isset($setting) ? $setting->brand_logo : ''; ?>"  type="hidden">
                                        <?php } ?>
                                        <div class="btn btn-default btn-file"><i class="fa fa-paperclip"></i> <?php echo lang('upload'); ?>
                                            <input  class="form-control col-md-7 col-xs-12"  name="logo" id="logo" type="file">
                                        </div>
                                        <div class="help-block"><?php echo form_error('logo'); ?></div>
                                    </div>
                                </div>
                                                           
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="favicon_icon"><?php echo lang('favicon_icon'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                         <?php if(isset($setting) && $setting->favicon_icon){ ?>
                                             <img class="logo-identifier" src="<?php echo UPLOAD_PATH; ?>logo/<?php echo $setting->favicon_icon; ?>" alt="" width="20" /><br/><br/>
                                             <input name="favicon_icon_prev" value="<?php echo isset($setting) ? $setting->favicon_icon : ''; ?>"  type="hidden">
                                        <?php } ?>
                                        <div class="btn btn-default btn-file"><i class="fa fa-paperclip"></i> <?php echo lang('upload'); ?>
                                            <input  class="form-control col-md-7 col-xs-12"  name="favicon_icon" id="favicon_icon" type="file">
                                        </div>
                                        <div class="help-block"><?php echo form_error('favicon_icon'); ?></div>
                                    </div>
                                </div>
                                
                                                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="brand_footer"><?php echo lang('brand_footer'); ?> </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">                                      
                                        <input  class="form-control col-md-7 col-xs-12"  name="brand_footer"  id="brand_footer" value="<?php echo isset($setting) ?  $setting->brand_footer : ''; ?>" placeholder="<?php echo lang('brand_footer'); ?> " type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('brand_footer'); ?></div> 
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="google_analytics"> <?php echo lang('google_analytics'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">                                      
                                        <input  class="form-control col-md-7 col-xs-12"  name="google_analytics"  id="google_analytics" value="<?php echo isset($setting) ?  $setting->google_analytics : ''; ?>" placeholder="<?php echo lang('google_analytics'); ?> " type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('google_analytics'); ?></div> 
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="default_school_id"><?php echo lang('default_school'); ?> <span class="required">*</span> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">      
                                        <select  class="form-control col-md-7 col-xs-12" id="default_school_id" name="default_school_id" required="required">
                                            <?php foreach(ci()->schools as $obj){ ?>
                                                <option value="<?php echo $obj->id; ?>" <?php if(isset($setting) && $setting->default_school_id == $obj->id){ echo 'selected="selected"';} ?>><?php echo $obj->branch_name; ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="help-block"><?php echo form_error('default_school_id'); ?></div> 
                                    </div>
                                </div>

                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <a href="<?php echo site_url('dashboard'); ?>" class="btn btn-primary"><?php echo lang('cancel'); ?></a>
                                        <button id="send" type="submit" class="btn btn-success"><?php  echo $action == 'add' ? lang('submit') : lang('update'); ?></button>
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
    $("#setting").validate();  
</script>