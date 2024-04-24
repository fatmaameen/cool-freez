@extends('layouts.master')
@section('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<style>
    /* Increase font size and line height for text within tab content */
    .tab-content {
        font-size: 1.2rem; /* Adjust the font size as desired */
        margin-bottom: 20px; /* Add space between tab content */
        line-height: 1.6; /* Add line height for spacing between lines */
    }

    /* Increase line height for other text elements */
    .col-group, .col-md-6 {
        line-height: 1.6; /* Add line height for better spacing between lines */
    }
</style>






@section('title')
{{ trans('main_trans.pricing_details') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{ trans('main_trans.pricing_details') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="default-color">{{ trans('main_trans.Dashboard')}}</a></li>
                <li class="breadcrumb-item active">{{ trans('main_trans.pricing_details') }}</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection

@section('content')
<!-- row -->
<div class="container">
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="information">
                            <h5 style="background-color: rgb(24, 53, 73); color: white; text-align: center; padding: 10px; margin: 10px auto; width: 80%;">{{ trans('main_trans.client_data') }}</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="col-group">
                                        <label for="" class="font-weight-bold">{{ trans('main_trans.user_name') }}:</label>
                                        <span>{{ $pricing->client->name }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="col-group">
                                        <label for="" class="font-weight-bold">{{ trans('main_trans.email') }}:</label>
                                        <span>{{ $pricing->client->email }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="col-group">
                                        <label for="" class="font-weight-bold">{{ trans('main_trans.phone') }} :</label>
                                        <span>{{ $pricing->client->phone_number }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="col-group">
                                        <label for="" class="font-weight-bold">{{ trans('main_trans.address') }}:</label>
                                        <span class="date">{{ $pricing->client->address }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="col-group">
                                        <label for="" class="font-weight-bold">{{ trans('main_trans.avatar') }} :</label>
                                        <img class="rounded-circle" src="{{ $pricing->client->image}}" width="60" height="60">
                                    </div>
                                </div>
                            </div>

                            {{-- ////////////////////////////////////////////////////////////////////////////////// --}}

                        </div>
                    </div>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="information">
                            <h5 style="background-color:  rgb(24, 53, 73); color: white; text-align: center; padding: 10px; margin: 10px auto; width: 80%;">{{ trans('main_trans.pricing_details') }}</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="col-group">
                                        <label for="" class="font-weight-bold">{{ trans('main_trans.building_type') }}:</label>
                                        <span>{{ $pricing->details->first()->building_type }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="col-group">
                                        <label for="" class="font-weight-bold">{{ trans('main_trans.floor') }}:</label>
                                        <span>{{ $pricing->details->first()->floor }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="col-group">
                                        <label for="" class="font-weight-bold">{{ trans('main_trans.brand') }}:</label>
                                        <span>{{ $pricing->details->first()->brand }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="col-group">
                                        <label for="" class="font-weight-bold">{{ trans('main_trans.air_conditioning_type') }} :</label>
                                        <span>{{ $pricing->details->first()->air_conditioning_type }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="information">
                                    <h5>{{ trans('main_trans.drawing_of_building') }}</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="col-group">
                                                @php
                                                // Get the drawing_of_building attribute from the pricing details
                                                $file = $pricing->details->first()->drawing_of_building;
                                                @endphp

                                                <!-- Create a hyperlink to the file in the public/pricing_files directory -->
                                                <a href="{{ url('pricing_files/' . $file) }}" class="btn btn-primary" target="_blank">{{ trans('main_trans.show') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- row closed -->
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@endsection
