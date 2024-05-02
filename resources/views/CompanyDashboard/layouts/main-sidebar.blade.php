<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            <div class="scrollbar side-menu-bg">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">
                    <!-- menu item Dashboard-->
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

                    <li>
                        <a href="{{ route('company-dashboard') }}"><i class="ti-home"></i><span class="right-nav-text">{{ trans('main_trans.Dashboard')}}
                            </span></a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#calendar-menu">
                            <div class="pull-left"><i class="fa fa-gear"></i><span class="right-nav-text">{{ trans('main_trans.companyMaintenance') }}</span></div>
                            <div class="pull-right"><i class="fa fa-chevron-down"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="calendar-menu" class="collapse" data-parent="#sidebarnav">
                            <li>
                                <a href="{{ route('complete_maintenance') }}">
                                    <i class="fa fa-check-circle"></i> {{ trans('main_trans.complete_maintenance') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('incomplete_maintenance') }}">
                                    <i class="fa fa-exclamation-triangle"></i> {{ trans('main_trans.Incomplete_maintenance') }}
                                </a>
                            </li>
                        </ul>

                    </li>





                    <li>
                        <a href="{{ route('technician') }}"><i class="fa fa-cogs"></i><span class="right-nav-text">{{ trans('main_trans.technician') }}</span></a>
                    </li>






                </ul>
            </div>
        </div>

        <!-- Left Sidebar End-->

        <!--=================================
