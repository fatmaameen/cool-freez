@extends('MainDashboard.layouts.master')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
<style>.circular-link {
    display: inline-block;
    width: 40px; /* يمكنك ضبط العرض حسب رغبتك */
    height: 40px; /* يمكنك ضبط الارتفاع حسب رغبتك */
    line-height: 40px; /* يجعل النص والأيقونة في منتصف العنصر */
    border-radius: 50%; /* يجعل العنصر دائري الشكل */
    background-color: lightblue; /* لون الخلفية اللبني */
    color: rgb(17, 17, 17); /* لون النص والأيقونة */
    text-align: center; /* محاذاة النص والأيقونة في الوسط */
    text-decoration: none; /* لإزالة أي خطوط تحتية من الرابط */
}
.button-container {
    text-align: center; /* لمحاذاة العنصر إلى اليمين داخل العنصر */
}
body {
    overflow-x: hidden; /* لإخفاء شريط التمرير الأفقي فقط */
    overflow-y: auto; /* السماح بظهور شريط التمرير الرأسي عند الحاجة */
}

/* إضافة تأثير التحويم (hover) لتحسين التصميم */
.circular-link {
    margin-right: 40px; /* تضيف مساحة على اليمين */
}


</style>
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
                     <h5 style="background-color: #91c5d0; color: white; text-align: center; padding: 10px; margin: 10px auto; width: 100%;">{{ trans('main_trans.client_data') }}</h5>


                     <table class="table table-bordered  w-100">
                        <thead class="bg-light">
                            <tr>


                                <th scope="col">{{ trans('main_trans.user_name') }}</th>
                                <th scope="col">{{ trans('main_trans.email') }}</th>
                                <th scope="col">{{ trans('main_trans.phone') }}</th>
                                <th scope="col">{{ trans('main_trans.address') }}</th>
                                <th scope="col">{{ trans('main_trans.avatar') }}</th>

                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td scope="row">{{ $review->client->name }}</td>
                                <td scope="row">{{ $review->client->email }}</td>
                                <td scope="row">{{ $review->client->phone_number }}</td>
                                <td scope="row">{{ $review->client->address }}</td>
                                <td scope="row"> <img class="rounded-circle"
                                    src="{{$review->client->image}}"
                                    width="60"
                                    height="60"></td>

                    </tr>

                </tbody>
            </table>

                    </div>
                </div>
                <div class="tab-content">

                    <div role="tabpanel" class="tab-pane active" id="information">
                        <h5 style="background-color:#91c5d0; color: white; text-align: center; padding: 10px; margin: 10px auto; width: 100%;">{{ trans('main_trans.consultant_data') }}</h5>
                        <table class="table table-bordered  w-100">
                            <thead class="bg-light">
                                <tr>

                                    <th scope="col">{{ trans('main_trans.job_title') }}</th>
                                    <th scope="col">{{ trans('main_trans.user_name') }}</th>
                                    <th scope="col">{{ trans('main_trans.email') }}</th>
                                    <th scope="col">{{ trans('main_trans.phone') }}</th>
                                    <th scope="col">{{ trans('main_trans.rate') }}</th>
                                    <th scope="col">{{ trans('main_trans.avatar') }}</th>

                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td scope="row">{{  $review->consultant->job_title}}</td>
                                    <td scope="row">{{ $review->consultant->name }}</td>
                                    <td scope="row">{{ $review->consultant->email }}</td>
                                    <td scope="row">{{ $review->consultant->phone_number }}</td>
                                    <td scope="row">{{ $review->consultant->rate }}</td>
                                    <td scope="row"> <img class="rounded-circle"
                                        src="{{$review->consultant->image}}"
                                        width="60"
                                        height="60"></th>

                        </tr>

                    </tbody>
                </table>
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

                                                @if($files)
                    @foreach ($files as $file)
                        <a href="{{$file}}" class="circular-link" target="_blank">
                            <i class="fa-solid fa-file"></i>
                        </a>
                    @endforeach
                @else
                    <p>Dont have files...</p>
                @endif



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
