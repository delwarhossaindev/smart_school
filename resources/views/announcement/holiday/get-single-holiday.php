<table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <th width="16%"><?php echo lang('branch_name'); ?></th>
            <td><?php echo $holiday->branch_name; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('title'); ?></th>
            <td><?php echo $holiday->title; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('from_date'); ?> </th>
            <td><?php echo date(ci()->global_setting->date_format, strtotime($holiday->date_from)); ?></td>
        </tr>
        <tr>
            <th><?php echo lang('to_date'); ?> </th>
            <td><?php echo date(ci()->global_setting->date_format, strtotime($holiday->date_to)); ?></td>
        </tr>  
        <tr>
            <th><?php echo lang('note'); ?></th>
            <td><?php echo $holiday->note; ?></td>
        </tr>  
        <tr>
            <th><?php echo lang('is_view_on_web'); ?></th>
            <td><?php echo $holiday->is_view_on_web ? lang('yes') : lang('no'); ?></td>
        </tr> 
    </tbody>
</table>
