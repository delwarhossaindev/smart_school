<footer class="footer no-print">
    <div class="pull-right">
        <p class="white">
             <?php if(isset(ci()->branch_setting->footer) && ci()->branch_setting->footer != ''){ ?>
                <?php echo ci()->branch_setting->footer; ?>
             <?php }else{ ?>
                <?php echo ci()->global_setting->brand_footer ? ci()->global_setting->brand_footer : 'Copyright © '. date('Y').' <a target="_blank" href="https://codecanyon.net/user/codetroopers">Codetroopers Team.</a> All rights reserved.'; ?> 
             <?php } ?>
        </p>       
    </div>
    <div class="clearfix"></div>
</footer>