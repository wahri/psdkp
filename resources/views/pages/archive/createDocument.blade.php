@extends('layouts.app')

@section('title', 'PSDKP | USERS')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        {{-- <h1 class="m-0">tes</h1> --}}
                        <a href="/dashboard/archive/{{ $documentType->id }}" class="btn btn-secondary"><i
                                class="fas fa-arrow-left" aria-hidden="true"></i></a>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Archive Management</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <form>
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">{{ $documentType->name }}</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <div class="card-body">
                                    @foreach ($inputFormat as $input)
                                        @if ($input->type == 'text')
                                            <div class="form-group">
                                                <label for="{{ $input->id }}">{{ $input->name }}</label>
                                                <input type="text" class="form-control" id="{{ $input->id }}">
                                            </div>
                                        @elseif($input->type == 'date')
                                            {{-- <div class="form-group">
                                                <label for="{{ $input->id }}">{{ $input->name }}</label>
                                                <input type="date" class="form-control" id="{{ $input->id }}">
                                            </div> --}}
                                            <div class="form-group">
                                                <label>{{ $input->name }}</label>
                                                <div class="input-group date" id="reservationdate"
                                                    data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input"
                                                        data-target="#reservationdate" />
                                                    <div class="input-group-append" data-target="#reservationdate"
                                                        data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>

                                        @endif
                                    @endforeach
                                    <div class="form-group">
                                        <label for="exampleInputFile">Upload Document</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="exampleInputFile">
                                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text">Upload</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content -->
    </div>
@endsection

{{-- THIS SCRIPT ONLY RENDER FOR THIS PAGE --}}
@push('script')

@endpush


{{-- THIS STYLE ONLY RENDER FOR THIS PAGE --}}
@push('style')

@endpush
