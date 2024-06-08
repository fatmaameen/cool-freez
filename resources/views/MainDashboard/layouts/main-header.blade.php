<!--=================================
header start-->
<nav class="admin-header navbar navbar-default col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <!-- logo -->
    <style>
        .navbar-brand-wrapper .navbar-brand img {
            width: 110px;
            height: auto;
        }
    </style>
    <div class="text-left navbar-brand-wrapper">
        <a class="navbar-brand brand-logo" href="">
            <img src="{{ asset('assets/images/logo.png') }}" alt="">
        </a>
    </div>

    <!-- Top bar left -->
    <ul class="nav navbar-nav mr-auto">
        <li class="nav-item">
            <a id="button-toggle" class="button-toggle-nav inline-block ml-20 pull-left" href="javascript:void(0);">
                <i class="zmdi zmdi-menu ti-align-right"></i>
            </a>
        </li>
    </ul>

    <style>
        /* أنماط القائمة المنسدلة */
        .language-selector {
            position: relative;
            display: inline-block;
        }

        /* تكبير حجم الزر */
        .dropdown-button {
            color: #110202;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            font-size: 1.2rem;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            min-width: 180px;
            border: 1px solid #a19e9e;
            background-color: #94deec;
            border-radius: 4px;
            z-index: 1000;
        }

        /* تكبير حجم الاختيارات */
        .dropdown-menu li {
            list-style: none;
        }

        .dropdown-menu a {
            display: block;
            padding: 10px 20px;
            color: #110202;
            text-decoration: none;
            font-size: 1.2rem;
        }

        .dropdown-menu a:hover {
            background-color: #f0f0f0;
        }

        .language-selector:hover .dropdown-menu,
        .language-selector:focus-within .dropdown-menu {
            display: block;
        }
    </style>

    <!-- top bar right -->
    <ul class="nav navbar-nav ml-auto">
        <div class="language-selector">
            <button class="dropdown-button">
                @if (app()->getLocale() == 'en')
                    <img src="{{ asset('assets/images/en-flag.png') }}" width="32px" alt="">&nbsp;
                    <i class="fa-solid fa-caret-down"></i>
                @else
                    <img src="{{ asset('assets/images/ar-flag.png') }}" width="32px" alt="">&nbsp;
                    <i class="fa-solid fa-caret-down"></i>
                @endif
            </button>
            <ul class="dropdown-menu">
                @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <li>
                        <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                            {{ $properties['native'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <li class="nav-item fullscreen">
            <a id="btnFullscreen" href="#" class="nav-link"><i class="ti-fullscreen"></i></a>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link top-nav" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="ti-bell"></i>
                @if (auth()->user()->unreadNotifications->count() > 0)
                    <span class="badge badge-danger notification-status"> </span>
                @endif
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-big dropdown-notifications pb-0">
                <div class="dropdown-header notifications">
                    <strong class="notification-title">{{ trans('main_trans.Notifications') }}</strong>
                    <span class="badge badge-pill badge-danger notification-count">{{ auth()->user()->unreadNotifications->count() }}</span>
                </div>
                <div class="dropdown-divider"></div>
                <div class="notification-container">
                    @if (auth()->user()->unreadNotifications->count() > 0)
                    <audio autoplay>
                        <source src="{{ asset('assets/notify.wav') }}" type="audio/mpeg">
                    </audio>
                        @foreach (auth()->user()->unreadNotifications as $notification)
                            @if (isset($notification->data['image']))
                                <div class="dropdown-item" style="display: flex; align-items: center;">
                                    <img src="{{ $notification->data['image'] }}" width="30px" alt="">
                                    <a href="{{ $notification->data['url'] }}">
                                        {{ $notification->data['message'] }}
                                    </a>
                                </div>
                            @else
                                <a class="dropdown-item" href="{{ $notification->data['url'] }}">
                                    {{ $notification->data['message'] }}
                                </a>
                            @endif
                        @endforeach
                    </div>
                    <div class="text-center bg-secondary">
                        <a href="{{ route('markAsRead', auth()->user()->id) }}" class="dropdown-item">
                            {{ trans('main_trans.mark_as') }}
                        </a>
                    </div>
                    @else
                        <div class="text-center">
                            <p>{{ trans('main_trans.no_notification') }}</p>
                        </div>
                    @endif
                </div>
            </li>

            <li class="nav-item dropdown mr-30">
                <a class="nav-link nav-pill user-avatar" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <div class="ul-widget-app__profile-pic">
                        <img class="rounded-circle" src="{{ Auth::user()->image }}" width="60" height="60">
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-header">
                        <div class="media">
                            <div class="media-body">
                                <h5 class="mt-0 mb-0">{{ Auth::user()->name }}</h5>
                                <span>{{ Auth::user()->email }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('profile') }}">
                        <i class="text-warning ti-user"></i>{{ trans('main_trans.profile') }}
                    </a>
                    <div class="dropdown-divider"></div>
                    <a id="logout-link" class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="text-danger ti-unlock"></i>{{ trans('main_trans.logout') }}
                    </a>
                    </div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>

            </li>
        </ul>
    </nav>

    <script>
        var logoutLink = document.getElementById('logout-link');

        // تحديث الكود لحذف التعديل على href
        logoutLink.addEventListener('click', function(event) {
            document.getElementById('logout-form').submit();
        });
    </script>


    <style>
        .notification-container {
            max-height: 300px;
            overflow-y: auto;
        }

        .notification-title {
            font-size: 1.2rem; /* حجم النص لكلمة "الإشعارات" */
        }

        .notification-count {
            font-size: 1.2rem; /* حجم النص للرقم */
        }
        /* أنماط القائمة المنسدلة */
.language-selector {
    position: relative;
    display: inline-block;
}

.dropdown-button {
    color: #110202;
    padding: 5px 10px;
    border: none;
    cursor: pointer;
    border-radius: 4px;
    font-size: 1.2rem;
}

.dropdown-menu {
    display: none;
    position: absolute;
    top: 100%;
    left: 0;
    min-width: 220px; /* زيادة عرض القائمة */
    border: 1px solid #a19e9e;
    background-color: #89cff0;
    border-radius: 4px;
    z-index: 1000;
}

.dropdown-menu li {
    list-style: none;
}

.dropdown-menu a {
    display: block;
    padding: 15px 25px; /* زيادة padding */
    color: #110202;
    text-decoration: none;
    font-size: 1.4rem; /* تكبير حجم الخط */
}

.dropdown-menu a:hover {
    background-color: #f0f0f0;
}

.language-selector:hover .dropdown-menu,
.language-selector:focus-within .dropdown-menu {
    display: block;
}
    </style>
<!--=================================
header End-->
