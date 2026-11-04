<div class="x_content quick-link no-print">
    <div class="row">                   
        <div class="col-md-12 col-sm-12 col-xs-12">
            <span style="padding-top: 8px;"><?php echo lang('select'); ?> <?php echo lang('report'); ?>:</span>
            <select  class="form-control" name="report" id="report" onchange="get_report_action(this.value);">
                    <?php 
                    $reports = array(); 
                    $reports[site_url('report/income')] = lang('income_report'); 
                    $reports[site_url('report/expenditure')] = lang('expenditure_report'); 
                    $reports[site_url('report/invoice')] = lang('invoice_report'); 
                    $reports[site_url('report/duefee')] = lang('due_fee_report'); 
                    $reports[site_url('report/feecollection')] = lang('fee_collection_report'); 
                    $reports[site_url('report/balance')] = lang('accounting_balance_report'); 
                    $reports[site_url('report/library')] = lang('library_report'); 
                    $reports[site_url('report/sattendance')] = lang('student_attendance_report'); 
                    $reports[site_url('report/syattendance')] = lang('student_yearly_attendance_report'); 
                    $reports[site_url('report/tattendance')] = lang('teacher_attendance_report');  
                    $reports[site_url('report/tyattendance')] = lang('teacher_yearly_attendance_report'); 
                    $reports[site_url('report/eattendance')] = lang('employee_attendance_report'); 
                    $reports[site_url('report/eyattendance')] = lang('employee_yearly_attendance_report'); 
                    $reports[site_url('report/student')] = lang('student_report'); 
                    $reports[site_url('report/sinvoice')] = lang('student_invoice_report'); 
                    $reports[site_url('report/sactivity')] = lang('student_activity_report'); 
                    $reports[site_url('report/payroll')] = lang('payroll_report'); 
                    $reports[site_url('report/transaction')] = lang('daily_transaction_report'); 
                    $reports[site_url('report/statement')] = lang('daily_statement_report'); 
                    $reports[site_url('report/examresult')] = lang('exam_result_report'); 
                    ?>
                    <option value="">--<?php echo lang('select'); ?>--</option>
                    <?php foreach($reports as $key=>$value){ ?>
                    <option value="<?php echo $key; ?>" <?php if(isset($report_url) && $report_url == $key){ echo 'selected="selected"';} ?>><?php echo $value; ?></option>
                    <?php } ?>
                </select>
        </div>
    </div>             
</div>

<script src="<?php echo VENDOR_URL; ?>chart/js/highcharts.js"></script>
<script src="<?php echo VENDOR_URL; ?>chart/js/highcharts-3d.js"></script>
<script src="<?php echo VENDOR_URL; ?>chart/js/modules/exporting.js"></script>

<script type="text/javascript">
    function get_report_action(url){          
       if(url){
           window.location.href = url; 
       }
    }
    
    function get_date_range(order_by){
       if(order_by == 'daily'){
           $('.fn_date_range').show();
       }else{
           $('.fn_date_range').hide();
       }    
    }
    
</script>

 