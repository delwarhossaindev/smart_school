<table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <th><?php echo lang('branch_name'); ?></th>
            <td><?php echo $assignment->branch_name; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('title'); ?></th>
            <td><?php echo $assignment->title; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('class'); ?></th>
            <td><?php echo $assignment->class_name; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('section'); ?></th>
            <td><?php echo $assignment->section; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('subject'); ?></th>
            <td><?php echo $assignment->subject; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('deadline'); ?></th>
            <td><?php echo date(ci()->global_setting->date_format, strtotime($assignment->deadline)); ?></td>
        </tr>
        <tr>
            <th><?php echo lang('assignment'); ?></th>
            <td>
                <?php if($assignment->assignment){ ?>
                <a target="_blank" href="<?php echo UPLOAD_PATH; ?>assignment/<?php echo $assignment->assignment; ?>"  class="btn btn-success btn-xs"><i class="fa fa-download"></i> <?php echo lang('download'); ?></a> <br/><br/>
                <?php } ?>
            </td>
        </tr>        
        <tr>
            <th><?php echo lang('note'); ?></th>
            <td><?php echo $assignment->note; ?>   </td>
        </tr>
    </tbody>
</table>
