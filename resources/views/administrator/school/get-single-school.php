<div class="" data-example-id="togglable-tabs">
    <ul  class="nav nav-tabs bordered">
        <li class="active"><a href="#tab_basic_info"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-info-circle"></i> <?php echo lang('basic_information'); ?></a> </li>
        <li class=""><a href="#tab_setting_info"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-gear"></i> <?php echo lang('setting_information'); ?></a> </li>
        <li class=""><a href="#tab_social_info"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-share"></i> <?php echo lang('social_information'); ?></a> </li>
    </ul>
    <br/>
    
     <div class="tab-content">
        <div  class="tab-pane fade in active" id="tab_basic_info" > 
            <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <tbody>
                    <tr>
                        <th><?php echo lang('branch_url'); ?></th>
                        <td colspan="3"><a target="_blank" href="<?php echo site_url($school->branch_url); ?>"><?php echo site_url($school->branch_url); ?></a></td> 
                    </tr>
                    <tr>
                        <th><?php echo lang('branch_code'); ?></th>
                        <td><?php echo $school->branch_code; ?></td>        
                        <th><?php echo lang('branch_name'); ?></th>
                        <td><?php echo $school->branch_name; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo lang('address'); ?></th>
                        <td><?php echo $school->address; ?></td>        
                        <th><?php echo lang('phone'); ?></th>
                        <td><?php echo $school->phone; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo lang('registration_date'); ?></th>
                        <td><?php echo $school->registration_date; ?></td>        
                        <th><?php echo lang('email'); ?></th>
                        <td><?php echo $school->email; ?></td>
                    </tr>
                    
                    <tr>   
                        <th><?php echo lang('branch_fax'); ?></th>
                        <td><?php echo $school->branch_fax; ?></td>      
                        <th><?php echo lang('footer'); ?></th>
                        <td><?php echo $school->footer; ?></td>                           
                    </tr>
                    <tr>                           
                        <th><?php echo lang('frontend_logo'); ?></th>
                        <td>
                            <?php if($school->frontend_logo){ ?>
                                <img class="logo-identifier" src="<?php echo UPLOAD_PATH; ?>logo/<?php echo $school->frontend_logo; ?>" alt="" width="70" />
                            <?php } ?>        
                        </td> 
                        <th><?php echo lang('admin_logo'); ?></th>
                        <td>
                            <?php if($school->logo){ ?>
                                <img class="logo-identifier" src="<?php echo UPLOAD_PATH; ?>logo/<?php echo $school->logo; ?>" alt="" width="70" />
                            <?php } ?>        
                        </td>  
                    </tr>
                    <tr>   
                        <th><?php echo lang('is_default'); ?></th>
                        <td><?php echo $school->is_default ? lang('yes') : lang('no'); ?></td>      
                        <th><?php echo lang('status'); ?></th>
                        <td><?php echo $school->status ? lang('active') : lang('in_active'); ?></td>                           
                    </tr>
                    
                    
                </tbody>
            </table>
        </div>
         
        <div  class="tab-pane fade in" id="tab_setting_info" > 
            <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <tbody> 
                <tr>                         
                    <th><?php echo lang('branch_lat'); ?></th>
                    <td><?php echo $school->branch_lat; ?></td> 
                    <th><?php echo lang('branch_lng'); ?></th>
                    <td><?php echo $school->branch_lng; ?></td> 
                </tr>
                <tr>  
                    <th>Google <?php echo lang('api_key'); ?></th>
                    <td><?php echo $school->map_api_key; ?></td>  
                    <th><?php echo lang('language'); ?></th>
                    <td><?php echo $school->language; ?></td>  
                </tr>
                <tr>  
                    <th><?php echo lang('theme'); ?></th>
                    <td ><?php echo $school->theme_name; ?></td>  
                    <th><?php echo lang('online_admission'); ?></th>
                    <td><?php echo $school->enable_online_admission ? lang('yes') : lang('no'); ?></td>  
                </tr>
                <tr>
                    <th><?php echo lang('currency'); ?></th>
                    <td><?php echo $school->currency; ?></td>       
                    <th><?php echo lang('currency_symbol'); ?></th>
                    <td><?php echo $school->currency_symbol; ?></td>
                </tr>            
                <tr>
                    <th><?php echo lang('enable_frontend'); ?></th>
                    <td><?php echo $school->enable_frontend ? lang('yes') : lang('no'); ?></td>
                    <th><?php echo lang('exam_final_result'); ?></th>
                    <td><?php echo $school->final_result_type ? lang('only_of_fianl_exam') : lang('avg_of_all_exam'); ?></td>        
                </tr>  
                <tr>  
                    <th><?php echo lang('zoom_api_key'); ?></th>
                    <td><?php echo $school->zoom_api_key; ?></td>  
                    <th><?php echo lang('zoom_secret'); ?></th>
                    <td><?php echo $school->zoom_secret; ?></td>  
                </tr>                
                <tr>  
                    <th><?php echo lang('enable_rtl'); ?></th>
                    <td><?php echo $school->enable_rtl ? lang('yes') : lang('no'); ?></td>  
                    <th></th>
                    <td></td>  
                </tr>
            </tbody>
        </table>
        </div>
         
        <div  class="tab-pane fade in" id="tab_social_info" > 
            <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <tbody>           
                <tr>
                    <th><?php echo lang('facebook_url'); ?></th>
                    <td><?php echo $school->facebook_url; ?></td>       
                    <th><?php echo lang('linkedin_url'); ?></th>
                    <td><?php echo $school->linkedin_url; ?></td>
                </tr>
                <tr>
                    <th><?php echo lang('twitter_url'); ?></th>
                    <td><?php echo $school->twitter_url; ?></td>                            
                    <th><?php echo lang('youtube_url'); ?></th>
                    <td><?php echo $school->youtube_url; ?></td>        
                </tr>
                <tr>
                    <th><?php echo lang('instagram_url'); ?></th>
                    <td><?php echo $school->instagram_url; ?></td>        
                    <th><?php echo lang('pinterest_url'); ?></th>
                    <td><?php echo $school->pinterest_url; ?></td>
                </tr>                 
            </tbody>
            </table>
        </div>
    </div>
</div>
