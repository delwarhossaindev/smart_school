<table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <th width="30%"><?php echo lang('branch_name'); ?></th>
            <td><?php echo $email_setting->branch_name; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('email_protocol'); ?></th>
            <td><?php echo $email_setting->mail_protocol; ?></td>
        </tr>
         
        <?php if($email_setting->mail_protocol == 'smtp'){ ?>
            <tr>
                <th><?php echo lang('smtp_host'); ?></th>
                <td><?php echo $email_setting->smtp_host; ?></td>
            </tr> 
            <tr>
                <th><?php echo lang('smtp_port'); ?></th>
                <td><?php echo $email_setting->smtp_port; ?></td>
            </tr> 
            <tr>
                <th><?php echo lang('smtp_username'); ?></th>
                <td><?php echo $email_setting->smtp_user; ?></td>
            </tr> 
            <tr>
                <th><?php echo lang('smtp_password'); ?></th>
                <td><?php echo $email_setting->smtp_pass; ?></td>
            </tr> 
            <tr>
                <th><?php echo lang('smtp_security'); ?></th>
                <td><?php echo $email_setting->smtp_crypto; ?></td>
            </tr>                     
        <?php } ?>
        
        <tr>
            <th><?php echo lang('char_set'); ?></th>
            <td><?php echo $email_setting->char_set; ?></td>
        </tr> 
        
        <tr>
            <th><?php echo lang('from_name'); ?></th>
            <td><?php echo $email_setting->from_name; ?></td>
        </tr> 
        <tr>
            <th><?php echo lang('from_email'); ?></th>
            <td><?php echo $email_setting->from_address; ?></td>
        </tr> 
        
    </tbody>
</table>
