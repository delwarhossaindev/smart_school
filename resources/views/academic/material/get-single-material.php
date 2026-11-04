<table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <th><?php echo lang('branch_name'); ?></th>
            <td><?php echo $material->branch_name; ?></td>
        </tr>        
        <tr>
            <th><?php echo lang('title'); ?></th>
            <td><?php echo $material->title; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('class'); ?></th>
            <td><?php echo $material->class_name; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('subject'); ?></th>
            <td><?php echo $material->subject; ?></td>
        </tr>
        <?php if($material->material){ ?>
            <tr>
                <th><?php echo lang('material'); ?></th>
                <td>
                    <a target="_blank" href="<?php echo UPLOAD_PATH; ?>material/<?php echo $material->material; ?>" class="btn btn-success btn-xs"> <i class="fa fa-download"></i> <?php echo lang('download'); ?></a> <br/>
                </td>
            </tr>        
        <?php } ?> 
        <tr>
            <th><?php echo lang('description'); ?></th>
            <td><?php echo $material->description; ?>   </td>
        </tr>
        <tr>
            <th><?php echo lang('upload_date'); ?></th>
            <td><?php echo date(ci()->global_setting->date_format, strtotime($material->created_at)); ?></td>
        </tr>
    </tbody>
</table>
