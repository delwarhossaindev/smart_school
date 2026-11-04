<?php if(ci()->session->userdata('role_id') == SUPER_ADMIN){ ?>
<?php $schools = get_school_list(); ?>
<div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="branch_id"><?php echo lang('branch_name'); ?> <span class="required">*</span></label>
    <div class="col-md-6 col-sm-6 col-xs-12">
        <select  class="form-control col-md-7 col-xs-12 fn_branch_id" name="branch_id" id="add_branch_id" required="required">
            <option value="">--<?php echo lang('select_branch'); ?>--</option>
            <?php foreach($schools as $obj){ ?>
                <option value="<?php echo $obj->id; ?>" <?php if(isset($branch_id) && $branch_id == $obj->id){echo 'selected="selected"';} ?>><?php echo $obj->branch_name; ?></option>
            <?php } ?>
        </select>
        <div class="help-block"><?php echo form_error('branch_id'); ?></div>
    </div>
</div>
<?php }else{ ?>
    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="branch_id"></label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input class="fn_branch_id" type="hidden" name="branch_id" id="add_branch_id" value="<?php echo ci()->session->userdata('branch_id'); ?>" />
        </div>
    </div>
<?php } ?>
