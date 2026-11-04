<table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <th><?php echo lang('branch_name'); ?></th>
            <td><?php echo $schedule->branch_name; ?></td>
        </tr>     
        <tr>
            <th><?php echo lang('exam_term'); ?> </th>
            <td><?php echo $schedule->title; ?></td>
        </tr>     
        <tr>
            <th><?php echo lang('class'); ?></th>
            <td><?php echo $schedule->class_name; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('subject'); ?></th>
            <td><?php echo $schedule->subject; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('exam_date'); ?></th>
            <td><?php echo date(ci()->global_setting->date_format, strtotime($schedule->exam_date)); ?></td>
        </tr>
               
        <tr>
            <th><?php echo lang('start_time'); ?></th>
            <td><?php echo $schedule->start_time; ?>   </td>
        </tr>
        <tr>
            <th><?php echo lang('end_time'); ?></th>
            <td><?php echo $schedule->end_time; ?>   </td>
        </tr>
        <tr>
            <th><?php echo lang('room_no'); ?></th>
            <td><?php echo $schedule->room_no; ?>   </td>
        </tr>
        <tr>
            <th><?php echo lang('note'); ?></th>
            <td><?php echo $schedule->note; ?>   </td>
        </tr>
    </tbody>
</table>