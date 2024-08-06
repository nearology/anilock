@extends("layouts.master")

@section("title", "organization add user")

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
                            "title" => "افزودن کاربر به سازمان {$user->organization->title}",
                        ])
                    </div>
                    <div class="row" style="margin-bottom: 7rem">
                        <div class="widget has-shadow col-md-7 col-12">
                            <div class="widget-header bordered no-actions d-flex align-items-center">
                                <h4>اطلاعات کاربر</h4>
                            </div>
                            <div class="widget-body">
                                <form class="form-horizontal" action="/organization/new" method="POST">
                                    @csrf
                                    @if($errors->any())
                                        @include("includes.form-errors", ["errors" => $errors])
                                    @endif
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
                                    <div class="mb-3">
                                        <div class="styled-checkbox">
                                            <input type="checkbox" name="user_access" id="check-1">
                                            <label for="check-1">دسترسی</label>
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
@endsection
