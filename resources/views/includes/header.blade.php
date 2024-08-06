<header class="header">
    <nav class="navbar fixed-top">
        <div class="navbar-holder d-flex align-items-center align-middle justify-content-between">
            <div class="navbar-header">
                <a href="db-default.html" class="navbar-brand">
                    <div class="brand-image brand-small">
                        <img src="/assets/img/logo.png" alt="logo" class="logo-small">
                    </div>
                    <div class="brand-image brand-big">
                        <img src="/assets/img/logo.png" alt="logo" class="logo-small">
                        <h4 style="display:contents">AniLock</h4>
                    </div>
                </a>
                <a id="toggle-btn" href="#" class="menu-btn active">
                    <span></span>
                    <span></span>
                    <span></span>
                </a>
            </div>
            <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center pull-right">
                <li class="nav-item">
                    <a class="nav-link">
                        <i class="la"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route("alerts") }}" class="ml-2 mr-2 d-flex align-items-center" style="width:auto">
                        <div class="badge bg-danger mr-2" style="display:inline-block;width:1.2rem;height:1.2rem"></div>
                        <h5 style="display:content" class="mt-1">هشدارها</h5>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route("logs") }}" class="ml-2 mr-2 d-flex align-items-center" style="width:auto">
                        <div class="badge bg-warning mr-2" style="display:inline-block;width:1.2rem;height:1.2rem"></div>
                        <h5 style="display:content" class="mt-1">گزارشات</h5>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</header>
