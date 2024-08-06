<div class="default-sidebar">
    <nav class="side-navbar box-scroll sidebar-scroll">
        <ul class="list-unstyled">
            <li>
                <a href="{{ route("home") }}">
                    <i class="ti ti-home"></i>
                    <span>خانه</span>
                </a>
            </li>
            <li>
                <a href="{{ route("profile") }}">
                    <i class="la la-cog"></i>
                    <span>پروفایل</span>
                </a>
            </li>
            <li>
                <a href="{{ route("devices") }}">
                    <i class="la la-mobile-phone"></i>
                    <span>مدیریت دستگاه ها</span>
                </a>
            </li>
            <li>
                <a href="{{ route("deviceUsers") }}">
                    <i class="la la-user"></i>
                    <span>مدیریت کاربرها</span>
                </a>
            </li>
            <li>
                <a href="{{ route("logs") }}">
                    <i class="la la-newspaper-o"></i>
                    <span>آخرین تغییرات</span>
                </a>
            </li>
            <li>
                <a href="{{ route("alerts") }}">
                    <i class="la la-clock-o"></i>
                    <span>هشدار ها و اعلان ها</span>
                </a>
            </li>
            @if($user->user_access)
                <li>
                    <a href="{{ route("organization") }}">
                        <i class="la la-bank"></i>
                        <span>مدیریت کاربران سازمانی</span>
                    </a>
                </li>
            @endif
            <li>
                <a href="#">
                    <i class="la la-database"></i>
                    <span>مدیریت داده ها</span>
                </a>
            </li>
            @if($user->admin)
                <li>
                    <a href="{{ route("panel") }}">
                        <i class="la la-cog"></i>
                        <span>مدیریت</span>
                    </a>
                </li>
            @endif
            <li>
                <a href="{{ route("about") }}">
                    <i class="la la-info-circle"></i>
                    <span>درباره ما</span>
                </a>
            </li>
            <li>
                <a href="{{ route("signout") }}">
                    <i class="la la-sign-out"></i>
                    <span>خروج</span>
                </a>
            </li>
        </ul>
    </nav>
</div>
