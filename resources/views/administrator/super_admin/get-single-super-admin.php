<table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <tbody>     
        <tr>
            <th><?php echo lang('name'); ?></th>
            <td><?php echo $superadmin->name; ?></td>        
            <th><?php echo lang('national_id'); ?></th>
            <td><?php echo $superadmin->national_id; ?></td>
        </tr>
        <tr>
           <th><?php echo lang('role'); ?></th>
            <td><?php echo $superadmin->role; ?></td>     
            <th><?php echo lang('phone'); ?></th>
            <td><?php echo $superadmin->phone; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('present_address'); ?></th>
            <td><?php echo $superadmin->present_address; ?></td>        
            <th><?php echo lang('permanent_address'); ?></th>
            <td><?php echo $superadmin->permanent_address; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('gender'); ?></th>
            <td><?php echo lang($superadmin->gender); ?></td>       
            <th><?php echo lang('blood_group'); ?></th>
            <td><?php echo lang($superadmin->blood_group); ?></td>
        </tr>
        <tr>
            <th><?php echo lang('religion'); ?></th>
            <td><?php echo $superadmin->religion; ?></td>       
            <th><?php echo lang('birth_date'); ?></th>
            <td><?php echo date(ci()->global_setting->date_format, strtotime($superadmin->dob)); ?></td>
        </tr>
        <tr>
            <th><?php echo lang('email'); ?></th>
            <td><?php echo $superadmin->email; ?></td>        
            <th><?php echo lang('other_info'); ?></th>
            <td><?php echo $superadmin->other_info; ?></td>
        </tr>

        <tr>
            <th><?php echo lang('photo'); ?></th>
            <td>
                
                <?php  if($superadmin->photo != ''){ ?>
                    <img class="detail-img" src="<?php echo UPLOAD_PATH; ?>employee-photo/<?php echo $superadmin->photo; ?>" alt="" width="70" /> 
                 <?php }else{ ?>
                    <img class="detail-img" src="<?php echo IMG_URL; ?>default-user.png" alt="" width="70" /> 
                 <?php } ?>
                   
            </td>
            <th><?php echo lang('resume'); ?></th>
            <td>
                <?php if($superadmin->resume){ ?>
                   <a target="_blank" href="<?php echo UPLOAD_PATH; ?>employee-resume/<?php echo $superadmin->resume; ?>" class="btn btn-success btn-xs"><i class="fa fa-download"></i> <?php echo lang('download'); ?></a>
                <?php } ?>
            </td>
        </tr>                    

    </tbody>
</table>