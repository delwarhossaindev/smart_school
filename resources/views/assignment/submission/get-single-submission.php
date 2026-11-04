<table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <th><?php echo lang('branch_name'); ?></th>
            <td><?php echo $submit->branch_name; ?></td>        
            <th><?php echo lang('title'); ?></th>
            <td><?php echo $submit->title; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('class'); ?></th>
            <td><?php echo $submit->class_name; ?></td>        
            <th><?php echo lang('section'); ?></th>
            <td><?php echo $submit->section; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('subject'); ?></th>
            <td><?php echo $submit->subject; ?></td>
            <th><?php echo lang('submitted_by'); ?></th>
            <td><?php echo $submit->student_name; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('deadline'); ?></th>
            <td><?php echo date(ci()->global_setting->date_format, strtotime($submit->deadline)); ?></td>
            <th><?php echo lang('submitted_at'); ?></th>
            <td><?php echo date(ci()->global_setting->date_format, strtotime($submit->submitted_at)); ?></td>
        </tr>
        <tr>
            <th><?php echo lang('submission'); ?></th>
            <td colspan="3">
                <?php                
                    $submit_type = explode(".", $submit->submission);
                    $extension = strtolower($submit_type[count($submit_type) - 1]);                
                ?>
                <?php if($submit->submission){ ?>                
                    <a target="_blank" href="<?php echo UPLOAD_PATH; ?>assignment-submission/<?php echo $submit->submission; ?>"  class="btn btn-success btn-xs"><i class="fa fa-download"></i> <?php echo lang('download'); ?></a> <br/><br/>
                <?php } ?>
                   
            </td>
        </tr>        
        <tr>
            <th><?php echo lang('note'); ?></th>
            <td colspan="3"><?php echo $submit->note; ?>   </td>
        </tr>
    </tbody>
</table>
