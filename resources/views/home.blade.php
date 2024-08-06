@extends("layouts.master")

@section("title", "home")

@section("stylesheets")
    <link rel="stylesheet" href="assets/css/datatables/datatables.min.css">
    <link rel="stylesheet" href="assets/css/animate/animate.min.css">
    <style>
        .act-title.wait-update {
            color: #17a2b8 !important;
        }
        .act-title.wait-update i {
            display: inline;
        }
        .act-title:not(.wait-update) i {
            display: none;
        }
    </style>
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
                            "title" => "خانه",
                        ])
                    </div>
                    <div class="row">
                        <h4 class="mb-3 ml-3">شما عضو سازمان {{ $user->organization->title }} هستید!</h4>
                    </div>
                    <div class="row flex-row">
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                            <div class="widget-31 widget has-shadow">
                                <div class="widget-body conso">
                                    <div class="row align-items-center">
                                        <div class="col-xl-7">
                                            <div class="conso-title">
                                                <div class="title">دستگاه ها</div>
                                            </div>
                                        </div>
                                        <div class="col-xl-5 d-flex justify-content-center">
                                            <div class="water">
                                                <canvas width="100" height="100"></canvas>
                                                <div class="percent">{{ $device_count }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                            <div class="widget-31 widget has-shadow">
                                <div class="widget-body conso">
                                    <div class="row align-items-center">
                                        <div class="col-xl-7">
                                            <div class="conso-title">
                                                <div class="title">کاربران ها</div>
                                            </div>
                                        </div>
                                        <div class="col-xl-5 d-flex justify-content-center">
                                            <div class="water">
                                                <canvas width="100" height="100"></canvas>
                                                <div class="percent">{{ $users_count }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="widget has-shadow">
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
                </div>
                @include("includes.footer")
                @include("includes.profile-editor")
            </div>
        </div>
    </div>
@endsection

@section("snippets")
    <script src="assets/vendors/js/nicescroll/nicescroll.min.js"></script>
    <script src="assets/vendors/js/datatables/datatables.js"></script>
    <script src="assets/vendors/js/datatables/dataTables.buttons.min.js"></script>
    <script src="assets/vendors/js/datatables/jszip.min.js"></script>
    <script src="assets/vendors/js/datatables/buttons.html5.min.js"></script>
    <script src="assets/vendors/js/datatables/pdfmake.min.js"></script>
    <script src="assets/vendors/js/datatables/vfs_fonts.js"></script>
    <script src="assets/vendors/js/datatables/buttons.print.min.js"></script>
    <script src="assets/js/pages/export-table.js"></script>
    <script src="assets/js/pages/devices.js?8"></script>
    <script src="assets/vendors/js/noty/noty.min.js"></script>
    <script src="assets/js/pages/notifies.js"></script>
@endsection
