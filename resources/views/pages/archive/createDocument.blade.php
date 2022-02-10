@extends('layouts.app')

@section('title', 'PSDKP | Tambah Dokumen')

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
                        <form action="{{ route('dashboard.archive.store.document') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">{{ $documentType->name }}</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <div class="card-body">
                                    <input type="hidden" name="document_type_id" value="{{ $documentType->id }}">
                                    @foreach ($inputFormat as $input)
                                        <input type="hidden" name="input_format_id[]" value="{{ $input->id }}">
                                        @if ($input->type == 'text')
                                            <div class="form-group">
                                                <label for="{{ $input->id }}">{{ $input->name }}</label>
                                                <input type="text" class="form-control" name="value[]"
                                                    id="{{ $input->id }}">
                                            </div>
                                        @elseif($input->type == 'date')
                                            <div class="form-group">
                                                <label>{{ $input->name }}</label>
                                                <div class="input-group date" id="reservationdate"
                                                    data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input"
                                                        name="value[]" data-target="#reservationdate" />
                                                    <div class="input-group-append" data-target="#reservationdate"
                                                        data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>

                                        @endif
                                    @endforeach
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="">Room</label>
                                                <select class="form-control" name="room_id" id="rooms">
                                                    <option hidden>Pilih Ruangan</option>
                                                    @foreach ($rooms as $eachRoom)
                                                        <option value="{{ $eachRoom->id }}">{{ $eachRoom->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="">Locker</label>
                                                <select class="form-control" name="locker_id" id="lockers">
                                                    <option hidden>Pilih Locker</option>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="">Racks</label>
                                                <select class="form-control" name="rack_id" id="racks">
                                                    <option hidden>Pilih Rak</option>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="">Boxes</label>
                                                <select class="form-control" name="box_id" id="boxes">
                                                    <option hidden>Pilih Box</option>
                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fileDocument">Upload Document</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="fileDocument"
                                                    name="fileDocument">
                                                <label class="custom-file-label" for="fileDocument">Choose file</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text">Upload</span>
                                            </div>
                                        </div>
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
    <script>
        $(function() {

            $('#rooms').on('change', () => {
                var id = $('#rooms').val()
                $.ajax({
                    url: `{{ route('dashboard.archive.get.lockers', ['']) }}/${id}`,
                    type: "GET",
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    dataType: "JSON",
                    success: function(res) {
                        $('#lockers')
                            .find('option')
                            .remove()
                            .end()

                        $('#lockers').append($('<option>', {
                            value: '',
                            text: 'Pilih Locker',
                            hidden: true
                        }));
                        $.each(res.data, function(i, val) {
                            $('#lockers').append($('<option>', {
                                value: val.id,
                                text: val.code
                            }));
                        });
                    }
                });
            })

            $('#lockers').on('change', () => {
                var id = $('#lockers').val()
                $.ajax({
                    url: `{{ route('dashboard.archive.get.racks', ['']) }}/${id}`,
                    type: "GET",
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    dataType: "JSON",
                    success: function(res) {
                        $('#racks')
                            .find('option')
                            .remove()
                            .end()

                        $('#racks').append($('<option>', {
                            value: '',
                            text: 'Pilih Rak',
                            hidden: true
                        }));

                        $.each(res.data, function(i, val) {
                            $('#racks').append($('<option>', {
                                value: val.id,
                                text: val.code
                            }));
                        });
                    }
                });
            })
            $('#racks').on('change', () => {
                var id = $('#racks').val()
                $.ajax({
                    url: `{{ route('dashboard.archive.get.boxes', ['']) }}/${id}`,
                    type: "GET",
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    dataType: "JSON",
                    success: function(res) {
                        $('#boxes')
                            .find('option')
                            .remove()
                            .end()

                        $('#boxes').append($('<option>', {
                            value: '',
                            text: 'Pilih Box',
                            hidden: true
                        }));

                        $.each(res.data, function(i, val) {
                            $('#boxes').append($('<option>', {
                                value: val.id,
                                text: val.code
                            }));
                        });
                    }
                });
            })

            $('input[type=file]').on('change', () => {
                var filename = $('input[type=file]').val().split('\\').pop();
                console.log(filename);
                $('label[for=fileDocument]').text(filename)
            })

        })
    </script>
@endpush


{{-- THIS STYLE ONLY RENDER FOR THIS PAGE --}}
@push('style')

@endpush
