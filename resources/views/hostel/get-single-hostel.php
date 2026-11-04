<table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <th><?php echo lang('branch_name'); ?></th>
            <td><?php echo $hostel->branch_name; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('hostel'); ?></th>
            <td><?php echo $hostel->name; ?></td>
        </tr>   
        <tr>
            <th><?php echo lang('hostel_type'); ?></th>
            <td><?php echo lang($hostel->type); ?></td>
        </tr>
        <tr>
            <th><?php echo lang('address'); ?></th>
            <td><?php echo $hostel->address; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('note'); ?></th>
            <td><?php echo $hostel->note; ?></td>
        </tr>      
        <tr>
            <th><?php echo lang('created'); ?></th>
            <td><?php echo date(ci()->global_setting->date_format, strtotime($hostel->created_at)); ?></td>
        </tr>       
    </tbody>
</table>