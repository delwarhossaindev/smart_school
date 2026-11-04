<table class="table table-striped table-bordered dt-responsive nowrap no-print" cellspacing="0" width="100%" >
    <tbody>
        <tr>
            <th><?php echo lang('branch_name'); ?></th>
            <td><?php echo $activity->branch_name; ?></td>
        </tr>       
        <tr>
            <th><?php echo lang('session_year'); ?> </th>
            <td><?php echo $activity->session_year; ?></td>
        </tr>       
        <tr>
            <th><?php echo lang('student'); ?></th>
            <td><?php echo $activity->student; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('phone'); ?></th>
            <td><?php echo $activity->phone; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('class'); ?></th>
            <td><?php echo $activity->class_name; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('section'); ?></th>
            <td><?php echo $activity->section; ?></td>
        </tr>
         <tr>
            <th><?php echo lang('activity'); ?> </th>
            <td><?php echo $activity->activity; ?></td>
        </tr>        
        <tr>
            <th><?php echo lang('date'); ?></th>
            <td><?php echo date(ci()->global_setting->date_format, strtotime($activity->activity_date)); ?>   </td>
        </tr>
    </tbody>
</table>
