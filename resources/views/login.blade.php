@extends("layouts.master")

@section("title", "Login")

@section("container")
    @include("includes.preloader")
    <div class="container-fluid no-padding h-100">
        <div class="row flex-row h-100 bg-white">
            <div class="col-xl-3 col-lg-5 col-md-5 col-sm-12 col-12 no-padding">
                <div class="seenbord-bg background-03">
                    <div class="seenboard-overlay overlay-08"></div>
                    <div class="authentication-col-content-2 mx-auto text-center">
                        <h1>ورود به حساب</h1>
                        <span class="description">
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-7 col-md-7 col-sm-12 col-12 my-auto no-padding">
                <div class="authentication-form-2 mx-auto">
                    <div class="tab-content" id="animate-tab-content">
                        <div role="tabpanel" class="tab-pane show active" id="singin" aria-labelledby="singin-tab">
                            <h3>خوش آمدید</h3>
                            <form action="/login" method="POST">
                                @csrf
                                @if($errors->any())
                                    <div class="alert alert-danger alert-dissmissible fade show" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="group material-input">
                                    <input type="text" name="username" required>
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>نام کاربری</label>
                                </div>
                                <div class="group material-input">
                                    <input type="password" name="password" required>
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>رمز عبور</label>
                                </div>
                                <div class="sign-btn text-center">
                                    <input class="btn btn-lg btn-gradient-01" type="submit" value="ورود">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="d-none">
        @include("includes.profile-editor")
    </div>
@endsection

@section("stylesheet")
    <link rel="stylesheet" href="assets/css/animate/animate.min.css">
@endsection

@section("snippets")
    <script src="assets/js/components/tabs/animated-tabs.min.js"></script>
@endsection
