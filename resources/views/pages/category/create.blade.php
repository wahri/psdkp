@extends('layouts.app')

@section('title', 'PSDKP | USERS')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Create Category</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Starter Page</li>
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
                <div class="col-lg-12">
                    <div class="card">
                        <form>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" class="form-control" placeholder="Judul Kategori" autofocus>
                                </div>
                                <div id="fieldInput">
                                    <div class="row">
                                        <div class="col">
                                            <input type="text" class="form-control" placeholder="Nama Kolom">
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control" placeholder="Informasi Kolom">
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <select class="form-control" name="tipe_kolom">
                                                    <option hidden>Tipe Kolom</option>
                                                    <option>Text</option>
                                                    <option>File</option>
                                                    <option value="master">Judul Master</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <button type="button" class="btn btn-primary btn-block">
                                                <i class="fas fa-plus"></i> Sub item
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <button type="button" class="btn btn-primary btn-block" id="add">
                                            <i
                                                class="fas fa-plus"></i> Tambah Kolom
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
</div>
@endsection

{{-- THIS SCRIPT ONLY RENDER FOR THIS PAGE --}}
@push('script')
<script>
    $(document).ready(function() {
            $("#add").click(function() {
                var lastField = $("#buildyourform div:last");
                var intId = (lastField && lastField.length && lastField.data("idx") + 1) || 1;
                var fieldWrapper = $("<div class=\"row\" id=\"field" + intId + "\"/>");
                fieldWrapper.data("idx", intId);
                var colWrapper = 
                var input = `<div class="col-4">
                                    <input type="text" class="form-control" placeholder="Field Name">
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <select class="form-control">
                                            <option hidden>Select Type</option>
                                            <option>option 2</option>
                                            <option>option 3</option>
                                            <option>option 4</option>
                                            <option>option 5</option>
                                        </select>
                                    </div>
                                </div>
                                `
                var removeButtonWrapper = $(`<div class="col-2">
                                </div>`)
                var removeButton = $(
                    "<button type=\"button\" class=\"btn btn-danger remove\" /><i class=\"fas fa-minus\"></i></button>"
                );
                removeButton.click(function() {
                    $(this).closest('.row').remove();
                });
                fieldWrapper.append(input);
                removeButtonWrapper.append(removeButton)
                fieldWrapper.append(removeButtonWrapper);
                $("#fieldInput").append(fieldWrapper);
            });
        });
</script>
@endpush


{{-- THIS STYLE ONLY RENDER FOR THIS PAGE --}}
@push('style')

@endpush