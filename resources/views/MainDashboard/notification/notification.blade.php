@extends('MainDashboard.layouts.master')

@section('css')
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.min.css" rel="stylesheet" />
    <style>
        body {
            overflow-x: hidden;
            /* لإخفاء شريط التمرير الأفقي فقط */
            overflow-y: auto;
            /* السماح بظهور شريط التمرير الرأسي عند الحاجة */
        }

        .blue-button {
            background-color: #94deec;
            /* لتغيير لون الخلفية إلى الأزرق */
            color: rgb(19, 18, 18);
            /* لتغيير لون النص إلى الأبيض */
            border: none;
            /* لإزالة الحدود */
            padding: 10px 20px;
            /* يمكنك تعديل حجم الوسادة */
            border-radius: 5px;
            /* يمكنك تعديل نصف القطر للإطار */
            cursor: pointer;
            /* لإظهار مؤشر اليد */
        }
    </style>
    <style>
        .form-select {
            width: 100%;
            /* يجعل العرض 100% من حجم الحاوية */
            font-size: 16px;
            /* لتكبير حجم النص داخل العنصر */
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        /* Customize the table's border color and row colors */
        .table-bordered {
            border-color: #12aee2;
            /* Light blue */
        }

        .table-bordered th,
        .table-bordered td {
            border-color: #12aee2;
            /* Light blue */
        }

        /* Customize the header background color */
        thead.bg-light {
            background-color: #21dff8;
            /* Light cyan */
        }
    </style>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
@endsection

@section('title')
    {{ trans('main_trans.notification') }}
@stop

@section('page-header')
    <!-- breadcrumb -->
    {{-- <div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{ trans('main_trans.profile') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="default-color">{{ trans('main_trans.Dashboard')}}</a></li>
                <li class="breadcrumb-item active">{{ trans('main_trans.profile') }}</li>
            </ol>
        </div>
    </div>
</div> --}}
    <!-- breadcrumb -->
@endsection
@section('content')
<style>
    .parent-container {
        display: flex;
        justify-content: center;
    }
    .container{
        margin-left: 100px !important;
    }
</style>
<body>
<div class="parent-container">
    <div class="container" style="margin: 0 auto;">
        <div role="tabpanel" class="tab-pane active" id="information">
            <h5 style="background-color: #91c5d0; color: white; text-align: center; padding: 10px; margin: 10px auto; width: 100%;">
                {{ trans('main_trans.notification') }}
            </h5>
            <div class="card card-statistics h-70">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-6">
                            <form action="{{ route('notifications') }}" method="POST">
                                @csrf <!-- Laravel CSRF protection -->

                                <!-- Title input -->
                                <div data-mdb-input-init class="form-outline mb-4">
                                    <input type="text" id="form4Example1" name="title" class="form-control" required />
                                    <label class="form-label" for="form4Example1">Title</label>
                                </div>

                                <!-- Message input -->
                                <div data-mdb-input-init class="form-outline mb-4">
                                    <textarea class="form-control" id="form4Example3" name="message" rows="4" required></textarea>
                                    <label class="form-label" for="form4Example3">Message</label>
                                </div>

                                <!-- Submit button -->
                                <button data-mdb-ripple-init type="submit" class="btn btn-primary btn-block mb-4">Send</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

@endsection
@section('js')
    <script>
        // Initialization for ES Users
        import {
            Input,
            Ripple,
            initMDB
        } from "mdb-ui-kit";

        initMDB({
            Input,
            Ripple
        });
    </script>
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.umd.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" --}}
    {{-- integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"> --}}
    {{-- </script> --}}

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script> --}}

    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'error') }}";
            toastr.options.timeOut = 10000;
            var message = "{{ Session::get('message') }}";

            switch (type) {
                case 'info':
                    toastr.info(message);
                    break;
                case 'success':
                    toastr.success(message);
                    break;
                case 'warning':
                    toastr.warning(message);
                    break;
                case 'error':
                    toastr.error(message); // هنا قمنا بتغيير اللون إلى الأحمر في حالة الخطأ
                    var audio = new Audio('audio.mp3');
                    audio.play();
                    break;
            }
        @endif
    </script>


@endsection
