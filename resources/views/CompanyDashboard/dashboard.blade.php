<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Webmin - Bootstrap 4 & Angular 5 Admin Dashboard Template" />
    <meta name="author" content="potenzaglobalsolutions.com" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    @include('CompanyDashboard.layouts.head')
</head>

<body>

    <div class="wrapper">

        <!--=================================
 preloader -->

        <div id="pre-loader">
            <img  src="{{ asset('assets/images/pre-loader/loader-01.svg') }}" alt="">
        </div>

        <!--=================================
 preloader -->

        @include('CompanyDashboard.layouts.main-header')

        @include('CompanyDashboard.layouts.main-sidebar')

        <!--=================================
 Main content -->
        <!-- main-content -->
        <div class="content-wrapper">
            <div class="page-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h4 class="mb-0"> {{ trans('main_trans.Dashboard') }}</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                        </ol>
                    </div>
                </div>
            </div>
            <!-- widgets -->
            <div class="row">
                <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="clearfix">
                                <div class="float-left">
                                    <span class="text-danger">
                                        <i class="fa fa-bar-chart-o highlight-icon" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="float-right text-right">
                                   <h5> <p class="card-text text-dark">{{ trans('main_trans.clients') }}</p></h5>
                                    @php
                                    use App\Models\Client; // Correct the namespace
