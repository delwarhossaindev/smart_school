<table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <th width="20%"><?php echo lang('branch_name'); ?></th>
            <td width="30%"><?php echo $book->branch_name; ?></td>        
            <th width="20%"><?php echo lang('title'); ?> </th>
            <td width="30%"><?php echo $book->title; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('book_id'); ?></th>
            <td><?php echo $book->custom_id; ?></td>
            <th><?php echo lang('book_cover'); ?></th>
            <td>
                <?php if($book->cover){ ?>
                <img src="<?php echo UPLOAD_PATH; ?>book-cover/<?php echo $book->cover; ?>" alt="" width="70" /><br/><br/>
                <?php } ?>
            </td>       
        </tr>
        <tr>
            <th><?php echo lang('edition'); ?></th>
            <td><?php echo $book->edition; ?></td>       
            <th><?php echo lang('isbn_no'); ?></th>
            <td><?php echo $book->isbn_no; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('author'); ?></th>
            <td><?php echo $book->author; ?></td>        
            <th><?php echo lang('language'); ?></th>
            <td><?php echo $book->language; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('quantity'); ?></th>
            <td><?php echo $book->qty; ?></td>        
            <th><?php echo lang('price'); ?></th>
            <td><?php echo ci()->session->userdata('currency_symbol'); ?><?php echo $book->price; ?></td>
        </tr>        
        <tr>
            <th><?php echo lang('almira_rack'); ?></th>
            <td><?php echo $book->rack_no; ?>   </td>        
            <th><?php echo lang('created'); ?></th>
            <td><?php echo date(ci()->global_setting->date_format, strtotime($book->created_at)); ?></td>
        </tr>       
    </tbody>
</table>