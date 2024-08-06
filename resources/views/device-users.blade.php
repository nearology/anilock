@extends("layouts.master")

@section("title", "device users")

@section("stylesheets")
    <link rel="stylesheet" href="/assets/css/datatables/datatables.min.css">
@endsection

@section("container")
    @include("includes.preloader")
    <div class="page">
        @include("includes.header")
        <div class="page-content d-flex align-items-stretch">
            @include("includes.sidebar")
            <div class="content-inner">
                <div class="container-fluid">
                    <div class="row">
                        @include("includes.path-header", [
                            "title" => "مدیریت کاربرها",
                        ])
                    </div>
                    <div class="row">
                        <a href="/deviceUser/new">
                            <button type="button" class="btn btn-primary btn-square ml-3 mb-3">افزودن</button>
                        </a>
                    </div>
                    <div class="row" style="overflow-y:auto">
                        <div class="widget has-shadow">
                            <div class="widget-header bordered no-actions d-flex align-items-center">
                                <h2>لیست کاربران</h2>
                            </div>
                            <div class="widget-body">
                                <div class="table-responsive">
                                    <div id="export-table_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                                        <table id="export-table" class="table mb-0 dataTable no-footer export-table" role="grid" aria-describedby="export-table_info">
                                            <thead>
                                                <tr role="row">
                                                    <th class="sorting_asc" tabindex="0" aria-controls="export-table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="شماره: activate to sort column descending">
                                                        شماره
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="export-table" rowspan="1" colspan="1" aria-label="نام کاربری: activate to sort column ascending">
                                                        نام کاربری
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="export-table" rowspan="1" colspan="1" aria-label="رمز عبور: activate to sort column ascending">
                                                        رمز عبور
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="export-table" rowspan="1" colspan="1" aria-label="نام دستگاه: activate to sort column ascending">
                                                        نام دستگاه
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="export-table" rowspan="1" colspan="1" aria-label="شروع از: activate to sort column ascending">
                                                        شروع از
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="export-table" rowspan="1" colspan="1" aria-label="پایان در: activate to sort column ascending" >
                                                        پایان در
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="export-table" rowspan="1" colspan="1" aria-label="وضعیت: activate to sort column ascending">
                                                        <span style="width:100px;">وضعیت</span>
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="export-table" rowspan="1" colspan="1" aria-label="تنظیمات: activate to sort column ascending">
                                                        تنظیمات
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($accounts as $idx => $account)
                                                    <tr>
                                                        <td>
                                                            <span class="tabledit-span tabledit-identifier">{{ $idx + 1 }}</span>
                                                        </td>
                                                        <td class="tabledit-view-mode">
                                                            <span class="tabledit-span">{{ $account->username }}</span>
                                                        </td>
                                                        <td class="tabledit-view-mode">
                                                            <span class="tabledit-span">{{ $account->password }}</span>
                                                        </td>
                                                        <td class="tabledit-view-mode">
                                                            <span class="tabledit-span">{{ $account->device->name }}</span>
                                                        </td>
                                                        <td class="tabledit-view-mode">
                                                            <span class="tabledit-span">{{ $account->start_at ? jdate($account->start_at)->format('Y/m/d H:i:s') : '-' }}</span>
                                                        </td>
                                                        <td class="tabledit-view-mode">
                                                            <span class="tabledit-span">{{ $account->end_at ? jdate($account->end_at)->format('Y/m/d H:i:s') : '-' }}</span>
                                                            <input class="tabledit-input form-control input-sm" type="text" name="country" value="ایران" style="display: none;" disabled="">
                                                        </td>
                                                        <td class="tabledit-view-mode">
                                                            @switch(intval($account->action))
                                                                @case(App\Models\Account::REPORTED)
                                                                    <span class="badge-text badge-text-small success">ثبت شده</span>
                                                                @break
                                                                @case(App\Models\Account::REPORT_NEW)
                                                                <span class="badge-text badge-text-small info">افزوده شده</span>
                                                                @break
                                                                @case(App\Models\Account::REPORT_REMOVED)
                                                                <span class="badge-text badge-text-small success">حذف شده</span>
                                                                @break
                                                            @endswitch
                                                        </td>
                                                        <td class="td-actions">
                                                            @if($account->action != App\Models\Account::REPORT_REMOVED)
                                                                <a href="/device/{{ $account->device->imei }}/user/{{ $account->id }}/remove">
                                                                    <i class="la la-remove delete"></i>
                                                                </a>
                                                            @else
                                                                <span>-</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @include("includes.footer")
                @include("includes.profile-editor")
            </div>
        </div>
    </div>
@endsection

@section("snippets")
    <script src="/assets/vendors/js/nicescroll/nicescroll.min.js"></script>
    <script src="/assets/vendors/js/datatables/datatables.js"></script>
    <script src="/assets/vendors/js/datatables/dataTables.buttons.min.js"></script>
    <script src="/assets/vendors/js/datatables/jszip.min.js"></script>
    <script src="/assets/vendors/js/datatables/buttons.html5.min.js"></script>
    <script src="/assets/vendors/js/datatables/pdfmake.min.js"></script>
    <script src="/assets/vendors/js/datatables/vfs_fonts.js"></script>
    <script src="/assets/vendors/js/datatables/buttons.print.min.js"></script>
    <script src="/assets/js/pages/export-table.js"></script>
    <script src="assets/vendors/js/noty/noty.min.js"></script>
    <script src="assets/js/pages/notifies.js"></script>
@endsection
