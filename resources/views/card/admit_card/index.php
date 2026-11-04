<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-barcode"></i><small> <?php echo lang('manage_admit_card_setting'); ?></small></h3>
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
                        <li class="<?php if(isset($list)){ echo 'active'; }?>"><a href="#tab_setting_list"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-list-ol"></i> <?php echo lang('list'); ?></a> </li>
                        <?php if(has_permission(ADD, 'card', 'admitsetting')){ ?>
                            <?php if(isset($edit)){ ?>
                        <li  class="<?php if(isset($add)){ echo 'active'; }?>"><a href="<?php echo site_url('card/admitsetting/add'); ?>" aria-expanded="false"><i class="fa fa-plus-square-o"></i> <?php echo lang('add'); ?></a> </li>                          
                            <?php }else{ ?>
                                <li  class="<?php if(isset($add)){ echo 'active'; }?>"><a href="#tab_add_setting"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-plus-square-o"></i> <?php echo lang('add'); ?></a> </li>                          
                            <?php } ?>     
                        <?php } ?>     
                        <?php if(isset($edit)){ ?>
                            <li  class="active"><a href="#tab_edit_setting"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-pencil-square-o"></i> <?php echo lang('edit'); ?></a> </li>                          
                        <?php } ?>  
                    </ul>
                    <br/>
                    
                    <div class="tab-content">
                        
                        <div  class="tab-pane fade in <?php if(isset($list)){ echo 'active'; }?>" id="tab_setting_list" >
                            <div class="x_content">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo lang('sl_no'); ?></th>
                                         <?php if(ci()->session->userdata('role_id') == SUPER_ADMIN){ ?>
                                            <th><?php echo lang('branch'); ?></th>
                                        <?php } ?>
                                        <th><?php echo lang('border_color'); ?></th>
                                        <th><?php echo lang('top_background'); ?></th>
                                        <th><?php echo lang('bottom_signature'); ?></th>
                                        <th><?php echo lang('signature_background'); ?></th>
                                        <th><?php echo lang('action'); ?></th>                                            
                                    </tr>
                                </thead>
                                <tbody>   
                                    <?php $count = 1; if(isset($settings) && !empty($settings)){ ?>
                                        <?php foreach($settings as $obj){ ?>                                       
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <?php if(ci()->session->userdata('role_id') == SUPER_ADMIN){ ?>
                                                <td><?php echo $obj->branch_name; ?></td>
                                            <?php } ?>
                                            <td><span style="padding: 4px 10px; background-color:<?php echo $obj->border_color; ?>"></span></td>                                           
                                            <td><span style="padding: 4px 10px; background-color:<?php echo $obj->top_bg; ?>"></span></td>                                           
                                            <td><?php echo $obj->bottom_text; ?></td>                                          
                                            <td><span style="padding: 4px 10px; background-color:<?php echo $obj->bottom_bg; ?>"></span></td>                                           
                                                                                      
                                            <td>
                                                <?php if(has_permission(VIEW, 'card', 'admitsetting')){ ?>
                                                    <a  onclick="get_setting_modal(<?php echo $obj->id; ?>);"  data-toggle="modal" data-target=".bs-setting-modal-lg"  class="btn btn-success btn-xs"><i class="fa fa-eye"></i> <?php echo lang('view'); ?> </a>
                                                <?php } ?>
                                                <?php if(has_permission(EDIT, 'card', 'admitsetting')){ ?>
                                                    <a href="<?php echo site_url('card/admitsetting/edit/'.$obj->id); ?>" class="btn btn-success btn-xs"><i class="fa fa-edit"></i> <?php echo lang('edit'); ?> </a>
                                                <?php } ?>
                                                <?php if(has_permission(DELETE, 'card', 'admitsetting')){ ?>
                                                    <a href="<?php echo site_url('card/admitsetting/delete/'.$obj->id); ?>" onclick="javascript: return confirm('<?php echo lang('confirm_alert'); ?>');" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> <?php echo lang('delete'); ?> </a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                            </div>
                        </div>

                        <div  class="tab-pane fade in <?php if(isset($add)){ echo 'active'; }?>" id="tab_add_setting">
                            <div class="x_content"> 
                               <?php echo form_open_multipart(site_url('card/admitsetting/add'), array('name' => 'add', 'id' => 'add', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                
                                <?php ci()->load->view('layout/school_list_form'); ?>
                                       
                                <div class="form-group"> 
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="border_color"><?php echo lang('border_color'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                                        <div class="input-group fn_colorpicker">
                                            <input  class="form-control col-md-7 col-xs-12 " readonly="readonly"  name="border_color"  id="border_color" value="e01ab5" placeholder="<?php echo lang('border_color'); ?>" type="text" autocomplete="off">
                                             <span class="input-group-addon"><i></i></span>
                                        </div>
                                        <div class="help-block"><?php echo form_error('border_color'); ?></div>
                                    </div>
                                </div>
                                 
                                    
                                <div class="form-group"> 
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="top_bg"><?php echo lang('top_background'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                                        <div class="input-group fn_colorpicker">
                                            <input  class="form-control col-md-7 col-xs-12 " readonly="readonly"  name="top_bg"  id="top_bg" value="e01ab5" placeholder="<?php echo lang('top_background'); ?> " type="text" autocomplete="off">
                                            <span class="input-group-addon"><i></i></span>
                                        </div>
                                        <div class="help-block"><?php echo form_error('top_bg'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="form-group"> 
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="branch_name"><?php echo lang('card_branch_name'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="branch_name"  id="branch_name" value="" placeholder="<?php echo lang('card_branch_name'); ?>" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('branch_name'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="form-group"> 
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="branch_name_font_size"><?php echo lang('branch_name_font_size'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="branch_name_font_size"  id="branch_name_font_size" max="28" value="" placeholder="<?php echo lang('branch_name_font_size'); ?>" type="number" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('branch_name_font_size'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="form-group"> 
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="branch_name_color"><?php echo lang('branch_name_color'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="input-group fn_colorpicker">
                                            <input  class="form-control col-md-7 col-xs-12"  name="branch_name_color"  id="branch_name_color" readonly="readonly" value="e01ab5" placeholder="<?php echo lang('branch_name_color'); ?>" type="text" autocomplete="off">
                                         <span class="input-group-addon"><i></i></span>
                                        </div>
                                        <div class="help-block"><?php echo form_error('branch_name_color'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="form-group"> 
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="branch_address"><?php echo lang('branch_address'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="branch_address"  id="branch_address" value="" placeholder="<?php echo lang('branch_address'); ?>" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('branch_address'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="form-group"> 
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="branch_address_color"><?php echo lang('branch_address_color'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="input-group fn_colorpicker">
                                        <input  class="form-control col-md-7 col-xs-12"  name="branch_address_color"  id="branch_address_color" readonly="readonly"  value="e01ab5" placeholder="<?php echo lang('branch_address_color'); ?>" type="text" autocomplete="off">
                                        <span class="input-group-addon"><i></i></span>
                                        </div>
                                        <div class="help-block"><?php echo form_error('branch_address_color'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="form-group"> 
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="admit_font_size"><?php echo lang('admit_title_font_size'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="admit_font_size"  id="admit_font_size" max="20" value="" placeholder="<?php echo lang('admit_title_font_size'); ?> " type="number" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('admit_font_size'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="form-group"> 
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="admit_color"><?php echo lang('admit_title_color'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="input-group fn_colorpicker">
                                            <input  class="form-control col-md-7 col-xs-12"  name="admit_color"  id="admit_color" readonly="readonly" value="e01ab5" placeholder="<?php echo lang('admit_title_color'); ?> " type="text" autocomplete="off">
                                            <span class="input-group-addon"><i></i></span>
                                        </div>
                                        <div class="help-block"><?php echo form_error('admit_color'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="form-group"> 
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="admit_bg"><?php echo lang('admit_title_background'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="input-group fn_colorpicker">
                                            <input  class="form-control col-md-7 col-xs-12"  name="admit_bg"  id="admit_bg" readonly="readonly" value="e01ab5" placeholder="<?php echo lang('admit_title_background'); ?> " type="text" autocomplete="off">
                                            <span class="input-group-addon"><i></i></span>
                                        </div>
                                        <div class="help-block"><?php echo form_error('admit_bg'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="form-group"> 
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title_font_size"><?php echo lang('title_font_size'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="title_font_size"  id="title_font_size" max="12" value="" placeholder="<?php echo lang('title_font_size'); ?> " type="number" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('title_font_size'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="form-group"> 
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title_color"><?php echo lang('title_color'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="input-group fn_colorpicker">
                                            <input  class="form-control col-md-7 col-xs-12"  name="title_color"  id="title_color" readonly="readonly" value="e01ab5" placeholder="<?php echo lang('title_color'); ?> " type="text" autocomplete="off">
                                            <span class="input-group-addon"><i></i></span>
                                        </div>
                                        <div class="help-block"><?php echo form_error('title_color'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="form-group"> 
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="value_font_size"><?php echo lang('value_font_size'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="value_font_size"  id="value_font_size" max="13" value="" placeholder="<?php echo lang('value_font_size'); ?> " type="number" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('value_font_size'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="form-group"> 
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="value_color"><?php echo lang('value_color'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="input-group fn_colorpicker">
                                            <input  class="form-control col-md-7 col-xs-12"  name="value_color"  id="value_color" readonly="readonly" value="e01ab5" placeholder="<?php echo lang('value_color'); ?> " type="text" autocomplete="off">
                                            <span class="input-group-addon"><i></i></span>
                                        </div>
                                        <div class="help-block"><?php echo form_error('value_color'); ?></div>
                                    </div>
                                </div>   
                                
                                <div class="form-group"> 
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="exam_font_size"><?php echo lang('exam_title_font_size'); ?>  </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input  class="form-control col-md-7 col-xs-12"  name="exam_font_size"  id="exam_font_size"  placeholder="<?php echo lang('exam_title_font_size'); ?> " type="number" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('exam_font_size'); ?></div>
                                    </div>
                                </div>                                
                                                                    
                                <div class="form-group"> 
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="exam_color"><?php echo lang('exam_title_color'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                                        <div class="input-group fn_colorpicker">
                                            <input  class="form-control col-md-7 col-xs-12 " readonly="readonly"  name="exam_color"  id="exam_color" value="e01ab5" placeholder="<?php echo lang('exam_title_color'); ?> " type="text" autocomplete="off">
                                            <span class="input-group-addon"><i></i></span>
                                        </div>
                                        <div class="help-block"><?php echo form_error('exam_color'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="form-group"> 
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="subject_font_size"><?php echo lang('subject_font_size'); ?>  </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input  class="form-control col-md-7 col-xs-12"  name="subject_font_size"  id="subject_font_size"  placeholder="<?php echo lang('subject_font_size'); ?> " type="number" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('subject_font_size'); ?></div>
                                    </div>
                                </div>                                
                                                                    
                                <div class="form-group"> 
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="subject_color"><?php echo lang('subject_color'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                                        <div class="input-group fn_colorpicker">
                                            <input  class="form-control col-md-7 col-xs-12 " readonly="readonly"  name="subject_color"  id="subject_color" value="e01ab5" placeholder="<?php echo lang('subject_color'); ?> " type="text" autocomplete="off">
                                            <span class="input-group-addon"><i></i></span>
                                        </div>
                                        <div class="help-block"><?php echo form_error('subject_color'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="form-group"> 
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="bottom_text"><?php echo lang('bottom_signature'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="bottom_text"  id="bottom_text" value="" required="required" placeholder="<?php echo lang('bottom_signature'); ?> " type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('bottom_text'); ?></div>
                                    </div>
                                </div>  
                                <div class="form-group"> 
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="bottom_bg"><?php echo lang('signature_background'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                                        <div class="input-group fn_colorpicker">
                                            <input  class="form-control col-md-7 col-xs-12 " readonly="readonly"  name="bottom_bg"  id="bottom_bg" value="e01ab5" placeholder="<?php echo lang('signature_background'); ?> " type="text" autocomplete="off">
                                            <span class="input-group-addon"><i></i></span>
                                        </div>
                                        <div class="help-block"><?php echo form_error('bottom_bg'); ?></div>
                                    </div>
                                </div>
                                                                 
                                <div class="form-group"> 
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="bottom_text_color"><?php echo lang('signature_color'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="input-group fn_colorpicker">
                                        <input  class="form-control col-md-7 col-xs-12"  name="bottom_text_color"  id="bottom_text_color" readonly="readonly"  value="e01ab5" placeholder="<?php echo lang('signature_color'); ?>" type="text" autocomplete="off">
                                        <span class="input-group-addon"><i></i></span>
                                        </div>
                                        <div class="help-block"><?php echo form_error('bottom_text_color'); ?></div>
                                    </div>
                                </div>  
                                
                                <div class="form-group"> 
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="bottom_text_align"><?php echo lang('signature_align'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <?php $aligns = get_card_bottom_text_align(); ?>
                                        <select  class="form-control col-md-12 col-xs-12"  name="bottom_text_align"  id="bottom_text_align">
                                            <option value="">--<?php echo lang('select'); ?> --</option> 
                                            <?php foreach($aligns as $key=>$value ){ ?>
                                                <option value="<?php echo $key; ?>" ><?php echo $value; ?></option>
                                            <?php } ?>                                            
                                        </select>
                                        <div class="help-block"><?php echo form_error('bottom_text_align'); ?></div>
                                    </div>
                                </div>  
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="logo"><?php echo lang('card_logo'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">                                         
                                        <div class="btn btn-default btn-file"><i class="fa fa-paperclip"></i> <?php echo lang('upload'); ?>
                                            <input  class="form-control col-md-7 col-xs-12"  name="logo" id="logo" type="file">
                                        </div>
                                        <div class="help-block"><?php echo form_error('logo'); ?></div>
                                    </div>
                                </div>
                                  
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <a href="<?php echo site_url('card/admitsetting/index'); ?>" class="btn btn-primary"><?php echo lang('cancel'); ?></a>
                                        <button id="send" type="submit" class="btn btn-success"><?php echo lang('submit'); ?></button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>  
                        
                        
                        <div  class="tab-pane fade in <?php if(isset($edit)){ echo 'active'; }?>" id="tab_edit_setting">
                            <div class="x_content"> 
                               <?php echo form_open_multipart(site_url('card/admitsetting/edit/'.$setting->id), array('name' => 'add', 'id' => 'add', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                
                                <?php ci()->load->view('layout/school_list_edit_form'); ?>                                 
                                
                                <div class="form-group"> 
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="border_color"><?php echo lang('border_color'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                                        <div class="input-group fn_colorpicker">
                                            <input  class="form-control col-md-7 col-xs-12 " readonly="readonly"  name="border_color"  id="border_color" value="<?php echo isset($setting->border_color) ?  $setting->border_color : 'e01ab5'; ?>" placeholder="<?php echo lang('border_color'); ?>" type="text" autocomplete="off">
                                             <span class="input-group-addon"><i></i></span>
                                        </div>
                                        <div class="help-block"><?php echo form_error('border_color'); ?></div>
                                    </div>
                                </div>      
                                    
                                <div class="form-group"> 
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="top_bg"><?php echo lang('top_background'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                                        <div class="input-group fn_colorpicker">
                                            <input  class="form-control col-md-7 col-xs-12 " readonly="readonly"  name="top_bg"  id="top_bg" value="<?php echo isset($setting->top_bg) ?  $setting->top_bg : 'e01ab5'; ?>" placeholder="<?php echo lang('top_background'); ?> " type="text" autocomplete="off">
                                            <span class="input-group-addon"><i></i></span>
                                        </div>
                                        <div class="help-block"><?php echo form_error('top_bg'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="form-group"> 
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="branch_name"><?php echo lang('branch_name'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="branch_name"  id="branch_name" value="<?php echo isset($setting->branch_name) ?  $setting->branch_name : ''; ?>" placeholder="<?php echo lang('card_branch_name'); ?>" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('branch_name'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="form-group"> 
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="branch_name_font_size"><?php echo lang('branch_name_font_size'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="branch_name_font_size" max="28"  id="branch_name_font_size" value="<?php echo isset($setting->branch_name_font_size) ?  $setting->branch_name_font_size : ''; ?>" placeholder="<?php echo lang('branch_name_font_size'); ?>" type="number" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('branch_name_font_size'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="form-group"> 
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="branch_name_color"><?php echo lang('branch_name_color'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="input-group fn_colorpicker">
                                            <input  class="form-control col-md-7 col-xs-12"  name="branch_name_color"  id="branch_name_color" readonly="readonly" value="<?php echo isset($setting->branch_name_color) ?  $setting->branch_name_color : 'e01ab5'; ?>" placeholder="<?php echo lang('branch_name_color'); ?>" type="text" autocomplete="off">
                                         <span class="input-group-addon"><i></i></span>
                                        </div>
                                        <div class="help-block"><?php echo form_error('branch_name_color'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="form-group"> 
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="branch_address"><?php echo lang('branch_address'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="branch_address"  id="branch_address" value="<?php echo isset($setting->branch_address) ?  $setting->branch_address : ''; ?>" placeholder="<?php echo lang('branch_address'); ?>" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('branch_address'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="form-group"> 
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="branch_address_color"><?php echo lang('branch_address_color'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="input-group fn_colorpicker">
                                        <input  class="form-control col-md-7 col-xs-12"  name="branch_address_color"  id="branch_address_color" readonly="readonly"  value="<?php echo isset($setting->branch_address_color) ?  $setting->branch_address_color : 'e01ab5'; ?>" placeholder="<?php echo lang('branch_address_color'); ?>" type="text" autocomplete="off">
                                        <span class="input-group-addon"><i></i></span>
                                        </div>
                                        <div class="help-block"><?php echo form_error('branch_address_color'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="form-group"> 
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="admit_font_size"><?php echo lang('admit_title_font_size'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="admit_font_size"  id="admit_font_size" max="20" value="<?php echo isset($setting->admit_font_size) ?  $setting->admit_font_size : ''; ?>" placeholder="<?php echo lang('admit_title_font_size'); ?> " type="number" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('admit_font_size'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="form-group"> 
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="admit_color"><?php echo lang('admit_title_color'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="input-group fn_colorpicker">
                                            <input  class="form-control col-md-7 col-xs-12"  name="admit_color"  id="admit_color" readonly="readonly" value="<?php echo isset($setting->admit_color) ?  $setting->admit_color : 'e01ab5'; ?>" placeholder="<?php echo lang('admit_title_color'); ?> " type="text" autocomplete="off">
                                            <span class="input-group-addon"><i></i></span>
                                        </div>
                                        <div class="help-block"><?php echo form_error('admit_color'); ?></div>
                                    </div>
                                </div>
                                <div class="form-group"> 
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="admit_bg"><?php echo lang('admit_title_background'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="input-group fn_colorpicker">
                                            <input  class="form-control col-md-7 col-xs-12"  name="admit_bg"  id="admit_bg" readonly="readonly" value="<?php echo isset($setting->admit_bg) ?  $setting->admit_bg : 'e01ab5'; ?>" placeholder="<?php echo lang('admit_title_background'); ?> " type="text" autocomplete="off">
                                            <span class="input-group-addon"><i></i></span>
                                        </div>
                                        <div class="help-block"><?php echo form_error('admit_bg'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="form-group"> 
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title_font_size"><?php echo lang('title_font_size'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="title_font_size"  id="title_font_size" max="12" value="<?php echo isset($setting->title_font_size) ?  $setting->title_font_size : ''; ?>" placeholder="<?php echo lang('title_font_size'); ?> " type="number" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('title_font_size'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="form-group"> 
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title_color"><?php echo lang('title_color'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="input-group fn_colorpicker">
                                            <input  class="form-control col-md-7 col-xs-12"  name="title_color"  id="title_color" readonly="readonly" value="<?php echo isset($setting->title_color) ?  $setting->title_color : 'e01ab5'; ?>" placeholder="<?php echo lang('title_color'); ?> " type="text" autocomplete="off">
                                            <span class="input-group-addon"><i></i></span>
                                        </div>
                                        <div class="help-block"><?php echo form_error('title_color'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="form-group"> 
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="value_font_size"><?php echo lang('value_font_size'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="value_font_size"  id="value_font_size" max="13" value="<?php echo isset($setting->value_font_size) ?  $setting->value_font_size : ''; ?>" placeholder="<?php echo lang('value_font_size'); ?> " type="number" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('value_font_size'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="form-group"> 
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="value_color"><?php echo lang('value_color'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="input-group fn_colorpicker">
                                            <input  class="form-control col-md-7 col-xs-12"  name="value_color"  id="value_color" readonly="readonly" value="<?php echo isset($setting->value_color) ?  $setting->value_color : 'e01ab5'; ?>" placeholder="<?php echo lang('value_color'); ?>" type="text" autocomplete="off">
                                            <span class="input-group-addon"><i></i></span>
                                        </div>
                                        <div class="help-block"><?php echo form_error('value_color'); ?></div>
                                    </div>
                                </div>  
                                
                                 <div class="form-group"> 
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="exam_font_size"><?php echo lang('exam_title_font_size'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="exam_font_size"  id="exam_font_size" max="13" value="<?php echo isset($setting->exam_font_size) ?  $setting->exam_font_size : ''; ?>" placeholder="<?php echo lang('exam_title_font_size'); ?>" type="number" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('exam_font_size'); ?></div>
                                    </div>
                                </div>
                                 <div class="form-group"> 
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="exam_color"><?php echo lang('exam_title_color'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="input-group fn_colorpicker">
                                            <input  class="form-control col-md-7 col-xs-12"  name="exam_color"  id="exam_color" readonly="readonly" value="<?php echo isset($setting->exam_color) ?  $setting->exam_color : 'e01ab5'; ?>" placeholder="<?php echo lang('exam_title_color'); ?>" type="text" autocomplete="off">
                                            <span class="input-group-addon"><i></i></span>
                                        </div>
                                        <div class="help-block"><?php echo form_error('exam_color'); ?></div>
                                    </div>
                                </div>  
                                      
                                <div class="form-group"> 
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="subject_font_size"><?php echo lang('subject_font_size'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="subject_font_size"  id="subject_font_size" max="13" value="<?php echo isset($setting->subject_font_size) ?  $setting->subject_font_size : ''; ?>" placeholder="<?php echo lang('subject_font_size'); ?> " type="number" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('subject_font_size'); ?></div>
                                    </div>
                                </div>
                                 <div class="form-group"> 
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="subject_color"><?php echo lang('subject_color'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="input-group fn_colorpicker">
                                            <input  class="form-control col-md-7 col-xs-12"  name="subject_color"  id="subject_color" readonly="readonly" value="<?php echo isset($setting->subject_color) ?  $setting->subject_color : 'e01ab5'; ?>" placeholder="<?php echo lang('subject_color'); ?> " type="text" autocomplete="off">
                                            <span class="input-group-addon"><i></i></span>
                                        </div>
                                        <div class="help-block"><?php echo form_error('subject_color'); ?></div>
                                    </div>
                                </div>  
                                      
                                <div class="form-group"> 
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="bottom_bg"><?php echo lang('signature_background'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                                        <div class="input-group fn_colorpicker">
                                            <input  class="form-control col-md-7 col-xs-12 " readonly="readonly"  name="bottom_bg"  id="bottom_bg" readonly="readonly"  value="<?php echo isset($setting->bottom_bg) ?  $setting->bottom_bg : 'e01ab5'; ?>" placeholder="<?php echo lang('signature_background'); ?> " type="text" autocomplete="off">
                                            <span class="input-group-addon"><i></i></span>
                                        </div>
                                        <div class="help-block"><?php echo form_error('bottom_bg'); ?></div>
                                    </div>
                                </div>
                                <div class="form-group"> 
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="bottom_text"><?php echo lang('bottom_signature'); ?><span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="bottom_text"  id="bottom_text" required="required" value="<?php echo isset($setting->bottom_text) ?  $setting->bottom_text : ''; ?>" placeholder="<?php echo lang('bottom_signature'); ?>" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('bottom_text'); ?></div>
                                    </div>
                                </div> 
                                
                                <div class="form-group"> 
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="bottom_text_color"><?php echo lang('signature_color'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="input-group fn_colorpicker">
                                            <input  class="form-control col-md-7 col-xs-12"  name="bottom_text_color"  id="bottom_text_color" readonly="readonly"  value="<?php echo isset($setting->bottom_text_color) ?  $setting->bottom_text_color : 'e01ab5'; ?>" placeholder="<?php echo lang('signature_color'); ?>" type="text" autocomplete="off">
                                            <span class="input-group-addon"><i></i></span>
                                        </div>
                                        <div class="help-block"><?php echo form_error('bottom_text_color'); ?></div>
                                    </div>
                                </div>    
                                
                                <div class="form-group"> 
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="bottom_text_align"><?php echo lang('signature_align'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <?php $aligns = get_card_bottom_text_align(); ?>
                                        <select  class="form-control col-md-12 col-xs-12"  name="bottom_text_align"  id="bottom_text_align">
                                            <option value="">--<?php echo lang('select'); ?> --</option> 
                                            <?php foreach($aligns as $key=>$value ){ ?>
                                                <option value="<?php echo $key; ?>" <?php echo isset($setting->bottom_text_align) && $setting->bottom_text_align == $key ?  'selected="selected"' : ''; ?>><?php echo $value; ?></option>
                                            <?php } ?>                                            
                                        </select>
                                        <div class="help-block"><?php echo form_error('bottom_text_align'); ?></div>
                                    </div>
                                </div>  
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="logo"><?php echo lang('card_logo'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">  
                                           
                                            <?php if($setting->branch_logo){ ?>
                                             <input type="hidden" name="prev_logo" id="prev_logo" value="<?php echo $setting->branch_logo; ?>" />
                                            <img src="<?php echo UPLOAD_PATH; ?>logo/<?php echo $setting->branch_logo; ?>" alt="" width="70" /><br/><br/>
                                            <?php } ?>
                                            
                                        <div class="btn btn-default btn-file">
                                            <i class="fa fa-paperclip"></i> <?php echo lang('upload'); ?> 
                                            <input  class="form-control col-md-7 col-xs-12"  name="logo" id="logo" type="file" />
                                        </div>
                                        <div class="help-block"><?php echo form_error('branch_logo'); ?></div>
                                    </div>
                                </div>
                                                                
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <input type="hidden" id="id" name="id" value="<?php if(isset($setting)){ echo $setting->id;} ?>"/>
                                        <a href="<?php echo site_url('card/cardsetting/index'); ?>" class="btn btn-primary"><?php echo lang('cancel'); ?></a>
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



<div class="modal fade bs-setting-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title"><?php echo lang('detail_information'); ?></h4>
        </div>
        <div class="modal-body fn_setting_data">            
        </div>       
      </div>
    </div>
</div>

<script type="text/javascript">
         
    function get_setting_modal(setting_id){
         
        $('.fn_setting_data').html('<p style="padding: 20px;"><p style="padding: 20px;text-align:center;"><img src="<?php echo IMG_URL; ?>loading.gif" /></p>');
        $.ajax({       
          type   : "POST",
          url    : "<?php echo site_url('card/admitsetting/get_single_admit_setting'); ?>",
          data   : {setting_id : setting_id},  
          success: function(response){                                                   
             if(response)
             {
                $('.fn_setting_data').html(response);
             }
          }
       });
    }
</script>

<link href="<?php echo VENDOR_URL; ?>colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet">
<script src="<?php echo VENDOR_URL; ?>colorpicker/bootstrap-colorpicker.min.js"></script> 

 <script type="text/javascript">
     
    $('.fn_colorpicker').colorpicker();
   
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
