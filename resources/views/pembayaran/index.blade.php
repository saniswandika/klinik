@extends('layouts.app')

@section('title', 'Menu Pembayaran')

@section('content')

    {{-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.css"/> --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.css" />

    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/js/C"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.5/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap5.js"></script>
   
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Table Pembayaran pasien</h6>
                </div>

                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link" id="tabdraft" data-toggle="tab" href="#tabledraft"
                                    role="tab" aria-controls="tabledraft" aria-selected="true">List Pasien</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tabpembayaran" data-toggle="tab" href="#tablepembayaran"
                                    role="tab" aria-controls="tablepembayaran" aria-selected="true">List Pembayaran</a>
                            </li>
                            {{-- <li class="nav-item ml-auto" style="margin-left: auto">
                                <a href="/pendaftaran_pasien/create" class="btn btn-primary ml-2">
                                    <i class="fa fa-plus"></i> Tambah Pasien
                                </a>
                            </li> --}}
                        </ul>
                        <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show table-responsive" id="tablepembayaran" role="tabpanel"
                            aria-labelledby="tabpembayaran" style="margin-top: 20px;">
                            <table id="tblpembayaran" class="table table-striped table-bordered dt-responsive nowrap"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th>antrian</th>
                                        <th>Nama_pasien</th>
                                        <th>Alamat</th>
                                        <th>tanggal_pendaftaran</th>
                                        <th>Tanggal_Pembayaran</th>
                                        <th>total_pembayaran</th>
                                        <th>metode_pembayaran</th>
                                        {{-- <th>status</th> --}}
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                            <div class="tab-pane fade show table-responsive" id="tabledraft" role="tabpanel"
                                aria-labelledby="tabdraft" style="margin-top: 20px;">
                                <table id="draft" class="table table-striped table-bordered dt-responsive nowrap"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>antrian</th>
                                            <th>Nama_pasien</th>
                                            <th>Alamat</th>
                                            <th>tanggal_pendaftaran</th>
                                            <th>waktu_pendaftaran</th>
                                            <th>jenis_kelamin</th>
                                            {{-- <th></th> --}}
                                            {{-- <th>status</th> --}}
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#draft').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "/getdataPembayaran",
                    type: 'GET',
                    dataSrc: 'data'
                },
                buttons: [{
                    text: 'My button',
                    action: function(e, dt, node, config) {
                        alert('Button activated');
                    }
                }],
                columns: [{
                        data: 'Nomor_antrian',
                        name: 'Nomor_antrian'
                    },
                    {
                        data: 'Nama_pasien',
                        name: 'Nama_pasien'
                    },
                    {
                        data: 'Alamat',
                        name: 'Alamat'
                    },
                    {
                        data: 'tanggal_pendaftaran',
                        name: 'tanggal_pendaftaran'
                    },
                    {
                        data: 'waktu_pendaftaran',
                        name: 'waktu_pendaftaran'
                    },
                    {
                        data: 'jenis_kelamin',
                        name: 'jenis_kelamin'
                    },
                    {
                        data: null,
                        className: "dt-center editor-delete",
                        orderable: false,
                        "mRender": function(data, type, row) {
                            return '<div class="btn-group" role="group" aria-label="Actions">' +
                                    '<a class="btn btn-success btn-sm" href="/proses_Pembayaran/' + data.id + '">' +
                                    '<i class="fas fa-eye"></i> Proses Pembayaran</a>' +
                                    '<div class="btn-group" role="group" aria-label="Actions">' +
                                    '<a class="btn btn-success btn-sm" href="/pendaftaran_pasien/' + data.id + '">' +
                                    '<i class="fas fa-eye"></i> Details</a>' +
                                    '<form action="/pendaftaran_pasien/' + data.id + '" method="POST" style="display:inline">' +
                                        '@csrf' +
                                        '@method("DELETE")' +
                                        '<button type="submit" class="btn btn-danger btn-sm">' +
                                        '<i class="fas fa-trash"></i> Hapus Data</button>' +
                                    '</form>' +
                                    '<div class="btn-group" role="group" aria-label="Actions">'+
                                    '<a class="btn btn-primary btn-sm" href="/pendaftaran_pasien/'+data.id +'/edit""><i class="far fa-edit"></i></i>   Edit </a>' +
                                    '</div>';
                        }
                    }
                ],
            });
            $('#tblpembayaran').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "/getdataProsesPembayaran",
                    type: 'GET',
                    dataSrc: 'data'
                },
                buttons: [{
                    text: 'My button',
                    action: function(e, dt, node, config) {
                        alert('Button activated');
                    }
                }],
                columns: [{
                        data: 'Nomor_antrian',
                        name: 'Nomor_antrian'
                    },
                    {
                        data: 'Nama_pasien',
                        name: 'Nama_pasien'
                    },
                    {
                        data: 'Alamat',
                        name: 'Alamat'
                    },
                    {
                        data: 'tanggal_pendaftaran',
                        name: 'tanggal_pendaftaran'
                    },
                    {
                        data: 'Tanggal_Pembayaran',
                        name: 'Tanggal_Pembayaran'
                    },
                    {
                        data: 'total_pembayaran',
                        name: 'total_pembayaran'
                    },
                    {
                        data: 'metode_pembayaran',
                        name: 'metode_pembayaran'
                    },
                    {
                        data: null,
                        className: "dt-center editor-delete",
                        orderable: false,
                        "mRender": function(data, type, row) {
                            return '<div class="btn-group" role="group" aria-label="Actions">' +
                                    '<a class="btn btn-success btn-sm" href="/pembayaran/' + data.id + '">' +
                                    '<i class="fas fa-eye"></i> Details</a>' +
                                    '<form action="/pendaftaran_pasien/' + data.id + '" method="POST" style="display:inline">' +
                                        '@csrf' +
                                        '@method("DELETE")' +
                                        '<button type="submit" class="btn btn-danger btn-sm">' +
                                        '<i class="fas fa-trash"></i> Hapus Data</button>' +
                                    '</form>' +
                                    '<div class="btn-group" role="group" aria-label="Actions">' +
                                    '<a class="btn btn-primary btn-sm" href="/cetakStruk/' + data.id + '">' +
                                    '<i class="fas fa-eye"></i>Cetak Struk</a>';
                        }
                    }
                ],
            });
        });
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            var target = $(e.target).attr("href"); // mendapatkan href dari tab aktif
            $(target).find('table').DataTable().columns.adjust().responsive
                .recalc(); // menyesuaikan ulang lebar kolom dan responsivitas tabel
        });
    </script>
@endsection
