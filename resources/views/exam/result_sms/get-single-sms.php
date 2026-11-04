<table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <th><?php echo lang('branch_name'); ?></th>
            <td><?php echo $sms->branch_name; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('session_year'); ?></th>
            <td><?php echo $sms->session_year; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('receiver_type'); ?></th>
            <td><?php echo $sms->receiver_type; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('receiver'); ?></th>
            <td><?php echo $sms->receivers; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('gateway'); ?></th>
            <td><?php echo lang($sms->sms_gateway); ?></td>
        </tr>
        <tr>
            <th><?php echo lang('sms'); ?></th>
            <td><?php echo $sms->body; ?></td>
        </tr>       
        <tr>
            <th><?php echo lang('send_date'); ?></th>
            <td><?php echo get_nice_time($sms->created_at); ?></td>
        </tr> 
    </tbody>
</table>
