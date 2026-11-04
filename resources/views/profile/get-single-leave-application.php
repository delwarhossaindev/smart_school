<table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <th><?php echo lang('branch'); ?></th>
            <td><?php echo $application->branch_name; ?></td>       
            <th><?php echo lang('session_year'); ?></th>
            <td><?php echo $application->session_year; ?></td>
        </tr>
        
        <tr>
            <th><?php echo lang('applicant_type'); ?></th>
            <td><?php echo $application->role_name; ?></td>       
            <th><?php echo lang('applicant'); ?></th>
            <td>
                <?php
                    $user = get_user_by_role($application->role_id, $application->user_id);
                    echo $user->name;
                    if($application->role_id == STUDENT){
                        echo ' [ '.lang('class').': '.$user->class_name.', '. lang('section').': '.$user->section.', '.lang('roll_no').': '.$user->roll_no .' ]';
                    }
                 ?>
            </td>
        </tr>
        
        <tr>
            <th><?php echo lang('leave_type'); ?></th>
            <td><?php echo $application->type; ?></td>        
            <th><?php echo lang('date'); ?></th>
            <td><?php echo date(ci()->global_setting->date_format, strtotime($application->leave_date)); ?></td>
        </tr>
        
        <tr>
            <th><?php echo lang('leave_from'); ?></th>
            <td><?php echo date(ci()->global_setting->date_format, strtotime($application->leave_from)); ?></td>       
            <th><?php echo lang('leave_to'); ?></th>
            <td><?php echo date(ci()->global_setting->date_format, strtotime($application->leave_to)); ?></td>
        </tr>         
       
        <tr>
            <th><?php echo lang('reason'); ?></th>
            <td><?php echo $application->leave_reason; ?></td>       
            <th><?php echo lang('note'); ?></th>
            <td><?php echo $application->leave_note; ?></td>
        </tr> 
                    
        <tr>
            <th><?php echo lang('total_leave'); ?></th>
            <td><?php echo $application->total_leave; ?> <?php echo lang('day'); ?></td>        
            <th><?php echo lang('apply_leave'); ?></th>
            <td><?php echo $application->leave_day; ?> <?php echo lang('day'); ?></td>
        </tr>  
        
        <tr>
            <th><?php echo lang('leave_used'); ?></th>
            <td>
                <?php 
                   $used = get_total_used_leave(ci()->academic_year_id, $application->role_id, $application->type_id, $application->user_id);
                   echo $used > 0 ? $used : 0;
                ?>
                <?php echo lang('day'); ?>
            </td>        
            <th><?php echo lang('leave_remain'); ?></th>
            <td><?php echo $application->total_leave - $used; ?> <?php echo lang('day'); ?></td>
        </tr>  
        
        <tr>
            <th><?php echo lang('status'); ?></th>
            <td>
                <?php  if($application->leave_status == 0){ ?>
                    <a href="javascript:void(0);" class="btn btn-default red btn-xs"> <?php echo lang('new'); ?> </a>
                <?php  }elseif($application->leave_status == 1){ ?>
                    <a href="javascript:void(0);" class="btn btn-info btn-xs"><?php echo lang('waiting'); ?> </a>  
                <?php  }elseif($application->leave_status == 2){ ?>
                    <a href="javascript:void(0);" class="btn btn-danger btn-xs"><?php echo lang('approved'); ?> </a>  
                <?php  }elseif($application->leave_status == 3){ ?>
                    <a href="javascript:void(0);" class="btn btn-danger btn-xs"><?php echo lang('declined'); ?> </a>  
                <?php  } ?>
            </td>       
            <th><?php echo lang('attachment'); ?></th>
            <td>
                <?php if($application->attachment){ ?>
                <a href="<?php echo UPLOAD_PATH; ?>leave/<?php echo $application->attachment; ?>" target="_blank" class="btn btn-success btn-xs"><i class="fa fa-download"></i> <?php echo lang('download'); ?></a> <br/><br/>
                <?php } ?>
            </td>
        </tr>    
    </tbody>
</table>
