@extends("layouts.master")

@section("title", "organization users")

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
                            "title" => "مدیریت کاربران سازمانی {$user->organization->title}",
                        ])
                    </div>
                    <div class="row">
                        <div class="widget has-shadow col-12">
                            <div class="widget-header bordered no-actions d-flex align-items-center">
                                <h2>لیست کاربران سازمانی</h2>
                                <a href="/organization/new">
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
                                                    <th class="sorting" tabindex="0" aria-controls="export-table" rowspan="1" colspan="1" aria-label="نام کاربری: activate to sort column ascending">
                                                        نام کاربری
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="export-table" rowspan="1" colspan="1" aria-label="دسترسی: activate to sort column ascending">
                                                        دسترسی
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="export-table" rowspan="1" colspan="1" aria-label="تنظیمات: activate to sort column ascending">
                                                        تنظیمات
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($user->organization->users as $idx => $item)
                                                    <tr>
                                                        <td>
                                                            <span class="tabledit-span tabledit-identifier">{{ $idx + 1 }}</span>
                                                        </td>
                                                        <td class="tabledit-view-mode">
                                                            <span class="tabledit-span">{{ $item->username }}</span>
                                                        </td>
                                                        <td class="tabledit-view-mode">
                                                            <span class="tabledit-span">
                                                                <i class="la la-{{ $item->user_access ? "check" : "close" }}"></i>
                                                            </span>
                                                        </td>
                                                        <td class="td-actions">
                                                            <a href="/organization/{{ $item->id }}/remove">
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
