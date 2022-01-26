@extends('layouts.app')

@section('title', 'PSDKP | USER')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6 d-flex">
                        <a href="{{ route('dashboard.storage.index') }}" class="btn btn-secondary"><i
                                class="fas fa-arrow-left"></i></a>
                        <h1 class="ml-3">Kelola Tempat Penyimpanan</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">
                            {{ $room->name }}
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <button type="button" class="btn btn-success btn-sm mb-4" data-toggle="modal"
                                    data-target="#addLockerModal">
                                    <i class="fas fa-plus mr-2"></i> Tambah Locker
                                </button>
                                <div class="row">
                                    @foreach ($locker as $eachLocker)
                                        <div class="col-6">
                                            <div class="card">
                                                <div class="card-header text-center bg-dark">
                                                    <h3 class="card-title">Locker {{ $eachLocker->code }}</h3>
                                                </div>
                                                <!-- /.card-header -->
                                                <div class="card-body">
                                                    <!-- we are adding the accordion ID so Bootstrap's collapse plugin detects it -->
                                                    <div id="accordion{{ $eachLocker->id }}">
                                                        @foreach ($eachLocker->racks as $eachRack)
                                                            <div class="card card-info">
                                                                <div class="card-header">
                                                                    <h4 class="card-title w-100">
                                                                        <a class="d-block w-100" data-toggle="collapse"
                                                                            href="#collapseRacksId{{ $eachRack->id }}">
                                                                            Rak {{ $eachRack->code }}
                                                                        </a>
                                                                    </h4>
                                                                </div>
                                                                <div id="collapseRacksId{{ $eachRack->id }}"
                                                                    class="collapse"
                                                                    data-parent="#accordion{{ $eachLocker->id }}">
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            @foreach ($eachRack->boxes as $eachBox)
                                                                                <div class="col-6">
                                                                                    <div class="info-box">
                                                                                        <span
                                                                                            class="info-box-icon bg-info elevation-1"><i
                                                                                                class="fas fa-cog"></i></span>

                                                                                        <div class="info-box-content">
                                                                                            <span
                                                                                                class="info-box-text">{{ $eachBox->code }}</span>
                                                                                            <span class="info-box-number">
                                                                                                10
                                                                                                <small>Dokumen</small>
                                                                                            </span>
                                                                                        </div>
                                                                                        <!-- /.info-box-content -->
                                                                                    </div>
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                        <button type="button" class="btn btn-block btn-success"
                                                        data-toggle="modal" data-target="#addBoxModal"
                                                        data-id="{{ $eachRack->id }}">
                                                        <i class="fas fa-plus"></i> Tambah Box
                                                    </button>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <button type="button" class="btn btn-block btn-success"
                                                        data-toggle="modal" data-target="#addRackModal"
                                                        data-id="{{ $eachLocker->id }}">
                                                        <i class="fas fa-plus"></i> Tambah Rak
                                                    </button>
                                                </div>
                                                <!-- /.card-body -->
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>

    {{-- add locker modal --}}
    <form action="{{ route('dashboard.storage.create.room.locker', $room->id) }}" id="addLockerForm" method="post">
        @csrf
        <div class="modal fade" id="addLockerModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">New Locker</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="code">Nama Locker :</label>
                                    <input id="code" type="text" name="code" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </form>


    {{-- add rack modal --}}
    <form action="{{ route('dashboard.storage.create.room.locker.rack') }}" id="addRackForm" method="post">
        @csrf
        <div class="modal fade" id="addRackModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">New Rack</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="codeRack">Nama Rak :</label>
                                    <input id="codeRack" type="text" name="code" class="form-control">
                                </div>
                                <div class="form-group">
                                <input id="locker_id" type="hidden" name="locker_id" class="form-control" value="">
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </form>

    {{-- add box modal --}}
    <form action="{{ route('dashboard.storage.create.room.locker.rack.box') }}" id="addBoxForm" method="post">
        @csrf
        <div class="modal fade" id="addBoxModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">New Box</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="codeBox">Nama Box :</label>
                                    <input id="codeBox" type="text" name="code" class="form-control">
                                </div>
                                <div class="form-group">
                                <input id="rack_id" type="hidden" name="rack_id" class="form-control" value="">
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </form>

@endsection

