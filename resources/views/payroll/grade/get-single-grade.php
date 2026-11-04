<table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <th width="18%"><?php echo lang('branch_name'); ?></th>
            <td width="32%"><?php echo $grade->branch_name; ?></td>       
            <th width="18%"><?php echo lang('grade_name'); ?></th>
            <td width="32%"><?php echo $grade->grade_name; ?></td>
        </tr>
              
        <tr>
            <th><?php echo lang('basic_salary'); ?> </th>
            <td><?php echo $grade->basic_salary; ?></td>       
            <th><?php echo lang('house_rent'); ?> </th>
            <td><?php echo $grade->house_rent; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('transport_allowance'); ?></th>
            <td><?php echo $grade->transport; ?></td>       
            <th><?php echo lang('medical_allowance'); ?></th>
            <td><?php echo $grade->medical; ?></td>
        </tr>        
        <tr>
            <th><?php echo lang('over_time_hourly_rate'); ?></th>
            <td><?php echo $grade->over_time_hourly_rate; ?></td>        
            <th><?php echo lang('provident_fund'); ?></th>
            <td><?php echo $grade->provident_fund; ?></td>
        </tr>        
        <tr>
            <th><?php echo lang('hourly_rate'); ?></th>
            <td><?php echo $grade->hourly_rate; ?></td>        
            <th><?php echo lang('total_allowance'); ?></th>
            <td><?php echo $grade->total_allowance; ?></td>
        </tr>        
        <tr>
            <th><?php echo lang('total_deduction'); ?></th>
            <td><?php echo $grade->total_deduction; ?></td>        
            <th><?php echo lang('gross_salary'); ?></th>
            <td><?php echo $grade->gross_salary; ?></td>
        </tr>               
        <tr>
            <th><?php echo lang('net_salary'); ?></th>
            <td><?php echo $grade->net_salary; ?></td>        
            <th><?php echo lang('note'); ?></th>
            <td><?php echo $grade->note; ?></td>
        </tr>               
    </tbody>
</table>
