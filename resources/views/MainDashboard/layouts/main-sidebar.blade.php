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

                    {{-- <li>
                        <a href="{{ route('maintenance') }}"><i class="fa fa-hammer"></i><span class="right-nav-text">{{ trans('main_trans.maintenance') }}</span></a>
                    </li> --}}

                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#calendar-menu">
                            <div class="pull-left"><i class="fa fa-gear"></i><span class="right-nav-text">{{ trans('main_trans.maintenance') }}</span></div>
                            <div class="pull-right"><i class="fa fa-chevron-down"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="calendar-menu" class="collapse" data-parent="#sidebarnav">
                            <li>
                                <a href="{{ route('maintenance') }}">
                                    <i class="fa fa-wrench"></i> {{ trans('main_trans.all_maintenance') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('new_maintenance') }}">
                                    <i class="fa fa-plus-circle"></i> {{ trans('main_trans.new_maintenance') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('comfirmed_maintenance') }}">
                                    <i class="fa fa-check-circle"></i> {{ trans('main_trans.comfirmed_maintenance') }}
                                </a>
                            </li>
                        </ul>
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
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#caler-menu">
                            <div class="pull-left"><i class="fa fa-comments"></i><span class="right-nav-text">{{ trans('main_trans.reviews') }}</span></div>
                            <div class="pull-right"><i class="fa fa-chevron-down"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="caler-menu" class="collapse" data-parent="#sidebarnav">
                            <li>
                                <a href="{{ route('reviews.reviews') }}">
                                    <i class="fa fa-list"></i> {{ trans('main_trans.all_review') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('new_review') }}">
                                    <i class="fa fa-star"></i> {{ trans('main_trans.new_review') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('comfirmed_review') }}">
                                    <i class="fa fa-check"></i> {{ trans('main_trans.comfirmed_review') }}
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="{{ route('buildingTypes.buildingTypes') }}"><i class="ti-home"></i><span class="right-nav-text">{{ trans('main_trans.buildingTypes') }}</span></a>
                    </li>

                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#pricing-menu">
                            <div class="pull-left"><i class="fa-solid fa-hand-holding-dollar"></i><span class="right-nav-text">{{ trans('main_trans.pricing') }}</span></div>
                            <div class="pull-right"><i class="fa fa-chevron-down"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="pricing-menu" class="collapse" data-parent="#sidebarnav">
                            <li>
                                <a href="{{ route('pricing.pricing') }}">
                                    <i class="fa-solid fa-money-check-dollar"></i> {{ trans('main_trans.all_pricing') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('pricing.new') }}">
                                    <i class="fa-solid fa-tags"></i> {{ trans('main_trans.new_pricing') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('pricing.confirmed') }}">
                                    <i class="fa-solid fa-award"></i> {{ trans('main_trans.confirmed_pricing') }}
                                </a>
                            </li>
                        </ul>
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
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#load-menu">
                            <div class="pull-left"><i class="fa-solid fa-calculator"></i><span class="right-nav-text">{{ trans('main_trans.loadCalculation') }}</span></div>
                            <div class="pull-right"><i class="fa fa-chevron-down"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="load-menu" class="collapse" data-parent="#sidebarnav">
                            <li>
                                <a href="{{ route('loadCalculation') }}">
                                    <i class="fa-solid fa-calculator"></i>{{ trans('main_trans.all_loads') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('loadCalculation.new') }}">
                                    <i class="fa-solid fa-tags"></i> {{ trans('main_trans.new_loads') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('loadCalculation.confirmed') }}">
                                    <i class="fa-solid fa-award"></i> {{ trans('main_trans.confirmed_loads') }}
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ route('cfmRates') }}">
                            <i class="fas fa-calculator"></i>
                            <span>{{ trans('main_trans.cfmRates') }}</span>
                        </a>
                    </li>
                    <style>
                        #calendar-menu a {
                            font-size: 1.2em; /* حجم النص */
                        }


                        </style>

                    <li>
<<<<<<< HEAD
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#companies-menu">
=======
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#lendar-menu">
>>>>>>> 6ed226f07b0fcf3446b8ddd7b1475c0f1100c5d1
                            <div class="pull-left"><i class="fa fa-gear"></i><span class="right-nav-text">{{ trans('main_trans.companies_info') }}</span></div>
                            <div class="pull-right"><i class="fa fa-chevron-down"></i></div>
                            <div class="clearfix"></div>
                        </a>
<<<<<<< HEAD
                        <ul id="companies-menu" class="collapse" data-parent="#sidebarnav">
=======
                        <ul id="lendar-menu" class="collapse" data-parent="#sidebarnav">
>>>>>>> 6ed226f07b0fcf3446b8ddd7b1475c0f1100c5d1
                            <li>
                                <a href="{{ route('companies') }}">
                                    <i class="fa-regular fa-building"></i> {{ trans('main_trans.companies') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('companyAdmins') }}">
                                    <i class="fa-solid fa-user-tie"></i> {{ trans('main_trans.companies_admins') }}
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ route('notifications') }}">
                            <i class="fa-solid fa-bell"></i> {{ trans('main_trans.notification') }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Left Sidebar End-->

        <!--=================================
