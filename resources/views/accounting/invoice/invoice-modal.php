<div class="modal fade bs-invoice-modal-lg no-print" tabindex="-1" role="dialog" aria-hidden="true" style="z-index: 999999;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header  no-print">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title"><?php echo lang('detail_information'); ?></h4>
        </div>
        <div class="modal-body fn_invoice_data"></div>       
      </div>
    </div>
</div>
<script type="text/javascript">
         
    function get_invoice_modal(invoice_id){
         
        $('.fn_news_data').html('<p style="padding: 20px;"><p style="padding: 20px;text-align:center;"><img src="<?php echo IMG_URL; ?>loading.gif" /></p>');
        $.ajax({       
          type   : "POST",
          url    : "<?php echo site_url('accounting/invoice/get_single_invoice'); ?>",
          data   : {invoice_id:invoice_id},  
          success: function(response){                                                   
             if(response)
             {
                $('.fn_invoice_data').html(response);
             }
          }
       });
    }
</script>
