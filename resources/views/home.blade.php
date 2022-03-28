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
            <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarExample01">
                <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link btn btn-success mt-3 ml-3" aria-current="page" href="{{ route('login') }}">
                        <i class="bi bi-arrow-left"></i>
                            Kembali
                        </a>
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
        <div class="content-wrapper home-page" style="background: url({{ asset('/img/bookshelf.png') }}) no-repeat center center; background-size: cover;">
            <!-- Main content -->
            <section class="content" style="background-color: #013060E8; padding: 50px; border-radius: 10px">
                <div class="container mt-5">
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
                                                            <button type="submit" class="btn btn-lg btn-success">
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
                                    <div class="card">
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
                                                                <td><button type="button" name="showDocument" data-id="{{ $eachDocument->id }}" class="btn btn-info"><i class="bi bi-eye"></i></button></td>
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

    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              {{-- <h5 class="modal-title" id="detailModalLabel">Modal title</h5> --}}
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row px-lg-5 py-lg-4" id="content">
                       
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>


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

            // $(window).scroll(function(){
            //     var scroll = $(window).scrollTop();

            //     console.log(scroll);
            //     if (scroll > 100) {
            //         $(".navbar").addClass("navbar-scrolled");
            //     }else{
            //         $(".navbar").removeClass("navbar-scrolled");  	
            //     }
            // })
                        
            $("button[name*='showDocument']").on("click",function(){
   
                let id = $(this).data('id');

                $.ajax({
                    url: '{{ route("get.document-detail",['']) }}/' + id,
                    type: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    success: function(response){ 
                        let data = response.data;

                        $('#detailModal').modal('show');
                        
                        let content = $('#detailModal').find("#content");

                        let html = "";


                        $.each(data.document_infos,function(i,v){
                            html += `
                                <div class="col-4 mb-4">
                                    <div class="form-group">
                                        <label for="">${v.input_format.name} :</label>
                                        <p>${v.value}</p>
                                    </div>
                                </div>
                            `;
                        });

                        html+=`
                            <div class="col-4 mb-4">
                                <div class="form-group">
                                    <label for="">Ruang :</label>
                                    <p>${data.room.name}</p>
                                </div>
                            </div>
                        `;

                        html+=`
                            <div class="col-4 mb-4">
                                <div class="form-group">
                                    <label for="">Loker :</label>
                                    <p>${data.locker.code}</p>
                                </div>
                            </div>
                        `;

                        html+=`
                            <div class="col-4 mb-4">
                                <div class="form-group">
                                    <label for="">Rack :</label>
                                    <p>${data.rack.code}</p>
                                </div>
                            </div>
                        `;

                        html+=`
                            <div class="col-4 mb-4">
                                <div class="form-group">
                                    <label for="">Rack :</label>
                                    <p>${data.box.code}</p>
                                </div>
                            </div>
                        `;

                        html+=`
                            <div class="col-12 d-flex justify-content-end mb-4">
                                <a class="btn btn-info" href="/fileDocument/${data.file}"><i class="bi bi-download"></i> Download</a>
                            </div>
                        `;

                        content.html(html);
                    }
                });
            });

        });
    </script>
</body>

</html>
