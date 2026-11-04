<table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <th><?php echo lang('branch_name'); ?></th>
            <td><?php echo $receive->branch_name; ?></td> 
        </tr>
        <tr>
            <th><?php echo lang('to_title'); ?></th>
            <td><?php echo $receive->to_title; ?></td> 
        </tr>
        <tr>
            <th><?php echo lang('reference'); ?></th>
            <td><?php echo $receive->reference; ?></td> 
        </tr>
        <tr>
            <th><?php echo lang('address'); ?></th>
            <td><?php echo $receive->address; ?></td> 
        </tr>             
        <tr>
            <th><?php echo lang('from_title'); ?> </th>
            <td><?php echo $receive->from_title; ?></td> 
        </tr>        
        <tr>      
            <th><?php echo lang('receive_date'); ?></th>
            <td><?php echo date(ci()->global_setting->date_format, strtotime($receive->receive_date)); ?></td>
        </tr>          
       
        <tr>              
            <th><?php echo lang('note'); ?></th>
            <td><?php echo $receive->note; ?></td>
        </tr>
        
        <tr>                
            <th><?php echo lang('attachment'); ?></th>
            <td>
                <?php if($receive->attachment){ ?>
                <a href="<?php echo UPLOAD_PATH; ?>postal/<?php echo $receive->attachment; ?>"  target="_blank" class="btn btn-success btn-xs"><i class="fa fa-download"></i> <?php echo lang('download'); ?></a> <br/><br/>
                <?php } ?>
            </td>
        </tr>    
    </tbody>
</table>
