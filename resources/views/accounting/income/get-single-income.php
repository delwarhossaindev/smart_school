<table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <th><?php echo lang('branch_name'); ?></th>
            <td><?php echo $income->branch_name; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('session_year'); ?></th>
            <td><?php echo $income->session_year; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('income_head'); ?></th>
            <td><?php echo $income->head; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('income_method'); ?></th>
            <td><?php echo lang($income->payment_method); ?></td>
        </tr>
        <tr>
            <th><?php echo lang('amount'); ?></th>
            <td><?php echo $income->net_amount; ?></td>
        </tr>
        <?php if($income->payment_method == 'cheque'){ ?>
         <tr>
            <th><?php echo lang('bank_name'); ?></th>
            <td><?php echo $income->bank_name; ?></td>
        </tr> 
        <tr>
            <th><?php echo lang('cheque_number'); ?></th>
            <td><?php echo $income->cheque_no; ?></td>
        </tr> 
        <?php } ?>
        <tr>
            <th><?php echo lang('date'); ?></th>
            <td><?php echo date(ci()->global_setting->date_format, strtotime($income->date)); ?></td>
        </tr> 
       
        <tr>
            <th><?php echo lang('note'); ?></th>
            <td><?php echo $income->note; ?></td>
        </tr> 
    </tbody>
</table>
