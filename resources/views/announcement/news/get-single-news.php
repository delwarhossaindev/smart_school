<table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <th width="16%"><?php echo lang('branch_name'); ?></th>
            <td><?php echo $news->branch_name; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('title'); ?></th>
            <td><?php echo $news->title; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('date'); ?> </th>
            <td><?php echo date(ci()->global_setting->date_format, strtotime($news->date)); ?></td>
        </tr>
        <tr>
            <th><?php echo lang('image'); ?></th>
            <td>
                <?php if($news->image){ ?>
                <img src="<?php echo UPLOAD_PATH; ?>news/<?php echo $news->image; ?>" alt="" /><br/><br/>
                <?php } ?>
            </td>
        </tr>        
        <tr>
            <th><?php echo lang('news'); ?></th>
            <td><?php echo $news->news; ?></td>
        </tr> 
        <tr>
            <th><?php echo lang('is_view_on_web'); ?></th>
            <td><?php echo $news->is_view_on_web ? lang('yes') : lang('no'); ?></td>
        </tr> 
    </tbody>
</table>
