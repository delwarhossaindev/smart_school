<?php if(ci()->session->userdata('role_id') == SUPER_ADMIN){ ?>
<div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="branch_id"></label>
    <div class="col-md-6 col-sm-6 col-xs-12">
        <input class="fn_branch_id" type="hidden" name="branch_id" id="edit_branch_id" value="<?php echo $branch_id; ?>" />
    </div>
</div>
<?php }else{ ?>
    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="branch_id"></label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input class="fn_branch_id" type="hidden" name="branch_id" id="edit_branch_id" value="<?php echo ci()->session->userdata('branch_id'); ?>" />
        </div>
    </div>
<?php } ?>
