<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-unlock-alt"></i><small> {{ __('manage_role_permission') }}</small></h3>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>

            <div class="x_content quick-link">
                @include('administrator.quick-link')
            </div>

            <div class="x_content">
                <ul class="nav nav-tabs bordered">
                    <li class="active"><a href="#tab_permission" role="tab" data-toggle="tab"><i class="fa fa-gear"></i> {{ __('role_permission') }}</a></li>
                    <li class="li-class-list">
                        <select class="form-control col-md-7 col-xs-12" id="filter_role" style="width: auto;">
                            <option value="{{ route('permissions.index') }}">--{{ __('select') }}--</option>
                            @foreach ($roles as $item)
                                <option value="{{ route('permissions.show', $item) }}" @selected($role?->id === $item->id)>{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </li>
                </ul>
                <br/>

                <div class="tab-content">
                    <div class="tab-pane active" id="tab_permission">
                        @if ($role)
                            <div class="x_content">
                                <div class="col-md-12">{{ __('role_permission') }} : {{ $role->name }}</div>
                            </div>
                            <div class="x_content" style="overflow-y: hidden;">
                                <form action="{{ route('permissions.update', $role) }}" method="post" class="form-horizontal form-label-left">
                                    @csrf
                                    @method('PUT')
                                    <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>{{ __('sl_no') }}</th>
                                                <th class="role-text" width="10%">{{ __('module_name') }}</th>
                                                <th class="role-text">{{ __('function_name') }}</th>
                                                @foreach (['view', 'add', 'edit', 'delete'] as $action)
                                                    <th>{{ __($action) }} &nbsp;<input type="checkbox" class="role-check js-check-all" data-action="{{ $action }}" value="1" /></th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($modules as $module)
                                                <tr>
                                                    <td class="role-text" style="background: #ececec; font-weight: bold;">{{ $loop->iteration }}</td>
                                                    <td colspan="6" class="role-text" style="background: #ececec; font-weight: bold;">{{ $module->module_name }} &raquo;</td>
                                                </tr>
                                                @php($moduleNumber = $loop->iteration)
                                                @foreach ($module->operations as $operation)
                                                    <tr>
                                                        <td class="role-text">{{ $moduleNumber }}.{{ $loop->iteration }}</td>
                                                        <td colspan="2" class="role-text" style="padding-left: 120px;">{{ $operation->operation_name }}</td>
                                                        @foreach (['view', 'add', 'edit', 'delete'] as $action)
                                                            <td>
                                                                @if ($operation->{'is_'.$action.'_vissible'})
                                                                    @php($name = \App\Support\PermissionName::for(array_search($action, \App\Support\PermissionName::ACTIONS), $module->module_slug, $operation->operation_slug))
                                                                    <input type="checkbox" class="js-{{ $action }}" name="permissions[]" value="{{ $name }}" @checked($granted->has($name)) />
                                                                @endif
                                                            </td>
                                                        @endforeach
                                                    </tr>
                                                @endforeach
                                            @empty
                                                <tr><td colspan="7" class="not-found">{{ __('no_data_found') }}</td></tr>
                                            @endforelse
                                        </tbody>
                                    </table>

                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-6">
                                            <a href="{{ route('roles.index') }}" class="btn btn-primary">{{ __('cancel') }}</a>
                                            @can('administrator.permission.edit')
                                                <button type="submit" class="btn btn-success">{{ __('update') }} {{ __('role_permission') }}</button>
                                            @endcan
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @else
                            <div class="x_content">
                                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>{{ __('sl_no') }}</th>
                                            <th>{{ __('role') }}/ {{ __('name') }}</th>
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
                                                    @can('administrator.permission.edit')
                                                        <a href="{{ route('permissions.show', $item) }}" class="btn btn-success btn-xs"><i class="fa fa-folder-open-o"></i> {{ __('role_permission') }} {{ __('setting') }}</a>
                                                    @endcan
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
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

        $('.js-check-all').click(function () {
            $('.js-' + $(this).data('action')).prop('checked', $(this).is(':checked'));
        });

        $('#filter_role').change(function () {
            window.location.href = this.value;
        });
    });
</script>
