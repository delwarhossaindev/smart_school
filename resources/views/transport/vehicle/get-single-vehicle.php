<table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <th><?php echo lang('branch_name'); ?></th>
            <td><?php echo $vehicle->branch_name; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('vehicle_number'); ?></th>
            <td><?php echo $vehicle->number; ?></td>
        </tr>
        
        <tr>
            <th><?php echo lang('vehicle_model'); ?></th>
            <td><?php echo $vehicle->model; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('driver'); ?></th>
            <td><?php echo $vehicle->driver; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('vehicle_license'); ?></th>
            <td><?php echo $vehicle->license; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('vehicle_contact'); ?></th>
            <td><?php echo $vehicle->contact; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('note'); ?></th>
            <td><?php echo $vehicle->note; ?></td>
        </tr>       
        
        <tr>
            <th><?php echo lang('created'); ?></th>
            <td><?php echo date(ci()->global_setting->date_format, strtotime($vehicle->created_at)); ?></td>
        </tr>       
    </tbody>
</table>