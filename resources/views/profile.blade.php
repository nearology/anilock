@extends("layouts.master")

@section("title", "profile")

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
                            "title" => "پروفایل",
                        ])
                    </div>
                    <div class="row" style="margin-bottom: 7rem">
                        <div class="widget has-shadow col-md-7 col-12">
                            <div class="widget-header bordered no-actions d-flex align-items-center">
                                <h4>پروفایل</h4>
                            </div>
                            <div class="widget-body">
                                <form class="form-horizontal" action="/profile" method="POST">
                                    @csrf
                                    @if($errors->any())
                                        @include("includes.form-errors", ["errors" => $errors])
                                    @endif
                                    <div class="form-group row d-flex align-items-center mb-5">
                                        <label class="col-lg-3 form-control-label">نام کاربری</label>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control" name="username" value="{{ $user->username }}" required>
                                        </div>
                                    </div>
                                    <div class="form-group row d-flex align-items-center mb-5">
                                        <label class="col-lg-3 form-control-label">نام سازمان</label>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control" name="organization_name" value="{{ $user->organization->title }}" {{ $user->user_access ? '' : "disabled" }}>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <input type="submit" class="btn btn-primary mr-1 mb-2" value="اعمال">
                                    </div>
                                </form>
                                <hr>
                                <form class="form-horizontal" action="/password" method="POST">
                                    @csrf
                                    <div class="form-group row d-flex align-items-center mb-5">
                                        <label class="col-lg-3 form-control-label">رمز فعلی</label>
                                        <div class="col-lg-9">
                                            <input type="password" class="form-control" name="password" value="" required>
                                        </div>
                                    </div>
                                    <div class="form-group row d-flex align-items-center mb-5">
                                        <label class="col-lg-3 form-control-label">رمز جدید</label>
                                        <div class="col-lg-9">
                                            <input type="password" class="form-control" name="new_password" value="" required>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <input type="submit" class="btn btn-primary mr-1 mb-2" value="تغییر رمز">
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
    <script src="assets/vendors/js/noty/noty.min.js"></script>
    <script src="assets/js/pages/notifies.js"></script>
@endsection
