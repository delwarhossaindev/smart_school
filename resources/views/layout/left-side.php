<div class="col-md-3 <?php echo ci()->global_setting->enable_rtl ? 'right_col' : 'left_col'; ?>">
    <div class="<?php echo ci()->global_setting->enable_rtl ? 'right_col' : 'left_col'; ?> scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="<?php echo site_url('dashboard/index'); ?>">
                <?php if(ci()->global_setting->brand_name){ ?>
                    <span <?php if(str_word_count(ci()->global_setting->brand_name) == 1 ){ echo 'style="margin-top: 30px;"'; }  ?>>
                        <?php  echo ci()->global_setting->brand_name; ?>
                    </span>
                <?php }else{ ?>
                     <span>Multi Branch</span>    
                <?php } ?>                
                
                <?php if(ci()->global_setting->brand_logo){ ?>
                     <img class="logo" src="<?php echo UPLOAD_PATH.'logo/'.ci()->global_setting->brand_logo; ?>" style="max-width: 65px;" alt="">
                <?php }else{ ?>
                     <img class="logo" src="<?php echo IMG_URL; ?>sms-logo-50.png" alt="">
                <?php } ?>
            </a>
        </div>
        <div class="clearfix" style=""></div>        
        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <?php 
                    if(ci()->session->userdata('role_id') != SUPER_ADMIN){                  
                        $classes = get_classes(ci()->session->userdata('branch_id'));
                    }               
                    if(ci()->session->userdata('role_id') == GUARDIAN){                  
                        $guardian_class_data = get_guardian_access_data('class'); 
                    }               
                ?>
                
                <ul class="nav side-menu">                    
                    <li><a href="<?php echo site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard'); ?></a>  </li>
                    
                    <?php if(ci()->session->userdata('role_id') != SUPER_ADMIN){ ?>
                        <?php if(has_permission(VIEW, 'setting', 'setting') || has_permission(VIEW, 'setting', 'payment')  || has_permission(VIEW, 'setting', 'sms')){ ?> 
                            <li><a><i class="fa fa-gears"></i> <?php echo lang('setting'); ?> <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">                            
                                    <?php if(has_permission(VIEW, 'setting', 'setting')){ ?>
                                        <li><a href="<?php echo site_url('setting/index'); ?>"><?php echo lang('branch_setting'); ?></a></li>
                                    <?php } ?>
                                    <?php if(has_permission(VIEW, 'setting', 'payment')){ ?> 
                                        <li><a href="<?php echo site_url('setting/payment/index'); ?>"><?php echo lang('payment_setting'); ?></a></li>
                                    <?php } ?>
                                    <?php if(has_permission(VIEW, 'setting', 'sms')){ ?>
                                        <li><a href="<?php echo site_url('setting/sms/index'); ?>"><?php echo lang('sms_setting'); ?></a></li>
                                    <?php } ?>
                                    <?php if(has_permission(VIEW, 'setting', 'emailsetting')){ ?>
                                        <li><a href="<?php echo site_url('setting/emailsetting/index'); ?>"><?php echo lang('email_setting'); ?></a></li>
                                    <?php } ?>
                                    <?php if(has_permission(VIEW, 'setting', 'openinghour')){ ?>
                                        <li><a href="<?php echo site_url('setting/openinghour/index'); ?>"><?php echo lang('opening_hour'); ?></a></li>
                                    <?php } ?>
                                </ul>
                            </li>                        
                        <?php } ?>                          
                    <?php } ?>
                                        
                    
                    <?php if(has_permission(VIEW, 'theme', 'theme')){ ?>
                            <li><a  href="<?php echo site_url('theme/index'); ?>"><i class="fa fa-cubes"></i> <?php echo lang('theme'); ?></a></li> 
                    <?php } ?>  
                    
                    <?php if(has_permission(VIEW, 'language', 'language')){ ?>
                        <li><a  href="<?php echo site_url('language/index'); ?>"><i class="fa fa-language"></i> <?php echo lang('language'); ?></a></li>
                    <?php } ?>
                      
                    <?php 
                    if(has_permission(VIEW, 'administrator', 'setting') ||
                            has_permission(VIEW, 'administrator', 'school') || 
                            has_permission(VIEW, 'administrator', 'payment') || 
                            has_permission(VIEW, 'administrator', 'sms') || 
                            has_permission(VIEW, 'administrator', 'year') || 
                            has_permission(VIEW, 'administrator', 'role') || 
                            has_permission(VIEW, 'administrator', 'permission') || 
                            has_permission(VIEW, 'administrator', 'user') || 
                            has_permission(VIEW, 'administrator', 'usercredential') || 
                            has_permission(VIEW, 'administrator', 'superadmin') || 
                            has_permission(EDIT, 'administrator', 'password') || 
                            has_permission(VIEW, 'administrator', 'backup') ||                            
                            has_permission(VIEW, 'administrator', 'activitylog') ||
                            has_permission(VIEW, 'administrator', 'feedback')){ ?>    
                        <li><a><i class="fa fa-user"></i> <?php echo lang('administrator'); ?> <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <?php if(has_permission(VIEW, 'administrator', 'setting')){ ?>   
                                    <li><a href="<?php echo site_url('administrator/setting/index'); ?>"> <?php echo lang('general_setting'); ?></a></li>
                                <?php } ?>
                                <?php if(has_permission(VIEW, 'administrator', 'school')){ ?>   
                                    <li><a href="<?php echo site_url('administrator/school/index'); ?>"> <?php echo lang('manage_branch'); ?></a></li>
                                <?php } ?>
                                <?php if(has_permission(VIEW, 'administrator', 'payment')){ ?> 
                                <li><a href="<?php echo site_url('administrator/payment/index'); ?>"><?php echo lang('payment_setting'); ?></a></li>
                                <?php } ?>
                                <?php if(has_permission(VIEW, 'administrator', 'sms')){ ?>
                                    <li><a href="<?php echo site_url('administrator/sms/index'); ?>"><?php echo lang('sms_setting'); ?></a></li>
                                <?php } ?>    
                                <?php if(has_permission(VIEW, 'administrator', 'emailsetting')){ ?>
                                    <li><a href="<?php echo site_url('administrator/emailsetting/index'); ?>"><?php echo lang('email_setting'); ?></a></li>
                                <?php } ?>    
                                <?php if(has_permission(VIEW, 'administrator', 'year')){ ?>   
                                    <li><a href="<?php echo site_url('administrator/year/index'); ?>"> <?php echo lang('academic_year'); ?></a></li>
                                 <?php } ?>
                                <?php if(has_permission(VIEW, 'administrator', 'role')){ ?>   
                                    <li><a href="<?php echo route('roles.index'); ?>"> <?php echo lang('user_role'); ?> (ACL)</a></li> 
                                <?php } ?>
                                <?php if(has_permission(VIEW, 'administrator', 'permission')){ ?> 
                                    <li><a href="<?php echo route('permissions.index'); ?>"><?php echo lang('role_permission'); ?> (ACL)</a></li> 
                                 <?php } ?>
                                <?php if(has_permission(VIEW, 'administrator', 'superadmin')){ ?>   
                                    <li><a href="<?php echo site_url('administrator/superadmin/index'); ?>"> <?php echo lang('manage_super_admin'); ?></a></li> 
                                 <?php } ?>
                                <?php if(has_permission(VIEW, 'administrator', 'user')){ ?>   
                                    <li><a href="<?php echo site_url('administrator/user/index'); ?>"><?php echo lang('manage_user'); ?></a></li> 
                                <?php } ?>
                                <?php if(has_permission(EDIT, 'administrator', 'password')){ ?>   
                                    <li><a href="<?php echo site_url('administrator/password/index'); ?>"><?php echo lang('reset_user_password'); ?></a></li> 
                                 <?php } ?> 
                                <?php if(has_permission(EDIT, 'administrator', 'username')){ ?>   
                                    <li><a href="<?php echo site_url('administrator/username/index'); ?>"><?php echo lang('reset_username'); ?></a></li> 
                                 <?php } ?> 
                                <?php if(has_permission(VIEW, 'administrator', 'usercredential')){ ?>   
                                    <li><a href="<?php echo site_url('administrator/usercredential/index'); ?>"><?php echo lang('user_credential'); ?></a></li> 
                                 <?php } ?> 
                                <?php if(has_permission(VIEW, 'administrator', 'activitylog')){ ?>   
                                    <li><a href="<?php echo site_url('administrator/activitylog/index'); ?>"><?php echo lang('activity_log'); ?></a></li>                         
                                <?php } ?>      
                                <?php if(has_permission(VIEW, 'administrator', 'feedback')){ ?>   
                                    <li><a href="<?php echo site_url('administrator/feedback/index'); ?>"><?php echo lang('manage_feedback'); ?></a></li>                         
                                <?php } ?> 
                                <?php if(has_permission(VIEW, 'administrator', 'openinghour')){ ?>   
                                    <li><a href="<?php echo site_url('administrator/openinghour/index'); ?>"><?php echo lang('opening_hour'); ?></a></li>                         
                                <?php } ?>    
                                <?php if(has_permission(VIEW, 'administrator', 'backup')){ ?>   
                                    <li><a href="<?php echo site_url('administrator/backup/index'); ?>"><?php echo lang('backup_database'); ?></a></li>                         
                                <?php } ?>    
                            </ul>
                        </li>
                    <?php } ?>
                        
                        
                     <?php if(has_permission(VIEW, 'administrator', 'emailtemplate') || has_permission(VIEW, 'administrator', 'smstemplate')){ ?> 
                        <li><a><i class="fa fa-tags"></i> <?php echo lang('template'); ?> <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">                            
                                 <?php if(has_permission(VIEW, 'administrator', 'smstemplate')){ ?>   
                                    <li><a href="<?php echo site_url('administrator/smstemplate/index'); ?>"><?php echo lang('sms_template'); ?></a></li>                         
                                <?php } ?>
                                <?php if(has_permission(VIEW, 'administrator', 'emailtemplate')){ ?>   
                                    <li><a href="<?php echo site_url('administrator/emailtemplate/index'); ?>"><?php echo lang('email_template'); ?></a></li>                         
                                <?php } ?>     
                            </ul>
                        </li>                        
                    <?php } ?> 
                        
                     <?php if(has_permission(VIEW, 'frontoffice', 'purpose') ||
                             has_permission(VIEW, 'frontoffice', 'visitor') ||
                             has_permission(VIEW, 'frontoffice', 'calllog') ||
                             has_permission(VIEW, 'frontoffice', 'dispatch') ||
                             has_permission(VIEW, 'frontoffice', 'receive') ||
                             has_permission(VIEW, 'administrator', 'frontoffice')){ ?> 
                        <li><a><i class="fa fa-tty"></i> <?php echo lang('front_office'); ?> <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">                            
                                 <?php if(has_permission(VIEW, 'frontoffice', 'purpose')){ ?>   
                                    <li><a href="<?php echo site_url('frontoffice/purpose/index'); ?>"><?php echo lang('visitor_purpose'); ?></a></li>                         
                                <?php } ?>
                                <?php if(has_permission(VIEW, 'frontoffice', 'visitor')){ ?>   
                                    <li><a href="<?php echo site_url('frontoffice/visitor/index'); ?>"><?php echo lang('visitor_info'); ?></a></li>                         
                                <?php } ?>                                 
                                <?php if(has_permission(VIEW, 'frontoffice', 'calllog')){ ?>   
                                    <li><a href="<?php echo site_url('frontoffice/calllog/index'); ?>"><?php echo lang('call_log'); ?></a></li>                         
                                <?php } ?>                                 
                                <?php if(has_permission(VIEW, 'frontoffice', 'dispatch')){ ?>   
                                    <li><a href="<?php echo site_url('frontoffice/dispatch/index'); ?>"><?php echo lang('postal_dispatch'); ?></a></li>                         
                                <?php } ?>                                 
                                <?php if(has_permission(VIEW, 'frontoffice', 'receive')){ ?>   
                                    <li><a href="<?php echo site_url('frontoffice/receive/index'); ?>"><?php echo lang('postal_receive'); ?></a></li>                         
                                <?php } ?>                                 
                            </ul>
                        </li>                        
                    <?php } ?> 
                    
                    <?php if(has_permission(VIEW, 'hrm', 'designation') || has_permission(VIEW, 'hrm', 'employee')){ ?>    
                    <li><a><i class="fa fa-user-md"></i>  <?php echo lang('human_resource'); ?> <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <?php if(has_permission(VIEW, 'hrm', 'designation')){ ?>   
                                <li><a href="<?php echo site_url('hrm/designation/index'); ?>"><?php echo lang('manage_designation'); ?></a></li>
                            <?php } ?>
                            <?php if(has_permission(VIEW, 'hrm', 'employee')){ ?>   
                                <li><a href="<?php echo site_url('hrm/employee/index'); ?>"><?php echo lang('manage_employee'); ?></a></li>                            
                            <?php } ?>
                        </ul>
                    </li> 
                    <?php } ?>
                    
                    
                    <?php if(has_permission(VIEW, 'leave', 'leave') || has_permission(VIEW, 'leave', 'type')){ ?>
                        <li><a><i class="fa fa-bell-o"></i> <?php echo lang('manage_leave'); ?> <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <?php if(has_permission(VIEW, 'leave', 'type')){ ?>  
                                    <li><a href="<?php echo site_url('leave/type/index'); ?>"><?php echo lang('leave_type'); ?></a></li>
                                <?php } ?>
                                <?php if(has_permission(VIEW, 'leave', 'application')){ ?>  
                                    <li><a href="<?php echo site_url('leave/application/index'); ?>"><?php echo lang('leave_application'); ?> </a></li>
                                <?php } ?>
                                <?php if(has_permission(VIEW, 'leave', 'waiting')){ ?>  
                                    <li><a href="<?php echo site_url('leave/waiting/index'); ?>"><?php echo lang('waiting_application'); ?></a></li>
                                <?php } ?>
                                <?php if(has_permission(VIEW, 'leave', 'approve')){ ?>  
                                    <li><a href="<?php echo site_url('leave/approve/index'); ?>"><?php echo lang('approved_application'); ?></a></li>
                                <?php } ?>
                                <?php if(has_permission(VIEW, 'leave', 'decline')){ ?>  
                                    <li><a href="<?php echo site_url('leave/decline/index'); ?>"><?php echo lang('declined_application'); ?></a></li>
                                <?php } ?>
                            </ul>
                        </li>   
                    <?php } ?>  
                    
                   
                    <?php if(has_permission(VIEW, 'teacher', 'teacher')){ ?>
                        <li><a href="<?php echo site_url('teacher/index'); ?>"><i class="fa fa-users"></i> <?php echo lang('teacher'); ?></a> </li>  
                    <?php } ?>
                        
                                     
                    <?php if(has_permission(VIEW, 'academic', 'classes')){ ?>
                        <li><a href="<?php echo site_url('academic/classes/index'); ?>"><i class="fa fa-slideshare"></i> <?php echo lang('class'); ?></a> </li> 
                    <?php } ?>
                                            
                    <?php if(has_permission(VIEW, 'academic', 'section')){ ?>
                        <li><a  href="<?php echo site_url('academic/section/index'); ?>"><i class="fa fa-bars"></i> <?php echo lang('section'); ?> </a></li>
                    <?php } ?>  
                        
                    <?php if(has_permission(VIEW, 'academic', 'subject')){ ?> 
                        <li><a  href="<?php echo site_url('academic/subject/index'); ?>"><i class="fa fa-folder-open"></i> <?php echo lang('subject'); ?> </a></li>
                    <?php } ?>     
                        
                    <?php if(has_permission(VIEW, 'academic', 'liveclass')){ ?>
                        <li><a  href="<?php echo site_url('academic/liveclass/index'); ?>"><i class="fa fa-headphones"></i> <?php echo lang('live_class'); ?></a> </li> 
                    <?php } ?> 
                        
                    <?php if(has_permission(VIEW, 'teacher', 'lecture')){ ?>
                        <li><a  href="<?php echo site_url('teacher/lecture/index'); ?>"><i class="fa fa-file-video-o"></i> <?php echo lang('class_lecture'); ?></a> </li>
                    <?php } ?>         
                            
                    <?php if(has_permission(VIEW, 'academic', 'syllabus')){ ?> 
                        <li><a  href="<?php echo site_url('academic/syllabus/index'); ?>"><i class="fa fa-clipboard"></i> <?php echo lang('syllabus'); ?></a> </li>
                    <?php } ?>     
                           
                    <?php if(has_permission(VIEW, 'academic', 'material')){ ?> 
                       <li><a  href="<?php echo site_url('academic/material/index'); ?>"><i class="fa fa-file-text-o"></i> <?php echo lang('study_material'); ?></a> </li> 
                    <?php } ?>    
                   
                    <?php if(has_permission(VIEW, 'academic', 'routine')){ ?>
                       <li> <a  href="<?php echo site_url('academic/routine/index'); ?>"> <i class="fa fa-clock-o"></i><?php echo lang('class_routine'); ?></a></li>
                    <?php } ?>   
                                        
                    <?php if(has_permission(VIEW, 'guardian', 'guardian')){ ?>    
                        <li><a href="<?php echo site_url('guardian/index'); ?>"><i class="fa fa-paw"></i> <?php echo lang('guardian'); ?></a> </li>
                    <?php } ?>
                                            
                    
                    <?php if(has_permission(VIEW, 'student', 'type') || 
                            has_permission(ADD, 'student', 'student') ||
                            has_permission(ADD, 'student', 'bulk') ||
                            has_permission(ADD, 'student', 'admission') ||
                            has_permission(ADD, 'student', 'activity')){ ?> 
                      
                           <li><a><i class="fa fa-group"></i> <?php echo lang('manage_student'); ?> <span class="fa fa-chevron-down"></span></a>
                               <ul class="nav child_menu">
                                    <?php if(has_permission(VIEW, 'student', 'type')){ ?>
                                        <li><a href="<?php echo site_url('student/type/index'); ?>"> <?php echo lang('student_type'); ?></a></li>
                                     <?php } ?> 
                                    <?php if(has_permission(VIEW, 'student', 'student')){ ?>
                                        <li><a href="<?php echo site_url('student/index'); ?>"><?php echo lang('student_list'); ?></a></li>
                                     <?php } ?> 
                                    <?php if(has_permission(ADD, 'student', 'student')){ ?>
                                        <li><a href="<?php echo site_url('student/add'); ?>"> <?php echo lang('admit_student'); ?></a></li>
                                     <?php } ?> 
                                    <?php if(has_permission(ADD, 'student', 'bulk')){ ?>
                                         <li><a href="<?php echo site_url('student/bulk/add'); ?>"> <?php echo lang('bulk_admission'); ?></a></li>
                                    <?php } ?> 
                                    <?php if(has_permission(VIEW, 'student', 'admission')){ ?>
                                         <li><a href="<?php echo site_url('student/admission/index'); ?>"> <?php echo lang('online_admission'); ?></a></li>
                                    <?php } ?> 
                                    <?php if(has_permission(VIEW, 'student', 'activity')){ ?>
                                      <li><a href="<?php echo site_url('student/activity/index'); ?>"> <?php echo lang('student_activity'); ?></a></li>
                                    <?php } ?> 
                               </ul>
                           </li> 
                        
                    <?php } ?>
                    
              
                            
                    <?php if(has_permission(VIEW, 'attendance', 'student') || 
                            has_permission(VIEW, 'attendance', 'teacher') || 
                            has_permission(VIEW, 'attendance', 'employee') || 
                            has_permission(VIEW, 'attendance', 'absentemail') || 
                            has_permission(VIEW, 'attendance', 'absentsms')){ ?>
                            
                        <li><a><i class="fa fa-check-circle-o"></i> <?php echo lang('attendance'); ?> <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <?php if(has_permission(VIEW, 'attendance', 'student')){ ?>                                    
                                    <?php if(ci()->session->userdata('role_id') == GUARDIAN){ ?>
                                        <li><a href="<?php echo site_url('attendance/student/guardian'); ?>"><?php echo lang('student_attendance'); ?></a></li>
                                     <?php }else{ ?>   
                                        <li><a href="<?php echo site_url('attendance/student/index'); ?>"><?php echo lang('student_attendance'); ?></a></li>
                                     <?php } ?>   
                                <?php } ?>
                                <?php if(has_permission(VIEW, 'attendance', 'teacher')){ ?>
                                    <li><a href="<?php echo site_url('attendance/teacher/index'); ?>"><?php echo lang('teacher_attendance'); ?></a></li>
                                <?php } ?>
                                <?php if(has_permission(VIEW, 'attendance', 'employee')){ ?>
                                    <li><a href="<?php echo site_url('attendance/employee/index'); ?>"><?php echo lang('employee_attendance'); ?></a></li>
                                <?php } ?>
                                <?php if(has_permission(VIEW, 'attendance', 'absentemail')){ ?>  
                                    <li><a href="<?php echo site_url('attendance/absentemail/index'); ?>"><?php echo lang('absent_email'); ?></a></li>
                                <?php } ?>
                                <?php if(has_permission(VIEW, 'attendance', 'absentsms')){ ?>  
                                    <li><a href="<?php echo site_url('attendance/absentsms/index'); ?>"><?php echo lang('absent_sms'); ?></a></li>
                                <?php } ?>     
                            </ul>
                        </li> 
                    <?php } ?>
                                            
                    <?php if(has_permission(VIEW, 'assignment', 'assignment')){ ?>    
                       <li>  <a href="<?php echo site_url('assignment/index'); ?>"><i class="fa fa-file-word-o"></i> <?php echo lang('assignment'); ?></a></li> 
                    <?php } ?> 
                                           
                    <?php if(has_permission(VIEW, 'assignment', 'submission')){ ?> 
                       <li>  <a href="<?php echo site_url('assignment/submission/index'); ?>"><i class="fa fa-upload"></i> <?php echo lang('submission'); ?></a></li>
                    <?php } ?>    
                                                   
                    <?php if(has_permission(VIEW, 'card', 'idsetting') || 
                            has_permission(VIEW, 'card', 'schoolidsetting') ||
                            has_permission(VIEW, 'card', 'admitsetting') ||
                            has_permission(VIEW, 'card', 'schooladmitsetting') ||
                            has_permission(VIEW, 'card', 'teacher') ||
                            has_permission(VIEW, 'card', 'employee') ||
                            has_permission(VIEW, 'card', 'student') ||
                            has_permission(VIEW, 'card', 'admit')){ ?>
                            
                        <li><a><i class="fa fa-barcode"></i> <?php echo lang('generate_card'); ?><span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">                                
                                <?php if(has_permission(VIEW, 'card', 'idsetting')){ ?>
                                    <li><a href="<?php echo site_url('card/idsetting/index'); ?>"><?php echo lang('id_card_setting'); ?></a></li>
                                <?php } ?>
                                <?php if(has_permission(VIEW, 'card', 'admitsetting')){ ?>
                                     <li><a href="<?php echo site_url('card/admitsetting/index'); ?>"><?php echo lang('admit_card_setting'); ?></a></li>
                                <?php } ?>
                                        
                                <?php if(has_permission(VIEW, 'card', 'schoolidsetting')){ ?>
                                    <li><a href="<?php echo site_url('card/schoolidsetting/index'); ?>"><?php echo lang('id_card_setting'); ?></a></li>
                                <?php } ?>     
                                <?php if(has_permission(VIEW, 'card', 'schooladmitsetting')){ ?>
                                     <li><a href="<?php echo site_url('card/schooladmitsetting/index'); ?>"><?php echo lang('admit_card_setting'); ?></a></li>
                                <?php } ?>
                                        
                                <?php if(has_permission(VIEW, 'card', 'teacher')){ ?>
                                    <li><a href="<?php echo site_url('card/teacher/index'); ?>"><?php echo lang('teacher_id_card'); ?></a></li>
                                <?php } ?>
                                <?php if(has_permission(VIEW, 'card', 'employee')){ ?>
                                    <li><a href="<?php echo site_url('card/employee/index'); ?>"><?php echo lang('employee_id_card'); ?></a></li>
                                <?php } ?>
                                <?php if(has_permission(VIEW, 'card', 'student')){ ?>  
                                    <li><a href="<?php echo site_url('card/student/index'); ?>"><?php echo lang('student_id_card'); ?></a></li>
                                <?php } ?>                                  
                                <?php if(has_permission(VIEW, 'card', 'admit')){ ?>  
                                    <li><a href="<?php echo site_url('card/admit/index'); ?>"><?php echo lang('student_admit_card'); ?></a></li>
                                <?php } ?>                                  
                            </ul>
                        </li> 
                    <?php } ?>    
                        
                    <?php if(has_permission(VIEW, 'exam', 'grade') || has_permission(VIEW, 'exam', 'exam')){ ?>    
                        <li><a><i class="fa fa-graduation-cap"></i> <?php echo lang('manage_exam'); ?> <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <?php if(has_permission(VIEW, 'exam', 'grade')){ ?>
                                    <li><a href="<?php echo site_url('exam/grade/index'); ?>"><?php echo lang('exam_grade'); ?></a></li>                         
                                <?php } ?>
                                <?php if(has_permission(VIEW, 'exam', 'exam')){ ?>
                                    <li><a href="<?php echo site_url('exam/index'); ?>"><?php echo lang('exam_term'); ?></a></li>                         
                                <?php } ?> 
                            </ul>
                        </li> 
                    <?php } ?>
                        
                    <?php if(has_permission(VIEW, 'exam', 'schedule')){ ?> 
                        <li><a href="<?php echo site_url('exam/schedule/index'); ?>"><i class="fa fa-thumb-tack"></i><?php echo lang('exam_schedule'); ?></a></li>
                    <?php } ?>    
                    
                    <?php if(has_permission(VIEW, 'exam', 'suggestion')){ ?>  
                        <li><a href="<?php echo site_url('exam/suggestion/index'); ?>"><i class="fa fa-file-text"></i><?php echo lang('exam_suggestion'); ?></a></li>
                    <?php } ?>     
             
                    <?php if(has_permission(VIEW, 'exam', 'attendance')){ ?>
                        <li><a  href="<?php echo site_url('exam/attendance/index'); ?>"><i class="fa fa-check"></i> <?php echo lang('exam_attendance'); ?></a></li>
                    <?php } ?>    
                        
                       <?php if(has_permission(VIEW, 'exam', 'mark') || 
                               has_permission(VIEW, 'exam', 'examresult') || 
                               has_permission(VIEW, 'exam', 'finalresult') || 
                               has_permission(VIEW, 'exam', 'meritlist') || 
                               has_permission(VIEW, 'exam', 'marksheet') || 
                               has_permission(VIEW, 'exam', 'resultcard') || 
                               has_permission(VIEW, 'exam', 'text') || 
                               has_permission(VIEW, 'exam', 'mail') || 
                               has_permission(VIEW, 'exam', 'resultemail') || 
                               has_permission(VIEW, 'exam', 'resultsms')){ ?>    
                        <li><a><i class="fa fa-file-text-o"></i> <?php echo lang('exam_mark'); ?> <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <?php if(has_permission(VIEW, 'exam', 'mark')){ ?>
                                    <li><a href="<?php echo site_url('exam/mark/index'); ?>"><?php echo lang('manage_mark'); ?></a></li>
                                <?php } ?>
                                <?php if(has_permission(VIEW, 'exam', 'examresult')){ ?>
                                    <li><a href="<?php echo site_url('exam/examresult/index'); ?>"><?php echo lang('exam_term_result'); ?></a></li>
                                <?php } ?>
                                <?php if(has_permission(VIEW, 'exam', 'finalresult')){ ?>
                                    <li><a href="<?php echo site_url('exam/finalresult/index'); ?>"><?php echo lang('exam_final_result'); ?></a></li>
                                <?php } ?>
                                <?php if(has_permission(VIEW, 'exam', 'meritlist')){ ?>
                                    <li><a href="<?php echo site_url('exam/meritlist/index'); ?>"><?php echo lang('merit_list'); ?></a></li>
                                <?php } ?>
                                <?php if(has_permission(VIEW, 'exam', 'marksheet')){ ?>
                                    <li><a href="<?php echo site_url('exam/marksheet/index'); ?>"><?php echo lang('mark_sheet'); ?></a></li>
                                <?php } ?>
                                <?php if(has_permission(VIEW, 'exam', 'resultcard')){ ?>
                                    <li><a href="<?php echo site_url('exam/resultcard/index'); ?>"><?php echo lang('result_card'); ?></a></li>
                                <?php } ?>                               
                                <?php if(has_permission(VIEW, 'exam', 'mail')){ ?>
                                    <li><a href="<?php echo site_url('exam/mail/index'); ?>"><?php echo lang('mark_send_by_email'); ?></a></li>
                                <?php } ?>
                                <?php if(has_permission(VIEW, 'exam', 'text')){ ?>
                                    <li><a href="<?php echo site_url('exam/text/index'); ?>"><?php echo lang('mark_send_by_sms'); ?></a></li>
                                <?php } ?>
                                <?php if(has_permission(VIEW, 'exam', 'resultemail')){ ?>  
                                    <li><a href="<?php echo site_url('exam/resultemail/index'); ?>"><?php echo lang('result_send_by_email'); ?></a></li>
                                <?php } ?>
                                <?php if(has_permission(VIEW, 'exam', 'resultsms')){ ?>  
                                    <li><a href="<?php echo site_url('exam/resultsms/index'); ?>"><?php echo lang('result_send_by_sms'); ?></a></li>
                                <?php } ?>    
                            </ul>
                        </li>
                    <?php } ?>
                    
                    <?php if(has_permission(VIEW, 'academic', 'promotion')){ ?>
                        <li><a href="<?php echo site_url('academic/promotion/index'); ?>"><i class="fa fa-mail-forward"></i><?php echo lang('promotion'); ?></a></li>                   
                    <?php } ?>
                        
                    <?php if(has_permission(VIEW, 'certificate', 'certificate') || has_permission(VIEW, 'certificate', 'type')){ ?>
                    <li><a><i class="fa fa-certificate"></i> <?php echo lang('certificate'); ?> <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <?php if(has_permission(VIEW, 'certificate', 'type')){ ?>
                                <li><a href="<?php echo site_url('certificate/type/index'); ?>"><?php echo lang('certificate_type'); ?></a></li>
                            <?php } ?>
                            <?php if(has_permission(VIEW, 'certificate', 'certificate')){ ?>
                                <li><a href="<?php echo site_url('certificate/index'); ?>"><?php echo lang('generate_certificate'); ?></a></li>
                            <?php } ?>                                
                        </ul>
                    </li>
                    <?php } ?>
                    
                    <?php if(has_permission(VIEW, 'library', 'book') || 
                            has_permission(VIEW, 'library', 'member') || 
                            has_permission(VIEW, 'library', 'issue') ||   
                            has_permission(VIEW, 'library', 'ebook')){ ?>    
                        <li><a><i class="fa fa-book"></i> <?php echo lang('library'); ?> <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <?php if(has_permission(VIEW, 'library', 'book')){ ?>
                                    <li><a href="<?php echo site_url('library/book/index'); ?>"><?php echo lang('book'); ?></a></li>
                                <?php } ?>
                                <?php if(has_permission(VIEW, 'library', 'member')){ ?>
                                    <li><a href="<?php echo site_url('library/member/index'); ?>"><?php echo lang('library_member'); ?></a></li>
                                <?php } ?>
                                <?php if(has_permission(VIEW, 'library', 'issue')){ ?>
                                    <li><a href="<?php echo site_url('library/issue/index'); ?>"><?php echo lang('issue_and_return'); ?></a></li>
                                <?php } ?>
                                <?php if(has_permission(VIEW, 'library', 'ebook')){ ?>
                                    <li><a href="<?php echo site_url('library/ebook/index'); ?>"><?php echo lang('e_book'); ?></a></li>
                                <?php } ?>
                            </ul>
                        </li> 
                    <?php } ?>
                    
                    <?php if(has_permission(VIEW, 'transport', 'vehicle') || 
                            has_permission(VIEW, 'transport', 'route') || 
                            has_permission(VIEW, 'transport', 'member')){ ?>        
                        <li><a><i class="fa fa-bus"></i> <?php echo lang('transport'); ?> <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <?php if(has_permission(VIEW, 'transport', 'vehicle')){ ?>
                                    <li><a href="<?php echo site_url('transport/vehicle/index'); ?>"><?php echo lang('vehicle'); ?></a></li>
                                <?php } ?>
                                <?php if(has_permission(VIEW, 'transport', 'route')){ ?>
                                    <li><a href="<?php echo site_url('transport/route/index'); ?>"><?php echo lang('transport_route'); ?></a></li>
                                <?php } ?>
                                <?php if(has_permission(VIEW, 'transport', 'member')){ ?>
                                    <li><a href="<?php echo site_url('transport/member/index'); ?>"><?php echo lang('transport_member'); ?></a></li>
                                <?php } ?>
                            </ul>
                        </li>  
                    <?php } ?>
                        
                    <?php if(has_permission(VIEW, 'hostel', 'hostel') || 
                            has_permission(VIEW, 'hostel', 'room') || 
                            has_permission(VIEW, 'hostel', 'member')){ ?>        
                        <li><a><i class="fa fa-hotel"></i> <?php echo lang('hostel'); ?> <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <?php if(has_permission(VIEW, 'hostel', 'hostel')){ ?>
                                    <li><a href="<?php echo site_url('hostel/index'); ?>"><?php echo lang('manage_hostel'); ?></a></li>
                                <?php } ?>
                                <?php if(has_permission(VIEW, 'hostel', 'room')){ ?>
                                    <li><a href="<?php echo site_url('hostel/room/index'); ?>"><?php echo lang('manage_room'); ?></a></li>
                                <?php } ?>
                                <?php if(has_permission(VIEW, 'hostel', 'member')){ ?>
                                    <li><a href="<?php echo site_url('hostel/member/index'); ?>"><?php echo lang('hostel_member'); ?></a></li>
                                <?php } ?>
                            </ul>
                        </li>
                   <?php } ?>
                    
                    <?php if(has_permission(VIEW, 'message', 'message')){ ?>    
                        <li><a href="<?php echo site_url('message/inbox'); ?>"><i class="fa fa-comments-o"></i> <?php echo lang('message'); ?></a></li>                   
                    <?php } ?>
                    
                    <?php if(has_permission(VIEW, 'message', 'mail') || has_permission(VIEW, 'message', 'text')){ ?>
                        <li><a><i class="fa fa-envelope-o"></i> <?php echo lang('mail_and_sms'); ?> <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <?php if(has_permission(VIEW, 'message', 'mail')){ ?>  
                                    <li><a href="<?php echo site_url('message/mail/index'); ?>"><?php echo lang('email'); ?></a></li>
                                <?php } ?>
                                <?php if(has_permission(VIEW, 'message', 'text')){ ?>  
                                    <li><a href="<?php echo site_url('message/text/index'); ?>"><?php echo lang('sms'); ?></a></li>
                                <?php } ?>
                            </ul>
                        </li>   
                    <?php } ?>           
                        
                    <?php if(has_permission(VIEW, 'complain', 'complain') || has_permission(VIEW, 'complain', 'type')){ ?>
                        <li><a><i class="fa fa-commenting"></i> <?php echo lang('complain'); ?> <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <?php if(has_permission(VIEW, 'complain', 'type')){ ?>  
                                    <li><a href="<?php echo site_url('complain/type/index'); ?>"><?php echo lang('complain_type'); ?></a></li>
                                <?php } ?>
                                <?php if(has_permission(VIEW, 'complain', 'complain')){ ?>  
                                    <li><a href="<?php echo site_url('complain/index'); ?>"><?php echo lang('manage_complain'); ?> </a></li>
                                <?php } ?>
                            </ul>
                        </li>   
                    <?php } ?>  
                    
                    <?php if(has_permission(VIEW, 'announcement', 'notice') || 
                            has_permission(VIEW, 'announcement', 'news') || 
                            has_permission(VIEW, 'announcement', 'holiday')){ ?>            
                        <li><a><i class="fa fa-bullhorn"></i> <?php echo lang('announcement'); ?> <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <?php if(has_permission(VIEW, 'announcement', 'notice')){ ?>
                                    <li><a href="<?php echo site_url('announcement/notice/index'); ?>"><?php echo lang('notice'); ?></a></li>
                                <?php } ?>
                                <?php if(has_permission(VIEW, 'announcement', 'news')){ ?>
                                    <li><a href="<?php echo site_url('announcement/news/index'); ?>"><?php echo lang('news'); ?></a></li>
                                <?php } ?>
                                <?php if(has_permission(VIEW, 'announcement', 'holiday')){ ?>
                                    <li><a href="<?php echo site_url('announcement/holiday/index'); ?>"><?php echo lang('holiday'); ?></a></li>
                                <?php } ?>
                            </ul>
                        </li>  
                    <?php } ?>
                   
                    <?php if(has_permission(VIEW, 'event', 'event')){ ?>    
                        <li><a href="<?php echo site_url('event/index'); ?>"><i class="fa fa fa-calendar-check-o"></i> <?php echo lang('event'); ?></a></li>
                    <?php } ?>
                                            
                    <?php if(has_permission(VIEW, 'payroll', 'grade') || has_permission(VIEW, 'payroll', 'payment')){ ?>
                        <li><a><i class="fa fa-dollar"></i> <?php echo lang('payroll'); ?> <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <?php if(has_permission(VIEW, 'payroll', 'grade')){ ?>  
                                    <li><a href="<?php echo site_url('payroll/grade/index'); ?>"><?php echo lang('salary_grade'); ?></a></li>
                                <?php } ?>
                                <?php if(has_permission(VIEW, 'payroll', 'payment')){ ?>  
                                    <li><a href="<?php echo site_url('payroll/payment/index'); ?>"> <?php echo lang('pay_salary'); ?></a></li>
                                <?php } ?>
                                <?php if(has_permission(VIEW, 'payroll', 'payment')){ ?>  
                                    <li><a href="<?php echo site_url('payroll/history/index'); ?>"><?php echo lang('paid_salary'); ?></a></li>
                                <?php } ?>
                            </ul>
                        </li>   
                    <?php } ?>    
                    
                                        
                    <?php if(has_permission(VIEW, 'accounting', 'discount') || 
                            has_permission(VIEW, 'accounting', 'feetype') || 
                            has_permission(VIEW, 'accounting', 'invoice') || 
                            has_permission(VIEW, 'accounting', 'duefeeemail')  || 
                            has_permission(VIEW, 'accounting', 'duefeesms') || 
                            has_permission(VIEW, 'accounting', 'exphead') || 
                            has_permission(VIEW, 'accounting', 'expenditure') || 
                            has_permission(VIEW, 'accounting', 'incomehead') || 
                            has_permission(VIEW, 'accounting', 'income')){ ?>                
                        <li><a><i class="fa fa-calculator"></i> <?php echo lang('accounting'); ?> <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                               <?php if(has_permission(VIEW, 'accounting', 'discount')){ ?>
                                    <li><a href="<?php echo site_url('accounting/discount/index'); ?>"><?php echo lang('discount'); ?></a></li> 
                                <?php } ?>
                               <?php if(has_permission(VIEW, 'accounting', 'feetype')){ ?>
                                    <li><a href="<?php echo site_url('accounting/feetype/index'); ?>"> <?php echo lang('fee_type'); ?></a></li> 
                                <?php } ?>
                               
                                <?php if(has_permission(VIEW, 'accounting', 'invoice')){ ?>
                                    
                                    <?php if(ci()->session->userdata('role_id') == STUDENT || ci()->session->userdata('role_id') == GUARDIAN){ ?>
                                        <li><a href="<?php echo site_url('accounting/invoice/due'); ?>"><?php echo lang('due_invoice'); ?></a></li>
                                    <?php }else{ ?>
                                        <li><a href="<?php echo site_url('accounting/invoice/add'); ?>"><?php echo lang('fee_collection'); ?></a></li>                            
                                        <li><a href="<?php echo site_url('accounting/invoice/index'); ?>"><?php echo lang('manage_invoice'); ?></a></li>                            
                                        <li><a href="<?php echo site_url('accounting/invoice/due'); ?>"><?php echo lang('due_invoice'); ?></a></li>
                                    <?php } ?>                                    
                                <?php } ?>
                                        
                                <?php if(has_permission(VIEW, 'accounting', 'receipt')){ ?>   
                                        <li><a href="<?php echo site_url('accounting/receipt/duereceipt'); ?>"><?php echo lang('due_receipt'); ?></a></li>
                                        <li><a href="<?php echo site_url('accounting/receipt/paidreceipt'); ?>"><?php echo lang('paid_receipt'); ?></a></li>
                                <?php } ?>        
                                        
                                <?php if(has_permission(VIEW, 'accounting', 'duefeeemail')){ ?>  
                                    <li><a href="<?php echo site_url('accounting/duefeeemail/index'); ?>"><?php echo lang('due_fee_email'); ?></a></li>
                                <?php } ?>
                                <?php if(has_permission(VIEW, 'accounting', 'duefeesms')){ ?>  
                                    <li><a href="<?php echo site_url('accounting/duefeesms/index'); ?>"><?php echo lang('due_fee_sms'); ?></a></li>
                                <?php } ?>
                                    
                                <?php if(has_permission(VIEW, 'accounting', 'incomehead')){ ?>
                                    <li><a href="<?php echo site_url('accounting/incomehead/index'); ?>"><?php echo lang('income_head'); ?></a></li> 
                                <?php } ?>
                                <?php if(has_permission(VIEW, 'accounting', 'income')){ ?>
                                    <li><a href="<?php echo site_url('accounting/income/index'); ?>"><?php echo lang('income'); ?></a></li> 
                                <?php } ?>        
                                <?php if(has_permission(VIEW, 'accounting', 'exphead')){ ?>
                                    <li><a href="<?php echo site_url('accounting/exphead/index'); ?>"><?php echo lang('expenditure_head'); ?></a></li>
                                <?php } ?>
                                <?php if(has_permission(VIEW, 'accounting', 'expenditure')){ ?>
                                    <li><a href="<?php echo site_url('accounting/expenditure/index'); ?>"><?php echo lang('expenditure'); ?></a></li>
                                <?php } ?>                                
                            </ul>
                        </li> 
                    <?php } ?>
                    
                    <?php if(has_permission(VIEW, 'report', 'report')){ ?>
                        <li><a><i class="fa fa-bar-chart"></i> <?php echo lang('report'); ?> <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="<?php echo site_url('report/income'); ?>"><?php echo lang('income_report'); ?></a></li>
                                <li><a href="<?php echo site_url('report/expenditure'); ?>"><?php echo lang('expenditure_report'); ?></a></li>
                                <li><a href="<?php echo site_url('report/invoice'); ?>"><?php echo lang('invoice_report'); ?></a></li>
                                <li><a href="<?php echo site_url('report/duefee'); ?>"><?php echo lang('due_fee_report'); ?></a></li>
                                <li><a href="<?php echo site_url('report/feecollection'); ?>"><?php echo lang('fee_collection_report'); ?></a></li>
                                <li><a href="<?php echo site_url('report/balance'); ?>"><?php echo lang('accounting_balance_report'); ?></a></li> 
                                <li><a href="<?php echo site_url('report/library'); ?>"><?php echo lang('library_report'); ?></a></li>
                                <li><a href="<?php echo site_url('report/sattendance'); ?>"><?php echo lang('student_attendance_report'); ?></a></li>
                                <li><a href="<?php echo site_url('report/syattendance'); ?>"><?php echo lang('student_yearly_attendance_report'); ?></a></li>
                                <li><a href="<?php echo site_url('report/tattendance'); ?>"><?php echo lang('teacher_attendance_report'); ?></a></li>
                                <li><a href="<?php echo site_url('report/tyattendance'); ?>"><?php echo lang('teacher_yearly_attendance_report'); ?></a></li>
                                <li><a href="<?php echo site_url('report/eattendance'); ?>"><?php echo lang('employee_attendance_report'); ?></a></li>
                                <li><a href="<?php echo site_url('report/eyattendance'); ?>"><?php echo lang('employee_yearly_attendance_report'); ?></a></li>
                                <li><a href="<?php echo site_url('report/student'); ?>"><?php echo lang('student_report'); ?></a></li>
                                <li><a href="<?php echo site_url('report/sinvoice'); ?>"><?php echo lang('student_invoice_report'); ?></a></li> 
                                <li><a href="<?php echo site_url('report/sactivity'); ?>"><?php echo lang('student_activity_report'); ?></a></li>
                                <li><a href="<?php echo site_url('report/payroll'); ?>"><?php echo lang('payroll_report'); ?></a></li>
                                <li><a href="<?php echo site_url('report/transaction'); ?>"><?php echo lang('daily_transaction_report'); ?></a></li>
                                <li><a href="<?php echo site_url('report/statement'); ?>"><?php echo lang('daily_statement_report'); ?></a></li>
                                <li><a href="<?php echo site_url('report/examresult'); ?>"><?php echo lang('exam_result_report'); ?></a></li>
                            </ul>
                        </li> 
                    <?php } ?>
                   
                   <?php if(has_permission(VIEW, 'gallery', 'gallery') || has_permission(VIEW, 'gallery', 'image')){ ?>     
                    <li><a><i class="fa fa-image"></i><?php echo lang('media_gallery'); ?> <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <?php if(has_permission(VIEW, 'gallery', 'gallery')){ ?>
                                <li><a href="<?php echo site_url('gallery/index'); ?>"><?php echo lang('gallery'); ?></a></li>
                           <?php } ?>
                           <?php if(has_permission(VIEW, 'gallery', 'image')){ ?>      
                                <li><a href="<?php echo site_url('gallery/image/index'); ?>"><?php echo lang('gallery_image'); ?></a></li>
                           <?php } ?>
                        </ul>
                    </li> 
                    <?php } ?> 
                    
                    <?php if(has_permission(VIEW, 'frontend', 'frontend') || has_permission(VIEW, 'frontend', 'slider')){ ?>
                    <li><a><i class="fa fa-desktop"></i><?php echo lang('manage_frontend'); ?> <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <?php if(has_permission(VIEW, 'frontend', 'frontend')){ ?>
                            <li><a href="<?php echo site_url('frontend/index'); ?>"> <?php echo lang('frontend_page'); ?></a></li>
                            <?php } ?>
                            <?php if(has_permission(VIEW, 'frontend', 'slider')){ ?>
                                <li><a href="<?php echo site_url('frontend/slider/index'); ?>"> <?php echo lang('manage_slider'); ?></a></li>
                            <?php } ?>                            
                            <?php if(has_permission(VIEW, 'frontend', 'about')){ ?>
                                <li><a href="<?php echo site_url('frontend/about/index'); ?>"><?php echo lang('about_branch'); ?></a></li>
                            <?php } ?>                            
                        </ul>
                    </li>  
                    <?php } ?>
                                   
                    <li><a><i class="fa fa-lock"></i><?php echo lang('profile'); ?> <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?php echo site_url('profile/index'); ?>"><?php echo lang('my_profile'); ?></a></li>
                            <li><a href="<?php echo site_url('profile/password'); ?>"><?php echo lang('reset_password'); ?></a></li>
                            <?php if(ci()->session->userdata('role_id') == GUARDIAN){ ?>
                                <li><a href="<?php echo site_url('guardian/invoice'); ?>"><?php echo lang('invoice'); ?></a></li>
                                <li><a href="<?php echo site_url('guardian/feedback'); ?>"><?php echo lang('feedback'); ?></a></li>
                            <?php } ?>
                            <?php if(ci()->session->userdata('role_id') == STUDENT){ ?>
                                <li><a href="<?php echo site_url('accounting/invoice/due'); ?>"><?php echo lang('invoice'); ?></a></li>
                            <?php } ?>
                                
                            <?php if(ci()->session->userdata('role_id') != SUPER_ADMIN){ ?>  
                                <?php if(has_permission(VIEW, 'usercomplain', 'usercomplain')){ ?>
                                    <li><a href="<?php echo site_url('usercomplain/index'); ?>"><?php echo lang('complain'); ?></a></li>    
                                <?php } ?>
                                <?php if(has_permission(VIEW, 'userleave', 'userleave')){ ?>
                                    <li><a href="<?php echo site_url('userleave/index'); ?>"><?php echo lang('leave_application'); ?></a></li>    
                                <?php } ?>
                            <?php } ?>
                                
                            <li><a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><?php echo lang('logout'); ?></a></li>
                        </ul>
                    </li>  
                    
                </ul>
            </div>     
        </div>
        <!-- /sidebar menu -->
    </div>
</div>