$clients=Client::orderBy('id', 'desc')->take(5)->get();
                                    $clientcount = Client::count(); // Get all clients
                                @endphp


                                    <h4>{{ $clientcount }}</h4> <!-- Display each client's ID -->

                                </div>
                            </div>
                            <p class="text-muted pt-3 mb-0 mt-2 border-top">
                            <h5>{{ trans('main_trans.total_clients') }}</h5>

                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="clearfix">
                                <div class="float-left">
                                    <span class="text-warning">
                                        <i class="fa fa-shopping-cart highlight-icon" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="float-right text-right">
                                    <h5> <p class="card-text text-dark">{{ trans('main_trans.maintenance') }}</p> </h5>
                                    @php
                                    use App\Models\Maintenance; // Correct the namespace

                                    $maintenancecount= Maintenance::count(); // Get all clients
                                @endphp

                                    <h4>{{$maintenancecount }}</h4> <!-- Display each client's ID -->

                                </div>
                            </div>
                            <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                <h5><i class="fa fa-bookmark-o mr-1" aria-hidden="true"></i> {{ trans('main_trans.total_maintenance') }}</h5>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="clearfix">
                                <div class="float-left">
                                    <span class="text-success">
                                        <i class="fa fa-dollar highlight-icon" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="float-right text-right">
                                    <h5> <p class="card-text text-dark">{{ trans('main_trans.offers') }}</p></h5>
                                    @php
                                    use App\Models\offer; // Correct the namespace
                                    $offerCount = offer::count();
                                @endphp


                                    <h4>{{$offerCount }}</h4> <!-- Display each client's ID -->

                                </div>
                            </div>
                            <p class="text-muted pt-3 mb-0 mt-2 border-top">
                               <h5> <i class="fa fa-calendar mr-1" aria-hidden="true"></i> {{ trans('main_trans.total_offer') }}</h5>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="clearfix">
                                <div class="float-left">
                                    <span class="text-primary">
                                        <i class="fa fa-twitter highlight-icon" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="float-right text-right">
                                    <h5><p class="card-text text-dark">{{ trans('main_trans.reviews') }}</p></h5>
                                    @php
                                    use App\Models\review; // Correct the namespace
                                    $reviewscount = review::count();
                                @endphp


                                    <h4>{{$reviewscount }}</h4> <!-- Display each client's ID -->

                                </div>
                            </div>
                            <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                <h5> <i class="fa fa-repeat mr-1" aria-hidden="true"></i> {{ trans('main_trans.Just Updated') }}</h5>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Orders Status widgets-->
            <div class="row">
                <div class="col-xl-4 mb-30">
                    <div class="card card-statistics h-100">


                        <div class="card-body">
                            <h5 class="card-title"> {{ trans('main_trans.summary') }}</h5>
                            <h4>50% </h4>
                            <div class="row mt-20">
                                <div class="col-4">
                                    <h6>{{  trans('main_trans.maintenance')  }}</h6>
                                    <b class="text-info">+ 82.24 % </b>
                                </div>
                                <div class="col-4">
                                    <h6>{{  trans('main_trans.pricing')  }}</h6>
                                    <b class="text-danger">- 12.06 % </b>
                                </div>
                                <div class="col-4">
                                    <h6>{{  trans('main_trans.reviews')  }}</h6>
                                    <b class="text-warning">+ 24.86 % </b>
                                </div>
                            </div>
                        </div>
                        <div id="sparkline2" class="scrollbar-x text-center"></div>
                    </div>
                </div>
                <div class="col-xl-8 mb-30">
                    <div class="card h-100">

                        <div class="card-body">
                            <div class="d-block d-md-flexx justify-content-between">
                                <div class="d-block">
                                    <h5 class="card-title">{{  trans('main_trans.App Visits Growth')  }} </h5>
                                </div>
                                <div class="d-flex">
                                    <div class="clearfix mr-30">
                                        <h6 class="text-success">{{  trans('main_trans.income')  }} </h6>
                                        <p>+584</p>
                                    </div>
                                    <div class="clearfix  mr-50">
                                        <h6 class="text-danger"> {{  trans('main_trans.outcome')  }} </h6>
                                        <p>-255</p>
                                    </div>
                                </div>
                            </div>
                            <div id="morris-area" style="height: 320px;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-4 mb-30">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{  trans('main_trans.reviews')  }}</h5>
                            <div class="row mb-30">
                                <div class="col-md-6">
                                    <div class="clearfix">
                                        <p class="mb-10 float-left">{{  trans('main_trans.positive')  }}</p>
                                        <i class="mb-10 text-success float-right fa fa-arrow-up"> </i>
                                    </div>
                                    <div class="progress progress-small">
                                        <div class="skill2-bar bg-success" role="progressbar" style="width: 70%"
                                            aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="mt-10 text-success">8501</h4>
                                </div>
                                <div class="col-md-6">
                                    <div class="clearfix">
                                        <p class="mb-10 float-left">{{  trans('main_trans.nagative')  }}</p>
                                        <i class="mb-10 text-danger float-right fa fa-arrow-down"> </i>
                                    </div>
                                    <div class="progress progress-small">
                                        <div class="skill2-bar bg-danger" role="progressbar" style="width: 30%"
                                            aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="mt-10 text-danger">3251</h4>
                                </div>
                            </div>
                            <div class="chart-wrapper" style="width: 100%; margin: 0 auto;">
                                <div id="canvas-holder">
                                    <canvas id="canvas3" width="550"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="tab nav-border" style="position: relative;">
                                <div class="d-block d-md-flex justify-content-between">
                                    <div class="d-block w-100">
                                        <h5 class="card-title">{{  trans('main_trans.last_clients')  }}</h5>
                                    </div>

                                </div>
                                <div class="tab-content" id="myTabContent">

                                    <table class="table table-bordered  w-100">
                                        <thead class="bg-light">
                                            <tr>
                                                <th>#</th>

                                                <th scope="col">{{ trans('main_trans.user_name') }}</th>
                                                <th scope="col">{{ trans('main_trans.email') }}</th>
                                                <th scope="col">{{ trans('main_trans.avatar') }}</th>
                                                <th scope="col">{{ trans('main_trans.phone') }}</th>
                                                <th scope="col">{{ trans('main_trans.address') }}</th>


                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($clients as $client)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>

                                                <td>{{ $client->name }}</td>
                                                <td>{{ $client->email }}</td>
                                                <td>
                                                    <div class="ul-widget-app__profile-pic">

                                                    <img class="rounded-circle"
                                                    src="{{$client->image}}"
                                                    width="60"
                                                    height="60"
                    >
                                                </div>
                                            </td>


                                                <td>{{ $client->phone_number }}</td>
                                                <td>{{ $client->address }}</td>




                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-4 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                          <style>  .tab .nav.nav-tabs li a.active {
                                background:#91c5d0;
                                color: #130101;
                                border-color: transparent;
                            }
                            .tab .nav.nav-tabs li a.active:focus {
    background: #91c5d0;
    color: #130101;
    border-color: transparent;
}
                            </style>
                            <h5 class="card-title">{{  trans('main_trans.summary')  }}</h5>
                            <ul class="list-unstyled">
                                @php
                                use App\Models\brand;
                                use App\Models\CustomerService;

                                $brands = brand::count();

                                $CustomerService = CustomerService::count();
                            @endphp

                                <li class="mb-20">
                                    <div class="media">
                                        <div class="position-relative">
                                            <img class="img-fluid mr-15 avatar-small" src="images/item/01.png" alt="">
                                        </div>
                                        <div class="media-body">
                                            <h6 class="mt-0 mb-0">{{  trans('main_trans.brand')  }} <span class="float-right text-danger">
                                                   {{ $brands }}</span> </h6>

                                        </div>
                                    </div>
                                    <div class="divider dotted mt-20"></div>
                                </li>
                                <li class="mb-20">
                                    <div class="media">
                                        <div class="position-relative clearfix">
                                            <img class="img-fluid mr-15 avatar-small" src="images/item/02.png" alt="">
                                        </div>
                                        <div class="media-body">
                                            <h6 class="mt-0 mb-0">{{  trans('main_trans.reviews')  }} <span class="float-right text-warning">
                                                    {{ $CustomerService }}</span> </h6>

                                        </div>
                                    </div>
                                    <div class="divider dotted mt-20"></div>
                                </li>
                                <li class="mb-20">
                                    <div class="media">
                                        <div class="position-relative">
                                            <img class="img-fluid mr-15 avatar-small" src="images/item/03.png" alt="">
                                        </div>
                                        <div class="media-body">
                                            <h6 class="mt-0 mb-0">{{ trans('main_trans.maintenance') }} <span class="float-right text-success">
                                                {{$maintenancecount }}</span> </h6>

                                        </div>
                                    </div>
                                    <div class="divider dotted mt-20"></div>
                                </li>
                                <li>
                                    <div class="media">
                                        <div class="position-relative clearfix">
                                            <img class="img-fluid mr-15 avatar-small" src="images/item/04.png" alt="">
                                        </div>
                                        <div class="media-body">
                                            <h6 class="mt-0 mb-0">{{ trans('main_trans.clients') }} <span
                                                    class="float-right text-warning">{{ $clientcount }} </span></h6>

                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            <style>   .fc-today-button {
                    background: #91c5d0;
                    color: #160202;
                }
                .fc-state-active {
    background: #91c5d0;
    color: #160202;
}
.bg-gray,
.bg-gray * {
    background-color: #91c5d0; /* لون الخلفية الرمادية */
    color: #000; /* لون النص الأسود */
}

