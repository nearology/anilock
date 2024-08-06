@extends("layouts.master")

@section("title", "panel")

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
                            "title" => "پنل",
                        ])
                    </div>
                    <div class="row">
                        <div class="widget has-shadow col-12">
                            <div class="widget-header bordered no-actions d-flex align-items-center">
                                <h2>لیست سازمان ها</h2>
                                <a href="/panel/organization">
                                    <button type="button" class="btn btn-secondary btn-square mr-1 mb-2">افزودن</button>
                                </a>
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
                                                    <th class="sorting" tabindex="0" aria-controls="export-table" rowspan="1" colspan="1" aria-label="نام: activate to sort column ascending">
                                                        نام
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="export-table" rowspan="1" colspan="1" aria-label="کلید: activate to sort column ascending">
                                                        کلید
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="export-table" rowspan="1" colspan="1" aria-label="تنظیمات: activate to sort column ascending">
                                                        تنظیمات
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($organizations as $idx => $organization)
                                                    <tr>
                                                        <td>
                                                            <span class="tabledit-span tabledit-identifier">{{ $idx + 1 }}</span>
                                                        </td>
                                                        <td class="tabledit-view-mode">
                                                            <span class="tabledit-span">{{ $organization->title }}</span>
                                                        </td>
                                                        <td class="tabledit-view-mode">
                                                            <span class="tabledit-span">{{ $organization->keyname }}</span>
                                                        </td>
                                                        <td class="td-actions">
                                                            <a href="/panel/{{ $organization->id }}/removeOrganization">
                                                                <i class="la la-remove delete"></i>
                                                            </a>
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
                    <div class="row">
                        <div class="widget has-shadow col-12">
                            <div class="widget-header bordered no-actions d-flex align-items-center">
                                <h2>لیست کاربران</h2>
                                <a href="/panel/new">
                                    <button type="button" class="btn btn-secondary btn-square mr-1 mb-2">افزودن</button>
                                </a>
                            </div>
                            <div class="widget-body">
                                <div class="table-responsive">
                                    <div id="export-table2_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                                        <table id="export2-table" class="table mb-0 dataTable no-footer export-table" role="grid" aria-describedby="export-table2_info">
                                            <thead>
                                                <tr role="row">
                                                    <th class="sorting_asc" tabindex="0" aria-controls="export-table2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="شماره: activate to sort column descending">
                                                        شماره
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="export-table2" rowspan="1" colspan="1" aria-label="نام کاربری: activate to sort column ascending">
                                                        نام کاربری
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="export-table2" rowspan="1" colspan="1" aria-label="ادمین: activate to sort column ascending">
                                                        ادمین
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="export-table2" rowspan="1" colspan="1" aria-label="دسترسی: activate to sort column ascending">
                                                        دسترسی
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="export-table2" rowspan="1" colspan="1" aria-label="تنظیمات: activate to sort column ascending">
                                                        تنظیمات
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($users as $idx => $item)
                                                    <tr>
                                                        <td>
                                                            <span class="tabledit-span tabledit-identifier">{{ $idx + 1 }}</span>
                                                        </td>
                                                        <td class="tabledit-view-mode">
                                                            <span class="tabledit-span">{{ $item->username }}</span>
                                                        </td>
                                                        <td class="tabledit-view-mode">
                                                            <span class="tabledit-span">
                                                                <i class="la la-{{ $item->admin ? "check" : "close" }}"></i>
                                                            </span>
                                                        </td>
                                                        <td class="tabledit-view-mode">
                                                            <span class="tabledit-span">
                                                                <i class="la la-{{ $item->user_access ? "check" : "close" }}"></i>
                                                            </span>
                                                        </td>
                                                        <td class="td-actions">
                                                            <a href="/panel/{{ $item->id }}/remove">
                                                                <i class="la la-remove delete"></i>
                                                            </a>
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
                    <div class="row">
                        <div class="widget has-shadow col-12 mb-5">
                            <div class="widget-header bordered no-actions d-flex align-items-center">
                                <h2>لیست دستگاه ها</h2>
                                <a href="/device/add">
                                    <button type="button" class="btn btn-secondary btn-square ml-3 mb-3">افزودن</button>
                                </a>
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
                                                    <th class="sorting" tabindex="0" aria-controls="export-table" rowspan="1" colspan="1" aria-label="نام دستگاه: activate to sort column ascending">
                                                        نام دستگاه
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="export-table" rowspan="1" colspan="1" aria-label="مالک: activate to sort column ascending">
                                                        مالک
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="export-table" rowspan="1" colspan="1" aria-label="وضعیت درب: activate to sort column ascending">
                                                        وضعیت درب
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="export-table" rowspan="1" colspan="1" aria-label="وضعیت آلارم: activate to sort column ascending">
                                                        وضعیت آلارم
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
                                                @foreach($user->devices as $idx => $device)
                                                    @include("includes.row-device", [
                                                        "idx" => $idx,
                                                        "device" => $device,
                                                        "show_user" => true,
                                                    ])
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @foreach($user->devices as $device)
                            @include("includes.modal-device", [
                                "device" => $device,
                            ])
                        @endforeach
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
@endsection
