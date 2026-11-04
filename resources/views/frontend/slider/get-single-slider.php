<table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <th><?php echo lang('branch_name'); ?></th>
            <td><?php echo $slider->branch_name; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('title'); ?></th>
            <td><?php echo $slider->title; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('image'); ?></th>
            <td>
                <?php if($slider->image){ ?>
                    <img src="<?php echo UPLOAD_PATH; ?>slider/<?php echo $slider->image; ?>" alt=""  class="img-responsive" /><br/><br/>
                <?php } ?>
            </td>
        </tr>       
        <tr>
            <th><?php echo lang('created'); ?></th>
            <td><?php echo date(ci()->global_setting->date_format, strtotime($slider->created_at)); ?></td>
        </tr>       
    </tbody>
</table>
