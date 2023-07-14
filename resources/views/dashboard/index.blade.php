@extends('layouts.app')

@section('title', 'Menu Tindakan Medis')

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
                    <h6>Table Tindakan Medis</h6>
                </div>

                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link" id="tabvitalsign" data-toggle="tab" href="#vitalsign"
                                    role="tab" aria-controls="vitalsign" aria-selected="true">List Vital Sign</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tabtindakmedis" data-toggle="tab" href="#tindakmedis"
                                    role="tab" aria-controls="tindakmedis" aria-selected="true">List Tindak Medis</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show table-responsive" id="vitalsign" role="tabpanel"
                                aria-labelledby="tabvitalsign" style="margin-top: 20px;">
                                <table id="tablevitalsign" class="table table-striped table-bordered dt-responsive nowrap"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Nomor Antrian</th>
                                            <th>tekanan_darah</th>
                                            <th>suhu_tubuh</th>
                                            <th>laju_respirasi</th>
                                            <th>pulsu</th>
                                            {{-- <th></th> --}}
                                            {{-- <th>status</th> --}}
                                            <th>Aksi</th>
                                        </tr>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade show table-responsive" id="tindakmedis" role="tabpanel"
                                aria-labelledby="tindakmedis" style="margin-top: 20px;">
                                <table id="tabletindakmedis" class="table table-striped table-bordered dt-responsive nowrap"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Nama Dokter</th>
                                            <th>jenis_tindakan</th>
                                            <th>hasil_tindakan</th>
                                            <th>tanggal_tindakan</th>
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
                <script>
                    $(document).ready(function() {
                        $('#tablevitalsign').DataTable({
                            processing: true,
                            serverSide: true,
                            ajax: {
                                url: "/datavitalsign",
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
                                    data: 'tekanan_darah',
                                    name: 'tekanan_darah'
                                },
                                {
                                    data: 'suhu_tubuh',
                                    name: 'suhu_tubuh'
                                },
                                {
                                    data: 'laju_respirasi',
                                    name: 'laju_respirasi'
                                },
                                {
                                    data: 'pulsu',
                                    name: 'pulsu'
                                },
                                {
                                    data: null,
                                    className: "dt-center editor-delete",
                                    orderable: false,
                                    "mRender": function(data, type, row) {
                                        return '<div class="btn-group" role="group" aria-label="Actions">' +
                                                '<a class="btn btn-success btn-sm" href="/vital_sign/' + data.id_vitalsign + '">' +
                                                '<i class="fas fa-eye"></i> Details</a>' ;
                                           
                                    }
                                }
                            ],
                        });
                        $('#tabletindakmedis').DataTable({
                            processing: true,
                            serverSide: true,
                            ajax: {
                                url: "/hasilTindakanMedis",
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
                                    data: 'name',
                                    name: 'name'
                                },
                                {
                                    data: 'jenis_tindakan',
                                    name: 'jenis_tindakan'
                                },
                                {
                                    data: 'hasil_tindakan',
                                    name: 'hasil_tindakan'
                                },
                                {
                                    data: 'tanggal_tindakan',
                                    name: 'tanggal_tindakan'
                                },
                                {
                                    data: null,
                                    className: "dt-center editor-delete",
                                    orderable: false,
                                    "mRender": function(data, type, row) {
                                        return '<div class="btn-group" role="group" aria-label="Actions">' +
                                                '<a class="btn btn-success btn-sm" href="/tindakan_medis/' + data.id_tindakan_medis + '">' +
                                                '<i class="fas fa-eye"></i> Details</a>' ;
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
