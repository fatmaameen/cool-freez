<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            <div class="scrollbar side-menu-bg">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">
                    <!-- menu item Dashboard-->
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

                    <li>
                        <a href="{{ route('dashboard') }}"><i class="ti-home"></i><span class="right-nav-text">{{ trans('main_trans.Dashboard')}}
                            </span></a>
                    </li>

                    @if (Auth::user()->role_id ==1)
                    <li>
                        <a href="{{ route('users.user_list') }}"><i class="ti-user"></i><span class="right-nav-text">{{ trans('main_trans.admins') }}
                            </span></a>
                    </li>

                    @endif
                    <li>
                        <a href="{{ route('clients') }}"><i class="fa fa-users"></i><span class="right-nav-text">{{ trans('main_trans.clients') }}</span></a>
                    </li>

                    <li>
                        <a href="{{ route('maintenance') }}"><i class="fa fa-hammer"></i><span class="right-nav-text">{{ trans('main_trans.maintenance') }}</span></a>
                    </li>



                    <li>
                        <a href="{{ route('brands.brands') }}"><i class="ti-tag"></i><span class="right-nav-text">{{ trans('main_trans.brands') }}
                            </span></a>
                    </li>

                    <li>
                        <a href="{{ route('types.types') }}"><i class="ti-layout"></i><span class="right-nav-text">{{ trans('main_trans.types') }}
                        </span></a>
                    </li>
                    <li>
                        <a href="{{ route('offer.offer') }}"><i class="ti-gift"></i><span class="right-nav-text">{{ trans('main_trans.offers') }}
                        </span></a>
                    </li>
                    <li>
                        <a href="{{ route('consultant.consultant') }}"><i class="ti-user"></i><span class="right-nav-text">{{ trans('main_trans.consultant') }}
                        </span></a>
                    </li>
                    <li>
                        <a href="{{ route('reviews.reviews') }}"><i class="ti-comment-alt"></i><span class="right-nav-text">{{ trans('main_trans.reviews') }}
                        </span></a>
                    </li>
                    {{-- <li>
                        <a href="{{ route('floors.floors') }}"><i class="ti-email"></i><span class="right-nav-text">{{ trans('main_trans.floors') }}
                        </span></a>
                    </li> --}}
                    <li>
                        <a href="{{ route('buildingTypes.buildingTypes') }}"><i class="ti-home"></i><span class="right-nav-text">{{ trans('main_trans.buildingTypes') }}</span></a>
                    </li>


                    <li>
                        <a href="{{ route('pricing.pricing') }}"><i class="ti-tag"></i><span class="right-nav-text">{{ trans('main_trans.pricing') }}
                        </span></a>
                    </li>
                    <li>
                        <a href="{{ route('customer_service.customer_service') }}"><i class="ti-headphone"></i><span class="right-nav-text">{{ trans('main_trans.customer_service') }}
                        </span></a>
                    </li>
                        <li>
                        <a href="{{ route('usingFloors') }}"><i class="ti-layout-accordion-separated"></i><span class="right-nav-text">{{ trans('main_trans.usingFloors') }}
                        </span></a>
                    </li>
                    <li>
                        <a href="{{ route('dataSheet') }}"><i class="ti-book"></i><span class="right-nav-text">{{ trans('main_trans.dataSheet') }}
                        </span></a>
                    </li>
                    <li>
                        <a href="{{ route('loadCalculation') }}"><i class="ti-email"></i><span class="ti-calculator">{{ trans('main_trans.loadCalculation') }}
                        </span></a>
                    </li>

                </ul>
            </div>
        </div>

        <!-- Left Sidebar End-->

        <!--=================================
