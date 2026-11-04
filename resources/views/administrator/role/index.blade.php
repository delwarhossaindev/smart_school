<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-unlock-alt"></i><small> {{ __('manage_user_role') }}</small></h3>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>

            <div class="x_content quick-link">
                @include('administrator.quick-link')
            </div>

            <div class="x_content">
                <div data-example-id="togglable-tabs">
                    <ul class="nav nav-tabs bordered">
                        <li class="{{ isset($list) ? 'active' : '' }}"><a href="#tab_role_list" role="tab" data-toggle="tab"><i class="fa fa-list-ol"></i> {{ __('list') }}</a></li>
                        @can('administrator.role.add')
                            <li><a href="#tab_add_role" role="tab" data-toggle="tab"><i class="fa fa-plus-square-o"></i> {{ __('add') }}</a></li>
                        @endcan
                        @isset($edit)
                            <li class="active"><a href="#tab_edit_role" role="tab" data-toggle="tab"><i class="fa fa-pencil-square-o"></i> {{ __('edit') }}</a></li>
                        @endisset
                    </ul>
                    <br/>

                    <div class="tab-content">
                        <div class="tab-pane fade in {{ isset($list) ? 'active' : '' }}" id="tab_role_list">
                            <div class="x_content">
                                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>{{ __('sl_no') }}</th>
                                            <th>{{ __('name') }}</th>
                                            <th>{{ __('note') }}</th>
                                            <th>{{ __('is_default') }}</th>
                                            <th>{{ __('action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($roles as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ ucfirst($item->name) }}</td>
                                                <td>{{ $item->note }}</td>
                                                <td>{{ $item->is_default ? __('yes') : __('no') }}</td>
                                                <td>
                                                    @can('administrator.role.edit')
                                                        <a href="{{ route('roles.edit', $item) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil-square-o"></i> {{ __('edit') }}</a>
                                                    @endcan
                                                    @can('administrator.role.delete')
                                                        @unless ($item->is_default)
                                                            <form action="{{ route('roles.destroy', $item) }}" method="post" style="display: inline;" onsubmit="return confirm('{{ __('confirm_alert') }}');">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> {{ __('delete') }}</button>
                                                            </form>
                                                        @endunless
                                                    @endcan
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="tab-pane fade in" id="tab_add_role">
                            <div class="x_content">
                                <form action="{{ route('roles.store') }}" method="post" name="add" id="add" class="form-horizontal form-label-left">
                                    @csrf
                                    @include('administrator.role.fields', ['name' => old('name'), 'note' => old('note')])
                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-3">
                                            <a href="{{ route('roles.index') }}" class="btn btn-primary">{{ __('cancel') }}</a>
                                            <button type="submit" class="btn btn-success">{{ __('submit') }}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        @isset($edit)
                            <div class="tab-pane fade in active" id="tab_edit_role">
                                <div class="x_content">
                                    <form action="{{ route('roles.update', $role) }}" method="post" name="edit" id="edit" class="form-horizontal form-label-left">
                                        @csrf
                                        @method('PUT')
                                        @include('administrator.role.fields', ['name' => old('name', $role->name), 'note' => old('note', $role->note)])
                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-3">
                                                <a href="{{ route('roles.index') }}" class="btn btn-primary">{{ __('cancel') }}</a>
                                                <button type="submit" class="btn btn-success">{{ __('update') }}</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#datatable-responsive').DataTable({
            dom: 'Bfrtip',
            iDisplayLength: 15,
            buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5', 'pageLength'],
            search: true,
            responsive: true
        });
    });

    $("#add").validate();
    $("#edit").validate();
</script>
