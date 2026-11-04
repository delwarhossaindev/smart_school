<table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <th><?php echo lang('branch_name'); ?></th>
            <td><?php echo $ebook->branch_name; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('name'); ?></th>
            <td><?php echo $ebook->name; ?></td>
        </tr>
             
        <tr>
            <th><?php echo lang('class'); ?></th>
            <td><?php echo $ebook->class_name; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('edition'); ?></th>
            <td><?php echo $ebook->edition; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('author'); ?></th>
            <td><?php echo $ebook->author; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('language'); ?></th>
            <td><?php echo $ebook->language; ?></td>
        </tr>    
        <tr>
            <th><?php echo lang('book_cover'); ?></th>
            <td>
                <?php if($ebook->cover_image){ ?>
                <img src="<?php echo UPLOAD_PATH; ?>ebook/<?php echo $ebook->cover_image; ?>" alt="" width="100" /><br/><br/>
                <?php } ?>
            </td>
        </tr>  
        <tr>
            <th><?php echo lang('e_book'); ?></th>
            <td>
                <?php if($ebook->file_name){ ?>
                <a  target="_blank" href="<?php echo UPLOAD_PATH; ?>ebook/<?php echo $ebook->file_name; ?>" class="btn btn-success btn-xs"> <i class="fa fa-download"></i> <?php echo lang('download'); ?></a> <br/>
                <?php } ?>
            </td>
        </tr>  
        <tr>
            <th><?php echo lang('upload'); ?></th>
            <td><?php echo date(ci()->global_setting->date_format, strtotime($ebook->created_at)); ?></td>
        </tr>       
    </tbody>
</table>