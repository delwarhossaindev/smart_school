<table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <th><?php echo lang('branch_name'); ?></th>
            <td><?php echo $feetype->branch_name; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('fee_type'); ?> / <?php echo lang('title'); ?></th>
            <td><?php echo $feetype->title; ?></td>
        </tr>
        <?php if($feetype->head_type == 'fee'){ ?>
            <tr style="background-color: lightgray;">
                <th><?php echo lang('class'); ?></th>             
                <th><?php echo lang('amount'); ?></th>             
            </tr>
            <?php foreach($classes as $obj){ ?>
            <?php $fee_amount = get_fee_amount($feetype->id, $obj->id); ?>
                <tr>
                    <th><?php echo $obj->name; ?></th>
                    <td><?php echo @$fee_amount->fee_amount; ?></td>
                </tr>
            <?php } ?>
        <?php } ?>
            
        <tr>
            <th><?php echo lang('note'); ?></th>
            <td><?php echo $feetype->note; ?>   </td>
        </tr>
    </tbody>
</table>
