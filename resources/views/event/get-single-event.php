<table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <th width="16%"><?php echo lang('branch_name'); ?></th>
            <td><?php echo $event->branch_name; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('title'); ?></th>
            <td><?php echo $event->title; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('event_for'); ?> </th>
            <td><?php echo $event->name ? $event->name : lang('all'); ?></td>
        </tr>       
        <tr>
            <th><?php echo lang('event_place'); ?> </th>
            <td><?php echo $event->event_place; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('from_date'); ?> </th>
            <td><?php echo date(ci()->global_setting->date_format, strtotime($event->event_from)); ?></td>
        </tr>
        <tr>
            <th><?php echo lang('to_date'); ?> </th>
            <td><?php echo date(ci()->global_setting->date_format, strtotime($event->event_to)); ?></td>
        </tr>
        <tr>
            <th><?php echo lang('image'); ?></th>
            <td>
                <?php if($event->image){ ?>
                <img src="<?php echo UPLOAD_PATH; ?>event/<?php echo $event->image; ?>" alt=""  /><br/><br/>
                <?php } ?>
            </td>
        </tr>        
        <tr>
            <th><?php echo lang('note'); ?></th>
            <td><?php echo $event->note; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('is_view_on_web'); ?></th>
            <td><?php echo $event->is_view_on_web ? lang('yes') : lang('no'); ?></td>
        </tr> 
    </tbody>
</table>
