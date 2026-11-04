<table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <th><?php echo lang('branch_name'); ?></th>
            <td><?php echo $visitor->branch_name; ?></td>
        </tr>        
        <tr>
            <th><?php echo lang('name'); ?></th>
            <td><?php echo $visitor->name; ?></td>
        </tr>              
        <tr>
            <th><?php echo lang('phone'); ?> </th>
            <td><?php echo $visitor->phone; ?></td>
        </tr>    
        <tr>
            <th><?php echo lang('to_meet'); ?> </th>
            <td>
                <?php $user = get_user_by_role($visitor->role_id, $visitor->user_id); echo $user->name; ?>
                [ <?php echo $visitor->role; ?> ]
            </td>
        </tr>
        <tr>
            <th><?php echo lang('visitor_purpose'); ?></th>
            <td><?php echo $visitor->purpose; ?></td>
        </tr>        
        <tr>
            <th><?php echo lang('check_in'); ?></th>
            <td><?php echo date(ci()->global_setting->date_format . '  h:i:s A', strtotime($visitor->check_in)); ?></td>
        </tr>        
        <tr>
            <th><?php echo lang('check_out'); ?></th>
            <td><?php echo $visitor->check_out ? date(ci()->global_setting->date_format .' H:i:s A', strtotime($visitor->check_out)) : '<a style="color:red;" href="javascript:void(0);" onclick="check_out('.$visitor->id.');">'.lang('check_out').'</a>'; ?></td>
        </tr>        
        <tr>
            <th><?php echo lang('note'); ?></th>
            <td><?php echo $visitor->note; ?></td>
        </tr>               
    </tbody>
</table>