<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            <div class="scrollbar side-menu-bg">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">
                    <!-- menu item Dashboard-->

                    <li>
                        <a href="{{ route('company-dashboard') }}"><i class="ti-comments"></i><span class="right-nav-text">{{ trans('main_trans.Dashboard')}}
                            </span></a>
                    </li>
                    <li>
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
                    </li>



                    <li>
                        <a href="{{ route('technician') }}"><i class="ti-menu-alt"></i><span class="right-nav-text">{{ trans('main_trans.technician') }}
                            </span> </a>
                    </li>





                </ul>
            </div>
        </div>

        <!-- Left Sidebar End-->

        <!--=================================
