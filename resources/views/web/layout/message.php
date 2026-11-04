<style type="text/css">
    .remove{ 
        font-weight: bold;
        font-size: 12px;
        cursor: pointer;
        float: right;
    }
    #message_div{ 
        padding: 6px 10px 6px 10px;
        margin-bottom: 10px;
        margin-top: 20px;
        background: #01b5ef;
        font-weight: bold;
        text-align: left;
        border-radius: 5px;
        color: #fff;
    }
</style>

<?php
$message = '';
$alert_class = 'success';
if (ci()->session->userdata('success')):
    $message = ci()->session->userdata('success');
    ci()->session->unset_userdata('success');
    $class = 'success';
elseif (ci()->session->userdata('error')):
    $message = ci()->session->userdata('error');
    ci()->session->unset_userdata('error');
    $class = 'error';
elseif (ci()->session->userdata('warning')):
    $message = ci()->session->userdata('warning');
    ci()->session->unset_userdata('warning');
    $class = 'warning';
elseif (ci()->session->userdata('info')):
    $message = ci()->session->userdata('info');
    ci()->session->unset_userdata('alert_info');
    $class = 'info';
endif;
?>

<?php if ($message):  ?>
<div class="row"> 
    <div class="col-md-12 col-xs-12 col-sm-12">
        <div id="message_div" class="alert alert-<?php echo $class; ?>"> 
                <?php echo $message; ?>  
            <span class="remove">X</span>
        </div>
    </div>
</div>
<?php endif; ?>
<script type="text/javascript">
    $(function () {
        $('#message_div').delay(10000).fadeOut();
        $('.remove').click(function () {
           $('#message_div').hide();
        });
    });
</script>