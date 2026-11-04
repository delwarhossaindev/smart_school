<section class="page-breadcumb-area bg-with-black">
    <div class="container text-center">
        <div class="breadcrumb-content">
            <h2 class="title"><?php echo lang('admission_form'); ?></h2>
            <ul class="links">
                <li><a href="<?php echo site_url($school->branch_url); ?>"><?php echo lang('home'); ?></a></li>
                <li><a href="javascript:void(0);"><?php echo lang('admission_form'); ?></a></li>
            </ul>
        </div>
    </div>
</section>

<section class="page-contact-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="admission-form">
                    <div class="row"> 
                        <div class="col-md-10 col-sm-10 col-xs-12 ">
                            <div class="admission-address">
                                <div><h3><?php echo $school->branch_name; ?></h3></div>                                
                                <div><?php echo $school->address; ?></div>
                                <div><?php echo $school->phone; ?></div>
                                <div><?php echo $school->email; ?></div>
                                <div><h4><?php echo lang('admission_form'); ?></h4></div>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                            <span class="student-picture"><?php echo lang('photo'); ?></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12"><hr></div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12 col-sm-12"><p class="admission-form-title"><strong><?php echo lang('basic_information'); ?>:</strong></p> </div>
                    </div>  
                    
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-field">
                                <div class="field-title"><?php echo lang('name'); ?>:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div> 
                        <div class="col-md-6 col-sm-6">
                            <div class="form-field">
                                <div class="field-title"><?php echo lang('birth_date'); ?>:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>                                              
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-field">
                                <div class="field-title"><?php echo lang('gender'); ?>:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>                    
                        <div class="col-md-6 col-sm-6">
                            <div class="form-field">
                                <div class="field-title"><?php echo lang('blood_group'); ?>:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>
                    </div>
                    <div class="row">                                           
                        <div class="col-md-6 col-sm-6">
                            <div class="form-field">
                                <div class="field-title"><?php echo lang('religion'); ?>:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-field">
                                <div class="field-title"><?php echo lang('caste'); ?>:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>
                    </div>
                    <div class="row">                                           
                        <div class="col-md-6 col-sm-6">
                            <div class="form-field">
                                <div class="field-title"><?php echo lang('email'); ?>:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>   
                        <div class="col-md-6 col-sm-6">
                            <div class="form-field">
                                <div class="field-title"><?php echo lang('phone'); ?>:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>   
                    </div>
                    <div class="row">                                           
                        <div class="col-md-6 col-sm-6">
                            <div class="form-field">
                                <div class="field-title"><?php echo lang('national_id'); ?>:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>   
                        <div class="col-md-6 col-sm-6">
                            <div class="form-field">
                                <div class="field-title"><?php echo lang('health_condition'); ?>:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>   
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12 col-sm-12"><p class="admission-form-title"><strong><?php echo lang('address_information'); ?>:</strong></p> </div>
                    </div>                      
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-field">
                                <div class="field-title"><?php echo lang('present_address'); ?>:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-field">
                                <div class="field-title"><?php echo lang('permanent_address'); ?>:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="row">
                        <div class="col-md-12 col-sm-12"><p class="admission-form-title"><strong><?php echo lang('academic_information'); ?>:</strong></p> </div>
                    </div>                     
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-field">
                                <div class="field-title"><?php echo lang('student_type'); ?>:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-field">
                                <div class="field-title"><?php echo lang('class'); ?>:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-field">
                                <div class="field-title"><?php echo lang('group'); ?>:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-field">
                                <div class="field-title"><?php echo lang('second_language'); ?>:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>
                    </div>
                                     
                                        
                    
                    <div class="row">
                        <div class="col-md-12 col-sm-12"><p class="admission-form-title"><strong><?php echo lang('father_information'); ?>:</strong></p> </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-field">
                                <div class="field-title"><?php echo lang('father_name'); ?>:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-field">
                                <div class="field-title"><?php echo lang('father_phone'); ?>:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-field">
                                <div class="field-title"><?php echo lang('father_education'); ?>:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-field">
                                <div class="field-title"><?php echo lang('father_profession'); ?>:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-field">
                                <div class="field-title"><?php echo lang('father_designation'); ?>:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>                        
                    </div>
                    
                        
                    <div class="row">
                        <div class="col-md-12 col-sm-12"><p class="admission-form-title"><strong><?php echo lang('mother_information'); ?>:</strong></p> </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-field">
                                <div class="field-title"><?php echo lang('mother_name'); ?>:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-field">
                                <div class="field-title"><?php echo lang('mother_phone'); ?>:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-field">
                                <div class="field-title"><?php echo lang('mother_education'); ?>:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-field">
                                <div class="field-title"><?php echo lang('mother_profession'); ?>:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-field">
                                <div class="field-title"><?php echo lang('mother_designation'); ?>:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>                        
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12 col-sm-12"><p class="admission-form-title"><strong><?php echo lang('other_information'); ?>:</strong></p> </div>
                    </div> 
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-field">
                                <div class="field-title"><?php echo lang('email'); ?>:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-field">
                                <div class="field-title"><?php echo lang('health_condition'); ?> :</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-field">
                                <div class="field-title"><?php echo lang('previous_school'); ?>:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-field">
                                <div class="field-title"><?php echo lang('previous_class'); ?>:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-field">
                                <div class="field-title"><?php echo lang('other_info'); ?>:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>
                    </div>
                                     
                    <div class="row">
                        <div class="col-md-12 col-sm-12"><p class="admission-form-title"><strong><?php echo lang('guardian_information'); ?>:</strong></p> </div>
                    </div> 
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-field">
                                <div class="field-title"><?php echo lang('guardian_name'); ?>:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-field">
                                <div class="field-title"><?php echo lang('relation_with_guardian'); ?> :</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-field">
                                <div class="field-title"><?php echo lang('guardian_phone'); ?>:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-field">
                                <div class="field-title"><?php echo lang('email'); ?> :</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-field">
                                <div class="field-title"><?php echo lang('religion'); ?>:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-field">
                                <div class="field-title"><?php echo lang('profession'); ?> :</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-field">
                                <div class="field-title"><?php echo lang('national_id'); ?>:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>                        
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-field">
                                <div class="field-title"><?php echo lang('present_address'); ?>:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-field">
                                <div class="field-title"><?php echo lang('permanent_address'); ?>:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-field">
                                <div class="field-title"><?php echo lang('other_info'); ?>:</div> 
                                <div class="field-value"></div> 
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>         
        </div>
        <div class="row no-print">
            <div class="col-md-12 col-sm-12 text-center margin-top">
                <button class="btn btn-info glbscl-link-btn hvr-bs" onclick="window.print();"><i class="fa fa-print"></i> <?php echo lang('print'); ?></button>
                <a  class="btn btn-info glbscl-link-btn hvr-bs"  href="<?php echo site_url($school->branch_url.'/admission-online'); ?>"><?php echo lang('online_admission'); ?></a>
            </div>
        </div>
    </div>
</section>