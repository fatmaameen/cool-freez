@extends('MainDashboard.layouts.master')
@section('css')
<style>
    .circular-link {
        display: inline-block;
        width: 40px;
        height: 40px;
        line-height: 40px;
        border-radius: 50%;
        background-color: lightblue;
        color: rgb(17, 17, 17);
        text-align: center;
        text-decoration: none;
        margin-right: 40px;
    }

    .status {
        font-size: 20px;
        font-weight: bold;
        padding: 5px 10px;
        border-radius: 5px;
        display: inline-block;
    }

    .status-waiting {
        background-color: #ffc107;
        color: #fffefe;
    }

    .status-cancelled {
        background-color: #ff4d4d;
        color: #fff;
    }

    .status-confirmed {
        background-color: #28a745;
        color: #fff;
    }

    .status-icon {
        margin-right: 5px;
    }

    /* Hide horizontal scrollbar */
    .container {
        overflow-x: hidden;
    }

    /* Ensure the body has no unwanted margin or padding */
    body {
        margin: 0;
        padding: 0;
        overflow-x: hidden;
    }

    /* Ensure tables don't cause horizontal scroll */
    .table-responsive {
        overflow-x: auto;
    }

</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
@endsection

@section('title', trans('main_trans.clients'))

@section('page-header')
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
@endsection

@section('content')

