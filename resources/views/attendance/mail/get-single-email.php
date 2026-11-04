<table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <th><?php echo lang('branch_name'); ?></th>
            <td><?php echo $email->branch_name; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('session_year'); ?></th>
            <td><?php echo $email->session_year; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('receiver_type'); ?></th>
            <td><?php echo $email->receiver_type; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('receiver'); ?></th>
            <td><?php echo $email->receivers; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('subject'); ?></th>
            <td><?php echo $email->subject; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('email_body'); ?></th>
            <td><?php echo $email->body; ?></td>
        </tr>        
        <tr>
            <th><?php echo lang('absent_date'); ?></th>
            <td><?php echo date(ci()->global_setting->date_format, strtotime($email->absent_date)); ?></td>
        </tr> 
        <tr>
            <th><?php echo lang('send_date'); ?></th>
            <td><?php echo get_nice_time($email->created_at); ?></td>
        </tr> 
    </tbody>
</table>
