<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-gears "></i><small> <?php echo lang('branch_setting'); ?></small></h3>
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
                        <li  class="active"><a href="#tab_setting"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-gear"></i> <?php echo lang('branch_setting'); ?></a> </li> 
                     </ul>
                     <br/>
                     <div class="tab-content">
                         <div class="tab-pane fade in active"id="tab_setting">
                            <div class="x_content"> 
                                <?php $action = isset($school) ? 'edit' : 'add'; ?>
                                <?php echo form_open_multipart(site_url('setting/'. $action), array('name' => 'setting', 'id' => 'setting', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                <input type="hidden" value="<?php echo isset($school) ? $school->id : ''; ?>" name="id" />
                               
                                          
                                <div class="row">                  
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <h5  class="column-title"><strong><?php echo lang('basic_information'); ?>:</strong></h5>
                                    </div>
                                </div>
                                
                                <?php if($school->branch_url){ ?>
                                <div class="row">                                    
                                    <div class="col-md-12 col-sm-12 col-xs-12 red">
                                            <?php echo lang('branch_url'); ?> : <a class="red" target="_blank" href="<?php echo site_url($school->branch_url); ?>"><?php echo site_url($school->branch_url); ?></a>
                                            <div class="clear">&nbsp;</div>
                                    </div>
                                </div>
                                <?php } ?> 
                                
                                <div class="row">
                                    
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="branch_name"><?php echo lang('branch_name'); ?> <span class="required">*</span></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="branch_name"  id="branch_name" value="<?php echo isset($school) ? $school->branch_name : ''; ?>" placeholder="<?php echo lang('branch_name'); ?>" required="required" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('branch_name'); ?></div> 
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="branch_code"><?php echo lang('branch_code'); ?></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="branch_code"  id="branch_code" value="<?php echo isset($school) ? $school->branch_code : ''; ?>" placeholder="<?php echo lang('branch_code'); ?> "  type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('branch_code'); ?></div> 
                                        </div>
                                    </div>
                                                                        
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="address"><?php echo lang('address'); ?> <span class="required">*</span></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="address"  id="address" value="<?php echo isset($school) ? $school->address : ''; ?>" placeholder="<?php echo lang('address'); ?> " required="required" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('address'); ?></div> 
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="phone"><?php echo lang('phone'); ?> <span class="required">*</span></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="phone"  id="phone" value="<?php echo isset($school) ? $school->phone : ''; ?>" placeholder="<?php echo lang('phone'); ?> " required="required" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('phone'); ?></div> 
                                        </div>
                                    </div>
                                    
                                </div>
                                    
                                <div class="row">      
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="registration_date"><?php echo lang('registration_date'); ?> <span class="required">*</span></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="registration_date"  id="edit_registration_date" value="<?php echo isset($school) ? $school->registration_date : ''; ?>" placeholder="<?php echo lang('registration_date'); ?> " required="required" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('registration_date'); ?></div> 
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="email"><?php echo lang('email'); ?> <span class="required">*</span></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="email"  id="email" value="<?php echo isset($school) ? $school->email : ''; ?>" placeholder="<?php echo lang('email'); ?> " required="required" type="email" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('email'); ?></div> 
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="branch_fax"><?php echo lang('branch_fax'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="branch_fax"  id="branch_fax" value="<?php echo isset($school) ? $school->branch_fax : ''; ?>" placeholder="<?php echo lang('branch_fax'); ?> " type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('branch_fax'); ?></div> 
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="footer"><?php echo lang('footer'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="footer"  id="footer" value="<?php echo isset($school) ? $school->footer : ''; ?>" placeholder="<?php echo lang('footer'); ?> " type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('footer'); ?></div> 
                                        </div>
                                    </div> 
                                </div> 
                                
                                <div class="row">                                    
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="item form-group">
                                            <label for="branch_url"><?php echo lang('branch_url'); ?> <span class="required">*</span></label>
                                            <input  class="form-control col-lg-7 col-md-7 col-xs-12"  name="branch_url"  id="branch_url" value="<?php echo isset($school) ?  $school->branch_url : ''; ?>" placeholder="<?php echo lang('branch_url'); ?> "  type="text" required="required" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('branch_url'); ?></div>                                            
                                            <div class="note">
                                                Branch URL will be : No Space, No Capital Letter, No Special Character. Ex: south-point OR london-school OR liverpool
                                            </div>
                                        </div>
                                    </div>                                    
                                </div>
                                 
                                <div class="row">                  
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <h5  class="column-title"><strong><?php echo lang('setting_information'); ?>:</strong></h5>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="currency"><?php echo lang('currency'); ?></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="currency"  id="currency" value="<?php echo isset($school) ? $school->currency : ''; ?>" placeholder="<?php echo lang('currency'); ?> " type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('currency'); ?></div> 
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="currency_symbol"><?php echo lang('currency_symbol'); ?> <span class="required">*</span></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="currency_symbol"  id="currency_symbol" value="<?php echo isset($school) ? $school->currency_symbol : ''; ?>" placeholder="<?php echo lang('currency_symbol'); ?> " required="required" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('currency_symbol'); ?></div> 
                                        </div>
                                    </div>                                   
                                   
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="enable_frontend"><?php echo lang('enable_frontend'); ?> <span class="required">*</span></label>
                                            <select  class="form-control col-md-7 col-xs-12"  name="enable_frontend" required="required">
                                                <option value="1" <?php if(isset($school) && $school->enable_frontend == 1){ echo 'selected="selected"';} ?>><?php echo lang('yes'); ?></option>
                                                <option value="0" <?php if(isset($school) && $school->enable_frontend == 0){ echo 'selected="selected"';} ?>><?php echo lang('no'); ?></option>
                                            </select>
                                            <div class="help-block"><?php echo form_error('enable_frontend'); ?></div> 
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="final_result_type"><?php echo lang('final_result_based_on'); ?> <span class="required">*</span></label>
                                            <select  class="form-control col-md-7 col-xs-12"  name="final_result_type" required="required">
                                                <option value="0" <?php if(isset($school) && $school->final_result_type == 0){ echo 'selected="selected"';} ?>><?php echo lang('avg_of_all_exam'); ?> </option>
                                                <option value="1" <?php if(isset($school) && $school->final_result_type == 1){ echo 'selected="selected"';} ?>><?php echo lang('only_of_fianl_exam'); ?> </option>
                                            </select>
                                            <div class="help-block"><?php echo form_error('final_result_type'); ?></div> 
                                        </div>
                                    </div>
                               
                                    
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="branch_lat"><?php echo lang('branch_lat'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="branch_lat"  id="branch_lat" value="<?php echo isset($school) ? $school->branch_lat : ''; ?>" placeholder="<?php echo lang('branch_lat'); ?> "  type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('branch_lat'); ?></div> 
                                        </div>
                                    </div>    
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="branch_lng"><?php echo lang('branch_lng'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="branch_lng"  id="branch_lng" value="<?php echo isset($school) ? $school->branch_lng : ''; ?>" placeholder="<?php echo lang('branch_lng'); ?> "  type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('branch_lng'); ?></div> 
                                        </div>
                                    </div>    
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="map_api_key">
                                                Google Map <?php echo lang('api_key'); ?> 
                                                [ <a target="_blank" href="https://developers.google.com/maps/documentation/embed/get-api-key"><?php echo lang('get_api_key'); ?></a>]
                                            </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="map_api_key"  id="map_api_key" value="<?php echo isset($school) ?  $school->map_api_key : ''; ?>" placeholder="<?php echo lang('api_key'); ?> "  type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('map_api_key'); ?></div> 
                                        </div>
                                    </div>                                      
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="enable_online_admission"><?php echo lang('online_admission'); ?> </label>
                                            <select  class="form-control col-md-7 col-xs-12"  name="enable_online_admission" id="enable_online_admission" >
                                                <option value="" >--<?php echo lang('select'); ?>--</option>
                                                <option value="0" <?php if(isset($school) && $school->enable_online_admission == 0){ echo 'selected="selected"';} ?>><?php echo lang('no'); ?></option>
                                                <option value="1" <?php if(isset($school) && $school->enable_online_admission == 1){ echo 'selected="selected"';} ?>><?php echo lang('yes'); ?></option>
                                            </select>
                                            <div class="help-block"><?php echo form_error('enable_online_admission'); ?></div> 
                                        </div>
                                    </div>
                                    
                                </div>  
                                
                                <div class="row">  
                                    
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="language"><?php echo lang('language'); ?> <span class="required">*</span></label>
                                            <select  class="form-control col-md-7 col-xs-12"  name="language" id="language" required="required">
                                                <option value="" >--<?php echo lang('select'); ?>--</option>
                                                 <?php foreach($fields as $field){ ?>
                                                    <?php  if($field == 'id' || $field == 'label'){ continue; } ?>
                                                    <option value="<?php echo $field; ?>" <?php if(isset($school) && $school->language == $field){ echo 'selected="selected"';} ?>><?php echo ucfirst($field); ?></option>
                                                <?php } ?>
                                            </select>
                                            <div class="help-block"><?php echo form_error('language'); ?></div> 
                                        </div>
                                    </div>
                                    
                                </div>
                                
                                
                                 <div class="row">                  
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <h5  class="column-title"><strong><?php echo lang('live_class'); ?>:</strong></h5>
                                    </div>
                                </div>
                                 <div class="row"> 
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                            <div class="item form-group">
                                                <label for="zoom_api_key"><?php echo lang('zoom_api_key'); ?> </label>
                                                <input  class="form-control col-md-7 col-xs-12"  name="zoom_api_key"  id="zoom_api_key" value="<?php echo isset($school) ? $school->zoom_api_key : ''; ?>" placeholder="<?php echo lang('zoom_api_key'); ?> "  type="text" autocomplete="off">
                                                <div class="help-block"><?php echo form_error('zoom_api_key'); ?></div> 
                                            </div>
                                    </div>    
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="zoom_secret"><?php echo lang('zoom_secret'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="zoom_secret"  id="zoom_secret" value="<?php echo isset($school) ? $school->zoom_secret : ''; ?>" placeholder="<?php echo lang('zoom_secret'); ?> "  type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('zoom_secret'); ?></div> 
                                        </div>
                                    </div>  
                                     
                                    
                                 </div>
                                                                
                                <div class="row">                  
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <h5  class="column-title"><strong><?php echo lang('social_link'); ?>:</strong></h5>
                                    </div>
                                </div>
                                
                                <div class="row">
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="facebook_url"><?php echo lang('facebook_url'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="facebook_url"  id="facebook_url" value="<?php echo isset($school) ? $school->facebook_url : ''; ?>" placeholder="<?php echo lang('facebook_url'); ?> " type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('facebook_url'); ?></div> 
                                        </div>
                                    </div>
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="twitter_url"><?php echo lang('twitter_url'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="twitter_url"  id="twitter_url" value="<?php echo isset($school) ? $school->twitter_url : ''; ?>" placeholder="<?php echo lang('twitter_url'); ?> " type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('twitter_url'); ?></div> 
                                        </div>
                                    </div>
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="linkedin_url"><?php echo lang('linkedin_url'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="linkedin_url"  id="linkedin_url" value="<?php echo isset($school) ? $school->linkedin_url : ''; ?>" placeholder="<?php echo lang('linkedin_url'); ?> " type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('linkedin_url'); ?></div> 
                                        </div>
                                    </div>
                                    
                                                                       
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="youtube_url"><?php echo lang('youtube_url'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="youtube_url"  id="youtube_url" value="<?php echo isset($school) ? $school->youtube_url : ''; ?>" placeholder="<?php echo lang('youtube_url'); ?> " type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('youtube_url'); ?></div> 
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="instagram_url"><?php echo lang('instagram_url'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="instagram_url"  id="instagram_url" value="<?php echo isset($school) ? $school->instagram_url : ''; ?>" placeholder="<?php echo lang('instagram_url'); ?> " type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('instagram_url'); ?></div> 
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="pinterest_url"><?php echo lang('pinterest_url'); ?> </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="pinterest_url"  id="pinterest_url" value="<?php echo isset($school) ? $school->pinterest_url : ''; ?>" placeholder="<?php echo lang('pinterest_url'); ?> " type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('pinterest_url'); ?></div> 
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row">                  
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <h5  class="column-title"><strong><?php echo lang('other_information'); ?>:</strong></h5>
                                    </div>
                                </div>
                                
                                <div class="row">                             
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="logo"><?php echo lang('frontend_logo'); ?></label>
                                            <div class="btn btn-default btn-file"><i class="fa fa-paperclip"></i> <?php echo lang('upload'); ?>
                                                <input  class="form-control col-md-7 col-xs-12"  name="frontend_logo" id="frontend_logo"  type="file">
                                            </div>
                                            <?php if($school->frontend_logo){ ?>
                                               <img  class="logo-identifier" src="<?php echo UPLOAD_PATH; ?>logo/<?php echo $school->frontend_logo; ?>" alt="" width="70"/><br/><br/>
                                                <input name="frontend_logo_prev" value="<?php echo isset($school) ? $school->frontend_logo : ''; ?>"  type="hidden">
                                           <?php } ?>
                                            <div class="help-block"><?php echo form_error('frontend_logo'); ?></div> 
                                        </div>
                                    </div>                                   
                                    
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="logo"><?php echo lang('admin_logo'); ?></label>
                                            <div class="btn btn-default btn-file"><i class="fa fa-paperclip"></i> <?php echo lang('upload'); ?>
                                                <input  class="form-control col-md-7 col-xs-12"  name="logo" id="logo"  type="file">
                                            </div>
                                            <?php if($school->logo){ ?>
                                            <img class="logo-identifier" src="<?php echo UPLOAD_PATH; ?>logo/<?php echo $school->logo; ?>" alt="" width="70"/><br/><br/>
                                                <input name="logo_prev" value="<?php echo isset($school) ? $school->logo : ''; ?>"  type="hidden">
                                            <?php } ?>
                                            <div class="help-block"><?php echo form_error('logo'); ?></div> 
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="logo">&nbsp;</label>
                                           
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="logo">&nbsp;</label>
                                            
                                        </div>
                                    </div>
                                    
                                </div>                                 

                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <input type="hidden" value="<?php echo isset($school) ? $school->id : '' ?>" name="id" />
                                        <button id="send" type="submit" class="btn btn-success"><?php  echo lang('update'); ?></button>
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
 <script type="text/javascript">
     
   $('#edit_registration_date').datepicker();
    $("#setting").validate();  
</script>