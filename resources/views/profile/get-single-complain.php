<table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <th><?php echo lang('branch'); ?></th>
            <td><?php echo $complain->branch_name; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('academic_year'); ?></th>
            <td><?php echo $complain->session_year; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('complain_type'); ?></th>
            <td><?php echo $complain->type; ?></td>
        </tr>
        
        <tr>
            <th><?php echo lang('description'); ?></th>
            <td><?php echo $complain->description; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('date'); ?></th>
            <td><?php echo date(ci()->global_setting->date_format, strtotime($complain->complain_date)); ?></td>
        </tr>
        <?php if($complain->action_note){ ?>
        <tr>
            <th><?php echo lang('action'); ?></th>
            <td><?php echo $complain->action_note; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('actoin_date'); ?></th>
            <td><?php echo date(ci()->global_setting->date_format, strtotime($complain->action_date)); ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>
