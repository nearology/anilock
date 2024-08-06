@extends("layouts.master")

@section("title", "device add user")

@section("stylesheets")
    <link rel="stylesheet" href="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.css">
    <link rel="stylesheet" href="https://unpkg.com/multiple-select@1.7.0/dist/multiple-select.min.css">
    <link rel="stylesheet" href="/assets/css/multiselect.css">
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
                            "title" => "افزودن کاربر به دستگاه",
                        ])
                    </div>
                    <div class="row" style="margin-bottom: 7rem">
                        <div class="widget has-shadow col-md-7 col-12">
                            <div class="widget-header bordered no-actions d-flex align-items-center">
                                <h4>اطلاعات کاربر</h4>
                            </div>
                            <div class="widget-body">
                                <form class="form-horizontal" action="/deviceUser/new" method="POST">
                                    @csrf
                                    @if($errors->any())
                                        @include("includes.form-errors", ["errors" => $errors])
                                    @endif
                                    <div class="form-group row d-flex align-items-center mb-5">
                                        <label class="col-lg-3 form-control-label">
                                            دستگاه ها
                                        </label>
                                        <div class="col-lg-9">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <select class="custom-select form-control" name="device" multiple data-multi-select>
                                                        @foreach($devices as $device)
                                                            <option value="{{ $device->id }}">{{ $device->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row d-flex align-items-center mb-5">
                                        <label class="col-lg-3 form-control-label">
                                            <i class="la la-calendar"></i>
                                            شروع از تاریخ
                                        </label>
                                        <div class="col-lg-9">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" data-jdp placeholder="انتخاب کنید" name="start_at" value="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row d-flex align-items-center mb-5">
                                        <label class="col-lg-3 form-control-label">
                                            <i class="la la-calendar"></i>
                                            پایان در تاریخ
                                        </label>
                                        <div class="col-lg-9">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" data-jdp placeholder="انتخاب کنید" name="end_at" value="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row d-flex align-items-center mb-5">
                                        <label class="col-lg-3 form-control-label">نام کاربری</label>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control" name="username" required>
                                        </div>
                                    </div>
                                    <div class="form-group row d-flex align-items-center mb-5">
                                        <label class="col-lg-3 form-control-label">رمز عبور</label>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control" name="password" required>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <input type="submit" class="btn btn-primary mr-1 mb-2" value="افزودن">
                                    </div>
                                </form>
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
    {{-- <script src="/assets/vendors/js/datepicker/moment-with-locales.js"></script> --}}
    {{-- <script src="/assets/vendors/js/datepicker/daterangepicker.js"></script> --}}
    <script type="text/javascript" src="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.js"></script>
    <script src="/assets/js/pages/datepicker.js"></script>
    <script src="https://unpkg.com/multiple-select@1.7.0/dist/multiple-select.min.js"></script>
    <script src="/assets/js/pages/multiselect.js"></script>
@endsection
