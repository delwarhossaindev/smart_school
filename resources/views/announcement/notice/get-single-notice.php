<table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <th width="16%"><?php echo lang('branch_name'); ?></th>
            <td><?php echo $notice->branch_name; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('title'); ?></th>
            <td><?php echo $notice->title; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('date'); ?> </th>
            <td><?php echo date(ci()->global_setting->date_format, strtotime($notice->date)); ?></td>
        </tr>
        <tr>
            <th><?php echo lang('notice_for'); ?></th>
            <td><?php echo $notice->name  ? $notice->name : lang('all'); ?></td>
        </tr>
        <tr>
            <th><?php echo lang('notice'); ?></th>
            <td><?php echo $notice->notice; ?></td>
        </tr>        
        <tr>
            <th><?php echo lang('is_view_on_web'); ?></th>
            <td><?php echo $notice->is_view_on_web ? lang('yes') : lang('no'); ?></td>
        </tr>        
    </tbody>
</table>
