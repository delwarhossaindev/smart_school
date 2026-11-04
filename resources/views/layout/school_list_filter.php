<?php if(ci()->session->userdata('role_id') == SUPER_ADMIN){ ?>
<?php $schools = get_school_list(); ?>
<div class="col-md-3 col-sm-3 col-xs-12">
    <div class="item form-group"> 
        <div><?php echo lang('branch_name'); ?> <span class="required"> *</span></div>
        <select  class="form-control col-md-7 col-xs-12 fn_branch_id" name="branch_id" id="branch_id" required="required">
            <option value="">--<?php echo lang('select_branch'); ?>--</option>
            <?php foreach($schools as $obj){ ?>
                <option value="<?php echo $obj->id; ?>" <?php if(isset($branch_id) && $branch_id == $obj->id){echo 'selected="selected"';} ?>><?php echo $obj->branch_name; ?></option>
            <?php } ?>
        </select>       
    </div>
</div>
<?php }else{ ?>  
<input type="hidden" class="fn_branch_id" name="branch_id" id="branch_id" value="<?php echo ci()->session->userdata('branch_id'); ?>" />
<?php } ?>