<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="tab-content">
                    @if ($mergedData->contains('service_id', 1))
                    <div role="tabpanel" class="tab-pane active" id="maintenance">
                        <h5 style="background-color: #91c5d0; color: white; text-align: center; padding: 10px; margin: 10px auto; width: 100%;">{{ trans('main_trans.maintenance') }}</h5>
                        <table class="table table-bordered w-100">
                            <thead class="bg-light">
                                <tr>
                                    <th>#</th>
                                    <th scope="col">{{ trans('main_trans.code') }}</th>
                                    <th scope="col">{{ trans('main_trans.admin_status') }}</th>
                                    <th scope="col">{{ trans('main_trans.create_at') }}</th>
                                    <th scope="col">{{ trans('main_trans.details') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mergedData->where('service_id', 1) as $maintenance)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $maintenance->code }}</td>
                                    <td>
                                        @if ($maintenance->admin_status == 'waiting')
                                        <span class="status status-waiting">
                                            <i class="status-icon fas fa-clock"></i>
                                            Waiting
                                        </span>
                                        @elseif ($maintenance->admin_status == 'cancelled')
                                        <span class="status status-cancelled">
                                            <i class="status-icon fas fa-times-circle"></i>
                                            Cancelled
                                        </span>
                                        @elseif ($maintenance->admin_status == 'confirmed')
                                        <span class="status status-confirmed">
                                            <i class="status-icon fas fa-check-circle"></i>
                                            Confirmed
                                        </span>
                                        @endif
                                    </td>
                                    <td>{{ $maintenance->created_at }}</td>
                                    <td>
                                        <a href="#editModal{{ $maintenance->id }}" data-toggle="modal" class="circular-link">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif

                    @if ($mergedData->contains('service_id', 2))
                    <div role="tabpanel" class="tab-pane active" id="pricing">
                        <h5 style="background-color: #91c5d0; color: white; text-align: center; padding: 10px; margin: 10px auto; width: 100%;">{{ trans('main_trans.pricing') }}</h5>
                        <table class="table table-bordered w-100">
                            <thead class="bg-light">
                                <tr>
                                    <th>#</th>
                                    <th scope="col">{{ trans('main_trans.code') }}</th>
                                    <th scope="col">{{ trans('main_trans.admin_status') }}</th>
                                    <th scope="col">{{ trans('main_trans.create_at') }}</th>
                                    <th scope="col">{{ trans('main_trans.details') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mergedData->where('service_id', 2) as $pricing)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $pricing->code }}</td>
                                    <td>
                                        @if ($pricing->admin_status == 'waiting')
                                        <span class="status status-waiting">
                                            <i class="status-icon fas fa-clock"></i>
                                            Waiting
                                        </span>
                                        @elseif ($pricing->admin_status == 'cancelled')
                                        <span class="status status-cancelled">
                                            <i class="status-icon fas fa-times-circle"></i>
                                            Cancelled
                                        </span>
                                        @elseif ($pricing->admin_status == 'confirmed')
                                        <span class="status status-confirmed">
                                            <i class="status-icon fas fa-check-circle"></i>
                                            Confirmed
                                        </span>
                                        @endif
                                    </td>
                                    <td>{{ $pricing->created_at }}</td>

                                        <td>
                                            <a href="#pricingModal{{ $pricing->id }}" data-toggle="modal" class="circular-link">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                        </td>


                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif

                    @if ($mergedData->contains('service_id', 3))
                    <div role="tabpanel" class="tab-pane active" id="reviews">
                        <h5 style="background-color: #91c5d0; color: white; text-align: center; padding: 10px; margin: 10px auto; width: 100%;">{{ trans('main_trans.reviews') }}</h5>
                        <table class="table table-bordered w-100">
                            <thead class="bg-light">
                                <tr>
                                    <th>#</th>
                                    <th scope="col">{{ trans('main_trans.code') }}</th>
                                    <th scope="col">{{ trans('main_trans.admin_status') }}</th>
                                    <th scope="col">{{ trans('main_trans.create_at') }}</th>
                                    <th scope="col">{{ trans('main_trans.details') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mergedData->where('service_id', 3) as $review)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $review->code }}</td>
                                    <td>
                                        @if ($review->admin_status == 'waiting')
                                        <span class="status status-waiting">
                                            <i class="status-icon fas fa-clock"></i>
                                            Waiting
                                        </span>
                                        @elseif ($review->admin_status == 'cancelled')
                                        <span class="status status-cancelled">
                                            <i class="status-icon fas fa-times-circle"></i>
                                            Cancelled
                                        </span>
                                        @elseif ($review->admin_status == 'confirmed')
                                        <span class="status status-confirmed">
                                            <i class="status-icon fas fa-check-circle"></i>
                                            Confirmed
                                        </span>
                                        @endif
                                    </td>
                                    <td>{{ $review->created_at }}</td>
                                    <td>
                                        <a href="#reviewModal{{ $review->id }}" data-toggle="modal" class="circular-link">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif

                    @if ($mergedData->contains('service_id', 4))
                    <div role="tabpanel" class="tab-pane active" id="loadCalculation">
                        <h5 style="background-color: #91c5d0; color: white; text-align: center; padding: 10px; margin: 10px auto; width: 100%;">{{ trans('main_trans.loadCalculation') }}</h5>
                        <table class="table table-bordered w-100">
                            <thead class="bg-light">
                                <tr>
                                    <th>#</th>
                                    <th scope="col">{{ trans('main_trans.code') }}</th>
                                    <th scope="col">{{ trans('main_trans.admin_status') }}</th>
                                    <th scope="col">{{ trans('main_trans.create_at') }}</th>
                                    <th scope="col">{{ trans('main_trans.details') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mergedData->where('service_id', 4) as $load)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $load->code }}</td>
                                    <td>
                                        @if ($load->admin_status == 'waiting')
                                        <span class="status status-waiting">
                                            <i class="status-icon fas fa-clock"></i>
                                            Waiting
                                        </span>
                                        @elseif ($load->admin_status == 'cancelled')
                                        <span class="status status-cancelled">
                                            <i class="status-icon fas fa-times-circle"></i>
                                            Cancelled
                                        </span>
                                        @elseif ($load->admin_status == 'confirmed')
                                        <span class="status status-confirmed">
                                            <i class="status-icon fas fa-check-circle"></i>
                                            Confirmed
                                        </span>
                                        @endif
                                    </td>
                                    <td>{{ $load->created_at }}</td>
                                    <td>
                                        <a href="#loadModal{{ $load->id }}" data-toggle="modal" class="circular-link">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>

                @foreach ($mergedData->where('service_id', 1) as $maintenance)
                <div class="modal fade" id="editModal{{ $maintenance->id }}" data-backdrop="static" tabindex="-1" aria-labelledby="editModalLabel{{ $maintenance->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content" style="background-color: #C3E0E5;"> <!-- Apply baby blue color -->
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel{{ $maintenance->id }}" style="font-size: 1.5rem;">{{ trans('main_trans.details') }}</h5> <!-- Increase font size -->
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" style="font-size: 1.2rem;"> <!-- Increase font size -->
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td><strong>{{ trans('main_trans.address') }}</strong></td>
                                            <td>{{ $maintenance->address }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>{{ trans('main_trans.street_address') }}</strong></td>
                                            <td>{{ $maintenance->street_address }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>{{ trans('main_trans.phone') }}</strong></td>
                                            <td>{{ $maintenance->phone_number }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>{{ trans('main_trans.device_type') }}</strong></td>
                                            <td>{{ $maintenance->device_type }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>{{ trans('main_trans.type_of_malfunction') }}</strong></td>
                                            <td>{{ $maintenance->type_of_malfunction }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('main_trans.close') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach



            @foreach ($mergedData->where('service_id', 2) as $pricing)
            <div class="modal fade" id="pricingModal{{ $pricing->id }}" data-backdrop="static" tabindex="-1" aria-labelledby="pricingModalLabel{{ $pricing->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content" style="background-color: #C3E0E5;"> <!-- Apply baby blue color -->
                        <div class="modal-header">
                            <h5 class="modal-title" id="pricingModalLabel{{ $pricing->id }}" style="font-size: 1.5rem;">{{ trans('main_trans.details') }}</h5> <!-- Increase font size -->
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" style="font-size: 1.2rem;"> <!-- Increase font size -->
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>{{ trans('main_trans.building_type') }}</th>
                                        <th>{{ trans('main_trans.floor') }}</th>
                                        <th>{{ trans('main_trans.brand') }}</th>
                                        <th>{{ trans('main_trans.air_conditioning_type') }}</th>
                                        <th>{{ trans('main_trans.drawing_of_building') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pricing->details as $detail)
                                    <tr>
                                        <td>{{ $detail['building_type'] }}</td>
                                        <td>{{ $detail['floor'] }}</td>
                                        <td>{{ $detail['brand'] }}</td>
                                        <td>{{ $detail['air_conditioning_type'] }}</td>
                                        <td>{{ $detail['drawing_of_building'] }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('main_trans.close') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        @foreach ($mergedData->where('service_id', 3) as $review)
    <div class="modal fade" id="reviewModal{{ $review->id }}" data-backdrop="static" tabindex="-1" aria-labelledby="reviewModalLabel{{ $review->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg"> <!-- Added modal-lg class for a large modal -->
            <div class="modal-content">
                <div class="modal-header" style="background-color: #c5dae9;"> <!-- Apply light pink background color -->
                    <h5 class="modal-title" id="reviewModalLabel{{ $review->id }}" style="font-size: 1.5rem;">{{ trans('main_trans.details') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="font-size: 1.2rem; overflow-x: auto;"> <!-- Apply overflow-x: auto; to enable horizontal scrolling -->
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>{{ trans('main_trans.job_title') }}</th>
                                <th>{{ trans('main_trans.user_name') }}</th>
                                <th>{{ trans('main_trans.email') }}</th>
                                <th>{{ trans('main_trans.phone') }}</th>
                                <th>{{ trans('main_trans.rate') }}</th>
                                <th>{{ trans('main_trans.avatar') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $review->consultant->job_title }}</td>
                                <td>{{ $review->consultant->name }}</td>
                                <td>{{ $review->consultant->email }}</td>
                                <td>{{ $review->consultant->phone_number }}</td>
                                <td>{{ $review->consultant->rate }}</td>
                                <td>
                                    <img class="rounded-circle" src="{{ $review->consultant->image }}" width="60" height="60">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer" style="background-color: #c5dae9;"> <!-- Apply light pink background color -->
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('main_trans.close') }}</button>
                </div>
            </div>
        </div>
    </div>
@endforeach


@foreach ($mergedData->where('service_id', 4) as $load)
<div class="modal fade" id="loadModal{{ $load->id }}" data-backdrop="static" tabindex="-1" aria-labelledby="loadModalLabel{{ $load->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg"> <!-- Added modal-lg class for a large modal -->
        <div class="modal-content">
            <div class="modal-header" style="background-color: #c5dae9;"> <!-- Apply light pink background color -->
                <h5 class="modal-title" id="loadModalLabel{{ $load->id }}" style="font-size: 1.5rem;">{{ trans('main_trans.details') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="font-size: 1.2rem; overflow-x: auto;"> <!-- Apply overflow-x: auto; to enable horizontal scrolling if needed -->
                @if($load->model)
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">{{ trans('main_trans.brand') }}</th>
                                <th scope="col">{{ trans('main_trans.type') }}</th>
                                <th scope="col">{{ trans('main_trans.model') }}</th>
                                <th scope="col">{{ trans('main_trans.btu') }}</th>
                                <th scope="col">{{ trans('main_trans.cfm') }}</th>
                                <th scope="col">{{ trans('main_trans.gas') }}</th>
                                <th scope="col">{{ trans('main_trans.made_in') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td scope="row">{{ $load->model->brand }}</td>
                                <td scope="row">{{ $load->model->type }}</td>
                                <td scope="row">{{ $load->model->model }}</td>
                                <td scope="row">{{ $load->model->btu }}</td>
                                <td scope="row">{{ $load->model->cfm }}</td>
                                <td scope="row">{{ $load->model->gas }}</td>
                                <td scope="row">{{ $load->model->made_in }}</td>
                            </tr>
                        </tbody>
                    </table>
                @else
                    <p>No data available.</p> <!-- Added paragraph for the message -->
                @endif
            </div>
            <div class="modal-footer" style="background-color: #c5dae9;"> <!-- Apply light pink background color -->
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('main_trans.close') }}</button>
            </div>
        </div>
    </div>
</div>
@endforeach



            </div>
        </div>
    </div>
</div>

@endsection

@section('js')


@endsection
