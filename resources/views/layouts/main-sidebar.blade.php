<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            <div class="scrollbar side-menu-bg">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">
                    <!-- menu item Dashboard-->

                    <li>
                        <a href="{{ route('dashboard') }}"><i class="ti-comments"></i><span class="right-nav-text">{{ trans('main_trans.Dashboard')}}
                            </span></a>
                    </li>
                    <li>
                        <a href="/admins"><i class="ti-comments"></i><span class="right-nav-text">{{ trans('main_trans.admins') }}
                            </span></a>
                    </li>



                    <li>
                        <a href="{{ route('clients') }}"><i class="ti-comments"></i><span class="right-nav-text">{{ trans('main_trans.clients') }}
                            </span></a>
                    </li>

                    <li>
                        <a href="{{ route('maintenance') }}"><i class="ti-menu-alt"></i><span class="right-nav-text">{{ trans('main_trans.maintenance') }}
                            </span> </a>
                    </li>
                    {{-- <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#calendar-menu">
                            <div class="pull-left"><i class="ti-calendar"></i><span
                                    class="right-nav-text">{{ trans('main_trans.companyMaintenance') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="calendar-menu" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{ route('complete_maintenance') }}">{{ trans('main_trans.complete_maintenance') }} </a> </li>
                            <li> <a href="{{ route('incomplete_maintenance') }}">{{ trans('main_trans.Incomplete_maintenance') }} </a> </li>
                        </ul>
                    </li> --}}
                    <li>
                        <a href="{{ route('brands.brands') }}"><i class="ti-comments"></i><span class="right-nav-text">{{ trans('main_trans.brands') }}
                            </span></a>
                    </li>

                    <li>
                        <a href="{{ route('types.types') }}"><i class="ti-email"></i><span class="right-nav-text">{{ trans('main_trans.types') }}
                        </span></a>
                    </li>
                    <li>
                        <a href="{{ route('offer.offer') }}"><i class="ti-email"></i><span class="right-nav-text">{{ trans('main_trans.offers') }}
                        </span></a>
                    </li>
                    <li>
                        <a href="{{ route('consultant.consultant') }}"><i class="ti-email"></i><span class="right-nav-text">{{ trans('main_trans.consultant') }}
                        </span></a>
                    </li>
                    <li>
                        <a href="{{ route('reviews.reviews') }}"><i class="ti-email"></i><span class="right-nav-text">{{ trans('main_trans.reviews') }}
                        </span></a>
                    </li>
                    <li>
                        <a href="{{ route('floors.floors') }}"><i class="ti-email"></i><span class="right-nav-text">{{ trans('main_trans.floors') }}
                        </span></a>
                    </li>
                    <li>
                        <a href="{{ route('buildingTypes.buildingTypes') }}"><i class="ti-email"></i><span class="right-nav-text">{{ trans('main_trans.buildingTypes') }}
                        </span></a>
                    </li>
                    <li>
                        <a href="{{ route('usings.usings') }}"><i class="ti-email"></i><span class="right-nav-text">{{ trans('main_trans.usings') }}
                        </span></a>
                    </li>
                    <li>
                        <a href="{{ route('pricing.pricing') }}"><i class="ti-email"></i><span class="right-nav-text">{{ trans('main_trans.pricing') }}
                        </span></a>
                    </li>
                    <li>
                        <a href="{{ route('customer_service.customer_service') }}"><i class="ti-email"></i><span class="right-nav-text">{{ trans('main_trans.customer_service') }}
                        </span></a>
                    </li>

                    <!-- menu item Charts-->
                    {{-- <li>
                        <a href="" data-toggle="collapse" data-target="#chart">
                            <div class="pull-left"><i class="ti-pie-chart"></i><span
                                    class="right-nav-text">ospag</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="chart" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="chart-js.html">Chart.js</a> </li>
                            <li> <a href="chart-morris.html">Chart morris </a> </li>
                            <li> <a href="chart-sparkline.html">Chart Sparkline</a> </li>
                        </ul>
                    </li> --}}

                    <!-- menu font icon-->
                    {{-- <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#font-icon">
                            <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">font
                                    icon</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="font-icon" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="fontawesome-icon.html">font Awesome</a> </li>
                            <li> <a href="themify-icons.html">Themify icons</a> </li>
                            <li> <a href="weather-icon.html">Weather icons</a> </li>
                        </ul>
                    </li> --}}

{{--
                    <li>
                        <a href="maps.html"><i class="ti-location-pin"></i><span class="right-nav-text">maps</span>
                            <span class="badge badge-pill badge-success float-right mt-1">06</span></a>
                    </li> --}}
                    <!-- menu item timeline-->

                </ul>
            </div>
        </div>

        <!-- Left Sidebar End-->

        <!--=================================
