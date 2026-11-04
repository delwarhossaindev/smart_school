<header>
    <div class="header-top-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-12 hta-left">
                    <div class="hta-box">
                        <p class="text"><?php echo lang('have_any_question'); ?></p>
                    </div>                    
                    <?php if(isset($school->email)){ ?>
                        <div class="hta-box">
                            <span class="icon"><i class="fas fa-phone"></i></span>
                            <p class="text"><?php echo $school->phone; ?></p>
                        </div>                       
                   <?php } ?>   
                    <?php if(isset($school->email)){ ?>
                        <div class="hta-box">
                            <span class="icon"><i class="fas fa-envelope"></i></span>
                            <p class="text"><?php echo $school->email; ?></p>
                        </div>                        
                   <?php } ?>                    
                    
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-12 hta-right text-right">                
                    <!--<div class="hta-box"><a href="https://codecanyon.net/item/global-multi-school-management-system-express/21975378" target="_blank" style="background: red;border-radius: 50%;font-weight: bold; padding: 8px;color: #fff;">Buy Now</a></div>-->
                    <?php if(isset($school->enable_online_admission) && $school->enable_online_admission){ ?>
                        <div class="hta-box">
                            <a class="text" href="<?php echo site_url($school->branch_url.'/admission-online'); ?>"><?php echo lang('admission'); ?></a>
                        </div>
                    <?php } ?> 
                    
                    <?php if (logged_in_user_id()) { ?>  
                    
                        <div class="hta-box">
                            <a class="text" href="<?php echo site_url('dashboard/index'); ?>"><?php echo lang('dashboard'); ?></a>
                        </div>
                        <div class="hta-box">
                            <span class="icon"><i class="fas fa-sign-out-alt"></i></span>
                            <a class="text" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><?php echo lang('logout'); ?></a>
                        </div>
                    <?php }else{ ?>
                        <div class="hta-box">
                            <span class="icon"><i class="fas fa-sign-in-alt"></i></span>
                            <a class="text" href="<?php echo site_url('auth/login'); ?>"><?php echo lang('login'); ?></a>
                        </div>
                    <?php } ?>
                    
                </div>
            </div>
        </div>
    </div>
    <div class="header-bottom-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 offset-lg-0 col-md-4 offset-md-3 col-sm-6 col-6">
                    <div class="logo">
                        <a href="<?php echo site_url($school->branch_url); ?>">
                            <?php if(isset($school->frontend_logo)){ ?>                            
                                <img src="<?php echo UPLOAD_PATH; ?>logo/<?php echo $school->frontend_logo; ?>" alt=""  />
                            <?php }elseif(isset($school->logo)){ ?>                            
                                <img src="<?php echo UPLOAD_PATH; ?>logo/<?php echo $school->logo; ?>" alt=""  />
                            <?php }else{ ?>
                                <img  width="100" height="100" src="<?php echo IMG_URL; ?>sms-logo.png">
                            <?php } ?>    
                        </a>
                    </div>
                </div>
                <div class="col-lg-10 offset-lg-0 col-md-8 offset-md-2 col-sm-12 col-12">
                    <div class="menu">
                        <nav id="mobile_menu_active">
                            <ul id="menu">
                                <li><a href="<?php echo site_url($school->branch_url); ?>"><?php echo lang('home'); ?></a></li>
                                <li><a href="#"><?php echo lang('announcement'); ?> <span class="icon fas fa-chevron-down"></span></a>
                                    <ul class="drop">
                                        <li><a href="<?php echo site_url($school->branch_url.'/news'); ?>"><?php echo lang('news'); ?></a></li>
                                        <li><a href="<?php echo site_url($school->branch_url.'/notice'); ?>"><?php echo lang('notice'); ?></a></li>
                                        <li><a href="<?php echo site_url($school->branch_url.'/holiday'); ?>"><?php echo lang('holiday'); ?></a></li>
                                    </ul>                                
                                </li>
                                <li><a href="<?php echo site_url($school->branch_url.'/events'); ?>"><?php echo lang('event'); ?></a></li>
                                <li><a href="<?php echo site_url($school->branch_url.'/galleries'); ?>"><?php echo lang('gallery'); ?></a></li>
                                <li><a href="<?php echo site_url($school->branch_url.'/teachers'); ?>"><?php echo lang('teacher'); ?></a></li>
                                <li><a href="<?php echo site_url($school->branch_url.'/staff'); ?>"><?php echo lang('staff'); ?></a></li>
                                <li><a href="<?php echo site_url($school->branch_url.'/contact'); ?>"><?php echo lang('contact_us'); ?></a></li>
                                <?php if(isset($header_pages) && !empty($header_pages)){ ?>
                                    <li><a href="javascript:void(0)"><?php echo lang('page'); ?> <span class="icon fas fa-chevron-down"></span></a>
                                        <ul class="drop">
                                        <?php foreach($header_pages AS $obj ){ ?>
                                             <li><a href="<?php echo site_url($school->branch_url.'/page/'.$obj->page_slug); ?>"><?php echo $obj->page_title; ?></a></li>
                                         <?php } ?> 
                                        </ul>                                
                                    </li>    
                                <?php } ?> 
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>