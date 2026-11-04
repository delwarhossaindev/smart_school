<table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <th width="16%"><?php echo lang('branch_name'); ?></th>
            <td><?php echo $feedback->branch_name; ?></td>
        </tr>         
        <tr>
            <th><?php echo lang('is_publish'); ?></th>
            <td><?php echo $feedback->is_publish ? lang('yes') : lang('no'); ?></td>
        </tr> 
        <tr>
            <th><?php echo lang('feedback'); ?></th>
            <td><?php echo $feedback->feedback; ?></td>
        </tr> 
        <tr>
            <th><?php echo lang('date'); ?> </th>
            <td><?php echo date(ci()->global_setting->date_format, strtotime($feedback->created_at)); ?></td>
        </tr>
    </tbody>
</table>