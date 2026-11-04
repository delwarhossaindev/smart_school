<table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <tbody>        
        <tr>
            <th><?php echo lang('session_year'); ?> </th>
            <td><?php echo $syllabus->session_year; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('title'); ?></th>
            <td><?php echo $syllabus->title; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('class'); ?></th>
            <td><?php echo $syllabus->class_name; ?></td>
        </tr>       
        <?php if($syllabus->syllabus){ ?>
            <tr>
                <th><?php echo lang('syllabus'); ?></th>
                <td>
                    <a target="_blank" href="<?php echo UPLOAD_PATH; ?>syllabus/<?php echo $syllabus->syllabus; ?>" class="btn btn-success btn-xs"> <i class="fa fa-download"></i> <?php echo lang('download'); ?></a> <br/>
                </td>
            </tr>        
        <?php } ?> 
        <tr>
            <th><?php echo lang('note'); ?></th>
            <td><?php echo $syllabus->note; ?>   </td>
        </tr>
    </tbody>
</table>
