<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PSDKP | Log in</title>

    <script src="https://kit.fontawesome.com/3c3b5dd79d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="css/style.css">

</head>

<body class="hold-transition home-page">
    <div class="login-box">
        {{-- <div class="login-logo">
            <a href="../../index2.html"><b>Admin</b>LTE</a>
        </div> --}}
    </div>
    <div class="container">
        <div class="row mb-3">
            <div class="col-12 text-center">
                <img src="{{ asset('img/logo_psdkp.png') }}" alt="AdminLTE Logo" class="img-circle elevation-3"
                    width="5%">
                <h1 class="text-light">PSDKP Batam</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Pilih Kategori Surat</label>
                                    <select class="form-control">
                                        <option selected="selected">All</option>
                                        <option>Alaska</option>
                                        <option>California</option>
                                        <option>Delaware</option>
                                        <option>Tennessee</option>
                                        <option>Texas</option>
                                        <option>Washington</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Pilih Kolom Pencarian</label>
                                    <select class="form-control">
                                        <option selected="selected">All</option>
                                        <option>Alaska</option>
                                        <option>California</option>
                                        <option>Delaware</option>
                                        <option>Tennessee</option>
                                        <option>Texas</option>
                                        <option>Washington</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="input-group input-group">
                                    <input type="text" class="form-control" data-dashlane-rid="278c857c2030868a"
                                        data-form-type="other" placeholder="Cari Kata Kunci">
                                    <span class="input-group-append">
                                        <button type="button" class="btn btn-info btn-flat" data-dashlane-label="true"
                                            data-dashlane-rid="d387b56ca3458ef6" data-form-type="other">
                                            <i class="fas fa-search fa-fw"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </divv>
        <!-- /.login-box -->

        <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