{{-- THIS SCRIPT ONLY RENDER FOR THIS PAGE --}}
@push('script')
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script>
        $(function() {
            let addLockerModal = $("div#addLockerModal");
            let addRackModal = $("div#addRackModal");
            let addBoxModal = $("div#addBoxModal");
            let editUserModal = $("div#editUserModal");
            let addLockerForm = $("form#addLockerForm");
            let addRackForm = $("form#addRackForm");
            let addBoxForm = $("form#addBoxForm");
            let editUserForm = $("form#editUserForm");

            addRackModal.on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                var locker_id = button.data('id')
                console.log(locker_id)
                var modal = $(this)
                modal.find('.modal-body input#locker_id').val(locker_id)
            })

            addBoxModal.on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                var rack_id = button.data('id')
                console.log(rack_id)
                var modal = $(this)
                modal.find('.modal-body input#rack_id').val(rack_id)
            })

            //submit form action
            addLockerForm.on("submit", function(event) {
                event.preventDefault();
                let form = $(this);
                let url = $(this).attr("action");
                let data = $(this).serialize();

                $.ajax({
                    url: url,
                    type: "POST",
                    data: data,
                    dataType: "JSON",
                    success: function(res) {
                        showNotification(res.message, "success", 3000);
                        // userListTable.ajax.reload();
                        // addLockerModal.modal("toggle");
                        form[0].reset();
                        location.reload();
                    },
                    error: function(res) {
                        let data = res.responseJSON;
                        showNotification(data.message, "error", 3000);
                    }
                })


            })

            addRackForm.on("submit", function(event) {
                event.preventDefault();
                let form = $(this);
                let url = $(this).attr("action");
                var code = $('#codeRack').val();
                let data = $(this).serialize();

                $.ajax({
                    url: url,
                    type: "POST",
                    data: data,
                    dataType: "JSON",
                    success: function(res) {
                        showNotification(res.message, "success", 3000);
                        // userListTable.ajax.reload();
                        // addRackModal.modal("toggle");
                        form[0].reset();
                        location.reload();
                    },
                    error: function(res) {
                        let data = res.responseJSON;
                        showNotification(data.message, "error", 3000);
                    }
                })


            })

            addBoxForm.on("submit", function(event) {
                event.preventDefault();
                let form = $(this);
                let url = $(this).attr("action");
                let data = $(this).serialize();

                $.ajax({
                    url: url,
                    type: "POST",
                    data: data,
                    dataType: "JSON",
                    success: function(res) {
                        showNotification(res.message, "success", 3000);
                        // userListTable.ajax.reload();
                        // addRackModal.modal("toggle");
                        form[0].reset();
                        location.reload();
                    },
                    error: function(res) {
                        let data = res.responseJSON;
                        showNotification(data.message, "error", 3000);
                    }
                })


            })


            editUserForm.on("submit", function(event) {
                event.preventDefault();
                let form = $(this);
                let url = $(this).attr("action");
                let data = $(this).serialize();

                $.ajax({
                    url: url,
                    type: "PUT",
                    data: data,
                    dataType: "JSON",
                    success: function(res) {
                        showNotification(res.message, "success", 3000);
                        userListTable.ajax.reload();
                        editUserModal.modal("toggle");
                        form[0].reset();
                    },
                    error: function(res) {
                        let data = res.responseJSON;
                        showNotification(data.message, "error", 3000);
                    }
                })


            })


            //delete button action
            $(document).on("click", "table#userListTable button[name='delete']", function() {
                let id = $(this).attr('data-id');

                Swal.fire({
                    title: 'Apakah kamu yakin?',
                    text: "klik yes untuk menghapus akun.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `{{ route('dashboard.user.destroy', ['']) }}/${id}`,
                            type: "DELETE",
                            headers: {
                                'X-CSRF-TOKEN': "{{ csrf_token() }}"
                            },
                            dataType: "JSON",
                            success: function(res) {
                                userListTable.ajax.reload();
                                showNotification(res.message, "success", 3000);
                            },
                            error: function(res) {
                                let data = res.responseJSON;
                                showNotification(data.message, "error", 3000);
                            }
                        })
                    }
                })
            })


            //edit button action
            $(document).on("click", "table#userListTable button[name='edit']", function() {
                let id = $(this).attr('data-id');

                $.ajax({
                    url: `{{ route('dashboard.user.show', ['']) }}/${id}`,
                    type: "GET",
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    dataType: "JSON",
                    success: function(res) {
                        let data = res.data;
                        editUserModal.find("input[name='name']").val(data.name);
                        editUserModal.find("input[name='username']").val(data.username);
                        editUserModal.find("input[name='password']").val("");
                        editUserModal.find("input[name='password_confirm']").val("");

                        editUserModal.find("select[name='role'] option").each(function() {
                            if (data.roles[0].name == $(this).val()) {
                                $(this).attr("selected", true);
                            } else {
                                $(this).removeAttr("selected");
                            }
                        })
                        editUserModal.modal("toggle");
                        editUserForm.attr("action",
                            `{{ route('dashboard.user.update', ['']) }}/${id}`)
                    }
                });
            });


        });
    </script>
@endpush


{{-- THIS STYLE ONLY RENDER FOR THIS PAGE --}}
@push('style')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush
