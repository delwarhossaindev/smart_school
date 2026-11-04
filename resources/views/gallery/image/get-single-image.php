<table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <th width="16%"><?php echo lang('branch_name'); ?></th>
            <td><?php echo $image->branch_name; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('gallery'); ?></th>
            <td><?php echo $image->title; ?></td>
        </tr>       
        <tr>
            <th><?php echo lang('caption'); ?></th>
            <td><?php echo $image->caption; ?></td>
        </tr>       
        <tr>
            <th><?php echo lang('image'); ?></th>
            <td>
                <?php if($image->image){ ?>
                <img src="<?php echo UPLOAD_PATH; ?>gallery/<?php echo $image->image; ?>" alt="" style="width: 100%;"/><br/><br/>
                <?php } ?>
            </td>
        </tr>         
    </tbody>
</table>
