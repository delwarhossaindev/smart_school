<table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <th><?php echo lang('branch_name'); ?></th>
            <td><?php echo $expenditure->branch_name; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('session_year'); ?></th>
            <td><?php echo $expenditure->session_year; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('expenditure_head'); ?></th>
            <td><?php echo $expenditure->head; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('expenditure_method'); ?></th>
            <td><?php echo lang($expenditure->expenditure_via); ?></td>
        </tr>
        <tr>
            <th><?php echo lang('reference'); ?></th>
            <td><?php echo $expenditure->reference; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('amount'); ?></th>
            <td><?php echo $expenditure->amount; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('date'); ?></th>
            <td><?php echo date(ci()->global_setting->date_format, strtotime($expenditure->date)); ?></td>
        </tr> 
        <tr>
            <th><?php echo lang('note'); ?></th>
            <td><?php echo $expenditure->note; ?></td>
        </tr> 
    </tbody>
</table>
