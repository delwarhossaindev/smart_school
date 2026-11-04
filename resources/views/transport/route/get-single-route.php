<table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <th><?php echo lang('branch_name'); ?></th>
            <td><?php echo $route->branch_name; ?></td>
        </tr>        
        <tr>
            <th><?php echo lang('route_name'); ?></th>
            <td><?php echo $route->title; ?></td>
        </tr>        
        <tr>
            <th><?php echo lang('route_start'); ?></th>
            <td><?php echo $route->route_start; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('route_end'); ?></th>
            <td><?php echo $route->route_end; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('vehicle_for_route'); ?></th>
            <td><?php echo get_vehicle_by_ids($route->vehicle_ids); ?></td>
        </tr>
        <tr>
            <th><?php echo lang('route_stop_fare'); ?></th>
            <td>
                <table style="width:100%;" class="fn_edit_stop_container responsive"> 
                    <tr>               
                        <th><?php echo lang('stop_name'); ?></th>
                        <th><?php echo lang('stop_km'); ?></th>
                        <th><?php echo lang('stop_fare'); ?></th>
                    </tr>
                    <?php foreach($route_stops as $obj){ ?> 
                        <tr>  
                            <td><?php echo $obj->stop_name; ?></td>
                            <td><?php echo $obj->stop_km; ?></td>
                            <td><?php echo $obj->stop_fare; ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </td>
        </tr>
        <tr>
            <th><?php echo lang('note'); ?></th>
            <td><?php echo $route->note; ?></td>
        </tr>             
    </tbody>
</table>