@extends('MainDashboard.layouts.master')

@section('css')
    <!-- External CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"> --}}

    <!-- Custom CSS -->
    <style>
        /* Custom styles here */
    </style>
@endsection

@section('title', trans('main_trans.clients'))

@section('page-header')
    <!-- Breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">{{ trans('main_trans.clients') }}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="default-color">{{ trans('main_trans.Dashboard')}}</a></li>
                    <li class="breadcrumb-item active">{{ trans('main_trans.clients') }}</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- Breadcrumb -->
@endsection

@section('content')
    <!-- Main Content -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <!-- Tab Content -->
                    <div class="tab-content">
                        <!-- Maintenance Tab -->
                        <div role="tabpanel" class="tab-pane active" id="maintenance">
                            <h5 style="background-color: #91c5d0; color: white; text-align: center; padding: 10px; margin: 10px auto; width: 100%;">{{ trans('main_trans.maintenance') }}</h5>
                            <!-- Maintenance Table -->
                            <table class="table table-bordered  w-100">
                                <thead class="bg-light">
                                   <tr>
                                    <th>#</th>

                                    <th scope="col">{{ trans('main_trans.code') }}</th>
                                    <th scope="col">{{ trans('main_trans.address') }}</th>
                                    <th scope="col">{{ trans('main_trans.street_address') }}</th>
                                    <th scope="col">{{ trans('main_trans.phone') }}</th>
                                    <th scope="col">{{ trans('main_trans.device_type') }}</th>

                                   </tr>
                                </thead>
                                <tbody>
                                    <!-- Maintenance Records -->
                                    @foreach ($maintenances as $maintenance)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>

                                        <td>{{ $maintenance->code }}</td>
                                        <td>{{ $maintenance->address }}</td>
                                        <td>{{ $maintenance->street_address }}</td>


                                        <td>
                                            <span class="text-success"
                                                style="font-size: 20px">{{ $maintenance->admin_status }}</span>
                                        </td>

                                        <td>
                                            <span class="text-success"
                                                style="font-size: 20px">{{ $maintenance->company_status }}</span>
                                        </td>
                                        <td>
                                            <span class="text-success"
                                                style="font-size: 20px">{{ $maintenance->technical_status }}</span>
                                        </td>






                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div role="tabpanel" class="tab-pane" id="pricing">
                            <h5 style="background-color:#91c5d0; color: white; text-align: center; padding: 10px; margin: 10px auto; width: 100%;">{{ trans('main_trans.pricing') }}</h5>

                            <table class="table table-bordered  w-100">
                                <thead class="bg-light">
                                    <!-- Table Headers -->
                                </thead>
                                <tbody>

                                    <!-- Replace with data from your controller -->
                                </tbody>
                            </table>
                        </div>
                        <!-- Files Tab -->
                        <div role="tabpanel" class="tab-pane" id="files">
                            <h5>{{ trans('main_trans.files') }}</h5>
                            <!-- File Links -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="col-group">
                                        <!-- File Links here -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-content">
                        <!-- Maintenance Tab -->
                        <div role="tabpanel" class="tab-pane active" id="pricing">
                            <h5 style="background-color: #91c5d0; color: white; text-align: center; padding: 10px; margin: 10px auto; width: 100%;">{{ trans('main_trans.pricing') }}</h5>
                            <!-- Maintenance Table -->
                            <table class="table table-bordered  w-100">
                                <thead class="bg-light">
                                   <tr>
                                    <th>#</th>

                                    <th scope="col">{{ trans('main_trans.code') }}</th>
                                    <th scope="col">{{ trans('main_trans.address') }}</th>
                                    <th scope="col">{{ trans('main_trans.street_address') }}</th>
                                    <th scope="col">{{ trans('main_trans.phone') }}</th>



                                   </tr>
                                </thead>
                                <tbody>
                                    <!-- Maintenance Records -->
                                    @foreach ($maintenances as $maintenance)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>

                                        <td>{{ $maintenance->code }}</td>
                                        <td>{{ $maintenance->address }}</td>
                                        <td>{{ $maintenance->street_address }}</td>


                                        <td>
                                            <span class="text-success"
                                                style="font-size: 20px">{{ $maintenance->admin_status }}</span>
                                        </td>

                                        <td>
                                            <span class="text-success"
                                                style="font-size: 20px">{{ $maintenance->company_status }}</span>
                                        </td>
                                        <td>
                                            <span class="text-success"
                                                style="font-size: 20px">{{ $maintenance->technical_status }}</span>
                                        </td>





                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div role="tabpanel" class="tab-pane" id="reviews">
                            <h5 style="background-color:#91c5d0; color: white; text-align: center; padding: 10px; margin: 10px auto; width: 100%;">{{ trans('main_trans.reviews') }}</h5>

                            <table class="table table-bordered  w-100">
                                <thead class="bg-light">
                                    <!-- Table Headers -->
                                </thead>
                                <tbody>

                                    <!-- Replace with data from your controller -->
                                </tbody>
                            </table>
                        </div>
                        <!-- Files Tab -->
                        <div role="tabpanel" class="tab-pane" id="files">
                            <h5>{{ trans('main_trans.files') }}</h5>
                            <!-- File Links -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="col-group">
                                        <!-- File Links here -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-content">
                        <!-- Maintenance Tab -->
                        <div role="tabpanel" class="tab-pane active" id="review">
                            <h5 style="background-color: #91c5d0; color: white; text-align: center; padding: 10px; margin: 10px auto; width: 100%;">{{ trans('main_trans.reviews') }}</h5>
                            <!-- Maintenance Table -->
                            <table class="table table-bordered  w-100">
                                <thead class="bg-light">
                                   <tr>
                                    <th>#</th>

                                    <th scope="col">{{ trans('main_trans.code') }}</th>
                                    <th scope="col">{{ trans('main_trans.address') }}</th>
                                    <th scope="col">{{ trans('main_trans.street_address') }}</th>
                                    <th scope="col">{{ trans('main_trans.phone') }}</th>



                                   </tr>
                                </thead>
                                <tbody>
                                    <!-- Maintenance Records -->
                                    @foreach ($maintenances as $maintenance)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>

                                        <td>{{ $maintenance->code }}</td>
                                        <td>{{ $maintenance->address }}</td>
                                        <td>{{ $maintenance->street_address }}</td>


                                        <td>
                                            <span class="text-success"
                                                style="font-size: 20px">{{ $maintenance->admin_status }}</span>
                                        </td>

                                        <td>
                                            <span class="text-success"
                                                style="font-size: 20px">{{ $maintenance->company_status }}</span>
                                        </td>
                                        <td>
                                            <span class="text-success"
                                                style="font-size: 20px">{{ $maintenance->technical_status }}</span>
                                        </td>





                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div role="tabpanel" class="tab-pane" id="reviews">
                            <h5 style="background-color:#91c5d0; color: white; text-align: center; padding: 10px; margin: 10px auto; width: 100%;">{{ trans('main_trans.reviews') }}</h5>

                            <table class="table table-bordered  w-100">
                                <thead class="bg-light">
                                    <!-- Table Headers -->
                                </thead>
                                <tbody>

                                    <!-- Replace with data from your controller -->
                                </tbody>
                            </table>
                        </div>
                        <!-- Files Tab -->
                        <div role="tabpanel" class="tab-pane" id="files">
                            <h5>{{ trans('main_trans.files') }}</h5>
                            <!-- File Links -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="col-group">
                                        <!-- File Links here -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content">
                        <!-- Maintenance Tab -->
                        <div role="tabpanel" class="tab-pane active" id="loadCalculation">
                            <h5 style="background-color: #91c5d0; color: white; text-align: center; padding: 10px; margin: 10px auto; width: 100%;">{{ trans('main_trans.loadCalculation') }}</h5>
                            <!-- Maintenance Table -->
                            <table class="table table-bordered  w-100">
                                <thead class="bg-light">
                                   <tr>
                                    <th>#</th>

                                    <th scope="col">{{ trans('main_trans.code') }}</th>
                                    <th scope="col">{{ trans('main_trans.address') }}</th>
                                    <th scope="col">{{ trans('main_trans.street_address') }}</th>
                                    <th scope="col">{{ trans('main_trans.phone') }}</th>



                                   </tr>
                                </thead>
                                <tbody>
                                    <!-- Maintenance Records -->
                                    @foreach ($maintenances as $maintenance)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>

                                        <td>{{ $maintenance->code }}</td>
                                        <td>{{ $maintenance->address }}</td>
                                        <td>{{ $maintenance->street_address }}</td>


                                        <td>
                                            <span class="text-success"
                                                style="font-size: 20px">{{ $maintenance->admin_status }}</span>
                                        </td>

                                        <td>
                                            <span class="text-success"
                                                style="font-size: 20px">{{ $maintenance->company_status }}</span>
                                        </td>
                                        <td>
                                            <span class="text-success"
                                                style="font-size: 20px">{{ $maintenance->technical_status }}</span>
                                        </td>





                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div role="tabpanel" class="tab-pane" id="reviews">
                            <h5 style="background-color:#91c5d0; color: white; text-align: center; padding: 10px; margin: 10px auto; width: 100%;">{{ trans('main_trans.reviews') }}</h5>

                            <table class="table table-bordered  w-100">
                                <thead class="bg-light">
                                    <!-- Table Headers -->
                                </thead>
                                <tbody>

                                    <!-- Replace with data from your controller -->
                                </tbody>
                            </table>
                        </div>
                        <!-- Files Tab -->
                        <div role="tabpanel" class="tab-pane" id="files">
                            <h5>{{ trans('main_trans.files') }}</h5>
                            <!-- File Links -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="col-group">
                                        <!-- File Links here -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- End Main Content -->
@endsection

@section('js')
    <!-- Bootstrap Bundle JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
