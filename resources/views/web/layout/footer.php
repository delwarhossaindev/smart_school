<footer>
    <div class="footer-top-area   bg-with-black">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-7 col-sm-7 col-12">
                    <div class="footer-widget">
                        <div class="fw-logo">
                            <?php if(isset($school->frontend_logo)){ ?>                            
                                <img src="<?php echo UPLOAD_PATH; ?>logo/<?php echo $school->frontend_logo; ?>" alt=""  />
                            <?php }elseif(isset($school->logo)){ ?>                            
                                <img src="<?php echo UPLOAD_PATH; ?>logo/<?php echo $school->logo; ?>" alt=""  />
                            <?php }else{ ?>
                                <img  width="100" height="100" src="<?php echo IMG_URL; ?>sms-logo.png">
                            <?php } ?>   
                        </div>
                        <div class="fw-logo">
                            <?php if(isset($schools) && count($schools) > 1){ ?>
                                <div class="item form-group"> 
                                    <select  class="form-control col-md-7 col-xs-12"  name="role_id"  id="edit_role_id" required="required" onchange="change_school(this.value);">
                                            <option value="">--<?php echo lang('select_branch'); ?>--</option>
                                        <?php foreach($schools as $obj ){ ?>
                                            <option value="<?php echo site_url('branch/'.$obj->branch_url); ?>" <?php if(ci()->session->userdata('front_branch_id') == $obj->id){ echo 'selected="selected"';} ?>><?php echo $obj->branch_name; ?></option>
                                        <?php } ?>                                            
                                     </select>
                                 </div>    
                            <?php } ?> 
                        </div>
                        <p class="text">
                            <?php if(isset($school->about_text) && !empty($school->about_text)){ ?>
                                <?php echo strip_tags(substr($school->about_text, 0, 350)); ?>
                            <?php } ?> 
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-5 col-sm-5 col-12">
                    <div class="footer-widget">
                        <h2 class="fw-title"> <span><?php echo lang('quick_link'); ?></span></h2>
                        <ul class="links">
                            <li><a href="<?php echo site_url($school->branch_url.'/admission-online'); ?>"><?php echo lang('admission'); ?></a></li>
                            <li><a href="<?php echo site_url($school->branch_url.'/news'); ?>"><?php echo lang('news'); ?></a></li>
                            <li><a href="<?php echo site_url($school->branch_url.'/notice'); ?>"><?php echo lang('notice'); ?></a></li>
                            <li><a href="<?php echo site_url($school->branch_url.'/holiday'); ?>"><?php echo lang('holiday'); ?></a></li>
                            <li><a href="<?php echo site_url($school->branch_url.'/events'); ?>"><?php echo lang('event'); ?></a></li>
                            <li><a href="<?php echo site_url($school->branch_url.'/galleries'); ?>"><?php echo lang('gallery'); ?></a></li>
                            <li><a href="<?php echo site_url($school->branch_url.'/teachers'); ?>"><?php echo lang('teacher'); ?></a></li>
                            <li><a href="<?php echo site_url($school->branch_url.'/staff'); ?>"><?php echo lang('staff'); ?></a></li>
                            <li><a href="<?php echo site_url($school->branch_url.'/contact'); ?>"><?php echo lang('contact_us'); ?></a></li>
                            <?php if(isset($footer_pages) && !empty($footer_pages)){ ?>
                               <?php foreach($footer_pages AS $obj ){ ?>
                                    <li><a href="<?php echo site_url($school->branch_url.'/page/'.$obj->page_slug); ?>"><?php echo $obj->page_title; ?></a></li>
                                <?php } ?> 
                            <?php } ?> 
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-5 col-sm-5 col-12">
                    <div class="footer-widget">
                        <h2 class="fw-title"><?php echo lang('opening_hour'); ?></h2>
                        <ul class="links hours">
                            <?php if(isset($opening_hour) && !empty($opening_hour->monday)){ ?>
                                <li><span><?php echo lang('monday'); ?></span>: <?php echo $opening_hour->monday; ?></li>
                            <?php }else{ ?> 
                                <li><span><?php echo lang('monday'); ?></span>: <?php echo lang('close'); ?></li>
                            <?php } ?>
                                
                            <?php if(isset($opening_hour) && !empty($opening_hour->tuesday)){ ?>
                                <li><span><?php echo lang('tuesday'); ?></span>: <?php echo $opening_hour->tuesday; ?></li>
                             <?php }else{ ?> 
                                <li><span><?php echo lang('tuesday'); ?></span>: <?php echo lang('close'); ?></li>
                            <?php } ?> 
                                
                            <?php if(isset($opening_hour) && !empty($opening_hour->wednesday)){ ?>
                                <li><span><?php echo lang('wednesday'); ?></span>: <?php echo $opening_hour->wednesday; ?></li>
                             <?php }else{ ?> 
                                <li><span><?php echo lang('wednesday'); ?></span>: <?php echo lang('close'); ?></li>
                            <?php } ?>  
                                
                            <?php if(isset($opening_hour) && !empty($opening_hour->thursday)){ ?>
                                <li><span><?php echo lang('thursday'); ?></span>: <?php echo $opening_hour->wednesday; ?></li>
                             <?php }else{ ?> 
                                <li><span><?php echo lang('thursday'); ?></span>: <?php echo lang('close'); ?></li>
                            <?php } ?>
                                
                            <?php if(isset($opening_hour) && !empty($opening_hour->friday)){ ?>
                                <li><span><?php echo lang('friday'); ?></span>: <?php echo $opening_hour->friday; ?></li>
                             <?php }else{ ?> 
                                <li><span><?php echo lang('friday'); ?></span>: <?php echo lang('close'); ?></li>
                            <?php } ?>  
                                
                            <?php if(isset($opening_hour) && !empty($opening_hour->saturday)){ ?>
                                <li><span><?php echo lang('saturday'); ?></span>: <?php echo $opening_hour->saturday; ?></li>
                             <?php }else{ ?> 
                                <li><span><?php echo lang('saturday'); ?></span>: <?php echo lang('close'); ?></li>
                            <?php } ?>  
                                
                            <?php if(isset($opening_hour) && !empty($opening_hour->sunday)){ ?>
                                <li><span><?php echo lang('sunday'); ?></span>: <?php echo $opening_hour->sunday; ?></li>
                             <?php }else{ ?> 
                                <li><span><?php echo lang('sunday'); ?></span>: <?php echo lang('close'); ?></li>
                            <?php } ?>  
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-7 col-sm-7 col-12">
                    <div class="footer-widget">
                        <h2 class="fw-title"><?php echo lang('get_in_touch'); ?></h2>
                        <ul class="address">
                            <li><span class="icon"><i class="fas fa-phone"></i></span> 
                                <?php if(isset($school->phone)){ ?>
                                     <?php echo $school->phone; ?>
                                <?php } ?> 
                            </li>
                            <li><span class="icon"><i class="fas fa-envelope"></i></span>
                                <?php if(isset($school->email)){ ?>
                                     <?php echo $school->email; ?>
                                <?php } ?>
                            </li>
                            <li><span class="icon"><i class="fas fa-map-marker-alt"></i></span> 
                                <?php if(isset($school->address)){ ?>
                                     <?php echo $school->address; ?>
                                <?php } ?>
                            </li>
                        </ul>
                        <ul class="social">
                            <?php if(isset($school->facebook_url) && !empty($school->facebook_url)){ ?>
                                <li><a href="<?php echo $school->facebook_url; ?>" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                            <?php } ?> 
                            <?php if(isset($school->twitter_url)  && !empty($school->twitter_url)){ ?>
                                <li><a href="<?php echo $school->twitter_url; ?>" target="_blank"><i class="fab fa-twitter"></i></a></li>
                            <?php } ?>                             
                            <?php if(isset($school->linkedin_url)  && !empty($school->linkedin_url)){ ?>
                                <li><a href="<?php echo $school->linkedin_url; ?>" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
                            <?php } ?>                
                            <?php if(isset($school->youtube_url)  && !empty($school->youtube_url)){ ?>
                                <li><a href="<?php echo $school->youtube_url; ?>" target="_blank"><i class="fab fa-youtube"></i></a></li>
                            <?php } ?>                              
                            <?php if(isset($school->instagram_url)  && !empty($school->instagram_url)){ ?>
                                <li><a href="<?php echo $school->instagram_url; ?>" target="_blank"><i class="fab fa-instagram"></i></a></li>
                            <?php } ?>                              
                            <?php if(isset($school->pinterest_url)  && !empty($school->pinterest_url)){ ?>
                                <li><a href="<?php echo $school->pinterest_url; ?>" target="_blank"><i class="fab fa-pinterest-p"></i></a></li>
                            <?php } ?> 
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom-area">
        <div class="container text-center">
            <p class="copyright">
                <?php if(isset($school->footer)){ ?>                            
                    <?php echo $school->footer; ?>
                <?php }else{ ?>
                    <?php echo ci()->global_setting->brand_footer; ?>
                <?php } ?>                 
            </p>
        </div>
    </div>
</footer>
