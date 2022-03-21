<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Pengarsipan PSDKP</title>

    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

    {{-- datatable --}}
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>

<body class="hold-transition layout-top-nav">
    <nav class="navbar navbar-expand-lg fixed-top navbar-scroll">
        <div class="container-fluid">
            <button class="navbar-toggler ps-0" type="button" data-mdb-toggle="collapse"
                data-mdb-target="#navbarExample01" aria-controls="navbarExample01" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon d-flex justify-content-start align-items-center">
                    <i class="fas fa-bars"></i>
                </span>
            </button>
            <div class="collapse navbar-collapse" id="navbarExample01">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link" aria-current="page" href="{{ route('login') }}">Login</a>
                    </li>
                </ul>

                <ul class="navbar-nav flex-row">
                    {{-- <!-- Icons -->
                    <li class="nav-item">
                        <a class="nav-link pe-2" href="https://www.youtube.com/channel/UC5CF7mLQZhvx8O5GODZAhdA"
                            rel="nofollow" target="_blank">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-2" href="https://www.facebook.com/mdbootstrap" rel="nofollow"
                            target="_blank">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-2" href="https://twitter.com/MDBootstrap" rel="nofollow" target="_blank">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link ps-2" href="https://github.com/mdbootstrap/mdb-ui-kit" rel="nofollow"
                            target="_blank">
                            <i class="fab fa-github"></i>
                        </a>
                    </li> --}}
                </ul>
            </div>
        </div>
    </nav>
    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper home-page">
            <!-- Main content -->
            <section class="content">
                <div class="container my-5">
                    <div class="row mb-3">
                        <div class="col-12 text-center">
                            <img src="{{ asset('img/logo_psdkp.png') }}" alt="AdminLTE Logo"
                                class="img-circle elevation-3" width="5%">
                            <h1 class="text-light">PSDKP Batam</h1>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-12">

                            <div class="card">
                                <div class="card-body">
                                    <form action="">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Pilih Kategori Surat</label>
                                                    <select class="form-control select2bs4" name="kategori"
                                                        onchange="submit()">
                                                        <option selected="selected">All</option>
                                                        @foreach ($documentTypeAll as $eachDocument)
                                                            <option value="{{ $eachDocument->id }}"
                                                                {{ Request::exists('kategori') && request('kategori') == $eachDocument->id ? 'selected' : '' }}>
                                                                {{ $eachDocument->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            {{-- <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Urut Berdasarkan</label>
                                                    <select class="form-control" name="sort">
                                                        <option selected="selected">Ascending</option>
                                                        <option value="terbaru">Descending</option>
                                                    </select>
                                                </div>
                                            </div> --}}
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <div class="input-group input-group-lg">
                                                        <input type="search" class="form-control form-control-lg"
                                                            placeholder="Cari dokumen..." name="search"
                                                            value="{{ request('search') ?? '' }}">
                                                        <div class="input-group-append">
                                                            <button type="submit" class="btn btn-lg btn-info">
                                                                <i class="fa fa-search"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if (Request::exists('search'))
                        @foreach ($getDocumentType as $eachType)
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <div class="card card-info">
                                        <div class="card-header">
                                            <div class="card-title">
                                                {{ $eachType->name }}
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-bordered documentTable" id="documentTable">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 10px">#</th>
                                                        <th>Room</th>
                                                        <th>Locker</th>
                                                        <th>Rack</th>
                                                        <th>Box</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($documentArchive as $i => $eachDocument)
                                                        @if ($eachDocument->document_type_id == $eachType->id)
                                                            <tr>
                                                                <td>{{ $i + 1 }}</td>
                                                                <td>{{ $eachDocument->room->name }}</td>
                                                                <td>{{ $eachDocument->locker->code }}</td>
                                                                <td>{{ $eachDocument->rack->code }}</td>
                                                                <td>{{ $eachDocument->box->code }}</td>
                                                                <td><a href="" class="btn btn-info">Detail</a></td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </section>
        </div>

    </div>
    <!-- ./wrapper -->


    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Select2 -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
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
            $(".documentTable").DataTable({
                "responsive": true,
            })

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })

        });
    </script>
</body>

</html>
