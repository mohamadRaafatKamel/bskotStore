<nav class="navbar fixed-top navbar-expand-lg navbar-dark scrolling-navbar">
    <div class="container">

        <!-- Brand -->
        <div class="left-nav">
            <a class="navbar-brand" href="{{ route('cart') }}">
                <strong>
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-handbag" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M8 1a2 2 0 0 0-2 2v2h4V3a2 2 0 0 0-2-2zm3 4V3a3 3 0 1 0-6 0v2H3.361a1.5 1.5 0 0 0-1.483 1.277L.85 13.13A2.5 2.5 0 0 0 3.322 16h9.356a2.5 2.5 0 0 0 2.472-2.87l-1.028-6.853A1.5 1.5 0 0 0 12.64 5H11zm-1 1v1.5a.5.5 0 0 0 1 0V6h1.639a.5.5 0 0 1 .494.426l1.028 6.851A1.5 1.5 0 0 1 12.678 15H3.322a1.5 1.5 0 0 1-1.483-1.723l1.028-6.851A.5.5 0 0 1 3.36 6H5v1.5a.5.5 0 0 0 1 0V6h4z"/>
                    </svg>
                </strong>
                @if(isset($_COOKIE['order']))
                <span class="badge badge badge-pill badge-danger float-right mr-2">
                    {{ \App\Models\Orders::culcContItem($_COOKIE['order']) }}
                </span></a>
                @endif
            </a>
            @if(\Illuminate\Support\Facades\App::isLocale('en'))
                <a class="navbar-brand" href="{{ route('lang','ar') }}" >ع</a>
            @endif
            @if(\Illuminate\Support\Facades\App::isLocale('ar'))
                <a class="navbar-brand" href="{{ route('lang','en') }}">EN</a>
            @endif
        </div>

        <!-- Collapse -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Links -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <!-- Left -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('home') }}">{{ __('msg.Menu') }}
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('search') }}">{{ __('msg.search') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('branches') }}">{{ __('msg.Branches') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('check.order') }}">{{ __('msg.Order Status') }}</a>
                </li>

            </ul>

            <!-- Right -->
            <ul class="navbar-nav nav-flex-icons">
                <li class="nav-item">
                    <a href="https://www.snapchat.com/add/baskotii1" class="nav-link" target="_blank">
                        <i class="fab fa-snapchat-ghost"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="https://instagram.com/baskotii" class="nav-link" target="_blank">
                        <i class="fab fa-instagram"></i>
                    </a>
                </li>
{{--                <li class="nav-item">--}}
{{--                    <a href="#" class="nav-link border border-light rounded"--}}
{{--                       target="_blank">--}}
{{--                        <i class="fab fa-github mr-2"></i>MDB GitHub--}}
{{--                    </a>--}}
{{--                </li>--}}
            </ul>

        </div>

    </div>
</nav>
