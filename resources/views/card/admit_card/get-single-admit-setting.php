<table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <th width="30%"><?php echo lang('branch_name'); ?></th>
            <td colspan="3"><?php echo $setting->branch_name; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('border_color'); ?></th>
            <td><span style="padding: 4px 10px; background-color:<?php echo $setting->border_color; ?>"></span></td>        
            <th><?php echo lang('top_background'); ?> </th>
            <td><span style="padding: 4px 10px; background-color:<?php echo $setting->top_bg; ?>"></span></td>
        </tr>
         
        <tr>
            <th><?php echo lang('branch_name'); ?></th>
            <td><?php echo $setting->branch_name; ?></td>        
            <th><?php echo lang('card_logo'); ?></th>
            <td>
                <?php if($setting->branch_logo){ ?>
                <img src="<?php echo UPLOAD_PATH; ?>logo/<?php echo $setting->branch_logo; ?>" alt=""  width="80" /><br/><br/>
                <?php } ?>
            </td>
        </tr> 
        
        <tr>
            <th><?php echo lang('branch_name_font_size'); ?></th>
            <td><?php echo $setting->branch_name_font_size; ?></td>        
            <th><?php echo lang('branch_name_color'); ?></th>
            <td><span style="padding: 4px 10px; background-color:<?php echo $setting->branch_name_color; ?>"></span></td>
        </tr> 
        
        <tr>
            <th><?php echo lang('branch_address'); ?></th>
            <td><?php echo $setting->branch_address; ?></td>
            <th><?php echo lang('branch_address_color'); ?></th>
            <td><span style="padding: 4px 10px; background-color:<?php echo $setting->branch_address_color; ?>"></span></td>
        </tr>
        
        <tr>
            <th><?php echo lang('admit_title_font_size'); ?></th>
            <td><?php echo $setting->admit_font_size; ?></td>
            <th><?php echo lang('admit_title_color'); ?></th>
            <td><span style="padding: 4px 10px; background-color:<?php echo $setting->admit_color; ?>"></span></td>
        </tr> 
        <tr>
            <th><?php echo lang('admit_title_background'); ?></th>
            <td colspan="3"><span style="padding: 4px 10px; background-color:<?php echo $setting->admit_bg; ?>"></span></td>
        </tr> 
        
        <tr>
            <th><?php echo lang('title_font_size'); ?></th>
            <td><?php echo $setting->title_font_size; ?></td>
            <th><?php echo lang('title_color'); ?></th>
            <td><span style="padding: 4px 10px; background-color:<?php echo $setting->title_color; ?>"></span></td>
        </tr> 
        
        <tr>
            <th><?php echo lang('value_font_size'); ?></th>
            <td><?php echo $setting->value_font_size; ?></td>
            <th><?php echo lang('value_color'); ?></th>
            <td><span style="padding: 4px 10px; background-color:<?php echo $setting->value_color; ?>"></span></td>
        </tr> 
        
        <tr>                   
            <th><?php echo lang('bottom_signature'); ?></th>
            <td><?php echo $setting->bottom_text; ?></td>
            <th><?php echo lang('signature_background'); ?> </th>
            <td><span style="padding: 4px 10px; background-color:<?php echo $setting->bottom_bg; ?>"></span></td>        
        </tr> 
        <tr >
            <th><?php echo lang('signature_color'); ?></th>
            <td><span style="padding: 4px 10px; background-color:<?php echo $setting->bottom_text_color; ?>"></span></td> 
            <th><?php echo lang('signature_align'); ?></th>
            <td><?php echo $setting->bottom_text_align; ?></td>
        </tr> 
        
    </tbody>
</table>
