@extends('MainDashboard.layouts.master')
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
        }

        .button-container {
            text-align: center;
        }

        body {
            overflow-x: hidden;
            overflow-y: auto;
        }

        .circular-link {
            margin-right: 40px;
        }

        .tab-content {
            font-size: 1.2rem;
            margin-bottom: 20px;
            line-height: 1.6;
        }

        .col-group,
        .col-md-6 {
            line-height: 1.6;
        }

        .parent-container {
            display: flex;
            justify-content: center;
        }

        .container {
            margin-left: 100px !important;
        }
    </style>
@endsection

@section('title')
    {{ trans('main_trans.notification') }}
@stop

@section('page-header')

@endsection

@section('content')
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
                                <div class="form-group mb-4">
                                    <label class="form-label" for="form4Example1"> {{ trans('main_trans.Title') }}</label>
                                    <input type="text" id="form4Example1" name="title" class="form-control" required />
                                </div>

                                <!-- Message input -->
                                <div class="form-group mb-4">
                                    <label class="form-label" for="form4Example3">{{ trans('main_trans.massage') }}</label>
                                    <textarea class="form-control" id="form4Example3" name="message" rows="4" required></textarea>
                                </div>

                                <!-- Submit button -->
                                <button type="submit" class="btn btn-primary btn-block mb-4">{{trans('main_trans.send')}}</button>
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
                    toastr.error(message);
                    var audio = new Audio('audio.mp3');
                    audio.play();
                    break;
            }
        @endif
    </script>

    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.umd.min.js"></script>
@endsection
