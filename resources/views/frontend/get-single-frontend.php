<table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <th><?php echo lang('branch_name'); ?></th>
            <td><?php echo $frontend->branch_name; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('title'); ?></th>
            <td><?php echo $frontend->page_title; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('description'); ?></th>
            <td><?php echo $frontend->page_description; ?></td>
        </tr>
        <?php if($frontend->page_image){ ?>
        <tr>
            <th><?php echo lang('image'); ?></th>
            <td>                
                <img src="<?php echo UPLOAD_PATH; ?>page/<?php echo $frontend->page_image; ?>" alt=""  class="img-responsive" /><br/><br/>
            </td>
        </tr>
         <?php } ?>
        <tr>
            <th><?php echo lang('modified'); ?></th>
            <td><?php echo date(ci()->global_setting->date_format, strtotime($frontend->created_at)); ?></td>
        </tr>        
    </tbody>
</table>
