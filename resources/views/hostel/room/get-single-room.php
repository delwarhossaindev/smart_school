<table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <th><?php echo lang('branch_name'); ?></th>
            <td><?php echo $room->branch_name; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('hostel'); ?></th>
            <td><?php echo $room->hostel_name; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('room_no'); ?> </th>
            <td><?php echo $room->room_no; ?></td>
        </tr>   
        <tr>
            <th><?php echo lang('room_type'); ?></th>
            <td><?php echo lang($room->room_type); ?></td>
        </tr>
        <tr>
            <th><?php echo lang('seat_total'); ?></th>
            <td><?php echo $room->total_seat; ?></td>
        </tr>
                   
        <tr>
            <th><?php echo lang('cost_per_seat'); ?> </th>
            <td><?php echo $room->cost; ?></td>
        </tr>   
        <tr>
            <th><?php echo lang('note'); ?> </th>
            <td><?php echo $room->note; ?></td>
        </tr>   
        <tr>
            <th><?php echo lang('created'); ?></th>
            <td><?php echo date(ci()->global_setting->date_format, strtotime($room->created_at)); ?></td>
        </tr>       
    </tbody>
</table>