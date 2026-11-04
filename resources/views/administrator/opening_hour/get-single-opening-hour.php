<table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <th width="30%"><?php echo lang('branch_name'); ?></th>
            <td><?php echo $opening_hour->branch_name; ?></td>
        </tr>
                 
        <tr>
            <th><?php echo lang('monday'); ?></th>
            <td><?php echo $opening_hour->monday; ?></td>
        </tr> 
        <tr>
            <th><?php echo lang('tuesday'); ?></th>
            <td><?php echo $opening_hour->tuesday; ?></td>
        </tr> 
        <tr>
            <th><?php echo lang('wednesday'); ?></th>
            <td><?php echo $opening_hour->wednesday; ?></td>
        </tr> 
        <tr>
            <th><?php echo lang('thursday'); ?></th>
            <td><?php echo $opening_hour->thursday; ?></td>
        </tr> 
        <tr>
            <th><?php echo lang('friday'); ?></th>
            <td><?php echo $opening_hour->friday; ?></td>
        </tr>                     
        
        <tr>
            <th><?php echo lang('saturday'); ?></th>
            <td><?php echo $opening_hour->saturday; ?></td>
        </tr> 
        
        <tr>
            <th><?php echo lang('sunday'); ?></th>
            <td><?php echo $opening_hour->sunday; ?></td>
        </tr> 
    </tbody>
</table>