.fc-unthemed td.fc-today {
    background: #91c5d0;
}
.fc-event, .fc-event:hover {
    color: #000; /* لون النص أسود */
    text-decoration: none;
}


                </style>
                <div class="col-xl-4 mb-30">
                    <div class="card h-100">

                        <div class="card-body">
                            <h5 class="card-title">{{  trans('main_trans.App Visits Growth')  }} </h5>
                            <div class="row">
                                <div class="col-6">
                                    <h6 class="text-danger">{{  trans('main_trans.income')  }}</h6>
                                    <p class="text-danger">+584</p>
                                </div>
                                <div class="col-6">
                                    <h6 class="text-info">{{  trans('main_trans.outcome')  }}</h6>
                                    <p class="text-info">-255</p>
                                </div>
                            </div>
                            <div id="morris-line" style="height: 320px;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="p-4 text-center bg" style="background: url(images/bg/01.jpg);">
                            <h5 class="mb-70 text-white position-relative">{{ Auth::user()->name }} </h5>

                        </div>
                        <div class="card-body text-center position-relative">
                            <div class="avatar-top">
                                <img class="img-fluid w-25 rounded-circle " src="{{Auth::user()->image }}" alt="">
                            </div>

                            <div class="divider mt-20"></div>

                            <h5 class="mt-10">{{ Auth::user()->email }}</h5>
                            <div class="social-icons color-icon mt-20">
                                <ul>
                                    <li class="social-rss"><a href="#"><i class="fa fa-rss"></i></a></li>
                                    <li class="social-facebook"><a href="#"><i class="fa fa-facebook"></i></a>
                                    </li>
                                    <li class="social-twitter"><a href="#"><i class="fa fa-twitter"></i></a>
                                    </li>
                                    <li class="social-github"><a href="#"><i class="fa fa-github"></i></a></li>
                                    <li class="social-youtube"><a href="#"><i class="fa fa-youtube"></i></a>
                                    </li>
                                    <li class="social-instagram"><a href="#"><i class="fa fa-instagram"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="calendar-main mb-30">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="row">
                            <div class="col-12 sm-mb-30">
                                {{-- <a href="#" data-toggle="modal" data-target="#add-category"
                                    class="btn btn-primary btn-block m-t-20">
                                    <i class="fa fa-plus pr-2"></i> Create New
                                </a> --}}
                                <div id="external-events" class="m-t-20">
                                    <br>
                                    {{-- <p class="text-muted">Drag and drop your event or click in the calendar</p> --}}
                                    <div class="external-event bg-gray fc-event">
                                        <i class="fa fa-circle mr-2 vertical-middle"></i> {{ trans('main_trans.admins') }}
                                    </div>
                                    <div class="external-event bg-info fc-event">
                                        <i class="fa fa-circle mr-2 vertical-middle"></i>{{ trans('main_trans.clients') }}
                                    </div>
                                    <div class="external-event bg-gray fc-event">
                                        <i class="fa fa-circle mr-2 vertical-middle"></i>{{ trans('main_trans.maintenance') }}
                                    </div>
                                    <div class="external-event bg-info fc-event">
                                        <i class="fa fa-circle mr-2 vertical-middle"></i>{{ trans('main_trans.brands') }}
                                    </div>
                                    <div class="external-event bg-gray fc-event">
                                        <i class="fa fa-circle mr-2 vertical-middle"></i>{{ trans('main_trans.types') }}
                                    </div>
                                    <div class="external-event bg-info fc-event">
                                        <i class="fa fa-circle mr-2 vertical-middle"></i>{{ trans('main_trans.offers') }}
                                    </div>
                                    <div class="external-event bg-gray fc-event">
                                        <i class="fa fa-circle mr-2 vertical-middle"></i>{{ trans('main_trans.consultant') }}
                                    </div>

                                    <div class="external-event bg-info fc-event">
                                        <i class="fa fa-circle mr-2 vertical-middle"></i>{{ trans('main_trans.pricing') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div id="calendar"></div>
                        <div class="modal" tabindex="-1" role="dialog" id="event-modal">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add New Event</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <div class="modal-body p-20"></div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-success save-event">Create
                                            event</button>
                                        <button type="button" class="btn btn-danger delete-event"
                                            data-dismiss="modal">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal Add Category -->
                        <div class="modal" tabindex="-1" role="dialog" id="add-category">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add a category</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-hidden="true">&times;</button>
                                    </div>
                                    <div class="modal-body p-20">
                                        <form>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="control-label">Category Name</label>
                                                    <input class="form-control form-white" placeholder="Enter name"
                                                        type="text" name="category-name" />
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="control-label">Choose Category Color</label>
                                                    <select class="form-control form-white"
                                                        data-placeholder="Choose a color..." name="category-color">
                                                        <option value="success">Success</option>
                                                        <option value="danger">Danger</option>
                                                        <option value="info">Info</option>
                                                        <option value="primary">Primary</option>
                                                        <option value="warning">Warning</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-success save-category"
                                            data-dismiss="modal">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--=================================
 wrapper -->

            <!--=================================
 footer -->

            @include('CompanyDashboard.layouts.footer')
        </div><!-- main content wrapper end-->
    </div>
    </div>
    </div>

    <!--=================================
 footer -->

    @include('CompanyDashboard.layouts.footer-scripts')

</body>

</html>
