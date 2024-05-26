@extends('MainDashboard.layouts.master')

@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<style>
    .form-select {
        width: 100%;
        font-size: 16px;
    }
    body {
        overflow-x: hidden;
        overflow-y: auto;
    }
    .blue-button {
        background-color: #94deec;
        color: rgb(19, 18, 18);
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
    }
    .modal-content {
        border-radius: 10px;
        padding: 20px;
    }
    .form-group {
        margin-bottom: 15px;
    }
    .btn-primary {
        background-color: #007bff;
        border: none;
    }
    .btn-secondary {
        background-color: #6c757d;
        border: none;
    }
    .table-bordered {
        border-color: #ADD8E6;
    }
    .table-bordered th,
    .table-bordered td {
        border-color: #ADD8E6;
    }
    thead.bg-light {
        background-color: #E0F7FA;
    }
</style>
@endsection

@section('title')
{{ trans('main_trans.offers') }}
@stop

@section('page-header')
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{ trans('main_trans.offers') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="default-color">{{ trans('main_trans.Dashboard') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('main_trans.offers') }}</li>
            </ol>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="container-fluid">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <button type="button" class="blue-button" data-bs-toggle="modal" data-bs-target="#createUserModal">
                                <i class="fa-solid fa-plus"></i> {{ trans('main_trans.create') }}
                            </button>
                        </div>
                    </div>
                    <table class="table table-bordered w-100">
                        <thead class="bg-light">
                            <tr>
                                <th>#</th>
                                <th>{{ trans('main_trans.offer_image') }}</th>
                                <th>{{ trans('main_trans.offer_type') }}</th>
                                <th>{{ trans('main_trans.offer_link') }}</th>
                                <th>{{ trans('main_trans.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($offers as $offer)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>
                                    <img class="rounded-circle" src="{{ $offer->offer }}" width="60" height="60">
                                </td>
                                <td>{{ $offer->type }}</td>
                                <td>{{ $offer->link }}</td>
                                <td>
                                    <a href="#editModal{{ $offer->id }}" data-bs-toggle="modal"><i class="fas fa-pen-to-square fa-2xl"></i></a>
                                    <a href="#" class="btn btn-danger" onclick="openDeleteModal('{{ $offer->id }}')"><i class="fa-solid fa-trash-can"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="createUserModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createUserModalLabel">{{ trans('main_trans.create') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('offer.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                    <h5> <label for="offer">{{ trans('main_trans.offer_image') }}</label></h5>
                        <input type="file" class="form-control" id="offer" name="offer">
                    </div>
                    <div class="form-group">
                        <h5> <label for="link">{{ trans('main_trans.offer_link') }}</label></h5>
                        <input type="url" class="form-control" id="link" name="link">
                    </div>
                    <div class="form-group">
                        <h5> <label for="type">{{ trans('main_trans.offer_type') }}</label></h5>
                        <select id="type" class="form-select form-select-sm" name="type" aria-label="Small select example">
                            <option value="Latest Offers">Latest Offers</option>
                            <option value="Limited Offers">Limited Offers</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ trans('main_trans.close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ trans('main_trans.save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@foreach ($offers as $offer)
<div class="modal fade" id="editModal{{ $offer->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $offer->id }}" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel{{ $offer->id }}">{{ trans('main_trans.edit') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('offer.update', $offer->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <h5> <label for="offer">{{ trans('main_trans.offer_image') }}</label></h5>
                        <input type="file" class="form-control" id="offer" name="offer" value="{{ $offer->offer }}">
                    </div>
                    <div class="form-group">
                        <h5> <label for="link">{{ trans('main_trans.offer_link') }}</label></h5>
                        <input type="url" class="form-control" id="link" name="link" value="{{ $offer->link }}">
                    </div>
                    <div class="form-group">
                        <h5>  <label for="type">{{ trans('main_trans.offer_type') }}</label></h5>
                        <select id="type" class="form-select form-select-sm" name="type" aria-label="Small select example">
                            <option value="Latest Offers" {{ $offer->type == 'Latest Offers' ? 'selected' : '' }}>Latest Offers</option>
                            <option value="Limited Offers" {{ $offer->type == 'Limited Offers' ? 'selected' : '' }}>Limited Offers</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ trans('main_trans.close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ trans('main_trans.save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal{{ $offer->id }}" data-bs-backdrop="static" tabindex="-1" aria-labelledby="deleteModalLabel{{ $offer->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel{{ $offer->id }}"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('offer.delete', $offer->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <h5>{{ trans('main_trans.delete_text') }}</h5>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ trans('main_trans.close') }}</button>
                        <button type="submit" class="btn btn-danger">{{ trans('main_trans.delete') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script>
    function openDeleteModal(offerId) {
        var deleteModalId = '#deleteModal' + offerId;
        $(deleteModalId).modal('show');
    }
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5+YE5O9wSFj/zIy4GfDMVNA/GpGFF93hXpG5KkN+" crossorigin="anonymous"></script>
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
            toastr.error(message);
            var audio = new Audio('audio.mp3');
            audio.play();
            break;
    }
    @endif
</script>
@endsection
