<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-comments-o"></i><small> <?php echo lang('manage_message'); ?></small></h3>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-md-3">
                            <?php ci()->load->view('message-nav'); ?>   
                        </div>
                        <!-- /.col -->
                        <div class="col-md-9">
                                <div class="box-header">
                                    <h3 class="box-title"><?php echo lang('draft'); ?></h3>              
                                </div>
                            <div class="box box-primary">
                                <!-- /.box-header -->
                                <div class="box-body no-padding">
                                    <div class="mailbox-controls">
                                        <!-- Check all button -->
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                                            </button>
                                            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                                            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                                        </div>
                                        <!-- /.btn-group -->
                                        <div class="pull-right">                 
                                        </div>
                                        <!-- /.pull-right -->
                                    </div>
                                    <div class="x_content">
                                        <table id="datatable-responsive" class="table table-striped  dt-responsive nowrap jambo_table bulk_action" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th><?php echo lang('sl_no'); ?></th>
                                                    <?php if(ci()->session->userdata('role_id') == SUPER_ADMIN){ ?>
                                                        <th><?php echo lang('branch'); ?></th>
                                                    <?php } ?>
                                                    <th><?php echo lang('status'); ?></th>
                                                    <th><?php echo lang('receiver'); ?></th>
                                                    <th><?php echo lang('subject'); ?></th>                                       
                                                    <th><?php echo lang('sent_at'); ?></th>                                                                   
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(isset($drafts) && !empty($drafts)){ ?>
                                                    <?php foreach($drafts as $obj ){ ?>
                                                    <tr>
                                                        <td><input type="checkbox"></td>
                                                        <?php if(ci()->session->userdata('role_id') == SUPER_ADMIN){ ?>
                                                            <td><?php echo $obj->branch_name; ?></td>
                                                        <?php } ?>
                                                        <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
                                                        <td class="mailbox-name">
                                                            <a href="<?php echo site_url('message/compose/'.$obj->message_id); ?>"><?php $user = get_user_by_id($obj->receiver_id); echo $user->name; ?></a>
                                                        </td>
                                                        <td class="mailbox-subject">
                                                            <b><a href="<?php echo site_url('message/compose/'.$obj->message_id); ?>"><?php echo $obj->subject; ?></a></b> 
                                                        </td>
                                                        <td class="mailbox-date"><?php echo get_nice_time($obj->created_at); ?></td>
                                                    </tr>
                                                    <?php } ?>
                                                <?php } ?>  
                                            </tbody>
                                        </table>
                                        <!-- /.table -->
                                    </div>
                                </div>
                            </div>
                            <!-- /. box -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </section>
                <!-- /.content -->
            </div>
        </div>
    </div>
</div>

<!-- datatable with buttons -->
 <script type="text/javascript">
        $(document).ready(function() {
          $('#datatable-responsive').DataTable( {
              dom: 'Bfrtip',
              iDisplayLength: 15,
              buttons: [
                  'copyHtml5',
                  'excelHtml5',
                  'csvHtml5',
                  'pdfHtml5',
                  'pageLength'
              ],
              search: true,              
              responsive: true
          });
        });
</script> 