@extends('CompanyDashboard.layouts.master')

@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>
    .blue-button {
        background-color: #94deec; /* لتغيير لون الخلفية إلى الأزرق */
        color: rgb(19, 18, 18); /* لتغيير لون النص إلى الأبيض */
        border: none; /* لإزالة الحدود */
        padding: 10px 20px; /* يمكنك تعديل حجم الوسادة */
        border-radius: 5px; /* يمكنك تعديل نصف القطر للإطار */
        cursor: pointer; /* لإظهار مؤشر اليد */
    }
</style>
<style>
    .form-select {
        width: 100%; /* يجعل العرض 100% من حجم الحاوية */
        font-size: 16px; /* لتكبير حجم النص داخل العنصر */
    }
</style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<style>/* Customize the table's border color and row colors */
.table-bordered {
    border-color: #12aee2; /* Light blue */
}

.table-bordered th,
.table-bordered td {
    border-color: #12aee2; /* Light blue */
}

/* Customize the header background color */
thead.bg-light {
    background-color: #21dff8; /* Light cyan */
}
</style>
{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
@endsection

@section('title')
      {{ trans('main_trans.profile') }}
@stop

@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
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
</div>
<!-- breadcrumb -->
@endsection
@section('content')
    <div class="container">
        <!-- Profile Information -->
        <div role="tabpanel" class="tab-pane active" id="information">
            <h5 style="background-color: #91c5d0; color: white; text-align: center; padding: 10px; margin: 10px auto; width: 100%;">{{ trans('main_trans.profile') }}</h5>
            <div class="card card-statistics h-70">
                <div class="card-body">
                    <!-- Profile Form -->
                    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf <!-- Add CSRF token -->

                        <!-- Profile Details -->
                        <fieldset>
                            <!-- User Name -->
                            <div class="form-group row">
                                <label class="col-5 control-label">{{ trans('main_trans.user_name') }}</label>
                                <div class="col-7">
                                    <input type="text" class="col-6 form-control" name="name" value="{{ $user->name }}">
                                </div>
                            </div>
                            <!-- Email -->
                            <div class="form-group row width-50">
                                <label class="col-5 control-label">{{ trans('main_trans.email') }}</label>
                                <div class="col-7">
                                    <input type="email" class="col-6 form-control" name="email" value="{{ $user->email }}">
                                </div>
                            </div>
                            <div class="form-group row width-50">
                                <label class="col-5 control-label">{{ trans('main_trans.password') }}</label>
                                <div class="col-7">
                                    <input type="password" class="col-6 form-control" name="password">
                                </div>
                            </div>
                            <!-- Phone Number -->
                            <div class="form-group row width-50">
                                <label class="col-5 control-label">{{ trans('main_trans.phone') }}</label>
                                <div class="col-7">
                                    <input type="number" class="col-6 form-control" name="phone_number" value="{{ $user->phone_number }}">
                                </div>
                            </div>
                            <!-- Avatar -->
                            <div class="form-group row width-50">
                                <label class="col-5 control-label">{{ trans('main_trans.avatar') }}</label>
                                <div class="col-7">
                                    <input type="file" class="col-6 form-control" name="image">
                                    <!-- Display current image if available -->
                                    @if($user->image)
                                        <img src="{{ $user->image }}" alt="Avatar" style="max-width: 100px;">
                                    @else
                                        <!-- Placeholder image if no image is available -->
                                        <img src="{{ asset('placeholder-image.jpg') }}" alt="Avatar" style="max-width: 100px;">
                                    @endif
                                </div>
                            </div>
                        </fieldset>

                        <!-- Action Buttons -->
                        <div class="form-group col-12 text-center btm-btn">
                            <button type="submit" class="btn btn-primary save_user_btn"><i class="fa fa-save"></i> {{ trans('main_trans.save') }}</button>
                        </div>
                    </form>

            </div>
        </div>
    </div>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

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
