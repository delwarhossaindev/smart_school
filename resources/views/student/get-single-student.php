<div class="no-print" data-example-id="togglable-tabs">
    <ul  class="nav nav-tabs bordered no-print">
        <li class="active"><a href="#tab_basic_info"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-info-circle"></i> <?php echo lang('basic_information'); ?></a> </li>
        <li class=""><a href="#tab_guardian_info"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-paw"></i> <?php echo lang('guardian_information'); ?></a> </li>
        <li class=""><a href="#tab_parent_info"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-male"></i> <?php echo lang('parent_information'); ?></a> </li>
        <li  class=""><a href="#tab_attendance"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-check-circle-o"></i> <?php echo lang('attendance'); ?></a> </li>                          
        <li  class=""><a href="#tab_mark"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-file-archive-o"></i> <?php echo lang('exam_mark'); ?></a> </li>                          
        <li  class=""><a href="#tab_payment"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-dollar"></i> <?php echo lang('payment'); ?> </a> </li>                          
        <li  class=""><a href="#tab_activity"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-clipboard"></i> <?php echo lang('activity'); ?> </a> </li>                          
    </ul>
    <br/>

    <div class="tab-content no-print">
        <div  class="tab-pane fade in active no-print" id="tab_basic_info" >               
            <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <tbody>
                    <tr>
                        <th width="20%"><?php echo lang('branch_name'); ?></th>
                        <td  width="30%"><?php echo $student->branch_name; ?></td>
                        <th  width="20%"><?php echo lang('username'); ?></th>
                        <td  width="30%"><?php echo $student->username; ?></td>
                    </tr>
                    <tr>
                        <th ><?php echo lang('admission_no'); ?></th>
                        <td ><?php echo $student->admission_no; ?></td>
                        <th ><?php echo lang('name'); ?></th>
                        <td ><?php echo $student->name; ?></td>
                    </tr>
                    <tr> 
                        <th><?php echo lang('admission_date'); ?></th>
                        <td><?php echo date(ci()->global_setting->date_format, strtotime($student->admission_date)); ?></td>
                        <th><?php echo lang('birth_date'); ?></th>
                        <td><?php echo date(ci()->global_setting->date_format, strtotime($student->dob)); ?></td>
                    </tr>
                    <tr>
                        <th><?php echo lang('national_id'); ?></th>
                        <td><?php echo $student->national_id; ?></td>
                        <th><?php echo lang('student_type'); ?></th>
                        <td><?php echo $student->type; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo lang('gender'); ?></th>
                        <td><?php echo lang($student->gender); ?></td>
                        <th><?php echo lang('blood_group'); ?></th>
                        <td><?php echo lang($student->blood_group); ?></td>
                    </tr>
                    <tr>
                        <th><?php echo lang('religion'); ?></th>
                        <td><?php echo $student->religion; ?></td>
                        <th><?php echo lang('caste'); ?></th>
                        <td><?php echo $student->caste; ?></td>                        
                    </tr>
                    <tr>
                        <th><?php echo lang('phone'); ?></th>
                        <td><?php echo $student->phone; ?></td>                       
                         <th><?php echo lang('email'); ?></th>
                        <td><?php echo $student->email; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo lang('present_address'); ?></th>
                        <td><?php echo $student->present_address; ?></td>
                        <th><?php echo lang('permanent_address'); ?></th>
                        <td><?php echo $student->permanent_address; ?></td>                        
                    </tr>
                    <tr>
                        <th><?php echo lang('class'); ?></th>
                        <td><?php echo $student->class_name; ?></td>
                        <th><?php echo lang('section'); ?></th>
                        <td><?php echo $student->section; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo lang('roll_no'); ?></th>
                        <td><?php echo $student->roll_no; ?></td>
                        <th><?php echo lang('registration_no'); ?></th>
                        <td><?php echo $student->registration_no; ?></td>
                    </tr>

                    <tr>
                        <th><?php echo lang('discount'); ?></th>
                        <td> 
                            <?php $type = $student->discount_type == 'flat' ? lang($student->discount_type.'_amount') : '%'; ?>
                            <?php echo $student->discount_title . ' [ ' . $student->amount . ' '.$type.' ]'; ?>
                        </td>
                        <th><?php echo lang('second_language'); ?></th>
                        <td><?php echo $student->second_language; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo lang('previous_school'); ?></th>
                        <td><?php echo $student->previous_school; ?></td>
                        <th><?php echo lang('previous_class'); ?></th>
                        <td><?php echo $student->previous_class; ?></td>

                    </tr>
                    <tr>
                        <th><?php echo lang('transfer_certificate'); ?></th>
                        <td colspan="3">
                            <?php if ($student->transfer_certificate) { ?>
                                <a target="_blank" href="<?php echo UPLOAD_PATH; ?>transfer-certificate/<?php echo $student->transfer_certificate; ?>" class="btn btn-success btn-xs"><i class="fa fa-download"></i> <?php echo lang('download'); ?></a>
                            <?php } ?>
                        </td>

                    </tr>
                    
                    <tr>
                        <th><?php echo lang('group'); ?></th>
                        <td><?php echo lang($student->group); ?></td>
                        <th><?php echo lang('health_condition'); ?></th>
                        <td><?php echo $student->health_condition; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo lang('other_info'); ?></th>
                        <td><?php echo $student->other_info; ?></td>
                        <th><?php echo lang('photo'); ?></th>
                        <td>
                            <?php if ($student->photo) { ?>
                            <img class="detail-img" src="<?php echo UPLOAD_PATH; ?>student-photo/<?php echo $student->photo; ?>" alt="" width="70" />
                            <?php }else{ ?>
                            <img class="detail-img" src="<?php echo IMG_URL; ?>default-user.png" alt="" width="70" /> 
                            <?php } ?>
                        </td>
                    </tr>
                </tbody>
            </table>                
        </div>
        <div  class="tab-pane fade in no-print" id="tab_guardian_info" >
            <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <tbody>
                    <tr>
                        <th><?php echo lang('guardian_name'); ?></th>
                        <td><?php echo $guardian->name; ?></td>
                        <th><?php echo lang('relation_with_guardian'); ?></th>
                        <td><?php echo $student->relation_with; ?></td>
                    </tr>                                                
                    <tr>
                        <th><?php echo lang('phone'); ?></th>
                        <td><?php echo $guardian->phone; ?></td>   
                        <th><?php echo lang('national_id'); ?></th>
                        <td><?php echo $guardian->national_id; ?></td>                        
                        
                    </tr>
                    <tr>
                        <th><?php echo lang('present_address'); ?></th>
                        <td><?php echo $guardian->present_address; ?></td>                        
                        <th><?php echo lang('permanent_address'); ?></th>
                        <td><?php echo $guardian->permanent_address; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo lang('religion'); ?></th>
                        <td><?php echo $guardian->religion; ?></td>                       
                        <th><?php echo lang('role'); ?></th>
                        <td><?php echo $guardian->role; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo lang('email'); ?></th>
                        <td><?php echo $guardian->email; ?></td>  
                        <th><?php echo lang('profession'); ?></th>
                        <td><?php echo $guardian->profession; ?></td>
                                               
                    </tr>        
                    <tr>
                        <th><?php echo lang('photo'); ?></th>
                        <td>
                            <?php if ($guardian->photo) { ?>
                                <img class="detail-img"  src="<?php echo UPLOAD_PATH; ?>guardian-photo/<?php echo $guardian->photo; ?>" alt="" width="70" /><br/><br/>
                            <?php }else{ ?>
                            <img class="detail-img" src="<?php echo IMG_URL; ?>default-user.png" alt="" width="70" /> 
                            <?php } ?> 
                        </td>
                         <th><?php echo lang('other_info'); ?></th>
                        <td ><?php echo $guardian->other_info; ?>   </td>
                    </tr>
                </tbody>
            </table>  
        </div>
        <div  class="tab-pane fade in no-print" id="tab_parent_info" >
            <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <tbody>
                    <tr>
                        <th><?php echo lang('father_name'); ?></th>
                        <td><?php echo $student->father_name; ?></td>                       
                        <th><?php echo lang('mother_name'); ?></th>
                        <td><?php echo $student->mother_name; ?></td>                       
                    </tr>
                    <tr>
                        <th><?php echo lang('father_phone'); ?></th>
                        <td><?php echo $student->father_phone; ?></td>                       
                        <th><?php echo lang('mother_phone'); ?></th>
                        <td><?php echo $student->mother_phone; ?></td>                       
                    </tr>
                    <tr>
                        <th><?php echo lang('father_education'); ?></th>
                        <td><?php echo $student->father_education; ?></td>                       
                        <th><?php echo lang('mother_education'); ?></th>
                        <td><?php echo $student->mother_education; ?></td>                       
                    </tr>                   
                    <tr>
                        <th><?php echo lang('father_profession'); ?></th>
                        <td><?php echo $student->father_profession; ?></td>                       
                        <th><?php echo lang('mother_profession'); ?></th>
                        <td><?php echo $student->mother_profession; ?></td>                       
                    </tr>
                    <tr>
                        <th><?php echo lang('father_designation'); ?></th>
                        <td><?php echo $student->father_designation; ?></td>                       
                        <th><?php echo lang('mother_designation'); ?></th>
                        <td><?php echo $student->mother_designation; ?></td>                       
                    </tr>
                    <tr>
                        <th><?php echo lang('father_photo'); ?></th>
                        <td>
                            <?php if ($student->father_photo) { ?>
                                <img class="detail-img"  src="<?php echo UPLOAD_PATH; ?>father-photo/<?php echo $student->father_photo; ?>" alt="" width="70" /><br/><br/>
                            <?php }else{ ?>
                            <img class="detail-img" src="<?php echo IMG_URL; ?>default-user.png" alt="" width="70" /> 
                            <?php } ?>
                        </td>                       
                        <th><?php echo lang('mother_photo'); ?></th>
                        <td>
                            <?php if ($student->mother_photo) { ?>
                                <img class="detail-img" src="<?php echo UPLOAD_PATH; ?>mother-photo/<?php echo $student->mother_photo; ?>" alt="" width="70" /><br/><br/>
                            <?php }else{ ?>
                            <img class="detail-img" src="<?php echo IMG_URL; ?>default-user.png" alt="" width="70" /> 
                            <?php } ?>
                        </td>                       
                    </tr>
                </tbody>
            </table>  
        </div>
        <div  class="tab-pane fade in no-print" id="tab_attendance" >
            <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <td><?php echo lang('month'); ?> <i class="fa fa-long-arrow-down"></i> - <?php echo lang('date'); ?> <i class="fa fa-long-arrow-right"></i></td>
                        <?php for($i = 1; $i<=$days; $i++ ){ ?>
                            <td><?php echo $i; ?></td>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>   
                    <?php  $months = get_months(); ?>
                    <?php foreach($months as $key=>$value){ ?>
                        <?php 
                            $month_number = date('m',strtotime($key)); 
                            $attendance = get_student_monthly_attendance($branch_id, $student_id, $academic_year_id, $class_id, $section_id, $month_number ,$days);
                           ?>
                        <?php if(!empty($attendance)){ ?>
                         <tr>
                             <td><?php echo $value; ?></td> 
                             <?php foreach($attendance AS $key ){ ?>
                                 <td> <?php echo $key ? $key : '<i style="color:red;">--</i>'; ?></td>
                             <?php } ?>
                         </tr>
                         <?php } ?>  
                        <?php } ?>  
                </tbody>
            </table>  
        </div>
        <div  class="tab-pane fade in no-print" id="tab_mark" >
            <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th rowspan="2"><?php echo lang('sl_no'); ?></th>
                        <th rowspan="2"  width="12%"><?php echo lang('subject'); ?></th>
                        <th colspan="2"><?php echo lang('written'); ?></th>                                            
                        <th colspan="2"><?php echo lang('tutorial'); ?></th>                                            
                        <th colspan="2"><?php echo lang('practical'); ?></th>                                            
                        <th colspan="2"><?php echo lang('viva'); ?></th>                                            
                        <th colspan="2"><?php echo lang('total'); ?></th>                                            
                        <th rowspan="2"><?php echo lang('letter_grade'); ?></th>                                            
                        <th rowspan="2"><?php echo lang('grade_point'); ?></th>                                            
                        <th rowspan="2"><?php echo lang('lowest'); ?></th>                                            
                        <th rowspan="2"><?php echo lang('height'); ?></th>                                            
                        <th rowspan="2"><?php echo lang('position'); ?></th>                                            
                    </tr>
                    <tr>                           
                        <th><?php echo lang('mark'); ?></th>                                            
                        <th><?php echo lang('obtain'); ?></th>                                            
                        <th><?php echo lang('mark'); ?></th>                                            
                        <th><?php echo lang('obtain'); ?></th>                                            
                        <th><?php echo lang('mark'); ?></th>                                            
                        <th><?php echo lang('obtain'); ?></th>                                            
                        <th><?php echo lang('mark'); ?></th>                                            
                        <th><?php echo lang('obtain'); ?></th>                                            
                        <th><?php echo lang('mark'); ?></th>                                            
                        <th><?php echo lang('obtain'); ?></th> 
                    </tr>
                </thead>
                <tbody id="fn_mark"> 

                      <?php if (isset($exams) && !empty($exams)) { ?>
                      <?php foreach($exams as $ex){ ?>

                          <tr style="background: #f9f9f9;">
                              <th colspan="17"><?php echo $ex->title; ?></th>
                          </tr>

                          <?php
                          $subjects = get_subject_list($branch_id, $academic_year_id, $ex->id, $class_id, $section_id, $student_id);
                          $count = 1;
                          if (isset($subjects) && !empty($subjects)) {
                          ?>

                          <?php foreach ($subjects as $obj) { ?>

                          <?php $lh = get_lowet_height_mark($branch_id, $academic_year_id, $ex->id, $class_id, $section_id, $obj->subject_id ); ?>
                          <?php $position = get_position_in_subject($branch_id,$academic_year_id, $ex->id, $class_id, $section_id, $obj->subject_id , $obj->obtain_total_mark); ?>
                              <tr>
                                  <td><?php echo $count++;  ?></td>
                                  <td><?php echo ucfirst($obj->subject); ?></td>
                                  <td><?php echo $obj->written_mark; ?></td>
                                  <td><?php echo $obj->written_obtain; ?></td>
                                  <td><?php echo $obj->tutorial_mark; ?></td>
                                  <td><?php echo $obj->tutorial_obtain; ?></td>
                                  <td><?php echo $obj->practical_mark; ?></td>
                                  <td><?php echo $obj->practical_obtain; ?></td>
                                  <td><?php echo $obj->viva_mark; ?></td>
                                  <td><?php echo $obj->viva_obtain; ?></td>
                                  <td><?php echo $obj->exam_total_mark; ?></td>
                                  <td><?php echo $obj->obtain_total_mark; ?></td>
                                  <td><?php echo $obj->name; ?></td>
                                  <td><?php echo $obj->point; ?></td>                               
                                  <td><?php echo $lh->lowest; ?></td>                               
                                  <td><?php echo $lh->height; ?></td>                               
                                  <td><?php echo $position; ?></td>                                
                              </tr>
                          <?php } ?>
                      <?php }else{ ?>
                              <tr>
                                  <td colspan="17" align="center"><?php echo lang('no_data_found'); ?></td>
                              </tr>
                      <?php } ?>   

                  <?php } ?>
                  <?php }else{ ?>
                          <tr>
                              <td colspan="17" align="center"><?php echo lang('no_data_found'); ?></td>
                           </tr>    
                   <?php } ?>            
                </tbody>   
            </table>  
             
            <table class="table table-striped_ table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th rowspan="2"><?php echo lang('sl_no'); ?></th>
                        <th rowspan="2" width="12%"><?php echo lang('exam'); ?></th>
                        <th colspan="2"><?php echo lang('written'); ?></th>                                            
                        <th colspan="2"><?php echo lang('tutorial'); ?></th>                                            
                        <th colspan="2"><?php echo lang('practical'); ?></th>                                            
                        <th colspan="2"><?php echo lang('viva'); ?></th>                                            
                        <th colspan="2"><?php echo lang('total'); ?></th>                                            
                        <th rowspan="2"><?php echo lang('average_grade_point'); ?></th>                                            
                        <th rowspan="2"><?php echo lang('letter_grade'); ?></th>                                            
                        <th rowspan="2"><?php echo lang('lowest'); ?></th>                                            
                        <th rowspan="2"><?php echo lang('height'); ?></th>                                            
                        <th rowspan="2"><?php echo lang('position'); ?></th>                                            
                    </tr>
                    <tr>                           
                        <th><?php echo lang('mark'); ?></th>                                            
                        <th><?php echo lang('obtain'); ?></th>                                            
                        <th><?php echo lang('mark'); ?></th>                                            
                        <th><?php echo lang('obtain'); ?></th>                                            
                        <th><?php echo lang('mark'); ?></th>                                            
                        <th><?php echo lang('obtain'); ?></th>                                            
                        <th><?php echo lang('mark'); ?></th>                                            
                        <th><?php echo lang('obtain'); ?></th>                                            
                        <th><?php echo lang('mark'); ?></th>                                            
                        <th><?php echo lang('obtain'); ?></th> 
                    </tr>
                </thead>
                <?php

                $count = 1;
                if (isset($exams) && !empty($exams)) {
                ?>

                    <?php foreach ($exams as $ex) { ?>
                        <?php $exam = get_exam_result($branch_id, $ex->id, $student_id, $academic_year_id, $class_id, $section_id); ?>
                        <?php if(@$exam->name == ''){ continue; } ?>
                
                        <?php $mark = get_exam_wise_markt($branch_id, $academic_year_id, $ex->id, $class_id, $section_id, $student_id ); ?>
                        <?php $obtain_total_mark = $mark->written_obtain+$mark->tutorial_obtain+$mark->practical_obtain+$mark->viva_obtain; ?>
                        <?php $rank = get_position_in_exam($branch_id, $academic_year_id, $ex->id, $class_id, $section_id, $obtain_total_mark); ?>
                        <?php $exam_lh = get_lowet_height_result($branch_id, $academic_year_id, $ex->id, $class_id, $section_id, $student_id); ?>
                        <?php $exam = get_exam_result($branch_id, $ex->id, $student_id, $academic_year_id, $class_id, $section_id); ?>

                        <tr>
                            <td><?php echo $count++;  ?></td>
                            <td><?php echo ucfirst($ex->title); ?></td>
                            <td><?php echo $mark->written_mark; ?></td>
                            <td><?php echo $mark->written_obtain; ?></td>
                            <td><?php echo $mark->tutorial_mark; ?></td>
                            <td><?php echo $mark->tutorial_obtain; ?></td>
                            <td><?php echo $mark->practical_mark; ?></td>
                            <td><?php echo $mark->practical_obtain; ?></td>
                            <td><?php echo $mark->viva_mark; ?></td>
                            <td><?php echo $mark->viva_obtain; ?></td>
                            <td><?php echo $mark->written_mark+$mark->tutorial_mark+$mark->practical_mark+$mark->viva_mark; ?></td>
                            <td><?php echo $obtain_total_mark; ?></td>
                            <td><?php echo @number_format($mark->point/$mark->total_subject,2); ?></td>                               
                            <td><?php echo @$exam->name; ?></td>
                            <td><?php echo $exam_lh->lowest; ?></td>                               
                            <td><?php echo $exam_lh->height; ?></td>                               
                            <td><?php echo $rank; ?></td>                                
                        </tr>                        
                    <?php } ?>   
                <?php } ?>   
            </table>
        </div>        
        <div  class="tab-pane fade in no-print" id="tab_payment">
            <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th><?php echo lang('sl_no'); ?></th>
                        <th><?php echo lang('invoice_number'); ?></th>
                        <th><?php echo lang('student'); ?></th>
                        <th><?php echo lang('class'); ?></th>
                        <th><?php echo lang('gross_amount'); ?></th>
                        <th><?php echo lang('discount'); ?></th>
                        <th><?php echo lang('net_amount'); ?></th>
                        <th><?php echo lang('payment_status'); ?></th>
                        <th><?php echo lang('action'); ?></th>                                            
                    </tr>
                </thead>
                 <tbody>   
                    <?php $count = 1; if(isset($invoices) && !empty($invoices)){ ?>
                        <?php foreach($invoices as $obj){ ?>
                        <tr>
                            <td><?php echo $count++; ?></td>
                            <td><?php echo $obj->custom_invoice_id; ?></td>
                            <td><?php echo $obj->student_name; ?></td>
                            <td><?php echo $obj->class_name; ?></td>
                            <td><?php echo $obj->gross_amount; ?></td>
                            <td><?php echo $obj->discount; ?></td>
                            <td><?php echo $obj->net_amount; ?></td>
                            <td><?php echo get_paid_status($obj->paid_status); ?></td>
                            <td>
                                <?php if(has_permission(VIEW, 'accounting', 'invoice')){ ?>
                                    <a  onclick="get_invoice_modal(<?php echo $obj->id; ?>);"  data-toggle="modal" data-target=".bs-invoice-modal-lg"  class="btn btn-success btn-xs"><i class="fa fa-eye"></i> <?php echo lang('view'); ?> </a>
                                <?php } ?>
                                <?php if(has_permission(DELETE, 'accounting', 'invoice')){ ?>
                                    <?php if($obj->paid_status == 'unpaid'){ ?>
                                        <a target="_blank" href="<?php echo site_url('accounting/invoice/delete/'.$obj->id); ?>" onclick="javascript: return confirm('<?php echo lang('confirm_alert'); ?>');" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> <?php echo lang('delete'); ?> </a>
                                    <?php } ?>
                                <?php } ?>
                            </td>
                        </tr>
                        <?php } ?>
                    <?php } ?>
                </tbody>                   
            </table>  
        </div>          
        <div  class="tab-pane fade in no-print" id="tab_activity" >
            <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                    <tr>
                    <th><?php echo lang('sl_no'); ?></th>
                    <th><?php echo lang('student'); ?></th>
                    <th><?php echo lang('class'); ?></th>
                    <th><?php echo lang('section'); ?></th>
                    <th><?php echo lang('activity'); ?> </th>
                    <th><?php echo lang('date'); ?></th>
                    <th><?php echo lang('action'); ?></th>
                </tr>
                </thead>
                 <tbody>   
                    <?php $count = 1; if(isset($activity) && !empty($activity)){ ?>
                    <?php foreach($activity as $obj){ ?>
                    <tr>
                        <td><?php echo $count++; ?></td>
                        <td><?php echo $obj->student; ?></td>
                        <td><?php echo $obj->class_name; ?></td>
                        <td><?php echo $obj->section; ?></td>
                        <td><?php echo $obj->activity; ?></td>
                        <td><?php echo date('M j,Y', strtotime($obj->activity_date)); ?></td>  
                        <td>
                            <?php if(has_permission(EDIT, 'student', 'activity')){ ?>
                            <a target="_blank" href="<?php echo site_url('student/activity/edit/'.$obj->id); ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil-square-o"></i> <?php echo lang('edit'); ?> </a>
                            <?php } ?>
                            <?php if(has_permission(VIEW, 'student', 'activity')){ ?>
                                <a  onclick="get_activity_modal(<?php echo $obj->id; ?>);"  data-toggle="modal" data-target=".bs-activity-modal-lg"  class="btn btn-success btn-xs"><i class="fa fa-eye"></i> <?php echo lang('view'); ?> </a>
                            <?php } ?>
                            <?php if(has_permission(DELETE, 'student', 'activity')){ ?>
                                <a href="<?php echo site_url('student/activity/delete/'.$obj->id); ?>" onclick="javascript: return confirm('<?php echo lang('confirm_alert'); ?>');" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> <?php echo lang('delete'); ?> </a>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                </tbody>                   
            </table>  
        </div>  
        
    </div>
</div>

<style type="text/css">
    .table>thead>tr>th { padding: 2px 4px;}
    .table>tbody>tr>th { padding: 2px 4px;}    
    .table>tbody>tr>td { padding: 2px 4px;}    
</style>


