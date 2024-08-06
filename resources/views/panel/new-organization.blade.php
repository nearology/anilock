@extends("layouts.master")

@section("title", "add organization")

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
                            "title" => "افزودن سازمان",
                        ])
                    </div>
                    <div class="row" style="margin-bottom: 7rem">
                        <div class="widget has-shadow col-md-7 col-12">
                            <div class="widget-header bordered no-actions d-flex align-items-center">
                                <h4>اطلاعات کاربر</h4>
                            </div>
                            <div class="widget-body">
                                <form class="form-horizontal" action="/panel/organization" method="POST">
                                    @csrf
                                    @if($errors->any())
                                        @include("includes.form-errors", ["errors" => $errors])
                                    @endif
                                    <div class="form-group row d-flex align-items-center mb-5">
                                        <label class="col-lg-3 form-control-label">نام سازمان</label>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control" name="title" required>
                                        </div>
                                    </div>
                                    <div class="form-group row d-flex align-items-center mb-5">
                                        <label class="col-lg-3 form-control-label">کلید سازمان</label>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control" name="keyname" required>
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
