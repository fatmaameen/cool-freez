        <!--=================================
 header start-->
        <nav class="admin-header navbar navbar-default col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <!-- logo -->



<style>
    .navbar-brand-wrapper .navbar-brand img {
        width: 110px; /* تغيير حجم الصورة إلى الحجم المطلوب */
        height: auto; /* تحديد ارتفاع الصورة بتلقائية للحفاظ على نسبة العرض إلى الارتفاع */
    }
</style>

<div class="text-left navbar-brand-wrapper">
    <a class="navbar-brand brand-logo" href=""><img src={{ asset('assets/images/logo.png') }} alt=""></a>
</div>

            <!-- Top bar left -->
            <ul class="nav navbar-nav mr-auto">
                <li class="nav-item">
                    <a id="button-toggle" class="button-toggle-nav inline-block ml-20 pull-left"
                        href="javascript:void(0);"><i class="zmdi zmdi-menu ti-align-right"></i></a>
                </li>

            </ul>

            <!-- top bar right -->
            <ul class="nav navbar-nav ml-auto">
                <style>
                    /* أنماط القائمة المنسدلة */
             .language-selector {
                 position: relative;
                 display: inline-block;
             }

             /* تكبير حجم الزر */
             .dropdown-button {
                 background-color: #ADD8E6; /* لون الخلفية */
                 color: #110202; /* لون النص */
                 padding: 12px 24px; /* تكبير padding للزر */
                 border: none;
                 cursor: pointer;
                 border-radius: 4px;
                 font-size: 1.2rem; /* تكبير حجم الخط */
             }

             .dropdown-menu {
                 display: none; /* إخفاء القائمة افتراضيًا */
                 position: absolute;
                 top: 100%; /* وضع القائمة أسفل الزر */
                 left: 0;
                 min-width: 180px; /* زيادة عرض القائمة */
                 border: 1px solid #a19e9e; /* حدود القائمة */
                 background-color: 89cff0;
                 border-radius: 4px;
                 z-index: 1000;
             }

             /* تكبير حجم الاختيارات */
             .dropdown-menu li {
                 list-style: none; /* إزالة النقاط من القائمة */
             }

             .dropdown-menu a {
                 display: block; /* لجعل الروابط تظهر بشكل مناسب */
                 padding: 10px 20px; /* زيادة padding */
                 color: #89cff0; /* لون بيبي بلو */
                 text-decoration: none;
                 font-size: 1.2rem; /* تكبير حجم الخط */
             }

             .dropdown-menu a:hover {
                 background-color: #f0f0f0; /* لون الخلفية عند المرور فوق العنصر */
             }

             /* عرض القائمة عند النقر على الزر */
             .language-selector:hover .dropdown-menu,
             .language-selector:focus-within .dropdown-menu {
                 display: block;
             }


             </style>
                         <!-- top bar right -->
                         <ul class="nav navbar-nav ml-auto">
                             <div class="language-selector">
                                 <button class="dropdown-button"> {{ trans('main_trans.language') }}</button>
                                 <ul class="dropdown-menu">
                                     @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
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
                <li class="nav-item dropdown ">
                    <a class="nav-link top-nav" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="ti-bell"></i>
                        <span class="badge badge-danger notification-status"> </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-big dropdown-notifications">
                        <div class="dropdown-header notifications">
                            <strong>Notifications</strong>
                            <span class="badge badge-pill badge-warning">05</span>
                        </div>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">New registered user <small
                                class="float-right text-muted time">Just now</small> </a>
                        <a href="#" class="dropdown-item">New invoice received <small
                                class="float-right text-muted time">22 mins</small> </a>
                        <a href="#" class="dropdown-item">Server error report<small
                                class="float-right text-muted time">7 hrs</small> </a>
                        <a href="#" class="dropdown-item">Database report<small class="float-right text-muted time">1
                                days</small> </a>
                        <a href="#" class="dropdown-item">Order confirmation<small class="float-right text-muted time">2
                                days</small> </a>
                    </div>
                </li>

                <li class="nav-item dropdown mr-30">
                    <a class="nav-link nav-pill user-avatar" data-toggle="dropdown" href="#" role="button"
                      aria-haspopup="true" aria-expanded="false">
                      <div class="ul-widget-app__profile-pic">
                        {{-- src="{{ asset('public/users_images/' . $user->image) }}" --}}
                        <img class="rounded-circle"
                        src="{{Auth::user()->image}}"
                        width="60"
                        height="60"
                        >
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

                        <a class="dropdown-item" href="{{ route('company_profile') }}"><i class="text-warning ti-user"></i>{{ trans('main_trans.profile') }}</a>


                        <a id="logout-link" class="dropdown-item" href="{{ route('logout') }}"
    onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
    <i class="text-danger ti-unlock"></i>Logout
    </a>
                    </div>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <script>
            // Get the logout link element
            var logoutLink = document.getElementById('logout-link');

            // Add event listener to update href attribute
            logoutLink.addEventListener('click', function(event) {
                event.preventDefault();
                this.href = '{{ route('login') }}'; // Set the href to the login route
                document.getElementById('logout-form').submit();
            });
        </script>
        <!--=================================
 header End-->
