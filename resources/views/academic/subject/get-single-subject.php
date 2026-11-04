<table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <th><?php echo lang('branch'); ?></th>
            <td><?php echo $subject->branch_name; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('subject'); ?> / <?php echo lang('name'); ?></th>
            <td><?php echo $subject->name; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('subject_code'); ?></th>
            <td><?php echo $subject->code; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('author'); ?></th>
            <td><?php echo $subject->author; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('type'); ?></th>
            <td><?php echo lang($subject->type); ?></td>
        </tr>
        <tr>
            <th><?php echo lang('class'); ?></th>
            <td><?php echo $subject->class_name; ?>   </td>
        </tr>
        <tr>
            <th><?php echo lang('teacher'); ?></th>
            <td><?php echo $subject->teacher; ?>   </td>
        </tr>        
        <tr>
            <th><?php echo lang('note'); ?></th>
            <td><?php echo $subject->note; ?>   </td>
        </tr>
    </tbody>
</table>
