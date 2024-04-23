@extends('layouts.master')
@section('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
@section('title')
{{ trans('main_trans.reviews') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{ trans('main_trans.reviews') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="default-color">{{ trans('main_trans.Dashboard')}}</a></li>
                <li class="breadcrumb-item active">{{ trans('main_trans.reviews') }}</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection

@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="tab-content">

                    <div role="tabpanel" class="tab-pane active" id="information">
                       <h5> {{ trans('main_trans.client_data') }}</h5>
                        <div class="row">

                            <div class="col-md-6">
                              <div class="col-group">
                                    <label for="" class="font-weight-bold">{{ trans('main_trans.user_name') }}:</label>
                                    <span>{{ $review->client->name }}</span>
                                </div>
                            </div>


                            <div class="col-md-6">
                                  <div class="col-group">



                                    <label for="" class="font-weight-bold">{{ trans('main_trans.email') }}:</label>
                                    <span>{{ $review->client->email }}</span>
                                   </div>
                            </div>

                            <div class="col-md-6">
                                  <div class="col-group">
                                    <label for="" class="font-weight-bold">{{ trans('main_trans.phone') }} :</label>
                                                                                        <span>{{ $review->client->phone_number }}</span>
                                                                               </div>
                            </div>

                            <div class="col-md-6">
                                   <div class="col-group">
                                    <label for="" class="font-weight-bold">{{ trans('main_trans.address') }}:</label>
                                    <span class="date">{{ $review->client->address }}</span>

                                </div>
                            </div>

                            <div class="col-md-6">
                                  <div class="col-group">
                                    <label for="" class="font-weight-bold">{{ trans('main_trans.avatar') }} :</label>
                                    <img class="rounded-circle"
                                    src="{{$review->client->image}}"
                                    width="60"
                                    height="60">

                                                                                      </div>
                            </div>



                </div>
                <div class="tab-content">

                    <div role="tabpanel" class="tab-pane active" id="information">
                       <h5> {{ trans('main_trans.consultant_data') }}</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="col-group">
                                      <label for="" class="font-weight-bold">{{ trans('main_trans.job_title') }}:</label>
                                      <span>{{ $review->consultant->job_title }}</span>
                                  </div>
                              </div>

                            <div class="col-md-6">
                              <div class="col-group">
                                    <label for="" class="font-weight-bold">{{ trans('main_trans.user_name') }}:</label>
                                    <span>{{ $review->consultant->name }}</span>
                                </div>
                            </div>


                            <div class="col-md-6">
                                  <div class="col-group">

                                    <label for="" class="font-weight-bold">{{ trans('main_trans.email') }}:</label>
                                    <span>{{ $review->consultant->email }}</span>
                                   </div>
                            </div>

                            <div class="col-md-6">
                                  <div class="col-group">
                                    <label for="" class="font-weight-bold">{{ trans('main_trans.phone') }} :</label>
                                                                                        <span>{{ $review->consultant->phone_number }}</span>
                                                                               </div>
                            </div>



                            <div class="col-md-6">
                                  <div class="col-group">
                                    <label for="" class="font-weight-bold">{{ trans('main_trans.avatar') }} :</label>
                                    <img class="rounded-circle"
                                    src="{{$review->consultant->image}}"
                                    width="60"
                                    height="60">

                                                                                      </div>
                            </div>


                            <div class="col-md-6">
                                <div class="col-group">

                                  <label for="" class="font-weight-bold">{{ trans('main_trans.rate') }}:</label>
                                  <span>{{ $review->consultant->rate }}</span>
                                 </div>
                          </div>
                </div>
                <div class="tab-content">

                    <div role="tabpanel" class="tab-pane active" id="information">
                       <h5> {{ trans('main_trans.files') }}</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="col-group">
                                    @php
                                    $files = json_decode($review->building_files, true);
                                    @endphp
                                    @foreach ($files as $file)
                                    <a href="{{$file}}" class="btn btn-primary" target="_blank">{{ trans('main_trans.show') }}</a>
                                    @endforeach

                                    {{-- <a href="{{'http://127.0.0.1:8000/reviews_files/'. json_decode($review->building_files, true)}}" class="btn btn-primary">{{ trans('main_trans.show') }}</a> --}}
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
