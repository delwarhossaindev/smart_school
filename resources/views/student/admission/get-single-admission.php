<div class="" data-example-id="togglable-tabs">
    <ul  class="nav nav-tabs bordered">
        <li class="active"><a href="#tab_basic_info"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-info-circle"></i> <?php echo lang('basic_information'); ?></a> </li>
        <li class=""><a href="#tab_guardian_info"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-paw"></i> <?php echo lang('guardian_information'); ?></a> </li>
        <li class=""><a href="#tab_parent_info"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-male"></i> <?php echo lang('parent_information'); ?></a> </li>
    </ul>
    <br/>

    <div class="tab-content">
        <div  class="tab-pane fade in active" id="tab_basic_info" >               
            <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <tbody>
                    <tr>
                        <th width="20%"><?php echo lang('branch_name'); ?></th>
                        <td  width="30%"><?php echo $admission->branch_name; ?></td> 
                        <th><?php echo lang('photo'); ?></th>
                        <td>
                            <?php if ($admission->photo) { ?>
                                <img src="<?php echo UPLOAD_PATH; ?>admission-photo/<?php echo $admission->photo; ?>" alt="" width="70" />
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>                       
                        <th ><?php echo lang('name'); ?></th>
                        <td ><?php echo $admission->name; ?></td>
                        <th><?php echo lang('student_type'); ?></th>
                        <td><?php echo $admission->type; ?></td>                                             
                    </tr>
                    <tr>                       
                        <th><?php echo lang('class'); ?></th>
                        <td><?php echo $admission->class_name; ?></td>                         
                        <th><?php echo lang('group'); ?></th>
                        <td><?php echo lang($admission->group); ?></td>   
                    </tr>                  
                    
                    <tr>
                        <th><?php echo lang('gender'); ?></th>
                        <td><?php echo lang($admission->gender); ?></td>
                        <th><?php echo lang('blood_group'); ?></th>
                        <td><?php echo lang($admission->blood_group); ?></td>
                    </tr>
                    <tr>
                        <th><?php echo lang('religion'); ?></th>
                        <td><?php echo $admission->religion; ?></td>
                        <th><?php echo lang('caste'); ?></th>
                        <td><?php echo $admission->caste; ?></td>                       
                    </tr>
                    <tr>
                        <th><?php echo lang('phone'); ?></th>
                        <td><?php echo $admission->phone; ?></td>                        
                         <th><?php echo lang('email'); ?></th>
                        <td><?php echo $admission->email; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo lang('national_id'); ?></th>
                        <td><?php echo $admission->national_id; ?></td>                        
                         <th><?php echo lang('second_language'); ?></th>
                        <td><?php echo $admission->second_language; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo lang('present_address'); ?></th>
                        <td><?php echo $admission->present_address; ?></td>
                        <th><?php echo lang('permanent_address'); ?></th>
                        <td><?php echo $admission->permanent_address; ?></td>                        
                    </tr>                    
                    <tr>
                        <th><?php echo lang('previous_school'); ?></th>
                        <td><?php echo $admission->previous_school; ?></td>
                        <th><?php echo lang('previous_class'); ?></th>
                        <td><?php echo $admission->previous_class; ?></td>
                    </tr>  
                    <tr> 
                        <th><?php echo lang('application_date'); ?></th>
                        <td><?php echo date(ci()->global_setting->date_format, strtotime($admission->created_at)); ?></td>
                        <th><?php echo lang('birth_date'); ?></th>
                        <td><?php echo date(ci()->global_setting->date_format, strtotime($admission->dob)); ?></td>
                    </tr>                   
                    <tr> 
                        <th><?php echo lang('health_condition'); ?></th>
                        <td colspan="3"><?php echo $admission->health_condition; ?></td>
                    </tr>                   
                </tbody>
            </table>                
        </div>
        <div  class="tab-pane fade in " id="tab_guardian_info" >
            <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <tbody>
                    <tr>
                        <th><?php echo lang('guardian_name'); ?></th>
                        <td><?php echo $admission->gud_name; ?></td>
                        <th><?php echo lang('relation_with_guardian'); ?></th>
                        <td><?php echo $admission->gud_relation; ?></td>
                    </tr>                                                
                    <tr>
                        <th><?php echo lang('guardian_phone'); ?></th>
                        <td><?php echo $admission->gud_phone; ?></td>   
                        <th><?php echo lang('email'); ?></th>
                        <td><?php echo $admission->gud_email; ?></td>  
                    </tr>
                    <tr>
                        <th><?php echo lang('present_address'); ?></th>
                        <td><?php echo $admission->gud_present_address; ?></td>                        
                        <th><?php echo lang('permanent_address'); ?></th>
                        <td><?php echo $admission->gud_permanent_address; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo lang('religion'); ?></th>
                        <td><?php echo $admission->gud_religion; ?></td>  
                         <th><?php echo lang('national_id'); ?></th>
                        <td><?php echo $admission->gud_national_id; ?></td>                        
                    </tr>
                    <tr>                        
                        <th><?php echo lang('profession'); ?></th>
                        <td colspan="3"><?php echo $admission->gud_profession; ?></td>                                               
                    </tr> 
                </tbody>
            </table>  
        </div>
        <div  class="tab-pane fade in " id="tab_parent_info" >
            <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <tbody>
                    <tr>
                        <th><?php echo lang('father_name'); ?></th>
                        <td><?php echo $admission->father_name; ?></td>                       
                        <th><?php echo lang('mother_name'); ?></th>
                        <td><?php echo $admission->mother_name; ?></td>                       
                    </tr>
                    <tr>
                        <th><?php echo lang('father_phone'); ?></th>
                        <td><?php echo $admission->father_phone; ?></td>                       
                        <th><?php echo lang('mother_phone'); ?></th>
                        <td><?php echo $admission->mother_phone; ?></td>                       
                    </tr>
                    <tr>
                        <th><?php echo lang('father_education'); ?></th>
                        <td><?php echo $admission->father_education; ?></td>                       
                        <th><?php echo lang('mother_education'); ?></th>
                        <td><?php echo $admission->mother_education; ?></td>                       
                    </tr>                    
                    <tr>
                        <th><?php echo lang('father_profession'); ?></th>
                        <td><?php echo $admission->father_profession; ?></td>                       
                        <th><?php echo lang('mother_profession'); ?></th>
                        <td><?php echo $admission->mother_profession; ?></td>                       
                    </tr>
                    <tr>
                        <th><?php echo lang('father_designation'); ?></th>
                        <td><?php echo $admission->father_designation; ?></td>                       
                        <th><?php echo lang('mother_designation'); ?></th>
                        <td><?php echo $admission->mother_designation; ?></td>                       
                    </tr>                    
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


